FROM webdevops/php-apache

RUN apt-get update
RUN apt-get install software-properties-common -y
RUN add-apt-repository universe
RUN add-apt-repository ppa:certbot/certbot
RUN apt-get update
RUN apt-get install certbot python3-certbot-apache -y
