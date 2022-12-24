<?php

namespace App\Http\Controllers;

use App\Models\TarefasRevisaoModel;
use App\Models\TesteCursoModel;
use App\Models\TesteFinalModel;
use App\Models\TesteIntermediarioModel;
use Illuminate\Http\Request;

use App\Models\UnidadeModel;
use App\Models\ConteudoEscritoModel;
use App\Models\ConteudoModel;
use App\Models\CronogramaModel;
use App\Models\QuestoesFizacaoModel;
use App\Models\QuestoesModel;

class ConteudoController extends Controller
{
    public function store(Request $request, $idUnidade)
    {
        $validacao = [
            'st_nome_conteudo' =>'required',
        ];

        $feedback =[
            'required'=> 'O campo deve ser preenchido,',
        ];
        $request->validate($validacao, $feedback);
        $conteudo = new ConteudoModel();
        $conteudo->st_nome_conteudo = $request->st_nome_conteudo;
        $conteudo->fk_unidade = $idUnidade;
        $conteudo->save();
        return  back()->with('success', 'Conteudo Cadastrado Com Sucesso');
    }

    public function delete(ConteudoModel $conteudo)
    {
        $idUnidade = $conteudo->fk_unidade;
        $idconteudo= $conteudo->id;
        ConteudoEscritoModel::where('fk_conteudo',$idconteudo)->delete();
        QuestoesModel::where('fk_conteudo',$idconteudo)->delete();
        QuestoesFizacaoModel::where('fk_conteudo',$idconteudo)->delete();
        TesteCursoModel::where('fk_conteudo_pertencente',$idconteudo)->delete();
        TesteIntermediarioModel::where('fk_conteudo_pertencente',$idconteudo)->delete();
        TesteFinalModel::where('fk_conteudo_pertencente',$idconteudo)->delete();
        TesteCursoModel::where('fk_conteudo',$idconteudo)->delete();
        TesteIntermediarioModel::where('fk_conteudo',$idconteudo)->delete();
        TesteFinalModel::where('fk_conteudo',$idconteudo)->delete();
        TarefasRevisaoModel::where('fk_conteudo',$idconteudo)->delete();
        CronogramaModel::where('fk_conteudo',$idconteudo)->delete();
        $conteudo->delete();
        return  redirect()->route('vizualizar.unidade',['unidade'=>$idUnidade]);

    }

    public function  vizualizarConteudo(ConteudoModel $conteudo)
    {
        $quantidadeQuestoesME = count(QuestoesModel::where('fk_conteudo',$conteudo->id)->where('st_tipoDeQuestao','questaoME')->get());
        $quantidadeQuestoesRB = count(QuestoesModel::where('fk_conteudo',$conteudo->id)->where('st_tipoDeQuestao','questaoRB')->get());
        $quantidadeQuestoesRN = count(QuestoesModel::where('fk_conteudo',$conteudo->id)->where('st_tipoDeQuestao','questaoRN')->get());
        $quantidadeQuestoesFZ = count(QuestoesFizacaoModel::where('fk_conteudo',$conteudo->id)->get());
        $arayQuantidade = [$quantidadeQuestoesME,$quantidadeQuestoesRB,$quantidadeQuestoesRN,$quantidadeQuestoesFZ];
        $CronogramaDoConteudo = CronogramaModel::where('fk_conteudo',$conteudo->id)->orderBy('st_ordem_apresentacao')->get();
        return  view('cronograma.vizualizarCronograma',['dadosconteudo'=>$conteudo,'cronogramas'=>$CronogramaDoConteudo,'arayQuantidade'=>$arayQuantidade]);
    }
}
