```mermaid
---
title: Diagramme de séquence Animateur active/désactive le chat le chat
---
sequenceDiagram
    participant Auditeur as Auditeur (Frontend)
    participant Backend as Backend (Laravel)
    participant DB as Base de données

    Auditeur->>Backend: Envoie une réponse avec une photo
    Backend->>Backend: Vérifie que l'interaction est toujours ouverte (CI-3)
    Backend->>Backend: Vérifie que le type de média correspond au type de l'interaction (CI-9)
    Backend->>DB: Enregistre la réponse
    DB->>Backend: Renvoie les détails de la réponse enregistrée
    Backend->>Auditeur: Confirme l'enregistrement de la réponse


