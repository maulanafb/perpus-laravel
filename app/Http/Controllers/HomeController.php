<?php

namespace App\Http\Controllers;

use App\Models\Databuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        // if (Auth::user()->hasRole('admin')) {
        //     return redirect()->route('beranda.admin');
        // } elseif (Auth::user()->hasRole('kepsek')) {
        //     return redirect()->route('beranda.kepsek');
        // }
        // return redirect()->route('beranda.siswa');
        return view('page.home.beranda');
    }

    public function Profile()
    {
        return view('page.home.profil');
    }
    public function listBuku()
    {
        $books = Databuku::all();

        return view('page.home.data-buku', compact('books'));

    }
    public function showDetail($id)
    {
        $book = DataBuku::findOrFail($id); // Mengambil data buku berdasarkan ID

        return view('page.home.detail-buku', compact('book'));
    }

    public function SOPAnggota()
    {
        return view('page.home.sop-anggota');
    }
    public function SOPPeminjaman()
    {
        return view('page.home.sop-peminjaman');
    }
    public function SOPPengembalian()
    {
        return view('page.home.sop-pengembalian');
    }
}