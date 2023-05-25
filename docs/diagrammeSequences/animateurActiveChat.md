```mermaid
---
title: Diagramme de séquence Animateur active/désactive le chat le chat
---
sequenceDiagram
    participant Auditeur as Auditeur (Frontend)
    participant Animateur as Animateur (Frontend)
    participant Backend as Backend (Laravel)
    participant DB as Base de données
    Animateur->>Backend: Demande d'activation/désactivation du chat
    Backend->>DB: Vérifie la configuration "is_chat_enabled"
    alt is_chat_enabled est vrai
        DB->>Backend: Renvoie "Le chat est déjà activé"
        Backend->>Animateur: Affiche "Le chat est déjà activé"
    else is_chat_enabled est faux
        DB->>Backend: Modifie la valeur de "is_chat_enabled" à vrai
        Backend->>Animateur: Confirme l'activation du chat
        Backend->>Auditeur: Affiche le chat
    end

