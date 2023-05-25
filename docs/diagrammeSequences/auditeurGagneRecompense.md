```mermaid
---
title: Diagramme de séquence Auditeur gagne une récompense
---
sequenceDiagram
    participant Auditeur as Auditeur (Frontend)
    participant Backend as Backend (Laravel)
    participant DB as Base de données

    Auditeur->>Backend: Demande de récupération des récompenses
    Backend->>DB: Récupère les récompenses de l'auditeur
    DB->>Backend: Renvoie les récompenses de l'auditeur
    Backend->>DB: Récupère les informations de l'utilisateur
    DB->>Backend: Renvoie les informations de l'utilisateur
    alt informations utilisateur est complète
        Backend->>Auditeur: Affiche les récompenses de l'auditeur
    else informations utilisateur est incomplet
        Backend->>Auditeur: Demande à l'auditeur de compléter ses informations
        Auditeur->>Backend: Envoie les informations de l'auditeur
        Backend->>DB: Met à jour les informations de l'auditeur
        DB->>Backend: Renvoie les informations de l'auditeur
        Backend->>Auditeur: Affiche les récompenses de l'auditeur
    end
     


