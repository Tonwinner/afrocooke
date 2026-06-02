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

# Active le module mod_rewrite pour les routes Laravel
RUN a2enmod rewrite

# Configure le répertoire de travail
WORKDIR /var/www/html

# Copie le code source dans le conteneur
COPY . .

# 🔧 CORRECTION : Configure Apache pour utiliser le dossier public/
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/apache2.conf

# Télécharge et installe Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Donne les droits d'écriture à Apache sur les dossiers storage et cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Installe les dépendances PHP (sauf celles de développement)
RUN composer install --no-dev --optimize-autoloader

# Installe les dépendances Node.js et compile les assets
RUN npm install && npm run build

# Nettoyage pour réduire la taille de l'image
RUN apt-get remove -y nodejs npm && apt-get autoremove -y

# Expose le port 80
EXPOSE 80