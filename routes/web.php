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


Auth::routes(['verify'=>true]);

Route::get('profile', function(){
    //Only verified users may enter...
})->middleware('verified');

Route::get('/logout','Auth\LoginController@logout');

Route::group(['middleware' => 'auth'], function() {
    //Pagina pricipal
    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index');
    //

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', 'UsersController@index')->name('users.users.index');
        Route::get('/create','UsersController@create')->name('users.users.create');
        Route::get('/show/{users}','UsersController@show')->name('users.users.show');
        Route::get('/{users}/edit','UsersController@edit')->name('users.users.edit');
        Route::post('/', 'UsersController@store')->name('users.users.store');
        Route::post('users/{users}', 'UsersController@update')->name('users.users.update');
        Route::delete('/users/{users}','UsersController@destroy')->name('users.users.destroy');

        Route::get('users/import/index', 'UsersController@index_import')->name('users.users.index.import');
        Route::post('users/import', 'UsersController@import')->name('users.users.import');

        Route::post('users/upload', 'UsersController@upload');
    });



    Route::get('/bitacoras', 'BitacorasController@index')->name('bitacoras.bitacora.index');
    Route::post('/bitacoras/search', 'BitacorasController@search')->name('bitacoras.bitacora.search');




    Route::group(['prefix' => 'sections'], function () {
        Route::get('/',['middleware'=>'permissions:["Secciones"],["R"]','uses'=>'PermissionsController@sections'])->name('sections.index');
        Route::get('/edit/{id}',['middleware'=>'permissions:["Secciones"],["C"]','uses' => 'PermissionsController@sectionsEdit']);
        Route::post('/save',['middleware'=>'permissions:["Secciones"],["W"]','uses' => 'PermissionsController@sectionsSave']);
        Route::post('/update',['middleware'=>'permissions:["Secciones"],["C"]','uses' => 'PermissionsController@sectionsSave']);
        Route::get('/delete/{id}',['middleware'=>'permissions:["Secciones"],["D"]','uses' => 'PermissionsController@sectionsDelete']);

    });

    Route::get('permissions/getProfiles',['middleware'=>'permissions:["Usuarios"],["W"]','uses'=>'ProfilesController@getProfiles']);
    Route::get('profiles',['middleware'=>'permissions:["Perfiles"],["R"]','uses'=>'ProfilesController@profiles']);
	Route::get('profiles/edit/{id}',['middleware'=>'permissions:["Perfiles"],["C"]','uses'=>'ProfilesController@profilesEdit']);
	Route::post('profiles/save',['middleware'=>'permissions:["Perfiles"],["W"]','uses'=>'ProfilesController@profilesSave']);
	Route::post('profiles/update',['middleware'=>'permissions:["Perfiles"],["C"]','uses'=>'ProfilesController@profilesSave']);
    Route::get('profiles/delete/{id}',['middleware'=>'permissions:["Perfiles"],["D"]','uses'=>'ProfilesController@profilesDelete']);


    /**/
    Route::get('profile-permissions',['middleware'=>'permissions:["Permisos"],["R"]','uses'=>'PermissionsController@profilePermissions']);
	Route::post('addPermissions',['middleware'=>'permissions:["Permisos"],["W"]','uses'=>'PermissionsController@addPermissions']);
	Route::post('removePermissions',['middleware'=>'permissions:["Permisos"],["W"]','uses'=>'PermissionsController@removePermissions']);
	Route::post('addPermissions_user',['middleware'=>'permissions:["Permisos"],["W"]','uses'=>'PermissionsController@addPermissions_user']);
    Route::post('removePermissions_user',['middleware'=>'permissions:["Permisos"],["W"]','uses'=>'PermissionsController@removePermissions_user']);

    Route::group(['prefix' => 'clientes'], function () {
        Route::get('/', 'CustomersController@index')->name('customers.index');
        Route::get('/create','CustomersController@create')->name('customers.create');
        Route::get('/show/{clientes}','CustomersController@show')->name('customers.show');
        Route::get('/{clientes}/edit','CustomersController@edit')->name('customers.edit');
        Route::post('update', 'CustomersController@update')->name('customers.update');
        Route::delete('/clientes/{clientes}','CustomersController@destroy')->name('customers.destroy');
    });

});


