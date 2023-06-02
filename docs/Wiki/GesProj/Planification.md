**Groupe** : super
**Membres** : BOHREN Joris, DA FONSECA Carina, DULEX Samuel, FORELICHER Cassandre, LONGO Rossiny, MENDES Daniel, REY Myriam, WUNDERLE Nicolas
**Classe** : M50-2
**Version** : 1
## Project Breakdown Structure
```mermaid
 graph TB

 A[ShowSpark]
 
 B[Backend Laravel]
 
 C[Client PWA auditeurs]
 
 D[Client PWA animateurs]
 
 A-->B
 
 A-->C

 A-->D
 
 B-->BE1[Base de données]
 
 BE1-->BE2[Système de chat]
 
 BE2-->BE3[Gestion des interactions]
 
 BE3-->BE4[Classiques: texte, médias]
 
 BE4-->BE5[Spécifiques: QCM, sondage, CTA]
 
 BE5-->BE6[Documentation backend]
 
 C-->WC1_1[Rapport UX]
 
 WC1_1-->WC1_2[Charte & concept UI]
 
 WC1_2-->WC1_3[Intégration flux C3]
 
 WC1_3-->WC1_4[Chat live]
 
 WC1_4-->WC1_5[Répondre aux interactions]
 
 WC1_5-->WC1_6[Documentation auditeurs]
 
 D-->WC2_1[Rapport UX]
 
 WC2_1-->WC2_2[Charte & concept UI]
 
 WC2_2-->WC2_3[Dashboard]
 
 WC2_3-->WC2_4[Module interactions]
 
 WC2_4-->WC2_5[Module chat]
 
 WC2_5-->WC2_6[Documentation animateurs]  
```
## Tableau des livrables
### Equipe
**DM**: Daniel Mendes, ingénieur full-stack, administrateur système
**SD**: Samuel Dulex, ingénieur back-end, scrum master 
**MR**: Myriam Rey, conceptrice UX, graphiste, gestion de projet
**CDF**: Carina Da Fonseca, conceptrice UX, graphiste
**CF**: Cassandre Froelicher, conceptrice UX, ingénieure front-end
**RL**: Rossiny Longo, conceptrice UX, ingénieure front-end
**NW**: Nicolas Wunderle, concepteur UX, ingénieur front-end
**JB**: Joris Bohren, gestion de projet, product owner

| Livrable                         | Durée |     Ressources      |
|:-------------------------------- |:----- |:-------------------:|
| Base de données                  | 60h   |       DM, SD        |
| Système de chat                  | 70h   |         DM          |
| Gestion des interactions backend | 70h   |         SD          |
| Rapports UX                      | 150h  | MR, CDF, CF, RL, NW |
| Charte & concept UI              | 48h   |       MR, CDF       |
| Intégration flux C3              | 29h   |       NW, RL        |
| Client chat                      | 45h   |         DM          |
| Interface interactions auditeurs | 85h   |       NW, RL        |
| Dashboard animateurs             | 158h  |       CF, DM        |
| Mise en production               | 108h  |        Tous         |
| Documentation                    | 102h  |       JB, MR        |
## Réseau d'activités
```mermaid
flowchart TD
	A[Début]-->D[Avant-Projet]
	D-->C[Récherches UX]
	D-->B[Spécification Back-end]
	G-->E[Dévelopement Back-end]
	G-->F[Conception graphique/UI]
	B & C-->G[Planification]
	F-->H[Dévelopement Front-end]
	G-->I[Suivi Réalisation]
	E & H --> J[Tests & Déploiement]
	I & J --> K[Clôture]
```
## [Gantt des livrables](planificationGantt.md)
(voir annexe)