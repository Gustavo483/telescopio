<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SummernoteController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\ConteudoController;
use App\Http\Controllers\CronogramaController;
use App\Http\Controllers\CadastrasAtividadesControlller;

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
Route::controller(SummernoteController::class)->group(function () {
    Route::get('/summernote', 'index')->name('summernote.index');
    Route::get('summernote/create', 'create')->name('summernote.create');
    Route::post('summernote/store', 'store')->name('summernote.store');
});

Route::controller(CursoController::class)->group(function () {
    Route::get('/', 'inicioPágina')->name('inicio.página');
    Route::get('/curso', 'index')->name('curso.index');
    Route::get('curso/create', 'create')->name('curso.create');
    Route::post('curso/store', 'store')->name('curso.store');
    Route::get('relacioamento/{curso}/{unidade}', 'CriarUnidadeDiretoParaCurso')->name('CriarUnidade.Curso');
    Route::get('Curso/{curso}','vizualizarCurso')->name('vizualizar.Curso');
    Route::get('/excluir{UnidadeId}{CursoId}/{UnidadeNome}', 'excluirUnidadeDoCurso')->name('excluir.unidadeDoCurso');
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
});