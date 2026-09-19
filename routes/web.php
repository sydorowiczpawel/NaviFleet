<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

// User
Route::get('/createUser', [App\Http\Controllers\UserController::class, 'create'])->name('createUser');
Route::post('/createUser', [App\Http\Controllers\UserController::class, 'store'])->name('createUser.store');
Route::post('/createRandom', [App\Http\Controllers\UserController::class, 'storeRandom'])->name('createUser.random');

// Employee
Route::get('/employees', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employees.index');
Route::get('/employees/create', [App\Http\Controllers\EmployeeController::class, 'create'])->name('employees.create');
Route::post('/employees/convert', [App\Http\Controllers\EmployeeController::class, 'convertFromUser'])->name('employees.convert');
Route::get('/employees/{id}', [App\Http\Controllers\EmployeeController::class, 'show'])->name('employees.show');
Route::get('/employees/{id}/edit', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('employees.edit');
Route::put('/employees/{id}', [App\Http\Controllers\EmployeeController::class, 'update'])->name('employees.update');

// Route::get('employees/{id}', [App\Http\Controllers\EmployeeController::class, 'show'])->name('employees.show');
// Route::get('employees/{id}/edit', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('employees.edit');
// Route::put('employees/{id}', [App\Http\Controllers\EmployeeController::class, 'update'])->name('employees.update');
// Route::delete('employees/{id}', [App\Http\Controllers\EmployeeController::class, 'destroy'])->name('employees.destroy');

// Vehicle
Route::get('/vehicles', [App\Http\Controllers\VehicleController::class, 'index'])->name('vehicles.index');
Route::get('/vehicles/create', [App\Http\Controllers\VehicleController::class, 'create'])->name('vehicles.add');
Route::post('/vehicles', [App\Http\Controllers\VehicleController::class, 'store'])->name('vehicles.store');
Route::get('/vehicles/{id}/edit', [App\Http\Controllers\VehicleController::class, 'edit'])->name('vehicles.edit');
Route::put('/vehicles/{id}', [App\Http\Controllers\VehicleController::class, 'update'])->name('vehicles.update');
Route::get('/vehicles/{vehicle}/deactivate', [App\Http\Controllers\VehicleController::class, 'deactivate'])->name('vehicles.deactivate');
Route::get('/vehicles/{vehicle}/activate', [App\Http\Controllers\VehicleController::class, 'activate'])->name('vehicles.activate');
Route::get('/vehicles/{id}', [App\Http\Controllers\VehicleController::class, 'show'])->name('vehicles.show');

// Route::get('/vehicles', \App\Lifewire\VehiclesIndex::class)->name('vehicles.index');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    // Route::view('employees', 'employees')->name('employees');

});

require __DIR__.'/settings.php';
