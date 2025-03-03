<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Management\ManagementController;
/*
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
คำสั่งสร้าง Controller php artisan make:conrepo ชื่อโฟล์เดอร์/ใส่แค่ชื่อ *Controller ใส่ให้อัตโนมัติ
คำสั่งสร้าง Repository php artisan make:repo ชื่อโฟล์เดอร์/ใส่แค่ชื่อ *Repository ใส่ให้อัตโนมัติ
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
กำหนดสิทธิ์ใน user_roles 
*/



Route::get('/', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');
Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'check.permission:View,Management'])->group(function () {

    Route::get('/admin/Management', [ManagementController::class, 'index'])->name('Management');
    Route::post('/admin/ManagementStore', [ManagementController::class, 'ManagementStore'])->name('ManagementStore');
//  Role
    Route::get('/admin/setRole', [ManagementController::class, 'role'])->name('setrole.role');
    Route::post('/admin/setRoles', [ManagementController::class, 'storeRole'])->name('role.store');
//  Permission
    Route::get('/admin/setPermission', [ManagementController::class, 'permission'])->name('setPermission.permission');
    Route::post('/admin/setPermissions', [ManagementController::class, 'storePermission'])->name('permission.store');
// Program
    Route::get('/admin/setProgram', [ManagementController::class, 'program'])->name('setPermission.program');
    Route::post('/admin/setPrograms', [ManagementController::class, 'storeProgram'])->name('programs.store');

    Route::get('/admin/ManageProgram', [ManagementController::class, 'ManageProgram'])->name('ManageProgram');

    // Delete
    Route::post('/remove-permission', [ManagementController::class, 'removePermission'])->name('removePermission');
    Route::delete('/admin/programs/{id}', [ManagementController::class, 'destroy'])->name('programs.destroy');
    Route::delete('/admin/permissions/{id}', [ManagementController::class, 'destroyPermission'])->name('permission.destroy');
    Route::delete('/admin/role/{id}', [ManagementController::class, 'destroyRole'])->name('role.destroy');
    
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
