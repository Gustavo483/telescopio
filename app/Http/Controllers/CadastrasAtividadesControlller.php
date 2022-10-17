<?php

namespace App\Http\Controllers;

use App\Models\ConteudoModel;
use App\Models\QuestoesModel;
use App\Models\CronogramaModel;
use App\Models\ConteudoEscritoModel;
use Illuminate\Http\Request;

class CadastrasAtividadesControlller extends Controller
{

    public function criarQuestaoME(ConteudoModel $dadosconteudo)
    {

        return view('CadastrarAtividades.CriarQuestaoME',['dadosconteudo'=>$dadosconteudo]);
    }

    public function criarQuestaoRB(ConteudoModel $dadosconteudo)
    {
        return view('CadastrarAtividades.CriarQuestaoRB',['dadosconteudo'=>$dadosconteudo]);
    }

    public function criarQuestaoRN(ConteudoModel $dadosconteudo)
    {
        return view('CadastrarAtividades.CriarQuestaoRN',['dadosconteudo'=>$dadosconteudo]);
    }


    public function StoreConteudoEscrito(Request $request, ConteudoModel $dadosconteudo)
    {
        $validacao = [
            'st_texto' =>'required',

        ];

        $feedback =[
            'required'=> 'O campo deve ser preenchido',
        ];
        $request->validate($validacao, $feedback);

        $cronograma = new CronogramaModel();
        $cronograma->st_tipo_atividade = 'TEXTO';
        $cronograma->st_ordem_apresentacao = $request->st_ordem_apresentacao;
        $cronograma->fk_conteudo = $dadosconteudo->id;
        $cronograma->fk_unidade = $dadosconteudo->fk_unidade;
        $cronograma->save();
        $IDCronograma = CronogramaModel::orderBy('id', 'desc')->first();

        $NovoTexto = new ConteudoEscritoModel();
        $NovoTexto->fk_conteudo =$IDCronograma->fk_conteudo;
        $NovoTexto->fk_cronograma =$IDCronograma->id;
        $NovoTexto->st_texto = $request->st_texto;
        $NovoTexto->save();
        return  redirect()->route('vizualizar.conteudo',['conteudo'=>$dadosconteudo->id]);

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

        $questoes = new QuestoesModel();
        $questoes->fk_conteudo = $dadosconteudo->id;
        $questoes->st_tipoDeQuestao = 'questaoME';
        $questoes->st_pergunta = $request->st_pergunta;
        $questoes->st_resolusao = $request->st_resolusao;
        $questoes->st_gabarito = $request->st_gabarito;
        $questoes->st_alternativa1 = $request->st_alternativa1;
        $questoes->st_alternativa2 = $request->st_alternativa2;
        $questoes->st_alternativa3 = $request->st_alternativa3;
        $questoes->st_alternativa4 = $request->st_alternativa4;
        $questoes->st_alternativa5 = $request->st_alternativa5;
        $questoes->save();
        return  redirect()->route('criarQuestaoME.conteudo',['dadosconteudo'=>$dadosconteudo]);
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

        $questoes = new QuestoesModel();
        $questoes->fk_conteudo = $dadosconteudo->id;
        $questoes->st_tipoDeQuestao = 'questaoRN';
        $questoes->st_gabarito = 'Null';
        $questoes->st_respostaRN = $request->st_respostaRN;
        $questoes->st_pergunta = $request->st_pergunta;
        $questoes->st_resolusao = $request->st_resolusao;
        $questoes->save();

        return  redirect()->route('criarQuestaoRN.conteudo',['dadosconteudo'=>$dadosconteudo]);
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

        $questoes = new QuestoesModel();
        $questoes->fk_conteudo = $dadosconteudo->id;
        $questoes->st_tipoDeQuestao = 'questaoRB';
        $questoes->st_gabarito = 'Null';
        $questoes->st_respostaRB = $request->st_respostaRB;
        $questoes->st_pergunta = $request->st_pergunta;
        $questoes->st_resolusao = $request->st_resolusao;

        $questoes->save();

        return  redirect()->route('criarQuestaoRB.conteudo',['dadosconteudo'=>$dadosconteudo]);
    }
    public function vizualizarAtividadesCurso( $dadosconteudo)
    {
        $todasQuestoesConteudo = QuestoesModel::where('fk_conteudo',$dadosconteudo)->get();
        return view('CadastrarAtividades.VizualizarQuestoesConteudo',['todasQuestoesConteudo'=>$todasQuestoesConteudo,'dadosconteudo'=>$dadosconteudo]);
    }
    public function DeleteQuestaoConteudo(QuestoesModel $IDQuestao)
    {
        $dadosconteudo = $IDQuestao->fk_conteudo;
        $IDQuestao->delete();
        return  redirect()->route('vizualizar.TodasAtividades',['dadosconteudo'=>$dadosconteudo]);
    }

    public function EditarQuestaoConteudoME(QuestoesModel $IDQuestao)
    {
        return view('CadastrarAtividades.EditarQuestaoME',['Questao'=>$IDQuestao]);
    }

    public function EditarQuestaoConteudoRB(QuestoesModel $IDQuestao)
    {
        return view('CadastrarAtividades.EditarQuestaoRB',['Questao'=>$IDQuestao]);
    }

    public function EditarQuestaoConteudoRN(QuestoesModel $IDQuestao)
    {
        return view('CadastrarAtividades.EditarQuestaoRN',['Questao'=>$IDQuestao]);
    }

    public function updadeQuestaoME(Request $request,QuestoesModel $IDQuestao)
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
        return  redirect()->route('vizualizar.TodasAtividades',['dadosconteudo'=>$idConteudo]);
    }

    public function updadeQuestaoRB(Request $request,QuestoesModel $IDQuestao)
    {
        $idConteudo = $IDQuestao->fk_conteudo;
        $validacao = [
            'st_pergunta' =>'required',
            'st_respostaRB'=>'required',
            'st_resolusao'=>'required',
        ];
        $feedback =[
            'required'=> 'O campo deve ser preenchido',
        ];
        $request->validate($validacao, $feedback);

        $IDQuestao->update($request->all());
        return  redirect()->route('vizualizar.TodasAtividades',['dadosconteudo'=>$idConteudo]);
    }

    public function updadeQuestaoRN(Request $request, QuestoesModel $IDQuestao)
    {
        $idConteudo = $IDQuestao->fk_conteudo;
        $validacao = [
            'st_pergunta' =>'required',
            'st_respostaRN'=>'required',
            'st_resolusao'=>'required',
        ];

        $feedback =[
            'required'=> 'O campo deve ser preenchido,',
        ];
        $request->validate($validacao, $feedback);
        $IDQuestao->update($request->all());
        return  redirect()->route('vizualizar.TodasAtividades',['dadosconteudo'=>$idConteudo]);


    }

}
