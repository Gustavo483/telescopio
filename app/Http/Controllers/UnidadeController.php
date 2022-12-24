<?php

namespace App\Http\Controllers;

use App\Models\ConteudoEscritoModel;
use App\Models\CronogramaModel;
use App\Models\QuestoesFizacaoModel;
use App\Models\QuestoesModel;
use App\Models\TarefasRevisaoModel;
use App\Models\TesteCursoModel;
use App\Models\TesteFinalModel;
use App\Models\TesteIntermediarioModel;
use Illuminate\Http\Request;
use App\Models\CursoModel;
use App\Models\UnidadeModel;
use App\Models\ConteudoModel;

class UnidadeController extends Controller
{
    public function deletarUnidade(UnidadeModel $unidade)
    {
        if (count($unidade->cursos)> 0){
            return back()->with('error', 'A unidade está cadastrada em cursos vigentes. Exclua a unidade dos cursos para excluí-la definitivamente do sistema.');
        }
        if (count($unidade->cursos) == 0){
            if (count($unidade->conteudos) == 0){
                $unidade->delete();
                return back()->with('success', 'Unidade excluida com sucesso');
            }
            if (count($unidade->conteudos) > 0){
                return back()->with('error', 'Exclua os conteudos antes de excluir a unidade');
            }
        }
    }

    public function index()
    {
        $TodasUnidades = UnidadeModel::all();
        return view('unidade.index',['unidades'=>$TodasUnidades]);
    }
    public function store(Request $request)
    {
        $validacao = [
            'st_nome_unidade' =>'required|unique:tb_unidade',
        ];

        $feedback =[
            'st_nome_unidade.unique'=>'Este nome de unidade já consta no banco de dados.',
            'required'=> 'O campo deve ser preenchido.',
        ];

        $request->validate($validacao, $feedback);
        $unidade = $request->all();
        UnidadeModel::create($unidade);
        $DadosUnidade = UnidadeModel::orderBy('id', 'desc')->first();
        return  redirect()->route('vizualizar.unidade',['unidade'=>$DadosUnidade])->with('success','Unidade cadastrada com sucesso');

    }

    public function VincularCursoUnidade(Request $request)
    {
        $validacao = [
            'DadosParaSalvar' =>'required',
        ];

        $feedback =[
            'DadosParaSalvar.required'=>'O campo deve ser preenchido.',

        ];

        $request->validate($validacao, $feedback);

        $nomePadrao = $request->DadosParaSalvar;
        $pieces = explode("-and12897*-", $nomePadrao);
        $idCurso= $pieces[0];
        $idUnidade = $pieces[1];

        $DadosCurso = CursoModel::where('id', $idCurso)->first();
        $DadosCurso->unidades()->attach($idUnidade);

        return  back()->with('success','Unidade cadastrada ao curso com sucesso');
    }

    public function storeVinculacaoCurso(Request $request,$IDCurso)
    {
        $validacao = [
            'st_nome_unidade' =>'required|unique:tb_unidade',
        ];

        $feedback =[
            'st_nome_unidade.unique'=>'Este nome de unidade já consta no banco de dados',
            'required'=> 'O campo deve ser preenchido,',
        ];

        $request->validate($validacao, $feedback);
        $unidade = $request->all();
        UnidadeModel::create($unidade);
        $DadosUnidade = UnidadeModel::orderBy('id', 'desc')->first();
        $dadoview = $DadosUnidade->id;
        $DadosUnidade->cursos()->attach($IDCurso);

        return redirect()->route('vizualizar.unidade',['unidade'=>$dadoview]);

    }

    public function vizualizarUnidade(UnidadeModel $unidade)
    {
        $Fkunidade = $unidade->id;
        $ConteudosDaUnidade = ConteudoModel::where('fk_unidade',$Fkunidade)->get();
        return view('unidade.vizualizarUnidade',['unidade'=>$unidade,'conteudos'=>$ConteudosDaUnidade]);
    }
    public function atualizarUnidade(Request $request, UnidadeModel $unidade)
    {
        for($i = 0; $i < count($request->Ids); ++$i) {
            if ($request->st_nome_conteudo[$i] != null and $request->int_ordem_apresentacao[$i] != null){
                $conteudo = ConteudoModel::where('id',$request->Ids[$i])->first();
                $conteudo->update([
                    'st_nome_conteudo'=>$request->st_nome_conteudo[$i],
                    'int_ordem_apresentacao'=> $request->int_ordem_apresentacao[$i],
                ]);
            }
        }
        return redirect()->route('curso.index')->with('successe', 'Curso excuído com sucesso');
    }
}
