FROM php:8.2.14-cli

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
COPY --chown=nobody:nobody ./ /var/www

WORKDIR /var/www
USER nobody

COPY --chown=nobody:nobody ./.docker/worker/entrypoint.sh /opt/bin/entrypoint.sh
RUN chmod +x /opt/bin/entrypoint.sh

CMD ["/opt/bin/entrypoint.sh"]
