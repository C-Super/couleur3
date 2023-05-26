```mermaid
---
title: Diagramme de séquence Animateur choisit une récompense
---
sequenceDiagram
    participant Animateur
    participant FrontendAnimateur as Frontend (Animateur)
    participant Backend as Backend (Laravel)
    participant DB as Base de données

    Animateur->>FrontendAnimateur: Attribue une récompense à une interaction
    activate FrontendAnimateur

    FrontendAnimateur->>+Backend: Demande d'ajout de la récompense à l'interaction
    activate Backend

    Backend->>+DB: Demande le type d'interaction
    activate DB

    DB-->>-Backend: Renvoie le type d'interaction
    deactivate DB

    Backend->>Backend: Vérifie que l'interaction est de type "MCQ", "TEXT", "AUDIO", "VIDEO" ou "PICTURE"

    Backend->>+DB: Demande les détails de la récompense
    activate DB

    DB-->>-Backend: Renvoie les détails de la récompense
    deactivate DB

    Backend->>Backend: Vérifie que la récompense est associée à un media de type "AUDIO", "VIDEO" ou "PICTURE"

    Backend->>+DB: Ajoute la récompense à l'interaction
    activate DB

    DB-->>-Backend: Renvoie les détails de l'interaction mise à jour
    deactivate DB

    Backend-->>-FrontendAnimateur: Confirme l'ajout de la récompense à l'interaction
    deactivate Backend

    FrontendAnimateur->>Animateur: Récompense ajoutée à l'interaction
    deactivate FrontendAnimateur







