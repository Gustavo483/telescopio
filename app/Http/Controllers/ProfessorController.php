<?php

namespace App\Http\Controllers;

use App\Models\AlunoModel;
use App\Models\CursoModel;
use App\Models\ProgressoModel;
use Illuminate\Http\Request;
use App\Models\ProfessorModel;
use App\Models\ConteudoModel;
use App\Models\CronogramaModel;

class ProfessorController extends Controller
{
    public function vizualizarCurso($IDProfessor)
    {

        $dadosProfessor = ProfessorModel::where('id', $IDProfessor)->first();
        $dadosCursos = $dadosProfessor->cursos;
        return view('Permisions.TelasProfessor.listarCursosDoProfessor', ['dadosCursos'=>$dadosCursos, 'IDProfessor'=>$IDProfessor]);
    }
    public function vizualizarAlunosCadastradosCurso($IDCurso,$IDProfessor)
    {
        $curso = CursoModel::where('id',$IDCurso)->first();
        $alunos = $curso->alunos;
        return view('Permisions.TelasProfessor.listarAlunosCursoEspecífico', ['curso'=>$curso,'IDProfessor'=> $IDProfessor, 'alunos'=>$alunos]);
    }


    public function vizualizarProgressoAluno($IDCurso,$IDProfessor,$alunos)
    {
        $array = [1,2,3,4];
        return view('Permisions.TelasProfessor.DesempenhoAlunoCurso',['alunos'=>$array, 'IDCurso'=>$IDCurso,'Aluno'=>$alunos,'IDProfessor'=>$IDProfessor]);
    }

    public function atividadesAluno($Aluno,$IDCurso,$IDProfessor)
    {
        $array = [1,2,3,4];
        return view('Permisions.TelasProfessor.DesempenhoAlunoCurso',['alunos'=>$array, 'IDCurso'=>$IDCurso,'Aluno'=>$Aluno,'IDProfessor'=>$IDProfessor]);
    }

    public function CursosAluno(AlunoModel $Aluno,$IDCurso,$IDProfessor)
    {
        $CursoParaCadastrarAluno = CursoModel::orderBy('st_nome_curso', 'asc')->get();
        $cursosCadastrados = $Aluno->cursos;

        $porcentagens = [];

        $arrayDados = [];
        foreach ($cursosCadastrados as $cursoCadastrado){
            $dado = $cursoCadastrado->st_nome_curso;
            array_push($arrayDados, $dado);
        }

        foreach ($cursosCadastrados as $cursos){
            $Atividades = ProgressoModel::where('fk_aluno',$Aluno->id)->where('fk_curso',$cursos->id)->get();
            $totalAtiviades = count($Atividades);
            $AtividadesRealizadas = [];
            $NaoRespondeuNenhumaAtiviade = [];
            $contador = 1;
            foreach ($Atividades as $atividade){
                if($atividade->int_submit_atividades == 2 ){
                   array_push($AtividadesRealizadas, 1);
                }
                if($atividade->int_submit_atividades == 0 and $contador == 1 ){
                    array_push($NaoRespondeuNenhumaAtiviade, 1);
                }
                $contador = $contador + 1;
            }
            if(count($NaoRespondeuNenhumaAtiviade) == 1){
                $value = $cursos->st_nome_curso;
                $dad = [$value, 0];
                array_push($porcentagens, $dad);
            }
            else{
                $dado =intval((count($AtividadesRealizadas) * 100)/$totalAtiviades);
                $value = $cursos->st_nome_curso;
                $dad = [$value, $dado];
                array_push($porcentagens,$dad );
            }
        }

        return view('Permisions.TelasProfessor.CursosAluno',['arrayDados'=>$arrayDados,'CursoParaCadastrarAluno'=>$CursoParaCadastrarAluno,'porcentagens'=>$porcentagens,'IDCurso'=>$IDCurso,'Aluno'=>$Aluno,'IDProfessor'=>$IDProfessor]);
    }


