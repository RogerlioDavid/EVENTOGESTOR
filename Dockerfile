FROM php:8.2-apache

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    libzip-dev unzip curl git \
    && docker-php-ext-install pdo pdo_mysql zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar los archivos del proyecto
COPY . /var/www/html

# Establecer permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Instalar dependencias de Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Generar APP_KEY si no existe
RUN echo '#!/bin/bash\\n'\\
'if ! grep -q "APP_KEY=" .env || grep -q "APP_KEY=$" .env; then\\n'\\
'  php artisan key:generate\\n'\\
'fi\\n' > /entrypoint.sh && chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]

# Configurar Apache para servir desde /public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Permitir acceso a /public
RUN echo "<Directory /var/www/html/public>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>" >> /etc/apache2/apache2.conf

EXPOSE 80
CMD ["apache2-foreground"]


