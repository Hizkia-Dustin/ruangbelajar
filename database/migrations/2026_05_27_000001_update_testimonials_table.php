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
            // Rename columns
            $table->renameColumn('nama_orangtua', 'name');
            $table->renameColumn('status', 'role');
            $table->renameColumn('foto', 'photo');
            $table->renameColumn('urutan', 'sort_order');
        });

        Schema::table('testimonials', function (Blueprint $table) {
            // Add new columns (photo is already renamed from foto)
            $table->boolean('is_featured')->default(false)->after('rating');
            $table->enum('display_location', ['home', 'about', 'both'])->default('home')->after('photo');
        });

        // Copy data from old page column to new display_location column
        DB::table('testimonials')->where('page', 'beranda')->update(['display_location' => 'home']);
        DB::table('testimonials')->where('page', 'about')->update(['display_location' => 'about']);
        DB::table('testimonials')->whereNotIn('page', ['beranda', 'about'])->update(['display_location' => 'home']);

        Schema::table('testimonials', function (Blueprint $table) {
            // Drop old page column
            $table->dropColumn('page');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            // Add old column back
            $table->string('page')->default('beranda')->after('is_active');
        });

        // Restore data
        DB::table('testimonials')->where('display_location', 'home')->update(['page' => 'beranda']);
        DB::table('testimonials')->where('display_location', 'about')->update(['page' => 'about']);
        DB::table('testimonials')->where('display_location', 'both')->update(['page' => 'beranda']);

        Schema::table('testimonials', function (Blueprint $table) {
            // Rename back
            $table->renameColumn('name', 'nama_orangtua');
            $table->renameColumn('role', 'status');
            $table->renameColumn('photo', 'foto');
            $table->renameColumn('sort_order', 'urutan');

            // Drop new columns
            $table->dropColumn(['is_featured', 'display_location']);
        });
    }
};
