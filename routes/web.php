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
    // return view('welcome');
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('siswa', 'SiswaController');
Route::resource('nilai', 'NilaiController');
Route::get('status-beasiswa','BeasiswaController@index')->name('status.index');
Route::get('pdf','BeasiswaController@export_pdf')->name('pdf');
