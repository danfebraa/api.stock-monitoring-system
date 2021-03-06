FROM nginx:stable-alpine

ADD nginx/nginx.conf /etc/nginx/nginx.conf
ADD nginx/default.conf /etc/nginx/conf.d/default.conf

RUN mkdir -p /var/www/html

RUN addgroup -g 1000 danfebraa && adduser -G danfebraa -g danfebraa -s /bin/sh -D danfebraa

RUN chown danfebraa:danfebraa /var/www/html