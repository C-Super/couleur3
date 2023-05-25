```mermaid
---
title: Diagramme de séquence Animateur lance une interaction CTA
---
sequenceDiagram
    participant Animateur as Animateur (Frontend)
    participant Auditeur as Auditeur (Frontend)
    participant Backend as Backend (Laravel)
    participant DB as Base de données

    Animateur->>Backend: Demande de terminer une interaction
    Backend->>DB: Met à jour l'interaction avec "ended_at" à maintenant
    DB->>Backend: Renvoie les détails de l'interaction mise à jour
    Backend->>Animateur: Confirme la fin de l'interaction
    Backend->>Auditeur: Notifie la fin de l'interaction




