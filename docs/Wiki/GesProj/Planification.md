**Groupe** : super
**Membres** : BOHREN Joris, DA FONSECA Carina, DULEX Samuel, FORELICHER Cassandre, LONGO Rossiny, MENDES Daniel, REY Myriam, WUNDERLE Nicolas
**Classe** : M50-2
**Version** : 1
## Project Breakdown Structure
```mermaid
 graph TB

 A[Web App Project]
 
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
## Réseau d'activités
## Gantt des livrables
