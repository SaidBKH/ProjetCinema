
#On précise l’image apache que l’on utilise
FROM php:8.2-apache

# On met le système à jour au moment du démarrage du conteneur
RUN apt-get update && apt-get upgrade -y

#On précise les extensions php à installer/activer (ici afin du pouvoir utiliser pdo)
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli pdo_mysql 


#On précise le port de base d’apache
EXPOSE 80

