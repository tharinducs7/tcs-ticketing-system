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


Route::group(['middleware' => ['auth','web']], function()
{
    Route::get('/', 'HomeController@index')->name('home');
    //Tickets
    Route::group(['middleware' => 'App\Http\Middleware\Permissions\PermissionMiddleware'], function() {
    Route::get('support-tickets/all', 'TicketsController@index')->name('support-tickets-all-list');
    Route::get('support-tickets/solved', 'TicketsController@solved')->name('support-tickets-solved');
    Route::get('support-tickets/on-process', 'TicketsController@process')->name('support-tickets-process');
    Route::get('support-tickets/pending', 'TicketsController@pending')->name('support-tickets-pending');

    Route::get('support-tickets/normal', 'TicketsController@Normal')->name('support-tickets-Normal');
    Route::get('support-tickets/medium', 'TicketsController@Medium')->name('support-tickets-Medium');
    Route::get('support-tickets/high', 'TicketsController@High')->name('support-tickets-High');

  //Users
    Route::group(['middleware' => 'App\Http\Middleware\Permissions\PermissionMiddleware'], function() {
    Route::get('users/all', 'UsersController@index')->name('users-all-list');
    Route::group(['middleware' => 'App\Http\Middleware\Permissions\ViewPermissionMiddleware'], function() {
    Route::get('users/view/{id}', 'UsersController@show')->name('users-view');
    });
    Route::group(['middleware' => 'App\Http\Middleware\Permissions\CreatePermissionMiddleware'], function() {   
    Route::get('users/create', 'UsersController@create')->name('users-create');
    Route::post('users/create', 'UsersController@store')->name('users-store');
    });
    Route::group(['middleware' => 'App\Http\Middleware\Permissions\UpdatePermissionMiddleware'], function() {    
    Route::get('users/update/{id}', 'UsersController@edit')->name('users-edit');
    Route::post('users/update/{id}', 'UsersController@update')->name('users-update');
    });
    Route::group(['middleware' => 'App\Http\Middleware\Permissions\DeletePermissionMiddleware'], function() {   
    Route::delete('users/delete/{id}', 'UsersController@destroy')->name('users-destroy');
    });
    });

    
    Route::get('support-tickets/view/{id}', 'TicketsController@show')->name('support-tickets-view');
    Route::get('support-tickets/create', 'TicketsController@create')->name('support-tickets-create');
    Route::post('support-tickets/create', 'TicketsController@store')->name('support-tickets-store');
    Route::get('support-tickets/update/{id}', 'TicketsController@edit')->name('support-tickets-edit');
    Route::post('support-tickets/update/{id}', 'TicketsController@update')->name('support-tickets-update');
    Route::get('support-tickets/answer/{id}', 'TicketsController@answer')->name('support-tickets-answer');
    Route::post('support-tickets/answer/{id}', 'TicketsController@answered')->name('support-tickets-answered');
    Route::delete('support-tickets/delete/{id}', 'TicketsController@destroy')->name('support-tickets-destroy');
    });

    //Modules
    Route::group(['middleware' => 'App\Http\Middleware\Permissions\PermissionMiddleware'], function() {
    Route::get('modules/all', 'ModulesController@index')->name('modules-all-list');
    Route::get('modules/view/{id}', 'ModulesController@show')->name('modules-view');
    Route::get('modules/create', 'ModulesController@create')->name('modules-create');
    Route::post('modules/create', 'ModulesController@store')->name('modules-store');
    Route::get('modules/update/{id}', 'ModulesController@edit')->name('modules-edit');
    Route::post('modules/update/{id}', 'ModulesController@update')->name('modules-update');
    Route::delete('modules/delete/{id}', 'ModulesController@destroy')->name('modules-destroy');
    });

    //User Roles
    Route::group(['middleware' => 'App\Http\Middleware\Permissions\PermissionMiddleware'], function() {
    Route::get('user-roles/all', 'UserRolesController@index')->name('user-roles-all-list');
    Route::get('user-roles/view/{id}', 'UserRolesController@show')->name('user-roles-view');
    Route::get('user-roles/create', 'UserRolesController@create')->name('user-roles-create');
    Route::post('user-roles/create', 'UserRolesController@store')->name('user-roles-store');
    Route::get('user-roles/update/{id}', 'UserRolesController@edit')->name('user-roles-edit');
    Route::post('user-roles/update/{id}', 'UserRolesController@update')->name('user-roles-update');
    Route::delete('user-roles/delete/{id}', 'UserRolesController@destroy')->name('user-roles-destroy');
    });

  
});