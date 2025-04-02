FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip unzip git && \
    docker-php-ext-install \
    pdo_mysql bcmath zip && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin

WORKDIR /var/www

ARG UID=1000
ARG GID=1000

RUN groupadd -g ${GID} developers && \
    useradd -m -u ${UID} -g developers developer

USER ${UID}:${GID}

