<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_solution_settings', function (Blueprint $table) {
            $table->id();
            $table->string('small_label')->nullable();
            $table->string('title_line_1')->nullable();
            $table->string('title_highlight')->nullable();
            $table->string('title_line_2')->nullable();
            $table->string('title_yellow')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_solution_settings');
    }
};
