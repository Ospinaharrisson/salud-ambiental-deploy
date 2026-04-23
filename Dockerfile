FROM php:8.0-apache

# Dependencias del sistema
 RUN apt-get update && apt-get install -y \
 libpng-dev libonig-dev libxml2-dev libzip-dev \
 zip unzip git curl \
 && rm -rf /var/lib/apt/lists/*

# Extensiones PHP para Laravel
 RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Habilitar mod_rewrite
 RUN a2enmod rewrite

# Apuntar Apache a /public
 ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
 RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
 RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Instalar Composer
 COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copiar proyecto
 COPY . .

# Instalar dependencias Laravel
 RUN composer install --no-dev --optimize-autoloader --no-interaction

# Permisos
 RUN chown -R www-data:www-data storage bootstrap/cache
 RUN chmod -R 775 storage bootstrap/cache

EXPOSE 80

CMD ["apache2-foreground"]
