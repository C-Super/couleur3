**Groupe** : super
**Membres** : BOHREN Joris, DA FONSECA Carina, DULEX Samuel, FORELICHER Cassandre, LONGO Rossiny, MENDES Daniel, REY Myriam, WUNDERLE Nicolas
**Classe** : M50-2
**Version** : 1
## Introduction
Couleur3 est une radio suisse romande publique, faisant partie du groupe RTS. Aujourd'hui, elle cherche à se redéfinir : intégrer les technologies web modernes et trouver des manières innovantes d'augmenter l'interaction à l'antenne ainsi que de créer un plus fort sens de communauté avec les auditeurs. 
Couleur3 a donc participé aux Hackdays de la RTS pour proposer cette question. Après 2 jours de travail intense, le groupe en charge a défini plusieurs axes et fonctionnalités que la radio pourrait explorer. Pour découvrir les maquettes ainsi que l'analyse technologique faite par Couleur3 à l'occasion de cet évènement, trouvez les liens ci-dessous : 
- [Maquette auditeurs](https://www.figma.com/proto/SXif9hDExKx45KslyAtD9l/wirefame-Couleur-3?page-id=143:10710&node-id=165-10721&viewport=210,432,0.4&scaling=min-zoom&starting-point-node-id=225:12451)
- [Maquette animateurs](https://www.figma.com/proto/SXif9hDExKx45KslyAtD9l/wirefame-Couleur-3?page-id=304:13539&node-id=304-14137&viewport=526,413,0.11&scaling=scale-down&starting-point-node-id=304:14070)
- [Analyse technologique](https://acrobat.adobe.com/link/track?uri=urn:aaid:scds:US:f5f80f5f-99eb-34c8-8145-67f03e37e330&viewer!megaVerb=group-discover)
## Résultats 
### Fonctionnalités
- Application auditeur
	- Écouter/regarder Couleur3
	- Login pour fonctionnalités
	- Chatter
	- Répondre à une question 
		- Par image
		- Par texte
		- Par vidéo
		- Par audio
		- Par QCM
	- Recevoir et afficher des CTA (call to action)
- Application animateurs
	- Accessible par login
	- Activer/désactiver le chat
	- Poser une question
		- Voir ci-dessus pour les différents types
		- Organiser un concours
	- Envoyer un CTA
### Autres livrables
- Application back-end Laravel complète
- Charte graphique et rapports UX
- Documentation complète du développement (format Markdown/Obsidian)
- Marche à suivre pour la formation des animateurs
## Coûts
- Phase de recherche et conception (360 heures)
	- UX : **150 heures** = 5 jours x 5 personnes x 6 heures
	- Spécification back-end : **60 heures** = 5 jours x 2 personnes x 6 heures
	- Gestion de projet & documentation : **30 heures** = 5 jours x 1 personne x 6 heures
	- Spécification front-end : **72 heures** = 4 jours x 3 personnes x 6 heures
	- Design visuel et conception UI : **48 heures** = 4 jours x 2 personnes x 6 heures
- Phase de développement (457 heures)
	- Développement back-end : **140 heures** = 10 jours x 2 personnes x 7 heures
	- Développement front-end : **245 heures** = 7 jours x 5 personnes x 7 heures
	- Gestion de projet & documentation : **72 heures** = 12 jours x 1 personne x 6 heures
- Phase de test & déploiement (108 heures)
	- Déploiement : **36 heures** = 3 jours x 2 personnes x 6 heures
	- Test : **72 heures** = 3 jours x 6 personnes x 4 heures
## Risques

| Probabilité v - Impact > | 1 - 2 | 3 - 4 | 5 - 6 | 7 - 8 | 9 - 10 |
| ------------------------:|:-----:|:-----:|:-----:|:-----:|:------:|
|                    1 - 2 |  6.   |       |       |  7.   |   4.   |
|                    3 - 4 |       |       |  5.   | 1./3. |        |
|                    5 - 6 |       |       |  2.   |       |        |
|                    7 - 8 |       |       |       |       |        |
|                   9 - 10 |       |       |       |       |        |
1. Problèmes de mise en place du serveur
2. Mauvaise estimation des tâches à faire 
3. Incompatibilité entre le front- et back-end 
4. Accident d'un membre de l'équipe
5. Besoin de réorienter le projet après retour client
6. Difficulté à implémenter le flux Couleur3
7. Perte d'informations importantes 
