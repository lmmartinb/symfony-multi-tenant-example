FROM php:8.1-fpm-alpine

ENV TZ=Europe/Madrid

RUN apk add --update linux-headers; \
    apk add --no-cache $PHPSIZE_DEPS \
        zlib-dev \
        jpeg-dev \
        libpng-dev \
        libzip-dev \
        autoconf \
        mysql-client \
        rabbitmq-c-dev \
        gcc \
        make \
        g++ \
        git \
        supervisor \
        icu-dev \
        bash \
        tzdata \
    ; \
    docker-php-ext-configure \
        gd --with-jpeg \
        intl \
    ; \
    docker-php-ext-install \
        gd \
        zip \
        mysqli \
        pdo_mysql \
        intl \
    ; \
    pecl install amqp-1.11.0; \
    pecl install apcu-5.1.22; \
    pecl install xdebug-3.2.1; \
    docker-php-ext-enable amqp apcu xdebug \
    ; \
    cp /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone ; \
    apk del $PHPSIZE_DEPS \
    ; \
    rm -rf /tmp/pear \
    ;

COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

COPY docker/php/conf/ /usr/local/etc/php/

WORKDIR /app