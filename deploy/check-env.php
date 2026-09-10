<?php

require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

if (! $app->environment('production') || config('app.debug') ||
    ! str_starts_with(config('app.url'), 'https://') ||
    str_contains(config('app.url'), 'GANTI_DOMAIN') ||
    config('database.default') !== 'mysql' ||
    ! config('database.connections.mysql.password') ||
    str_starts_with(config('database.connections.mysql.password'), 'GANTI_')) {
    fwrite(STDERR, "Lengkapi .env produksi: APP_ENV, APP_DEBUG, APP_URL HTTPS, dan database DOM Cloud.\n");
    exit(1);
}
