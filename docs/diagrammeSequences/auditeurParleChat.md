```mermaid
---
title: Diagramme de séquence Animateur active/désactive le chat le chat
---
sequenceDiagram
    participant Auditeur as Auditeur (Frontend)
    participant Animateur as Animateur (Frontend)
    participant Event as Event Server (Pusher)
    participant Backend as Backend (Laravel)
    participant DB as Base de données

    Auditeur->>Backend: Envoie un message dans le chat
    Backend->>Backend: Vérifie que l'auditeur a le droit de parler dans le chat
    Backend->>Backend: Vérifie que l'interaction est toujours ouverte
    Backend->>Backend: Vérifie que le message ne contient pas de caractères interdits
    Backend->>DB: Enregistre le message dans le chat
    DB->>Backend: Renvoie les détails du message enregistré
    Backend->>Event: Event nouveau message
    Event->>Auditeur: Nouveau message
    Event->>Animateur: Nouveau message

