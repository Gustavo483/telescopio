<?php

namespace App\Http\Controllers;

use App\Models\AlunoModel;
use App\Models\ConquistasAlunoModel;
use App\Models\HistoricoNotasAluno;
use App\Models\PetsModel;
use App\Models\RevisaoModel;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\CursoModel;
use App\Models\ConteudoModel;
use App\Models\CronogramaModel;
use App\Models\ProgressoModel;
use App\Models\ProfessorModel;
use App\Models\TrofeusModel;
use App\Models\DisciplinaModel;

class AdminController extends Controller
{
    public function revisaoForma()
    {
        $Revisao = RevisaoModel::first();
        return view('Permisions.TelasAdmin.AuterarRevisao', ['Revisao'=>$Revisao]);
    }
    public function CadastrarFormadeRevisao(Request $request,RevisaoModel $revisao)
    {
        $validacao = [
            'ordemCursoApresentar' => 'required',
            'NumerosQuestao' => 'required',
        ];
        $feedback =[
            'required'=> 'O campo deve ser preenchido',
        ];
        $request->validate($validacao, $feedback);
        $revisao->update(
            [
                'ordemCursoApresentar'=>$request->ordemCursoApresentar,
                'NumerosQuestao'=>$request->NumerosQuestao,
            ]
        );
        return back()
            ->with('success','Dados Salvos com Sucesso');
    }

    public function UpdadePet(Request $request, PetsModel $Pet)
    {

        if(isset($request->image)){
            $imageName = time().'.'.$request->image->extension();

            $request->image->move(public_path('images'), $imageName);

            $Pet->update(
                [
                    'st_nome_pet'=>$request->st_nome_pet,
                    'int_estrelas_paraComprar'=>$request->int_estrelas_paraComprar,
                    'image'=>$imageName,
                ]
            );
        }
        if (!isset($request->image)){
            $Pet->update($request->all());
        }
        return redirect()->route('vizualizarPets');
    }
    public function EditarPet(PetsModel $Pet)
    {
        return view('Permisions.TelasAdmin.EditarPets',['Pet'=>$Pet]);
    }

    public function DeletePet(PetsModel $Pet)
    {

        $alunosComEssePet = $Pet->alunos;
        foreach ($alunosComEssePet as $dado){
            $Pet->alunos()->detach($dado->id);
        }

        $Pet->delete();
        return redirect()->route('vizualizarPets');
    }
    public function vizualizarPets()
    {
        $Pets = PetsModel::all();
        return view('Permisions.TelasAdmin.VizualizarPets',['Pets'=>$Pets]);
    }

    public function CadastrarPet(Request $request)
    {
        $validacao = [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'st_nome_pet' => 'required',
            'int_estrelas_paraComprar'=> 'required',
        ];
        $feedback =[
            'required'=> 'O campo deve ser preenchido',
        ];
        $request->validate($validacao, $feedback);

        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('images'), $imageName);

        PetsModel::create(
            [
                'st_nome_pet'=>$request->st_nome_pet,
                'int_estrelas_paraComprar'=>$request->int_estrelas_paraComprar,
                'image'=>$imageName,
            ]
        );
        /*
            Write Code Here for
            Store $imageName name in DATABASE from HERE
        */

