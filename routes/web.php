<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Hash\HashController;
use App\Http\Controllers\Backend\User\UserController;
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\Roles\RoleController;
use App\Http\Controllers\Backend\Auth\LogoutController;


Route::get('/', function () {
    return redirect('/admin/login');
});

Route::get('/login', function () {
    return view('backend.auth.login');
})->name('admin.login.view')->middleware('guest');

Route::post('/login', [LoginController::class, 'authenticate'])->name('admin.login');

Route::middleware('auth')->name('admin.')->group(function () {

    Route::get('/dashboard', function () {
        return view('backend.dashboard');
    })->name('dashboard');

    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

    //User Routes
    Route::name('user.')->group(function () {
        Route::get('/all-user', [UserController::class, 'userIndex'])->name('index');
        Route::get('/user-create', [UserController::class, 'userCreate'])->name('create');
        Route::post('/user-store', [UserController::class, 'userStore'])->name('store');
        // Route::get('/alluser', [UserController::class,'userIndex'])->name('show');
        // Route::get('/alluser', [UserController::class,'userIndex'])->name('edit');
        // Route::get('/alluser', [UserController::class,'userIndex'])->name('update');
        // Route::get('/alluser', [UserController::class,'userIndex'])->name('delete');

        Route::get('/profile',[UserController::class, 'profile'])->name('profile');
        Route::PATCH('/update-password',[UserController::class, 'updatePassword'])->name('update-password');
    });
    //Role Routes
    Route::name('role.')->group(function () {
        Route::get('/all-role', [RoleController::class, 'roleIndex'])->name('index');
        Route::post('/role-store', [RoleController::class, 'roleStore'])->name('store');
        Route::get('/role-show/{id}', [RoleController::class, 'roleShow'])->name('show');
        Route::post('/role-update/{id}', [RoleController::class, 'roleUpdate'])->name('update');
        Route::delete('/role-delete/{id}', [RoleController::class, 'roleDelete'])->name('delete');
    });

    //Hash Routes
    Route::name('hash.')->group(function () {
        Route::get('/all-hash', [HashController::class, 'hashIndex'])->name('index');
        // Route::get('/hash-create', [HashController::class, 'hashCreate'])->name('create');
        Route::post('/hash-store', [HashController::class, 'hashStore'])->name('store');
        Route::get('/hash-show/{id}', [HashController::class, 'hashShow'])->name('show');
        Route::get('/hash-edit/{id}', [HashController::class, 'hashEdit'])->name('edit');
        Route::get('/hash-update', [HashController::class, 'hashUpdate'])->name('update');
        Route::DELETE('/hash-delete/{id}', [HashController::class, 'hashDelete'])->name('delete');

        //Import & Export
        Route::get('/hash-export', [HashController::class, 'hashExport'])->name('export');
    });
});
