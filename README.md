## Table of Contents
1. [General Info](#general-info)
2. [Technologies](#technologies)
3. [Installation](#installation)
4. [Ameliorations](#ameliorations)
### General Info
***
You'Nivers - Test technique / site vitrine 

## Technologies
***
A list of technologies used within the project:
* Symfony : Version 6.2.9
* PHP : Version 8.2
* Composer
* Yarn
* Node

## Installation
***
Voici les étapes à suivre pour l'installation du projet
```
$ git clone https://github.com/QuentinSP/test_younivers.git
$ cd vitrine
$ composer install
$ npm install
$ yarn install
$ php bin/console doctrine:migrations:migrate
$ symfony server:start
$ yarn encore dev --watch
```

Voulant profiter au maximum de l'environnement Symfony, j'ai utilisé <b>webpack-encore</b> pour la gestion des assets (CSS, JS, images).
J'ai donc modifié certaines parties du template d'origine afin de coller avec l'architecture de mes fichiers.
Il est donc nécessaire de bien utiliser <b>yarn encore dev --watch</b>.

Je reste évidemment à votre disposition en cas de problèmes.

## Ameliorations
***

. J'aurais aimé encore approfondir les formulaires de personnalisation de template. (pouvoir agir sur plus de secteurs et rendre ça encore plus dynamique)