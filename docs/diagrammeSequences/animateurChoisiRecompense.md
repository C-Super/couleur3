```mermaid
---
title: Diagramme de séquence Auditeur répond à une interaction de type "Sondage"
---
sequenceDiagram
    participant Animateur as Animateur (Frontend)
    participant Backend as Backend (Laravel)
    participant DB as Base de données

    Animateur->>Backend: Attribue une récompense à une interaction
    Backend->>Backend: Vérifie que l'interaction est de type "MCQ" ou "TEXT" (CI-17)
    Backend->>Backend: Vérifie que la récompense est associée à un media (CI-13)
    Backend->>DB: Ajoute la récompense à l'interaction
    DB->>Backend: Renvoie les détails de l'interaction mise à jour
    Backend->>Animateur: Confirme l'ajout de la récompense à l'interaction






