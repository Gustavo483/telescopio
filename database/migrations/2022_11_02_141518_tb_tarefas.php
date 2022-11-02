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
        Schema::create('tb_tarefas_revisao', function (Blueprint $table) {
            $table->id();
            $table->integer('int_estrelas_obtidas')->default(0);
            $table->integer('submit_atividade')->default(0);
            $table->date('data');
            /*FKS*/
            $table->foreignId('fk_aluno')->constrained('tb_alunos', 'id');
            $table->foreignId('fk_curso')->constrained('tb_curso', 'id');
            $table->foreignId('fk_professor')->constrained('tb_professores', 'id');
            $table->foreignId('fk_unidade')->constrained('tb_unidade', 'id');
            $table->foreignId('fk_conteudo')->constrained('tb_conteudos', 'id');
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
        Schema::dropIfExists('tb_tarefas_revisao');
    }
};
