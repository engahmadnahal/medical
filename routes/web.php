<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthCheckController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SpecialiteController;
use App\Http\Middleware\AuthCheck;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Support\Facades\App;
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

Route::post('check',[AuthCheckController::class,'check'])->name('auth.check');

// Only Admin
Route::middleware('auth:admin')->group(function(){
    //Role And Permission
Route::resource('permissions', PermissionController::class);
Route::resource('roles', RoleController::class);
Route::post('roles/permission',[RoleController::class , 'updateRolePermission'])->name('role.updata_permission');

// Doctor
Route::get('/doctors/trash',[DoctorController::class,'trash'])->name('doctors.trash');
Route::post('/doctors/restore/{id}',[DoctorController::class,'restore'])->name('doctors.restore');
Route::resource('doctors',DoctorController::class);

// User Permissions

Route::get('patients/{patient}/permission/edit',[PatientController::class , 'editUserPermission'])->name('patients.permissions');
Route::put('patients/{patient}/permission/update',[PatientController::class , 'updateUserPermission'])->name('patients.update_permissions');

});


Route::middleware('guest:admin,user')->group(function(){
Route::get('auth/{guard}',[AuthCheckController::class , 'index'])->name('auth.index');
});

Route::group(['middleware'=>['auth:admin,user']],function(){

Route::get('/logout',[HomePageController::class,'logout'])->name('logout');
Route::resource('/',HomePageController::class);


// Role & Permissions Routes
























// Patients
Route::get('/patients/trash',[PatientController::class,'trash'])->name('patients.trash');
Route::post('/patients/restore/{id}',[PatientController::class,'restore'])->name('patients.restore');
Route::resource('patients',PatientController::class);

// City
Route::get('/cities/trash',[CityController::class,'trash'])->name('cities.trash');
Route::post('/cities/restore/{id}',[CityController::class,'restore'])->name('cities.restore');
Route::resource('cities',CityController::class);

// Specialites
Route::get('/specialites/trash',[SpecialiteController::class,'trash'])->name('specialites.trash');
Route::post('/specialites/restore/{id}',[SpecialiteController::class,'restore'])->name('specialites.restore');
Route::resource('specialites',SpecialiteController::class);

// Appoinments
Route::get('/appointment/trash',[AppointmentController::class,'trash'])->name('appointment.trash');
Route::post('/appointment/restore/{id}',[AppointmentController::class,'restore'])->name('appointment.restore');
Route::resource('appointment',AppointmentController::class);

});

// Route::get('/{locale}', function ($locale) {
// dd(! in_array($locale, ['en', 'es', 'fr']));

//     if (! in_array($locale, ['en', 'es', 'fr'])) {
//         abort(400);
//     }

//     App::setLocale($locale);

//     //
// });

// // localization
// Route::prefix('{locale}')->group(function($locale){
// // App::setLocale($locale);
// // if(!in_array($locale,['ar','en'])){
// // // Doctor
// // // Employees
// // Route::get('/doctor',function(){
// //     return view('doctor.index');
// // });

// // Route::get('/doctor/show',function(){
// //     return view('doctor.show');
// // });

// // Route::get('/doctor/trash',function(){
// //     return view('doctor.trash');
// // });
// // Route::get('/doctor/create',function(){
// //     return view('doctor.craete');
// // });

// // Route::get('/doctor/edit',function(){
// //     return view('doctor.craete');
// // });
// // }else{
// //     abort(500);
// // }


// });
