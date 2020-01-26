
FROM php:7.4.2-apache

COPY . /app
COPY .docker/php/vhost.conf /etc/apache2/sites-available/000-default.conf
RUN apt-get update \
	&& apt-get install curl \
	&& docker-php-ext-install pdo pdo_mysql
RUN chown -R www-data:www-data /app \
	&& a2enmod rewrite && a2enmod ssl && echo "ServerName camagru.ga" >> /etc/apache2/apache2.conf && service apache2 restart
