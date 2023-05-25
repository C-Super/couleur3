```mermaid
---
title: Diagramme de séquence Auditeur répond à une interaction de type "MCQ"
---
sequenceDiagram
    participant Auditeur as Auditeur (Frontend)
    participant Backend as Backend (Laravel)
    participant DB as Base de données

    Auditeur->>Backend: Envoie la réponse à une interaction de type "MCQ"
    Backend->>Backend: Vérifie que l'interaction n'est pas terminée (CI-3)
    Backend->>Backend: Vérifie que l'auditeur n'a pas déjà répondu à cette interaction (CI-4)
    Backend->>Backend: Vérifie que la réponse correspond à une des choix de l'interaction (CI-10)
    Backend->>DB: Crée une nouvelle réponse avec la référence au choix de la question
    DB->>Backend: Renvoie les détails de la réponse créée
    Backend->>Auditeur: Confirme la prise en compte de la réponse





