FROM php:fpm-alpine
RUN apk --update --no-cache add git
COPY --from=composer /usr/bin/composer /usr/bin/composer
WORKDIR /srv/app
CMD composer install ; php-fpm
EXPOSE 9000
