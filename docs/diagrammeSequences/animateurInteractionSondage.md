```mermaid
---
title: Diagramme de séquence Animateur lance une interaction sondage
---
sequenceDiagram
    Actor Auditeur
    Actor Animateur
    participant FrontendAuditeur as Frontend (Auditeur)
    participant FrontendAnimateur as Frontend (Animateur)
    participant Event as Event Server (Pusher)
    participant Backend as Backend (Laravel)
    participant DB as Base de données

    Animateur->>FrontendAnimateur: Demande de lancement d'une interaction de type sondage avec N choix (2 <= N <= 6)
    activate FrontendAnimateur

    FrontendAnimateur->>+Backend: requestCreateSurveyInteraction()
    activate Backend

    alt Animateur a les autorisations
        Backend->>+DB: getCurrentInteractions()
        activate DB

        DB-->>-Backend: CurrentInteractions
        deactivate DB

        Backend->>Backend: noOtherInteractionsInProgress()
        Backend->>Backend: isValidChoiceNumber()
        Backend->>Backend: isSurveyContentValid()

        Backend->>+DB: createSurveyInteraction()
        activate DB

        DB-->>-Backend: InteractionDetails
        deactivate DB

        Backend-->>FrontendAnimateur: confirmInteractionCreation()
        deactivate Backend
        deactivate FrontendAnimateur

        Backend->>+Event: notifyNewSurveyInteraction()
        activate Event

        Event-->>FrontendAuditeur: sendNewSurveyInteraction()
        deactivate Event

        FrontendAuditeur->>Auditeur: Affiche l'interaction

    else Animateur n'a pas les autorisations ou le contenu du sondage n'est pas valide
        Backend->>FrontendAnimateur: errorNotification("Impossible de créer l'interaction")
        deactivate Backend
    end
