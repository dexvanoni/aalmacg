<?php

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
    return view('welcome');
})->name('welcome');

Auth::routes();


//rota para view HOME após login
Route::get('/home', 'HomeController@index')->name('home');

//rotas padrão do fluxo CRUD de cada módulo
Route::resource('reserva', 'ReservaController');
Route::resource('socio', 'SocioController');
Route::resource('diretor', 'DiretorController');
Route::resource('livro', 'LivroController');
Route::resource('evento', 'EventoController');
Route::resource('espaco', 'EspacoController');
Route::resource('piscina', 'PiscinaController');
Route::resource('adm', 'AdmController');
Route::resource('carteira', 'CarteiraController');
Route::resource('dependente', 'DependenteController');
Route::resource('escala', 'EscalaController');
Route::resource('notificacao', 'NotificacaoController');
Route::resource('carga', 'CargaController');
Route::resource('esporte', 'EsporteController');
Route::resource('cautela', 'CautelaController');
Route::resource('aviso', 'AvisoController');

//rota para check de PIN e SARAM para usuário fazer nova reserva de espaço.

//abre a view para login
Route::get('check_reserva', 'ReservaController@check_reserva')->name('check_reserva');
//faz o check de SARAM e PIN
Route::get('check_reserva_pin', 'ReservaController@check_reserva_pin')->name('check_reserva_pin');

//sobre o clube e regras
Route::get('/sobre', function () {
    return view('sobre');
})->name('sobre');

//rota que pesquisa disponibilidade para reserva (DASH do diretor)
Route::post('reserva/disp', 'ReservaController@disp')->name('disp');
Route::post('reserva/disp2', 'ReservaController@disp2')->name('disp2');

//rotas para ativar e desativar o sócio e seus dependentes
Route::get('/socio/{id}/desativar', 'SocioController@desativar')->name('socio.desativar');
Route::get('/socio/{id}/ativar', 'SocioController@ativar')->name('socio.ativar');

// rota de novo dependente a partir da lista de sócios
Route::get('/dependente/{id}/new_dep', 'DependenteController@new_dep')->name('dependente.new_dep');

//rota de login do sócio para fazer reserva
//chama o form
Route::get('login_socio', 'ReservaController@login_socio')->name('login_socio');
//verifica o login e direciona para o create
Route::post('login_socio_dados', 'ReservaController@login_socio_dados')->name('login_socio_dados');

//nova notificação do sócio
Route::get('/notificacao/{id}/nova', 'NotificacaoController@nova')->name('notificacao.nova');

//rotas para desativar notificação do sócio e seus dependentes
Route::get('/notificacao/{id}/desativar', 'NotificacaoController@desativar')->name('notificacao.desativar');

//chama o form de atendimento de reserva pelo diretor
Route::get('reserva/{id}/atender', 'ReservaController@atender')->name('atender');
//atende reserva do sócio
Route::post('atender_reserva', 'ReservaController@atender_reserva')->name('atender_reserva');
Route::get('/reserva/{id}/desativar', 'ReservaController@desativar')->name('reserva.desativar');

//rota de pesquisa da carteirinha para uso da piscina
Route::post('piscina/pesquisa', 'PiscinaController@pesquisa')->name('piscina.pesquisa');
