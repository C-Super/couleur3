```mermaid
---
title: Diagramme de séquence Animateur active/désactive le chat le chat
---
sequenceDiagram
    Actor Auditeur
    Actor Animateur
    participant FrontendAuditeur as Frontend (Auditeur)
    participant FrontendAnimateur as Frontend (Animateur)
    participant Event as Event Server (Pusher)
    participant Backend as Backend (Laravel)
    participant DB as Base de données

    Animateur->>FrontendAnimateur: Demande d'activation/désactivation du chat
    activate FrontendAnimateur

    FrontendAnimateur->>+Backend: toggleChatActivation()
    activate Backend

    alt L'Animateur a les autorisations
        Backend->>+DB: toggleChatStatus()
        activate DB

        DB-->>-Backend: Nouveau statut du chat (activé/désactivé)
        deactivate DB

        Backend->>Event: notifyChatStatusChange(Nouveau statut du chat)
        deactivate Backend

        Event-->>FrontendAnimateur: chatStatusChangedNotification(Nouveau statut du chat)
        Event-->>FrontendAuditeur: chatStatusChangedNotification(Nouveau statut du chat)


        FrontendAnimateur->>Animateur: Notifie le changement du statut du chat (activé/désactivé)
        FrontendAuditeur->>Auditeur: Notifie le changement du statut du chat (activé/désactivé)

    else L'Animateur n'a pas les autorisations
        Backend->>FrontendAnimateur: errorNotification("L'Animateur n'a pas les autorisations nécessaires")
        deactivate Backend
        deactivate FrontendAnimateur
    end
