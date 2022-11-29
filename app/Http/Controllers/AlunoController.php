<?php

namespace App\Http\Controllers;

use App\Models\ConquistasAlunoModel;
use App\Models\CursoModel;
use App\Models\PetsModel;
use App\Models\TarefasRevisaoModel;
use App\Models\TesteCursoModel;
use App\Models\UnidadeModel;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Collection;
use App\Models\ConteudoModel;
use Illuminate\Http\Request;
use App\Models\ProgressoModel;
use App\Models\CronogramaModel;
use App\Models\ConteudoEscritoModel;
use App\Models\QuestoesModel;
use App\Models\QuestoesFizacaoModel;
use App\Models\TesteFinalModel;
use App\Models\TesteIntermediarioModel;
use App\Models\HistoricoNotasAluno;
use App\Models\CursosConcluidosModel;
use App\Models\AlunoModel;
use App\Models\TrofeusModel;

class AlunoController extends Controller
{
    public function SalvarProgressoMedianteTarefa(TarefasRevisaoModel $DatosTarefa, Request $request)
    {
        $ConquistaAluno = ConquistasAlunoModel::where('fk_aluno',$DatosTarefa->fk_aluno)->first();

        $dadosProgresso = ProgressoModel::where('fk_aluno',$DatosTarefa->fk_aluno)->where('fk_unidade',$DatosTarefa->fk_unidade)->where('fk_curso',$DatosTarefa->fk_curso)->where('fk_conteudo',$DatosTarefa->fk_conteudo)->first();
        if($request->int_estrela_obtida >$dadosProgresso->int_estrela_obtida){
            $estrelasextrasGanhadas = intval($request->int_estrela_obtida ) - $dadosProgresso->int_estrela_obtida;
            $TotalEstreas = $ConquistaAluno->int_total_estrelas + $estrelasextrasGanhadas;
            $dadosProgresso->update([
                'int_estrela_obtida' => intval($request->int_estrela_obtida),
            ]);
            $ConquistaAluno->update([
                'int_total_estrelas'=> $TotalEstreas
            ]);
            $DatosTarefa->updade([

            ]);
        }
        dd($dadosProgresso,$request->all(),$DatosTarefa);
        dd('entramos aqui mlk doido', $request->all(), $DatosTarefa);
    }
    public function direcionarAlunoParaTarefa(TarefasRevisaoModel $DatosTarefa)
    {
        $dadosProgresso = ProgressoModel::where('fk_aluno',$DatosTarefa->fk_aluno)->where('fk_unidade',$DatosTarefa->fk_unidade)->where('fk_curso',$DatosTarefa->fk_curso)->where('fk_conteudo',$DatosTarefa->fk_conteudo)->first();

        if ($dadosProgresso->int_submit_atividades == 1 or $dadosProgresso->int_submit_atividades == 2){
            $dadosCronograma = CronogramaModel::where('fk_conteudo', $DatosTarefa->fk_conteudo)->where('fk_unidade', $DatosTarefa->fk_unidade)->get();
            foreach ( $dadosCronograma as $dado){
                if ($dado->st_tipo_atividade == 'testeConteudo'){
                    // verificar se a atividade já foi feita ou não
                    // fim verifição

                    $questoes = QuestoesModel::where('fk_conteudo',$dado->fk_conteudo)->inRandomOrder()->limit(5)->get();
                    return view('Permisions.TelasAluno.ApresentarAtividadesDetarefa',['questoes'=>$questoes,'DatosTarefa'=>$DatosTarefa, 'IdAluno'=>$DatosTarefa->fk_aluno,'idConteudo'=>$DatosTarefa->fk_conteudo,'IdCurso'=>$DatosTarefa->fk_curso,'tipoAtividade'=>$dado->st_tipo_atividade ]);

                }
                if ($dado->st_tipo_atividade == 'Teste Intermediario'){
                    $colect = new Collection();
                    $AtividadesIntermediarias = TesteIntermediarioModel::where('fk_conteudo_pertencente', $DatosTarefa->fk_conteudo)->get();
                    foreach ($AtividadesIntermediarias as $atividade){
                        $valorFkConteudo = $atividade->fk_conteudo;
                        $QuantidadeQuestoes = $atividade->totalQuestao;
                        $DadosQuestoes = QuestoesModel::where('fk_conteudo',$valorFkConteudo)->inRandomOrder()->limit($QuantidadeQuestoes)->get();
                        foreach ($DadosQuestoes as $questoes){
                            $colect->push($questoes);
                        }
                    }
                    $questoes = $colect->all();
                    return view('Permisions.TelasAluno.ApresentarAtividadesDetarefa',['questoes'=>$questoes,'DatosTarefa'=>$DatosTarefa, 'IdAluno'=>$DatosTarefa->fk_aluno,'idConteudo'=>$DatosTarefa->fk_conteudo,'IdCurso'=>$DatosTarefa->fk_curso,'tipoAtividade'=>$dado->st_tipo_atividade ]);
                }

                if ($dado->st_tipo_atividade == 'Teste Final'){
                    $colect = new Collection();
                    $dadosTesteFinalUnidade = TesteFinalModel::where('fk_conteudo_pertencente', $DatosTarefa->fk_conteudo)->get();
                    foreach ($dadosTesteFinalUnidade as $testefinalUnidade){
                        $valorFkConteudo = $testefinalUnidade->fk_conteudo;
                        $QuantidadeQuestoes = $testefinalUnidade->totalQuestao;
                        $DadosQuestoes = QuestoesModel::where('fk_conteudo',$valorFkConteudo)->inRandomOrder()->limit($QuantidadeQuestoes)->get();
                        foreach ($DadosQuestoes as $questoes){
                            $colect->push($questoes);
                        }
                    }
                    $questoes = $colect->all();
                    return view('Permisions.TelasAluno.ApresentarAtividadesDetarefa',['questoes'=>$questoes,'DatosTarefa'=>$DatosTarefa, 'IdAluno'=>$DatosTarefa->fk_aluno,'idConteudo'=>$DatosTarefa->fk_conteudo,'IdCurso'=>$DatosTarefa->fk_curso,'tipoAtividade'=>$dado->st_tipo_atividade ]);
                }

                if ($dado->st_tipo_atividade == 'Teste Final Curso'){
                    $colect = new Collection();
                    $dadosTesteFinalCurso = TesteCursoModel::where('fk_conteudo_pertencente', $DatosTarefa->fk_conteudo)->get();
                    foreach ($dadosTesteFinalCurso as $TesteFinalCurso){
                        $valorFkConteudo = $TesteFinalCurso->fk_conteudo;
                        $QuantidadeQuestoes = $TesteFinalCurso->totalQuestao;
                        $DadosQuestoes = QuestoesModel::where('fk_conteudo',$valorFkConteudo)->inRandomOrder()->limit($QuantidadeQuestoes)->get();
                        foreach ($DadosQuestoes as $questoes){
                            $colect->push($questoes);
                        }
                    }

                    $questoes = $colect->all();
                    return view('Permisions.TelasAluno.ApresentarAtividadesDetarefa',['questoes'=>$questoes,'DatosTarefa'=>$DatosTarefa, 'IdAluno'=>$DatosTarefa->fk_aluno,'idConteudo'=>$DatosTarefa->fk_conteudo,'IdCurso'=>$DatosTarefa->fk_curso,'tipoAtividade'=>$dado->st_tipo_atividade ]);
                }
            }
        }
        if ($dadosProgresso->int_submit_atividades == 0){
            $arrayIdUnidades = [];
            $dadoscurso = CursoModel::where('id',$DatosTarefa->fk_curso )->get();
            foreach ($dadoscurso as $cursos){
                foreach ($cursos->unidades as $dd){
                    array_push($arrayIdUnidades, $dd->id );
                }
            }
            $dadosconteudos = ConteudoModel::wherein('fk_unidade',$arrayIdUnidades )->get();
            $unidades = UnidadeModel::wherein('id',$arrayIdUnidades )->get();
            $contadorUnidades = count($unidades);

            $informacoesProgressos = ProgressoModel::where('fk_aluno',$DatosTarefa->fk_aluno)->where('fk_curso',$DatosTarefa->fk_curso)->get();
            $DadosParaApresentar = [];
            $PrimeiroDadoParaApresentar = [];
            $NomesConteudos = [];
            $nomeConteudo0 = [];
            $FKUnidadeConteudo0 = [];
            $contador = 0;
            $NomeConteudoSemSubmit = [];
            $nomeUnidadeSemSubmit = [];

            foreach ($informacoesProgressos as $progresso){
                $IdConteudo = $progresso->fk_conteudo;
                $nomeCurso = $progresso->cursos->st_nome_curso;
                $idCurso = $progresso->cursos->id;
                $nomeUnidade = $progresso->unidades->st_nome_unidade;
                $IDUnidade = $progresso->unidades->id;
                $dadosCronograma = CronogramaModel::where('fk_conteudo',$IdConteudo)->orderBy('st_ordem_apresentacao')->get();
                $nomeConteudo = ConteudoModel::where('id',$IdConteudo)->first();
                if(in_array($nomeConteudo->st_nome_conteudo,$NomesConteudos )){
                    foreach ($dadosCronograma as $dadoCronograma){
                        $dados = [$DatosTarefa->fk_aluno,$IdConteudo,$nomeConteudo->st_nome_conteudo,$nomeCurso,$nomeUnidade,$dadoCronograma->st_tipo_atividade,$dadoCronograma->id,$progresso->int_submit_atividades,$IDUnidade];
                        array_push($DadosParaApresentar, $dados);
                    }
                }else{
                    if ($contador != 0 ){
                        array_push($NomesConteudos,$nomeConteudo->st_nome_conteudo);
                    }
                    foreach ($dadosCronograma as $dadoCronograma){
                        if($contador == 0 ){

                            $dados = [$DatosTarefa->fk_aluno,$IdConteudo,$nomeConteudo->st_nome_conteudo,$nomeCurso,$nomeUnidade,$dadoCronograma->st_tipo_atividade,$dadoCronograma->id,$progresso->int_submit_atividades,$IDUnidade];
                            array_push($PrimeiroDadoParaApresentar, $dados);
                            $nomeConteudo0[0] = $nomeConteudo->st_nome_conteudo;
                            $FKUnidadeConteudo0[0] = $nomeConteudo->fk_unidade;
                        }else{
                            if ($progresso->int_submit_atividades == 0 and ! in_array($nomeConteudo->st_nome_conteudo,$NomeConteudoSemSubmit)){
                                array_push($nomeUnidadeSemSubmit, $nomeUnidade);
                                array_push($NomeConteudoSemSubmit, $nomeConteudo->st_nome_conteudo);
                            }
                            $dados = [$DatosTarefa->fk_aluno,$IdConteudo,$nomeConteudo->st_nome_conteudo,$nomeCurso,$nomeUnidade,$dadoCronograma->st_tipo_atividade,$dadoCronograma->id,$progresso->int_submit_atividades,$IDUnidade];
                            array_push($DadosParaApresentar, $dados);
                        }
                    }
                }
                $contador = $contador + 1 ;
            }

            // pegando a porcentagem do curso
            $porcentagens = [];
            $totalAtiviades = count($informacoesProgressos);
            $AtividadesRealizadas = [];
            $NaoRespondeuNenhumaAtiviade = [];
            $contador = 1;
            foreach ($informacoesProgressos as $atividade){
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
                array_push($porcentagens, $value,0);
            }
            else{
                $dado =intval((count($AtividadesRealizadas) * 100)/$totalAtiviades);
                $value = $cursos->st_nome_curso;

                array_push($porcentagens,$value,$dado );
            }

            $IdAluno = AlunoModel::where('id', $DatosTarefa->fk_aluno)->first();


            $mensagemErro = "Realize as atividades anteriores para realizar a atividade do conteudo ". $DatosTarefa->conteudos->st_nome_conteudo;
            return view('Permisions.TelasAluno.aprensetarCursoParaAlunos',['IdAluno'=>$IdAluno,'porcentagens'=>$porcentagens,'mensagemErro'=>$mensagemErro,'nomeUnidadeSemSubmit'=>$nomeUnidadeSemSubmit,'NomeConteudoSemSubmit'=>$NomeConteudoSemSubmit,'fkUnidade0'=>$FKUnidadeConteudo0,'nomeConteudo0'=>$nomeConteudo0,'PrimeiroDadoParaApresentar'=>$PrimeiroDadoParaApresentar,'DadosParaApresentar'=>$DadosParaApresentar, 'NomesConteudos'=>$NomesConteudos, 'IdCurso'=>$idCurso,'DadosConteudos'=>$dadosconteudos, 'IDsUnidades'=>$unidades, 'contadorUnidades'=>$contadorUnidades]);
        }
    }
    public function VizualizarTarefasAluno( $IdAluno)
    {
        $TarefasCadastras = TarefasRevisaoModel::where('fk_aluno',$IdAluno)->where('submit_atividade',0)->get();
        return view('Permisions.TelasAluno.VizualizarTarefasAluno',['TarefasCadastras'=>$TarefasCadastras] );
    }

