<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SparePartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', "isClient"])->group(function () {
    Route::get('/admin', AdminController::class)->name('admin.dashboard');
    Route::get("/admin/users/clients", [ClientController::class, "index"])->name("clients");
    Route::get("/admin/users/clients/{client}/invoices", [ClientController::class, "clientInvoices"])->name("client.invoices");
    Route::get("/admin/users/clients/{invoice}/repairs", [ClientController::class, "clientInvoiceRepairs"])->name("invoice.repairs");
    Route::resource('admin/users', UserController::class)->names([
        'index' => 'users',
        'create' => 'users.create',
        'store' => 'users.store',
        'show' => 'user.details',
        'edit' => 'users.edit',
        'update' => 'users.update',
        'destroy' => 'users.destroy',
    ]);

    Route::resource('admin/vehicles', VehicleController::class)->names([
        'index' => 'vehicles',
        'create' => 'vehicles.create',
        'store' => 'vehicles.store',
        'show' => 'vehicle.details',
        'edit' => 'vehicles.edit',
        'update' => 'vehicles.update',
        'destroy' => 'vehicles.destroy',
    ]);


    Route::resource('admin/spare-parts', SparePartController::class)->names([
        'index' => 'spare-parts',
        'create' => 'spare-parts.create',
        'store' => 'spare-parts.store',
        'show' => 'spare-part.details',
        'edit' => 'spare-parts.edit',
        'update' => 'spare-parts.update',
        'destroy' => 'spare-parts.destroy',
    ]);

    Route::resource('admin/invoices', VehicleController::class)->names([
        'index' => 'invoices',
        'create' => 'invoices.create',
        'store' => 'invoices.store',
        'show' => 'invoice.details',
        'edit' => 'invoices.edit',
        'update' => 'invoices.update',
        'destroy' => 'invoices.destroy',
    ]);

    Route::resource('admin/repairs', UserController::class)->names([
        'index' => 'repairs',
        'create' => 'repairs.create',
        'store' => 'repairs.store',
        'show' => 'repair.details',
        'edit' => 'repairs.edit',
        'update' => 'repairs.update',
        'destroy' => 'repairs.destroy',
    ]);

    Route::get('/admin/profile', [ProfileController::class, 'adminEdit'])->name('admin.profile.edit');
});
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit')->middleware("auth");
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware("auth");
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy')->middleware("auth");

require __DIR__ . '/auth.php';


// Route for handling 404 error (Page Not Found)
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

// Route for handling 500 error (Internal Server Error)
Route::get('/error', function () {
    return response()->view('errors.500', [], 500);
});
