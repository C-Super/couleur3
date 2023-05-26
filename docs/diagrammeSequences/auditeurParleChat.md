```mermaid
---
title: Diagramme de séquence Auditeur parle dans le chat
---
sequenceDiagram
    Actor Auditeur
    Actor Animateur
    participant FrontendAuditeur as Frontend (Auditeur)
    participant FrontendAnimateur as Frontend (Animateur)
    participant Event as Event Server (Pusher)
    participant Backend as Backend (Laravel)
    participant DB as Base de données

    Auditeur->>FrontendAuditeur: sendMessage()
    activate FrontendAuditeur

    FrontendAuditeur->>FrontendAuditeur: verifyChatPermission()

    alt Auditeur est authentifié
        FrontendAuditeur->>+Backend: relayMessage()
        activate Backend

        Backend->>+DB: fetchUserDetails()
        activate DB

        DB-->>-Backend: UserDetails
        deactivate DB

        Backend->>Backend: verifyChatPermission()

        Backend->>+DB: fetchChatInteraction()
        activate DB

        DB-->>-Backend: ChatInteractionDetails
        deactivate DB

        Backend->>Backend: verifyChatOpen()

        alt Chat is open
            Backend->>Backend: validateMessageContent()

            Backend->>+DB: storeChatMessage()
            activate DB

            DB-->>-Backend: StoredMessageDetails
            deactivate DB

            Backend->>Event: emitNewMessageEvent()
            deactivate Backend

            Event->>FrontendAuditeur: newMessageEvent()
            FrontendAuditeur->>Auditeur: displayNewMessage()
            deactivate FrontendAuditeur

            Event->>FrontendAnimateur: newMessageEvent()
            FrontendAnimateur->>Animateur: displayNewMessage()
        else Chat is closed
            Backend-->>FrontendAuditeur: showChatStatus("Le chat est fermé")
            deactivate Backend
        end
    else Auditeur n'est pas authentifié
        FrontendAuditeur->>Auditeur: showAuthenticationRequiredMessage()
    end
