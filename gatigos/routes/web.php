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
Auth::routes();

Route::get('/', function () {
	if(Auth::user()) {
			    return view('sample');
	} else {
		   return view('auth/login');
	}
});

Route::GET('/citas', function () {
    return view('citas');
});

Route::GET('/historialOnly', 'HomeController@historial');

Route::post('historialOnly', 'HistorialController@searchFullDataPet');

Route::post('searchInquiry', 'HistorialController@searchInquiry');

Route::post('addInquiry','HistorialController@addInquiry');

Route::post('updatePet','HistorialController@updatePet')->middleware('updatePet');

Route::get('/register', function () {
  return view('auth/register');
})->name('register');

Route::get('/altas', function () {
    return view('altas');
});
Route::POST('mailingAlert', 'MailingController@alertMailingDates')->name('mailingAlert');

Route::GET('/buscadorClientes', 'HomeController@buscadorClientes');
// Listar todas las mascotas de un cliente.
Route::POST('buscadorClientes', 'HistorialController@searchAllClientPets')->middleware('usuariosPaginas');

Route::post('ownerRegister','AltaController@ownerRegister')->middleware('altasOwner');

Route::post('petRegister','AltaController@petRegister')->middleware('altasPet');;

Route::get('/perfil', 'AltaController@userProfile')->name('perfil');

Route::post('updateUser', 'AltaController@updateUser')->middleware('profileUpdate');

Route::GET('/misCitas', 'VetController@searchProxDates');

//INICIO TABLA USUARIOS MODIFICAR/LISTAR******************************************************************
Route::get('/usuarios','AdminController@listAllUsers')->name('listarUsuarios');
Route::post('updateUsersWork','AdminController@updateUser')->middleware('modificarUsuarios');
//FIN TABLA USUARIOS MODIFICAR/LISTAR******************************************************************

Route::GET('/clienteIndex', function() {
	return view('clienteIndex');
});
Route::post('/perfilCliente', function () {
    return view('perfilCliente');
});

Route::post('clientProfile','AltaController@clientProfile');
//MODAL MODIFICAR DATOS CLIENTE
Route::post('updateClient','AltaController@updateClient')->middleware('clientUpdate');

Route::get('lang/{lang}', function ($lang) {
    session(['lang' => $lang]);
    App::setLocale($lang);

    return redirect()->back();
});

Route::get('/home', 'HomeController@index')->name('home');
