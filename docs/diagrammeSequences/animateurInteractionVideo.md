```mermaid
---
title: Diagramme de séquence Animateur active/désactive le chat le chat
---
sequenceDiagram
    participant Animateur as Animateur (Frontend)
    participant Backend as Backend (Laravel)
    participant DB as Base de données

    Animateur->>Backend: Publie une interaction avec une vidéo
    Backend->>Backend: Vérifie que l'animateur a le droit de publier une interaction (CI-1)
    Backend->>Backend: Vérifie que le type de média correspond au type de l'interaction (CI-9)
    Backend->>DB: Enregistre l'interaction
    DB->>Backend: Renvoie les détails de l'interaction enregistrée
    Backend->>Animateur: Confirme la publication de l'interaction