    public function VizualizarTrofeusAluno(AlunoModel $IdAluno)
    {
        $CursosTerminados = CursosConcluidosModel::where('fk_aluno', $IdAluno->id)->orderBy('fk_curso', 'asc')->get();

        $verificarTrofeus = TrofeusModel::all();
        if (count($CursosTerminados) > 0) {
            $disciplinasValorConcluido = [];
            $nomeDisciplina = ['df'];
            $TotalAtividades = [0];
            $count = 1;
            foreach ($CursosTerminados as $CursoTerminado) {
                if ($count == 1 and count($CursosTerminados) == 1) {
                    $nomeDisciplina[0] = $CursoTerminado->cursos->st_nome_disciplinas;
                    $TotalAtividades[0] = 1;
                    $valoresAcrescentarCurso = [$nomeDisciplina[0], $TotalAtividades[0]];
                    array_push($disciplinasValorConcluido, $valoresAcrescentarCurso);
                }
                if ($count == 1 and count($CursosTerminados) > 1) {
                    $nomeDisciplina[0] = $CursoTerminado->cursos->st_nome_disciplinas;
                    $TotalAtividades[0] = 1;
                }
                if ($count > 1) {
                    if ($CursoTerminado->cursos->st_nome_disciplinas == $nomeDisciplina[0]) {
                        $TotalAtividades[0] = $TotalAtividades[0] + 1;
                        if (count($CursosTerminados) == $count) {
                            $valoresAcrescentarCurso = [$nomeDisciplina[0], $TotalAtividades[0]];
                            array_push($disciplinasValorConcluido, $valoresAcrescentarCurso);
                        }
                    }
                    if ($CursoTerminado->cursos->st_nome_disciplinas != $nomeDisciplina[0]) {
                        $valoresAcrescentarCurso = [$nomeDisciplina[0], $TotalAtividades[0]];
                        array_push($disciplinasValorConcluido, $valoresAcrescentarCurso);
                        $nomeDisciplina[0] = $CursoTerminado->cursos->st_nome_disciplinas;
                        $TotalAtividades[0] = 1;
                        if (count($CursosTerminados) == $count) {
                            $valoresAcrescentarCurso = [$nomeDisciplina[0], $TotalAtividades[0]];
                            array_push($disciplinasValorConcluido, $valoresAcrescentarCurso);
                        }
                    }
                }
                $count = $count + 1;
            }
            $totalTrofeus = 0;

            $trofeusConquistados = [];
            $trofeusEmAbertosComPorcentagem = [];
            $TrofeusSemProgresso = [];
            $idCursosConquistados = [];
            $idCursosNaoConquistados = [];

            //Verificar se aluno tem algum trofel

            foreach ($verificarTrofeus as $verificarTrofeu) {
                $count = 0;
                foreach ($disciplinasValorConcluido as $disciplinasConcluidas) {
                    if ($disciplinasConcluidas[0] == $verificarTrofeu->disciplinas->st_nome_disciplina) {
                        if ($disciplinasConcluidas[1] >= $verificarTrofeu->int_total_atividades) {
                            $data = [$disciplinasConcluidas[0], $disciplinasConcluidas[1],$verificarTrofeu->int_total_atividades, $verificarTrofeu->st_caminho_img, '100%',$verificarTrofeu->st_nome_trofeu];
                            array_push($idCursosConquistados, $verificarTrofeu->id);
                            array_push($trofeusConquistados, $data);
                            $totalTrofeus = $totalTrofeus + 1;
                        }
                        if ($disciplinasConcluidas[1] < $verificarTrofeu->int_total_atividades) {
                            $porcentagem = ($disciplinasConcluidas[1] /$verificarTrofeu->int_total_atividades) * 100;
                            $data = [$disciplinasConcluidas[0], $disciplinasConcluidas[1],$verificarTrofeu->int_total_atividades, $verificarTrofeu->st_caminho_img, $porcentagem."%",$verificarTrofeu->st_nome_trofeu];
                            array_push($idCursosNaoConquistados, $verificarTrofeu->id);
                            array_push($trofeusEmAbertosComPorcentagem, $data);
                        }
                    }
                }
            }
            $verificador = 0;
            //dd($idCursosConquistados,$idCursosNaoConquistados);
            return view('Permisions.TelasAluno.VizualizarTrofeusPeloAluno',['verificador'=>$verificador,'idTrofeusConquistados'=>$idCursosConquistados,'idTrofeusNaoConquistados'=>$idCursosNaoConquistados,'trofeusConquistados'=>$trofeusConquistados,'trofeusEmAbertosComPorcentagem'=>$trofeusEmAbertosComPorcentagem,'TodosTrofeus'=>$verificarTrofeus] );
        }

        if (count($CursosTerminados) == 0) {
            $verificador = 1;
            return view('Permisions.TelasAluno.VizualizarTrofeusPeloAluno',['verificador'=>$verificador,'TodosTrofeus'=>$verificarTrofeus] );
        }

    }

