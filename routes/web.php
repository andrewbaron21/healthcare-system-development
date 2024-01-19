<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClinicalHistoryController;
use App\Http\Controllers\UserController;

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
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['web', 'auth:sanctum'])->group(function () {
    // Your web routes here
});

Auth::routes();

Route::get('/users/patients', [UserController::class, 'getUsersByRolePatient'])->name('users.patients');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('clinicalhistories', ClinicalHistoryController::class);

// Route::get('clinical-histories/create', function () {
//     return view('clinicalHistories.create');
// })->name('create.view');

Route::get('/configuration', [HomeController::class, 'index'])->name('home');

Route::get('/user/profile', [UserController::class, 'showProfileForm'])->middleware('auth')->name('user.profile');
Route::put('/user/profile/update', [UserController::class, 'updateProfile'])->middleware('auth')->name('user.profile.update');