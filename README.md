AutoEntGes
========================

[![Build Status](https://travis-ci.org/lasdou/AutoEntGes.svg?branch=master)](https://travis-ci.org/lasdou/AutoEntGes)

qu'est ce que c'est ?
--------------

Il s'agit d'un outil permettant la gestion simple d'une auto-entreprise

  * Catalogue produits/services

  * Fichier Client

  * Création et envoi de Devis

  * Facturation

  * Bilan trismestriel URSSAF

Ce projet est dévelloppé sur le socle Symfony 3

Pour l'installer sur un serveur WEB, télécharger les sources et exécuter la ligne de commande suivante

`composer install`

puis 

`php bin/console doctrine:migrations:migrate`

suivez ce lien Si vous n'avez pas encore composer : https://getcomposer.org/download/

Pour créer un compte utilisateur "super admin" il faut exécuter la ligne de commande suivante :

`php bin/console fos:user:create adminuser --super-admin`
