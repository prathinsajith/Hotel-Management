<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

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
})->name('welcome');

Route::get('service', function () {
    return view('service');
})->name('service');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/booknow', [HomeController::class, 'userBookStore'])->name('booknow');

Route::get('/booked{id}', [HomeController::class, 'userHotelBookStore'])->name('booked');

Route::post('/ajaxPostBookDetails', [HomeController::class, 'ajaxPostBookDetails'])->name('ajaxPostBookDetails');

Route::get('/viewbooking', [HomeController::class, 'userBookView'])->name('viewbooking');

Route::post('/cancelBooking/{id}/{roomno}', [HomeController::class, 'userDestroy'])->name('cancelBooking');

// -- Admin -- //

Route::get('admin/home', [HomeController::class, 'handleAdmin'])->name('admin.route')->middleware('admin');

Route::resource('admin/hotelDetails', AdminController::class)->middleware('admin');

Route::get('admin/staffRegister', [AdminController::class, 'staffRegistration'])->name('admin.staffRegistration')->middleware('admin');

Route::post('admin/staffRegister', [AdminController::class, 'staffRegistrationStore'])->name('admin.staffRegistrationStore')->middleware('admin');

Route::get('admin/staffList', [AdminController::class, 'staffList'])->name('admin.staffList')->middleware('admin');

Route::post('admin/staffDestroy{id}', [AdminController::class, 'staffDestroy'])->name('admin.staffDestroy')->middleware('admin');

// -- Staff -- //

Route::get('staff/home', [HomeController::class, 'handleStaff'])->name('staff.route')->middleware('staff');

Route::get('staff/userapprove', [HomeController::class, 'userApproveByStaff'])->name('staff.userapprove')->middleware('staff');

Route::get('staff/approve{id}', [HomeController::class, 'approve'])->name('staff.approve')->middleware('staff');

Route::get('staff/reject{id}', [HomeController::class, 'reject'])->name('staff.reject')->middleware('staff');

Route::get('staff/roomdetails{id}', [HomeController::class, 'roomdetails'])->name('staff.roomdetails')->middleware('staff');

Route::get('staff/userCheckOut', [HomeController::class, 'userCheckOut'])->name('staff.userCheckOut')->middleware('staff');

Route::get('/checkout/{id}/{hotel_id}', [HomeController::class, 'checkout'])->name('checkout');

Route::get('staff/ajaxGetUserDetails/{id}', [HomeController::class, 'ajaxGetUserDetails'])->name('staff.ajaxGetUserDetails')->middleware('staff');