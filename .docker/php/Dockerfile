FROM php:7.4.2-apache

COPY . /app
COPY .docker/php/nicolasvienot.ga.conf /etc/apache2/sites-available/
WORKDIR /app
RUN apt-get update \
	&& apt-get install apt-utils -y \
	&& docker-php-ext-install pdo pdo_mysql \
	&& ln -s /etc/apache2/mods-available/headers.load /etc/apache2/mods-enabled/headers.load \
	&& chown -R www-data:www-data /app \
	&& chmod -R g+rw /app \
	&& a2enmod rewrite \
	&& echo "ServerName nicolasvienot.ga" >> /etc/apache2/apache2.conf \
	&& service apache2 restart \
	&& a2dissite 000-default.conf \
	&& a2ensite nicolasvienot.ga.conf \
	&& service apache2 restart \
	&& apt-get install python-certbot-apache -y 

CMD certbot --apache --noninteractive --agree-tos --redirect -m nvienot@gmail.com -d nicolasvienot.ga && apachectl stop && apachectl -D FOREGROUND