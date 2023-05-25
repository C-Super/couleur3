```mermaid
---
title: Diagramme de séquence Animateur active/désactive le chat le chat
---
sequenceDiagram
    participant Auditeur as Auditeur (Frontend)
    participant Backend as Backend (Laravel)
    participant DB as Base de données

    Auditeur->>Backend: Répond à une interaction texte
    Backend->>Backend: Vérifie que l'auditeur a le droit de répondre à une interaction (CI-1)
    Backend->>DB: Enregistre la réponse
    DB->>Backend: Renvoie les détails de la réponse enregistrée
    Backend->>Auditeur: Confirme l'enregistrement de la réponse

