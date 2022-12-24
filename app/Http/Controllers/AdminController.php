<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
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
        $validacao = [
            'st_nome_pet' => 'required',
            'int_estrelas_paraComprar' => 'required',
        ];

        $feedback =[
            'required'=> 'O campo deve ser preenchido',
        ];
        $request->validate($validacao, $feedback);

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
        return redirect()->route('vizualizarPets')->with('success','Pet Atualizado com sucesso');
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
            'image'=>'O campo deve ser preenchido',
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

        return back()->with('success','Arquivo Salvo com Sucesso');

    }


    public function UpdadeTroveu(Request $request,TrofeusModel $trofeu )
    {

        $validacao = [
            'st_nome_trofeu' => 'required',
            'int_total_atividades' => 'required',
            'fk_disciplina' => 'required',
        ];

        $feedback =[
            'required'=> 'O campo deve ser preenchido',
        ];
        $request->validate($validacao, $feedback);


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
        return redirect()->route('CadastrarTrofeus')->with('success','Arquivo Atualizado com sucesso.');
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
            'fk_disciplina'=>'required',
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


    public function RegistrarAluno(AdminModel $Admin)
    {
        return view('Permisions.TelasAdmin.registrarAluno',['Admin'=>$Admin]);
    }

    public function RegistrarProfessor(AdminModel $Admin)
    {
        return view('Permisions.TelasAdmin.registrarProfessor',['Admin'=>$Admin]);
    }
    public function registerAdmin(AdminModel $Admin)
    {
        return view('Permisions.TelasAdmin.registrarAdmin',['Admin'=>$Admin]);
    }

    public function registerAdminStore(Request $request)
    {
        $validacao = [
            'name' => 'required',
            'email'=> 'required|email',
            'password'=> 'required|min:8',
        ];
        $feedback =[
            'required'=> 'O campo deve ser preenchido',
            'min'=>'Digite ao menos 8 caracteres',
        ];
        $request->validate($validacao, $feedback);
        $curso = $request->all();
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'permision' => 3,
        ]);

        $DadosUser = User::orderBy('id', 'desc')->first();

        $arrayValues = [ $DadosUser->name,$DadosUser->id];

        AdminModel::create([
            'st_nome_admin' => $arrayValues[0],
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
        return back()->with('success','Administrador cadastrado Com sucesso');
    }

    public function RegistrarAlunoStore(Request $request)
    {
        $validacao = [
            'name' => 'required',
            'email'=> 'required|email',
            'password'=> 'required|min:8',
        ];
        $feedback =[
            'required'=> 'O campo deve ser preenchido',
            'min'=>'Digite ao menos 8 caracteres',
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
        return back()->with('success','Aluno cadastrado Com sucesso');
    }

    public function RegistrarProfessorStore(Request $request)
    {
        $validacao = [
            'name' => 'required',
            'email'=> 'required|email',
            'password'=> 'required|min:8',
        ];
        $feedback =[
            'required'=> 'O campo deve ser preenchido',
            'email'=>'Digite um e-mail válido',
            'min'=>'Digite ao menos 8 caracteres'
        ];
        $request->validate($validacao, $feedback);

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
        return back()->with('success','Professor cadastrado Com sucesso');
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
            'curso'=> 'required',
        ];
        $feedback =[
            'id_aluno.required'=> 'O aluno deve ser preenchido.',
            'curso.required'=> 'O curso deve ser preenchido.',
        ];
        $request->validate($validacao, $feedback);

        $dbAluno = AlunoModel::where('id', $request->id_aluno)->first();

        $ProgressoModel = ProgressoModel::where('fk_aluno',$dbAluno->id)->where('fk_curso',$request->curso)->get();


        $curso = CursoModel::find($request->curso);

        if (count($ProgressoModel) == 0){
            $dbAluno->cursos()->attach($request->curso);
            $Aluno = AlunoModel::find($request->id_aluno);
            foreach ($curso->unidades as $idUnidade){
                $conteudos = ConteudoModel::where('fk_unidade',$idUnidade->id)->orderBy('int_ordem_apresentacao')->get();
                foreach ( $conteudos as $conteudo) {
                    $dadosCronograma = CronogramaModel::where('fk_conteudo',$conteudo->id)->get();
                    $totalAtiviadesConteudo = count($dadosCronograma);
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
            return back()->with('success','Curso '.$curso->st_nome_curso.' cadastrdo para o aluno '.$dbAluno->st_nome_aluno);
        }

        else{
            return back()->with('error', 'O aluno '.$dbAluno->st_nome_aluno.' já esta cadastrado no curso '.$curso->st_nome_curso);
        }

    }
    public function VizualizarCursosCadastradosAluno(AlunoModel $aluno)
    {
        $cursos = $aluno->cursos;
        $ListCursos = [];
        foreach ($cursos as $curso){
            $progresso = ProgressoModel::where('fk_curso',$curso->id)->where('fk_aluno',$aluno->id)->get();
            if(count($progresso)> 0){
                $concluidos = ProgressoModel::where('fk_curso',$curso->id)->where('fk_aluno',$aluno->id)->where('int_submit_atividades',2)->get();
                $porcentagem = intval(count($concluidos)/count($progresso)* 100);
                array_push($ListCursos,[$curso->id, $curso->st_nome_curso,$porcentagem]);
            }else{
                array_push($ListCursos,[$curso->id, $curso->st_nome_curso,0]);
            }
        }
        return view('Permisions.TelasAdmin.VizualizarCursosCadastradosAluno', ['cursos'=>$ListCursos,'aluno'=>$aluno]);
    }
    public function listarAlunosCursos()
    {
        $alunos = AlunoModel::all();

        $ArrayFinal = [];
        foreach ($alunos as $aluno){
            $cursos =  $aluno->cursos;
            $user = User::where('id',$aluno->fk_user)->first();
            array_push($ArrayFinal,[$aluno->id,$aluno->st_nome_aluno,$user->email,$aluno->updated_at, count($cursos)]);
        }

        return view('Permisions.TelasAdmin.listarAlunosCursos', ['dados'=>$ArrayFinal]);
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
        $curso = CursoModel::where('id',$curso )->first();
        $aluno->cursos()->detach($curso);
        return back()->with('success','Curso ' .$curso->st_nome_curso.' excluido para o aluno '.$aluno->st_nome_aluno);

    }

    public function VincularProfessorCursoCreate()
    {
        $professores = ProfessorModel::all();
        $cursos = CursoModel::all();

        return view('Permisions.TelasAdmin.vincularCursoProfessor', ['professores'=>$professores, 'cursos'=>$cursos]);
    }
    public function VincularProfessorCursoStore(Request $request)
    {
        $validacao = [
            'id_professor' => 'required',
            'curso'=> 'required',
        ];

        $feedback =[
            'id_professor.required'=> 'O aluno deve ser preenchido.',
            'curso.required'=> 'Pelo meno um curso deve ser preenchido.',
        ];

        $request->validate($validacao, $feedback);
        $dbProfessor = ProfessorModel::where('id', $request->id_professor)->first();

        $dado = $dbProfessor->cursos;
        $array = [];

        foreach ($dado as $item) {
            array_push($array,$item->id);
        }
        $curso = CursoModel::where('id',$request->curso)->first();

        if ( ! in_array($request->curso,$array)){
            $dbProfessor->cursos()->attach($request->curso);
            return back()->with('success','O curso '.$curso->st_nome_curso.' foi cadastrado ao professor '.$dbProfessor->st_nome_professor.' com sucesso.');
        }
        else{

            return back()->with('error','O professor '.$dbProfessor->st_nome_professor. ' já esta cadastrado no curso '.$curso->st_nome_curso);
        }
    }

    public function listarprofessoresCursos()
    {
        $dados = ProfessorModel::all();
        $professores = [];
        foreach ($dados as $professor){
            array_push($professores, [$professor->id,$professor->st_nome_professor,$professor->updated_at,$professor->users->email,count($professor->cursos)]);
        }
        return view('Permisions.TelasAdmin.listarProfessorCursos', ['professores'=>$professores]);
    }

    public function VizualizarCursosCadastradosProfessor(ProfessorModel $professor)
    {
        $DadosProfessor = [];
        foreach ($professor->cursos as $curso){
            array_push($DadosProfessor, [$curso->id,$curso->st_nome_curso,count($curso->alunos)]);
        }
        return view('Permisions.TelasAdmin.VizualizarCursosCadastradosProfessor', ['DadosProfessor'=>$DadosProfessor,'professor'=>$professor]);

    }

    public function deleteProfessorCurso(ProfessorModel $professor, $curso)
    {
        $professor->cursos()->detach($curso);
        return redirect()->route('VizualizarCursosCadastradosProfessor',['professor'=>$professor]);
    }
}


