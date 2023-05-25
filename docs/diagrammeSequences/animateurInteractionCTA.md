```mermaid
---
title: Diagramme de séquence Animateur lance une interaction CTA
---
sequenceDiagram
    participant Auditeur
    participant Animateur
    participant FrontendAuditeur as Frontend (Auditeur)
    participant FrontendAnimateur as Frontend (Animateur)
    participant Event as Event Server (Pusher)
    participant Backend as Backend (Laravel)
    participant DB as Base de données

    Animateur->>FrontendAnimateur: Demande de lancement d'une interaction de type "CALL_TO_ACTION"
    activate FrontendAnimateur

    FrontendAnimateur->>+Backend: launchCallToActionInteraction()
    activate Backend

    Backend->>+DB: getCurrentInteractions()
    activate DB

    DB-->>-Backend: CurrentInteractions
    deactivate DB

    Backend->>Backend: noOtherInteractionsInProgress()
    Backend->>Backend: isTextURL()

    Backend->>+DB: createCallToActionInteraction()
    activate DB

    DB-->>-Backend: CreatedInteractionDetails
    deactivate DB

    Backend->>FrontendAnimateur: confirmInteractionCreation()
    deactivate Backend

    FrontendAnimateur->>Animateur: Confirme la création de l'interaction
    deactivate FrontendAnimateur

    Backend->>+Event: notifyNewInteraction()
    activate Event

    Event-->>FrontendAuditeur: sendCallToActionInteraction()
    deactivate Event

    FrontendAuditeur->>Auditeur: Affiche l'interaction




