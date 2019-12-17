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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/cond','CondsController');
Route::resource('/user','UsersController');
Route::resource('/role','RolesController');
Route::resource('/permission','PermissionsController');
Route::resource('/departement','DepartementsController');
Route::resource('/item','ItemsController');
Route::resource('/stat','StatsController');

//relation table
Route::resource('/stok','Stok_ItemsController');

Route::resource('/pngjuan','PengajuansController');
Route::get('/prstjuan/destroy/{id}','PersetujuansController@destroy');
Route::resource('/prstjuan','PersetujuansController');

Route::post('itemdetail/update', 'ItemDetailsController@update')->name('item-detail.update');
Route::get('itemdetail/destroy/{id}', 'ItemDetailsController@destroy');
Route::resource('/itemdetail','ItemDetailsController');
Route::get('/laporan/{input1}/{input2}','PelaporansController@generatePdfByDateRange')->name('printbydate');
Route::get('/print','PelaporansController@generatePdf')->name('print');
Route::resource('/laporan','PelaporansController');






