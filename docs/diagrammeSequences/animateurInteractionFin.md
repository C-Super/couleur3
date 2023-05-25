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

    Animateur->>FrontendAnimateur: Demande de terminer une interaction
    activate FrontendAnimateur

    FrontendAnimateur->>+Backend: requestEndInteraction()
    activate Backend

    Backend->>+DB: updateInteractionEndTime()
    activate DB

    DB-->>-Backend: UpdatedInteractionDetails
    deactivate DB

    Backend->>FrontendAnimateur: confirmEndOfInteraction()
    deactivate Backend

    FrontendAnimateur->>Animateur: Confirme la fin de l'interaction
    deactivate FrontendAnimateur

    Backend->>+Event: notifyEndOfInteraction()
    activate Event

    Event-->>FrontendAuditeur: sendEndOfInteraction()
    deactivate Event

    FrontendAuditeur->>Auditeur: Affiche la fin de l'interaction





