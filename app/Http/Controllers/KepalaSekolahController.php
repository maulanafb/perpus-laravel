<?php

namespace App\Http\Controllers;

use App\Models\DataAnggota;
use App\Models\Databuku;
use App\Models\DataPengunjung;
use App\Models\PpMandiri;
use App\Models\PpKolektif;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KepalaSekolahController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function Beranda()
    {
        $total_buku = DataBuku::get()->count();
        $total_anggota = User::get()->count();
        $total_pengunjung = DataPengunjung::get()->count();
        $total_pinjam_mandiri = PpMandiri::get()->count();
        $total_pinjam_kolektif = PpKolektif::get()->count();
        $total_pengembalian_mandiri = PpMandiri::where('status', true)->get()->count();
        $total_pengembalian_kolektif = PpKolektif::where('status', true)->get()->count();

        return view('page.kepsek.beranda', compact('total_buku', 'total_anggota', 'total_pengunjung', 'total_pinjam_mandiri', 'total_pinjam_kolektif', 'total_pengembalian_mandiri', 'total_pengembalian_kolektif'));
    }

    public function DataBuku(Request $request)
    {


        if ($request->ajax()) {
            $data = Databuku::select('*');

            if ($request->filled('from_date') && $request->filled('to_date')) {
                $data = $data->whereBetween('created_at', [$request->from_date, $request->to_date]);
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        return view('page.kepsek.data-buku');
    }

    public function DataPengunjung(Request $request)
    {
        if ($request->ajax()) {
            // $data = User::select('*')->where('nisn', '!=', 'null');
            $data = DataPengunjung::with('user')->get();

            if ($request->filled('from_date') && $request->filled('to_date')) {
                $data = $data->whereBetween('created_at', [$request->from_date, $request->to_date]);
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->user->name;
                })
                ->addColumn('kelas', function ($row) {
                    return $row->user->kelas;
                })
                ->addColumn('action', function ($row) {
                    // $csrfToken = csrf_token();
                    // dd($row->id);
    
                    $btn = '<div class="form-button-action">
                                                                <button type="button" data-toggle="modal"
                                                                    data-target="#edit' . $row->id . '"
                                                                    data-toggle="tooltip" title="Edit"
                                                                    class="btn btn-link btn-primary btn-lg"
                                                                    data-original-title="Edit">
                                                                    <i class="fa fa-edit"></i>
                                                                </button>
                                                                <a href="#">
                                                                    <button type="button" data-toggle="tooltip"
                                                                        title=""
                                                                        class="btn btn-link btn-danger btn-lg delete"
                                                                        data-original-title="Delete"
                                                                        data-id="' . $row->id . '"
                                                                        data-nama="' . $row->nama . '">
                                                                        <i class="fa-solid fa-trash-can"></i>
                                                                    </button>
                                                                </a>
                                                            </div>';

                    return $btn;
                })
                ->rawColumns(['name', 'kelas', 'action'])
                ->make(true);
        }

        // return view('page.admin.data-anggota');
        $data = User::where('nisn', '!=', null)->get();
        // dd($data);
        $data_pengunjung = DataPengunjung::with('user')->get();
        // dd($data_pengunjung);
        return view('page.kepsek.data-pengunjung', ['datapengunjung' => $data_pengunjung, 'data' => $data]);
    }
    public function DataAnggota(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*')->where('nisn', '!=', 'null');

            if ($request->filled('from_date') && $request->filled('to_date')) {
                $data = $data->whereBetween('created_at', [$request->from_date, $request->to_date]);
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        return view('page.kepsek.data-anggota');
    }

    public function PeminjamandanPengembalianMandiri(Request $request)
    {
        if ($request->ajax()) {
            $data = PpMandiri::with(['user', 'databuku'])
                ->whereBetween('tgl_pinjam', [$request->from_date, $request->to_date])
                ->get();

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
                ->addColumn('nisn', function ($row) {
                    return $row->user->nisn;
                })
                ->addColumn('nama', function ($row) {
                    return $row->user->name;
                })
                ->addColumn('judul', function ($row) {
                    return $row->databuku->judul;
                })
                ->addColumn('no_panggil', function ($row) {
                    return $row->databuku->no_panggil;
                })
                ->rawColumns(['action', 'status', 'nisn', 'nama', 'judul', 'no_panggil'])
                ->make(true);
        }
        return view('page.kepsek.peminjamandanpengembalian-mandiri', );
    }
    public function PeminjamandanPengembalianKolektif(Request $request)
    {
        if ($request->ajax()) {
            $data = PpKolektif::with('user', 'databuku')
                ->whereBetween('tgl_pinjam', [$request->from_date, $request->to_date])
                ->get();

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

                ->addColumn('nisn', function ($row) {
                    return $row->user->nisn;
                })
                ->addColumn('name', function ($row) {
                    return $row->user->name;
                })
                ->addColumn('kelas', function ($row) {
                    return $row->user->kelas;
                })
                ->addColumn('judul', function ($row) {
                    return $row->databuku->judul;

                })
                ->rawColumns(['action', 'status', 'nisn', 'nama', 'judul', 'jumlah', 'kelas'])

                ->make(true);
        }

        return view('page.kepsek.peminjamandanpengembalian-kolektif');
    }
}