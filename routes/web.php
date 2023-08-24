<?php

use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


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
//patient routes

Route::get('/',[PatientController::class,'index'] )->name('index');


Route::group(['middleware'=>'PatientAuth'],function(){
Route::get('/profile',[PatientController::class,'profile'] )->name('profile');
Route::get('/view-document/{url}',[PatientController::class,'viewDocument'])->name('viewDocument');  
Route::post('/delete-appointments', [PatientController::class,'deleteAppointments'])->name('deleteAppointments');
Route::post('/update-appointments', [PatientController::class,'updateAppointments'])->name('updateAppointments');
Route::post('/update-userinfo', [PatientController::class,'updateUserInfo'])->name('updateUserInfo');
Route::get('/logout', [PatientController::class,'logout'])->name('logout');
} );


Route::group(['middleware'=>'GuestPatientAuth'],function(){
    Route::get('/login', [PatientController::class,'showLogin'])->name('login');
    Route::post('/handle-login', [PatientController::class,'handleLogin'])->name('handleLogin');
    Route::get('/signup', [PatientController::class,'showSignup'])->name('signup');
    Route::post('/handle-signup', [PatientController::class,'handleSignup'])->name('handleSignup');
    
    
});







// Route::get('/login', function () {
//     return view('userViews/login');
// });
// Route::get('/signup', function () {
//     return view('userViews/signup');
// });

// Route::get('/admin', function () {
//     return view('adminViews/index');
// });
// Route::get('/appointments', function () {
//     return view('adminViews/appointments');
// });
// Route::get('/reports', function () {
//     return view('adminViews/reports');
// });
// Route::get('/loginAdmin', function () {
//     return view('adminViews/login');
// });
// Route::get('/test', function () {
// $results= DB::table("admin")->get();
// return $results;
// });