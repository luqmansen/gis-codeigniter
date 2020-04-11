FROM php:7.2-apache


LABEL MAINTAINER="Luqman Setyo N <luqmansen@gmail.com>"


RUN docker-php-ext-install mysqli

RUN a2enmod rewrite

COPY . /app

RUN chown www-data:www-data /app/*

RUN ln -s /app /var/www/html

CMD ["apache2-foreground"]


