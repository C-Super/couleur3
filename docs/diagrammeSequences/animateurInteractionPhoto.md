```mermaid
---
title: Diagramme de séquence Animateur création d'une interaction photo
---
sequenceDiagram
    Actor Auditeur
    Actor Animateur
    participant FrontendAuditeur as Frontend (Auditeur)
    participant FrontendAnimateur as Frontend (Animateur)
    participant Event as Event Server (Pusher)
    participant Backend as Backend (Laravel)
    participant DB as Base de données

    Animateur->>FrontendAnimateur: Publie une interaction avec une photo
    activate FrontendAnimateur

    FrontendAnimateur->>+Backend: requestCreatePhotoInteraction()
    activate Backend

    alt Animateur a les autorisations
        Backend->>+DB: getCurrentInteractions()
        activate DB

        DB-->>-Backend: CurrentInteractions
        deactivate DB

        Backend->>Backend: noOtherInteractionsInProgress()
        Backend->>Backend: isValidImageFile()

        Backend->>+DB: saveInteraction()
        activate DB

        DB-->>-Backend: InteractionDetails
        deactivate DB

        Backend-->>FrontendAnimateur: confirmInteractionPublication()
        deactivate Backend
        deactivate FrontendAnimateur

        Backend->>+Event: notifyNewInteraction()
        activate Event

        Event-->>FrontendAuditeur: sendNewInteractionToAuditors()
        deactivate Event

        FrontendAuditeur->>Auditeur: Affiche l'interaction

    else Animateur n'a pas les autorisations ou le fichier n'est pas une image valide
        Backend->>FrontendAnimateur: errorNotification("Impossible de créer l'interaction")
        deactivate Backend
    end
