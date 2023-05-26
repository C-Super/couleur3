```mermaid
---
title: Diagramme de séquence Auditeur répond à une interaction audio
---
sequenceDiagram
    participant Auditeur
    participant Animateur
    participant FrontendAuditeur as Frontend (Auditeur)
    participant FrontendAnimateur as Frontend (Animateur)
    participant Event as Event Server (Pusher)
    participant Backend as Backend (Laravel)
    participant DB as Base de données

    Auditeur->>FrontendAuditeur: sendAudioResponse()
    activate FrontendAuditeur

    FrontendAuditeur->>FrontendAuditeur: verifyInteractionOpen()
    FrontendAuditeur->>FrontendAuditeur: verifyResponseType()

    FrontendAuditeur->>+Backend: relayResponse()
    activate Backend

    Backend->>+DB: fetchInteractionDetails()
    activate DB

    DB-->>-Backend: InteractionDetails
    deactivate DB

    Backend->>Backend: verifyInteractionOpen()
    Backend->>Backend: verifyResponseType()

    Backend->>+DB: storeResponse()
    activate DB

    DB-->>-Backend: StoredResponseDetails
    deactivate DB

    Backend->>FrontendAuditeur: confirmResponseRecorded()
    deactivate Backend

    FrontendAuditeur->>Auditeur: displayConfirmation()
    deactivate FrontendAuditeur

    Backend->>+Event: emitNewResponseEvent()
    activate Event

    Event->>FrontendAnimateur: newResponseEvent()
    deactivate Event

    FrontendAnimateur->>Animateur: displayResponse()

