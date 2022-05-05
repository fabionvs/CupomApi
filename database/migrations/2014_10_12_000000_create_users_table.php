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
        Schema::create('tb_users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('nm_nome')->nullable();
            $table->string('dt_aniversario')->nullable();
            $table->string('cpf')->unique()->nullable();
            $table->string('email')->nullable();
            $table->string('google_id');
            $table->rememberToken();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_users');
    }
}
