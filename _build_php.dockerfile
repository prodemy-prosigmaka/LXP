FROM php:8.2-fpm

RUN apt-get update && apt-get install -y  \
    libfreetype6-dev \
    libjpeg-dev \
    libpng-dev \
    libwebp-dev \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    --no-install-recommends \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install mbstring exif pcntl bcmath -j$(nproc) gd

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

COPY . /usr/src/app
WORKDIR /usr/src/app

CMD ["composer", "install"]
