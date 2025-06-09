#!/usr/bin/env bash
set -e

echo "🔧 Ejecutando build.sh en Render..."

composer install --no-dev --optimize-autoloader

php artisan config:cache
php artisan route:cache
php artisan view:cache

php artisan storage:link || true
php artisan migrate --force

chmod -R 775 storage bootstrap/cache

echo "✅ Build completado correctamente."
