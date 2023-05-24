# Contraintes d'intégrité

1. Un `USER` ne peut pas être à la fois un `ANIMATOR` et un `AUDITOR`.

2. Un `AUDITOR` ne peut pas envoyer de `MESSAGE` si la `CONFIGURATION` `is_chat_enabled` est `false`.
3. Un `AUDITOR` ne peut pas `ANSWER` à une `INTERACTION` si la `ended_at` de celle-ci est dépassée.
4. un `AUDITOR` ne peut pas `ANSWER` à une même `INTERACTION` plusieurs fois. (UNIQUE: `interaction_id`, `auditor_id`)

5. La `ended_at` d'une `INTERACTION` ne peut pas être inférieure à la `created_at` de celle-ci.
6. Une `INTERACTION` de `type` `MCQ` ou `SURVEY` doit avoir entre 2 et 6 `QUESTION_CHOICE`.
7. Une `INTERACTION` de `type` `MCQ` doit avoir une seule `QUESTION_CHOICE` qui à `is_correct_answer` à `true`.
8. Une `INTERACTION` de `type` `SURVEY` doit avoir toutes les `QUESTION_CHOICE` à `is_correct_answer` à `true`.
9. Le `type` du `MEDIA` d'une `ANSWER` doit être le même que le `type` de l'`INTERACTION`.
10. Une `INTERACTION` de `type` `MCQ` ou `SURVEY` doit avoir une `ANSWER` en lien avec une `QUESTION_CHOICE`.
11. Une `INTERACTION` de `type` `TEXT` doit avoir une `ANSWER` en lien avec une `ANSWER_TEXT`.
12. Une `INTERACTION` de `type` `CALL_TO_ACTION` ne peut pas avoir de `ANSWER`.

13. Un `MEDIA` ne peut pas être lié à une `ANSWER`, `CALL_TO_ACTION` ou `REWARD` en même temps.

14. Une `ANSWER` ne peut pas `has_won` si l'`INTERACTION` n'a pas de `REWARD` associé.
15. Une `ANSWER` ne peut pas `has_won` si l'`INTERACTION` n'est pas terminée.
16. Une `ANSWER` ne peut pas `has_won` si l'`INTERACTION` est de `type` `SURVEY`.

17. Une `INTERACTION` de `type` `SURVEY` ne peut pas avoir de `REWARD` associé.
