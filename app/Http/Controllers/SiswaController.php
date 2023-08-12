<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataAnggota;
use App\Models\Databuku;
use App\Models\DataPengunjung;
use App\Models\PpKolektif;
use App\Models\PpMandiri;
use App\Models\User;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Beranda()
    {
        $total_buku = DataBuku::get()->count();
        $total_anggota = DataAnggota::get()->count();
        $total_pengunjung = DataPengunjung::get()->count();
        return view('page.siswa.beranda', compact('total_buku', 'total_anggota', 'total_pengunjung'));
    }

     /*data buku*/
     public function DataBuku()
     {
         $data_buku = Databuku::all();
 
         return view('page.siswa.data-buku', ['databukus' => $data_buku]);
     }

     public function PeminjamandanPengembalianMandiri(Request $request)
     {
        
         $judul_buku = Databuku::get();
         $no_panggil = Databuku::get();
         // dd($judul_buku);
         $pp_mandiri = PpMandiri::all();
         return view('page.siswa.peminjamandanpengembalian-mandiri', compact('judul_buku', 'pp_mandiri'));
     }
     public function PeminjamandanPengembalianKolektif(Request $request)
    {
        $judul_buku = Databuku::get();
        // dd($judul_buku);
        $pp_kolektif = PpKolektif::all();


        return view('page.siswa.peminjamandanpengembalian-kolektif', compact('judul_buku', 'pp_kolektif'));
    }


    
}
