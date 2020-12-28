ARG PHP_EXTENSIONS='intl'

FROM thecodingmachine/php:7.2-v3-apache

RUN a2enmod rewrite
ENV APACHE_RUN_USER=www-data \
    APACHE_RUN_GROUP=www-data \
    APACHE_DOCUMENT_ROOT=/var/www/html/sonda/ \
    ABSOLUTE_APACHE_DOCUMENT_ROOT=/var/www/html/sonda