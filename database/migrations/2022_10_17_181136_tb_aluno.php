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
        Schema::create('tb_alunos', function (Blueprint $table) {
            $table->id();
            $table->string('st_nome_aluno')->nullable();
            $table->foreignId('fk_user')->constrained('users', 'id');
            $table->integer('st_estrelas_obtidas')->default(0);
            $table->text('img_pet_selecionado');
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
        Schema::dropIfExists('tb_alunos');
    }
};
