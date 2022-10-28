<?php

namespace App\Http\Controllers;

use App\Models\ConteudoModel;
use App\Models\CronogramaModel;
use App\Models\ConteudoEscritoModel;
use App\Models\CursoModel;
use App\Models\TesteFinalModel;
use App\Models\TesteCursoModel;
use App\Models\TesteIntermediarioModel;
use App\Models\QuestoesFizacaoModel;
use Illuminate\Http\Request;


class CronogramaController extends Controller
{
    public function store(Request $request, ConteudoModel $dadosconteudo)
    {
        if ($request->TipoAtividade == "ConteudoEscrito"){
            $ordemAtividade = $request->st_ordem_apresentacao;
            return  view('CadastrarAtividades.CriarConteudoEscrito',['dadosconteudo'=>$dadosconteudo,'ordemApresentacao'=>$ordemAtividade]);
        }
        if($request->TipoAtividade == "TesteIntermediario"){
            $idUnidade = $dadosconteudo->fk_unidade;
            $todosConteudos = ConteudoModel::where('fk_unidade', $idUnidade)->where('id','!=',$dadosconteudo->id)->get();
            return  view('CadastrarAtividades.CriarTesteIntermediario',['todosConteudo'=>$todosConteudos,'dadosconteudo'=>$dadosconteudo]);
        }
        if($request->TipoAtividade == "testeFinalUnidade"){
            $idUnidade = $dadosconteudo->fk_unidade;
            $todosConteudos = ConteudoModel::where('fk_unidade', $idUnidade)->where('id','!=',$dadosconteudo->id)->get();
            return  view('CadastrarAtividades.CriartesteFinalUnidade',['todosConteudo'=>$todosConteudos,'dadosconteudo'=>$dadosconteudo]);
        }

        if($request->TipoAtividade == "testeFinalCurso"){
            $todosCursos = CursoModel::all();
            return  view('CadastrarAtividades.CriartesteFinalCurso',['todosCursos'=>$todosCursos,'dadosconteudo'=>$dadosconteudo]);
        }

        else{
            $validacao = [
                'st_ordem_apresentacao' =>'required|max:2',
            ];

            $feedback =[
                'required'=> 'O campo deve ser preenchido,',
                'max'=>'O campo deve ter no máximo 2 caracteres'
            ];

            $request->validate($validacao, $feedback);
            $cronograma = new CronogramaModel();
            $cronograma->st_tipo_atividade = $request->TipoAtividade;
            $cronograma->st_ordem_apresentacao = $request->st_ordem_apresentacao;
            $cronograma->fk_conteudo = $dadosconteudo->id;
            $cronograma->fk_unidade = $dadosconteudo->fk_unidade;
            $cronograma->save();
            return  redirect()->route('vizualizar.conteudo',['conteudo'=>$dadosconteudo->id]);
        }
    }
    public function deleteatividadeCronograma(CronogramaModel $cronograma)
    {
        if($cronograma->st_tipo_atividade == 'TEXTO'){
            ConteudoEscritoModel::where('fk_cronograma',$cronograma->id)->delete();
            $idConteudo = $cronograma->fk_conteudo;
            $cronograma->delete();
            return  redirect()->route('vizualizar.conteudo',['conteudo'=>$idConteudo]);
        }
        if($cronograma->st_tipo_atividade == 'Teste Final'){
            TesteFinalModel::where('fk_conteudo_pertencente',$cronograma->fk_conteudo)->delete();
            $idConteudo = $cronograma->fk_conteudo;
            $cronograma->delete();
            return  redirect()->route('vizualizar.conteudo',['conteudo'=>$idConteudo]);
        }
        if($cronograma->st_tipo_atividade == 'Teste Intermediario'){
            TesteIntermediarioModel::where('fk_conteudo_pertencente',$cronograma->fk_conteudo)->delete();
            $idConteudo = $cronograma->fk_conteudo;
            $cronograma->delete();
            return  redirect()->route('vizualizar.conteudo',['conteudo'=>$idConteudo]);
        }
        if($cronograma->st_tipo_atividade == 'AtividadeFixacao'){
            QuestoesFizacaoModel::where('fk_conteudo',$cronograma->fk_conteudo)->delete();
            $idConteudo = $cronograma->fk_conteudo;
            $cronograma->delete();
            return  redirect()->route('vizualizar.conteudo',['conteudo'=>$idConteudo]);
        }

        if($cronograma->st_tipo_atividade == 'Teste Final Conteudo'){
            $dados = TesteCursoModel::where('fk_conteudo_pertencente',$cronograma->fk_conteudo)->delete();
            $idConteudo = $cronograma->fk_conteudo;
            $cronograma->delete();
            return  redirect()->route('vizualizar.conteudo',['conteudo'=>$idConteudo]);
        }

        else{
            $idConteudo = $cronograma->fk_conteudo;
            $cronograma->delete();
            return  redirect()->route('vizualizar.conteudo',['conteudo'=>$idConteudo]);
        }
    }
}
