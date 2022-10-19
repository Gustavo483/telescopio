<?php

namespace App\Http\Controllers;

use App\Models\AlunoModel;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\CursoModel;


class AdminController extends Controller
{
    public function RegistrarAluno()
    {
        return view('Permisions.TelasAdmin.registrarAluno');
    }

    public function RegistrarProfessor()
    {
        return view('Permisions.TelasAdmin.registrarProfessor');
    }

    public function RegistrarAlunoStore(Request $request)
    {
        $validacao = [
            'name' => 'required',
            'email'=> 'required|email',
            'password'=> 'required',
        ];
        $feedback =[
            'required'=> 'O campo deve ser preenchido',
        ];
        $request->validate($validacao, $feedback);
        $curso = $request->all();
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'permision' => 1,
        ]);

        $DadosUser = User::orderBy('id', 'desc')->first();

        $arrayValues = [ $DadosUser->name,$DadosUser->id];

        AlunoModel::create([
            'st_nome_aluno' => $arrayValues[0],
            'fk_user' => $arrayValues[1] ,
            'st_estrelas_obtidas' => 0,
            'img_pet_selecionado' => 'Null'
        ]);
        return  redirect()->route('inicio.pagina');
    }

    public function RegistrarProfessorStore(Request $request)
    {
        $validacao = [
            'name' => 'required',
            'email'=> 'required|email',
            'password'=> 'required',
        ];
        $feedback =[
            'required'=> 'O campo deve ser preenchido',
        ];
        $request->validate($validacao, $feedback);
        $curso = $request->all();
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'permision' => 1,
        ]);

        $DadosUser = User::orderBy('id', 'desc')->first();

        $arrayValues = [ $DadosUser->name,$DadosUser->id];

        AlunoModel::create([
            'st_nome_aluno' => $arrayValues[0],
            'fk_user' => $arrayValues[1] ,
            'st_estrelas_obtidas' => 0,
            'img_pet_selecionado' => 'Null'
        ]);
        return  redirect()->route('inicio.pagina');
    }


    public function VincularAlunoCursoCreate()
    {
        $alunos = AlunoModel::all();
        $cursos = CursoModel::all();
        return view('Permisions.TelasAdmin.vincularCursoAluno', ['alunos'=>$alunos, 'cursos'=>$cursos]);
    }

    public function VincularAlunoCursoStore(Request $request)
    {
        $validacao = [
            'id_aluno' => 'required',
            'cursos'=> 'required',
        ];
        $feedback =[
            'id_aluno.required'=> 'O aluno deve ser preenchido.',
            'cursos.required'=> 'Pelo meno um curso deve ser preenchido.',
        ];
        $request->validate($validacao, $feedback);

        $dbAluno = AlunoModel::where('id', $request->id_aluno)->first();

        foreach ($request->cursos as $items) {
            $dbAluno->cursos()->attach($items);
        }

        $alunos = AlunoModel::all();
        $cursos = CursoModel::all();
        return view('Permisions.TelasAdmin.vincularCursoAluno', ['alunos'=>$alunos, 'cursos'=>$cursos]);
    }
    public function listarAlunosCursos()
    {
        $dados = AlunoModel::all();

        return view('Permisions.TelasAdmin.listarAlunosCursos', ['dados'=>$dados]);
        //var_dump($a->books);
    }
    public function deleteAlunoCurso($aluno, $curso)
    {

        $aluno = AlunoModel::where('id',$aluno )->first();
        $aluno->cursos()->detach($curso);

        $dados = AlunoModel::all();

        return view('Permisions.TelasAdmin.listarAlunosCursos', ['dados'=>$dados]);
    }
}


