#!/bin/bash

echo "🔧 Starting Laravel application..."

# Run migrations
echo "📊 Running database migrations..."
php artisan migrate --force

# Start the Laravel server
echo "🌐 Starting web server on port $PORT..."
php artisan serve --host=0.0.0.0 --port=$PORT
