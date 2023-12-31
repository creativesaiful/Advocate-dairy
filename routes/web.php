<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourtController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CaseController;
use App\Http\Controllers\DashboardController;
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

Route::get('/', function () {
    return redirect('/login');
});

// Route::get('logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard',[DashboardController::class, 'Dashboard'])->name('dashboard');
    Route::post('/dashboard',[DashboardController::class, 'Dashboard']);


    Route::get('casedate/{id}', [DashboardController::class, 'CaseDateEdit'])->name('casedate.edit');
    Route::post('casedate/update/{id}', [DashboardController::class, 'CaseDateUpdate'])->name('casedate.update');

    //Update a case for next date   
    Route::post('date/update', [DashboardController::class, 'DateUpdate'])->name('date.update');





   Route::prefix('courts')->group(function () {
       Route::get('/', [CourtController::class, 'index'])->name('courts.index');
       Route::get('/create', [CourtController::class, 'create'])->name('courts.create');
       Route::post('/store', [CourtController::class, 'store'])->name('courts.store');
       Route::get('/edit/{id}', [CourtController::class, 'edit'])->name('courts.edit');
       Route::post('update/{id}', [CourtController::class, 'update'])->name('courts.update');
       Route::get('delete/{id}', [CourtController::class, 'delete'])->name('courts.delete'); 

       Route::get('/court-list', [CourtController::class, 'courtListAjax'])->name('courts.list');


   });

   Route::prefix('case')->group(function () {
       Route::get('/', [CaseController::class, 'caseList'])->name('case.list');

       Route::get('/create', [CaseController::class, 'create'])->name('case.create');
       Route::post('/store', [CaseController::class, 'store'])->name('case.store');
       Route::get('/edit/{id}', [CaseController::class, 'edit'])->name('case.edit');
       Route::post('/update/{id}', [CaseController::class, 'update'])->name('case.update');

       Route::get('/delete/{id}', [CaseController::class, 'delete'])->name('case.delete');

       Route::get('/details/{id}', [CaseController::class, 'caseDetails'])->name('case.details');


   });
});
