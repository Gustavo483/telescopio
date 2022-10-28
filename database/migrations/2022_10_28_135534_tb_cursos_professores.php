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
        Schema::create('tb_professores_cursos', function (Blueprint $table) {
            $table->foreignId('fk_professor')->constrained('tb_professores', 'id');
            $table->foreignId('fk_curso')->constrained('tb_curso', 'id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_professores_cursos');
    }
};
