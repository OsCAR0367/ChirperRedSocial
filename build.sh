#!/bin/bash

echo "🚀 Starting Laravel deployment..."

# Install PHP dependencies
echo "📦 Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# Install Node.js dependencies and build assets
echo "📦 Installing Node.js dependencies..."
npm ci

echo "🏗️ Building assets..."
npm run build

# Laravel optimizations
echo "⚡ Optimizing Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Build completed!"
