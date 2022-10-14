<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CursoModel;
use App\Models\UnidadeModel;
use App\Models\ConteudoModel;

class UnidadeController extends Controller
{
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
            'st_nome_unidade.unique'=>'Este nome de unidade já consta no banco de dados',
            'required'=> 'O campo deve ser preenchido,',
        ];

        $request->validate($validacao, $feedback);
        $unidade = $request->all();
        UnidadeModel::create($unidade);
        $DadosUnidade = UnidadeModel::orderBy('id', 'desc')->first();
        return  redirect()->route('vizualizar.unidade',['unidade'=>$DadosUnidade]);

    }

    public function VincularCursoUnidade(Request $request)
    {
        $nomePadrao = $request->DadosParaSalvar;
        $pieces = explode("-and12897*-", $nomePadrao);
        $idCurso= $pieces[0];
        $idUnidade = $pieces[1];

        $DadosCurso = CursoModel::where('id', $idCurso)->first();
        $DadosCurso->unidades()->attach($idUnidade);

        return  redirect()->route('vizualizar.Curso',['curso'=>$idCurso]);
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



}
