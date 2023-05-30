```mermaid
---
title: Diagramme de séquence Interaction finit
---
sequenceDiagram
    Actor Auditeur
    ACtor Animateur
    participant FrontendAuditeur as Frontend (Auditeur)
    participant FrontendAnimateur as Frontend (Animateur)
    participant Event as Event Server (Pusher)
    participant Backend as Backend (Laravel)
    participant DB as Database

    Backend->>+DB: Queries Interaction Status and Remaining Time
    activate DB

    DB-->>-Backend: Returns Interaction Status and Remaining Time
    deactivate DB

    Backend->>Backend: If Interaction is Active and Time is Up, Ends Interaction

    Backend->>+DB: Updates Interaction Status
    activate DB

    DB-->>-Backend: Returns Updated Interaction Status
    deactivate DB

    Backend->>+Event: Emits Interaction End Event
    activate Event

    Event-->>FrontendAuditeur: newInteractionEvent()
    deactivate Event

    FrontendAuditeur->>Auditeur: displayInteractionEnded()
    FrontendAuditeur->>Auditeur: disableInteraction()

    Event->>+FrontendAnimateur: newInteractionEvent()
    activate FrontendAnimateur

    FrontendAnimateur->>Animateur: Display Interaction End
    deactivate FrontendAnimateur

    Backend->>Backend: Disables Responses from Auditors
