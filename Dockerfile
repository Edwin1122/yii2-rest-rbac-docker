FROM php:7.2-fpm-alpine
COPY ./config/php.ini $PHP_INI_DIR/
RUN apk --no-cache add pcre-dev ${PHPIZE_DEPS} \
&& docker-php-ext-install pdo pdo_mysql \
&& pecl install xdebug-2.8.1 \
&& docker-php-ext-enable xdebug \
&& apk del pcre-dev ${PHPIZE_DEPS}