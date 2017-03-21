FROM phalconphp/php-fpm:7-min
RUN mkdir -p /var/cache/apt/archives/partial /var/log/apt \
    && touch /var/cache/apt/archives/lock \
    && chmod 640 /var/cache/apt/archives/lock \
    && apt update && apt-get install -y --no-install-recommends libpq-dev \
    && docker-php-ext-install mysqli pdo_pgsql pdo_mysql