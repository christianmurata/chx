FROM ubuntu:latest

MAINTAINER christian murata <chris_murata@hotmail.com>

RUN apt-get update

VOLUME /var/www/html

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get install net-tools

# instalando APACHE
RUN apt-get update
RUN apt-get install -y apache2

RUN apt-get install -y software-properties-common 
# RUN apt-get install -y software-properties-common python-software-properties

# locale 
RUN apt-get install -y language-pack-en
RUN apt-get update
RUN locale-gen en_US.UTF-8
RUN export LANG=en_US.UTF-8

RUN cp /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-available/000-default.conf.bk

# PHP 7.0
RUN LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/php
RUN apt-get update
RUN apt-get -y install \
 php7.0 php7.0-mysql php-redis libapache2-mod-php7.0 php7.0-curl lynx-common lynx

# Enable apache mods.
RUN a2enmod php7.0
RUN a2enmod rewrite

# Install composer
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

# Update the PHP.ini file, enable <? ?> tags and quieten logging.
RUN sed -i "s/short_open_tag = Off/short_open_tag = On/" /etc/php/7.0/apache2/php.ini
RUN sed -i "s/error_reporting = .*$/error_reporting = E_ERROR | E_WARNING | E_PARSE/" /etc/php/7.0/apache2/php.ini

# Manually set up the apache environment variables
ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2
ENV APACHE_PID_FILE /var/run/apache2.pid

# Expose apache.
EXPOSE 80

# By default start up apache in the foreground, override with /bin/bash for interative.
CMD /usr/sbin/apache2ctl -D FOREGROUND
