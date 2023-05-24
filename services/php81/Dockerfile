FROM php:8.1-fpm
MAINTAINER Emil B

RUN apt-get update \
    && apt-get install -y \
        apt-utils \
        net-tools \
        nano \
        git \
        curl \
        dpkg-dev \
        libpng-dev \
        libjpeg-dev \
        libonig-dev \
        libxml2-dev \
        libpq-dev \
        netcat \
        libwebp-dev \
        libjpeg62-turbo-dev \
        libgd-dev \
        libxpm-dev \
        libfreetype6-dev \
        zip \
        unzip \
        ruby-sass \
        nodejs \
        cron \
        libzip-dev

ADD ./php.ini /usr/local/etc/php/php.ini

RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql pgsql mbstring exif pcntl bcmath gd sockets zip mysqli

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN groupadd --gid 1000 dev
RUN useradd -G www-data,root -s /bin/bash --uid 1000 --gid 1000 dev
RUN mkdir -p /home/dev/.composer
RUN chown -R dev:dev /home/$uname
RUN groupadd docker
RUN usermod -a -G docker dev

WORKDIR /var/www

USER dev

CMD ["php-fpm"]
