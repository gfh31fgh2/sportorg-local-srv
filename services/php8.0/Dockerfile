FROM php:8.1-fpm
MAINTAINER Emil B

ARG uname
ARG gid
ARG uid

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

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host = host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini 

RUN mkdir /var/log/xdebug

RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/

RUN docker-php-ext-install -j$(nproc) gd

RUN docker-php-ext-configure intl && docker-php-ext-install intl 

ADD ./php.ini /usr/local/etc/php/php.ini

RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql pgsql mbstring exif pcntl bcmath gd sockets zip mysqli

# LDAP
# RUN apt-get install -y libldap2-dev \
#     && docker-php-ext-configure ldap \
#     --with-libdir=lib/$(uname -m)-linux-gnu \
#     && docker-php-ext-install ldap

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN groupadd --gid $gid $uname
RUN useradd -G www-data,root -s /bin/bash --uid $uid --gid $gid $uname
RUN mkdir -p /home/$uname/.composer
RUN chown -R $uname:$uname /home/$uname
RUN groupadd docker
RUN usermod -a -G docker $uname

WORKDIR /var/www

USER $uname

# Expose port 9000 and start php-fpm server
#EXPOSE 9000

CMD ["php-fpm"]