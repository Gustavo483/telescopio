<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SummernoteController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\ConteudoController;
use App\Http\Controllers\CronogramaController;
use App\Http\Controllers\CadastrasAtividadesControlller;
use App\Http\Controllers\QuestoesFizacaoController;
use App\Http\Controllers\PermisionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\ImageUploadController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    Route::controller(PermisionController::class)->group(function () {
        Route::get('/', 'inicioPagina')->name('inicio.pagina');
        Route::get('/dashboard', 'inicioPagina')->name('dashboard');
    });

    Route::middleware(['admin'])->group(function (){
        Route::get('upload-image', [ ImageUploadController::class, 'index' ]);
        Route::post('upload-image', [ ImageUploadController::class, 'store' ])->name('image.store');

        Route::controller(AdminController::class)->group(function () {
            Route::get('/revisaoForma', 'revisaoForma')->name('revisaoForma');
            Route::post('/CadastrarFormaDeRevisao/{revisao}', 'CadastrarFormadeRevisao')->name('CadastrarFormadeRevisao');
            //Páginas de trofeu
            Route::get('/CadastrarTrofeus', 'CadastrarTrofeusIndex')->name('CadastrarTrofeus');
            Route::post('/CadastrarTrofeusStore', 'CadastrarTrofeuStore')->name('CadastrarTrofeu.store');
            Route::delete('/deleteTrofeu/{trofeu}', 'DeleteTrofeu')->name('delete.Trofeu');
            Route::get('/EditarTrofeu/{trofeu}', 'EditarTroveu')->name('Editar.Troveu');
            Route::put('/UpdadeTrofeu/{trofeu}', 'UpdadeTroveu')->name('UpdadeTroveu');

            // Páginas de petz
            Route::get('/vizualizarPets', 'vizualizarPets')->name('vizualizarPets');
            Route::post('/CadastrarPet', 'CadastrarPet')->name('CadastrarPet.store');
            Route::delete('/deletePet/{Pet}', 'DeletePet')->name('delete.pet');
            Route::get('/EditarPet/{Pet}', 'EditarPet')->name('Editar.Pets');
            Route::put('/UpdadePet/{Pet}', 'UpdadePet')->name('UpdadePet');
            Route::get('/registerAluno/{Admin}', 'RegistrarAluno')->name('registerAluno');
            Route::get('/registerProfessor/{Admin}', 'RegistrarProfessor')->name('registerProfessor');
            Route::get('/registerAdmin/{Admin}', 'registerAdmin')->name('registerAdmin');
            Route::post('/SalvarAluno', 'RegistrarAlunoStore')->name('registerAlunoStore');
            Route::post('/registroProfessor', 'RegistrarProfessorStore')->name('RegistrarProfessorStore');//ainda não implementado
            Route::post('/registerAdmin', 'registerAdminStore')->name('registerAdminStore');
            Route::get('/AlunoCurso', 'VincularAlunoCursoCreate')->name('AlunoCursodf');
            Route::post('/VincularAlunoCurso', 'VincularAlunoCursoStore')->name('VincularAlunoCurso');
            Route::get('/listarAlunosCursos', 'listarAlunosCursos')->name('listarAlunosCursos');
            Route::get('/VizualizarCursosCadastradosAluno/{aluno}', 'VizualizarCursosCadastradosAluno')->name('VizualizarCursosCadastradosAluno');
            Route::get('/VizualizarCursosCadastradosProfessor/{professor}', 'VizualizarCursosCadastradosProfessor')->name('VizualizarCursosCadastradosProfessor');
            Route::delete('/deleteAlunoCurso/{aluno}/{curso}', 'deleteAlunoCurso')->name('deleteAlunoCurso');
            Route::get('CadastrarFormatodeRevisão', 'CadastrarFormatodeRevisao')->name('CadastrarFormatodeRevisão');


            //rotas para cadastrar professor
            Route::get('VincularCursoProfessor', 'VincularProfessorCursoCreate')->name('ProfessorCurso');
            Route::post('/VincularProfessorCurso', 'VincularProfessorCursoStore')->name('VincularProfessorCurso');
            Route::get('/listarprofessorCursos', 'listarprofessoresCursos')->name('listarprofessoresCursos');
            Route::delete('/deleteProfessorCurso/{professor}/{curso}', 'deleteProfessorCurso')->name('deleteProfessorCurso');
        });

        Route::controller(CursoController::class)->group(function () {
            Route::get('/curso', 'index')->name('curso.index');
            Route::get('curso/create', 'create')->name('curso.create');
            Route::post('curso/store', 'store')->name('curso.store');
            Route::get('relacioamento/{curso}/{unidade}', 'CriarUnidadeDiretoParaCurso')->name('CriarUnidade.Curso');
            Route::get('Curso/{curso}','vizualizarCurso')->name('vizualizar.Curso');
            Route::get('/excluir{UnidadeId}{CursoId}/{UnidadeNome}', 'excluirUnidadeDoCurso')->name('excluir.unidadeDoCurso');
            Route::post('SalvarNovaDisciplina/store', 'SalvarNovaDisciplina')->name('SalvarNovaDisciplina.Curso');
            Route::get('ExcluirCurso/{curso}', 'ExcluirCurso')->name('excluir.Curso');
        });

        Route::controller(SummernoteController::class)->group(function () {
            Route::get('/summernote', 'index')->name('summernote.index');
            Route::get('summernote/create', 'create')->name('summernote.create');
            Route::post('summernote/store', 'store')->name('summernote.store');
        });

        Route::controller(UnidadeController::class)->group(function () {
            Route::get('/unidade', 'index')->name('unidade.index');
            Route::post('unidade/store', 'store')->name('unidade.store');
            Route::get('unidade/{unidade}','vizualizarUnidade')->name('vizualizar.unidade');
            Route::post('unidade/store{IDCurso}', 'storeVinculacaoCurso')->name('unidade.storeVinculacao');
            Route::post('unidade/vincular', 'VincularCursoUnidade')->name('Unidade.VincularCursoUnidade');
            Route::get('deletarUnidade/{unidade}','deletarUnidade')->name('deletar.unidade');
            Route::post('atualizarUnidade/{unidade}','atualizarUnidade')->name('atualizarUnidade');

        });

        Route::controller(ConteudoController::class)->group(function () {
            Route::post('conteudo/create{idUnidade}', 'store')->name('conteudo.store');
            Route::get('conteudo/visualizar{conteudo}', 'vizualizarConteudo')->name('vizualizar.conteudo');
            Route::delete('conteudo/deletar{conteudo}', 'delete')->name('delete.conteudo');
        });

        Route::controller(CronogramaController::class)->group(function () {
            Route::post('tesr/create{dadosconteudo}', 'store')->name('cronograma.store');
            Route::delete('cronograma/deletar{cronograma}', 'deleteatividadeCronograma')->name('delete.atividadeCronograma');
        });

        Route::controller(CadastrasAtividadesControlller::class)->group(function () {
            Route::get('criarConteudoEscrito', 'criarConteudoEscrito')->name('criarConteudoEscrito.conteudo');
            Route::get('criarQuestaoME{dadosconteudo}', 'criarQuestaoME')->name('criarQuestaoME.conteudo');
            Route::get('criarQuestaoRB{dadosconteudo}', 'criarQuestaoRB')->name('criarQuestaoRB.conteudo');
            Route::get('criarQuestaoRN{dadosconteudo}', 'criarQuestaoRN')->name('criarQuestaoRN.conteudo');
            Route::get('vizualixarAtividades/{dadosconteudo}', 'vizualizarAtividadesCurso')->name('vizualizar.TodasAtividades');
            Route::get('vizualixarTextoEscrito/{dadosconteudo}/{idCronograma}', 'vizualixarTextoEscrito')->name('vizualixarTextoEscrito');
            Route::get('editarME{IDQuestao}', 'EditarQuestaoConteudoME')->name('editar.QuestaoME');
            Route::get('editarRB{IDQuestao}', 'EditarQuestaoConteudoRB')->name('editar.QuestaoRB');
            Route::get('editarRN{IDQuestao}', 'EditarQuestaoConteudoRN')->name('editar.QuestaoRN');
            Route::get('EditarTextoAtividade{textoEscrito}/{dadosconteudo}', 'EditarTextoAtividade')->name('EditarTextoAtividade');
            Route::put('updadeME{IDQuestao}', 'updadeQuestaoME')->name('update.QuestaoME');
            Route::put('updadeRB{IDQuestao}', 'updadeQuestaoRB')->name('update.QuestaoRB');
            Route::put('updadeRN{IDQuestao}', 'updadeQuestaoRN')->name('update.QuestaoRN');
            Route::delete('delete{IDQuestao}', 'DeleteQuestaoConteudo')->name('delete.QuestaoConteudo');
            Route::post('Store/QuestaoME{dadosconteudo}', 'StoreQuestaoME')->name('StoreQuestaoME.conteudo');
            Route::post('Store/QuestaoRB{dadosconteudo}', 'StoreQuestaoRB')->name('StoreQuestaoRB.conteudo');
            Route::post('Store/QuestaoRN{dadosconteudo}', 'StoreQuestaoRN')->name('StoreQuestaoRN.conteudo');
            Route::post('Store/Conteudo{dadosconteudo}', 'StoreConteudoEscrito')->name('StoreConteudoEscrito.conteudo');
            Route::post('update/updateConteudoEscrito{dadosconteudo}/{textoEscrito}', 'updateConteudoEscrito')->name('updateConteudoEscrito');
            Route::post('update/Testefinal{dadosconteudo}', 'UpdateTesteFina')->name('updateTesteFinalUnidade.conteudo');
            Route::post('Store/Testefinal{dadosconteudo}', 'StoreTesteFina')->name('StoreTesteFinalUnidade.conteudo');
            Route::get('vizualixarTesteFinalUnidade/{dadosconteudo}', 'vizualizarTesteFinalUnidade')->name('vizualizar.atividadeFinalUnidade');
            Route::delete('DeletarConteudoFinal/{IDexclusao}/{dadosconteudo}', 'ExcluirUnidadeTesteFinal')->name('delete.ConteudoTesteFinal');
            Route::get('editTesteFinal/{dadosconteudo}', 'EditarTesteFinal')->name('edit.ConteudoTesteFinal');
            Route::post('update/Testeintermediario{dadosconteudo}', 'UpdateTesteIntermediario')->name('updateTesteIntermediarioUnidade.conteudo');
            Route::post('Store/Testeintermediario{dadosconteudo}', 'StoreTesteIntermediario')->name('StoreTesteIntermediarioUnidade.conteudo');
            Route::get('vizualixarTesteintermediarioUnidade/{dadosconteudo}', 'vizualizarTesteIntermediarioUnidade')->name('vizualizar.atividadeIntermediarioUnidade');
            Route::delete('DeletarConteudointermediario/{IDexclusao}/{dadosconteudo}', 'ExcluirUnidadeTesteIntermediario')->name('delete.ConteudoTesteIntermediario');
            Route::get('editTesteintermediario/{dadosconteudo}', 'EditarTesteIntermediario')->name('edit.ConteudoTesteIntermediario');
            Route::post('SelecionarConteudosParaTesteFinalCurso/{dadosconteudo}', 'TesteFinalCursoIndex')->name('SelecionarConteudos.testeFinalCurso');
            Route::post('Store/TestefinalCurso/{dadosconteudo}/{IDCurso}', 'StoreTesteFinalCurso')->name('StoreTesteFinalCursocdhj.conteudo');
            Route::delete('DeletarConteudoFinalCurso/{IDexclusao}/{dadosconteudo}', 'ExcluirUnidadeTesteFinalCurso')->name('delete.ConteudoTesteFinalCurso');
            Route::get('editTesteFinalCurso/{dadosconteudo}/{fkCurso}', 'EditarTesteFinalCurso')->name('edit.ConteudoTesteFinalCurso');
            Route::get('vizualixarTesteFinalCurso/{dadosconteudo}', 'vizualizarTesteFinalCurso')->name('vizualizar.TesteFinalCurso');
            Route::post('updateTesteFinalCurso/{dadosconteudo}/{IDCurso}', 'updateTesteFinalCurso')->name('update.ConteudoTesteFinalCurso');
        });

        Route::controller(QuestoesFizacaoController::class)->group(function () {
            Route::get('criarQuestaoFZ{dadosconteudo}', 'criarQuestaoFZ')->name('criarQuestaoFZ.conteudo');
            Route::post('Store/QuestaoFizacaoME{dadosconteudo}', 'StoreQuestaoME')->name('StoreQuestaoFZME.conteudo');
            Route::post('Store/QuestaoFizacaoRB{dadosconteudo}', 'StoreQuestaoRB')->name('StoreQuestaoFZRB.conteudo');
            Route::post('Store/QuestaoFizacaoRN{dadosconteudo}', 'StoreQuestaoRN')->name('StoreQuestaoFZRN.conteudo');
            Route::get('vizualixarAtividadesFizacao/{dadosconteudo}', 'vizualizarAtividadesfZ')->name('vizualizar.TodasAtividadesFZ');
            Route::get('editarFZME{IDQuestao}', 'EditarQuestaoConteudoME')->name('editar.QuestaoFZME');
            Route::get('editarFZRB{IDQuestao}', 'EditarQuestaoConteudoRB')->name('editar.QuestaoFZRB');
            Route::get('editarFZRN{IDQuestao}', 'EditarQuestaoConteudoRN')->name('editar.QuestaoFZRN');
            Route::put('updadeFZME{IDQuestao}', 'updadeQuestaoME')->name('update.QuestaoFZME');
            Route::put('updadeFZRB{IDQuestao}', 'updadeQuestaoRB')->name('update.QuestaoFZRB');
            Route::put('updadeFZRN{IDQuestao}', 'updadeQuestaoRN')->name('update.QuestaoFZRN');
            Route::delete('deleteFZ/{IDQuestao}', 'DeleteQuestaoConteudosdsd')->name('delete.QuestaoFZ');

        });
    });

    Route::middleware(['aluno'])->group(function (){
        Route::controller(AlunoController::class)->group(function () {
            Route::get('/VizualizarCursoAluno{IdAluno}/{IdCurso}', 'vizualizarCurso')->name('Aluno.vizualizarCurso');
            Route::get('/VizualizarAtividadeAluno/sdcsdc{IdAluno}/{idConteudo}/{IdCronograma}/{tipoAtividade}/{IdCurso}', 'MostrarExercicioAluno')->name('Aluno.MostrarExercicio');
            Route::post('/SalvarProgresso{IdAluno}/{idConteudo}/{IdCurso}/{tipoAtividade}', 'Salvarprogresso')->name('Aluno.SalvarProgresso');
            Route::post('/SalvarAtividadeFizacao{IdAluno}/{idConteudo}/{IdCurso}/{tipoAtividade}', 'SalvarAtividadeFizacao')->name('Aluno.SalvarAtividadeFizacao');
            Route::get('/VizualizarPetsAluno{IdAluno}', 'VizualizarPetsAluno')->name('VizualizarPetsAluno');
            Route::post('/ComprarPet{IDAluno}/{IDPet}', 'ComprarPet')->name('ComprarPet');
            Route::get('/VizualizarTrofeusAluno{IdAluno}', 'VizualizarTrofeusAluno')->name('VizualizarTrofeusAluno');
            Route::get('/VizualizarTarefasAluno{IdAluno}', 'VizualizarTarefasAluno')->name('VizualizarTarefasAluno');
            Route::get('/direcionarAlunoParaTarefa{DatosTarefa}', 'direcionarAlunoParaTarefa')->name('direcionarAlunoParaTarefa');
        });
    });

    Route::middleware(['professor'])->group(function (){
        Route::controller(ProfessorController::class)->group(function () {
            Route::get('/VizualizarCursoAluno{IDProfessor}', 'vizualizarCurso')->name('vizualizarCursos.Professor');
            Route::get('/VizualizarAlunosCadastradosCurso{IDCurso}/{IDProfessor}', 'vizualizarAlunosCadastradosCurso')->name('vizualizarAlunosCadastradosNoCurso.Professor');
            Route::get('/VizualizarprogressoAluno/{IDCurso}/{IDProfessor}/{alunos}', 'vizualizarProgressoAluno')->name('vizualizarProgressoAluno.Professor');
            Route::get('/AtividadesAluno/{Aluno}/{IDCurso}/{IDProfessor}', 'atividadesAluno')->name('atividadesAluno.professor');
            Route::get('/CursosAluno/{Aluno}/{IDCurso}/{IDProfessor}', 'CursosAluno')->name('CursosAluno.professor');
            Route::get('/ProgressoAluno/{Aluno}/{IDCurso}/{IDProfessor}', 'ProgressoAluno')->name('ProgressoAluno.professor');
            Route::get('/TarefasAluno/{Aluno}/{IDCurso}/{IDProfessor}', 'TarefasAluno')->name('TarefasAluno.professor');
            Route::post('/VincularAlunoCursoPeloProfessor/{Aluno}/{IDCurso}/{IDProfessor}', 'VincularAlunoCurso')->name('VincularAlunoCurso.professor');
            Route::post('dfvdfvdfd/{Aluno}/{IDCurso}/{IDProfessor}/{IDUnidade}/{IDConteudo}', 'CadastrarAtividadeAluno')->name('CadastrarAtividadeAluno.professor');
            Route::delete('deleteTarefaAluno/{Aluno}/{IDCurso}/{IDProfessor}/{IDTarefa}', 'deleteTarefaAluno')->name('deleteTarefaAluno.professor');
            //Rotas para ver todos os alunos e suas funcionalidades
            Route::get('/vizualizarTodosAlunos/{IDProfessor}', 'vizualizarTodosAlunos')->name('vizualizarTodosAlunos.Professor');
            Route::get('/AtividadesAluno2/{Aluno}/{IDProfessor}', 'atividadesAluno2')->name('atividadesAluno2.professor');
            Route::get('/CursosAluno2/{Aluno}/{IDProfessor}', 'CursosAluno2')->name('CursosAluno2.professor');
            Route::get('/ProgressoAluno2/{Aluno}/{IDProfessor}', 'ProgressoAluno2')->name('ProgressoAluno2.professor');
            Route::get('/TarefasAluno2/{Aluno}/{IDProfessor}', 'TarefasAluno2')->name('TarefasAluno2.professor');
            Route::post('/VincularAlunoCursoPeloProfessor2/{Aluno}/{IDProfessor}', 'VincularAlunoCurso2')->name('VincularAlunoCurso2.professor');
            Route::post('fsdvdsfvsdfvd/{Aluno}/{IDCurso}/{IDProfessor}/{IDUnidade}/{IDConteudo}', 'CadastrarAtividadeAluno2')->name('CadastrarAtividadeAluno2.professor');
            Route::delete('deleteTarefaAluno2/{Aluno}/{IDProfessor}/{IDTarefa}', 'deleteTarefaAluno2')->name('deleteTarefaAluno2.professor');
        });
    });
});
