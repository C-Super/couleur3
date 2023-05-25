```mermaid
---
title: Diagramme de séquence Animateur lance une interaction CTA
---
sequenceDiagram
    participant Animateur as Animateur (Frontend)
    participant Auditeur as Auditeur (Frontend)
    participant Backend as Backend (Laravel)
    participant DB as Base de données

    Animateur->>Backend: Demande de lancement d'une interaction de type "CALL_TO_ACTION"
    Backend->>DB: Crée une nouvelle interaction de type "CALL_TO_ACTION"
    DB->>Backend: Renvoie les détails de l'interaction créée
    Backend->>Animateur: Confirme la création de l'interaction
    Backend->>Auditeur: Notifie la nouvelle interaction appel à l'action



