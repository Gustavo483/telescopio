<?php

namespace App\Http\Controllers;

use App\Models\ConteudoModel;
use App\Models\CronogramaModel;
use Illuminate\Http\Request;

class CronogramaController extends Controller
{
    public function store(Request $request, ConteudoModel $dadosconteudo)
    {
        if ($request->TipoAtividade == "ConteudoEscrito"){
            $ordemAtividade = $request->st_ordem_apresentacao;
            return  view('CadastrarAtividades.CriarConteudoEscrito',['dadosconteudo'=>$dadosconteudo,'ordemApresentacao'=>$ordemAtividade]);
        }else{
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
        $idConteudo = $cronograma->fk_conteudo;
        $cronograma->delete();
        return  redirect()->route('vizualizar.conteudo',['conteudo'=>$idConteudo]);
    }
}