    public function ComprarPet(AlunoModel $IDAluno,PetsModel $IDPet)
    {
        $ConquistasAluno = ConquistasAlunoModel::where('fk_aluno',$IDAluno->id)->first();
        if ($ConquistasAluno->int_total_estrelas >= $IDPet->int_estrelas_paraComprar){
            $valorEstrelasAtualizado = $ConquistasAluno->int_total_estrelas - $IDPet->int_estrelas_paraComprar ;
            $totalPets = $ConquistasAluno->int_total_pets + 1;
            $ConquistasAluno->update([
                    'int_total_estrelas' => $valorEstrelasAtualizado,
                    'int_total_pets' => $totalPets,
                ]);
            $IDAluno->pets()->attach($IDPet);
            return back()
                ->with('success','Compra efetuada com sucesso');
        }else{
            return back()
                ->with('Erro','Você não tem estrelas suficientes para efetuar a compra do pet');
        }
    }
    public function VizualizarPetsAluno($IdAluno)
    {
        $dbAluno = AlunoModel::where('id', $IdAluno)->first();
        $PetsComprados = $dbAluno->pets;
        $IDPetsComprados = [];
        foreach ($PetsComprados as $Pets){
            array_push($IDPetsComprados,$Pets->id);
        }
        $PetsParaComprar = new Collection();
        $todosPets = PetsModel::all();
        foreach ($todosPets as $Pet){
            if (! in_array("$Pet->id", $IDPetsComprados)) {
                $PetsParaComprar->push($Pet);
            }
        }

        //foreach ($request->cursos as $curso) {
        //    $dbAluno->cursos()->attach($curso);
        //}

        return view('Permisions.TelasAluno.VizualizarPetsPeloAluno',['IdAluno'=>$IdAluno,'PetsParaComprar'=>$PetsParaComprar,'PetsComprados'=>$PetsComprados]);
    }
    public function vizualizarCurso2($IdAluno,CursoModel $IdCurso, ConteudoModel $fkConteudo){
        // Pegando informações das unidades realizadas e atividades
        $arrayIdUnidades = [];
        $dadoscurso = CursoModel::where('id',$IdCurso->id )->get();
        foreach ($dadoscurso as $cursos){
            foreach ($cursos->unidades as $dd){
                array_push($arrayIdUnidades, $dd->id );
            }
        }
        $dadosconteudos = ConteudoModel::wherein('fk_unidade',$arrayIdUnidades )->get();
        $unidades = UnidadeModel::wherein('id',$arrayIdUnidades )->get();
        $contadorUnidades = count($unidades);

        $informacoesProgressos = ProgressoModel::where('fk_aluno',$IdAluno)->where('fk_curso',$IdCurso->id)->get();
        $DadosParaApresentar = [];
        $PrimeiroDadoParaApresentar = [];
        $NomesConteudos = [];
        $nomeConteudo0 = [];
        $FKUnidadeConteudo0 = [];
        $contador = 0;
        $NomeConteudoSemSubmit = [];
        $nomeUnidadeSemSubmit = [];

        foreach ($informacoesProgressos as $progresso){
            $IdConteudo = $progresso->fk_conteudo;
            $nomeCurso = $progresso->cursos->st_nome_curso;
            $idCurso = $progresso->cursos->id;
            $nomeUnidade = $progresso->unidades->st_nome_unidade;
            $IDUnidade = $progresso->unidades->id;
            $dadosCronograma = CronogramaModel::where('fk_conteudo',$IdConteudo)->orderBy('st_ordem_apresentacao')->get();
            $nomeConteudo = ConteudoModel::where('id',$IdConteudo)->first();
            if(in_array($nomeConteudo->st_nome_conteudo,$NomesConteudos )){
                foreach ($dadosCronograma as $dadoCronograma){
                    $dados = [$IdAluno,$IdConteudo,$nomeConteudo->st_nome_conteudo,$nomeCurso,$nomeUnidade,$dadoCronograma->st_tipo_atividade,$dadoCronograma->id,$progresso->int_submit_atividades,$IDUnidade];
                    array_push($DadosParaApresentar, $dados);
                }
            }else{
                if ($contador != 0 ){
                    array_push($NomesConteudos,$nomeConteudo->st_nome_conteudo);
                }
                foreach ($dadosCronograma as $dadoCronograma){
                    if($contador == 0 ){

                        $dados = [$IdAluno,$IdConteudo,$nomeConteudo->st_nome_conteudo,$nomeCurso,$nomeUnidade,$dadoCronograma->st_tipo_atividade,$dadoCronograma->id,$progresso->int_submit_atividades,$IDUnidade];
                        array_push($PrimeiroDadoParaApresentar, $dados);
                        $nomeConteudo0[0] = $nomeConteudo->st_nome_conteudo;
                        $FKUnidadeConteudo0[0] = $nomeConteudo->fk_unidade;
                    }else{
                        if ($progresso->int_submit_atividades == 0 and ! in_array($nomeConteudo->st_nome_conteudo,$NomeConteudoSemSubmit)){
                            array_push($nomeUnidadeSemSubmit, $nomeUnidade);
                            array_push($NomeConteudoSemSubmit, $nomeConteudo->st_nome_conteudo);
                        }

                        $dados = [$IdAluno,$IdConteudo,$nomeConteudo->st_nome_conteudo,$nomeCurso,$nomeUnidade,$dadoCronograma->st_tipo_atividade,$dadoCronograma->id,$progresso->int_submit_atividades,$IDUnidade];
                        array_push($DadosParaApresentar, $dados);
                    }
                }
            }
            $contador = $contador + 1 ;
        }

        // pegando a porcentagem do curso
        $porcentagens = [];
        $totalAtiviades = count($informacoesProgressos);
        $AtividadesRealizadas = [];
        $NaoRespondeuNenhumaAtiviade = [];
        $contador = 1;
        foreach ($informacoesProgressos as $atividade){
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
            array_push($porcentagens, $value,0);
        }
        else{
            $dado =intval((count($AtividadesRealizadas) * 100)/$totalAtiviades);
            $value = $cursos->st_nome_curso;
            array_push($porcentagens,$value,$dado );
        }
        $nome = AlunoModel::where('id', $IdAluno)->first();


        $mensagemSucess = 'Parabens!!! Você realizou a tarefa do conteudo '.$fkConteudo->st_nome_conteudo.'do Curso' .$IdCurso->st_nome_curso;
        return view('Permisions.TelasAluno.aprensetarCursoParaAlunos',['IdAluno'=>$nome,'porcentagens'=>$porcentagens,'mensagemSucess'=>$mensagemSucess,'nomeUnidadeSemSubmit'=>$nomeUnidadeSemSubmit,'NomeConteudoSemSubmit'=>$NomeConteudoSemSubmit,'fkUnidade0'=>$FKUnidadeConteudo0,'nomeConteudo0'=>$nomeConteudo0,'PrimeiroDadoParaApresentar'=>$PrimeiroDadoParaApresentar,'DadosParaApresentar'=>$DadosParaApresentar, 'NomesConteudos'=>$NomesConteudos, 'IdCurso'=>$IdCurso,'DadosConteudos'=>$dadosconteudos, 'IDsUnidades'=>$unidades, 'contadorUnidades'=>$contadorUnidades]);

    }

