```mermaid
---
title: Diagramme de séquence Animateur lance une interaction à choix multiple
---
sequenceDiagram
    participant Auditeur
    participant Animateur
    participant FrontendAuditeur as Frontend (Auditeur)
    participant FrontendAnimateur as Frontend (Animateur)
    participant Event as Event Server (Pusher)
    participant Backend as Backend (Laravel)
    participant DB as Base de données

    Animateur->>FrontendAnimateur: Demande de lancement d'une interaction MCQ avec N choix (2 <= N <= 6)
    activate FrontendAnimateur

    FrontendAnimateur->>+Backend: createMCQInteraction(N)
    activate Backend

    Backend->>+DB: getCurrentInteractions()
    activate DB

    DB-->>-Backend: CurrentInteractions
    deactivate DB

    Backend->>Backend: noOtherInteractionsInProgress()
    Backend->>Backend: isChoiceNumberValid(N)

    Backend->>+DB: createMCQInteractionWithChoices()
    activate DB

    DB-->>-Backend: CreatedInteractionDetails
    deactivate DB

    Backend->>FrontendAnimateur: confirmInteractionCreation()
    deactivate Backend

    FrontendAnimateur->>Animateur: Confirme la création de l'interaction
    deactivate FrontendAnimateur

    Backend->>+Event: notifyNewInteraction()
    activate Event

    Event-->>FrontendAuditeur: sendMCQInteractionToAuditors()
    deactivate Event

    FrontendAuditeur->>Auditeur: Affiche l'interaction


