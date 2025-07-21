#!/bin/bash
set -e

echo "🚀 Starting Laravel deployment..."

echo "📦 Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

echo "📦 Installing Node.js dependencies..."
npm ci

echo "🏗️ Building assets..."
npm run build

echo "⚡ Optimizing Laravel..."
php artisan config:cache
php artisan route:cache  
php artisan view:cache

echo "✅ Build completed!"
