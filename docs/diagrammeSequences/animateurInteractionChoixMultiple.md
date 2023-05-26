```mermaid
---
title: Diagramme de séquence Animateur lance une interaction à choix multiple
---
sequenceDiagram
    Actor Auditeur
    Actor Animateur
    participant FrontendAuditeur as Frontend (Auditeur)
    participant FrontendAnimateur as Frontend (Animateur)
    participant Event as Event Server (Pusher)
    participant Backend as Backend (Laravel)
    participant DB as Base de données

    Animateur->>FrontendAnimateur: Demande de lancement d'une interaction MCQ avec N choix (2 <= N <= 6)
    activate FrontendAnimateur

    FrontendAnimateur->>+Backend: createMCQInteraction(N)
    activate Backend

    alt Animateur a les autorisations
        Backend->>Backend: validateChoiceNumber(N)

        Backend->>+DB: getCurrentInteractions()
        activate DB

        DB-->>-Backend: CurrentInteractions
        deactivate DB

        Backend->>Backend: validateCurrentInteractions()

        Backend->>+DB: createMCQInteractionWithChoices()
        activate DB

        DB-->>-Backend: CreatedInteractionDetails
        deactivate DB

        Backend-->>FrontendAnimateur: confirmInteractionCreation()
        deactivate Backend
        deactivate FrontendAnimateur

        Backend->>+Event: notifyNewInteraction()
        activate Event

        Event-->>FrontendAuditeur: sendMCQInteractionToAuditors()
        deactivate Event

        FrontendAuditeur->>Auditeur: Affiche l'interaction
    else Animateur n'a pas les autorisations
        Backend->>FrontendAnimateur: errorNotification("L'Animateur n'a pas les autorisations nécessaires")
        deactivate Backend
    end
