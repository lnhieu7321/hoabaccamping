<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

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


Route::get('/', [App\Http\Controllers\LoginController::class, 'showLoginForm'])->name('admin.login');

// Route xử lý đăng nhập
Route::post('/', [App\Http\Controllers\LoginController::class, 'login']);
// Route đăng xuất
Route::post('/adlogout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

Route::get('/admindashboard', [App\Http\Controllers\AdminDashboardController::class, 'showDashBoard'])->middleware('auth')->name('admin.dashboard');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard'])->middleware('auth')->name('dashboard');



Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'useredit'])->middleware('auth')->name('profile.edit');
Route::post('/profile/update', [App\Http\Controllers\ProfileController::class, 'updateRecord'])->middleware('auth')->name('profile.update.bs');


// ----------------------------- booking -----------------------------//
Route::get('/allbooking', [App\Http\Controllers\BookingController::class, 'allbooking'])->middleware('auth')->name('form/allbooking');
Route::get('form/booking/edit', [App\Http\Controllers\BookingController::class, 'bookingEdit']);

Route::get('/approveBooking/{id}', [App\Http\Controllers\BookingController::class, 'approveBooking'])->middleware('auth')->name('form/booking/approveBooking');
Route::get('/cancelBooking/{id}', [App\Http\Controllers\BookingController::class, 'cancelBooking'])->middleware('auth')->name('form/booking/cancelBooking');


// ----------------------------- service -----------------------------//
Route::get('/allservice', [App\Http\Controllers\ServiceController::class, 'allservice'])->middleware('auth')->name('form/allservice');
Route::get('/serviceedit/{id}', [App\Http\Controllers\ServiceController::class, 'serviceEdit'])->middleware('auth')->name('form/serviceedit');
Route::get('/serviceadd', [App\Http\Controllers\ServiceController::class, 'serviceAdd'])->middleware('auth')->name('form/serviceadd');

Route::post('/service/save', [App\Http\Controllers\ServiceController::class, 'saveRecord'])->middleware('auth')->name('form/service/save');
Route::post('/service/update', [App\Http\Controllers\ServiceController::class, 'updateRecord'])->middleware('auth')->name('form/service/update');
Route::delete('/service/delete/{id}', [App\Http\Controllers\ServiceController::class, 'deleteRecord'])->middleware('auth')->name('form/service/delete');


Route::get('/allrating', [App\Http\Controllers\RatingController::class, 'allrating'])->middleware('auth')->name('form/allrating');




// ==============================================admin=====================================================================//

// ----------------------------- users -----------------------------//
Route::get('/alluser', [App\Http\Controllers\AdminUserController::class, 'alluser'])->middleware('auth')->name('form/alluser');
Route::get('/adapproveCustomer/{id}', [App\Http\Controllers\AdminUserController::class, 'approveCustomer'])->middleware('auth')->name('adminapproveCustomer');
Route::get('/adcancelCustomer/{id}', [App\Http\Controllers\AdminUserController::class, 'cancelCustomer'])->middleware('auth')->name('admincancelCustomer');

Route::get('/aduseradd', [App\Http\Controllers\AdminUserController::class, 'userAdd'])->middleware('auth')->name('form/aduseradd');

Route::post('/aduser/save', [App\Http\Controllers\AdminUserController::class, 'saveRecord'])->middleware('auth')->name('adminuser/save');
// ----------------------------- business -----------------------------//
Route::get('/allbusiness', [App\Http\Controllers\AdminBusinessController::class, 'allbusiness'])->middleware('auth')->name('form/allbusiness');
Route::get('/adapproveBusiness/{id}', [App\Http\Controllers\AdminBusinessController::class, 'approveBusiness'])->middleware('auth')->name('adminapproveBusiness');
Route::get('/adcancelBusiness/{id}', [App\Http\Controllers\AdminBusinessController::class, 'cancelBusiness'])->middleware('auth')->name('admincancelBusiness');

Route::get('/adbusinessadd', [App\Http\Controllers\AdminBusinessController::class, 'businessAdd'])->middleware('auth')->name('form/adbusinessadd');

Route::post('/adbusiness/save', [App\Http\Controllers\AdminBusinessController::class, 'saveRecord'])->middleware('auth')->name('adminbusiness/save');
// ----------------------------- booking -----------------------------//
Route::get('/adallbooking', [App\Http\Controllers\AdminBookingController::class, 'allbooking'])->middleware('auth')->name('form/adallbooking');

Route::get('/adapproveBooking/{id}', [App\Http\Controllers\AdminBookingController::class, 'approveBooking'])->middleware('auth')->name('adminapproveBooking');
Route::get('/adcancelBooking/{id}', [App\Http\Controllers\AdminBookingController::class, 'cancelBooking'])->middleware('auth')->name('admincancelBooking');


// ----------------------------- service -----------------------------//
Route::get('/adallservice', [App\Http\Controllers\AdminServiceController::class, 'allservice'])->middleware('auth')->name('form/adallservice');
Route::get('/adserviceedit/{id}', [App\Http\Controllers\AdminServiceController::class, 'serviceEdit'])->middleware('auth')->name('form/adserviceedit');
Route::get('/adserviceadd', [App\Http\Controllers\AdminServiceController::class, 'serviceAdd'])->middleware('auth')->name('form/adserviceadd');

Route::post('/adservice/save', [App\Http\Controllers\AdminServiceController::class, 'saveRecord'])->middleware('auth')->name('adminservice/save');
Route::post('/adservice/update', [App\Http\Controllers\AdminServiceController::class, 'updateRecord'])->middleware('auth')->name('adminservice/update');
Route::delete('/adservice/delete/{id}', [App\Http\Controllers\AdminServiceController::class, 'deleteRecord'])->middleware('auth')->name('adminservice/delete');


Route::get('/adallrating', [App\Http\Controllers\AdminRatingController::class, 'allrating'])->middleware('auth')->name('form/adallrating');
Route::delete('/adrating/delete/{id}', [App\Http\Controllers\AdminRatingController::class, 'deleteRecord'])->middleware('auth')->name('adminrating/delete');
