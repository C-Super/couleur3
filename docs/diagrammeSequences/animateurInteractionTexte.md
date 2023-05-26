```mermaid
---
title: Diagramme de séquence Animateur lance une interaction texte
---
sequenceDiagram
    participant Auditeur
    participant Animateur
    participant FrontendAuditeur as Frontend (Auditeur)
    participant FrontendAnimateur as Frontend (Animateur)
    participant Event as Event Server (Pusher)
    participant Backend as Backend (Laravel)
    participant DB as Base de données

    Animateur->>FrontendAnimateur: Demande de lancement d'une interaction texte
    activate FrontendAnimateur

    FrontendAnimateur->>+Backend: requestCreateTextInteraction()
    activate Backend

    Backend->>+DB: getCurrentInteractions()
    activate DB

    DB-->>-Backend: CurrentInteractions
    deactivate DB

    Backend->>Backend: noOtherInteractionsInProgress()

    Backend->>+DB: createTextInteraction()
    activate DB

    DB-->>-Backend: InteractionDetails
    deactivate DB

    Backend->>FrontendAnimateur: confirmInteractionCreation()
    deactivate Backend

    FrontendAnimateur->>Animateur: Confirme la création de l'interaction
    deactivate FrontendAnimateur

    Backend->>+Event: notifyNewTextInteraction()
    activate Event

    Event-->>FrontendAuditeur: sendNewTextInteraction()
    deactivate Event

    FrontendAuditeur->>Auditeur: Affiche l'interaction



