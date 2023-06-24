<?php

use Illuminate\Support\Facades\Route;
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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
        
        Route::middleware('auth')->group(function(){

            
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
        Route::get('/yajrainitialize', [UserController::class, 'yajraInitialize'])->name('yajrainitialize');
        Route::post('/createusers', [UserController::class, 'create'])->name('users.create');
        Route::post("/deletecrud/{id}", [UserController::class, 'delete'])->name('deletecrud');
        Route::get("/fetchuserdata/{id}", [UserController::class, 'fetchuserdata'])->name('fetchuserdata');
        Route::post("/updateuser/{id}", [UserController::class, 'updateuser'])->name('updateuser');



                         /////////   FILTER //////
        Route::get('/applyfilters', [UserController::class, 'applyFilter']);



         ////////  ROUTES OF YAJRA TABLE THAT COMES AFTER REDIRCT TO NEW VIEW AFTER CLICKING ON SPECIFIC COUNTRY IN GRPAH
        Route::get('/countrywisedetail', [UserController::class, 'countryWiseDetail']);



        // route to export Excel file
        Route::get('/export', [UserController::class, 'export'])->name('export');
        Route::post('/import', [UserController::class, 'import'])->name('import.excel');
     });
});
