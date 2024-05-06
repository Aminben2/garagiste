<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MechanicConroller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\SparePartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\PDFController;
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
    return view('landing.welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get("change-language/{locale}", [AppController::class, "changeLanguage"])->name("change.lang");

Route::middleware(['auth', "isClient"])->group(function () {

    // pdf routes
    Route::get('/generate-pdf', [PDFController::class, 'generatePDF']);
    Route::get('/admin/pdfs/invoicePDF/{invoiceId}', [PDFController::class, 'generateInvoicePDF']);

    // admin home page routes
    Route::get('/admin', AdminController::class)->name('admin.dashboard');

    // custom mechanic routes
    Route::get("/admin/users/mechanics/{mechanic}/repairs", [MechanicConroller::class, "mehcanicRepairs"])->name("mechanic.repairs");
    Route::get("/admin/users/mechanics", [MechanicConroller::class, "index"])->name("mechanics");

    // custom clients routes
    Route::get("/admin/users/clients/{invoice}/repairs", [ClientController::class, "clientInvoiceRepairs"])->name("invoice.repairs");
    Route::get("/admin/users/clients", [ClientController::class, "index"])->name("clients");
    Route::get("/admin/users/clients/{client}/invoices", [ClientController::class, "clientInvoices"])->name("client.invoices");

    // export routes
    Route::get('/admin/users/users-export', [UserController::class, 'export'])->name('users.export');
    Route::get('/admin/repairs/repairs-export', [RepairController::class, 'export'])->name('repairs.export');
    Route::get('/admin/invoices/invoices-export', [InvoiceController::class, 'export'])->name('invoices.export');
    Route::get('/admin/vehicles/vehicles-export', [VehicleController::class, 'export'])->name('vehicles.export');
    Route::get('/admin/spareParts/spareParts-export', [SparePartController::class, 'export'])->name('spareParts.export');

    // import routes
    Route::post('/admin/users/users-import', [UserController::class, 'import'])->name('users.import');
    Route::post('/admin/repairs/repairs-import', [RepairController::class, 'import'])->name('repairs.import');
    Route::post('/admin/invoices/invoices-import', [InvoiceController::class, 'import'])->name('invoices.import');
    Route::post('/admin/vehicles/vehicles-import', [VehicleController::class, 'import'])->name('vehicles.import');
    Route::post('/admin/spareParts/spareParts-import', [SparePartController::class, 'import'])->name('spareParts.import');

    // custom users routes
    Route::get("/admin/users/manageRoles", [UserController::class, "showManageRoles"])->name("manage.roles");
    Route::post("/admin/users/manageRoles/{userId}", [UserController::class, "ManageRoles"])->name("update.user.roles");
    Route::get("/admin/users/getUser/{userId}", [UserController::class, "getUser"]);
    Route::put("/admin/users/updateById/{userId}", [UserController::class, "updateById"]);

    // custom repairs routes
    Route::put("/admin/repairs/updateStatus/{repairId}/{status}", [RepairController::class, "updateStatus"]);

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

    Route::resource('admin/invoices', InvoiceController::class)->names([
        'index' => 'invoices',
        'create' => 'invoices.create',
        'store' => 'invoices.store',
        'show' => 'invoice.details',
        'edit' => 'invoices.edit',
        'update' => 'invoices.update',
        'destroy' => 'invoices.destroy',
    ]);

    Route::resource('admin/repairs', RepairController::class)->names([
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
