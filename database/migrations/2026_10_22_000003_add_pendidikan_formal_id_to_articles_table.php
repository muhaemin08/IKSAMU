<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->foreignId('pendidikan_formal_id')
                ->nullable()
                ->after('user_id')
                ->constrained('pendidikan_formals')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign(['pendidikan_formal_id']);
            $table->dropColumn('pendidikan_formal_id');
        });
    }
};
