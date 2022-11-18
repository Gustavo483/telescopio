<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tb_nome_disciplinas', function($table) {
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('tb_nome_disciplinas', function($table) {
            $table->dropColumn('updated_at');
            $table->dropColumn('created_at');
        });
    }
};
