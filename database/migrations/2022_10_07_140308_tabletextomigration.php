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
        Schema::create('tb_texto_conteudo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fk_conteudo')->constrained('tb_conteudos', 'id');
            $table->foreignId('fk_cronograma')->constrained('tb_cronograma', 'id');
            $table->longText('st_texto');
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
        Schema::dropIfExists('tb_questoes');
    }
};
