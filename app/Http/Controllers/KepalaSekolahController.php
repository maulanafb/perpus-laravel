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
        $total_buku = Databuku::get()->count();
        $total_anggota = DataAnggota::get()->count();
        $total_pengunjung = DataPengunjung::get()->count();
        //  dd($total_buku);

        return view('page.kepsek.beranda', compact('total_buku', 'total_anggota', 'total_pengunjung'));
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
        return view('page.kepsek.peminjamandanpengembalian-mandiri', );
    }
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

        return view('page.kepsek.peminjamandanpengembalian-kolektif');
    }
}