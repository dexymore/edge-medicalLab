<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('userViews/index');
});
Route::get('/profile', function () {
    return view('userViews/profile');
});

Route::get('/login', function () {
    return view('userViews/login');
});
Route::get('/signup', function () {
    return view('userViews/signup');
});

Route::get('/admin', function () {
    return view('adminViews/index');
});
Route::get('/appointments', function () {
    return view('adminViews/appointments');
});
Route::get('/reports', function () {
    return view('adminViews/reports');
});
Route::get('/loginAdmin', function () {
    return view('adminViews/login');
});