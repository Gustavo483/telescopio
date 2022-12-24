<?php

namespace App\Http\Controllers;

use App\Models\CursoModel;
use App\Models\CursosConcluidosModel;
use App\Models\ProgressoModel;
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
            'st_nome_disciplina1' =>'required',
        ];
        $feedback =[
            'st_nome_disciplina1.required'=> 'O nome da disciplina deve ser preenchido',
        ];
        $request->validate($validacao, $feedback);
        $curso = $request->all();

        DisciplinaModel::create([
            'st_nome_disciplina'=>$request->st_nome_disciplina1,
        ]);

        return back()->with('success','Disciplina cadastrada com sucesso');
    }

    public function store(Request $request)
    {
        $validacao = [
            'st_nome_curso' =>'required|unique:tb_curso',
            'st_nome_disciplina' =>'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        $feedback =[
            'image'=>'Selecione uma imagem',
            'st_nome_curso.unique'=>'Este nome de curso já consta no banco de dados',
            'st_nome_curso.required'=> 'O campo do nome do curso deve ser preenchido',
            'st_nome_disciplina.required'=> 'O campo do nome da disciplina deve ser preenchido',
        ];
        $request->validate($validacao, $feedback);

        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('images'), $imageName);
        CursoModel::create(
            [
                'st_nome_curso'=>$request->st_nome_curso,
                'st_nome_disciplinas'=>$request->st_nome_disciplina,
                'image'=>$imageName,
            ]
        );

        return back()->with('success','Curso cadastrado com sucesso');
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
            return view('curso.visualizarCurso', ['IdUnidadesCadastradas'=>$aray,'Unidades' => $UnidadesPertencenteAoCurso, 'NomeCurso' => $user, 'todasUnidades' => $TodasUnidadeSistema]);

        }

        else{
            $aray = [0];
            $UnidadesPertencenteAoCurso = 'nenhum curso cadastrado';
            $TodasUnidadeSistema = UnidadeModel::all();
            return view('curso.visualizarCursovisualizarCurso', ['IdUnidadesCadastradas'=>$aray,'Unidades' => $UnidadesPertencenteAoCurso, 'NomeCurso' => $user, 'todasUnidades' => $TodasUnidadeSistema]);
        }

    }
    public function excluirUnidadeDoCurso( $UnidadeId,$CursoId)
    {
        $curso = CursoModel::where('id',$CursoId )->first();
        $curso->unidades()->detach($UnidadeId);
        return  redirect()->route('vizualizar.Curso',['curso'=>$CursoId]);
    }
    public function ExcluirCurso(CursoModel $curso)
    {

        foreach ($curso->alunos as $aluno){
            $curso->alunos()->detach($aluno);
        }

        foreach ($curso->professores as $professor){
            $curso->professores()->detach($professor);
        }

        foreach ($curso->unidades as $unidades){
            $curso->unidades()->detach($unidades);
        }

        foreach ($curso->progressos as $progresso){
            $progresso->delete();
        }

        foreach ($curso->TarefasRevisao as $tarefa){
            $tarefa->delete();
        }
        foreach ($curso->HistoricoNotas as $historico){
            $historico->delete();
        }
        CursosConcluidosModel::where('fk_curso',$curso->id)->delete();
        $curso->delete();
        return back()->with('success','Curso excluido com sucesso');
    }
}
