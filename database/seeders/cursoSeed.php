<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CursoModel;

class cursoSeed extends Seeder
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
                ['id' => 1, 'st_nome_curso'=>'Curso1'],
                ['id' => 2, 'st_nome_curso'=>'Curso2'],
                ['id' => 3, 'st_nome_curso'=>'Curso3'],
                ['id' => 4, 'st_nome_curso'=>'Curso4'],
                ['id' => 5, 'st_nome_curso'=>'Curso5'],
                ['id' => 6, 'st_nome_curso'=>'Curso6'],
                ['id' => 7, 'st_nome_curso'=>'Curso7'],

            ];
            foreach ($unidades as $key => $unidade) {
                CursoModel::create($unidade);
            }
        }
    }
}
