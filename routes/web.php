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

//Route::get('/admin', 'AdminController@index')->name('admin'); //Will use when setting up a new guard

Route::prefix('home')->group(function(){
    Route::group(['middleware' => ['role:superuser']], function(){
      Route::resource('Permissions', 'PermissionsCont');
      Route::resource('Roles', 'RolesController');
      Route::resource('companies', 'CompanyController');
    });
    Route::resource('Properties', 'PropertyController');
    Route::resource('Agents', 'AgentsController');
    Route::resource('Tasks', 'TasksController');
    Route::resource('Transaction-type', 'TransactionTypeController');
    Route::resource('Transactions', 'TransactionsController');
    Route::resource('Invoices', 'InvoiceController');
    Route::get('Transaction-type/destroy/{Transaction_type}', 'TransactionTypeController@destroy');
    Route::get('Tasks/create/{property}', 'TasksController@taskForm');
    Route::get('Transactions/create/{property}', 'TransactionsController@newTransaction');
    Route::get('Properties/restore/{property}', 'PropertyController@restore');
    Route::get('/{property}','HomeController@restore');
    Route::get('Properties/kill/{property}', 'PropertyController@kill');
    Route::get('home/companies', 'CompanyController@destroySession')->name('destroySession');
    Route::post('Properties/filter', 'FilterController@filter')->name('filterProperty');
    Route::get('Properties/destroy/{property}', 'PropertyController@destroy');
});