    public function vizualizarCurso(AlunoModel $IdAluno, $IdCurso)
    {
        $arrayIdUnidades = [];
        $dadoscurso = CursoModel::where('id',$IdCurso )->get();
        foreach ($dadoscurso as $cursos){
            foreach ($cursos->unidades as $dd){
                array_push($arrayIdUnidades, $dd->id );
            }
        }
        $dadosconteudos = ConteudoModel::wherein('fk_unidade',$arrayIdUnidades )->get();
        $unidades = UnidadeModel::wherein('id',$arrayIdUnidades )->get();
        $contadorUnidades = count($unidades);

        $informacoesProgressos = ProgressoModel::where('fk_aluno',$IdAluno->id)->where('fk_curso',$IdCurso)->get();
        $DadosParaApresentar = [];
        $PrimeiroDadoParaApresentar = [];
        $NomesConteudos = [];

        $nomeConteudo0 = [];
        $FKUnidadeConteudo0 = [];
        $contador = 0;
        $NomeConteudoSemSubmit = [];
        $nomeUnidadeSemSubmit = [];
        foreach ($informacoesProgressos as $progresso){
            $IdConteudo = $progresso->fk_conteudo;
            $nomeCurso = $progresso->cursos->st_nome_curso;
            $idCurso = $progresso->cursos->id;
            $nomeUnidade = $progresso->unidades->st_nome_unidade;
            $IDUnidade = $progresso->unidades->id;
            $dadosCronograma = CronogramaModel::where('fk_conteudo',$IdConteudo)->orderBy('st_ordem_apresentacao')->get();
            $nomeConteudo = ConteudoModel::where('id',$IdConteudo)->first();
            if(in_array($nomeConteudo->st_nome_conteudo,$NomesConteudos )){
                foreach ($dadosCronograma as $dadoCronograma){
                    $dados = [$IdAluno->id,$IdConteudo,$nomeConteudo->st_nome_conteudo,$nomeCurso,$nomeUnidade,$dadoCronograma->st_tipo_atividade,$dadoCronograma->id,$progresso->int_submit_atividades,$IDUnidade];
                    array_push($DadosParaApresentar, $dados);
                }
            }else{
                if ($contador != 0 ){
                    array_push($NomesConteudos,$nomeConteudo->st_nome_conteudo);
                }
                foreach ($dadosCronograma as $dadoCronograma){
                    if($contador == 0 ){
                        $dados = [$IdAluno->id,$IdConteudo,$nomeConteudo->st_nome_conteudo,$nomeCurso,$nomeUnidade,$dadoCronograma->st_tipo_atividade,$dadoCronograma->id,$progresso->int_submit_atividades,$IDUnidade];
                        array_push($PrimeiroDadoParaApresentar, $dados);
                        $nomeConteudo0[0] = $nomeConteudo->st_nome_conteudo;
                        $FKUnidadeConteudo0[0] = $nomeConteudo->fk_unidade;
                    }else{
                        if ($progresso->int_submit_atividades == 0 and ! in_array($nomeConteudo->st_nome_conteudo,$NomeConteudoSemSubmit)){
                            array_push($nomeUnidadeSemSubmit, $nomeUnidade);
                            array_push($NomeConteudoSemSubmit, $nomeConteudo->st_nome_conteudo);
                        }
                        $dados = [$IdAluno->id,$IdConteudo,$nomeConteudo->st_nome_conteudo,$nomeCurso,$nomeUnidade,$dadoCronograma->st_tipo_atividade,$dadoCronograma->id,$progresso->int_submit_atividades,$IDUnidade];
                        array_push($DadosParaApresentar, $dados);
                    }
                }
            }
            $contador = $contador + 1 ;
        }

        // pegando a porcentagem do curso
        $porcentagens = [];
        $totalAtiviades = count($informacoesProgressos);
        $AtividadesRealizadas = [];
        $NaoRespondeuNenhumaAtiviade = [];
        $contador = 1;
        foreach ($informacoesProgressos as $atividade){
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
            array_push($porcentagens, $value,0);
        }
        else{
            $dado =intval((count($AtividadesRealizadas) * 100)/$totalAtiviades);
            $value = $cursos->st_nome_curso;
            array_push($porcentagens,$value,$dado );
        }

        return view('Permisions.TelasAluno.aprensetarCursoParaAlunos',['IdAluno'=>$IdAluno,'porcentagens'=>$porcentagens,'nomeUnidadeSemSubmit'=>$nomeUnidadeSemSubmit,'NomeConteudoSemSubmit'=>$NomeConteudoSemSubmit,'fkUnidade0'=>$FKUnidadeConteudo0,'nomeConteudo0'=>$nomeConteudo0,'PrimeiroDadoParaApresentar'=>$PrimeiroDadoParaApresentar,'DadosParaApresentar'=>$DadosParaApresentar, 'NomesConteudos'=>$NomesConteudos, 'IdCurso'=>$IdCurso,'DadosConteudos'=>$dadosconteudos, 'IDsUnidades'=>$unidades, 'contadorUnidades'=>$contadorUnidades]);
    }

