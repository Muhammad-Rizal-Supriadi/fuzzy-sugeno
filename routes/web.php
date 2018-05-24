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

Route::get('/', 'Backend\BackendController@index')->middleware('verify-login');
Route::get('login', 'LoginController@index');
Route::get('logout', 'LoginController@logout');
Route::post('validate-login', 'LoginController@login');
Route::group(['prefix' => 'backend', 'namespace' => 'Backend','middleware' => 'verify-login'], function () {
    Route::get('/', 'BackendController@index');
//    Route::group(['prefix' => 'master', 'namespace' => 'Master','middleware' => 'verify-login'],function (){
//
//        Route::group(['prefix' => 'diagnosa-penyakit'], function () {
//            Route::get('/', 'DiagnosaPenyakitController@index');
//            Route::post('/add', 'DiagnosaPenyakitController@form');
//            Route::post('/save', 'DiagnosaPenyakitController@save');
//            Route::post('/delete', 'DiagnosaPenyakitController@delete');
//        });
//        Route::group(['prefix' => 'role'], function () {
//            Route::get('/', 'RoleController@index');
//            Route::post('/add', 'RoleController@form');
//            Route::post('/save', 'RoleController@save');
//            Route::post('/delete', 'RoleController@delete');
//        });
//        Route::group(['prefix' => 'users'], function () {
//            Route::get('/', 'UserController@index');
//            Route::post('/add', 'UserController@form');
//            Route::post('/save', 'UserController@save');
//            Route::post('/delete', 'UserController@delete');
//        });
//        Route::group(['prefix' => 'gejala-fisik'], function () {
//            Route::get('/', 'GejalaFisikController@index');
//            Route::post('/add', 'GejalaFisikController@form');
//            Route::post('/save', 'GejalaFisikController@save');
//            Route::post('/delete', 'GejalaFisikController@delete');
//        });
//        Route::group(['prefix' => 'gejala-klinis'], function () {
//            Route::get('/', 'GejalaKlinisController@index');
//            Route::post('/add', 'GejalaKlinisController@form');
//            Route::post('/save', 'GejalaKlinisController@save');
//            Route::post('/delete', 'GejalaKlinisController@delete');
//        });
//        Route::group(['prefix' => 'penyebab-penyakit'], function () {
//            Route::get('/', 'PenyebabPenyakitController@index');
//            Route::post('/add', 'PenyebabPenyakitController@form');
//            Route::post('/save', 'PenyebabPenyakitController@save');
//            Route::get('/view','PenyebabPenyakitController@view');
//            Route::post('/delete', 'PenyebabPenyakitController@delete');
//        });
//        Route::group(['prefix' => 'penyebab-klinis'], function () {
//            Route::get('/', 'PenyebabKlinisController@index');
//            Route::post('/add', 'PenyebabKlinisController@form');
//            Route::post('/save', 'PenyebabKlinisController@save');
//            Route::get('/view','PenyebabKlinisController@view');
//            Route::post('/delete', 'PenyebabKlinisController@delete');
//        });
//
//
//    });
//
//    Route::group(['prefix' => 'pakar', 'namespace' => 'Pakar','middleware' => 'verify-login'],function (){
//
//        Route::group(['prefix' => 'sistem-pakar'], function () {
//            Route::get('/', 'SistemPakarController@index');
//            Route::post('/proses', 'SistemPakarController@proses');
//
//        });
//
//
//
//    });

    Route::group(['prefix' => 'fuzzy', 'namespace' => 'Fuzzy','middleware' => 'verify-login'],function (){
            Route::get('/', 'FuzzySugenoController@index');
            Route::post('/proses', 'FuzzySugenoController@proses');
    });

});