<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_cronograma', function (Blueprint $table) {
            $table->id();
            $table->string('st_tipo_atividade');
            $table->string('st_ordem_apresentacao');
            /*FKS*/
            $table->foreignId('fk_conteudo')->constrained('tb_conteudos', 'id');
            $table->foreignId('fk_unidade')->constrained('tb_unidade', 'id');
            /*FKS*/
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
        Schema::dropIfExists('tb_cronograma');
    }
};
