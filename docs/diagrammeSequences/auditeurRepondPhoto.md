```mermaid
---
title: Diagramme de séquence Audituer répond à une interaction photo
---
sequenceDiagram
    participant Auditeur
    participant Animateur
    participant FrontendAuditeur as Frontend (Auditeur)
    participant FrontendAnimateur as Frontend (Animateur)
    participant Event as Event Server (Pusher)
    participant Backend as Backend (Laravel)
    participant DB as Database

    Auditeur->>FrontendAuditeur: Sends Photo Response
    activate FrontendAuditeur

    FrontendAuditeur->>FrontendAuditeur: Checks if Interaction is Active
    FrontendAuditeur->>FrontendAuditeur: Checks if Media Type Matches Interaction Type

    FrontendAuditeur->>+Backend: Sends Response
    activate Backend

    Backend->>+DB: Queries Interaction Details
    activate DB

    DB-->>-Backend: Returns Interaction Details
    deactivate DB

    Backend->>Backend: Checks if Interaction is Active
    Backend->>Backend: Checks if Media Type Matches Interaction Type

    Backend->>+DB: Records Response
    activate DB

    DB-->>-Backend: Returns Recorded Response Details
    deactivate DB

    Backend->>FrontendAuditeur: Confirms Response Registration
    deactivate Backend

    FrontendAuditeur->>Auditeur: Confirms Response Registration
    deactivate FrontendAuditeur

    Backend->>+Event: Notifies New Response
    activate Event

    Event->>FrontendAnimateur: Sends New Response
    deactivate Event

    FrontendAnimateur->>Animateur: Displays New Response



