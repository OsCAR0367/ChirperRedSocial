#!/bin/bash
set -e

echo "🚀 Starting Laravel application..."

# Run Laravel optimizations
echo "⚡ Optimizing Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
echo "📊 Running database migrations..."
php artisan migrate --force

echo "🌐 Starting Apache server..."
apache2-foreground
