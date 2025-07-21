#!/bin/bash
set -e

echo "🔧 Starting Laravel application..."

echo "📊 Running database migrations..."
php artisan migrate --force

echo "🌐 Starting web server on port $PORT..."
php artisan serve --host=0.0.0.0 --port=$PORT
