```mermaid
gantt
	dateFormat DD-MM-YYYY
	title Projet ShowSpark
	excludes weekends
	todayMarker off
	
	section Backend
	Spécification backend: back1, 22-05-2023, 27-05-2023
	Base de données: back2, after back1, 2d
	Système de chat: back3, after back1, 10d
	Gestion des interactions: back4, after back1, 10d

	section Frontend
	Rapports UX: front1, 22-05-2023, 10d
	Conception graphique & UI: front2, 29-05-2023, 5d
	Intégration flux C3: front3, after front1, 2d
	Client chat: front4, after front1, 6d
	Interface interactions: front5, after front1, 6d
	Dashboard animateurs: front6, after front1, 7d

	section Finalisation
	Tests & déploiement: after front6, 2d

	section Gestion de projet
	Avant-projet: proj1, 22-05-2023, 2d
	Planification: proj2, after proj1, 3d
	Suivi réalisation: proj3, after proj2, 12d
	Clôture: proj4, after proj3, 2d
```
