```mermaid
---
title: Diagramme de séquence Auditeur gagne une récompense
---
sequenceDiagram
    participant Auditeur
    participant FrontendAuditeur as Frontend (Auditeur)
    participant Backend as Backend (Laravel)
    participant DB as Base de données

    Auditeur->>FrontendAuditeur: Demande une récompense
    activate FrontendAuditeur

    FrontendAuditeur->>+Backend: requestRewards()
    activate Backend

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
        Backend->>Auditeur: displayRewards()
        deactivate Backend
    else Auditor Information Incomplete
        Backend->>Auditeur: requestCompleteInformation()
        deactivate Backend

        Auditeur->>+Backend: sendCompleteInformation()
        activate Backend

        Backend->>+DB: updateAuditorInformation()
        activate DB

        DB-->>-Backend: UpdatedAuditorInformation
        deactivate DB

        Backend->>FrontendAuditeur: displayRewards()
        deactivate Backend
        
        FrontendAuditeur->>Auditeur: Affiche la récompense
    end

     


