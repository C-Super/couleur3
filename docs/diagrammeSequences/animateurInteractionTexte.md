```mermaid
---
title: Diagramme de séquence Animateur lance une interaction texte
---
sequenceDiagram
    participant Auditeur as Auditeur (Frontend)
    participant Animateur as Animateur (Frontend)
    participant Event as Event Server (Pusher)
    participant Backend as Backend (Laravel)
    participant DB as Base de données

    Animateur->>Backend: Demande de lancement d'une interaction texte
    Backend->>Backend: Vérifie qu'il n'y a pas d'autres interactions en cours
    Backend->>DB: Crée une nouvelle interaction de type "TEXT"
    DB->>Backend: Renvoie les détails de l'interaction créée
    Backend->>Animateur: Confirme la création de l'interaction
    Backend->>Event: Notifie qu'il y a une nouvelle interaction
    Event->>Auditeur: Notifie la nouvelle interaction texte


