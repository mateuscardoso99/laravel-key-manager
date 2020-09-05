<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*ROTAS DE PORTEIRO*/
Route::prefix('porteiro')->group(function(){
	Route::get('/', 'PorteiroController@index')->name('porteiro.index');

	Route::post('/', 'PorteiroController@store')->name('porteiro.store');
	
	Route::put('/alterar/{id}','PorteiroController@changeSituacao')->name('porteiro.alterar');

	Route::put('/update/{id}', 'PorteiroController@update')->name('porteiro.update');

	Route::delete('/delete/{id}', 'PorteiroController@delete')->name('porteiro.delete');
});

/* ROTAS DE PROFESSORES*/
Route::prefix('professor')->group(function(){
	Route::get('/', 'ProfessorController@index')->name('professor.index');

	Route::post('/', 'ProfessorController@store')->name('professor.store');
	
	Route::put('/alterar/{id}','ProfessorController@changeSituacao')->name('professor.alterar');

	Route::put('/update/{id}', 'ProfessorController@update')->name('professor.update');

	Route::delete('/delete/{id}', 'ProfessorController@delete')->name('professor.delete');
});

/* ROTAS DE ALUNOS*/
Route::prefix('aluno')->group(function(){
	Route::get('/', 'AlunoController@index')->name('aluno.index');
	
	Route::post('/', 'AlunoController@store')->name('aluno.store');
	
	Route::put('/alterar/{id}','AlunoController@changeSituacao')->name('aluno.alterar');

	Route::put('/update/{id}', 'AlunoController@update')->name('aluno.update');

	Route::delete('/delete/{id}', 'AlunoController@delete')->name('aluno.delete');
});

/* ROTAS DE CHAVES*/
Route::prefix('chave')->group(function(){
	Route::get('/', 'ChaveController@index')->name('chave.index');

	Route::post('/', 'ChaveController@store')->name('chave.store');

	Route::put('/update/{id}', 'ChaveController@update')->name('chave.update');

	Route::delete('/delete/{id}', 'ChaveController@delete')->name('chave.delete');

	Route::get('/manager/{id}','ChaveController@managerChave')->name('chave.manager');
	Route::post('/iniciar-aula/{id}','ChaveController@iniciarAula')->name('chave.iniciar');
	Route::post('/encerrar-aula/{id}','ChaveController@encerrarAula')->name('chave.encerrar');
});


/* ROTAS DE AULAS*/
Route::prefix('aula')->group(function(){
	Route::get('/', 'AulaController@index')->name('aula.index');

	Route::delete('/delete/{id}', 'AulaController@delete')->name('aula.delete');
});

/* ROTAS DE RELATÓRIOS*/
Route::prefix('relatorios')->group(function(){
	Route::get('', function(){
		return view('relatorios.index');
	})->name('relatorios');

	Route::get('/chaves/situacao','ChaveController@chavesSituacao')->name('chave.situacao');
	Route::get('/chaves/devolucoes','ChaveController@chavesDevolvidas')->name('chave.devolucao');
});