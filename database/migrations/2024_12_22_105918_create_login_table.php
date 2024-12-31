<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoginTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('login', function (Blueprint $table) {
            $table->id(); 
            $table->string('kode_user', 50)->unique();
            $table->string('fullname', 100);
            $table->string('username', 50)->unique();
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->string('kelas', 50)->nullable();
            $table->string('alamat', 255)->nullable();
            $table->string('verif', 10)->default('Tidak');
            $table->string('role', 50)->default('anggota');
            $table->timestamp('join_date')->useCurrent();
            $table->timestamp('terakhir_login')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('login');
    }
}
