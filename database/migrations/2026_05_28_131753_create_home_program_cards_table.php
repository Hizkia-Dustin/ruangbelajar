<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('home_program_cards', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('badge')->nullable();
            $table->text('description');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Seed default 3 cards
        DB::table('home_program_cards')->insert([
            [
                'title' => 'Pra-Sekolah',
                'badge' => 'Special',
                'description' => 'Mempersiapkan motorik & sosialisasi dini.',
                'sort_order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Jenjang TK',
                'badge' => 'Populer',
                'description' => 'Calistung asik untuk persiapan Sekolah Dasar.',
                'sort_order' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Jenjang SD',
                'badge' => null,
                'description' => 'Pendampingan akademik intensif per mata pelajaran.',
                'sort_order' => 3,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_program_cards');
    }
};
