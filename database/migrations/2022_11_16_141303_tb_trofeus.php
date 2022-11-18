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
        Schema::create('tb_trofeus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fk_disciplina')->constrained('tb_nome_disciplinas', 'id');
            $table->string('st_nome_trofeu');
            $table->integer('int_total_atividades');
            $table->longText('st_caminho_img');
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
        Schema::dropIfExists('tb_trofeus');
    }
};
