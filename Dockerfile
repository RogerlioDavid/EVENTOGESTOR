FROM php:8.3-apache

# Instalar extensiones necesarias de PHP para Laravel
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql zip mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar el proyecto al contenedor
COPY . /var/www/html

# Establecer permisos adecuados
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Habilitar mod_rewrite en Apache
RUN a2enmod rewrite

# Configurar Apache para servir desde /public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Permitir .htaccess y acceso a /public
RUN echo "<Directory /var/www/html/public>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>" >> /etc/apache2/apache2.conf

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Instalar dependencias de Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Crear script de arranque que copia .env y genera APP_KEY si hace falta
RUN printf '#!/bin/bash\n\
if [ ! -f .env ]; then\n\
  cp .env.example .env\n\
fi\n\
if ! grep -q "^APP_KEY=" .env || grep -q "^APP_KEY=$" .env; then\n\
  php artisan key:generate\n\
fi\n\
exec "$@"\n' > /entrypoint.sh \
    && chmod +x /entrypoint.sh

# Definir entrypoint y comando de arranque
ENTRYPOINT ["/entrypoint.sh"]
CMD ["apache2-foreground"]

# Exponer el puerto 80
EXPOSE 80
