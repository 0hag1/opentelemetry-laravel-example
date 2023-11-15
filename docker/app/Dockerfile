FROM php:8-apache-buster as builder

ENV COMPOSER_ALLOW_SUPERUSER=1 \
  COMPOSER_HOME=/composer
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN apt-get update && \
  DEBIAN_FRONTEND=noninteractive apt-get -y install git libicu-dev libonig-dev libzip-dev unzip locales libfreetype6-dev tzdata && \
  apt-get clean && \
  rm -rf /var/lib/apt/lists/* && \
  chmod +x /usr/local/bin/install-php-extensions && \
  install-php-extensions gd exif intl pdo_mysql sockets zip bcmath opcache opentelemetry-php/ext-opentelemetry@main && \
  a2enmod rewrite && \
  ln -sf  /usr/share/zoneinfo/Asia/Tokyo /etc/localtime && \
  locale-gen ja_JP.UTF-8 && \
  composer config -g process-timeout 3600 && \
  composer config -g repos.packagist composer https://packagist.org && \
  sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf && \
  sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

COPY ./docker/app/php.ini /usr/local/etc/php/php.ini
