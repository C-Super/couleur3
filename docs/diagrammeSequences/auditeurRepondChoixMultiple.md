```mermaid
---
title: Diagramme de séquence Auditeur répond à une interaction de type "MCQ"
---
sequenceDiagram
    Actor Auditeur
    Actor Animateur
    participant FrontendAuditeur as Frontend (Auditeur)
    participant FrontendAnimateur as Frontend (Animateur)
    participant Event as Event Server (Pusher)
    participant Backend as Backend (Laravel)
    participant DB as Base de données

    Auditeur->>FrontendAuditeur: sendMCQResponse()
    activate FrontendAuditeur

    FrontendAuditeur->>FrontendAuditeur: verifyInteractionNotFinished()
    FrontendAuditeur->>FrontendAuditeur: verifyNoPreviousResponse()
    FrontendAuditeur->>FrontendAuditeur: verifyResponseValidity()

    alt Auditeur est authentifié
        FrontendAuditeur->>+Backend: relayResponse()
        activate Backend

        Backend->>+DB: fetchOngoingInteractions()
        activate DB

        DB-->>-Backend: OngoingInteractions
        deactivate DB

        Backend->>Backend: verifyInteractionNotFinished()
        Backend->>+DB: fetchUserResponsesForInteraction()
        activate DB

        DB-->>-Backend: UserResponsesForInteraction
        deactivate DB

        Backend->>Backend: verifyNoPreviousResponse()
        Backend->>+DB: fetchInteractionResponses()
        activate DB

        DB-->>-Backend: InteractionResponses
        deactivate DB

        Backend->>Backend: verifyResponseValidity()

        alt Interaction is MCQ type
            Backend->>+DB: fetchCorrectInteractionResponse()
            activate DB

            DB-->>-Backend: CorrectInteractionResponse
            deactivate DB

            Backend->>Backend: verifyResponseCorrectness()
            Backend->>+DB: createNewResponseWithReference()
            activate DB

            DB-->>-Backend: CreatedResponseDetails
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
        else Interaction is not MCQ type
            Backend-->>FrontendAuditeur: showIncorrectInteractionTypeMessage()
            deactivate Backend
        end
    else Auditeur n'est pas authentifié
        FrontendAuditeur->>Auditeur: showAuthenticationRequiredMessage()
    end
