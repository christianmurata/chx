FROM php:7.1.26-apache-stretch
LABEL maintainer 'Christian Murata <chris_murata@hotmail.com>'

RUN apt-get update && apt-get install -y wget \
		libfreetype6-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
        libcurl4-gnutls-dev \
	&& docker-php-ext-install -j$(nproc) iconv \
	&& docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
	&& docker-php-ext-install -j$(nproc) gd

RUN docker-php-ext-install pdo_mysql 

RUN pecl install redis-3.1.6 \
    && docker-php-ext-enable redis

RUN a2enmod rewrite

# Image directory
RUN mkdir -p /var/www/html/images
VOLUME /var/www/html/images

# Composer:
WORKDIR /var/www/html
RUN chown -R www-data /var/www
COPY composer-install.sh /tmp
RUN chmod 744 /tmp/composer-install.sh && /tmp/composer-install.sh && cp /usr/local/bin/composer.phar /usr/local/bin/composer

USER www-data
RUN composer self-update

# build composer vendor files

COPY composer.json /var/www/html/composer.json
RUN /usr/local/bin/composer install -o

USER root