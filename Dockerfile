FROM php:7.2-apache

LABEL MAINTAINER="Luqman Setyo N <luqmansen@gmail.com>"

RUN apt-get update \
    && apt-get install -y \
        libzip-dev \
        zip \
  && docker-php-ext-configure zip --with-libzip \
  && docker-php-ext-install zip \
  &&  docker-php-ext-install mysqli

RUN a2enmod rewrite

COPY . /app

RUN chown www-data:www-data /app/*

RUN ln -s /app /var/www/html

CMD ["apache2-foreground"]


