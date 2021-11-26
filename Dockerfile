FROM php:7

WORKDIR /var/www

ENV COMPOSER_ALLOW_SUPERUSER=1

ADD . /var/www

RUN apt-get update
RUN apt-get install curl unzip git -y
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN composer install

#nodejs to development
RUN apt-get install -y build-essential
RUN curl -sL https://deb.nodesource.com/setup_10.x | bash -
RUN apt-get install -y nodejs
RUN npm i
