```mermaid
---
title: Diagramme de séquence Animateur lance une interaction à choix multiple
---
sequenceDiagram
    participant Animateur as Animateur (Frontend)
    participant Auditeur as Auditeur (Frontend)
    participant Backend as Backend (Laravel)
    participant DB as Base de données

    Animateur->>Backend: Demande de lancement d'une interaction MCQ avec N choix (2 <= N <= 6)
    Backend->>Backend: Vérifie que le nombre de choix est entre 2 et 6 (CI-6)
    Backend->>DB: Crée une nouvelle interaction de type "MCQ" avec les choix
    DB->>Backend: Renvoie les détails de l'interaction créée
    Backend->>Animateur: Confirme la création de l'interaction
    Backend->>Auditeur: Notifie la nouvelle interaction à choix multiple


