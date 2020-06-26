FROM webdevops/php-apache-dev

RUN apt-get update -y 
RUN apt-get install postfix mailutils libsasl2-2 ca-certificates libsasl2-modules -y

COPY .docker/php-apache-mail/postfix/main.cf /tmp/
RUN cat /tmp/main.cf >> /etc/postfix/main.cf && rm -f /tmp/main.cf

COPY .docker/php-apache-mail/postfix/sasl_passwd /etc/postfix/

RUN chmod 400 /etc/postfix/sasl_passwd
RUN postmap /etc/postfix/sasl_passwd

RUN cat /etc/ssl/certs/thawte_Primary_Root_CA.pem | sudo tee -a /etc/postfix/cacert.pem
RUN /etc/init.d/postfix reload
