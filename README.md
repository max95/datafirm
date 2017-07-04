# DATAFIRM

## OBJECTIF
La solution propose une sélection graphique et vaste en positionnant directement les entreprises sur une carte. Cela permet par exemple de chercher les entreprises par rapport, non plus à une ville, mais par rapport à une station de métro ou tout autre point paraissant stratégique sur la carte.
A terme le projet permettra à un utilisateur de rechercher des informations sur les entreprises recensées dans la base de données SIREN fournie sur le site « DataGouv.fr », et de filtrer selon un ou plusieurs critères.

## LE PROJET
Le projet traitera :
- D’une base de données comportant plusieurs millions de lignes
- De l’API de Google pour une restitution graphique des positions géographiques
- Du site internet « responsive » permettant la consultation de ces données

## SOURCES
Pour arriver à ce résultat,sera utilisé des données parmi les 25 000 jeux de données mis à disposition par data.gouv.fr, comme la table SIRENE regroupant l’intégralité des entreprises et établissement (soit 10 millions de lignes) et la table BAN (Base des Adresses Nationales) pour obtenir les coordonnées GPS de chaque adresse postale française.
Afin de rester dans l’esprit de data.gouv.fr, un maximum des services utilisés aura une licence Open Source. Une exception sera faite pour l’API de Google Map.

### BAN
La Base Adresse Nationale est une base de données qui a pour but de référencer l'intégralité des adresses du territoire français.

Elle contient la position géographique de plus de 25 millions d'adresses.

Elle est constituée par la collaboration entre:

- des acteurs nationaux tels que l'IGN, La Poste et La Poste,
- des acteurs locaux tels que les collectivités, les communes, les SDIS,
- des citoyens par exemple à travers le projet OpenStreetMap et l'association OpenStreetMap France. (source : data.gouv.Fr)

### Base Sirene des entreprises et de leurs établissements (SIREN, SIRET)
Ce jeu de données permet d'accéder aux 9 millions d'entreprises et 10 millions d'établissements actifs du répertoire Sirene de l'Insee qui enregistre quotidiennement leur état civil :

- quelle que soit leur forme juridique ;
- quel que soit leur secteur d'activité (industriels, commerçants, artisans, professions libérales, agriculteurs, collectivités territoriales, banques, assurances, associations...) ;
- situés en France métropolitaine, ainsi qu'en Guadeloupe, Martinique, Guyane, La Réunion, Mayotte, Saint-Barthélémy, Saint-Martin et Saint-Pierre-et-Miquelon. Les organismes publics ou privés et les entreprises étrangères qui ont une représentation ou une activité en France y sont également répertoriés.

Le répertoire Sirene est ainsi la principale source exhaustive sur l'ensemble des entreprises et des établissements actifs. (source : data.gouv.fr)
