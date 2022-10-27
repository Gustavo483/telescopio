<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\QuestoesFizacaoModel;

class QuestoesFizacaoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $QueestoesFizacao = [
            ['id' => 1, 'fk_conteudo'=>1, 'DadosBanca'=>'unb(22)', 'st_tipoDeQuestao'=>'questaoRB','st_pergunta'=>'1+2', 'st_resolusao'=>'1+2 =3', 'st_gabarito'=>'3'],
            ['id' => 2, 'fk_conteudo'=>1, 'DadosBanca'=>'unb(22)', 'st_tipoDeQuestao'=>'questaoRB','st_pergunta'=>'1+3', 'st_resolusao'=>'1+3 =4', 'st_gabarito'=>'4'],
            ['id' => 3, 'fk_conteudo'=>1, 'DadosBanca'=>'unb(22)', 'st_tipoDeQuestao'=>'questaoRB','st_pergunta'=>'1+4', 'st_resolusao'=>'1+4 =5', 'st_gabarito'=>'5'],
            ['id' => 4, 'fk_conteudo'=>1, 'DadosBanca'=>'unb(22)', 'st_tipoDeQuestao'=>'questaoRB','st_pergunta'=>'1+5', 'st_resolusao'=>'1+5 =6', 'st_gabarito'=>'6'],
            ['id' => 5, 'fk_conteudo'=>1, 'DadosBanca'=>'unb(22)', 'st_tipoDeQuestao'=>'questaoRB','st_pergunta'=>'1+6', 'st_resolusao'=>'1+6 =7', 'st_gabarito'=>'7'],
            ['id' => 6, 'fk_conteudo'=>1, 'DadosBanca'=>'unb(22)', 'st_tipoDeQuestao'=>'questaoRN','st_pergunta'=>'1+2', 'st_resolusao'=>'1+2 =3', 'st_gabarito'=>'3'],
            ['id' => 7, 'fk_conteudo'=>1, 'DadosBanca'=>'unb(22)', 'st_tipoDeQuestao'=>'questaoRN','st_pergunta'=>'1+3', 'st_resolusao'=>'1+3 =4', 'st_gabarito'=>'4'],
            ['id' => 8, 'fk_conteudo'=>1, 'DadosBanca'=>'unb(22)', 'st_tipoDeQuestao'=>'questaoRN','st_pergunta'=>'1+4', 'st_resolusao'=>'1+4 =5', 'st_gabarito'=>'5'],
            ['id' => 9, 'fk_conteudo'=>1, 'DadosBanca'=>'unb(22)', 'st_tipoDeQuestao'=>'questaoRN','st_pergunta'=>'1+5', 'st_resolusao'=>'1+5 =6', 'st_gabarito'=>'6'],
            ['id' => 10, 'fk_conteudo'=>1, 'DadosBanca'=>'unb(22)', 'st_tipoDeQuestao'=>'questaoRN','st_pergunta'=>'1+6', 'st_resolusao'=>'1+6 =7', 'st_gabarito'=>'7'],
            ['id' => 11, 'fk_conteudo'=>1, 'DadosBanca'=>'unb(22)', 'st_tipoDeQuestao'=>'questaoME','st_pergunta'=>'1+2', 'st_resolusao'=>'1+2 =3', 'st_gabarito'=>'1','st_alternativa1'=>'3','st_alternativa2'=>'4','st_alternativa3'=>'6','st_alternativa4'=>'8','st_alternativa5'=>'3'],
            ['id' => 12, 'fk_conteudo'=>1, 'DadosBanca'=>'unb(22)', 'st_tipoDeQuestao'=>'questaoME','st_pergunta'=>'1+3', 'st_resolusao'=>'1+3 =4', 'st_gabarito'=>'2','st_alternativa1'=>'1','st_alternativa2'=>'4','st_alternativa3'=>'2','st_alternativa4'=>'3','st_alternativa5'=>'4'],
            ['id' => 13, 'fk_conteudo'=>1, 'DadosBanca'=>'unb(22)', 'st_tipoDeQuestao'=>'questaoME','st_pergunta'=>'1+4', 'st_resolusao'=>'1+4 =5', 'st_gabarito'=>'3','st_alternativa1'=>'1','st_alternativa2'=>'2','st_alternativa3'=>'5','st_alternativa4'=>'3','st_alternativa5'=>'4'],
            ['id' => 14, 'fk_conteudo'=>1, 'DadosBanca'=>'unb(22)', 'st_tipoDeQuestao'=>'questaoME','st_pergunta'=>'1+5', 'st_resolusao'=>'1+5 =6', 'st_gabarito'=>'4','st_alternativa1'=>'5','st_alternativa2'=>'5','st_alternativa3'=>'7','st_alternativa4'=>'6','st_alternativa5'=>'5'],
            ['id' => 15, 'fk_conteudo'=>1, 'DadosBanca'=>'unb(22)', 'st_tipoDeQuestao'=>'questaoME','st_pergunta'=>'1+6', 'st_resolusao'=>'1+6 =7', 'st_gabarito'=>'5','st_alternativa1'=>'6','st_alternativa2'=>'7','st_alternativa3'=>'4','st_alternativa4'=>'3','st_alternativa5'=>'7'],
        ];
        foreach ($QueestoesFizacao as $key => $QueestaoFizacao) {
            QuestoesFizacaoModel::create($QueestaoFizacao);
        }
    }
}
