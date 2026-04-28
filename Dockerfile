FROM ubuntu:22.04

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y \
    apache2 \
    php8.1 \
    php8.1-cli \
    php8.1-fpm \
    libapache2-mod-php8.1 \
    php8.1-mysql \
    php8.1-mbstring \
    php8.1-xml \
    php8.1-zip \
    php8.1-gd \
    php8.1-curl \
    php8.1-bcmath \
    php8.1-intl \
    curl zip unzip git \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN a2enmod rewrite php8.1
RUN echo 'memory_limit=512M' >> /etc/php/8.1/apache2/php.ini
RUN a2dissite 000-default

RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>' > /etc/apache2/sites-available/laravel.conf

RUN a2ensite laravel

WORKDIR /var/www/html
COPY . .
RUN rm -f Procfile

RUN composer install --no-dev --optimize-autoloader --no-interaction --ignore-platform-reqs

RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

EXPOSE 80

CMD bash -c "sed -i 's/80/${PORT:-80}/g' /etc/apache2/sites-available/laravel.conf /etc/apache2/ports.conf && apache2ctl -D FOREGROUND"
