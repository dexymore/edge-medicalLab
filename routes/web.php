<?php

use App\Http\Controllers\PatientController;
use App\Http\Controllers\AdminController;
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

Route::get('/', [PatientController::class, 'index'])->name('index');

//auth middleware to make sure that the user is logged in
Route::group(['middleware' => 'PatientAuth'], function () {
    Route::get('/profile', [PatientController::class, 'profile'])->name('profile');
    Route::post('/delete-appointments', [PatientController::class, 'deleteAppointments'])->name('deleteAppointments');
    Route::post('/update-appointments', [PatientController::class, 'updateAppointments'])->name('updateAppointments');
    Route::post('/update-userinfo', [PatientController::class, 'updateUserInfo'])->name('updateUserInfo');
    Route::get('/logout', [PatientController::class, 'logout'])->name('logout');
    Route::post('/update-password', [PatientController::class, 'updatePassword'])->name('updatePassword');
    Route::post('/make-appointment', [PatientController::class, 'makeAppointment'])->name('makeAppointment');
    Route::get('/view-document/{url}', [PatientController::class, 'viewDocument'])->name('patientViewDocument');
});


Route::group(['middleware' => 'GuestPatientAuth'], function () {
    Route::get('/login', [PatientController::class, 'showLogin'])->name('login');
    Route::post('/handle-login', [PatientController::class, 'handleLogin'])->name('handleLogin');
    Route::get('/signup', [PatientController::class, 'showSignup'])->name('signup');
    Route::post('/handle-signup', [PatientController::class, 'handleSignup'])->name('handleSignup');
});







///admin routes


Route::group(['middleware' => 'GeustAdminAuth'], function () {
    Route::get('/admin/login', [AdminController::class, 'showAdminLogin'])->name('adminLogin');
    Route::post('/admin/handle-admin-login', [AdminController::class, 'handleAdminLogin'])->name('handleAdminLogin');
});

Route::group(['middleware' => 'AdminAuth'], function () {
    Route::get('admin/logoutAdmin', [AdminController::class, 'logoutAdmin'])->name('logoutAdmin');
    Route::get('admin/', [AdminController::class, 'adminProfile'])->name('adminProfile');
    Route::post('admin/delete-user', [AdminController::class, 'deleteUser'])->name('deleteUser');
    Route::post('admin/edit-user-info', [AdminController::class, 'editUserInfo'])->name('editUserInfo');
    Route::post('admin/add-appointment', [AdminController::class, 'addAppointment'])->name('addAppointment');
    Route::get('admin/appointments', [AdminController::class, 'adminAppoinments'])->name('adminAppoinments');
    Route::post('admin/update-user-appointment', [AdminController::class, 'updateUserAppointment'])->name('updateUserAppointment');
    Route::post('admin/delete-user-appointment', [AdminController::class, 'deleteUserAppointment'])->name('deleteUserAppointment');
    Route::get('admin/reports', [AdminController::class, 'adminReports'])->name('adminReports');
    Route::post('admin/upload-report', [AdminController::class, 'uploadFile'])->name('uploadFile');
    Route::post('admin/delete-report', [AdminController::class, 'AdmindeleteReport'])->name('AdmindeleteReport');
    Route::post('admin/update-report', [AdminController::class, 'updateFile'])->name('updateFile');
    Route::get('admin/view-document/{url}', [PatientController::class, 'viewDocument'])->name('adminViewDocument');
});
