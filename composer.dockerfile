FROM composer:2

RUN addgroup -g 1000 danfebraa && adduser -G danfebraa -g danfebraa -s /bin/sh -D danfebraa

WORKDIR /var/www/html
