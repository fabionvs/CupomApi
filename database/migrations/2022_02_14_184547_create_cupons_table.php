<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_empresa', function (Blueprint $table) {
            $table->id();
            $table->string('nm_nome')->unique();
            $table->string('nr_cnpj')->unique();
            $table->string('logo');

            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('tb_users')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('tb_filial', function (Blueprint $table) {
            $table->id();
            $table->string('latitude')->unique();
            $table->string('longitude')->unique();
            $table->boolean('st_ativo')->default(true);
            $table->string('categoria');
            $table->bigInteger('empresa_id')->unsigned()->index();
            $table->foreign('empresa_id')->references('id')->on('tb_empresa')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
        Schema::create('tb_promocao', function (Blueprint $table) {
            $table->id();
            $table->string('nm_nome')->unique();
            $table->string('cd_cupom')->unique();
            $table->string('nr_porcentagem');
            $table->boolean('st_ativo')->default(false);
            $table->timestamps();

            $table->bigInteger('filial_id')->unsigned()->index();
            $table->foreign('filial_id')->references('id')->on('tb_filial')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('tb_cupons', function (Blueprint $table) {
            $table->id();
            $table->string('nm_nome')->unique();
            $table->string('cd_codigo');
            $table->string('cd_cupom')->unique();
            $table->boolean('st_ativo')->default(false);
            $table->boolean('st_consumido')->default(false);
            $table->timestamp('dt_consumido');
            $table->timestamps();

            $table->bigInteger('promocao_id')->unsigned()->index();
            $table->foreign('promocao_id')->references('id')->on('tb_promocao')->onUpdate('cascade')->onDelete('cascade');

            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('tb_users')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_empresa');
        Schema::dropIfExists('tb_filial');
        Schema::dropIfExists('tb_promocao');
        Schema::dropIfExists('tb_cupons');
    }
}
