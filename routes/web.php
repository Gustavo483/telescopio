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
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
    Route::controller(PermisionController::class)->group(function () {
        Route::get('/', 'inicioPagina')->name('inicio.pagina');
    });

    Route::middleware(['admin'])->group(function (){
        Route::controller(AdminController::class)->group(function () {
            Route::get('/registerAluno', 'RegistrarAluno')->name('registerAluno');
            Route::get('/registerProfessor', 'RegistrarProfessor')->name('registerProfessor');
            Route::post('/SalvarAluno', 'RegistrarAlunoStore')->name('registerAlunoStore');
            Route::post('/registroProfessor', 'RegistrarProfessorStore')->name('RegistrarProfessorStore');//ainda não implementado
            Route::get('/AlunoCurso', 'VincularAlunoCursoCreate')->name('AlunoCursodf');
            Route::post('/VincularAlunoCurso', 'VincularAlunoCursoStore')->name('VincularAlunoCurso');
            Route::get('/listarAlunosCursos', 'listarAlunosCursos')->name('listarAlunosCursos');
            Route::delete('/deleteAlunoCurso/{aluno}/{curso}', 'deleteAlunoCurso')->name('deleteAlunoCurso');
        });

        Route::controller(CursoController::class)->group(function () {
            Route::get('/curso', 'index')->name('curso.index');
            Route::get('curso/create', 'create')->name('curso.create');
            Route::post('curso/store', 'store')->name('curso.store');
            Route::get('relacioamento/{curso}/{unidade}', 'CriarUnidadeDiretoParaCurso')->name('CriarUnidade.Curso');
            Route::get('Curso/{curso}','vizualizarCurso')->name('vizualizar.Curso');
            Route::get('/excluir{UnidadeId}{CursoId}/{UnidadeNome}', 'excluirUnidadeDoCurso')->name('excluir.unidadeDoCurso');
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

            Route::get('editarME{IDQuestao}', 'EditarQuestaoConteudoME')->name('editar.QuestaoME');
            Route::get('editarRB{IDQuestao}', 'EditarQuestaoConteudoRB')->name('editar.QuestaoRB');
            Route::get('editarRN{IDQuestao}', 'EditarQuestaoConteudoRN')->name('editar.QuestaoRN');

            Route::put('updadeME{IDQuestao}', 'updadeQuestaoME')->name('update.QuestaoME');
            Route::put('updadeRB{IDQuestao}', 'updadeQuestaoRB')->name('update.QuestaoRB');
            Route::put('updadeRN{IDQuestao}', 'updadeQuestaoRN')->name('update.QuestaoRN');

            Route::delete('delete{IDQuestao}', 'DeleteQuestaoConteudo')->name('delete.QuestaoConteudo');
            Route::post('Store/QuestaoME{dadosconteudo}', 'StoreQuestaoME')->name('StoreQuestaoME.conteudo');
            Route::post('Store/QuestaoRB{dadosconteudo}', 'StoreQuestaoRB')->name('StoreQuestaoRB.conteudo');
            Route::post('Store/QuestaoRN{dadosconteudo}', 'StoreQuestaoRN')->name('StoreQuestaoRN.conteudo');
            Route::post('Store/Conteudo{dadosconteudo}', 'StoreConteudoEscrito')->name('StoreConteudoEscrito.conteudo');

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
            Route::get('/VizualizarAtividadeAluno{IdAluno}/{idConteudo}/{IdCronograma}/{tipoAtividade}', 'MostrarExercicioAluno')->name('Aluno.MostrarExercicio');
            Route::post('/VizualizarAtividadeAluno{IdAluno}/{idConteudo}', 'Salvarprogresso')->name('Aluno.SalvarProgresso');
        });
    });

});
