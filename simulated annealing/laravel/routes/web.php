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



Route::get('/', 'Ai_Controller@index');
Route::get('/hasilsa', 'Ai_Controller@runningsa');
Route::get('/akurasi/{hasil}/{input}', 'Ai_Controller@akurasi');