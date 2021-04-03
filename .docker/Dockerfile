ARG PHP_VERSION=7.4
FROM php:${PHP_VERSION}-fpm

RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git \
    libcurl4-openssl-dev sqlite3 libsqlite3-dev \
    && docker-php-ext-install curl


ARG COMPOSER_VERSION=1.10.16
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer --version="${COMPOSER_VERSION}"

RUN usermod -u 1000 www-data

EXPOSE 9000

CMD ["php-fpm"]