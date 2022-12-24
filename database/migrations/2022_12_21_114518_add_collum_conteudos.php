<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::table('tb_conteudos', function($table) {
            $table->integer('int_ordem_apresentacao')->default(1);
        });
    }

    public function down()
    {
        Schema::table('tb_conteudos', function($table) {
            $table->dropColumn('int_ordem_apresentacao');
        });
    }
};
