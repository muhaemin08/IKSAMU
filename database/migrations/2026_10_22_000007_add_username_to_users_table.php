<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username', 100)->nullable()->unique()->after('name');
            $table->string('email')->nullable()->change();
        });

        // Set default usernames for existing users based on email prefix or id
        $users = DB::table('users')->get();
        foreach ($users as $u) {
            $prefix = explode('@', $u->email)[0];
            $username = $prefix ?: 'user' . $u->id;
            
            // ensure unique
            $count = DB::table('users')->where('username', $username)->where('id', '!=', $u->id)->count();
            if ($count > 0) {
                $username = $username . $u->id;
            }

            DB::table('users')->where('id', $u->id)->update(['username' => $username]);
        }
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
        });
    }
};
