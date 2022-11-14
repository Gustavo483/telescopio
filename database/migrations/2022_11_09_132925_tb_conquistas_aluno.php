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
        Schema::create('tb_conquistas_aluno', function (Blueprint $table) {
            $table->id();
            /*FKS*/
            $table->foreignId('fk_aluno')->constrained('tb_alunos', 'id');
            /*FKS*/
            $table->integer('int_total_pets')->default(0);
            $table->integer('int_total_cursos_concluidos')->default(0);
            $table->integer('int_revisoes')->default(0);
            $table->integer('int_total_estrelas')->default(0);
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
        Schema::dropIfExists('tb_conquistas_aluno');
    }
};
