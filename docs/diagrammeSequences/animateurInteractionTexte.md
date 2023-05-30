```mermaid
---
title: Diagramme de séquence Animateur lance une interaction texte
---
sequenceDiagram
    Actor Auditeur
    Actor Animateur
    participant FrontendAuditeur as Frontend (Auditeur)
    participant FrontendAnimateur as Frontend (Animateur)
    participant Event as Event Server (Pusher)
    participant Backend as Backend (Laravel)
    participant DB as Base de données

    Animateur->>FrontendAnimateur: Demande de lancement d'une interaction texte
    activate FrontendAnimateur

    FrontendAnimateur->>+Backend: requestCreateTextInteraction()
    activate Backend

    alt Animateur a les autorisations
        Backend->>+DB: getCurrentInteractions()
        activate DB

        DB-->>-Backend: CurrentInteractions
        deactivate DB

        Backend->>Backend: noOtherInteractionsInProgress()
        Backend->>Backend: isTextContentValid()

        Backend->>+DB: createTextInteraction()
        activate DB

        DB-->>-Backend: InteractionDetails
        deactivate DB

        Backend-->>FrontendAnimateur: confirmInteractionCreation()
        deactivate Backend
        deactivate FrontendAnimateur

        Backend->>+Event: notifyNewTextInteraction()
        activate Event

        Event-->>FrontendAuditeur: sendNewTextInteraction()
        deactivate Event

        FrontendAuditeur->>Auditeur: Affiche l'interaction

    else Animateur n'a pas les autorisations ou le contenu du texte n'est pas valide
        Backend->>FrontendAnimateur: errorNotification("Impossible de créer l'interaction")
        deactivate Backend
    end
