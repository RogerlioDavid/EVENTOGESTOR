FROM php:8.1-apache

# Instalar dependencias para Laravel (extensiones, composer)
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql zip mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar proyecto
COPY . /var/www/html

# Copiar .env.example a .env si no existe (se hará en entrypoint)
# (No lo hacemos aquí para que pueda funcionar dinámicamente)

# Establecer permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# Configurar Apache para servir desde /public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Permitir acceso a /public y habilitar .htaccess
RUN echo "<Directory /var/www/html/public>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>" >> /etc/apache2/apache2.conf

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Instalar dependencias de Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Crear script de entrypoint para copiar .env y generar APP_KEY
RUN printf '#!/bin/bash\n\
if [ ! -f .env ]; then\n\
  cp .env.example .env\n\
fi\n\
if ! grep -q "^APP_KEY=" .env || grep -q "^APP_KEY=$" .env; then\n\
  php artisan key:generate\n\
fi\n\
exec "$@"\n' > /entrypoint.sh && chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]

EXPOSE 80

CMD ["apache2-foreground"]
