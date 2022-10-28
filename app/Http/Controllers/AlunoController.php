<?php

namespace App\Http\Controllers;

use App\Models\CursoModel;
use App\Models\TesteCursoModel;
use App\Models\UnidadeModel;
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
        $arrayIdUnidades = [];
        $dadoscurso = CursoModel::where('id',$IdCurso )->get();
        foreach ($dadoscurso as $cursos){
            foreach ($cursos->unidades as $dd){
                array_push($arrayIdUnidades, $dd->id );
            }
        }
        $dadosconteudos = ConteudoModel::wherein('fk_unidade',$arrayIdUnidades )->get();
        $unidades = UnidadeModel::wherein('id',$arrayIdUnidades )->get();
        $contadorUnidades = count($unidades);

        $informacoesProgressos = ProgressoModel::where('fk_aluno',$IdAluno)->where('fk_curso',$IdCurso)->get();
        $DadosParaApresentar = [];
        $PrimeiroDadoParaApresentar = [];
        $NomesConteudos = [];
        $nomeConteudo0 = [];
        $FKUnidadeConteudo0 = [];
        $contador = 0;
        foreach ($informacoesProgressos as $progresso){
            $IdConteudo = $progresso->fk_conteudo;
            $nomeCurso = $progresso->cursos->st_nome_curso;
            $idCurso = $progresso->cursos->id;
            $nomeUnidade = $progresso->unidades->st_nome_unidade;
            $IDUnidade = $progresso->unidades->id;
            $dadosCronograma = CronogramaModel::where('fk_conteudo',$IdConteudo)->orderBy('st_ordem_apresentacao')->get();
            $nomeConteudo = ConteudoModel::where('id',$IdConteudo)->first();
            if(in_array($nomeConteudo->st_nome_conteudo,$NomesConteudos )){
                foreach ($dadosCronograma as $dadoCronograma){
                    $dados = [$IdAluno,$IdConteudo,$nomeConteudo->st_nome_conteudo,$nomeCurso,$nomeUnidade,$dadoCronograma->st_tipo_atividade,$dadoCronograma->id,$progresso->int_submit_atividades,$IDUnidade];
                    array_push($DadosParaApresentar, $dados);
                }
            }else{
                if ($contador != 0 ){
                    array_push($NomesConteudos,$nomeConteudo->st_nome_conteudo);
                }
                foreach ($dadosCronograma as $dadoCronograma){
                    if($contador == 0 ){

                        $dados = [$IdAluno,$IdConteudo,$nomeConteudo->st_nome_conteudo,$nomeCurso,$nomeUnidade,$dadoCronograma->st_tipo_atividade,$dadoCronograma->id,$progresso->int_submit_atividades,$IDUnidade];
                        array_push($PrimeiroDadoParaApresentar, $dados);
                        $nomeConteudo0[0] = $nomeConteudo->st_nome_conteudo;
                        $FKUnidadeConteudo0[0] = $nomeConteudo->fk_unidade;
                    }else{
                        $dados = [$IdAluno,$IdConteudo,$nomeConteudo->st_nome_conteudo,$nomeCurso,$nomeUnidade,$dadoCronograma->st_tipo_atividade,$dadoCronograma->id,$progresso->int_submit_atividades,$IDUnidade];
                        array_push($DadosParaApresentar, $dados);
                    }
                }
            }
            $contador = $contador + 1 ;
        }
        return view('Permisions.TelasAluno.aprensetarCursoParaAlunos',['fkUnidade0'=>$FKUnidadeConteudo0,'nomeConteudo0'=>$nomeConteudo0,'PrimeiroDadoParaApresentar'=>$PrimeiroDadoParaApresentar,'DadosParaApresentar'=>$DadosParaApresentar, 'NomesConteudos'=>$NomesConteudos, 'IdCurso'=>$idCurso,'DadosConteudos'=>$dadosconteudos, 'IDsUnidades'=>$unidades, 'contadorUnidades'=>$contadorUnidades]);
    }
    public function MostrarExercicioAluno($IdAluno,$idConteudo,$IdCronograma,$tipoAtividade,$IdCurso)
    {
        if($tipoAtividade == 'TEXTO'){
            $dados = ConteudoEscritoModel::where('fk_cronograma',$IdCronograma)->first();
            return view('Permisions.TelasAluno.ApresentarTextoConteudo', ['texto'=>$dados, 'IdAluno'=>$IdAluno, 'IdConteudo'=>$idConteudo, 'IdCurso'=>$IdCurso]);
        }
        if($tipoAtividade == 'AtividadeFixacao'){
            $dados = QuestoesFizacaoModel::where('fk_conteudo',$idConteudo)->get();
            return view('Permisions.TelasAluno.apresentarAtividadeFixacao', ['Atividades'=>$dados, 'IdAluno'=>$IdAluno, 'IdConteudo'=>$idConteudo, 'IdCurso'=>$IdCurso]);
        }
        if($tipoAtividade == 'testeConteudo'){
            $dados = QuestoesModel::where('fk_conteudo', $idConteudo)->inRandomOrder()->limit(5)->get();
            return view('Permisions.TelasAluno.testeConteudo', ['Atividades'=>$dados, 'IdAluno'=>$IdAluno, 'IdConteudo'=>$idConteudo , 'IdCurso'=>$IdCurso]);
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
            return view('Permisions.TelasAluno.testeConteudo', ['Atividades'=>$dadosAtividadeIntermediaria, 'IdAluno'=>$IdAluno, 'IdConteudo'=>$idConteudo, 'IdCurso'=>$IdCurso]);
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
            return view('Permisions.TelasAluno.testeConteudo', ['Atividades'=>$dadosAtividadeIntermediaria, 'IdAluno'=>$IdAluno, 'IdConteudo'=>$idConteudo, 'IdCurso'=>$IdCurso]);
        }
        if ($tipoAtividade == 'Teste Final Conteudo'){
            $colect = new Collection();
            $dados = TesteCursoModel::where('fk_conteudo_pertencente', $idConteudo)->get();
            foreach ($dados as $dado){
                $valorFkConteudo = $dado->fk_conteudo;
                $QuantidadeQuestoes = $dado->totalQuestao;
                $DadosQuestoes = QuestoesModel::where('fk_conteudo',$valorFkConteudo)->inRandomOrder()->limit($QuantidadeQuestoes)->get();
                foreach ($DadosQuestoes as $questoes){
                    $colect->push($questoes);
                }
            }
            $dadosTesteFinal = $colect->all();
            return view('Permisions.TelasAluno.testeConteudo', ['Atividades'=>$dadosTesteFinal, 'IdAluno'=>$IdAluno, 'IdConteudo'=>$idConteudo, 'IdCurso'=>$IdCurso]);
        }
    }

    public function Salvarprogresso(Request $request, $IdAluno, ConteudoModel $idConteudo, $IdCurso)
    {


        $dado = ProgressoModel::where('fk_aluno',$IdAluno)->where('fk_conteudo',$idConteudo->id)->where('fk_curso',$IdCurso)->first();
        $dado->update(
            [
                'int_submit_atividades'=>2,
                'int_estrela_obtida'=>2
            ]
        );

        $QuantosDados2 = count(ProgressoModel::where('fk_aluno',$IdAluno)->where('fk_curso',$IdCurso)->where('int_submit_atividades', 2)->get());
        $contador = 0;
        $contadorFinal = 0;

        $dadoCurso2 = ProgressoModel::where('fk_aluno',$IdAluno)->where('fk_curso',$IdCurso)->get();
        foreach ($dadoCurso2 as $dado){
            if($contadorFinal == 1){
                $dado->update(
                    [
                        'int_submit_atividades'=>1,
                    ]
                );
                break;
            }
            if ($dado->int_submit_atividades == 2){
                $contador = $contador + 1;
                if ($contador == $QuantosDados2 ){
                    $contadorFinal = $contadorFinal + 1;
                }
            }
        }
        return redirect()->route('Aluno.vizualizarCurso',['IdAluno'=>$IdAluno,'IdCurso'=>$IdCurso]);
    }
}
