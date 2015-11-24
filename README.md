#Interface Utilisateur Centre Hospitalier / IUCH


##Objectifs

IUCH est une application visant à simplifier la gestion des arrivées/départs du personnel en centre hospitalier.


##Installation

#####Requis: 

* [Installer composer](https://getcomposer.org/download/)

#####Installer le projet

``` shell
$ git clone https://github.com/WildCodeSchool/projet-intranet_hopital.git
$ cd projet-intranet_hopital
$ composer install
$ bash bash/chmod.sh
$ php app/console doctrine:database:create
$ php app/console doctrine:schema:update --force
$ php app/console doctrine:fixtures:load
```

#####Lancer les test

``` shell
$ phpunit -c app
```


Si vous utilisez le projet en local, pensez à donner les droits à Apache sur le dossier app.
Sur Mac OS (config par défaut):
`sudo chown _www app/uploads`

Sur Linux :
`sudo chown www-data app/uploads`