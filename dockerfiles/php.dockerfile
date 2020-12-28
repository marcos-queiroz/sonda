FROM php:7.4-apache

RUN apt-get update
RUN apt-get upgrade -y

RUN apt-get install --fix-missing -y libpq-dev
RUN apt-get install --no-install-recommends -y libpq-dev
RUN apt-get install -y libxml2-dev libbz2-dev zlib1g-dev
RUN apt-get -y install curl exif ftp
RUN docker-php-ext-install intl
RUN apt-get -y install --fix-missing zip unzip
RUN apt-get -y install --fix-missing git

RUN a2enmod rewrite

EXPOSE 80

RUN chown www-data:www-data /var/www/html/sonda/writable
RUN chmod 775 -R /var/www/html/sonda/writable