```mermaid
---
title: Diagramme de séquence Auditeur répond à une interaction texte
---
sequenceDiagram
    participant Auditeur
    participant Animateur
    participant FrontendAuditeur as Frontend (Auditeur)
    participant FrontendAnimateur as Frontend (Animateur)
    participant Event as Event Server (Pusher)
    participant Backend as Backend (Laravel)
    participant DB as Database

    Auditeur->>FrontendAuditeur: Responds to Text Interaction
    activate FrontendAuditeur

    FrontendAuditeur->>FrontendAuditeur: Checks if Interaction is Open
    FrontendAuditeur->>FrontendAuditeur: Validates Text

    FrontendAuditeur->>+Backend: Sends Response
    activate Backend

    Backend->>+DB: Queries Current Interaction Details
    activate DB

    DB-->>-Backend: Returns Current Interaction Details
    deactivate DB

    Backend->>Backend: Checks if Auditor is Allowed to Respond
    Backend->>Backend: Validates Text

    Backend->>+DB: Records Response
    activate DB

    DB-->>-Backend: Returns Recorded Response Details
    deactivate DB

    Backend->>FrontendAuditeur: Confirms Response Registration
    deactivate Backend

    FrontendAuditeur->>Auditeur: Confirms Response Registration
    deactivate FrontendAuditeur

    Backend->>+Event: notifyNewTextAnswer()
    activate Event

    Event-->>FrontendAnimateur: sendNewTextAnswer()
    deactivate Event

    FrontendAnimateur->>Animateur: Displays Response


