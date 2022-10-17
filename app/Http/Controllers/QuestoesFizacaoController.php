<?php

namespace App\Http\Controllers;

use App\Models\ConteudoModel;
use Illuminate\Http\Request;
use App\Models\QuestoesFizacaoModel;

class QuestoesFizacaoController extends Controller
{
    public function vizualizarAtividadesfZ( $dadosconteudo)
    {
        $todasQuestoesConteudo = QuestoesFizacaoModel::where('fk_conteudo',$dadosconteudo)->get();
        return view('CadastrarAtividadesFizacao.VizualizarQuestoesFizacao',['todasQuestoesConteudo'=>$todasQuestoesConteudo,'dadosconteudo'=>$dadosconteudo]);
    }
    public function criarQuestaoFZ(ConteudoModel $dadosconteudo)
    {
        return view('CadastrarAtividadesFizacao.QuestaoFizacao',['dadosconteudo'=>$dadosconteudo]);
    }

    public function StoreQuestaoME(Request $request, ConteudoModel $dadosconteudo)
    {
        $validacao = [
            'st_pergunta' =>'required',
            'st_gabarito'=>'required',
            'st_resolusao'=>'required',
            'st_alternativa1'=>'required'
        ];
        $feedback =[
            'st_alternativa1.required'=>'deve ter ao mesmo uma questão cadastrada',
            'required'=> 'O campo deve ser preenchido,',
        ];
        $request->validate($validacao, $feedback);

        $questoes = new QuestoesFizacaoModel();
        $questoes->fk_conteudo = $dadosconteudo->id;
        $questoes->st_tipoDeQuestao = 'questaoME';
        $questoes->DadosBanca = $request->DadosBanca;
        $questoes->st_pergunta = $request->st_pergunta;
        $questoes->st_resolusao = $request->st_resolusao;
        $questoes->st_gabarito = $request->st_gabarito;
        $questoes->st_alternativa1 = $request->st_alternativa1;
        $questoes->st_alternativa2 = $request->st_alternativa2;
        $questoes->st_alternativa3 = $request->st_alternativa3;
        $questoes->st_alternativa4 = $request->st_alternativa4;
        $questoes->st_alternativa5 = $request->st_alternativa5;
        $questoes->save();
        return  redirect()->route('criarQuestaoFZ.conteudo',['dadosconteudo'=>$dadosconteudo]);
    }

    public function StoreQuestaoRN(Request $request, ConteudoModel $dadosconteudo)
    {
        $validacao = [
            'st_pergunta' =>'required',
            'st_respostaRN'=>'required',
            'st_resolusao'=>'required',
        ];

        $feedback =[
            'required'=> 'O campo deve ser preenchido,',
        ];
        $request->validate($validacao, $feedback);

        $questoes = new QuestoesFizacaoModel();
        $questoes->fk_conteudo = $dadosconteudo->id;
        $questoes->st_tipoDeQuestao = 'questaoRN';
        $questoes->DadosBanca = $request->DadosBanca;
        $questoes->st_gabarito = $request->st_respostaRN;
        $questoes->st_pergunta = $request->st_pergunta;
        $questoes->st_resolusao = $request->st_resolusao;
        $questoes->save();
        return  redirect()->route('criarQuestaoFZ.conteudo',['dadosconteudo'=>$dadosconteudo]);
    }
    public function StoreQuestaoRB(Request $request, ConteudoModel $dadosconteudo)
    {
        $validacao = [
            'st_pergunta' =>'required',
            'st_respostaRB'=>'required',
            'st_resolusao'=>'required',
        ];
        $feedback =[
            'required'=> 'O campo deve ser preenchido',
        ];
        $request->validate($validacao, $feedback);

        $questoes = new QuestoesFizacaoModel();
        $questoes->fk_conteudo = $dadosconteudo->id;
        $questoes->st_tipoDeQuestao = 'questaoRB';
        $questoes->DadosBanca = $request->DadosBanca;
        $questoes->st_gabarito = $request->st_respostaRB;
        $questoes->st_pergunta = $request->st_pergunta;
        $questoes->st_resolusao = $request->st_resolusao;
        $questoes->save();
        return  redirect()->route('criarQuestaoFZ.conteudo',['dadosconteudo'=>$dadosconteudo]);
    }

    public function EditarQuestaoConteudoME(QuestoesFizacaoModel $IDQuestao)
    {
        return view('CadastrarAtividadesFizacao.EditarQuestaoME',['Questao'=>$IDQuestao]);
    }

    public function EditarQuestaoConteudoRB(QuestoesFizacaoModel $IDQuestao)
    {
        return view('CadastrarAtividadesFizacao.EditarQuestaoRB',['Questao'=>$IDQuestao]);
    }

    public function EditarQuestaoConteudoRN(QuestoesFizacaoModel $IDQuestao)
    {
        return view('CadastrarAtividadesFizacao.EditarQuestaoRN',['Questao'=>$IDQuestao]);
    }

    public function updadeQuestaoME(Request $request,QuestoesFizacaoModel $IDQuestao)
    {
        $idConteudo = $IDQuestao->fk_conteudo;
        $validacao = [
            'st_pergunta' =>'required',
            'st_gabarito'=>'required',
            'st_resolusao'=>'required',
            'st_alternativa1'=>'required'
        ];
        $feedback =[
            'st_alternativa1.required'=>'deve ter ao mesmo uma questão cadastrada',
            'required'=> 'O campo deve ser preenchido,',
        ];
        $request->validate($validacao, $feedback);
        $IDQuestao->update($request->all());
        return  redirect()->route('vizualizar.TodasAtividadesFZ',['dadosconteudo'=>$idConteudo]);
    }
    public function updadeQuestaoRB(Request $request,QuestoesFizacaoModel $IDQuestao)
    {
        $idConteudo = $IDQuestao->fk_conteudo;
        $validacao = [
            'st_pergunta' =>'required',
            'st_gabarito'=>'required',
            'st_resolusao'=>'required',
        ];
        $feedback =[
            'required'=> 'O campo deve ser preenchido',
        ];
        $request->validate($validacao, $feedback);

        $IDQuestao->update($request->all());
        return  redirect()->route('vizualizar.TodasAtividadesFZ',['dadosconteudo'=>$idConteudo]);
    }

    public function updadeQuestaoRN(Request $request, QuestoesFizacaoModel $IDQuestao)
    {
        $idConteudo = $IDQuestao->fk_conteudo;
        $validacao = [
            'st_pergunta' =>'required',
            'st_gabarito'=>'required',
            'st_resolusao'=>'required',
        ];

        $feedback =[
            'required'=> 'O campo deve ser preenchido,',
        ];
        $request->validate($validacao, $feedback);
        $IDQuestao->update($request->all());
        return  redirect()->route('vizualizar.TodasAtividadesFZ',['dadosconteudo'=>$idConteudo]);

    }
    public function DeleteQuestaoConteudosdsd(QuestoesFizacaoModel $IDQuestao)
    {
        $dadosconteudo = $IDQuestao->fk_conteudo;
        $IDQuestao->delete();
        return  redirect()->route('vizualizar.TodasAtividadesFZ',['dadosconteudo'=>$dadosconteudo]);
    }
}
