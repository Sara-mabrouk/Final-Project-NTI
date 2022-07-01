<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;
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
// Route::middleware('checkLang')->group(function(){

    Route::get('/', function () {
        return view('welcome');
});


////////////////////////////////////////////////////////////////////////

Route::middleware(['Admincheck'])->group(function () {

    Route::get('Admin/', [AdminController::class, 'index']);   //->middleware('adminCheck');
    Route::get('Admin/Create', [AdminController::class, 'Create']);
    Route::post('Admin/Store', [AdminController::class, 'Store']);
    Route::get('Admin/delete/{id}', [AdminController::class, 'destroy'])->middleware('checkDelete');
    Route::get('Admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('Admin/update/{id}', [AdminController::class, 'update']);

    //////////////////////////////////////////////////////
    //Task Rout
    Route::resource('Task', TasksController::class);
});

//////////////////////////////////////////////////////////////
//login , logout..
Route::get('Login', [AdminController::class, 'login']);
Route::post('DoLogin', [AdminController::class, 'DoLogin']);
Route::get('Logout', [AdminController::class, 'logout']);

Route::get('Session', [AdminController::class, 'testSession']);
////////////////////////////////////////////////////////////////////////////////////

    ///تغير اللغه
Route::get('Lang/{lang}', function ($lang) {
    session()->put('lang', $lang);
    return back();
});
