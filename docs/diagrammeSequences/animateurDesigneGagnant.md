```mermaid
sequenceDiagram
Actor Auditeur
Actor Animateur
participant FrontendAuditeur as Frontend (Auditeur)
participant FrontendAnimateur as Frontend (Animateur)
participant Event as Event Server (Pusher)
participant Backend as Backend (Laravel)
participant DB as Database

    Animateur->>FrontendAnimateur: Designates Winners for an Interaction
    activate FrontendAnimateur

    FrontendAnimateur->>+Backend: designateWinnersForInteraction()
    activate Backend

    alt Animateur has permissions
        Backend->>+DB: getInteractionDetails()
        activate DB

        DB-->>-Backend: InteractionDetails
        deactivate DB

        Backend->>Backend: validateInteraction()

        Backend->>+DB: designateWinnersForInteraction()
        activate DB

        DB-->>-Backend: UpdatedInteractionDetails
        deactivate DB

        loop for each winner
            Backend->>+Event: notifyWinnerForInteraction()
            activate Event

            Event-->>FrontendAuditeur: winnerNotification()
            deactivate Event

            FrontendAuditeur->>Auditeur: Notify the winner for the interaction
        end

        Backend-->>FrontendAnimateur: confirmWinnersDesignation()
        deactivate Backend
        deactivate FrontendAnimateur
    else Animateur does not have permissions
        Backend->>FrontendAnimateur: errorNotification("The Host does not have the necessary permissions")
        deactivate Backend
    end
