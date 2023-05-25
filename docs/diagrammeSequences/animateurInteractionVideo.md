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

    Animateur->>Backend: Publie une interaction avec une vidéo
    Backend->>Backend: Vérifie qu'il n'y a pas d'autres interactions en cours
    Backend->>Backend: Vérifie que le type de média correspond au type de l'interaction
    Backend->>DB: Enregistre l'interaction
    DB->>Backend: Renvoie les détails de l'interaction enregistrée
    Backend->>Animateur: Confirme la publication de l'interaction
    Backend->>Event: Notifie qu'il y a une nouvelle interaction
    Event->>Auditeur: Envoie l'interaction aux auditeurs
