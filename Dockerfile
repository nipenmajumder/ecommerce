FROM php:8.2-fpm
MAINTAINER Nipen
ARG user
ARG uid
# Install Dependencies
RUN apt-get update && apt-get install -y git curl libpng-dev libonig-dev libxml2-dev zip unzip

RUN apt-get install -y wget dpkg fontconfig libfreetype6 libjpeg62-turbo libxrender1 xfonts-75dpi xfonts-base mariadb-client

RUN wget http://archive.ubuntu.com/ubuntu/pool/main/o/openssl/libssl1.1_1.1.1f-1ubuntu2_amd64.deb

RUN wget https://github.com/wkhtmltopdf/packaging/releases/download/0.12.6-1/wkhtmltox_0.12.6-1.buster_amd64.deb
RUN dpkg -i libssl1.1_1.1.1f-1ubuntu2_amd64.deb

#install some base extensions
RUN apt-get install -y \
        libzip-dev \
        zip \
        zlib1g-dev\
  && docker-php-ext-install zip \
  && docker-php-ext-install gd
# Clear Cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql intl mbstring exif pcntl bcmath gd

#Install Node Js and Npm
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -

RUN apt-get install -y nodejs

RUN apt-get install -y npm

# Install Cron
RUN apt-get install -y cron vim

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY .docker/app/php-fpm.ini /usr/local/etc/php/conf.d/php-fpm.ini
# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# wkhtmltopdf install
RUN dpkg -i wkhtmltox_0.12.6-1.buster_amd64.deb
RUN apt-get install --fix-broken

# Set working directory
WORKDIR /var/www
RUN chown -R www-data:www-data /var/www
USER $user
