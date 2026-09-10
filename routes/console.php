<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('admin:create', function () {
    $name = $this->ask('Nama admin');
    $email = $this->ask('Email admin');
    $password = $this->secret('Password (minimal 12 karakter)');
    $confirmation = $this->secret('Ulangi password');

    $validator = validator(compact('name', 'email', 'password'), [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255', 'unique:users,email'],
        'password' => ['required', 'string', 'min:12'],
    ]);
    if ($validator->fails() || $password !== $confirmation) {
        $this->error($validator->fails() ? $validator->errors()->first() : 'Konfirmasi password berbeda.');
        return 1;
    }

    \App\Models\User::create([
        'name' => $name,
        'email' => $email,
        'password' => \Illuminate\Support\Facades\Hash::make($password),
    ]);
    $this->info('Admin berhasil dibuat. Login melalui /admin/login.');
})->purpose('Buat akun admin dengan password pilihan sendiri');
