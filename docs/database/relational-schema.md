```mermaid
---
title: Schéma relationnel
---

classDiagram
    class CONFIGURATION {
        id id PK
        string name UNIQUE
        string value
        enum[STRING|INTEGER|BOOLEAN] type
    }

    class USER {
        id id PK
        string email UNIQUE
        string password
    }

    class ANIMATOR {
        id id PK
        id user_id FK USER.id
    }

    class AUDITOR {
        id id PK
        id user_id FK USER.id
        string[50] username UNIQUE
        string firstname
        string lastname
        string phone
        string address
        string city
        string country
        int[4] zip_code
    }

    class MESSAGE {
        id id PK
        string[255] content
        date created_at
        id auditor_id FK AUDITOR.id
    }

    class MEDIA {
        id id PK
        string[255] path
        enum[PICTURE|VIDEO|AUDIO] type
    }

    class INTERACTION {
        id id PK
        string title
        enum[MCQ|SURVEY|TEXT|AUDIO|PICTURE|VIDEO] type
        datetime created_at
        datetime ended_at
        id animator_id FK ANIMATOR.id
        id reward_id FK REWARD.id NULL
        int winners_quantity NULL
    }

    class REWARD {
        id id PK
        string[255] name
        id media_id FK MEDIA.id NULL
    }

    class QUESTION_CHOICE {
        id id PK
        string content
        boolean is_correct_answer
        id interaction_id FK INTERACTION.id
    }

    class ANSWER {
        id id PK
        id auditor_id FK AUDITOR.id
        id interaction_id FK INTERACTION.id
        id responds_with_id FK [MEDIA.id|ANSWER_TEXT.id|QUESTION_CHOICE.id]
    }

    class ANSWER_TEXT {
        id id PK
        string[255] content
    }

    class WINNER {
        id id PK
        id auditor_id FK AUDITOR.id
        id interaction_id FK INTERACTION.id
    }

    class CALL_TO_ACTION {
        id id PK
        string[255] description
        string[255] url
        id interaction_id FK INTERACTION.id
        id media_id FK MEDIA.id
    }

    AUDITOR --> USER : inherits et CI-1
    ANIMATOR --> USER : inherits et CI-1

    MESSAGE --> AUDITOR : CI-2

    INTERACTION --> ANIMATOR : CI-20
    INTERACTION -- INTERACTION : CI-5
    INTERACTION --> REWARD : CI-17

    QUESTION_CHOICE --> INTERACTION : CI-6, CI-7 et CI-8

    REWARD --> MEDIA : CI-13

    CALL_TO_ACTION --> MEDIA : CI-13
    CALL_TO_ACTION --> INTERACTION

    ANSWER --> AUDITOR : CI-3 et CI-4
    ANSWER --> INTERACTION : CI-12
    ANSWER --> ANSWER_TEXT : CI-11
    ANSWER --> QUESTION_CHOICE : CI-10
    ANSWER --> MEDIA : CI-9 et CI-13

    WINNER --> INTERACTION : CI-14, CI-15 et CI-16
    WINNER --> AUDITOR
```