    public function MostrarExercicioAluno($IdAluno,$idConteudo,$IdCronograma,$tipoAtividade,$IdCurso)
    {
        if($tipoAtividade == 'TEXTO'){
            $func = $this->vizualizarCurso4545( $IdAluno, $IdCurso);
            $dados = ConteudoEscritoModel::where('fk_cronograma',$IdCronograma)->first();
            return view('Permisions.TelasAluno.ApresentarTextoConteudo',
                ['texto'=>$dados,
                'IdAluno'=>$func['IdAluno'],
                'IdConteudo'=>$idConteudo,
                'IdCurso'=>$IdCurso,
                'tipoAtividade'=>$tipoAtividade,
                'porcentagens'=> $func['porcentagens'],
                'nomeUnidadeSemSubmit'=> $func['nomeUnidadeSemSubmit'],
                'NomeConteudoSemSubmit'=>$func['NomeConteudoSemSubmit'],
                'fkUnidade0'=>$func['fkUnidade0'],
                'nomeConteudo0'=>$func['nomeConteudo0'],
                'PrimeiroDadoParaApresentar'=>$func['PrimeiroDadoParaApresentar'],
                'DadosParaApresentar'=>$func['DadosParaApresentar'],
                'NomesConteudos'=>$func['NomesConteudos'],
                'DadosConteudos'=>$func['DadosConteudos'],
                'IDsUnidades'=>$func['IDsUnidades'],
                'contadorUnidades'=>$func['contadorUnidades'],
                ]);
        }

        if($tipoAtividade == 'AtividadeFixacao'){
            $dados = QuestoesFizacaoModel::where('fk_conteudo',$idConteudo)->get();
            return view('Permisions.TelasAluno.apresentarAtividadeFixacao', ['Atividades'=>$dados, 'IdAluno'=>$IdAluno, 'IdConteudo'=>$idConteudo, 'IdCurso'=>$IdCurso,'tipoAtividade'=>$tipoAtividade]);
        }

        if($tipoAtividade == 'testeConteudo'){
            $dados = QuestoesModel::where('fk_conteudo', $idConteudo)->inRandomOrder()->limit(5)->get();
            return view('Permisions.TelasAluno.testeConteudo', ['Atividades'=>$dados, 'IdAluno'=>$IdAluno, 'IdConteudo'=>$idConteudo , 'IdCurso'=>$IdCurso,'tipoAtividade'=>$tipoAtividade]);
        }

        if ($tipoAtividade == 'Teste Final'){
            $colect = new Collection();
            $dados = TesteFinalModel::where('fk_conteudo_pertencente', $idConteudo)->get();
            foreach ($dados as $dado){
                $valorFkConteudo = $dado->fk_conteudo;
                $QuantidadeQuestoes = $dado->totalQuestao;
                $DadosQuestoes = QuestoesModel::where('fk_conteudo',$valorFkConteudo)->inRandomOrder()->limit($QuantidadeQuestoes)->get();
                foreach ($DadosQuestoes as $questoes){
                    $colect->push($questoes);
                }
            }
            $dadosAtividadeIntermediaria = $colect->all();
            return view('Permisions.TelasAluno.testeConteudo', ['Atividades'=>$dadosAtividadeIntermediaria, 'IdAluno'=>$IdAluno, 'IdConteudo'=>$idConteudo, 'IdCurso'=>$IdCurso,'tipoAtividade'=>$tipoAtividade]);
        }

        if ($tipoAtividade == 'Teste Intermediario'){
            $colect = new Collection();
            $dados = TesteIntermediarioModel::where('fk_conteudo_pertencente', $idConteudo)->get();
            foreach ($dados as $dado){
                $valorFkConteudo = $dado->fk_conteudo;
                $QuantidadeQuestoes = $dado->totalQuestao;
                $DadosQuestoes = QuestoesModel::where('fk_conteudo',$valorFkConteudo)->inRandomOrder()->limit($QuantidadeQuestoes)->get();
                foreach ($DadosQuestoes as $questoes){
                    $colect->push($questoes);
                }
            }
            $dadosAtividadeIntermediaria = $colect->all();
            return view('Permisions.TelasAluno.testeConteudo', ['Atividades'=>$dadosAtividadeIntermediaria, 'IdAluno'=>$IdAluno, 'IdConteudo'=>$idConteudo, 'IdCurso'=>$IdCurso,'tipoAtividade'=>$tipoAtividade]);
        }
        if ($tipoAtividade == 'Teste Final Curso'){
            $colect = new Collection();
            $dados = TesteCursoModel::where('fk_conteudo_pertencente', $idConteudo)->get();
            foreach ($dados as $dado){
                $valorFkConteudo = $dado->fk_conteudo;
                $QuantidadeQuestoes = $dado->totalQuestao;
                $DadosQuestoes = QuestoesModel::where('fk_conteudo',$valorFkConteudo)->inRandomOrder()->limit($QuantidadeQuestoes)->get();
                foreach ($DadosQuestoes as $questoes){
                    $colect->push($questoes);
                }
            }
            $dadosTesteFinal = $colect->all();
            return view('Permisions.TelasAluno.testeConteudo', ['Atividades'=>$dadosTesteFinal, 'IdAluno'=>$IdAluno, 'IdConteudo'=>$idConteudo, 'IdCurso'=>$IdCurso,'tipoAtividade'=>$tipoAtividade]);
        }
    }

