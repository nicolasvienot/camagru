
FROM php:7.4.2-apache

COPY . /app
COPY .docker/php/camagru.ga.conf /etc/apache2/sites-available/
RUN apt-get update \
	&& docker-php-ext-install pdo pdo_mysql
RUN chown -R www-data:www-data /app \
	&& chmod -R g+rw /app && a2enmod rewrite && echo "ServerName nicolasvienot.tk" >> /etc/apache2/apache2.conf && service apache2 restart && a2dissite 000-default.conf && a2ensite nicolasvienot.tk.conf && service apache2 restart
RUN apt-get install python-certbot-apache -y 
# && certbot --apache --noninteractive --agree-tos --redirect -m nvienot@gmail.com -d nicolasvienot.tk -d www.nicolasvienot.tk