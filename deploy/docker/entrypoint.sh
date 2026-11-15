#!/bin/sh
set -e

# Default PORT to 10000 if not set (Render injects $PORT dynamically)
PORT=${PORT:-10000}

# Replace __PORT__ in Nginx config with the actual $PORT Render assigned
sed -i "s/__PORT__/${PORT}/g" /etc/nginx/http.d/default.conf

# Setup storage symlink if it doesn't exist
php artisan storage:link --force || true

# Check if SQLite database file exists and is writable (when DB_CONNECTION is sqlite)
if [ ! -f /var/www/html/database/database.sqlite ]; then
    touch /var/www/html/database/database.sqlite
fi
chown -R www-data:www-data /var/www/html/database /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/database /var/www/html/storage /var/www/html/bootstrap/cache

# Run migrations
echo "Running migrations..."
php artisan migrate --force || true

# Seed default admin user & data
echo "Seeding default data..."
php artisan db:seed --class=AdminSeeder --force || true
php artisan db:seed --class=BerandaSeeder --force || true
php artisan db:seed --class=ProgramSeeder --force || true

# Optimize cache for production
echo "Caching configuration and routes..."
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

echo "Starting Nginx and PHP-FPM on port ${PORT}..."
exec /usr/bin/supervisord -c /etc/supervisord.conf
