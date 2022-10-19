<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UnidadeModel;

class unidadeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            $unidades = [
                ['id' => 1, 'st_nome_unidade'=>'unidade1'],
            ];
            foreach ($unidades as $key => $unidade) {
                UnidadeModel::create($unidade);
            }
        }
    }
}
