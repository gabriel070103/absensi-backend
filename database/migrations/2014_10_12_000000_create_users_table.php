<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('foto_profil');
            $table->enum('role', ['admin', 'guru', 'siswa']);
            $table->rememberToken();
            $table->timestamps();
        });

        /*
        * For Default Admin Account
        */
        DB::table('user')->insert([
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'foto_profil' => 'default.jpg',
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
