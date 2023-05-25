```mermaid
---
title: Diagramme de séquence Animateur lance une interaction sondage
---
sequenceDiagram
    participant Animateur as Animateur (Frontend)
    participant Auditeur as Auditeur (Frontend)
    participant Backend as Backend (Laravel)
    participant DB as Base de données

    Animateur->>Backend: Demande de lancement d'une interaction de type sondage avec N choix (2 <= N <= 6)
    Backend->>Backend: Vérifie que le nombre de choix est entre 2 et 6 (CI-6)
    Backend->>DB: Crée une nouvelle interaction de type "SURVEY" avec les choix
    DB->>Backend: Renvoie les détails de l'interaction créée
    Backend->>Animateur: Confirme la création de l'interaction
    Backend->>Auditeur: Notifie la nouvelle interaction de sondage



