```mermaid
---
title: Diagramme de séquence Animateur active/désactive le chat le chat
---
sequenceDiagram
    participant Auditeur
    participant Animateur
    participant FrontendAuditeur as Frontend (Auditeur)
    participant FrontendAnimateur as Frontend (Animateur)
    participant Event as Event Server (Pusher)
    participant Backend as Backend (Laravel)
    participant DB as Base de données

    Animateur->>FrontendAnimateur: Demande d'activation/désactivation du chat
    activate FrontendAnimateur

    FrontendAnimateur->>+Backend: toggleChatStatus()
    activate Backend

    Backend->>+DB: checkChatStatus()
    activate DB

    alt is_chat_enabled est vrai
        DB-->>-Backend: "Le chat est déjà activé"

        Backend-->>FrontendAnimateur: showChatStatus("Le chat est déjà activé")
        deactivate Backend

    else is_chat_enabled est faux
        DB-->>-Backend: setChatStatus(true)

        Backend-->>FrontendAnimateur: confirmChatStatus(true)
        deactivate Backend

        FrontendAnimateur->>Animateur: Notifie chat activé

        Backend->>+Event: notifyChatActivation()
        activate Event

        Event-->>FrontendAuditeur: chatActivatedNotification()
        deactivate Event

        FrontendAuditeur->>Auditeur: chat activé
    end
    deactivate FrontendAnimateur


