
FROM php:7.4.2-apache

COPY . /app
COPY .docker/php/nicolasvienot.cf.conf /etc/apache2/sites-available/
RUN apt-get update \
	&& apt-get install apt-utils -y \
	&& docker-php-ext-install pdo pdo_mysql \
	&& ln -s /etc/apache2/mods-available/headers.load /etc/apache2/mods-enabled/headers.load \
	&& chown -R www-data:www-data /app \
	&& chmod -R g+rw /app \
	&& a2enmod rewrite \
	&& echo "ServerName nicolasvienot.cf" >> /etc/apache2/apache2.conf \
	&& service apache2 restart \
	&& a2dissite 000-default.conf \
	&& a2ensite nicolasvienot.cf.conf \
	&& service apache2 restart \
	&& apt-get install python-certbot-apache -y 

CMD certbot --apache --noninteractive --expand --agree-tos --redirect -m nvienot@gmail.com -d nicolasvienot.cf && /usr/sbin/apache2ctl -D FOREGROUND

# ADD .docker/php/letsencrypt.sh /usr/local/bin/letsencrypt.sh
# RUN chmod +x /usr/local/bin/letsencrypt.sh
# CMD /usr/local/bin/letsencrypt.sh