        return back()
            ->with('success','Arquivos Salvos com Sucesso');

    }


    public function UpdadeTroveu(Request $request,TrofeusModel $trofeu )
    {
        if(isset($request->image)){
            $imageName = time().'.'.$request->image->extension();

            $request->image->move(public_path('images'), $imageName);

            $trofeu->update(
                [
                    'fk_disciplina'=>$request->fk_disciplina,
                    'st_nome_trofeu'=>$request->st_nome_trofeu,
                    'int_total_atividades'=>$request->int_total_atividades,
                    'st_caminho_img'=>$imageName,
                ]
            );
        }
        if (!isset($request->image)){
            $trofeu->update($request->all());
        }
        return redirect()->route('CadastrarTrofeus');
    }

    public function EditarTroveu(TrofeusModel $trofeu)
    {
        $disciplinas = DisciplinaModel::all();
        return view('Permisions.TelasAdmin.editarTrofeu',['trofeu'=>$trofeu,'disciplinas'=>$disciplinas]);
    }

    public function DeleteTrofeu(TrofeusModel $trofeu)
    {
        $trofeu->delete();
        return redirect()->route('CadastrarTrofeus');
    }
    public function CadastrarTrofeuStore(Request $request)
    {
        $validacao = [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'st_nome_trofeu' => 'required',
            'int_total_atividades'=> 'required',
        ];
        $feedback =[
            'required'=> 'O campo deve ser preenchido',
        ];
        $request->validate($validacao, $feedback);

        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('images'), $imageName);

        TrofeusModel::create(
            [
                'fk_disciplina'=>$request->fk_disciplina,
                'st_nome_trofeu'=>$request->st_nome_trofeu,
                'int_total_atividades'=>$request->int_total_atividades,
                'st_caminho_img'=>$imageName,
            ]
        );

        return back()
            ->with('success','Arquivos Salvos com Sucesso.')
            ->with('image',$imageName);
    }

    public function CadastrarTrofeusIndex()
    {
        $disciplinas = DisciplinaModel::all();
        $todosTrofeus = TrofeusModel::all();
        return view('Permisions.TelasAdmin.CadastrarTrofeus',['todosTrofeus'=>$todosTrofeus,'disciplinas'=>$disciplinas]);
    }


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
        ]);

        $idaluno = AlunoModel::orderBy('id', 'DESC')->first();
        $conquistasAluno = new ConquistasAlunoModel();
        $conquistasAluno->fk_aluno = $idaluno->id;
        $conquistasAluno->int_total_pets = 0;
        $conquistasAluno->int_total_cursos_concluidos = 0;
        $conquistasAluno->int_total_estrelas = 0;
        $conquistasAluno->int_total_trofeus = 0;
        $conquistasAluno->save();
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
            'permision' => 2,
        ]);
        $DadosUser = User::orderBy('id', 'desc')->first();

        $arrayValues = [ $DadosUser->name,$DadosUser->id];

        ProfessorModel::create([
            'st_nome_professor' => $arrayValues[0],
            'fk_user' => $arrayValues[1] ,
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

        $dadosHistorico = HistoricoNotasAluno::where('fk_aluno',$aluno)->where('fk_curso',$curso)->get();
        foreach ($dadosHistorico as $dado){
            $dado->delete();
        }


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

    public function VincularProfessorCursoCreate()
    {
        $professores = ProfessorModel::all();
        $cursos = CursoModel::all();
        return view('Permisions.TelasAdmin.vincularCursoProfessor', ['professores'=>$professores, 'cursos'=>$cursos]);
    }
    public function VincularProfessorCursoStore(Request $request)
    {
        //código que esta funcionando para o cadastro de alunos nos cursos
        $validacao = [
            'id_professor' => 'required',
            'cursos'=> 'required',
        ];
        $feedback =[
            'id_professor.required'=> 'O aluno deve ser preenchido.',
            'cursos.required'=> 'Pelo meno um curso deve ser preenchido.',
        ];
        $request->validate($validacao, $feedback);

        $dbProfessor = ProfessorModel::where('id', $request->id_professor)->first();

        foreach ($request->cursos as $curso) {
            $dbProfessor->cursos()->attach($curso);
        }
        //redirect para a roda de vincular aluno e curso
        $professores = ProfessorModel::all();
        $cursos = CursoModel::all();
        return view('Permisions.TelasAdmin.vincularCursoProfessor', ['professores'=>$professores, 'cursos'=>$cursos]);
    }
    public function listarprofessoresCursos()
    {
        $dados = ProfessorModel::all();
        return view('Permisions.TelasAdmin.listarProfessorCursos', ['dados'=>$dados]);
        //var_dump($a->books);
    }
    public function deleteProfessorCurso($professor, $curso)
    {
        $professor = ProfessorModel::where('id',$professor )->first();
        $professor->cursos()->detach($curso);
        $dados = ProfessorModel::all();
        return view('Permisions.TelasAdmin.listarProfessorCursos', ['dados'=>$dados]);
    }
}


