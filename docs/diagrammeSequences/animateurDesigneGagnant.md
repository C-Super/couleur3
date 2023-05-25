```mermaid
---
title: Diagramme de séquence Animateur active/désactive le chat le chat
---
sequenceDiagram
    participant Auditeur as Auditeur (Frontend)
    participant Animateur as Animateur (Frontend)
    participant Backend as Backend (Laravel)
    participant DB as Base de données

    Animateur->>Backend: Désigne un gagnant pour une interaction
    Backend->>Backend: Vérifie que l'interaction est terminée (CI-15)
    Backend->>Backend: Vérifie que l'interaction a une récompense associée (CI-14)
    Backend->>Backend: Vérifie que l'interaction n'est pas de type "SURVEY" (CI-16)
    Backend->>DB: Désigne un gagnant pour l'interaction
    DB->>Backend: Renvoie les détails de l'interaction mise à jour
    Backend->>Animateur: Confirme la désignation du gagnant
    Backend->>Auditeur: Notifie le gagnant


