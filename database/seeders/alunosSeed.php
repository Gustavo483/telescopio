<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\AlunoModel;

class alunosSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Alunos = [
            ['id' => 1,'st_nome_aluno'=>'Aluno um','fk_user'=> 10,'st_estrelas_obtidas'=>0, 'img_pet_selecionado'=>'ImgPet1',],
            ['id' => 2,'st_nome_aluno'=>'Aluno dois','fk_user'=> 9,'st_estrelas_obtidas'=>0, 'img_pet_selecionado'=>'ImgPet1',],
            ['id' => 3,'st_nome_aluno'=>'Aluno tres','fk_user'=> 8,'st_estrelas_obtidas'=>0, 'img_pet_selecionado'=>'ImgPet1',],
            ['id' => 4,'st_nome_aluno'=>'Aluno quatro','fk_user'=> 7,'st_estrelas_obtidas'=>0, 'img_pet_selecionado'=>'ImgPet1',],
            ['id' => 5,'st_nome_aluno'=>'Aluno cinco','fk_user'=> 6,'st_estrelas_obtidas'=>0, 'img_pet_selecionado'=>'ImgPet1',],
            ['id' => 6,'st_nome_aluno'=>'Aluno seis','fk_user'=> 5,'st_estrelas_obtidas'=>0, 'img_pet_selecionado'=>'ImgPet1',],
            ['id' => 7,'st_nome_aluno'=>'Aluno sete','fk_user'=> 4,'st_estrelas_obtidas'=>0, 'img_pet_selecionado'=>'ImgPet1',],
            ['id' => 8,'st_nome_aluno'=>'Aluno oito','fk_user'=> 3,'st_estrelas_obtidas'=>0, 'img_pet_selecionado'=>'ImgPet1',],
            ['id' => 9,'st_nome_aluno'=>'Aluno nove','fk_user'=> 2,'st_estrelas_obtidas'=>0, 'img_pet_selecionado'=>'ImgPet1',],
            ['id' => 10,'st_nome_aluno'=>'Aluno dez','fk_user'=> 1,'st_estrelas_obtidas'=>0, 'img_pet_selecionado'=>'ImgPet1',],

        ];
        foreach ($Alunos as $key => $Aluno) {
            AlunoModel::create($Aluno);
        }
    }
}
