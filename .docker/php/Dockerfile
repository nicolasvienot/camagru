FROM php:7-apache

COPY . /app
COPY .docker/php/nicolasvienot.cf.conf /etc/apache2/sites-available/
WORKDIR /app

RUN apt-get update -y && apt-get install -y libwebp-dev libjpeg62-turbo-dev libpng-dev libxpm-dev \
    libfreetype6-dev
RUN apt-get update && \
    apt-get install -y \
        zlib1g-dev  

RUN apt-get install -y libzip-dev
RUN docker-php-ext-install zip

RUN docker-php-ext-configure gd --with-jpeg=/usr/include/ --with-freetype=/usr/include/

RUN docker-php-ext-install gd

RUN apt-get update \
	&& apt-get install apt-utils -y \
	&& docker-php-ext-install pdo pdo_mysql \
	&& ln -s /etc/apache2/mods-available/headers.load /etc/apache2/mods-enabled/headers.load \
	&& chown -R www-data:www-data /app \
	&& chmod -R g+rw /app \
	&& a2enmod rewrite \
	&& echo "ServerName nicolasvienot.cfa" >> /etc/apache2/apache2.conf \
	&& service apache2 restart \
	&& a2dissite 000-default.conf \
	&& a2ensite nicolasvienot.cf.conf \
	&& service apache2 restart \
	&& apt-get install python-certbot-apache -y  

CMD certbot --apache --noninteractive --agree-tos --redirect -m nvienot@gmail.com -d nicolasvienot.cf && sleep 10 && apachectl stop && apachectl -D FOREGROUND