    public function ProgressoAluno($Aluno,CursoModel $IDCurso, $IDProfessor)
    {
        //porcentagem dos cursos
        $porcentagemCurso = [];
        $PorcentagensUnidadeApresentar = [];
        $porcentagemConteudo = [];
        $UnidadesDoCurso = $IDCurso->unidades;
        $Atividades = ProgressoModel::where('fk_aluno',$Aluno)->where('fk_curso',$IDCurso->id)->get();
        $totalAtiviades = count($Atividades);
        $AtividadesRealizadas = [];
        $NaoRespondeuNenhumaAtiviade = [];
        $contador = 1;
        foreach ($Atividades as $atividade){
            if($atividade->int_submit_atividades == 2 ){
                array_push($AtividadesRealizadas, 1);
            }
            if($atividade->int_submit_atividades == 0 and $contador == 1 ){
                array_push($NaoRespondeuNenhumaAtiviade, 1);
            }
            $contador = $contador + 1;
        }
        if(count($NaoRespondeuNenhumaAtiviade) == 1){
            $value = $IDCurso->st_nome_curso;
            $dad = [$value, 0];
            array_push($porcentagemCurso, $dad);
        }
        else{
            $dado =intval((count($AtividadesRealizadas) * 100)/$totalAtiviades);
            $value = $IDCurso->st_nome_curso;
            $dad = [$value, $dado];
            array_push($porcentagemCurso,$dad );
        }

        //porcentagem das unidades
        foreach ($UnidadesDoCurso as $Unidade){
            //dd($Aluno,$IDCurso->id,$Unidade);
            $progressoUnidade = ProgressoModel::where('fk_aluno',$Aluno)->where('fk_curso',$IDCurso->id)->where('fk_unidade',$Unidade->id)->get();
            //dd($progressoUnidade);
            $totalAtiviades = count($progressoUnidade);
            $AtividadesRealizadas = [];
            $dadosConteudos = [];
            $NaoRespondeuNenhumaAtiviade = [];
            $contadordf = 1;

            foreach ($progressoUnidade as $atividade){
                $dadosCronograma = CronogramaModel::where('fk_conteudo',$atividade->fk_conteudo)->get();
                if($atividade->int_submit_atividades == 2 ){
                    $ExisteOuNaoAtividadeAvaliativa = [0];
                    foreach ($dadosCronograma as $dadoCronograma){
                        $nomeConteudo = ConteudoModel::where('id',$dadoCronograma->fk_conteudo)->first();
                        if ($dadoCronograma->st_tipo_atividade == 'testeConteudo'){
                            $ExisteOuNaoAtividadeAvaliativa[0] = 1;
                        }else{
                            $ExisteOuNaoAtividadeAvaliativa[0] = 0;
                        }
                    }
                    if ($ExisteOuNaoAtividadeAvaliativa[0] == 1){
                        $dados = [$IDCurso->st_nome_curso,$Unidade->st_nome_unidade, $nomeConteudo->st_nome_conteudo,100,1,$atividade->updated_at,$atividade->int_estrela_obtida];
                        array_push($dadosConteudos,$dados);
                        array_push($AtividadesRealizadas, 1);
                    }else{
                        $dados = [$IDCurso->st_nome_curso,$Unidade->st_nome_unidade, $nomeConteudo->st_nome_conteudo,100,0,$atividade->updated_at,$atividade->int_estrela_obtida];
                        array_push($dadosConteudos,$dados );
                        array_push($AtividadesRealizadas, 1);
                    }
                }

                if($atividade->int_submit_atividades == 1 or $atividade->int_submit_atividades == 0 ){
                    $ExisteOuNaoAtividadeAvaliativa = [0];
                    foreach ($dadosCronograma as $dadoCronograma){
                        $nomeConteudo = ConteudoModel::where('id',$dadoCronograma->fk_conteudo)->first();
                        if ($dadoCronograma->st_tipo_atividade == 'testeConteudo'){
                            $ExisteOuNaoAtividadeAvaliativa[0] = 1;
                        }else{
                            $ExisteOuNaoAtividadeAvaliativa[0] = 0;
                        }
                    }
                    if ($ExisteOuNaoAtividadeAvaliativa[0] == 1){
                        $dados = [$IDCurso->st_nome_curso,$Unidade->st_nome_unidade, $nomeConteudo->st_nome_conteudo,0,1,'-','-'];
                        array_push($dadosConteudos,$dados);
                        array_push($NaoRespondeuNenhumaAtiviade, 1);
                    }else{
                        $dados = [$IDCurso->st_nome_curso,$Unidade->st_nome_unidade, $nomeConteudo->st_nome_conteudo,0,0,'-','-'];
                        array_push($dadosConteudos,$dados );
                        array_push($NaoRespondeuNenhumaAtiviade, 1);
                    }
                }
                $contadordf = $contadordf + 1;
            }
            array_push($porcentagemConteudo,$dadosConteudos );

            if(count($NaoRespondeuNenhumaAtiviade) == 1){
                $value = $IDCurso->st_nome_curso;
                $dad = [$value,$Unidade->st_nome_unidade, 0];
                array_push($PorcentagensUnidadeApresentar, $dad);
            }
            else{
                $dado =intval((count($AtividadesRealizadas) * 100)/$totalAtiviades);
                $value = $IDCurso->st_nome_curso;
                $dad = [$value,$Unidade->st_nome_unidade, $dado];
                array_push($PorcentagensUnidadeApresentar,$dad);
            }
        }
        return view('Permisions.TelasProfessor.ProgressoAlunoECadastrarTarefas',['porcentagemCurso'=>$porcentagemCurso,'PorcentagensUnidadeApresentar'=>$PorcentagensUnidadeApresentar,'porcentagemConteudos'=>$porcentagemConteudo,'IDCurso'=>$IDCurso->id,'Aluno'=>$Aluno,'IDProfessor'=>$IDProfessor]);
    }

    public function TarefasAluno($Aluno,$IDCurso, $IDProfessor)
    {
        dd($Aluno,$IDCurso);
    }

    public function VincularAlunoCurso(Request $request, AlunoModel $Aluno ,$IDCurso, $IDProfessor)
    {
        $validacao = [
            'cursos' => 'required',

        ];
        $feedback =[
            'required'=> 'O campo deve ser preenchido',
        ];
        $request->validate($validacao, $feedback);

        foreach ($request->cursos as $curso) {
            $Aluno->cursos()->attach($curso);
        }
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
        return redirect()->route('CursosAluno.professor', ['Aluno'=>$Aluno->id,'IDCurso'=>$IDCurso,'IDProfessor'=>$IDProfessor]);
    }
}
