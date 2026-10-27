<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pendidikan_formals', function (Blueprint $table) {
            $table->string('foto_kepala_sekolah')->nullable()->after('kepala_sekolah');
            $table->text('sambutan_kepala_sekolah')->nullable()->after('foto_kepala_sekolah');
            $table->string('nip_kepala_sekolah')->nullable()->after('sambutan_kepala_sekolah');
        });
    }

    public function down(): void
    {
        Schema::table('pendidikan_formals', function (Blueprint $table) {
            $table->dropColumn(['foto_kepala_sekolah', 'sambutan_kepala_sekolah', 'nip_kepala_sekolah']);
        });
    }
};
