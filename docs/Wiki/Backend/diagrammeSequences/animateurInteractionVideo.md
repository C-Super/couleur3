```mermaid
---
title: Diagramme de séquence Animateur lance une interaction vidéo
---
sequenceDiagram
    Actor Auditeur
    Actor Animateur
    participant FrontendAuditeur as Frontend (Auditeur)
    participant FrontendAnimateur as Frontend (Animateur)
    participant Event as Event Server (Pusher)
    participant Backend as Backend (Laravel)
    participant DB as Base de données

    Animateur->>FrontendAnimateur: Demande de lancement d'une interaction vidéo
    activate FrontendAnimateur

    FrontendAnimateur->>+Backend: requestCreateVideoInteraction()
    activate Backend

    alt Animateur a les autorisations
        Backend->>Backend: validateAndCleanVideoInput()

        Backend->>+DB: getCurrentInteractions()
        activate DB

        DB-->>-Backend: CurrentInteractions
        deactivate DB

        Backend->>Backend: validateCurrentInteractions() and validateMediaType()

        Backend->>+DB: createVideoInteraction()
        activate DB

        DB-->>-Backend: InteractionDetails
        deactivate DB

        Backend-->>FrontendAnimateur: confirmInteractionCreation()
        deactivate Backend
        deactivate FrontendAnimateur

        Backend->>+Event: notifyNewVideoInteraction()
        activate Event

        Event-->>FrontendAuditeur: sendNewVideoInteraction()
        deactivate Event

        FrontendAuditeur->>Auditeur: Affiche l'interaction
    else Animateur n'a pas les autorisations
        Backend->>FrontendAnimateur: errorNotification("L'Animateur n'a pas les autorisations nécessaires")
        deactivate Backend
    end
```

