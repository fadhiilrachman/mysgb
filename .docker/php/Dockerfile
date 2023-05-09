FROM php:8.1.10-fpm-bullseye
RUN sed -i 's/9000/3004/' /usr/local/etc/php-fpm.d/zz-docker.conf

RUN apt-get update && apt-get install -y \
    libpq-dev libicu-dev libonig-dev \
    libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
    ldap-utils libldap2-dev \
    zlib1g-dev libzip-dev \
    npm nano git cron curl \
    libmagickwand-dev --no-install-recommends \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ \
    && docker-php-ext-install pdo pdo_pgsql pgsql pcntl zip bcmath exif xml intl \
    -j$(nproc) gd \
    && docker-php-ext-install ldap \
    && pecl install imagick \
	&& docker-php-ext-enable intl imagick ldap \
    && pecl -v install redis && docker-php-ext-enable redis

RUN docker-php-ext-install mbstring gd
RUN addgroup --gid 1001 nobody

COPY ./.docker/php/php.ini /usr/local/etc/php/conf.d/php.ini

ADD ./.docker/worker /etc/supervisor/conf.d

WORKDIR /var/www
USER nobody
