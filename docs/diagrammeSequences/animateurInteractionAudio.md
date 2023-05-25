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

    Animateur->>FrontendAnimateur: Publie une interaction avec un audio
    activate FrontendAnimateur

    FrontendAnimateur->>+Backend: publishAudioInteraction()
    activate Backend

    Backend->>+DB: getCurrentInteractions()
    activate DB

    DB-->>-Backend: CurrentInteractions
    deactivate DB

    Backend->>Backend: noOtherInteractionsInProgress()
    Backend->>Backend: isMediaTypeMatchingInteractionType()

    Backend->>+DB: registerInteraction()
    activate DB

    DB-->>-Backend: RegisteredInteractionDetails
    deactivate DB

    Backend->>FrontendAnimateur: confirmInteractionPublication()
    deactivate Backend

    FrontendAnimateur->>Animateur: Confirme la publication de l'interaction
    deactivate FrontendAnimateur

    Backend->>+Event: notifyNewInteraction()
    activate Event

    Event-->>FrontendAuditeur: sendInteractionToAuditors()
    deactivate Event

    FrontendAuditeur->>Auditeur: Affiche l'interaction

