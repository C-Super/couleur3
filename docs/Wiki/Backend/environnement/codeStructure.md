# Structure du backend

**Laravel** ayant été imposé pour la gestion du backend, le choix d'utiliser **Inertia.js** pour faire le lien entre le **Frontend** et le **Backend** sans devoir utiliser un **API** semblait la meilleure solution.

**Inertia.js** est un framework moderne qui permet de créer des applications monopages (SPA) en utilisant le backend classique de Laravel tout en bénéficiant de la réactivité des composants Vue.js sur le frontend.

L'utilisation de Inertia présente plusieurs avantages dans le cadre de  l'architecture du projet :

1. **Simplicité de développement** : Inertia permet de créer des interfaces utilisateur complexes sans avoir besoin de construire une API REST ou GraphQL séparée. Les développeurs peuvent ainsi se concentrer sur la logique métier en utilisant les outils et les pratiques qu'ils connaissent déjà, comme les contrôleurs, les ORM, etc.

2. **Intégration transparente** : En utilisant Inertia, on peut facilement utiliser les fonctionnalités de Vue.js dans un projet Laravel. Cela signifie qu'on peut bénéficier de la réactivité et de la réutilisation des composants offertes par Vue.js, tout en ayant un accès complet aux fonctionnalités de Laravel.

3. **Amélioration des performances** : Avec Inertia, les vues sont rendues côté serveur et envoyées au client sous forme de JSON. Cela élimine le besoin de faire plusieurs allers-retours au serveur pour obtenir les données, ce qui peut améliorer considérablement les performances.

4. **Maintenance simplifiée** : Étant donné qu'il n'y a pas besoin de construire et de maintenir une API séparée, l'infrastructure globale devient moins complexe, ce qui rend la maintenance plus facile.

Une autre technologie intéressante pour le projet aurait été d'utiliser **Laravel Precognition**.

L'intérêt d'utiliser **Laravel Precognition** dans un projet réside principalement dans sa capacité à anticiper les résultats d'une future requête HTTP, en particulier pour fournir une validation "en direct" pour votre application frontend JavaScript sans avoir à dupliquer vos règles de validation backend de l'application​[1](https://laravel.com/docs/10.x/precognition)​.

1. Facilite l'interaction en temps réel avec les utilisateurs lors de la validation des formulaires. Par exemple, lorsqu'un utilisateur remplit un champ de formulaire, une erreur de validation peut être affichée immédiatement à côté de celui-ci, améliorant ainsi l'expérience utilisateur​[2](https://haait.net/how-to-use-precognition-in-laravel-9/)​.

2. S'intègre à votre infrastructure existante avec un effort minimal. Pour activer cette fonctionnalité, il suffit d'ajouter le middleware precognition à la route souhaitée. Cette fonctionnalité est disponible à partir de Laravel 9.35​[2](https://haait.net/how-to-use-precognition-in-laravel-9/)​.

3. Peut rendre les interfaces plus conviviales en rendant la validation des données plus efficace et interactive. Cela peut être particulièrement utile pour les applications qui nécessitent une validation de formulaire complexe et qui souhaitent améliorer l'expérience utilisateur en fournissant des commentaires en temps réel​[2](https://haait.net/how-to-use-precognition-in-laravel-9/)​.

4. Flexible et peut s'adapter à divers scénarios d'utilisation. Par exemple, il peut être utilisé pour valider des champs spécifiques ou pour éviter d'exécuter du code de validation lourd. Il dispose également d'une fonctionnalité de limitation de débit qui peut être ajustée en fonction des besoins de votre application​[2](https://haait.net/how-to-use-precognition-in-laravel-9/)​.

Malheureusement, ce projet étant trop récent et manquant de documentation, le choix a été fait de le retirer du projet car posant trop de problèmes de compatibilité.

## Gestion de la sécurité

Afin de gérer le principe d'avoir 2 frontend différent, 1 pour les auditeurs et 1 pour les animateurs, le choix s'est porté sur l'utilisation de 2 middlewares différents qui permettent d'autoriser les utilisateurs à n'accéder qu'à leurs fonctionnalités respectives.

## Gestion des événements

La gestion et la diffusion des événements websocket se font avec 3 channel différents :

1. **Public** : Tout le monde peut écouter sur ce channel

2. **interactions** : Channel privé pour l'animateur

3. **answer** : Channel privé pour l'auditeur

## Gestion des jobs

Afin de pouvoir gérer correctement la fin des interactions, un job a été mis en place afin d'envoyer à tout le monde dès qu'un événement est terminé, cela permet d'empêcher les clients de manipuler les durées des interactions.

## Gestion des tests

Toutes les fonctionnalités créées des tests avec le framework **Pest**

**Pest** est un framework de tests pour PHP, et en particulier Laravel, qui vise à simplifier et à rendre l'écriture de tests plus agréable et moins fastidieuse. Sa syntaxe expressive, claire et minimaliste, permet d'écrire des tests plus lisibles et maintenables.

L'utilisation de **Pest** présente plusieurs avantages pour la réalisation des tests :

1. **Syntaxe expressive** : Pest utilise une syntaxe chaînée inspirée de frameworks de test JavaScript comme Jest. Cette approche rend les tests plus lisibles et permet aux développeurs de comprendre rapidement ce que fait un test.

2. **Fonctions de test de haut niveau** : **Pest** fournit des fonctions de test de haut niveau qui permettent d'écrire des tests plus concis et expressifs. Ces fonctions couvrent un large éventail de cas de test courants, réduisant ainsi le temps nécessaire à l'écriture de tests.

3. **Intégration transparente avec Laravel** : **Pest** s'intègre parfaitement avec Laravel, offrant une API familière pour tester les fonctionnalités spécifiques de Laravel. Il prend également en charge la parallélisation des tests, ce qui peut accélérer significativement l'exécution des tests.

4. **Flexibilité et extensibilité** : **Pest** est hautement extensible, permettant aux développeurs d'ajouter leurs propres fonctionnalités via des plugins. Cela donne aux développeurs la liberté de personnaliser le framework selon leurs besoins spécifiques.

## Polymorphisme

Afin de diminuer les redondances et augmenter la flexibilité de l'architecture du projet, il a été décidé d'intégrer le polymorphisme au sein du modèle de donnée.

Dans Laravel, le polymorphisme est un concept avancé d'orienté objet qui permet à un modèle d'interagir avec des modèles multiples de manière flexible. Il est souvent utilisé dans les relations entre les modèles, comme les relations polymorphiques et les relations polymorphiques multiples.

L'intérêt du polymorphisme réside dans sa flexibilité et sa réutilisabilité :

1. **Flexibilité** : Il permet à une entité d'appartenir à plusieurs autres entités. Par exemple, dans une application de blog, un commentaire pourrait être lié à un post, mais aussi à une vidéo ou à un produit. Sans le polymorphisme, il serait nécessaire de créer une table de liaison pour chaque type d'entité, ce qui pourrait rapidement devenir encombrant et difficile à maintenir.

2. **Réutilisabilité** : Il permet de réutiliser le code et de minimiser la redondance. En utilisant des relations polymorphiques, il est possible d'écrire une seule méthode qui peut être utilisée pour tous les types d'entités associées.