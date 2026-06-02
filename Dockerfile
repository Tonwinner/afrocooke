# Utilise l'image officielle PHP avec Apache pour Laravel
FROM php:8.2-apache

# Installe les extensions nécessaires (PostgreSQL, etc.)
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    nodejs \
    npm \
    && docker-php-ext-install pdo_pgsql

# Active le module mod_rewrite
RUN a2enmod rewrite

# Configure Apache pour utiliser le dossier public de Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Configure le répertoire de travail
WORKDIR /var/www/html

# Copie le code source
COPY . .

# Installe Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Donne les droits d'écriture
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Installe les dépendances PHP
RUN composer install --no-dev --optimize-autoloader

# Installe les dépendances Node.js et compile
RUN npm install && npm run build

# Nettoie les outils inutiles
RUN apt-get remove -y nodejs npm && apt-get autoremove -y

RUN php artisan config:clear
RUN php artisan cache:clear
RUN php artisan view:clear

RUN touch storage/logs/laravel.log
RUN chmod -R 777 storage
RUN chmod -R 777 bootstrap/cache

EXPOSE 80

# Expose le port 80
EXPOSE 80


CMD ["apache2-foreground"]