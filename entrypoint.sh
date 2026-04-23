#!/bin/bash
set -e

echo "🚀 Iniciando Laravel en Render..."

# Limpiar cachés previos
php artisan config:clear || true
php artisan cache:clear || true
php artisan view:clear || true

# Ejecutar migraciones (si hay DB configurada)
php artisan migrate --force || echo "⚠️ Migraciones fallaron o no configuradas"

# Crear enlace simbólico de storage
php artisan storage:link || true

# Optimizar para producción
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Laravel listo. Iniciando Apache..."

# Iniciar Apache en primer plano
exec apache2-foreground
