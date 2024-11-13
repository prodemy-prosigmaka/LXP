FROM dunglas/frankenphp

RUN install-php-extensions pcntl gd intl zip opcache
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
COPY . /app

ENTRYPOINT ["php", "artisan", "octane:frankenphp"]
