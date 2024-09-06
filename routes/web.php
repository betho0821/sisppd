<?php

use App\Http\Controllers\BeneficiarioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitController;

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

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rutas específicas para Administradores
    Route::middleware(['auth', 'role:Administrador'])->group(function () {
        Route::get('/register', [UserController::class, 'create'])->name('register');
        Route::post('/register', [UserController::class, 'store']);
    });

    // Perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/visits/create', [VisitController::class, 'create'])->name('visits.create');
    Route::post('/visits', [VisitController::class, 'store'])->name('visits.store');
    Route::get('/visitas', [VisitController::class, 'index'])->name('visitas.index');
    Route::get('/beneficiarios/create', [BeneficiarioController::class, 'create'])->name('beneficiarios.create');
    Route::post('/beneficiarios', [BeneficiarioController::class, 'store'])->name('beneficiarios.store');
    Route::get('/beneficiarios', [BeneficiarioController::class, 'index'])->name('beneficiarios.index');
});

require __DIR__ . '/auth.php';