    public function Salvarprogresso(Request $request, $IdAluno, ConteudoModel $idConteudo, $IdCurso, $tipoAtividade)
    {
        if($tipoAtividade == 'testeConteudo'){
            $tipo_atividade = 'TC';
        }
        if($tipoAtividade == 'Teste Intermediario'){
            $tipo_atividade = 'TI';
        }
        if( $tipoAtividade=='Teste Final'){
            $tipo_atividade = 'TFU';
        }
        if($tipoAtividade=='Teste Final Curso'){
            $tipo_atividade = 'TFC';
        }

        $dado = ProgressoModel::where('fk_aluno',$IdAluno)->where('fk_conteudo',$idConteudo->id)->where('fk_curso',$IdCurso)->first();

        $conquistas = ConquistasAlunoModel::where('fk_aluno',$IdAluno)->first();

        HistoricoNotasAluno::create([
            'st_nome_disciplina' =>Null,
            'fk_aluno'=> $dado->fk_aluno,
            'fk_curso'=> $dado->fk_curso,
            'fk_unidade'=> $dado->fk_unidade,
            'fk_conteudo'=> $dado->fk_conteudo,
            'st_tipo_atividade'=>$tipo_atividade,
            'int_acertos'=>$request->int_acertos,
            'int_tempo_execucao'=>$request->int_tempo_execucao,
        ]);

        if($dado->int_submit_atividades == 2 and $dado->int_estrela_obtida < $request->int_estrela_obtida){

            $estrelasExtras = $request->int_estrela_obtida - $dado->int_estrela_obtida;
            $totalEstrelas = $conquistas->int_total_estrelas + $estrelasExtras;
            $conquistas->update(
                [
                    'int_total_estrelas'=> $totalEstrelas,
                ]
            );

            $dado->update(
                [
                    'int_submit_atividades'=>2,
                    'int_estrela_obtida'=> $request->int_estrela_obtida,
                ]
            );
        }

        if ($dado->int_submit_atividades == 1 or $dado->int_submit_atividades == 0){
            $totalEstrelas = $conquistas->int_total_estrelas + $request->int_estrela_obtida;

            $conquistas->update(
                [
                    'int_total_estrelas'=> $totalEstrelas,
                ]
            );
            $dado->update(
                [
                    'int_submit_atividades'=> 2,
                    'int_estrela_obtida'=> $request->int_estrela_obtida,
                ]
            );
        }


        $QuantosDados2 = count(ProgressoModel::where('fk_aluno',$IdAluno)->where('fk_curso',$IdCurso)->where('int_submit_atividades', 2)->get());

        $contadorFinal = 0;

        $dadoCurso2 = ProgressoModel::where('fk_aluno',$IdAluno)->where('fk_curso',$IdCurso)->get();
        $totalSubmits = count($dadoCurso2);
        $contador = 0;

        if ($QuantosDados2 ==$totalSubmits){
            $verificarSubmit = count(CursosConcluidosModel::where('fk_curso',$IdCurso)->where('fk_aluno',$IdAluno)->get());
            $TotalCursos = count(CursosConcluidosModel::where('fk_aluno',$IdAluno)->get());

            if ($verificarSubmit == 0){
                CursosConcluidosModel::create([
                    'fk_curso' =>$IdCurso,
                    'fk_aluno'=> $IdAluno,

                ]);
                $conquistas->update(
                    [
                        'int_total_cursos_concluidos'=> $TotalCursos + 1,
                    ]
                );
            }


        }else{
            foreach ($dadoCurso2 as $dado){
                if($contadorFinal == 1){
                    $dado->update(
                        [
                            'int_submit_atividades'=>1,
                        ]
                    );
                    break;
                }
                if ($dado->int_submit_atividades == 2){
                    $contador = $contador + 1;
                    if ($contador == $QuantosDados2 ){
                        $contadorFinal = $contadorFinal + 1;
                    }
                }
            }
        }

        $verificarSeExisteTarefa = count(TarefasRevisaoModel::where('fk_aluno',$IdAluno)->where('fk_curso',$IdCurso)->where('fk_unidade',$dado->fk_unidade)->where('fk_conteudo',$idConteudo->id)->where('submit_atividade',0)->get());

        if ($verificarSeExisteTarefa > 0){
            $tarefa = TarefasRevisaoModel::where('fk_aluno',$IdAluno)->where('fk_curso',$IdCurso)->where('fk_unidade',$dado->fk_unidade)->where('fk_conteudo',$idConteudo->id)->where('submit_atividade',0)->first();
            $tarefa->update([
                'int_estrelas_obtidas'=>$request->int_estrela_obtida,
                'submit_atividade'=> 1,
            ]);
            return redirect()->route('Aluno.vizualizarCurso2',['IdAluno'=>$IdAluno,'IdCurso'=>$IdCurso,'fkConteudo'=>$idConteudo->id]);
        }else{
            return redirect()->route('Aluno.vizualizarCurso',['IdAluno'=>$IdAluno,'IdCurso'=>$IdCurso]);
        }

    }


