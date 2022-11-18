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
        Schema::create('tb_alunos_pets', function (Blueprint $table) {
            $table->foreignId('fk_aluno')->constrained('tb_alunos', 'id');
            $table->foreignId('fk_pets')->constrained('tb_pets', 'id');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_alunos_pets');
    }
};
