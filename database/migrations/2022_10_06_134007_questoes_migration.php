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
        Schema::create('tb_questoes', function (Blueprint $table) {
            $table->id();
            /*FKS*/
            $table->foreignId('fk_conteudo')->constrained('tb_conteudos', 'id');
            /*FKS*/
            $table->string('st_tipoDeQuestao');
            $table->longText('st_resolusao');
            $table->longText('st_pergunta');
            $table->text('st_gabarito')->nullable();
            $table->text('st_respostaRB')->nullable();
            $table->text('st_respostaRN')->nullable();
            $table->longText('st_alternativa1')->nullable();
            $table->longText('st_alternativa2')->nullable();
            $table->longText('st_alternativa3')->nullable();
            $table->longText('st_alternativa4')->nullable();
            $table->longText('st_alternativa5')->nullable();
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
