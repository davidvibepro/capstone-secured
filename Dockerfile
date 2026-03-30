FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    && docker-php-ext-install pdo pdo_mysql

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

RUN a2dismod mpm_event mpm_worker || true
RUN a2enmod mpm_prefork

COPY . /var/www/html/

RUN a2enmod rewrite

EXPOSE 80
