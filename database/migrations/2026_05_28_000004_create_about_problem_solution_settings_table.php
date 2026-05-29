<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_problem_solution_settings', function (Blueprint $table) {
            $table->id();
            $table->string('small_label')->nullable();
            $table->string('main_title')->nullable();
            $table->string('main_title_highlight')->nullable();
            $table->string('problem_title')->nullable();
            $table->string('solution_title')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_problem_solution_settings');
    }
};
