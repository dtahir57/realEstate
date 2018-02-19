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
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', 'AdminController@index')->name('admin');

Route::prefix('home')->group(function(){
    Route::group(['middleware' => ['role:superadmin']], function(){
      Route::resource('Permissions', 'PermissionsCont');
      Route::get('Permissions', 'PermissionsCont@index')->name('permission');
      Route::get('Permissions/create', 'PermissionsCont@permissionForm')->name('permissionCreate');
      Route::post('Permissions/create', 'PermissionsCont@store')->name('storePermission');
      Route::get('Permissions/{Permission}/edit', 'PermissionsCont@edit');
      Route::post('Permissions/{data}', 'PermissionsCont@update');
      Route::get('Permissions/{Permission}', 'PermissionsCont@destroy');
      Route::resource('Roles', 'RolesController');
      Route::get('Roles', 'RolesController@index')->name('roles');
      Route::get('Roles/create', 'RolesController@rolesForm')->name('roleCreate');
      Route::post('Roles/create', 'RolesController@store')->name('storeRole');
      Route::get('Roles/show/{Role}', 'RolesController@show')->name('showSingleRecord');
      Route::get('Roles/{Role}/edit', 'RolesController@edit');
      Route::post('Roles/{Role}', 'RolesController@update');
      Route::get('Roles/{Role}', 'RolesController@destroy');
      Route::resource('user', 'UserController');
      Route::get('user', 'UserController@index')->name('showUsers');
      Route::get('user/create', 'UserController@showCreateUserForm')->name('createUser');
      Route::post('user/create', 'UserController@store')->name('storeUser');
      Route::get('user/{user}/edit', 'UserController@edit');
      Route::get('user/show/{user}', 'UserController@show');
      Route::post('user/{user}', 'UserController@update');
      Route::get('user/{user}', 'UserController@destroy');
      Route::resource('companies', 'CompanyController');
      Route::get('companies', 'CompanyController@index')->name('allCompanies');
    });
});
