<?php


use App\Http\Controllers\LayananController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RumahSakitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AjaxUserController;

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


// Route::get('/', function () {
//     return view('add-pages.poliklinik-pages');
//     });
Route::resource('/ajaxuser', AjaxUserController::class);
Route::resource('/', UserController::class);

Auth::routes();
Route::resource('/map', RumahSakitController::class);
Route::resource('/poli', PoliklinikController::class);
Route::resource('/lab', LabController::class);
Route::resource('/layanan', LayananController::class);
Route::resource('/room', RoomController::class);
