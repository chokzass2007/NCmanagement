<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
/*
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
คำสั่งสร้าง Controller php artisan make:conrepo ชื่อโฟล์เดอร์/ใส่แค่ชื่อ *Controller ใส่ให้อัตโนมัติ
คำสั่งสร้าง Repository php artisan make:repo ชื่อโฟล์เดอร์/ใส่แค่ชื่อ *Repository ใส่ให้อัตโนมัติ
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
*/


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/test', [Controller::class, 'viewProgramA']);

Route::get('/programnameA', [Controller::class, 'viewProgramA'])
    ->middleware('check.permission:ProgramA,ProgramA');

    Route::get('/programnameB/edit', [Controller::class, 'editProgramB'])
    ->middleware('check.permission:edit_programname,programnameB');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
