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
        Schema::create('tb_progresso', function (Blueprint $table) {
            $table->foreignId('fk_aluno')->constrained('tb_alunos', 'id');
            $table->foreignId('fk_unidade')->constrained('tb_unidade', 'id');
            $table->foreignId('fk_curso')->constrained('tb_curso', 'id');
            $table->foreignId('fk_conteudo')->constrained('tb_conteudos', 'id');
            $table->integer('int_count_atividade')->default(0);
            $table->integer('int_submit_atividades')->default(0);
            $table->integer('int_estrela_obtida')->default(0);
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
        Schema::dropIfExists('tb_progresso');
    }
};
