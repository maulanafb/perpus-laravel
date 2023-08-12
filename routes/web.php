<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KepalaSekolahController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [HomeController::class, 'index']);


Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/beranda-admin', [AdminController::class, 'Beranda'])->name('beranda.admin');
    // Route::get('/data-buku-admin', [AdminController::class, 'DataBuku']);
    // Route::get('/data-anggota', [AdminController::class, 'DataAnggota']);
    // Route::get('/data-pengunjung', [AdminController::class, 'DataPengunjung']);

    /* Admin - Data Buku  */
    Route::get('/data-buku-admin', [AdminController::class, 'DataBuku'])->name('data-buku');

    //create
    Route::post('/data-buku/tambah', [AdminController::class, 'TambahDataBuku']);
    //Update
    Route::post('/data-buku/{id}', [AdminController::class, 'UpdateDataBuku']);
    //Delete
    Route::get('/data-buku/delete/{id}', [AdminController::class, 'DeleteDataBuku']);

    /* Admin - Data Pengunjung */
    Route::get('/data-pengunjung', [AdminController::class, 'DataPengunjung'])->name('data-pengunjung');
    //create
    Route::post('/data-pengunjung', [AdminController::class, 'TambahDataPengunjung']);
    //Update
    Route::post('/data-pengunjung/{id}', [AdminController::class, 'UpdateDataPengunjung']);
    //Delete
    Route::get('/data-pengunjung/delete/{id}', [AdminController::class, 'DeleteDataPengunjung']);

    /* Admin - Data Anggota */
    Route::get('/data-anggota', [AdminController::class, 'DataAnggota'])->name('data-anggota');
    //create
    Route::post('/data-anggota', [AdminController::class, 'TambahDataAnggota']);
    //Update
    Route::post('/data-anggota/{id}', [AdminController::class, 'UpdateDataAnggota']);
    //Delete
    Route::get('/data-anggota/delete/{id}', [AdminController::class, 'DeleteDataAnggota']);

    /* Admin - Peminjaman dan Pengembalian Mandiri  */
    Route::get('/peminjamandanpengembalian-mandiri-admin', [AdminController::class, 'PeminjamandanPengembalianMandiri'])->name('pinjam-mandiri');
    //Create
    Route::post('/peminjamandanpengembalian-mandiri', [AdminController::class, 'TambahPeminjamanMandiri'])->name('pinjam-mandiri.create');
    //Delete
    Route::get('/peminjamandanpengembalian-mandiri/delete/{id}', [AdminController::class, 'DeletePeminjamanMandiri'])->name('pinjam-mandiri.delete');
    //Kembali
    Route::get('/peminjamandanpengembalian-mandiri/update/{id}', [AdminController::class, 'KembalikanMandiri'])->name('pinjam-mandiri.update');
    //Perpanjang
    Route::get('/peminjamandanpengembalian-mandiri/perpanjang/{id}', [AdminController::class, 'PerpanjangMandiri'])->name('pinjam-mandiri.perpanjang');

    /* Admin - Peminjaman dan Pengembalian Kolektif  */
    Route::get('/peminjamandanpengembalian-kolektif-admin', [AdminController::class, 'PeminjamandanPengembalianKolektif'])->name('pinjam-kolektif');

    //Create
    Route::post('/peminjamandanpengembalian-kolektif', [AdminController::class, 'TambahPeminjamanKolektif'])->name('pinjam-kolektif.create');
    //Kembali
    Route::get('/peminjamandanpengembalian-kolektif/update/{id}', [AdminController::class, 'KembalikanKolektif'])->name('pinjam-kolektif.update');
    //Delete
    Route::get('/peminjamandanpengembalian-kolektif/delete/{id}', [AdminController::class, 'DeletePeminjamanKolektif'])->name('pinjam-kolektif.delete');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/laporan', [AdminController::class, 'Laporan']);

// Route Siswa
Route::group(['middleware' => ['role:user']], function () {
    Route::get('/beranda-siswa', [SiswaController::class, 'Beranda'])->name('beranda.siswa');
    Route::get('/data-buku', [SiswaController::class, 'DataBuku'])->name('data-buku');
    Route::get('/peminjamandanpengembalian-mandiri', [SiswaController::class, 'PeminjamandanPengembalianMandiri'])->name('pp-mandiri-siswa');
    Route::get('/peminjamandanpengembalian-kolektif', [SiswaController::class, 'PeminjamandanPengembalianKolektif'])->name('pp-kolektif-siswa');
});




//Route Kepala Sekolah

Route::group(['middleware' => ['role:kepsek']], function () {
    Route::get('/beranda', [KepalaSekolahController::class, 'Beranda'])->name('beranda.kepsek');
    Route::get('/data-buku-kepsek', [KepalaSekolahController::class, 'DataBuku'])->name('data-buku-kepsek');
    Route::get('/data-anggota-kepsek', [KepalaSekolahController::class, 'DataAnggota'])->name('data-anggota-kepsek');
    Route::get('/pp-mandiri-kepsek', [KepalaSekolahController::class, 'PeminjamandanPengembalianMandiri'])->name('lp-mandiri-kepsek');
    Route::get('/pp-kolektif-kepsek', [KepalaSekolahController::class, 'PeminjamandanPengembalianKolektif'])->name('lp-kolektif-kepsek');
});
