```mermaid
---
title: Diagramme de séquence Auditeur répond à une interaction de type "Sondage"
---
sequenceDiagram
    Actor Auditeur
    Actor Animateur
    participant FrontendAuditeur as Frontend (Auditeur)
    participant FrontendAnimateur as Frontend (Animateur)
    participant Event as Event Server (Pusher)
    participant Backend as Backend (Laravel)
    participant DB as Database

    Auditeur->>FrontendAuditeur: Sends Survey Response
    activate FrontendAuditeur

    FrontendAuditeur->>FrontendAuditeur: verifyInteractionOpen()
    FrontendAuditeur->>FrontendAuditeur: Checks if Response Type Matches Interaction Type

    alt Auditeur est authentifié
        FrontendAuditeur->>+Backend: relaysResponse()
        activate Backend

        Backend->>+DB: fetchInteractionDetails()
        activate DB

        DB-->>-Backend: Returns Interaction Details
        deactivate DB

        Backend->>Backend: verifyInteractionOpen()
        Backend->>Backend: Checks if Response Type Matches Interaction Type

        alt Interaction is Survey type
            Backend->>+DB: recordResponse()
            activate DB

            DB-->>-Backend: Returns Recorded Response Details
            deactivate DB

            Backend->>FrontendAuditeur: displayConfirmation()
            deactivate Backend

            FrontendAuditeur->>Auditeur: displayConfirmation()
            deactivate FrontendAuditeur

            Backend->>+Event: emitNewResponseEvent()
            activate Event

            Event->>FrontendAnimateur: newResponseEvent()
            deactivate Event

            FrontendAnimateur->>Animateur: displayResponse()
        else Interaction is not Survey type
            Backend-->>FrontendAuditeur: showIncorrectInteractionTypeMessage()
            deactivate Backend
        end
    else Auditeur n'est pas authentifié
        FrontendAuditeur->>Auditeur: showAuthenticationRequiredMessage()
    end
