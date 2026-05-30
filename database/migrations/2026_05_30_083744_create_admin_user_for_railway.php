<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration {
    public function up(): void
    {
        DB::table('users')->updateOrInsert(
            ['email' => 'admin@ruangbelajar.id'],
            [
                'name' => 'Admin Ruang Belajar',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }

    public function down(): void
    {
        DB::table('users')
            ->where('email', 'admin@ruangbelajar.id')
            ->delete();
    }
};