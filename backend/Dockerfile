FROM php:8.2-apache

USER root

WORKDIR /var/www/html

RUN mkdir public && echo "Hello" > /var/www/html/public/index.php
RUN echo "Listen 9000" > /etc/apache2/ports.conf
COPY ./config/apache2/000-default.conf /etc/apache2/sites-available/

RUN a2enmod rewrite
RUN service apache2 restart

RUN apt-get update && apt-get install -y \
      apt-utils unzip zip git zlib1g-dev libzip-dev supervisor libicu-dev openssl libssh-dev libcurl4-gnutls-dev \
      curl libfreetype6-dev libjpeg62-turbo-dev libpng-dev libmagickwand-dev p7zip p7zip-full \
      && docker-php-ext-install zip \
      && pecl install imagick && docker-php-ext-enable imagick \
      && pecl install redis && docker-php-ext-enable redis \
      && docker-php-ext-install -j$(nproc) intl \
      && docker-php-ext-install mysqli \
      && docker-php-ext-install pdo pdo_mysql \
      && docker-php-ext-install pcntl \
      && docker-php-ext-install curl \
      && docker-php-ext-install gd \
      && apt-get clean \
      && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

#Install composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin

COPY php.ini /usr/local/etc/php/conf.d/php.ini

COPY --chown=www-data:www-data start.sh /usr/local/bin/start
COPY --chown=www-data:www-data composer.json /var/www/html/composer.json
COPY --chown=www-data:www-data . /var/www/html

#RUN composer self-update --2
#RUN composer install --no-dev

RUN chown -R www-data:www-data /var/www/html

RUN chmod -R 777 storage && chmod -R 777 bootstrap/cache && chmod u+x /usr/local/bin/start

CMD ["/usr/local/bin/start"]

