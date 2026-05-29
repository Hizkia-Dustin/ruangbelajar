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
        // First convert existing statuses to avoid enum validation issues
        DB::table('registrations')->where('status', 'pending')->update(['status' => 'need_contact']);
        DB::table('registrations')->whereIn('status', ['trial', 'accepted'])->update(['status' => 'contacted']);

        Schema::table('registrations', function (Blueprint $table) {
            // Change column default and type
            $table->string('status', 50)->default('need_contact')->change();
            
            // Add program_name if it doesn't exist
            if (!Schema::hasColumn('registrations', 'program_name')) {
                $table->string('program_name')->nullable()->after('program_id');
            }
        });

        // Copy selected_program to program_name for data consistency
        DB::table('registrations')->update(['program_name' => DB::raw('selected_program')]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->string('status', 50)->default('pending')->change();
            $table->dropColumn('program_name');
        });
    }
};
