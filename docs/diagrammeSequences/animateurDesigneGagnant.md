```mermaid
---
title: Diagramme de séquence Animateur active/désactive le chat le chat
---
sequenceDiagram
    participant Auditeur
    participant Animateur
    participant FrontendAuditeur as Frontend (Auditeur)
    participant FrontendAnimateur as Frontend (Animateur)
    participant Event as Event Server (Pusher)
    participant Backend as Backend (Laravel)
    participant DB as Base de données

    Animateur->>FrontendAnimateur: Désigne un gagnant pour une interaction
    activate FrontendAnimateur

    FrontendAnimateur->>+Backend: designateWinnerForInteraction()
    activate Backend

    Backend->>+DB: getInteractionDetails()
    activate DB

    DB-->>-Backend: InteractionDetails
    deactivate DB

    Backend->>Backend: isInteractionFinished()
    Backend->>Backend: hasAssociatedReward()
    Backend->>Backend: isValidInteractionType()

    Backend->>+DB: designateWinnerForInteraction()
    activate DB

    DB-->>-Backend: UpdatedInteractionDetails
    deactivate DB

    Backend->>+Event: notifyWinnerForInteraction()
    activate Event

    Event-->>FrontendAuditeur: winnerNotification()
    deactivate Event

    FrontendAuditeur->>Auditeur: Notifie le gagnant pour l'interaction

    Backend->>Animateur: confirmWinnerDesignation()
    deactivate Backend


