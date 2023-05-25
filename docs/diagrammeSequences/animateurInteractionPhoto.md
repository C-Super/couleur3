```mermaid
---
title: Diagramme de séquence Animateur création d'une interaction photo
---
sequenceDiagram
    participant Auditeur
    participant Animateur
    participant FrontendAuditeur as Frontend (Auditeur)
    participant FrontendAnimateur as Frontend (Animateur)
    participant Event as Event Server (Pusher)
    participant Backend as Backend (Laravel)
    participant DB as Base de données

    Animateur->>FrontendAnimateur: Publie une interaction avec une photo
    activate FrontendAnimateur

    FrontendAnimateur->>+Backend: requestCreatePhotoInteraction()
    activate Backend

    Backend->>+DB: getCurrentInteractions()
    activate DB

    DB-->>-Backend: CurrentInteractions
    deactivate DB

    Backend->>Backend: noOtherInteractionsInProgress()
    Backend->>Backend: isValidMediaTypeForInteraction()

    Backend->>+DB: saveInteraction()
    activate DB

    DB-->>-Backend: InteractionDetails
    deactivate DB

    Backend->>FrontendAnimateur: confirmInteractionPublication()
    deactivate Backend

    FrontendAnimateur->>Animateur: Confirme la publication de l'interaction
    deactivate FrontendAnimateur

    Backend->>+Event: notifyNewInteraction()
    activate Event

    Event-->>FrontendAuditeur: sendNewInteractionToAuditors()
    deactivate Event

    FrontendAuditeur->>Auditeur: Affiche l'interaction

