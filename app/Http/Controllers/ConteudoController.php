<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConteudoModel;
use App\Models\UnidadeModel;
use App\Models\CronogramaModel;
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
        return  redirect()->route('vizualizar.unidade',['unidade'=>$idUnidade]);
    }

    public function delete(ConteudoModel $conteudo)
    {
        $idUnidade = $conteudo->fk_unidade;
        $conteudo->delete();

        return  redirect()->route('vizualizar.unidade',['unidade'=>$idUnidade]);
    }

    public function  vizualizarConteudo(ConteudoModel $conteudo)
    {
        $quantidadeQuestoesME = count(QuestoesModel::where('fk_conteudo',$conteudo->id)->where('st_tipoDeQuestao','questaoME')->get());
        $quantidadeQuestoesRB = count(QuestoesModel::where('fk_conteudo',$conteudo->id)->where('st_tipoDeQuestao','questaoRB')->get());
        $quantidadeQuestoesRN = count(QuestoesModel::where('fk_conteudo',$conteudo->id)->where('st_tipoDeQuestao','questaoRN')->get());
        $arayQuantidade = [$quantidadeQuestoesME,$quantidadeQuestoesRB,$quantidadeQuestoesRN];
        $CronogramaDoConteudo = CronogramaModel::where('fk_conteudo',$conteudo->id)->orderBy('st_ordem_apresentacao')->get();
        return  view('cronograma.vizualizarCronograma',['dadosconteudo'=>$conteudo,'cronogramas'=>$CronogramaDoConteudo,'arayQuantidade'=>$arayQuantidade]);
    }
}