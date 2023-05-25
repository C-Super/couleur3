```mermaid
---
title: Diagramme de séquence Animateur active/désactive le chat le chat
---
sequenceDiagram
    participant Backend as Backend (Laravel)
    participant DB as Base de données

    Backend->>DB: Vérifie le temps restant de l'interaction
    DB->>Backend: Renvoie le temps restant
    Backend->>Backend: Si le temps est écoulé, termine l'interaction
    Backend->>DB: Met à jour l'état de l'interaction
    DB->>Backend: Renvoie l'état mis à jour de l'interaction



