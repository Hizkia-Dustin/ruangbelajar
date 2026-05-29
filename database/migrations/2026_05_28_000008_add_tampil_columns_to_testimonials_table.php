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
        Schema::table('testimonials', function (Blueprint $table) {
            $table->boolean('tampil_di_beranda')->default(true)->after('photo');
            $table->boolean('tampil_di_tentang')->default(false)->after('tampil_di_beranda');
        });

        // Copy display_location to the new columns
        DB::table('testimonials')->where('display_location', 'home')->update([
            'tampil_di_beranda' => true,
            'tampil_di_tentang' => false,
        ]);
        DB::table('testimonials')->where('display_location', 'about')->update([
            'tampil_di_beranda' => false,
            'tampil_di_tentang' => true,
        ]);
        DB::table('testimonials')->where('display_location', 'both')->update([
            'tampil_di_beranda' => true,
            'tampil_di_tentang' => true,
        ]);

        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn('display_location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->enum('display_location', ['home', 'about', 'both'])->default('home')->after('photo');
        });

        // Copy back
        DB::table('testimonials')->where('tampil_di_beranda', true)->where('tampil_di_tentang', false)->update(['display_location' => 'home']);
        DB::table('testimonials')->where('tampil_di_beranda', false)->where('tampil_di_tentang', true)->update(['display_location' => 'about']);
        DB::table('testimonials')->where('tampil_di_beranda', true)->where('tampil_di_tentang', true)->update(['display_location' => 'both']);

        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn(['tampil_di_beranda', 'tampil_di_tentang']);
        });
    }
};
