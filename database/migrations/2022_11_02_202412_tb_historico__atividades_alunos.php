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
        Schema::create('tb_historico_atividade_aluno', function (Blueprint $table) {
            $table->id();
            $table->string('st_nome_disciplina',50)->nullable();
            /*FKS*/
            $table->foreignId('fk_aluno')->constrained('tb_alunos', 'id');
            $table->foreignId('fk_curso')->constrained('tb_curso', 'id');
            $table->foreignId('fk_unidade')->constrained('tb_unidade', 'id');
            $table->foreignId('fk_conteudo')->constrained('tb_conteudos', 'id');
            /*FKS*/
            $table->string('st_tipo_atividade',20)->nullable();
            $table->integer('int_acertos')->default(0);
            $table->integer('int_tempo_execucao')->default(0);

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
        Schema::dropIfExists('tb_historico_atividade_aluno');
    }

};