    public function vizualizarCurso4545($IdAluno, $IdCurso)
    {
        $Aluno = AlunoModel::where('id',$IdAluno)->first();

        $arrayIdUnidades = [];
        $dadoscurso = CursoModel::where('id',$IdCurso )->get();
        foreach ($dadoscurso as $cursos){
            foreach ($cursos->unidades as $dd){
                array_push($arrayIdUnidades, $dd->id );
            }
        }
        $dadosconteudos = ConteudoModel::wherein('fk_unidade',$arrayIdUnidades )->get();
        $unidades = UnidadeModel::wherein('id',$arrayIdUnidades )->get();
        $contadorUnidades = count($unidades);

        $informacoesProgressos = ProgressoModel::where('fk_aluno',$Aluno->id)->where('fk_curso',$IdCurso)->get();
        $DadosParaApresentar = [];
        $PrimeiroDadoParaApresentar = [];
        $NomesConteudos = [];

        $nomeConteudo0 = [];
        $FKUnidadeConteudo0 = [];
        $contador = 0;
        $NomeConteudoSemSubmit = [];
        $nomeUnidadeSemSubmit = [];
        foreach ($informacoesProgressos as $progresso){
            $IdConteudo = $progresso->fk_conteudo;
            $nomeCurso = $progresso->cursos->st_nome_curso;
            $idCurso = $progresso->cursos->id;
            $nomeUnidade = $progresso->unidades->st_nome_unidade;
            $IDUnidade = $progresso->unidades->id;
            $dadosCronograma = CronogramaModel::where('fk_conteudo',$IdConteudo)->orderBy('st_ordem_apresentacao')->get();
            $nomeConteudo = ConteudoModel::where('id',$IdConteudo)->first();
            if(in_array($nomeConteudo->st_nome_conteudo,$NomesConteudos )){
                foreach ($dadosCronograma as $dadoCronograma){
                    $dados = [$Aluno->id,$IdConteudo,$nomeConteudo->st_nome_conteudo,$nomeCurso,$nomeUnidade,$dadoCronograma->st_tipo_atividade,$dadoCronograma->id,$progresso->int_submit_atividades,$IDUnidade];
                    array_push($DadosParaApresentar, $dados);
                }
            }else{
                if ($contador != 0 ){
                    array_push($NomesConteudos,$nomeConteudo->st_nome_conteudo);
                }
                foreach ($dadosCronograma as $dadoCronograma){
                    if($contador == 0 ){
                        $dados = [$Aluno->id,$IdConteudo,$nomeConteudo->st_nome_conteudo,$nomeCurso,$nomeUnidade,$dadoCronograma->st_tipo_atividade,$dadoCronograma->id,$progresso->int_submit_atividades,$IDUnidade];
                        array_push($PrimeiroDadoParaApresentar, $dados);
                        $nomeConteudo0[0] = $nomeConteudo->st_nome_conteudo;
                        $FKUnidadeConteudo0[0] = $nomeConteudo->fk_unidade;
                    }else{
                        if ($progresso->int_submit_atividades == 0 and ! in_array($nomeConteudo->st_nome_conteudo,$NomeConteudoSemSubmit)){
                            array_push($nomeUnidadeSemSubmit, $nomeUnidade);
                            array_push($NomeConteudoSemSubmit, $nomeConteudo->st_nome_conteudo);
                        }
                        $dados = [$Aluno->id,$IdConteudo,$nomeConteudo->st_nome_conteudo,$nomeCurso,$nomeUnidade,$dadoCronograma->st_tipo_atividade,$dadoCronograma->id,$progresso->int_submit_atividades,$IDUnidade];
                        array_push($DadosParaApresentar, $dados);
                    }
                }
            }
            $contador = $contador + 1 ;
        }

        // pegando a porcentagem do curso
        $porcentagens = [];
        $totalAtiviades = count($informacoesProgressos);
        $AtividadesRealizadas = [];
        $NaoRespondeuNenhumaAtiviade = [];
        $contador = 1;
        foreach ($informacoesProgressos as $atividade){
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
            array_push($porcentagens, $value,0);
        }
        else{
            $dado =intval((count($AtividadesRealizadas) * 100)/$totalAtiviades);
            $value = $cursos->st_nome_curso;
            array_push($porcentagens,$value,$dado );
        }
        return ['IdAluno'=>$Aluno,'porcentagens'=>$porcentagens,'nomeUnidadeSemSubmit'=>$nomeUnidadeSemSubmit,'NomeConteudoSemSubmit'=>$NomeConteudoSemSubmit,'fkUnidade0'=>$FKUnidadeConteudo0,'nomeConteudo0'=>$nomeConteudo0,'PrimeiroDadoParaApresentar'=>$PrimeiroDadoParaApresentar,'DadosParaApresentar'=>$DadosParaApresentar, 'NomesConteudos'=>$NomesConteudos, 'IdCurso'=>$IdCurso,'DadosConteudos'=>$dadosconteudos, 'IDsUnidades'=>$unidades, 'contadorUnidades'=>$contadorUnidades];
    }
}
