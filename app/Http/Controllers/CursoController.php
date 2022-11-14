<?php

namespace App\Http\Controllers;

use App\Models\CursoModel;
use App\Models\UnidadeModel;
use App\Models\DisciplinaModel;
use Illuminate\Http\Request;

class CursoController extends Controller
{

    public function index(Request $request)
    {
        $cursos = CursoModel::all();
        $DisciplinasCadastradas = DisciplinaModel::all();
        return view('curso.index',['DisciplinasCadastradas'=>$DisciplinasCadastradas,'cursos'=>$cursos,'request'=>$request->all()]);
    }
    public function SalvarNovaDisciplina(Request $request)
    {
        $validacao = [
            'st_nome_disciplinas' =>'required',
        ];
        $feedback =[
            'st_nome_disciplinas.required'=> 'O campo do nome da disciplina deve ser preenchido',
        ];
        $request->validate($validacao, $feedback);
        $curso = $request->all();
        CursoModel::create($curso);
        return  redirect()->route('curso.index');
    }
    public function store(Request $request)
    {
        $validacao = [
            'st_nome_curso' =>'required|unique:tb_curso',
            'st_nome_disciplinas' =>'required',
        ];
        $feedback =[
            'st_nome_curso.unique'=>'Este nome de curso já consta no banco de dados',
            'st_nome_curso.required'=> 'O campo do nome do curso deve ser preenchido',
            'st_nome_disciplinas.required'=> 'O campo do nome da disciplina deve ser preenchido',
        ];
        $request->validate($validacao, $feedback);
        $curso = $request->all();
        CursoModel::create($curso);
        return  redirect()->route('curso.index');
    }

    public function vizualizarCurso($curso)
    {
        $user = CursoModel::where('id', $curso)->first();
        $teste = count($user->unidades);
        if ($teste != 0) {
            $aray = [];
            foreach ($user->unidades as $role) {
                $valor = $role->pivot->fk_unidade;
                array_push($aray, $valor);
            }
            $UnidadesPertencenteAoCurso = UnidadeModel::whereIn('id', $aray)->get();
            $TodasUnidadeSistema = UnidadeModel::all();
            return view('curso.visualizarCurso', ['Unidades' => $UnidadesPertencenteAoCurso, 'NomeCurso12' => $user, 'todasUnidades' => $TodasUnidadeSistema]);

        }else{
            $UnidadesPertencenteAoCurso = 'nenhum curso cadastrado';
            $TodasUnidadeSistema = UnidadeModel::all();
            return view('curso.visualizarCurso', ['Unidades' => $UnidadesPertencenteAoCurso, 'NomeCurso12' => $user, 'todasUnidades' => $TodasUnidadeSistema]);
        }

    }
    public function excluirUnidadeDoCurso( $UnidadeId,$CursoId)
    {
        $curso = CursoModel::where('id',$CursoId )->first();
        $curso->unidades()->detach($UnidadeId);
        return  redirect()->route('vizualizar.Curso',['curso'=>$CursoId]);
    }
}
