## Table of Contents
1. [General Info](#general-info)
2. [Technologies](#technologies)
3. [Installation](#installation)
4. [Ameliorations](#ameliorations)
### General Info
***
You'Nivers - Test technique / site vitrine 

Les rôles : <br>
    . Un client ne peut pas accéder au back.<br>
    . Un admin peut accéder au back pour la gestion de contenu.<br>
    . Un super admin peut, en plus, gérer les utilisateurs.

Une fois un utilisateur créer, le super admin peut lui attribuer un rôle.

La méthode apiContent() retourne la liste des contenus pour un user avec cette route : /api/posts/{id}

La BDD se nomme vitrine
## Technologies
***
A list of technologies used within the project:
* Symfony : Version 6.2.9
* PHP : Version 8.2
* Composer
* Yarn
* MYSQL

## Installation
***
Voici les étapes à suivre pour l'installation du projet
```
$ git clone https://github.com/QuentinSP/test_younivers.git
$ cd test_younivers
$ composer install
$ yarn install
$ php bin/console doctrine:migrations:migrate
$ symfony server:start
$ yarn encore dev
```

Voulant profiter au maximum de l'environnement Symfony, j'ai utilisé <b>webpack-encore</b> pour la gestion des assets (CSS, JS, images).
J'ai donc modifié certaines parties du template d'origine afin de coller avec l'architecture de mes fichiers.

Après les premières images mise en ligne, lancez : <b>$ yarn encore dev --watch</b>
Cela permettra de mettre à jour automatiquement les futures images.
<br>
<br>
Je reste évidemment à votre disposition en cas de problèmes.

## Ameliorations
***

. Approfondir les formulaires de personnalisation de template. (pouvoir agir sur plus de secteurs et rendre ça encore plus dynamique) <BR>
. Cacher les infos du .env <br>
. Ranger un peu mon arborescence