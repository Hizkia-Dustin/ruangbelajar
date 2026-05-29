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
        Schema::table('register_form_settings', function (Blueprint $table) {
            $table->string('label_child_name')->nullable()->after('form_highlight');
            $table->string('placeholder_child_name')->nullable()->after('label_child_name');
            $table->string('label_parent_name')->nullable()->after('placeholder_child_name');
            $table->string('placeholder_parent_name')->nullable()->after('label_parent_name');
            $table->string('label_age')->nullable()->after('placeholder_parent_name');
            $table->string('placeholder_age')->nullable()->after('label_age');
            $table->string('label_class')->nullable()->after('placeholder_age');
            $table->string('placeholder_class')->nullable()->after('label_class');
            $table->string('label_program')->nullable()->after('placeholder_class');
            $table->string('placeholder_program')->nullable()->after('label_program');
            $table->string('label_whatsapp')->nullable()->after('placeholder_program');
            $table->string('placeholder_whatsapp')->nullable()->after('label_whatsapp');
            $table->string('label_note')->nullable()->after('placeholder_whatsapp');
            $table->string('placeholder_note')->nullable()->after('label_note');
            $table->string('trust_text_1')->nullable()->after('placeholder_note');
            $table->string('trust_text_2')->nullable()->after('trust_text_1');
        });

        // Set default values for existing records
        $first = DB::table('register_form_settings')->first();
        if ($first) {
            DB::table('register_form_settings')->where('id', $first->id)->update([
                'label_child_name' => 'Nama Lengkap Anak',
                'placeholder_child_name' => 'Masukkan nama putra/putri Anda',
                'label_parent_name' => 'Nama Orang Tua / Wali',
                'placeholder_parent_name' => 'Masukkan nama Ibu / Ayah / Wali',
                'label_age' => 'Umur Anak',
                'placeholder_age' => 'Contoh: 5',
                'label_class' => 'Kelas',
                'placeholder_class' => 'Contoh: TK-B atau 1 SD',
                'label_program' => 'Pilih Program Belajar',
                'placeholder_program' => '-- Pilih Program --',
                'label_whatsapp' => 'Nomor WhatsApp Aktif',
                'placeholder_whatsapp' => 'Contoh: 0812xxxxxx',
                'label_note' => 'Catatan / Keterangan Tambahan',
                'placeholder_note' => 'Tuliskan catatan tambahan jika ada...',
                'trust_text_1' => 'Data Aman Terlindungi',
                'trust_text_2' => 'Respon Cepat Kilat',
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('register_form_settings', function (Blueprint $table) {
            $table->dropColumn([
                'label_child_name',
                'placeholder_child_name',
                'label_parent_name',
                'placeholder_parent_name',
                'label_age',
                'placeholder_age',
                'label_class',
                'placeholder_class',
                'label_program',
                'placeholder_program',
                'label_whatsapp',
                'placeholder_whatsapp',
                'label_note',
                'placeholder_note',
                'trust_text_1',
                'trust_text_2',
            ]);
        });
    }
};
