<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ConteudoModel;

class conteudosSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $conteudos = [
            ['id' => 1, 'st_nome_conteudo'=>'conteudo1', 'fk_unidade'=>1],
            ['id' => 2, 'st_nome_conteudo'=>'conteudo2', 'fk_unidade'=>1],
            ['id' => 3, 'st_nome_conteudo'=>'conteudo3', 'fk_unidade'=>1],
            ['id' => 4, 'st_nome_conteudo'=>'conteudo4', 'fk_unidade'=>1],
            ['id' => 5, 'st_nome_conteudo'=>'conteudo5', 'fk_unidade'=>1],

        ];
        foreach ($conteudos as $key => $conteudo) {
            ConteudoModel::create($conteudo);
        }
    }
}
