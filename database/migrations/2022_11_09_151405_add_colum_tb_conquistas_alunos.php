<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tb_conquistas_aluno', function($table) {
            $table->integer('int_total_trofeus')->nullable();
        });
    }

    public function down()
    {
        Schema::table('tb_conquistas_aluno', function($table) {
            $table->dropColumn('int_total_trofeus');
        });
    }
};
