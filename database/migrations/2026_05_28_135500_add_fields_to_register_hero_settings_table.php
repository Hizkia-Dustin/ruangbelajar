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
        Schema::table('register_hero_settings', function (Blueprint $table) {
            $table->string('title_line_2')->nullable()->after('title_line_1');
            $table->string('benefit_1_title')->nullable()->after('hero_image');
            $table->text('benefit_1_description')->nullable()->after('benefit_1_title');
            $table->string('benefit_2_title')->nullable()->after('benefit_1_description');
            $table->text('benefit_2_description')->nullable()->after('benefit_2_title');
            $table->string('benefit_3_title')->nullable()->after('benefit_2_description');
            $table->text('benefit_3_description')->nullable()->after('benefit_3_title');
            $table->string('counter_text')->nullable()->after('benefit_3_description');
            $table->string('counter_description')->nullable()->after('counter_text');
        });

        // Set default values for the first record if it exists
        $first = DB::table('register_hero_settings')->first();
        if ($first) {
            DB::table('register_hero_settings')->where('id', $first->id)->update([
                'benefit_1_title' => 'Kelas Super Kecil',
                'benefit_1_description' => 'Maksimal 5 anak per sesi untuk kenyamanan belajar.',
                'benefit_2_title' => 'Metode Playful',
                'benefit_2_description' => 'Belajar asik tanpa tekanan melalui pendekatan personal.',
                'benefit_3_title' => 'Konsultasi Gratis',
                'benefit_3_description' => 'Bantu pilihkan program terbaik untuk putra-putri Anda.',
                'counter_text' => '100+ Anak',
                'counter_description' => 'Telah Bergabung Bersama Kami',
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('register_hero_settings', function (Blueprint $table) {
            $table->dropColumn([
                'title_line_2',
                'benefit_1_title',
                'benefit_1_description',
                'benefit_2_title',
                'benefit_2_description',
                'benefit_3_title',
                'benefit_3_description',
                'counter_text',
                'counter_description',
            ]);
        });
    }
};
