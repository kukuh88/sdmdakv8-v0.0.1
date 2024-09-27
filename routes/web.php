<?php

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Eselon;
use App\Exports\KaryawanExport;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PkwtController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\EselonController;
use App\Http\Controllers\PensiunController;
use App\Http\Controllers\PilihanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriKontrakController;

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


// halaman dasboard
Route::get('/', function () {
    if (auth()->guest()) {
        return redirect()->route('login');
    }
    return redirect()->route('dashboard');
});

require __DIR__.'/auth.php';

// bagian login
Route::get('/auth', function () {
    return view('/auth/login');
});

// bagian error
Route::get('/error', function(){
    return view ('/error/index');
});

// bagian help
Route::get('/help', function(){
    return view ('/help/index');
});

// bagian profil
Route::get('/profile', function(){
    return view ('/profile/index');
});

// bagian dashboard menu dalam
Route::get('/welcome', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('welcome');

// untuk user yang sudah masuk
Route::group(['middleware' => ['auth']], function () {
    // BOOK
    Route::view ('/dashboard', [DashboardController::class, 'index']);
    Route::get('/book/notification', [BookController::class, 'notif'])->name('book.notif');
    Route::get('book/{id}/pilihan', [BookController::class, 'pilihan'])->name('book.pilihan');
    Route::resource('book', BookController::class);

    // PILIHAN
    Route::get('pilihan/{id}/reguler', [PilihanController::class, 'reguler'])->name('pilihan.reguler');
    Route::resource('pilihan', PilihanController::class);

    // KARYAWAN
    Route::post('karyawan/{karyawan}/approval-tingkat', [KaryawanController::class, 'approvel_kenaikan'])->name('karyawan.approval-tingkat');
    Route::post('karyawan/{karyawan}/approval-acc', [KaryawanController::class, 'approvel_acc'])->name('approvel_acc');
    Route::get('karyawan/{karyawan}/pensiun', [KaryawanController::class, 'editPensiun']);
    Route::get('pensiun/{karyawan}/form', [KaryawanController::class, 'editPensiun'])->name('pensiun.form');
    Route::put('karyawan/{karyawan}/pensiun', [KaryawanController::class, 'updatePensiun1'])->name('karyawan.update-pensiun');
    Route::get('karyawanexport', [KaryawanController::class, 'karyawanexport'])->name('karyawanexport');
    Route::post('karyawanimport', [KaryawanController::class, 'karyawanimport'])->name('karyawanimport');
    // Route::get('/filter', [KaryawanController::class, 'filter'])->name('filter');;

    // hold
    Route::get('hold', [KaryawanController::class, 'holdon'])->name('holdon');
    Route::resource('/pensiun', PensiunController::class);

    // Histroy Hold
    Route::get('histroy', [KaryawanController::class, 'history_hold'])->name('history_hold');

    // PKWT
    Route::get('pkwtexport', [PkwtController::class, 'pkwtexport'])->name('pkwtexport');
    Route::post('pkwtimport', [PkwtController::class, 'pkwtimport'])->name('pkwtimport');
    Route::resource('pkwt', PkwtController::class);

    // ESELON
    Route::resource('eselon', EselonController::class);

    //EMPLOYEE
    Route::resource('employee', EmployeeController::class);
    Route::post('/daterange/fetch_data', [EmployeeController::class, 'fetch_data'])->name('employee.fetch_data');

    // KARYAWAN
    Route::resource('karyawan', KaryawanController::class);

    // DASHBOARD
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/e-mail', [KaryawanController::class,'mail']);

    // email kirim email atau zimbra
    // Route::get('email', [EmailController::class, 'index']);

    Route::get('/book/detail_karyawan/{karyawan}', [BookController::class, 'detailKaryawan']);
    // Route::post('/pensiun/{karyawan}', [PensiunController::class, 'store']);

    // Kategori Kontrak
    Route::resource('kategorikontrak', KategoriKontrakController::class);
});
