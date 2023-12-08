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
    return view('index');
});

Route::get('/aboutus', function () {
    return view('aboutus');
});

Route::get('/auth', function () {
    return view('auth');
});

Route::get('/reg', function () {
    return view('reg');
});

Route::get('/menu', function () {
    return view('menu');
});

Route::get('/application', function () {
    return view('application');
});

Route::get('/personal', function () {
    return view('personal');
});