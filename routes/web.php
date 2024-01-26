<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PengunjungController;
use App\Http\Controllers\KepalaSekolahController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profile', [HomeController::class, 'Profile'])->name('profile');
Route::get('/list-buku-mandiri', [SiswaController::class, 'listBukuMandiri'])->name('list-buku-mandiri');
Route::get('/list-buku-kolektif', [SiswaController::class, 'listBukuKolektif'])->name('list-buku-kolektif');
Route::get('/detail-buku-mandiri/{id}', [SiswaController::class, 'showDetailMandiri'])->name('detail-buku-mandiri.show');
Route::get('/detail-buku-kolektif/{id}', [SiswaController::class, 'showDetailKolektif'])->name('detail-buku-kolektif.show');
Route::get('/sop-anggota', [HomeController::class, 'SOPAnggota'])->name('SOPAnggota-Pengunjung');
Route::get('/sop-peminjam', [HomeController::class, 'SOPPeminjaman'])->name('SOPPeminjaman-Pengunjung');
Route::get('/sop-pengembalian', [HomeController::class, 'SOPPengembalian'])->name('SOPPengembalian-Pengunjung');

Route::get('/admin/lap-mandiri/pdf/', [AdminController::class, 'pdfMandiri'])->name('lap-bm.pdfMandiri');
Route::get('/admin/lap-kolektif/pdf/', [AdminController::class, 'pdfKolektif'])->name('lap-bm.pdfKolektif');


Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/beranda-admin', [AdminController::class, 'Beranda'])->name('beranda.admin');
    // Route::get('/data-buku-admin', [AdminController::class, 'DataBuku']);
    // Route::get('/data-anggota', [AdminController::class, 'DataAnggota']);
    // Route::get('/data-pengunjung', [AdminController::class, 'DataPengunjung']);

    /* Admin - Data Buku  */
    Route::get('/data-buku-admin', [AdminController::class, 'DataBuku'])->name('data-buku.admin');

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
    Route::get('/konfirmasi-mandiri/{id}', [AdminController::class, 'KurangiStokMandiri'])->name('kurangi-stok-mandiri');
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
    Route::get('/konfirmasi-kolektif/{id}', [AdminController::class, 'KurangiStokKolektif'])->name('kurangi-stok-kolektif');

    //Create
    Route::post('/peminjamandanpengembalian-kolektif', [AdminController::class, 'TambahPeminjamanKolektif'])->name('pinjam-kolektif.create');
    //Kembali
    Route::get('/peminjamandanpengembalian-kolektif/update/{id}', [AdminController::class, 'KembalikanKolektif'])->name('pinjam-kolektif.update');
    //Delete
    Route::get('/peminjamandanpengembalian-kolektif/delete/{id}', [AdminController::class, 'DeletePeminjamanKolektif'])->name('pinjam-kolektif.delete');
});


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/laporan', [AdminController::class, 'Laporan']);

// Route Siswa
Route::group(['middleware' => ['role:user']], function () {
    Route::get('/beranda-siswa', [SiswaController::class, 'Beranda'])->name('beranda.siswa');
    Route::get('/data-buku', [SiswaController::class, 'DataBuku'])->name('data-buku');
    Route::get('/siswa/history', [SiswaController::class, 'history'])->name('history');
    Route::post('/pp-kolektif-siswa', [SiswaController::class, 'TambahPeminjamanKolektif'])->name('pp-kolektif-siswa');
    Route::post('/pp-mandiri-siswa', [SiswaController::class, 'TambahPeminjamanMandiri'])->name('pp-mandiri-siswa');

});




//Route Kepala Sekolah

Route::group(['middleware' => ['role:kepsek']], function () {
    Route::get('/beranda', [KepalaSekolahController::class, 'Beranda'])->name('beranda.kepsek');
    Route::get('/data-buku-kepsek', [KepalaSekolahController::class, 'DataBuku'])->name('data-buku-kepsek');
    Route::get('/data-anggota-kepsek', [KepalaSekolahController::class, 'DataAnggota'])->name('data-anggota-kepsek');
    Route::get('/data-pengunjung-kepsek', [KepalaSekolahController::class, 'DataPengunjung'])->name('data-pengunjung-kepsek');
    Route::get('/pp-mandiri-kepsek', [KepalaSekolahController::class, 'PeminjamandanPengembalianMandiri'])->name('lp-mandiri-kepsek');
    Route::get('/pp-kolektif-kepsek', [KepalaSekolahController::class, 'PeminjamandanPengembalianKolektif'])->name('lp-kolektif-kepsek');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/logout', 'Logout')->name('Logout');
});

// Route::controller(PengunjungController::class)->group(function () {
//     Route::get('/pengunjung/beranda', 'Beranda')->name('Beranda-Pengunjung');
//     Route::get('/pengunjung/profil', 'Profil')->name('Profil-Pengunjung');
//     Route::get('/pengunjung/layanan/sop-anggota', 'SOPAnggota')->name('SOPAnggota-Pengunjung');
//     Route::get('/pengunjung/layanan/sop-peminjaman', 'SOPPeminjaman')->name('SOPPeminjaman-Pengunjung');
//     Route::get('/pengunjung/layanan/sop-pengembalian', 'SOPPengembalian')->name('SOPPengembalian-Pengunjung');
// });
