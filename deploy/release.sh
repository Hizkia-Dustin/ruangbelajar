#!/usr/bin/env bash
set -euo pipefail
cd "$(dirname "$0")/.."

if [[ ! -f .env ]]; then
  echo 'Buat .env dari deploy/env.example dan isi konfigurasi DOM Cloud dahulu.' >&2
  exit 1
fi

composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction
php artisan config:clear
php deploy/check-env.php
npm ci --include=dev
npm run build

# Buat key hanya pada instalasi pertama; key yang sudah ada tetap dipakai.
if ! grep -Eq '^APP_KEY=.+$' .env; then
  php artisan key:generate --force
fi
php artisan migrate --force
if [[ ! -e public/storage && ! -L public/storage ]]; then
  php artisan storage:link
fi
if [[ -f public/hot ]]; then
  rm public/hot
fi
chmod -R u+rwX,g+rX storage bootstrap/cache
php artisan config:cache
php artisan view:cache
echo 'Deploy selesai. Periksa /up, halaman utama, dan /admin/login.'
