<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use App\Models\AlunoModel;
use App\Models\ProfessorModel;
use App\Models\ConquistasAlunoModel;
use App\Models\CursosConcluidosModel;

use App\Models\ProgressoModel;
use App\Models\TarefasRevisaoModel;
use App\Models\TrofeusModel;
use Illuminate\Http\Request;

class PermisionController extends Controller
{
    public function porcentagemCurso($IdUsuario)
    {
        $aluno = AlunoModel::where('id',$IdUsuario )->first();
        $porcentagensCursos = [];
        foreach ($aluno->cursos as $curso){
            $totalDados = count(ProgressoModel::where('fk_aluno',$aluno->id)->where('fk_curso',$curso->id)->get());
            $AtividadesRealizadas = count(ProgressoModel::where('fk_aluno',$aluno->id)->where('fk_curso',$curso->id)->where('int_submit_atividades',2)->get());
            $resultado = intval(($AtividadesRealizadas / $totalDados) * 100);
            array_push($porcentagensCursos, $resultado);
        }
        return $porcentagensCursos;
    }
    public function inicioPagina()
    {
        if (auth()->user()->permision == 1 ){
            $IdUsuario = auth()->user()->id;

            $IdAluno = AlunoModel::where('fk_user',$IdUsuario)->first();
            $nomeAluno = $IdAluno->st_nome_aluno;
            $IdAluno->update([
                'st_nome_aluno'=>'tesdas',
            ]);
            $IdAluno->update([
                'st_nome_aluno'=>$nomeAluno,
            ]);

            $Aluno = AlunoModel::find($IdAluno->id);
            $PorcentagemCurso = $this->porcentagemCurso($Aluno->id);

            $dadosAlunosCursos = $Aluno->cursos;
            $ConquitasAlunos = ConquistasAlunoModel::where('fk_aluno',$IdAluno->id)->first();
            $CursosTerminados = CursosConcluidosModel::where('fk_aluno', $IdAluno->id)->orderBy('fk_curso', 'asc')->get();
            if (count($CursosTerminados) > 0){
                $verificarTrofeus = TrofeusModel::all();
                $disciplinasValorConcluido = [];
                $nomeDisciplina = ['df'];
                $TotalAtividades = [0];
                $count = 1;
                foreach ($CursosTerminados as $CursoTerminado){
                    if ($count == 1 and count($CursosTerminados) == 1){
                        $nomeDisciplina[0] = $CursoTerminado->cursos->st_nome_disciplinas;
                        $TotalAtividades[0] = 1;
                        $valoresAcrescentarCurso = [$nomeDisciplina[0],$TotalAtividades[0]];
                        array_push($disciplinasValorConcluido,$valoresAcrescentarCurso);
                    }
                    if($count == 1 and count($CursosTerminados) > 1){
                        $nomeDisciplina[0] = $CursoTerminado->cursos->st_nome_disciplinas;
                        $TotalAtividades[0] = 1;
                    }
                    if ($count > 1){
                        if ($CursoTerminado->cursos->st_nome_disciplinas == $nomeDisciplina[0]){
                            $TotalAtividades[0] = $TotalAtividades[0] + 1;
                            if (count($CursosTerminados) == $count){
                                $valoresAcrescentarCurso = [$nomeDisciplina[0],$TotalAtividades[0]];
                                array_push($disciplinasValorConcluido,$valoresAcrescentarCurso);
                            }
                        }
                        if ($CursoTerminado->cursos->st_nome_disciplinas != $nomeDisciplina[0]){
                            $valoresAcrescentarCurso = [$nomeDisciplina[0],$TotalAtividades[0]];
                            array_push($disciplinasValorConcluido,$valoresAcrescentarCurso);
                            $nomeDisciplina[0] = $CursoTerminado->cursos->st_nome_disciplinas;
                            $TotalAtividades[0] = 1;
                            if (count($CursosTerminados) == $count){
                                $valoresAcrescentarCurso = [$nomeDisciplina[0],$TotalAtividades[0]];
                                array_push($disciplinasValorConcluido,$valoresAcrescentarCurso);
                            }
                        }
                    }
                    $count = $count + 1 ;
                }
                $totalTrofeus = 0;
                //Verificar se aluno tem algum trofel
                foreach ($verificarTrofeus as $verificarTrofeu){
                    foreach ($disciplinasValorConcluido as $disciplinasConcluidas){
                        if ($disciplinasConcluidas[0] == $verificarTrofeu->disciplinas->st_nome_disciplina){
                            if ($disciplinasConcluidas[1] >= $verificarTrofeu->int_total_atividades){
                                $totalTrofeus = $totalTrofeus + 1;
                            }
                        }
                    }
                }
                $ConquitasAlunos->update([
                    'int_total_trofeus'=>$totalTrofeus,
                ]);
            }

            if (count($CursosTerminados) == 0){
                $ConquitasAlunos->update([
                    'int_total_trofeus'=>0,
                ]);
                $totalTrofeus = 0;
            }
            $totalTarefas = TarefasRevisaoModel::where('fk_aluno',$IdAluno->id)->where('submit_atividade','!=',1)->get();

            $contadorAtividades = 0;

            foreach ($totalTarefas as $tarefa){
                $data = $tarefa->data;
                $DataSalvaSistema = explode('-',$data);
                $hoje = date('d/m/Y');
                $Datahoje = explode('/',$hoje);

                $totalminutosSistema =($DataSalvaSistema[0] * 525600) + ($DataSalvaSistema[1] * 43800) + ($DataSalvaSistema[2] *1440 );
                $totalminutosHoje = ($Datahoje[2] * 525600) + ($Datahoje[1] * 43800) + ($Datahoje[0] * 1440 );

                if($totalminutosSistema > $totalminutosHoje){
                    $contadorAtividades = $contadorAtividades + 1;
                }
                if($totalminutosSistema < $totalminutosHoje){
                    $contadorAtividades = $contadorAtividades + 1;
                    $tarefa->update([
                        'submit_atividade' => 3
                    ]);
                }
            }
            return view('Permisions.TelasAluno.homeAluno',['porcentagemCurso'=>$PorcentagemCurso,'totalTarefas'=>$contadorAtividades,'totalTrofeus'=>$totalTrofeus,'ConquitasAlunos'=>$ConquitasAlunos,'dadosAlunosCursos' => $dadosAlunosCursos, 'IdAluno'=>$IdAluno]);
        }
        if (auth()->user()->permision == 2 ){
            $IdUsuario = auth()->user()->id;
            $Professor = ProfessorModel::where('fk_user',$IdUsuario)->first();
            return view('Permisions.TelasProfessor.homeProfessor',['professor'=>$Professor]);
        }
        if (auth()->user()->permision == 3 ){
            $IdAdmin = auth()->user()->id;
            $Admin = AdminModel::where('fk_user',$IdAdmin)->first();
            return view('Permisions.TelasAdmin.homeAdmin',['Admin'=>$Admin]);
        }
    }
}
