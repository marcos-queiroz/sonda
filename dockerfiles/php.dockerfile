FROM php:7.4-apache

RUN apt-get update
RUN apt-get upgrade -y

RUN apt-get install --fix-missing -y libpq-dev
RUN apt-get install --no-install-recommends -y libpq-dev
RUN apt-get install -y libxml2-dev libbz2-dev zlib1g-dev
RUN apt-get -y install libsqlite3-dev libsqlite3-0 mariadb-client curl exif ftp
RUN docker-php-ext-install intl
RUN apt-get -y install --fix-missing zip unzip
RUN apt-get -y install --fix-missing git

RUN a2enmod rewrite

EXPOSE 80

ENV APACHE_RUN_USER=www-data \
    APACHE_RUN_GROUP=www-data \
    APACHE_DOCUMENT_ROOT=/var/www/html/sonda/ \
    ABSOLUTE_APACHE_DOCUMENT_ROOT=/var/www/html/sonda\
    PHP_INI_UPLOAD_MAX_FILESIZE=10M\
    PHP_INI_POST_MAX_SIZE=10M\