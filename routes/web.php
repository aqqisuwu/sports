<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\SlotController;
use App\Http\Controllers\Admin\SportController;
use App\Http\Controllers\Frontend\CategoryController as FrontendCategoryController;
use App\Http\Controllers\Frontend\ReservationController as FrontendReservationController;
use App\Http\Controllers\Frontend\SportController as FrontendSportController;
use App\Http\Controllers\Frontend\WelcomeController;
use App\Http\Controllers\ProfileController;
use App\Models\Reservation;
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

Route::get('/', [WelcomeController::class, 'index']);
Route::get('/categories',[FrontendCategoryController::class, 'index']) -> name('categories.index');
Route::get('/categories/{category}',[FrontendCategoryController::class, 'show']) -> name('categories.show');
Route::get('/sports',[FrontendSportController::class, 'index']) -> name('sports.index');
Route::get('/reservation/step-one',[FrontendReservationController::class, 'stepOne']) -> name('reservations.step.one');
Route::post('/reservation/step-one',[FrontendReservationController::class, 'storestepOne']) -> name('reservations.store.step.one');
Route::get('/reservation/step-two',[FrontendReservationController::class, 'stepTwo']) -> name('reservations.step.two');
Route::post('/reservation/step-two',[FrontendReservationController::class, 'storestepTwo']) -> name('reservations.store.step.two');

Route::get('/thankyou',[WelcomeController::class, 'thankyou'])->name('thankyou');

Route::get('/dashboard', function () {
    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->name('admin.')->prefix('admin')->group(function() {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::resource('/categories', CategoryController::class);
    Route::resource('/sports', SportController::class);
    Route::resource('/slots', SlotController::class);
    Route::resource('/reservation', ReservationController::class);
});
require __DIR__.'/auth.php';
