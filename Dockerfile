FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libpq-dev zip unzip nodejs npm \
    && docker-php-ext-install pdo_pgsql

RUN a2enmod rewrite

ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

WORKDIR /var/www/html
COPY . .

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

RUN npm install && npm run build

RUN apt-get remove -y nodejs npm && apt-get autoremove -y

RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

RUN chmod -R 777 storage
RUN chmod -R 777 bootstrap/cache

# Exécute les migrations
RUN php artisan migrate --force

EXPOSE 80

CMD ["apache2-foreground"]