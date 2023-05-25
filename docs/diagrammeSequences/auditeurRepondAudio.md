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

    Auditeur->>Backend: Envoie une réponse avec un audio
    Backend->>Backend: Vérifie que l'interaction est toujours ouverte
    Backend->>Backend: Vérifie que le type de média correspond au type de l'interaction
    Backend->>DB: Enregistre la réponse
    DB->>Backend: Renvoie les détails de la réponse enregistrée
    Backend->>Auditeur: Confirme l'enregistrement de la réponse
    Backend->>Event: Notifie qu'il y a une nouvelle réponse
    Event->>Animateur: Envoie la réponse à l'animateur
