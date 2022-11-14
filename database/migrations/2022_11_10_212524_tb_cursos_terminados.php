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
        Schema::create('tb_cursos_terminados', function (Blueprint $table) {
            $table->id();
            /*FKS*/
            $table->foreignId('fk_aluno')->constrained('tb_alunos', 'id');
            $table->foreignId('fk_curso')->constrained('tb_curso', 'id');
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
        Schema::dropIfExists('tb_cursos_terminados');
    }
};
