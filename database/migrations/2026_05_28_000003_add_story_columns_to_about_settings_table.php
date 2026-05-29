<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('about_settings', function (Blueprint $table) {
            $table->string('story_image')->nullable();
            $table->string('story_title_line_1')->nullable();
            $table->string('story_title_highlight')->nullable();
            $table->text('story_description')->nullable();
            $table->text('story_quote')->nullable();
            $table->text('story_bottom_text')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('about_settings', function (Blueprint $table) {
            $table->dropColumn([
                'story_image',
                'story_title_line_1',
                'story_title_highlight',
                'story_description',
                'story_quote',
                'story_bottom_text'
            ]);
        });
    }
};
