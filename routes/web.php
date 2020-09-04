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

	Route::get('/create', 'PorteiroController@create')->name('porteiro.create');
	Route::post('/', 'PorteiroController@store')->name('porteiro.store');
	
	Route::put('/alterar/{id}','PorteiroController@changeSituacao')->name('porteiro.alterar');

	Route::get('/edit/{id}','PorteiroController@edit')->name('porteiro.edit');
	Route::put('/update/{id}', 'PorteiroController@update')->name('porteiro.update');

	Route::delete('/delete/{id}', 'PorteiroController@delete')->name('porteiro.delete');
});

/* ROTAS DE PROFESSORES*/
Route::prefix('professor')->group(function(){
	Route::get('/', 'ProfessorController@index')->name('professor.index');

	Route::get('/create', 'ProfessorController@create')->name('professor.create');
	Route::post('/', 'ProfessorController@store')->name('professor.store');
	
	Route::put('/alterar/{id}','ProfessorController@changeSituacao')->name('professor.alterar');

	Route::get('/edit/{id}','ProfessorController@edit')->name('professor.edit');
	Route::put('/update/{id}', 'ProfessorController@update')->name('professor.update');

	Route::delete('/delete/{id}', 'ProfessorController@delete')->name('professor.delete');
});

/* ROTAS DE ALUNOS*/
Route::prefix('aluno')->group(function(){
	Route::get('/', 'AlunoController@index')->name('aluno.index');

	Route::get('/create', 'AlunoController@create')->name('aluno.create');
	Route::post('/', 'AlunoController@store')->name('aluno.store');
	
	Route::put('/alterar/{id}','AlunoController@changeSituacao')->name('aluno.alterar');

	Route::get('/edit/{id}','AlunoController@edit')->name('aluno.edit');
	Route::put('/update/{id}', 'AlunoController@update')->name('aluno.update');

	Route::delete('/delete/{id}', 'AlunoController@delete')->name('aluno.delete');
});

/* ROTAS DE CHAVES*/
Route::prefix('chave')->group(function(){
	Route::get('/', 'ChaveController@index')->name('chave.index');

	Route::get('/create', 'ChaveController@create')->name('chave.create');
	Route::post('/', 'ChaveController@store')->name('chave.store');

	Route::get('/edit/{id}','ChaveController@edit')->name('chave.edit');
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
Route::get('/relatorios', function(){
	return view('relatorios.index');
})->name('relatorios');