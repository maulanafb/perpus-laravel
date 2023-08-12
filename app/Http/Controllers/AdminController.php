<?php

namespace App\Http\Controllers;


use App\Models\DataAnggota;
use App\Models\Databuku;
use App\Models\DataPengunjung;
use App\Models\PpKolektif;
use App\Models\PpMandiri;
use App\Models\User;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /*beranda*/
    public function Beranda()
    {
        $total_buku = DataBuku::get()->count();
        $total_anggota = DataAnggota::get()->count();
        $total_pengunjung = DataPengunjung::get()->count();
        return view('page.admin.beranda', compact('total_buku', 'total_anggota', 'total_pengunjung'));
    }

    /*data buku*/
    public function DataBuku()
    {
        $data_buku = Databuku::all();

        return view('page.admin.data-buku', ['databukus' => $data_buku]);
    }

    /*create*/
    public function TambahDataBuku(Request $request)
    {
        $data_buku = Databuku::create($request->all());
        return redirect()->route('data-buku');
    }
    /*update*/
    public function UpdateDataBuku(Request $request, $id)
    {
        $data_buku = Databuku::find($id);
        $data_buku->update($request->all());
        return redirect()->route('data-buku');
    }
    /*delete*/
    public function DeleteDataBuku($id)
    {
        $data_databuku = Databuku::find($id);
        $data_databuku->delete();
        return redirect()->route('data-buku');
    }


    /*data anggota*/

    public function DataAnggota(Request $request)
    {
        // $data = User::where('nisn', '!=', 'null')->get();
        // dd($data);
        if ($request->ajax()) {
            $data = User::select('*')->where('nisn', '!=', 'null');

            if ($request->filled('from_date') && $request->filled('to_date')) {
                $data = $data->whereBetween('created_at', [$request->from_date, $request->to_date]);
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $csrfToken = csrf_token();

                    $btn = '<div class="form-button-action">
                                                            <button type="button" data-toggle="modal"
                                                                    data-target="#edit' . $row->id . '"
                                                                    data-toggle="tooltip" title="Edit"
                                                                    class="btn btn-link btn-primary btn-lg"
                                                                    data-original-title="Edit">
                                                                    <i class="fa fa-edit"></i>
                                                                </button>
                                                            <a href="/data-anggota/delete/' . $row->id . '">
                                                                <button type="button" data-toggle="tooltip" onclick="showSweetAlert()" title="" class="btn btn-link btn-danger" data-original-title="Hapus">
                                                                    <i class="fa-solid fa-trash-can"></i>
                                                                </button>
                                                            </a>
                                                        </div>

                                                        <div class="modal fade" id="edit' . $row->id . '" tabindex="-1"
                                                        role="dialog" aria-hidden="false">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header no-bd">
                                                                    <h5 class="modal-title">
                                                                        <span class="fw-mediumbold">
                                                                            Edit Data</span>
                                                                        <span class="fw-light">

                                                                        </span>
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p class="small">Silahkan Mengisi Data Buku Dibawah
                                                                        !</p>
                                                                    <form action="/data-anggota/' . $row->id . '"
                                                                        method="POST" enctype="multipart/form-data">
                                                                        <input type="hidden" name="_token" value="' . $csrfToken . '">
                                                                        <div class="row">
                                                                            <div class="col-sm-12 mb-3">
                                                                                <div class="row ">
                                                                                    <div
                                                                                        class="col-md-3 d-flex align-items-center">
                                                                                        <label>Nama</label>
                                                                                    </div>
                                                                                    <div class="col-md-9">
                                                                                        <input id="addName"
                                                                                            value="' . $row->name . '"
                                                                                            name="name"
                                                                                            type="text"
                                                                                            class="form-control"
                                                                                            placeholder="" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-12 mb-3">
                                                                                <div class="row ">
                                                                                    <div
                                                                                        class="col-md-3 d-flex align-items-center">
                                                                                        <label>Nisn</label>
                                                                                    </div>
                                                                                    <div class="col-md-9">
                                                                                        <input id="addName"
                                                                                            value="' . $row->nisn . '"
                                                                                            name="nisn"
                                                                                            type="text"
                                                                                            class="form-control"
                                                                                            placeholder="" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm-12 mb-3">
                                        <div class="row ">
                                            <div class="col-md-3 d-flex align-items-center">
                                                <label>Tanggal Lahir</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input id="addName tgl_lahir" name="tgl_lahir" type="date" value="' . $row->tgl_lahir . '"
                                                    class="form-control" placeholder="Tanggal Lahir">
                                            </div>
                                        </div>
                                    </div>

                                                                            <div class="col-sm-12 mb-3">
                                                                                <div class="row ">
                                                                                    <div
                                                                                        class="col-md-3 d-flex align-items-center">
                                                                                        <label>kelas</label>
                                                                                    </div>
                                                                                    <div class="col-md-9">
                                                                                        <input id="addName"
                                                                                            value="' . $row->kelas . '"
                                                                                            name="kelas"
                                                                                            type="text"
                                                                                            class="form-control"
                                                                                            placeholder="" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer no-bd">
                                                                            <button type="submit"
                                                                                onclick="showSweetAlertEdit()"
                                                                                class="btn btn-primary">Edit</button>
                                                                            <button type="button"
                                                                                class="btn btn-danger"
                                                                                data-dismiss="modal">Batal</button>
                                                                        </div>
                                                                    </form>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                        ';

                    return $btn;
                })




                ->rawColumns(['action'])
                ->make(true);
        }

        return view('page.admin.data-anggota');
    }
    /*create*/
    public function TambahDataAnggota(Request $request)
    {
        // dd($request);
        $user = User::create([
            'name' => $request['name'],
            'nisn' => $request['nisn'],
            'tgl_lahir' => $request['tgl_lahir'],
            'kelas' => $request['kelas'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        // dd($user);

        $user->assignRole('user');
        // dd($request->all);
        return redirect()->route('data-anggota');
    }
    /*update*/
    public function UpdateDataAnggota(Request $request, $id)
    {
        $data_anggota = User::find($id);
        $data_anggota->update($request->all());
        return redirect()->route('data-anggota');
    }
    /*delete*/
    public function DeleteDataAnggota($id)
    {

        $data_dataanggota = User::find($id);
        // dd($id);
        $data_dataanggota->delete();
        return redirect()->route('data-anggota');
    }


    /*data pengunjung*/
    public function DataPengunjung()
    {
        $data_pengunjung = DataPengunjung::all();
        return view('page.admin.data-pengunjung', ['datapengunjung' => $data_pengunjung]);
    }
    /*create*/
    public function TambahDataPengunjung(Request $request)
    {
        $data_pengunjung = DataPengunjung::create($request->all());
        // dd($request->all);
        return redirect()->route('data-pengunjung');
    }
    /*update*/
    public function UpdateDataPengunjung(Request $request, $id)
    {
        $data_pengunjung = User::find($id);
        $data_pengunjung->update($request->all());
        return redirect()->route('data-pengunjung');
    }
    /*delete*/
    public function DeleteDataPengunjung($id)
    {
        $data_pengunjung = DataPengunjung::find($id);
        $data_pengunjung->delete();
        return redirect()->route('data-pengunjung');
    }


    /*PPMandiri*/
    public function PeminjamandanPengembalianMandiri(Request $request)
    {
        if ($request->ajax()) {
            $data = PpMandiri::select('*');

            if ($request->filled('from_date') && $request->filled('to_date')) {
                $data = $data->whereBetween('tgl_pinjam', [$request->from_date, $request->to_date]);
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn(
                    'status',
                    function ($row) {
                        if (!$row->status) {
                            $sts = '<div class="btn btn-secondary btn-sm">Dipinjam</div>';
                        } else {
                            $sts = '<div class="btn btn-success btn-sm">Dikembalikan</div>';
                        }
                        return $sts;
                    }
                )
                ->addColumn('action', function ($row) {
                    if (!$row->status) {
                        $btn = '<div class="form-button-action">
													<a href="/peminjamandanpengembalian-mandiri/update/' . $row->id . ' ">
														<button type="button" data-toggle="tooltip" title="" onclick="showSweetAlertKembali()"  class="btn btn-primary btn-round ml-auto" data-original-title="Kembalikan" ' . ($row->status ? "disabled" : "") . '>
															kembalikan
														</button>
													</a>
													<a href="/peminjamandanpengembalian-mandiri/perpanjang/' . $row->id . '">
														<button type="button" data-toggle="tooltip" title="" onclick="showSweetAlertPerpanjang()" class="btn btn-success btn-round ml-auto" data-original-title="Perpanjang" ' . ($row->status ? "disabled" : "") . '>
															Perpanjang
														</button>
													</a>
													<a href="/peminjamandanpengembalian-mandiri/delete/' . $row->id . '">
                                                    <button type="button" data-toggle="tooltip" title="" onclick="showSweetAlert()" class="btn btn-link btn-danger" data-original-title="Hapus">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
													</a>
                                                </div>';
                    } else {
                        $btn = '<div class="form-button-action">
                                                                    <a
                                                                        href="/peminjamandanpengembalian-mandiri/update/' . $row->id . ' ">

                                                                        <button type="submit" data-toggle="tooltip"
                                                                            title=""
                                                                            onclick="showSweetAlertKembali()"
                                                                            class="btn btn-primary btn-round ml-auto"
                                                                            data-original-title="Kembalikan"
                                                                            disabled >
                                                                            kembalikan
                                                                        </button>
                                                                    </a>
                                                                    <a href="/peminjamandanpengembalian-mandiri/perpanjang/' . $row->id . '">
														<button type="button" data-toggle="tooltip" title="" onclick="showSweetAlertPerpanjang()" class="btn btn-success btn-round ml-auto" data-original-title="Perpanjang" ' . ($row->status ? "disabled" : "") . '>
															Perpanjang
														</button>
													</a>
                                                                    <a
                                                                        href="/peminjamandanpengembalian-mandiri/delete/' . $row->id . ' ">
                                                                        <button type="button" data-toggle="tooltip"
                                                                            title="" onclick="showSweetAlert()"
                                                                            class="btn btn-link btn-danger"
                                                                            data-original-title="Hapus">
                                                                            <i class="fa-solid fa-trash-can"></i>
                                                                        </button>
                                                                    </a>
                                                                </div>';
                    }


                    return $btn;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        $judul_buku = Databuku::get();
        $no_panggil = Databuku::get();
        // dd($judul_buku);
        $pp_mandiri = PpMandiri::all();
        return view('page.admin.peminjamandanpengembalian-mandiri', compact('judul_buku', 'pp_mandiri'));
    }

    /*create*/
    public function TambahPeminjamanMandiri(Request $request)
    {
        $pinjam_mandiri = PpMandiri::create($request->all());
        // dd($request->all);
        return redirect()->route('pinjam-mandiri');
    }

    // kembalikan
    public function KembalikanMandiri($id)
    {

        // Cari peminjaman berdasarkan ID
        $pinjam_mandiri = PpMandiri::findOrFail($id);

        // Ubah status menjadi "dikembalikan"
        $pinjam_mandiri->status = !$pinjam_mandiri->status;
        if ($pinjam_mandiri->status) {
            $pinjam_mandiri->tgl_kembali = Carbon::now()->toDateString();
        } else {
            $pinjam_mandiri->tgl_kembali = null;
        }

        $pinjam_mandiri->save();

        $pp_mandiri = PpMandiri::all();
        // Hitung denda untuk setiap peminjaman
        // dd($pinjam_mandiri->tgl_perpanjang);
        if ($pinjam_mandiri->tgl_perpanjang) {
            foreach ($pp_mandiri as $pinjam_mandiri) {
                $tgl_perpanjang = Carbon::parse($pinjam_mandiri->tgl_perpanjang);
                $sekarang = Carbon::now();
                $selisihHari = $sekarang->diffInDays($tgl_perpanjang);

                // Denda mulai dihitung setelah 3 hari sejak tanggal peminjaman
                $denda = max(0, $selisihHari - 3) * 1000;
                $pinjam_mandiri->denda = $denda;
                $pinjam_mandiri->save();
            }
        } else {
            foreach ($pp_mandiri as $pinjam_mandiri) {
                $tgl_pinjam = Carbon::parse($pinjam_mandiri->tgl_pinjam);
                $sekarang = Carbon::now();
                $selisihHari = $sekarang->diffInDays($tgl_pinjam);

                // Denda mulai dihitung setelah 3 hari sejak tanggal peminjaman
                $denda = max(0, $selisihHari - 3) * 1000;
                $pinjam_mandiri->denda = $denda;
                $pinjam_mandiri->save();
            }
        }


        // Redirect ke halaman sebelumnya atau halaman yang sesuai
        return redirect()->route('pinjam-mandiri');
    }

    // perpanjang
    public function PerpanjangMandiri($id)
    {
        $pinjam_mandiri = PpMandiri::findOrFail($id);

        // Jika peminjaman sudah dikembalikan, tidak bisa dilakukan perpanjangan
        if ($pinjam_mandiri->status) {
            return redirect('/peminjamandanpengembalian-mandiri')->with('error', 'Peminjaman sudah dikembalikan, tidak bisa melakukan perpanjangan.');
        }

        // Hitung tanggal perpanjangan peminjaman (tambahkan 3 hari dari tanggal pengembalian sebelumnya)
        $tgl_perpanjang = Carbon::parse($pinjam_mandiri->tgl_kembali)->addDays(3);

        // Pastikan tanggal perpanjangan tidak melebihi tanggal saat ini
        $tgl_perpanjang = $tgl_perpanjang->isPast() ? Carbon::now() : $tgl_perpanjang;

        // Update tanggal_pengembalian dengan tanggal perpanjangan
        $pinjam_mandiri->tgl_perpanjang = $tgl_perpanjang;
        $pinjam_mandiri->save();

        return redirect('/peminjamandanpengembalian-mandiri')->with('success', 'Peminjaman berhasil diperpanjang.');
    }


    /*delete*/
    public function DeletePeminjamanMandiri($id)
    {
        $pinjam_mandiri = PpMandiri::find($id);
        $pinjam_mandiri->delete();
        return redirect()->route('pinjam-mandiri');
    }


    /*PPKolektif*/
    public function PeminjamandanPengembalianKolektif(Request $request)
    {
        if ($request->ajax()) {
            $data = PpKolektif::select('*');

            if ($request->filled('from_date') && $request->filled('to_date')) {
                $data = $data->whereBetween('tgl_pinjam', [$request->from_date, $request->to_date]);
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn(
                    'status',
                    function ($row) {
                        if (!$row->status) {
                            $sts = '<div class="btn btn-secondary btn-sm">Dipinjam</div>';
                        } else {
                            $sts = '<div class="btn btn-success btn-sm">Dikembalikan</div>';
                        }
                        return $sts;
                    }
                )
                ->addColumn('action', function ($row) {
                    if (!$row->status) {
                        $btn = '<div class="form-button-action">
                                                                    <a
                                                                        href="/peminjamandanpengembalian-kolektif/update/' . $row->id . ' ">

                                                                        <button type="submit" data-toggle="tooltip"
                                                                            title=""
                                                                            onclick="showSweetAlertKembali()"
                                                                            class="btn btn-primary btn-round ml-auto"
                                                                            data-original-title="Kembalikan"
                                                                            >
                                                                            kembalikan
                                                                        </button>
                                                                    </a>
                                                                    <a
                                                                        href="/peminjamandanpengembalian-kolektif/delete/' . $row->id . ' ">
                                                                        <button type="button" data-toggle="tooltip"
                                                                            title="" onclick="showSweetAlert()"
                                                                            class="btn btn-link btn-danger"
                                                                            data-original-title="Hapus">
                                                                            <i class="fa-solid fa-trash-can"></i>
                                                                        </button>
                                                                    </a>
                                                                </div>';
                    } else {
                        $btn = '<div class="form-button-action">
                                                                    <a
                                                                        href="/peminjamandanpengembalian-kolektif/update/' . $row->id . ' ">

                                                                        <button type="submit" data-toggle="tooltip"
                                                                            title=""
                                                                            onclick="showSweetAlertKembali()"
                                                                            class="btn btn-primary btn-round ml-auto"
                                                                            data-original-title="Kembalikan"
                                                                            disabled >
                                                                            kembalikan
                                                                        </button>
                                                                    </a>
                                                                    <a
                                                                        href="/peminjamandanpengembalian-kolektif/delete/' . $row->id . ' ">
                                                                        <button type="button" data-toggle="tooltip"
                                                                            title="" onclick="showSweetAlert()"
                                                                            class="btn btn-link btn-danger"
                                                                            data-original-title="Hapus">
                                                                            <i class="fa-solid fa-trash-can"></i>
                                                                        </button>
                                                                    </a>
                                                                </div>';
                    }


                    return $btn;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        $judul_buku = Databuku::get();
        // dd($judul_buku);
        $pp_kolektif = PpKolektif::all();


        return view('page.admin.peminjamandanpengembalian-kolektif', compact('judul_buku', 'pp_kolektif'));
    }

    /*create*/
    public function TambahPeminjamanKolektif(Request $request)
    {
        $pinjam_kolektif = PpKolektif::create($request->all());
        // dd($request->all);
        return redirect()->route('pinjam-kolektif');
    }

    // kembalikan
    public function KembalikanKolektif($id)
    {
        // Cari peminjaman berdasarkan ID
        $pinjam_kolektif = PpKolektif::findOrFail($id);

        // Ubah status menjadi "dikembalikan"
        $pinjam_kolektif->status = !$pinjam_kolektif->status;
        $pinjam_kolektif->save();

        // Redirect ke halaman sebelumnya atau halaman yang sesuai
        return redirect()->route('pinjam-kolektif');
    }

    /*delete*/
    public function DeletePeminjamanKolektif($id)
    {
        $pinjam_kolektif = PpKolektif::find($id);
        $pinjam_kolektif->delete();
        return redirect()->route('pinjam-kolektif');
    }


    public function Laporan()
    {
        return view('page.admin.laporan');
    }
}