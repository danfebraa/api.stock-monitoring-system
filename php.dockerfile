FROM php:8.0-fpm-alpine

ADD php/www.conf /usr/local/etc/php-fpm.d/www.conf

RUN addgroup -g 1000 danfebraa && adduser -G danfebraa -g danfebraa -s /bin/sh -D danfebraa

RUN mkdir -p /var/www/html

RUN chown danfebraa:danfebraa /var/www/html

WORKDIR /var/www/html

RUN docker-php-ext-install pdo pdo_mysql
