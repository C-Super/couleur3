```mermaid
---
title: Diagramme de séquence Animateur lance une interaction CTA
---
sequenceDiagram
    Actor Auditeur
    Actor Animateur
    participant FrontendAuditeur as Frontend (Auditeur)
    participant FrontendAnimateur as Frontend (Animateur)
    participant Event as Event Server (Pusher)
    participant Backend as Backend (Laravel)
    participant DB as Base de données

    Animateur->>FrontendAnimateur: Demande de lancement d'une interaction de type "CALL_TO_ACTION"
    activate FrontendAnimateur

    FrontendAnimateur->>+Backend: launchCallToActionInteraction()
    activate Backend

    alt Animateur a les autorisations
        Backend->>Backend: validateURL()

        Backend->>+DB: getCurrentInteractions()
        activate DB

        DB-->>-Backend: CurrentInteractions
        deactivate DB

        Backend->>Backend: validateCurrentInteractions()

        Backend->>+DB: createCallToActionInteraction()
        activate DB

        DB-->>-Backend: CreatedInteractionDetails
        deactivate DB

        Backend-->>FrontendAnimateur: confirmInteractionCreation()
        deactivate Backend
        deactivate FrontendAnimateur

        Backend->>+Event: notifyNewInteraction()
        activate Event

        Event-->>FrontendAuditeur: sendCallToActionInteraction()
        deactivate Event

        FrontendAuditeur->>Auditeur: Affiche l'interaction
    else Animateur n'a pas les autorisations
        Backend->>FrontendAnimateur: errorNotification("L'Animateur n'a pas les autorisations nécessaires")
        deactivate Backend
    end
