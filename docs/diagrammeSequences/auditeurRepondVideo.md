```mermaid
---
title: Diagramme de séquence Auditeur répond à une interaction vidéo
---
sequenceDiagram
    participant Auditeur
    participant Animateur
    participant FrontendAuditeur as Frontend (Auditeur)
    participant FrontendAnimateur as Frontend (Animateur)
    participant Event as Event Server (Pusher)
    participant Backend as Backend (Laravel)
    participant DB as Database

    Auditeur->>FrontendAuditeur: Sends Video Response
    activate FrontendAuditeur

    FrontendAuditeur->>FrontendAuditeur: Checks if Interaction is Open
    FrontendAuditeur->>FrontendAuditeur: Validates Media Type

    FrontendAuditeur->>+Backend: Sends Response
    activate Backend

    Backend->>+DB: Queries Interaction Details
    activate DB

    DB-->>-Backend: Returns Interaction Details
    deactivate DB

    Backend->>Backend: Checks if Interaction is Open
    Backend->>Backend: Validates Media Type

    Backend->>+DB: Records Response
    activate DB

    DB-->>-Backend: Returns Recorded Response Details
    deactivate DB

    Backend->>FrontendAuditeur: Confirms Response Registration
    deactivate Backend

    FrontendAuditeur->>Auditeur: Confirms Response Registration
    deactivate FrontendAuditeur

    Backend->>+Event: notifyNewVideoResponse()
    activate Event

    Event-->>FrontendAnimateur: sendNewVideoResponse()
    deactivate Event

    FrontendAnimateur->>Animateur: Displays New Response

