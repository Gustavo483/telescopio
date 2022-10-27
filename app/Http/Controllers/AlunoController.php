<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use App\Models\ConteudoModel;
use Illuminate\Http\Request;
use App\Models\ProgressoModel;
use App\Models\CronogramaModel;
use App\Models\ConteudoEscritoModel;
use App\Models\QuestoesModel;
use App\Models\QuestoesFizacaoModel;
use App\Models\TesteFinalModel;
use App\Models\TesteIntermediarioModel;

class AlunoController extends Controller
{
    public function vizualizarCurso($IdAluno, $IdCurso)
    {
        $informacoesProgressos = ProgressoModel::where('fk_aluno',$IdAluno)->where('fk_curso',$IdCurso)->get();
        $DadosParaApresentar = [];
        $PrimeiroDadoParaApresentar = [];
        $NomesConteudos = [];
        $nomeConteudo0 = [];
        $contador = 0;
        foreach ($informacoesProgressos as $progresso){
            $IdConteudo = $progresso->fk_conteudo;
            $nomeCurso = $progresso->cursos->st_nome_curso;
            $nomeUnidade = $progresso->unidades->st_nome_unidade;
            $dadosCronograma = CronogramaModel::where('fk_conteudo',$IdConteudo)->orderBy('st_ordem_apresentacao')->get();
            $nomeConteudo = ConteudoModel::where('id',$IdConteudo)->first();
            if(in_array($nomeConteudo->st_nome_conteudo,$NomesConteudos )){
                foreach ($dadosCronograma as $dadoCronograma){
                    $dados = [$IdAluno,$IdConteudo,$nomeConteudo->st_nome_conteudo,$nomeCurso,$nomeUnidade,$dadoCronograma->st_tipo_atividade,$dadoCronograma->id,$progresso->int_submit_atividades];
                    array_push($DadosParaApresentar, $dados);
                }
            }else{
                if ($contador != 0 ){
                    array_push($NomesConteudos,$nomeConteudo->st_nome_conteudo);
                }
                foreach ($dadosCronograma as $dadoCronograma){
                    if($contador == 0 ){

                        $dados = [$IdAluno,$IdConteudo,$nomeConteudo->st_nome_conteudo,$nomeCurso,$nomeUnidade,$dadoCronograma->st_tipo_atividade,$dadoCronograma->id,$progresso->int_submit_atividades];
                        array_push($PrimeiroDadoParaApresentar, $dados);
                        $nomeConteudo0[0] = $nomeConteudo->st_nome_conteudo;

                    }else{
                        $dados = [$IdAluno,$IdConteudo,$nomeConteudo->st_nome_conteudo,$nomeCurso,$nomeUnidade,$dadoCronograma->st_tipo_atividade,$dadoCronograma->id,$progresso->int_submit_atividades];
                        array_push($DadosParaApresentar, $dados);
                    }

                }
            }
            $contador = $contador + 1 ;

        }

        return view('Permisions.TelasAluno.aprensetarCursoParaAlunos',['nomeConteudo0'=>$nomeConteudo0,'PrimeiroDadoParaApresentar'=>$PrimeiroDadoParaApresentar,'DadosParaApresentar'=>$DadosParaApresentar, 'NomesConteudos'=>$NomesConteudos]);
    }
    public function MostrarExercicioAluno($IdAluno,$idConteudo,$IdCronograma,$tipoAtividade)
    {
        if($tipoAtividade == 'TEXTO'){
            $dados = ConteudoEscritoModel::where('fk_cronograma',$IdCronograma)->first();
            return view('Permisions.TelasAluno.ApresentarTextoConteudo', ['texto'=>$dados, 'IdAluno'=>$IdAluno, 'IdConteudo'=>$idConteudo]);
        }

        if($tipoAtividade == 'AtividadeFixacao'){
            $dados = QuestoesFizacaoModel::where('fk_conteudo',$idConteudo)->get();
            return view('Permisions.TelasAluno.apresentarAtividadeFixacao', ['Atividades'=>$dados, 'IdAluno'=>$IdAluno, 'IdConteudo'=>$idConteudo]);
        }
        if($tipoAtividade == 'testeConteudo'){
            $dados = QuestoesModel::where('fk_conteudo', $idConteudo)->inRandomOrder()->limit(5)->get();
            return view('Permisions.TelasAluno.testeConteudo', ['Atividades'=>$dados, 'IdAluno'=>$IdAluno, 'IdConteudo'=>$idConteudo]);
        }
        if ($tipoAtividade == 'Teste Final'){
            $colect = new Collection();
            $dados = TesteFinalModel::where('fk_conteudo_pertencente', $idConteudo)->get();
            foreach ($dados as $dado){
                $valorFkConteudo = $dado->fk_conteudo;
                $QuantidadeQuestoes = $dado->totalQuestao;
                $DadosQuestoes = QuestoesModel::where('fk_conteudo',$valorFkConteudo)->inRandomOrder()->limit($QuantidadeQuestoes)->get();
                foreach ($DadosQuestoes as $questoes){
                    $colect->push($questoes);
                }
            }
            $dadosAtividadeIntermediaria = $colect->all();
            return view('Permisions.TelasAluno.testeConteudo', ['Atividades'=>$dadosAtividadeIntermediaria, 'IdAluno'=>$IdAluno, 'IdConteudo'=>$idConteudo]);
        }
        if ($tipoAtividade == 'Teste Intermediario'){
            $colect = new Collection();
            $dados = TesteIntermediarioModel::where('fk_conteudo_pertencente', $idConteudo)->get();
            foreach ($dados as $dado){
                $valorFkConteudo = $dado->fk_conteudo;
                $QuantidadeQuestoes = $dado->totalQuestao;
                $DadosQuestoes = QuestoesModel::where('fk_conteudo',$valorFkConteudo)->inRandomOrder()->limit($QuantidadeQuestoes)->get();
                foreach ($DadosQuestoes as $questoes){
                    $colect->push($questoes);
                }
            }
            $dadosAtividadeIntermediaria = $colect->all();
            return view('Permisions.TelasAluno.testeConteudo', ['Atividades'=>$dadosAtividadeIntermediaria, 'IdAluno'=>$IdAluno, 'IdConteudo'=>$idConteudo]);
        }
    }
    public function Salvarprogresso(Request $request, $IdAluno, ConteudoModel $idConteudo)
    {
        $dadoCurso = ProgressoModel::where('fk_aluno',$IdAluno)->where('fk_unidade',$idConteudo->fk_unidade)->get();
        $dado = ProgressoModel::where('fk_aluno',$IdAluno)->where('fk_conteudo',$idConteudo->id)->first();
        $dado->update(
            [
                'int_submit_atividades'=>2,
                'int_estrela_obtida'=>2
            ]
        );
        $contador = 0;

        foreach ($dadoCurso as $dado){
            if($contador == 1){
                $dado->update(
                    [
                        'int_submit_atividades'=>1,
                    ]
                );
                break;
            }
            if($contador == 0){
                if ($dado->int_submit_atividades == 2){
                    $contador = $contador + 1;
                }
            }

        }
    }
}
