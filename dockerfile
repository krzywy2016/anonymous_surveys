# Użyj obrazu PHP 8.0 z obsługą Apache
FROM php:8.0-apache

# Skopiuj customowy plik konfiguracyjny Apache
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Instaluj zależności
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Włącz niektóre rozszerzenia PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath opcache

RUN docker-php-ext-install xml

# Ustaw katalog roboczy na /var/www/html
WORKDIR /var/www/html

# Włącz moduł rewrite dla Apache
RUN a2enmod rewrite

# Skopiuj pliki aplikacji do kontenera
COPY . .

# Instaluj Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instaluj zależności
RUN composer install

# Instaluj Node.js i npm
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get install -y nodejs

# Skonfiguruj środowisko
COPY .env.example .env
RUN php artisan key:generate

# Uruchom Apache
CMD ["apache2-foreground"]