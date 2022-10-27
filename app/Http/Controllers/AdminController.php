<?php

namespace App\Http\Controllers;

use App\Models\AlunoModel;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\CursoModel;
use App\Models\ConteudoModel;
use App\Models\CronogramaModel;
use App\Models\ProgressoModel;

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
        //código que esta funcionando para o cadastro de alunos nos cursos
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

        foreach ($request->cursos as $curso) {
            $dbAluno->cursos()->attach($curso);
        }

        // Código para teste da tabela de cronograma

        $Aluno = AlunoModel::find($request->id_aluno);

        foreach ($request->cursos as $IDcurso) {
            $curso = CursoModel::find($IDcurso);
            foreach ($curso->unidades as $idUnidade){
                $conteudos = ConteudoModel::where('fk_unidade',$idUnidade->id)->get();
                foreach ( $conteudos as $conteudo) {
                    $dadosCronograma = CronogramaModel::where('fk_conteudo',$conteudo->id)->get();
                    $totalAtiviadesConteudo = count($dadosCronograma);
                    $arrayIntermediatio = [$Aluno->id,$curso->id,$idUnidade->id,$conteudo->id,$totalAtiviadesConteudo];
                    ProgressoModel::create([
                        'fk_aluno' => $Aluno->id,
                        'fk_unidade' => $idUnidade->id,
                        'fk_curso' =>$curso->id ,
                        'fk_conteudo' => $conteudo->id,
                        'int_count_atividade' => $totalAtiviadesConteudo,
                        'int_submit_atividades' => 0,
                        'int_estrela_obtida' => 0
                    ]);
                }
            }
        }
        //redirect para a roda de vincular aluno e curso
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
        $dadosProgresso = ProgressoModel::where('fk_aluno', $aluno)->where('fk_curso', $curso)->get();
        //excluir dados da tabela de progresso quando o curso é excluido da base de dados.
        foreach ($dadosProgresso as $progresso){
            $progresso->delete();
        }
        $aluno = AlunoModel::where('id',$aluno )->first();
        $aluno->cursos()->detach($curso);


        $dados = AlunoModel::all();
        return view('Permisions.TelasAdmin.listarAlunosCursos', ['dados'=>$dados]);
    }
}


