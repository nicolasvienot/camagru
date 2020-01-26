
FROM php:7.4.2-apache

COPY . /app
COPY .docker/php/vhost.conf /etc/apache2/sites-available/000-default.conf
RUN apt-get update \
	&& docker-php-ext-install pdo pdo_mysql && a2ensite vhost.conf
RUN chown -R www-data:www-data /app \
	&& a2enmod rewrite && echo "ServerName camagru.ga" >> /etc/apache2/apache2.conf && service apache2 restart
RUN apt-get install python-certbot-apache -y 
# && certbot --apache --noninteractive --agree-tos --redirect -m nvienot@gmail.com -d camagru.ga -d www.camagru.ga