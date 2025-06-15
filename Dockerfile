# On part de l'image officielle WordPress + Apache + PHP 8.2
FROM wordpress:6.4-php8.2-apache

# Copie ton dossier wp-content (thèmes / plugins / uploads) dans le conteneur
COPY wp-content /var/www/html/wp-content

# Expose le port HTTP
EXPOSE 80