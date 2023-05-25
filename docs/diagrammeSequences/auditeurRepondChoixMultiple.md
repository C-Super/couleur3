```mermaid
---
title: Diagramme de séquence Auditeur répond à une interaction de type "MCQ"
---
sequenceDiagram
    participant Auditeur as Auditeur (Frontend)
    participant Animateur as Animateur (Frontend)
    participant Event as Event Server (Pusher)
    participant Backend as Backend (Laravel)
    participant DB as Base de données

    Auditeur->>Backend: Envoie la réponse à une interaction de type "MCQ"
    Backend->>Backend: Vérifie que l'interaction n'est pas terminée 
    Backend->>Backend: Vérifie que l'auditeur n'a pas déjà répondu à cette interaction
    Backend->>Backend: Vérifie que la réponse correspond à une des choix de l'interaction
    Backend->>DB: Demande la bonne réponse de l'interaction
    DB->>Backend: Renvoie la bonne réponse de l'interaction
    Backend->>Backend: Vérifie que la réponse est correcte
    Backend->>DB: Crée une nouvelle réponse avec la référence au choix de la question
    DB->>Backend: Renvoie les détails de la réponse créée
    Backend->>Auditeur: Confirme la prise en compte de la réponse
    Backend->>Event: Notifie qu'il y a une nouvelle réponse
    Event->>Animateur: Envoie la réponse à l'animateur





