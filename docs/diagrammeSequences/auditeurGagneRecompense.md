```mermaid
---
title: Diagramme de séquence Auditeur gagne une récompense
---
sequenceDiagram
    Actor Auditeur
    participant FrontendAuditeur as Frontend (Auditeur)
    participant Backend as Backend (Laravel)
    participant DB as Base de données

    Auditeur->>FrontendAuditeur: Demande une récompense
    activate FrontendAuditeur

    FrontendAuditeur->>+Backend: requestRewards()
    activate Backend

    alt Auditeur est authentifié
        Backend->>Backend: validateAndEncryptAuditorInput()

        Backend->>+DB: fetchAuditorRewards()
        activate DB

        DB-->>-Backend: AuditorRewards
        deactivate DB

        Backend->>Backend: verifyRewardEligibility()

        Backend->>+DB: fetchAuditorInformation()
        activate DB

        DB-->>-Backend: AuditorInformation
        deactivate DB

        Backend->>Backend: verifyAuditorInformationCompleteness()

        alt Auditor Information Complete
            Backend-->>FrontendAuditeur: displayRewards()
            deactivate Backend
        else Auditor Information Incomplete
            Backend-->>FrontendAuditeur: requestCompleteInformation()
            deactivate Backend

            Auditeur->>+Backend: sendCompleteInformation()
            activate Backend

            Backend->>Backend: validateAndEncryptAuditorInput()

            Backend->>+DB: updateAuditorInformation()
            activate DB

            DB-->>-Backend: UpdatedAuditorInformation
            deactivate DB

            Backend-->>FrontendAuditeur: displayRewards()
            deactivate Backend

            FrontendAuditeur->>Auditeur: Affiche la récompense
        end
    else Auditeur n'est pas authentifié
        Backend->>FrontendAuditeur: errorNotification("Vous devez être authentifié pour demander une récompense")
        deactivate Backend
    end
