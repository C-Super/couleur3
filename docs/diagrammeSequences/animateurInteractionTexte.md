```mermaid
---
title: Diagramme de séquence Animateur lance une interaction texte
---
sequenceDiagram
    participant Animateur as Animateur (Frontend)
    participant Auditeur as Auditeur (Frontend)
    participant Backend as Backend (Laravel)
    participant DB as Base de données

    Animateur->>Backend: Demande de lancement d'une interaction texte
    Backend->>DB: Crée une nouvelle interaction de type "TEXT"
    DB->>Backend: Renvoie les détails de l'interaction créée
    Backend->>Animateur: Confirme la création de l'interaction
    Backend->>Auditeur: Notifie la nouvelle interaction texte


