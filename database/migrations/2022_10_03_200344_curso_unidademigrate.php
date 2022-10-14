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
        Schema::create('tb_curso_unidade', function (Blueprint $table) {
            $table->foreignId('fk_curso')->constrained('tb_curso', 'id');
            $table->foreignId('fk_unidade')->constrained('tb_unidade', 'id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_curso_unidade');
    }
};
