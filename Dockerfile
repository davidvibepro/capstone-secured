FROM php:8.2-apache

RUN docker-php-ext-install pdo pdo_mysql

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

COPY . /var/www/html/

RUN a2enmod rewrite
RUN a2dismod mpm_event
RUN a2enmod mpm_prefork

EXPOSE 80
