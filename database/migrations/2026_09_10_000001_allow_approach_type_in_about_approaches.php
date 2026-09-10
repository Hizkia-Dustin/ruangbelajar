<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('about_approaches', function (Blueprint $table) {
            $table->enum('type', ['problem', 'solution', 'approach'])->change();
        });
    }

    public function down(): void
    {
        // Keep existing approach records valid when rolling back.
        Schema::table('about_approaches', function (Blueprint $table) {
            $table->string('type')->change();
        });
    }
};
