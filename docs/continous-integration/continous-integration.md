# Intégration continue

```mermaid
flowchart LR

    subgraph setup
        direction TB

        setupPHP
        installComposerDepedencies
        setupNode
        installNpmDependencies
    end

    subgraph format
        direction TB

        laravelPint
        prettier
    end

    subgraph lint
        direction TB

        larastan
        eslint
    end

    subgraph test
        direction TB

        pest
    end

    subgraph security
        direction TB

        phpSecurityChecker
        npmAudit
    end

    subgraph build
        direction TB

        npmBuild
        composerProduction
    end

    subgraph deploy
        direction TB

        connectSSH
    end

    setup --> format
    format --> lint
    lint --> test
    test --> security
    security --> build
    build --> deploy

    click laravelPint "https://laravel.com/docs/10.x/pint" _blank
    click prettier "https://prettier.io/" _blank
    click larastan "https://github.com/nunomaduro/larastan" _blank
    click eslint "https://eslint.org/" _blank
    click pest "https://pestphp.com/" _blank
    click phpSecurityChecker "https://github.com/enlightn/security-checker" _blank
    click npmAudit "https://docs.npmjs.com/cli/v9/commands/npm-audit" _blank
```

## Laravel Pint

Documentation: https://laravel.com/docs/10.x/pint

Laravel Pint est un outil de correction de style de code PHP pour les applications Laravel. Basé sur PHP-CS-Fixer, il permet de maintenir un style de code propre et cohérent.

## Prettier

Documentation: https://prettier.io/

Prettier est un outil de formatage de code qui permet d'automatiser et d'uniformiser la mise en forme du code source. Il prend en charge plusieurs langages de programmation, tels que JavaScript, TypeScript, CSS, HTML, JSON et bien d'autres.

## Larastan

Documentation: https://github.com/nunomaduro/larastan

Larastan est un outil d'analyse statique de code spécifiquement conçu pour les applications Laravel. Il utilise [PHPStan](https://phpstan.org/), un outil d'analyse statique pour PHP, pour détecter les erreurs potentielles, les problèmes de typage, les incohérences de méthode, les problèmes de performance et autres erreurs courantes dans le code Laravel

## ESLint

Documentation: https://eslint.org/

ESLint est un outil de linting pour JavaScript et TypeScript. Il permet de détecter et de signaler les erreurs de syntaxe, les problèmes de style et les erreurs logiques dans le code

## Pest

Documentation: https://pestphp.com/

Pest est un framework de test unitaire pour PHP. Il permet aux développeurs d'écrire et d'exécuter des tests automatisés pour vérifier le bon fonctionnement de leur code PHP.

## PHP Security Checker

Documentation: https://github.com/enlightn/security-checker

PHP Security Checker est un outil qui permet de vérifier si les dépendances PHP d'un projet contiennent des vulnérabilités connues.

## npm audit

Documentation: https://docs.npmjs.com/cli/v9/commands/npm-audit

C'est une commande fournie par npm, le gestionnaire de paquets de Node.js. Elle permet de vérifier les dépendances d'un projet JavaScript pour détecter les vulnérabilités connues et les problèmes de sécurité.
