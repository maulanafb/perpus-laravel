<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\DataAnggota;
use App\Models\Databuku;
use App\Models\DataPengunjung;
use App\Models\PpKolektif;
use App\Models\PpMandiri;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\Session;

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
    public function listBukuMandiri()
    {
        $books = Databuku::all();
        return view('page.home.data-buku-mandiri', compact('books'));

    }
    public function listBukuKolektif()
    {
        $books = Databuku::all();
        return view('page.home.data-buku-kolektif', compact('books'));

    }
    public function showDetailMandiri($id)
    {
        $book = DataBuku::findOrFail($id); // Mengambil data buku berdasarkan ID
        return view('page.home.detail-buku-mandiri', compact('book'));
    }
    public function showDetailKolektif($id)
    {
        $book = DataBuku::findOrFail($id); // Mengambil data buku berdasarkan ID
        return view('page.home.detail-buku-kolektif', compact('book'));
    }
    public function historyMandiri()
    {
        $history = PpMandiri::where("id_user", Auth::user()->id)->with('databuku')->get();
        // dd($history);
        return view('page.siswa.history-mandiri', compact('history'));
    }
    public function historyKolektif()
    {
        $history = PpKolektif::where("id_user", Auth::user()->id)->with('databuku')->get();
        return view('page.siswa.history-kolektif', compact('history'));
    }
    public function cart()
    {
        $carts = Cart::where("id_user", Auth::user()->id)->with(['databuku', 'user'])->get();
        $total = Cart::count();

        return view('page.siswa.cart', compact('carts', 'total'));
    }

    public function addCart(Request $request)
    {
        $cart = new Cart();
        $cart->id_buku = $request->input('id_buku');
        $cart->id_user = auth()->user()->id;
        $cart->save();

        return redirect()->back()->with('success', 'Buku berhasil ditambahkan ke keranjang.');
    }

    public function deleteCart($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        $carts = Cart::where("id_user", Auth::user()->id)->with(['databuku', 'user'])->get();
        return redirect()->route('cart', compact('carts'))->with('success', 'Buku berhasil dihapus dari keranjang.');
    }
    //data buku//
    public function DataBukuKolektif()
    {
        $data_buku = Databuku::all();

        return view('page.home.data-buku-kolektif', ['databukus' => $data_buku]);
    }
    public function DataBukuMandiri()
    {
        $data_buku = Databuku::all();

        return view('page.home.data-buku-mandiri', ['databukus' => $data_buku]);
    }

    public function TambahPeminjamanMandiri(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'id_buku' => 'required|exists:databukus,id',
            // Memastikan id_buku ada di tabel Databuku
            'jumlah' => 'required|numeric|min:1',
            // ... tambahkan aturan validasi lainnya
            'id_user' => 'required',
            'tgl_pinjam' => 'required',
        ]);

        // Ambil data buku yang dipinjam berdasarkan id_buku
        $buku = Databuku::findOrFail($request->input('id_buku'));

        // Kurangkan stok buku sesuai dengan jumlah dipinjam
        $jumlah = $request->input('jumlah');
        if ($buku->stok >= $jumlah) {
            // $buku->stok -= $jumlah;
            $buku->save();

            // Lanjutkan dengan membuat peminjaman mandiri
            $pinjam_mandiri = PpMandiri::create($validatedData);

            return redirect()->route('list-buku-mandiri')->with('success', 'Peminjaman berhasil');
        } else {
            // Jika stok tidak mencukupi, berikan respon atau lakukan tindakan lainnya
            return redirect()->back()->with('error', 'Stok buku tidak mencukupi');
        }
    }
    public function TambahPeminjamanKolektif(Request $request)
    {
        // ... (validasi dan lain-lain)

        $id_user = $request->id_user; // Ambil id_user dari input form

        // Ambil data buku yang dipinjam berdasarkan id_buku
        $id_buku = $request->id_buku;
        $tgl_pinjam = $request->tgl_pinjam;
        $buku = Databuku::find($id_buku);

        // Kurangkan stok buku sesuai dengan jumlah dipinjam
        $jumlah = $request->jumlah;
        if ($buku && $buku->stok >= $jumlah) {
            // Lanjutkan dengan membuat peminjaman kolektif
            $pinjam_kolektif = PpKolektif::create([
                'id_user' => $id_user,
                'id_buku' => $id_buku,
                'tgl_pinjam' => $tgl_pinjam,
                'jumlah' => $jumlah,
                'status' => "booking",
                // ... (atribut lainnya)
            ]);

            // Kurangkan stok buku
            // $buku->stok -= $jumlah;
            $buku->save();

            return redirect()->route('list-buku-kolektif');
        } else {
            // Jika stok tidak mencukupi, berikan respon atau lakukan tindakan lainnya
            return redirect()->back()->with('error', 'Stok buku tidak mencukupi');
        }
    }



}
