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
        Schema::create('tb_teste_final_curso', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_conteudo_pertencente');
            /*FKS*/
            $table->foreignId('fk_conteudo')->constrained('tb_conteudos', 'id');
            $table->foreignId('fk_curso')->constrained('tb_curso', 'id');
            /*FKS*/
            $table->integer('totalQuestao');
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
        Schema::dropIfExists('tb_teste_final_curso');
    }
};
