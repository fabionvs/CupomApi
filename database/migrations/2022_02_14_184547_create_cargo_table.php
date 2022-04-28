<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_cargo', function (Blueprint $table) {
            $table->id();
            $table->string('nm_nome')->unique();
            $table->boolean('st_cargo')->default(false);
            $table->string('cd_cargo')->unique();
            $table->string('cd_cbo')->unique();
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
        Schema::dropIfExists('tb_cargo');
    }
}
