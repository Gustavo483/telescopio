<?php

namespace App\Http\Controllers;

use App\Models\ConteudoModel;
use App\Models\CursoModel;
use App\Models\QuestoesModel;
use App\Models\CronogramaModel;
use App\Models\ConteudoEscritoModel;
use App\Models\TesteCursoModel;
use App\Models\TesteIntermediarioModel;
use App\Models\TesteFinalModel;
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
        return  redirect()->route('criarQuestaoME.conteudo',['dadosconteudo'=>$dadosconteudo]);
    }

    public function StoreQuestaoRN(Request $request, ConteudoModel $dadosconteudo)
    {
        $validacao = [
            'st_pergunta' =>'required',
            'st_gabarito'=>'required',
            'st_resolusao'=>'required',
        ];

        $feedback =[
            'required'=> 'O campo deve ser preenchido,',
        ];
        $request->validate($validacao, $feedback);

        $questoes = new QuestoesModel();
        $questoes->fk_conteudo = $dadosconteudo->id;
        $questoes->DadosBanca = $request->DadosBanca;
        $questoes->st_tipoDeQuestao = 'questaoRN';
        $questoes->st_gabarito = $request->st_gabarito;
        $questoes->st_pergunta = $request->st_pergunta;
        $questoes->st_resolusao = $request->st_resolusao;
        $questoes->save();

        return  redirect()->route('criarQuestaoRN.conteudo',['dadosconteudo'=>$dadosconteudo]);
    }

    public function StoreQuestaoRB(Request $request, ConteudoModel $dadosconteudo)
    {
        $validacao = [
            'st_pergunta' =>'required',
            'st_gabarito'=>'required',
            'st_resolusao'=>'required',
        ];
        $feedback =[
            'required'=> 'O campo deve ser preenchido',
        ];
        $request->validate($validacao, $feedback);

        $questoes = new QuestoesModel();
        $questoes->fk_conteudo = $dadosconteudo->id;
        $questoes->st_tipoDeQuestao = 'questaoRB';
        $questoes->st_gabarito = $request->st_gabarito;
        $questoes->DadosBanca = $request->DadosBanca;
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
            'st_gabarito'=>'required',
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
            'st_gabarito'=>'required',
            'st_resolusao'=>'required',
        ];

        $feedback =[
            'required'=> 'O campo deve ser preenchido,',
        ];
        $request->validate($validacao, $feedback);
        $IDQuestao->update($request->all());
        return  redirect()->route('vizualizar.TodasAtividades',['dadosconteudo'=>$idConteudo]);


    }

    public function StoreTesteFina(Request $request, ConteudoModel $dadosconteudo)
    {
        //Criando o cronogroma para apresentar a atividade
        $cronograma = new CronogramaModel();
        $cronograma->st_tipo_atividade = 'Teste Final';
        $cronograma->st_ordem_apresentacao = 1;
        $cronograma->fk_conteudo = $dadosconteudo->id;
        $cronograma->fk_unidade = $dadosconteudo->fk_unidade;
        $cronograma->save();

        $SubmitTotal = count($request->cursos);
        $contador = 0;
        while (true){
           if ($contador != $SubmitTotal ){
               if ($request->valores[$contador] != null){
                   $testeFinal = new TesteFinalModel();
                   $testeFinal->fk_conteudo_pertencente = $dadosconteudo->id;
                   $testeFinal->fk_conteudo = $request->cursos[$contador];
                   $testeFinal->totalQuestao = $request->valores[$contador];
                   $testeFinal->save();
               }
               $contador = $contador + 1;
           }else{
               break;
           }
        }
        $dadosAtividades = TesteFinalModel::where('fk_conteudo_pertencente',$dadosconteudo->id)->get();
        return view('CadastrarAtividades.VizualizarTesteFinalUnidade', ['dados'=>$dadosAtividades]);

    }
    public function vizualizarTesteFinalUnidade(ConteudoModel $dadosconteudo)
    {
        $dadosAtividades = TesteFinalModel::where('fk_conteudo_pertencente',$dadosconteudo->id)->get();
        return view('CadastrarAtividades.VizualizarTesteFinalUnidade', ['dados'=>$dadosAtividades]);
    }

    public function ExcluirUnidadeTesteFinal(TesteFinalModel $IDexclusao, $dadosconteudo)
    {
        $IDexclusao->delete();
        $dadosAtividades = TesteFinalModel::where('fk_conteudo_pertencente',$dadosconteudo)->get();
        return view('CadastrarAtividades.VizualizarTesteFinalUnidade', ['dados'=>$dadosAtividades]);
    }
    public function EditarTesteFinal(ConteudoModel $dadosconteudo)
    {

        $dadosPreenchidos = TesteFinalModel::where('fk_conteudo_pertencente', $dadosconteudo->id)->get();
        $todosConteudo = ConteudoModel::where('fk_unidade',$dadosconteudo->fk_unidade )->where('id','!=',$dadosconteudo->id)->get();
        return view('CadastrarAtividades.EditarTesteFinalUnidade', ['todosConteudo'=>$todosConteudo, 'DadosPreenchidos'=>$dadosPreenchidos, 'dadosconteudo'=>$dadosconteudo]);
    }
    public function UpdateTesteFina(Request $request, ConteudoModel $dadosconteudo)
    {
        $dados = TesteFinalModel::where('fk_conteudo_pertencente',$dadosconteudo->id)->get();
        $SubmitTotal = count($request->cursos);

        foreach ($dados as $dado){
            $dado->delete();
        }
        $contador = 0;
        while (true){
            if ($contador != $SubmitTotal ){
                if ($request->valores[$contador] != null){
                    $testeFinal = new TesteFinalModel();
                    $testeFinal->fk_conteudo_pertencente = $dadosconteudo->id;
                    $testeFinal->fk_conteudo = $request->cursos[$contador];
                    $testeFinal->totalQuestao = $request->valores[$contador];
                    $testeFinal->save();
                }
                $contador = $contador + 1;
            }else{
                break;
            }
        }
        $dadosAtividades = TesteFinalModel::where('fk_conteudo_pertencente',$dadosconteudo->id)->get();
        return view('CadastrarAtividades.VizualizarTesteFinalUnidade', ['dados'=>$dadosAtividades]);
    }




    public function StoreTesteIntermediario(Request $request, ConteudoModel $dadosconteudo)
    {

        //Criando o cronogroma para apresentar a atividade
        $cronograma = new CronogramaModel();
        $cronograma->st_tipo_atividade = 'Teste Intermediario';
        $cronograma->st_ordem_apresentacao = 1;
        $cronograma->fk_conteudo = $dadosconteudo->id;
        $cronograma->fk_unidade = $dadosconteudo->fk_unidade;
        $cronograma->save();

        $SubmitTotal = count($request->cursos);
        $contador = 0;
        while (true){
            if ($contador != $SubmitTotal ){
                if ($request->valores[$contador] != null){
                    $testeFinal = new TesteIntermediarioModel();
                    $testeFinal->fk_conteudo_pertencente = $dadosconteudo->id;
                    $testeFinal->fk_conteudo = $request->cursos[$contador];
                    $testeFinal->totalQuestao = $request->valores[$contador];
                    $testeFinal->save();
                }
                $contador = $contador + 1;
            }else{
                break;
            }
        }
        $dadosAtividades = TesteIntermediarioModel::where('fk_conteudo_pertencente',$dadosconteudo->id)->get();
        return view('CadastrarAtividades.VizualizarTesteIntermediarioUnidade', ['dados'=>$dadosAtividades]);

    }
    public function vizualizarTesteIntermediarioUnidade(ConteudoModel $dadosconteudo)
    {
        $dadosAtividades = TesteIntermediarioModel::where('fk_conteudo_pertencente',$dadosconteudo->id)->get();
        return view('CadastrarAtividades.VizualizarTesteIntermediarioUnidade', ['dados'=>$dadosAtividades]);
    }

    public function ExcluirUnidadeTesteIntermediario(TesteIntermediarioModel $IDexclusao, $dadosconteudo)
    {
        $IDexclusao->delete();
        $dadosAtividades = TesteIntermediarioModel::where('fk_conteudo_pertencente',$dadosconteudo)->get();
        return view('CadastrarAtividades.VizualizarTesteIntermediarioUnidade', ['dados'=>$dadosAtividades]);
    }
    public function EditarTesteIntermediario(ConteudoModel $dadosconteudo)
    {

        $dadosPreenchidos = TesteIntermediarioModel::where('fk_conteudo_pertencente', $dadosconteudo->id)->get();
        $todosConteudo = ConteudoModel::where('fk_unidade',$dadosconteudo->fk_unidade )->where('id','!=',$dadosconteudo->id)->get();
        return view('CadastrarAtividades.EditarTesteIntermediarioUnidade', ['todosConteudo'=>$todosConteudo, 'DadosPreenchidos'=>$dadosPreenchidos, 'dadosconteudo'=>$dadosconteudo]);
    }
    public function UpdateTesteIntermediario(Request $request, ConteudoModel $dadosconteudo)
    {
        $dados = TesteIntermediarioModel::where('fk_conteudo_pertencente',$dadosconteudo->id)->get();
        $SubmitTotal = count($request->cursos);

        foreach ($dados as $dado){
            $dado->delete();
        }
        $contador = 0;
        while (true){
            if ($contador != $SubmitTotal ){
                if ($request->valores[$contador] != null){
                    $testeFinal = new TesteIntermediarioModel();
                    $testeFinal->fk_conteudo_pertencente = $dadosconteudo->id;
                    $testeFinal->fk_conteudo = $request->cursos[$contador];
                    $testeFinal->totalQuestao = $request->valores[$contador];
                    $testeFinal->save();
                }
                $contador = $contador + 1;
            }else{
                break;
            }
        }
        $dadosAtividades = TesteIntermediarioModel::where('fk_conteudo_pertencente',$dadosconteudo->id)->get();
        return view('CadastrarAtividades.VizualizarTesteIntermediarioUnidade', ['dados'=>$dadosAtividades]);
    }

    public function TesteFinalCursoIndex(Request $request,$dadosconteudo)
    {
        $validacao = [
            'dado' =>'required',
        ];

        $feedback =[
            'required'=> 'O campo deve ser preenchido,',
        ];

        $request->validate($validacao, $feedback);
        $IDCurso = $request->dado;
        $dadosCurso = CursoModel::where('id',$IDCurso)->first();
        $dados = $dadosCurso->unidades;
        $ArrayIDUnidades = [];
        foreach ($dados as $dado){
            array_push($ArrayIDUnidades,$dado->id);
        }
        $Conteudos = ConteudoModel::wherein('fk_unidade', $ArrayIDUnidades)->where('id','!=', $dadosconteudo)->get();

       return view('CadastrarAtividades.CadastrarConteudosTesteCurso', ['dadosconteudo'=>$dadosconteudo,'Conteudos'=>$Conteudos, 'IDCurso'=> $IDCurso]);
    }
    public function StoreTesteFinalCurso(Request $request,ConteudoModel $dadosconteudo, $IDCurso)
    {
        //Criando o cronogroma para apresentar a atividade
        $cronograma = new CronogramaModel();
        $cronograma->st_tipo_atividade = 'Teste Final Conteudo';
        $cronograma->st_ordem_apresentacao = 1;
        $cronograma->fk_conteudo = $dadosconteudo->id;
        $cronograma->fk_unidade = $dadosconteudo->fk_unidade;
        $cronograma->save();

        $SubmitTotal = count($request->conteudos);
        $contador = 0;
        while (true){
            if ($contador != $SubmitTotal ){
                if ($request->valores[$contador] != null){
                    $testeFinal = new TesteCursoModel();
                    $testeFinal->fk_conteudo_pertencente = $dadosconteudo->id;
                    $testeFinal->fk_curso  = $IDCurso;
                    $testeFinal->fk_conteudo = $request->conteudos[$contador];
                    $testeFinal->totalQuestao = $request->valores[$contador];
                    $testeFinal->save();
                }
                $contador = $contador + 1;
            }else{
                break;
            }
        }
        $dadosAtividades = TesteCursoModel::where('fk_curso',$IDCurso)->get();
        return view('CadastrarAtividades.VizualizarTesteFinalCurso', ['dados'=>$dadosAtividades]);
    }
    public function ExcluirUnidadeTesteFinalCurso(TesteCursoModel $IDexclusao)
    {
        $IDCurso = $IDexclusao->fk_curso;
        $IDexclusao->delete();
        $dadosAtividades = TesteCursoModel::where('fk_curso',$IDCurso)->get();
        return view('CadastrarAtividades.VizualizarTesteFinalCurso', ['dados'=>$dadosAtividades]);
    }

    public function vizualizarTesteFinalCurso($dadosconteudo)
    {
        $dadosAtividades = TesteCursoModel::where('fk_conteudo_pertencente',$dadosconteudo)->get();
        return view('CadastrarAtividades.VizualizarTesteFinalCurso', ['dados'=>$dadosAtividades]);
    }

    public function EditarTesteFinalCurso(ConteudoModel $dadosconteudo, $fkCurso)
    {
        $dadosCurso = CursoModel::where('id',$fkCurso)->first();
        $dados = $dadosCurso->unidades;
        $ArrayIDUnidades = [];
        foreach ($dados as $dado){
            array_push($ArrayIDUnidades,$dado->id);
        }

        $todosConteudo = ConteudoModel::wherein('fk_unidade', $ArrayIDUnidades)->where('id','!=', $dadosconteudo)->get();
        $dadosPreenchidos = TesteCursoModel::where('fk_conteudo_pertencente', $dadosconteudo->id)->get();

        return view('CadastrarAtividades.EditarTesteFinalCurso', ['dadosconteudo'=>$dadosconteudo,'todosConteudo'=>$todosConteudo,'dadosPreenchidos'=>$dadosPreenchidos,'IDCurso'=>$fkCurso]);

    }
    public function updateTesteFinalCurso(Request $request,ConteudoModel $dadosconteudo, $IDCurso)
    {
        $dados = TesteCursoModel::where('fk_conteudo_pertencente',$dadosconteudo->id)->delete();

        $SubmitTotal = count($request->cursos);
        $contador = 0;

        while (true){
            if ($contador != $SubmitTotal ){
                if ($request->valores[$contador] != null){
                    $testeFinal = new TesteCursoModel();
                    $testeFinal->fk_curso = $IDCurso;
                    $testeFinal->fk_conteudo_pertencente = $dadosconteudo->id;
                    $testeFinal->fk_conteudo = $request->cursos[$contador];
                    $testeFinal->totalQuestao = $request->valores[$contador];
                    $testeFinal->save();
                }
                $contador = $contador + 1;
            }else{
                break;
            }
        }
        //$dadosAtividades = TesteFinalModel::where('fk_conteudo_pertencente',$dadosconteudo->id)->get();
        return  redirect()->route('vizualizar.TesteFinalCurso',['dadosconteudo'=>$dadosconteudo->id]);
    }
}
