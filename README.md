# TestSoshop

Bonjour, tout d'abord merci de bien cloner le projet sur votre machine :
 - avec HTTPS :
   - https://github.com/gabrielchirouse/TestSoshop.git
 - avec SSH :
   - git@github.com:gabrielchirouse/TestSoshop.git
    
Une fois cette manipulation effectué, il faut lancé le docker :

```
docker-compose up --build
```
Attention les noms des container sont les suivants : 
- api-mariadb: port 3306
- api-soshop: port 8888

Pour accèder au container de l'api afin de finir la mise en place de symfony :
```
docker-compose exec api-soshop bash
```

**!! Attention pour executer les commandes qui vont suivre il faut être dans le bash du container api-soshop !!**

Executez la commande pour installer tout les bundles :

```
composer install
```
les dossiers var et vendor sont présents, il faut mettre en place la base de données :
```
bin/console doctrine:database:create (si la base de données n'est pas présente)
bin/console doctrine:migration:migrate
```
la migration est effectuée, il faut ajouté les données situées dans le dossier "sql data" (data.sql).

Vous pouvez désormais accéder au différentes routes :

| Objectif                     | Routes                   | Method |
|------------------------------|--------------------------|--------|
| Créer un utilisateur         | /users                   | POST   |
| Lire un utilisateur          | /users/{id}              | GET    |
| Modifier un utilisateur      | /users/{id}              | PUT    |
| Supprimer un utilisateur     | /users/{id}              | DELETE |
| Créer un compte bancaire     | /users/{id}/accountBanks | POST   |
| Lire un compte bancaire      | /accountBanks/{id}       | GET    |
| Modifier un compte bancaire  | /accountBanks/{id}       | PUT    |
| Supprimer un compte bancaire | /accountBanks/{id}       | DELETE |
| Export en CSV                | /accountBanks/{id}/csv   | GET    |



