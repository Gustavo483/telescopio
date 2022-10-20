<?php

namespace App\Http\Controllers;

use App\Models\ConteudoModel;
use Illuminate\Http\Request;
use App\Models\ProgressoModel;
use App\Models\CronogramaModel;


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
            return view('Permisions.TelasAluno.ApresentarTextoConteudo');
        }

        if($tipoAtividade == 'AtividadeFixacao'){
            return view('Permisions.TelasAluno.apresentarAtividadeFixacao');
        }

        if($tipoAtividade == 'testeConteudo'){
            return view('Permisions.TelasAluno.ApresentarTextoConteudo');
        }

        dd($IdAluno,$idConteudo,$IdCronograma,$tipoAtividade);
    }

}
