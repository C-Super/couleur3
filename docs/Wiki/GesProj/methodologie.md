## Mode de gestion
Dans le cadre du développement du projet, nous avons utilisé un framework agile, principalement inspiré des pratiques Scrum. 
Nous avons divisé les quatre semaines de travail à disposition en quatre sprints individuels. Chaque lundi, nous avons tenu une réunion qui combinait une rétrospective sur le sprint précédent, ainsi qu'une mise au point pour le travail à suivre. De plus, nous avons tenu chaque jour une réunion journalière pour assurer le suivi et l'état du projet. 
Dans le cadre de cette gestion, Samuel Dulex a pris le rôle de Scrum Master, et Joris Bohren celui de Product Owner.
## Outils
### GitHub
GitHub a servi de ressource centrale pour tout le développement du projet. Nous avons rapidement décidé de centraliser le plus possible l'information, et dans le cadre de ce projet universitaire, GitHub dispose d'une offre attractive. En plus de la fonctionnalité de base de serveur remote git, nous avons aussi utilisé les fonctionnalités adjacentes suivantes : 
#### Projects
GitHub Projects est un logiciel de gestion de projet spécialisé pour les développement informatiques. Il permet de lier automatiquement des Issues GitHub à des tâches, et de les visualiser sous forme de tableau, Kanban Board ou Gantt. Samuel Dulex a configuré cet outil.
#### Codespaces
GitHub Codespaces est un environnement de développement à distance, permettant de garantir un environnement identique pour chaque membre de l'équipe, évitant ainsi des problèmes de compatibilité et permettant de s'affranchir du besoin d'installer toutes les technologies sur chacun de nos ordinateurs. Codespaces s'intègre nativement avec Visual Studio Code, notre éditeur de code pour ce projet. Daniel Mendes a configuré cet outil. 
#### Actions
GitHub Actions est un service permettant de faciliter l'intégration continue (CI) ainsi que le déploiement continu (CD). Dans le cadre de ce projet, nous l'avons principalement utilisé pour le CI. À chaque changement fusionné dans la branche main, des Actions se lancent pour faire une série de tests afin de déterminer rapidement le fonctionnement des nouveaux changements. Daniel Mendes a configuré cet outil. 
### Discord
Discord est une application de communication similaire à Slack ou Teams. Nous l'avons utilisé comme solution facile de visioconférence, ainsi que pour le chat. Nous avons créé un canal de chat par équipe, permettant de mieux diviser les tâches et permettant de renforcer la collaboration. Finalement, à l'aide de Webhooks, nous avons lié le repository GitHub. Ceci permet de nous notifier lors de changements importants directement sur nos appareils, assurant un suivi du projet optimal. Joris Bohren a configuré cet outil. 
### Obsidian
Obsidian est un éditeur spécialisé de texte pour les fichiers Markdown, permettant de gérer une base de documentation complète et interconnectée. Sachant que les fichiers Obisidan sont de simples Markdown, nous avons stocké notre documentation sur le repository GitHub. Le rapport final du projet est constitué principalement de ces fichiers Markdown, simplement collectés en un seul document et mis en page. Joris Bohren a configuré cet outil.