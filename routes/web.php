<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FormulirController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormulirPenilaianDisposisiController;
use App\Http\Controllers\PembinaanController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PenjadwalanController;
use App\Models\FormulirPenilaianDisposisi;

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


Route::middleware('auth')->group(function () {

    // Route::get('/',[DashboardController::class,'index'])->name('dashboard');

    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('generate-penilaian', [DashboardController::class, 'generatePenilaian'])->name('dashboard.generate-penilaian');
    Route::resource('formulir', FormulirController::class);
    Route::get('formulir/{formulir}/set-default-children', [FormulirController::class, 'setDefaultChildren'])->name('formulir.set-default-children');

    Route::resource('formulir.domain', DomainController::class)->shallow()->only([
        'index',
        'create',
        'store',
        'edit',
        'update',
        'destroy'
    ]);


    Route::get('penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
    Route::resource('formulir.penilaian', PenilaianController::class)->shallow()->except('index');
    Route::get('formulir/{formulir}/penilaian-tersedia', [PenilaianController::class, 'penilaianTersedia'])->name('formulir.penilaianTersedia');
    Route::get('formulir/{formulir}/domain-penilaian', [PenilaianController::class, 'domainPenilaian'])->name('formulir.domain-penilaian');
    Route::get('formulir/{formulir}/domain-penilaian/{domain}', [PenilaianController::class, 'isiDomain'])->name('formulir.isi-domain');
    Route::get('formulir/{formulir}/domain-penilaian/{domain}/{aspek}/{indikator}', [PenilaianController::class, 'penilaianAspek'])->name('formulir.penilaianAspek');
    Route::post('formulir/{formulir}/domain-penilaian/{domain}/{aspek}/{indikator}/store-penilaian', [PenilaianController::class, 'store'])->name('formulir.store-penilaian');

    Route::resource('penjadwalan', PenjadwalanController::class);

    Route::get('pembinaan', [PembinaanController::class, 'index'])->name('pembinaan.index');
    Route::get('penjadwalan/{penjadwalan}/pembinaan', [PembinaanController::class, 'show'])->name('penjadwalan.pembinaan.show');
    Route::get('penjadwalan/{penjadwalan}/pembinaan/create', [PembinaanController::class, 'create'])->name('penjadwalan.pembinaan.create');
    Route::post('penjadwalan/{penjadwalan}/pembinaan', [PembinaanController::class, 'store'])->name('penjadwalan.pembinaan.store');
    Route::get('penjadwalan/{penjadwalan}/pembinaan/{pembinaan}/edit', [PembinaanController::class, 'edit'])->name('penjadwalan.pembinaan.edit');
    Route::put('penjadwalan/{penjadwalan}/pembinaan/{pembinaan}', [PembinaanController::class, 'update'])->name('penjadwalan.pembinaan.update');
    Route::delete('penjadwalan/{penjadwalan}/pembinaan/{pembinaan}', [PembinaanController::class, 'destroy'])->name('penjadwalan.pembinaan.destroy');



    Route::get('penilaian-selesai', [FormulirPenilaianDisposisiController::class, 'tersedia'])->name('disposisi.penelaian.tersedia');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('user', UserController::class);
});

require __DIR__ . '/auth.php';
