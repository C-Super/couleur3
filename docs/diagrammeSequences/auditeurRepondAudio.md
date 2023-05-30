```mermaid
---
title: Diagramme de séquence Auditeur répond à une interaction audio
---
sequenceDiagram
    Actor Auditeur
    Actor Animateur
    participant FrontendAuditeur as Frontend (Auditeur)
    participant FrontendAnimateur as Frontend (Animateur)
    participant Event as Event Server (Pusher)
    participant Backend as Backend (Laravel)
    participant DB as Base de données

    Auditeur->>FrontendAuditeur: sendAudioResponse()
    activate FrontendAuditeur

    FrontendAuditeur->>FrontendAuditeur: verifyInteractionOpen()
    FrontendAuditeur->>FrontendAuditeur: verifyResponseType()

    alt Auditeur est authentifié
        FrontendAuditeur->>+Backend: relayResponse()
        activate Backend

        Backend->>+DB: fetchInteractionDetails()
        activate DB

        DB-->>-Backend: InteractionDetails
        deactivate DB

        Backend->>Backend: verifyInteractionOpen()
        Backend->>Backend: verifyResponseType()

        alt Interaction est de type audio
            Backend->>+DB: storeResponse()
            activate DB

            DB-->>-Backend: StoredResponseDetails
            deactivate DB

            Backend->>FrontendAuditeur: confirmResponseRecorded()
            deactivate Backend

            FrontendAuditeur->>Auditeur: displayConfirmation()
            deactivate FrontendAuditeur

            Backend->>+Event: emitNewResponseEvent()
            activate Event

            Event->>FrontendAnimateur: newResponseEvent()
            deactivate Event

            FrontendAnimateur->>Animateur: displayResponse()
        else Interaction n'est pas de type audio
            Backend-->>FrontendAuditeur: showIncorrectInteractionTypeMessage()
            deactivate Backend
        end
    else Auditeur n'est pas authentifié
        FrontendAuditeur->>Auditeur: showAuthenticationRequiredMessage()
    end


