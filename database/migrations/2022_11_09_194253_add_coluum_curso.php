<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tb_curso', function($table) {
            $table->string('st_nome_disciplinas')->nullable();
        });
    }

    public function down()
    {
        Schema::table('tb_curso', function($table) {
            $table->dropColumn('st_nome_disciplinas');
        });
    }
};
