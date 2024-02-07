<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\User;
use App\Models\Databuku;
use App\Models\PpMandiri;
use App\Models\PpKolektif;
use App\Models\DataAnggota;
use Illuminate\Http\Request;
use App\Models\DataPengunjung;
use PDF;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //beranda/
    public function Beranda()
    {
        $total_buku = DataBuku::get()->count();
        $total_anggota = User::get()->count();
        $total_pengunjung = DataPengunjung::get()->count();
        $total_pinjam_mandiri = PpMandiri::get()->count();
        $total_pinjam_kolektif = PpKolektif::get()->count();
        $total_pengembalian_mandiri = PpMandiri::where('status', true)->get()->count();
        $total_pengembalian_kolektif = PpKolektif::where('status', true)->get()->count();
        return view('page.admin.beranda', compact('total_buku', 'total_anggota', 'total_pengunjung', 'total_pinjam_mandiri', 'total_pinjam_kolektif', 'total_pengembalian_mandiri', 'total_pengembalian_kolektif'));
    }

    //data buku/
    public function DataBuku(Request $request)
    {
        if ($request->ajax()) {
            $data = DataBuku::select('*');

            if ($request->filled('from_date') && $request->filled('to_date')) {
                $data = $data->whereBetween('created_at', [$request->from_date, $request->to_date]);
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editModalId = 'edit' . $row->id;
                    $detailModalId = 'detail' . $row->id;

                    return view('partials.action_buttons', compact('editModalId', 'detailModalId', 'row'));
                })
                ->addColumn('foto', function ($row) {
                    return '<img src="' . asset('storage/' . $row->img) . '" alt="Foto Buku" width="200">';
                })
                ->rawColumns(['action', 'foto'])
                ->make(true);
        }

        return view('page.admin.data-buku');
    }



    //create/
    public function TambahDataBuku(Request $request)
    {
        $validatedData = $request->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            // Validasi file gambar
            'judul' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'thn_terbit' => 'required',
            'kategori_buku' => 'required',
            'ISBN' => 'required',
            'no_panggil' => 'required',
            'stok' => 'required',
            'sumber' => 'required',
            // Tambahkan validasi lainnya sesuai dengan kebutuhan
        ]);

        // Simpan gambar di lokasi penyimpanan (contoh: storage/app/public/buku)
        $imagePath = $request->file('img')->store('public/buku');
        $imagePath = str_replace('public/', '', $imagePath);

        // Simpan data buku ke database
        $data_buku = new Databuku();
        $data_buku->judul = $request->input('judul');
        $data_buku->pengarang = $request->input('pengarang');
        $data_buku->penerbit = $request->input('penerbit');
        $data_buku->thn_terbit = $request->input('thn_terbit');
        $data_buku->kategori_buku = $request->input('kategori_buku');
        $data_buku->ISBN = $request->input('ISBN');
        $data_buku->no_panggil = $request->input('no_panggil');
        $data_buku->stok = $request->input('stok');
        $data_buku->sumber = $request->input('sumber');
        // Tambahkan atribut lain sesuai dengan kebutuhan
        $data_buku->img = $imagePath; // Simpan path gambar di kolom img
        $data_buku->save();

        // Redirect atau melakukan tindakan lain yang Anda butuhkan
        return redirect()->route('data-buku.admin')->with('success', 'Data buku berhasil ditambahkan.');
    }

    //update/
    public function updateDataBuku(Request $request, $id)
    {
        $validatedData = $request->validate([
            'img' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            // Validasi file gambar
            'judul' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'thn_terbit' => 'required',
            'kategori_buku' => 'required',
            'ISBN' => 'required',
            'no_panggil' => 'required',
            'stok' => 'required',
            'sumber' => 'required',
            // Tambahkan validasi lainnya sesuai dengan kebutuhan
        ]);

        // Cari data buku berdasarkan ID
        $data_buku = Databuku::findOrFail($id);

        // Jika ada file gambar yang diunggah, simpan gambar baru
        if ($request->hasFile('img')) {
            // Simpan gambar di lokasi penyimpanan (contoh: storage/app/public/buku)
            $imagePath = $request->file('img')->store('public/buku');
            $imagePath = str_replace('public/', '', $imagePath);
            $data_buku->img = $imagePath;
        }

        // Update data buku
        $data_buku->judul = $request->input('judul');
        $data_buku->pengarang = $request->input('pengarang');
        $data_buku->penerbit = $request->input('penerbit');
        $data_buku->thn_terbit = $request->input('thn_terbit');
        $data_buku->kategori_buku = $request->input('kategori_buku');
        $data_buku->ISBN = $request->input('ISBN');
        $data_buku->no_panggil = $request->input('no_panggil');
        $data_buku->stok = $request->input('stok');
        $data_buku->sumber = $request->input('sumber');
        // Update atribut lain sesuai dengan kebutuhan
        $data_buku->save();

        // Redirect atau melakukan tindakan lain yang Anda butuhkan
        return redirect()->route('data-buku.admin')->with('success', 'Data buku berhasil diperbarui.');
    }
    //delete/
    public function DeleteDataBuku($id)
    {
        $data_databuku = Databuku::find($id);
        $data_databuku->delete();
        return redirect()->route('data-buku.admin');
    }


    //data anggota/

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
                    <button type="button" class="btn btn-link btn-danger">
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
                                                                                            placeholder="" required disabled>
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
                                                                                        class="form-control" placeholder="Tanggal Lahir" required disabled>
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
                                                                                            placeholder="" required disabled>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm-12 mb-3">
                                                                                <div class="row ">
                                                                                    <div
                                                                                        class="col-md-3 d-flex align-items-center">
                                                                                        <label>Email</label>
                                                                                    </div>
                                                                                    <div class="col-md-9">
                                                                                        <input id="addName"
                                                                                            value="' . $row->email . '"
                                                                                            name="email"
                                                                                            type="text"
                                                                                            class="form-control"
                                                                                            placeholder="" required readonly>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm-12 mb-3">
                                                                                <div class="row ">
                                                                                    <div
                                                                                        class="col-md-3 d-flex align-items-center">
                                                                                        <label>Password Baru</label>
                                                                                    </div>
                                                                                    <div class="col-md-9">
                                                                                        <input id="addName"
                                                                                            value=""
                                                                                            name="password"
                                                                                            type="password"
                                                                                            class="form-control"
                                                                                            placeholder="" required >
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
    //create/
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
    //update/
    public function UpdateDataAnggota(Request $request, $id)
    {
        $data_anggota = User::find($id);
        $data_anggota->update($request->all());
        $data_anggota->password = bcrypt($request->password);
        $data_anggota->save();
        return redirect()->route('data-anggota');
    }
    //delete/
    public function DeleteDataAnggota($id)
    {

        $data_anggota = User::find($id);
        // dd($id);
        $data_anggota->delete();
        return redirect()->route('data-anggota');
    }


    //data pengunjung/
    public function DataPengunjung(Request $request)
    {
        if ($request->ajax()) {
            // $csrfToken = csrf_token();
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
                    return '<a href="/data-pengunjung/delete/' . $row->id . '">
                    <button type="button" class="btn btn-link btn-danger">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </a>';
                })





                ->rawColumns(['name', 'kelas', 'action'])
                ->make(true);
        }

        // return view('page.admin.data-anggota');
        $data = User::where('nisn', '!=', null)->get();
        // dd($data);
        $data_pengunjung = DataPengunjung::with('user')->get();
        // dd($data_pengunjung);
        return view('page.admin.data-pengunjung', ['datapengunjung' => $data_pengunjung, 'data' => $data]);
    }
    //create/
    public function TambahDataPengunjung(Request $request)
    {
        $data_pengunjung = DataPengunjung::create($request->all());
        // dd($request->all);
        return redirect()->route('data-pengunjung');
    }
    //update/
    public function UpdateDataPengunjung(Request $request, $id)
    {
        $data_pengunjung = DataPengunjung::find($id);
        $data_pengunjung->update($request->all());

        return redirect()->route('data-pengunjung');
    }
    //delete/
    public function DeleteDataPengunjung($id)
    {
        $data_pengunjung = DataPengunjung::find($id);
        $data_pengunjung->delete();
        return redirect()->route('data-pengunjung');
    }


    //PPMandiri/
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
                        if ($row->status == "booking") {
                            $sts = '<div class="btn btn-warning btn-sm">DiBooking</div>';
                        } else if ($row->status == "pinjam") {
                            $sts = '<div class="btn btn-success btn-sm">Dipinjam</div>';
                        } else {
                            $sts = '<div class="btn btn-secondary btn-sm">Dikembalikan</div>';
                        }
                        return $sts;
                    }
                )
                ->addColumn('nisn', function ($row) {
                    return $row->user->nisn;
                })
                ->addColumn('name', function ($row) {
                    return $row->user->name;
                })
                ->addColumn('judul', function ($row) {
                    return $row->databuku->judul;
                })
                ->addColumn('no_panggil', function ($row) {
                    return $row->databuku->no_panggil;
                })
                ->addColumn('action', function ($row) {
                    if (!$row->status) {
                        $btn = '<div class="form-button-action">
                                                                    <a href="/konfirmasi-mandiri/' . $row->id . ' ">
                    <button type="submit" data-toggle="tooltip" title="" onclick="showSweetAlertKembali()"
                    ' . ($row->status == "kembali" ? 'disabled' : '') . '
                        class="btn btn-warning btn-round ml-2" data-original-title="konfirmasi">
                        Konfirmasi
                    </button>
                </a>
													<a href="/peminjamandanpengembalian-mandiri/update/' . $row->id . ' ">
														<button type="button" data-toggle="tooltip" title="" onclick="showSweetAlertKembali()"  class="btn btn-primary btn-round ml-auto" data-original-title="Kembalikan">
															kembalikan
														</button>
													</a>
													<a href="/peminjamandanpengembalian-mandiri/perpanjang/' . $row->id . '">
														<button type="button" data-toggle="tooltip" title="" onclick="showSweetAlertPerpanjang()" class="btn btn-success btn-round ml-auto" data-original-title="Perpanjang">
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
                                        <a href="/konfirmasi-mandiri/' . $row->id . ' ">
                    <button type="submit" data-toggle="tooltip" title="" onclick="showSweetAlertKembali()"
                    ' . ($row->confirm ? 'disabled' : '') . '
                        class="btn btn-warning btn-round ml-2" data-original-title="Kembalikan">
                        Konfirmasi
                    </button>
                </a>
                                                                    <a
                                                                        href="/peminjamandanpengembalian-mandiri/update/' . $row->id . ' ">

                                                                        <button type="submit" data-toggle="tooltip"
                                                                            title=""
                                                                            onclick="showSweetAlertKembali()"
                                                                            class="btn btn-primary btn-round ml-auto"
                                                                            data-original-title="Kembalikan"
                                                                            ' . ($row->status === "kembali" ? "disabled" : "") . '
' . ($row->status === "kembali" ? "disabled" : "") . ' ' . ($row->status === "booking" ? "disabled" : "") . '>
                                                                            kembalikan
                                                                        </button>
                                                                    </a>
                                                                    <a href="/peminjamandanpengembalian-mandiri/perpanjang/' . $row->id . '">
														<button type="button" data-toggle="tooltip" title="" onclick="showSweetAlertPerpanjang()" class="btn btn-success btn-round ml-auto" data-original-title="Perpanjang" ' . ($row->status === "kembali" ? "disabled" : "") . '
' . ($row->status === "kembali" ? "disabled" : "") . ' ' . ($row->status === "booking" ? "disabled" : "") . ' >
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
                ->rawColumns(['action', 'status', 'nisn', 'name', 'judul', 'no_panggil'])
                ->make(true);
        }
        $judul_buku = Databuku::get();
        $no_panggil = Databuku::get();
        // dd($judul_buku);
        $data = User::where('nisn', '!=', null)->get();
        $pp_mandiri = PpMandiri::all();
        return view('page.admin.peminjamandanpengembalian-mandiri', compact('judul_buku', 'pp_mandiri', 'data'));
    }
    public function kurangiStokMandiri($id)
    {

        $ppmandiri = PpMandiri::find($id);
        $id_buku = $ppmandiri->id_buku;
        $buku = Databuku::find($id_buku);
        $jumlah = $ppmandiri->jumlah;

        // dd($buku);
        if (!$buku) {
            return redirect()->back()->with('error', 'Buku tidak ditemukan.');
        }

        // Ambil jumlah yang akan dikurangkan dari data jumlah pada tabel ppmandiri


        // Kurangi stok buku
        $buku->stok -= $jumlah;

        if ($buku->stok < 0) {
            $buku->stok = 0; // Pastikan stok tidak negatif
        }
        $buku->save();
        // Mengatur kolom "confirm" menjadi true
        $ppmandiri->confirm = true;
        date_default_timezone_set('Asia/Jakarta'); // Set the timezone to WIB
        $ppmandiri->tgl_pinjam = date('Y-m-d H:i:s');
        $ppmandiri->status = "pinjam";
        $ppmandiri->save();

        return redirect()->back()->with('success', 'buku berhasil di konfirmasi.');
    }

    //create/
    public function TambahPeminjamanMandiri(Request $request)
    {
        // Ambil data buku yang dipinjam berdasarkan id_buku
        $buku = Databuku::findOrFail($request->input('id_buku'));

        // Kurangkan stok buku sesuai dengan jumlah dipinjam
        $jumlah = $request->input('jumlah');
        if ($buku->stok >= $jumlah) {
            $buku->stok -= $jumlah;
            $buku->save();
            // Lanjutkan dengan membuat peminjaman mandiri
            $dataPeminjaman = [
                'id_buku' => $request->input('id_buku'),
                'jumlah' => $jumlah,
                'id_user' => $request->input('id_user'),
                'tgl_pinjam' => $request->input('tgl_pinjam'),
                'confirm' => false, // Selalu di-set ke true?
            ];
            // dd($dataPeminjaman);
            $pinjam_mandiri = PpMandiri::create($dataPeminjaman);

            return redirect()->route('pinjam-mandiri')->with('success', 'Peminjaman berhasil');
        } else {
            // Jika stok tidak mencukupi, berikan respon atau lakukan tindakan lainnya
            return redirect()->back()->with('error', 'Stok buku tidak mencukupi');
        }
    }




    // kembalikan
    public function KembalikanMandiri($id)
    {
        // Cari peminjaman berdasarkan ID
        $pinjam_mandiri = PpMandiri::findOrFail($id);

        // Ubah status menjadi "dikembalikan"
        $pinjam_mandiri->status = "kembali";
        if ($pinjam_mandiri->status) {
            $pinjam_mandiri->tgl_kembali = Carbon::now()->toDateString();
        } else {
            $pinjam_mandiri->tgl_kembali = null;
        }
        $pinjam_mandiri->save();

        // Tambah stok buku sesuai jumlah yang dipinjam
        $buku = Databuku::findOrFail($pinjam_mandiri->id_buku);
        $buku->stok += $pinjam_mandiri->jumlah;
        $buku->save();

        // Hitung denda
        $tgl_pengembalian = Carbon::parse($pinjam_mandiri->updated_at);
        $tgl_perpanjang = Carbon::parse($pinjam_mandiri->tgl_perpanjang ?? $pinjam_mandiri->tgl_pinjam);
        $selisihHari = $tgl_pengembalian->diffInDays($tgl_perpanjang);

        // Denda mulai dihitung setelah 3 hari sejak tanggal peminjaman
        $denda = max(0, $selisihHari - 3) * 1000;
        $pinjam_mandiri->denda = $denda;
        $pinjam_mandiri->save();

        return redirect()->route('pinjam-mandiri');
    }


    // perpanjang
    public function PerpanjangMandiri($id)
    {
        $pinjam_mandiri = PpMandiri::findOrFail($id);

        // Jika peminjaman sudah dikembalikan, tidak bisa dilakukan perpanjangan
        // if ($pinjam_mandiri->status) {
        //     return redirect('/peminjamandanpengembalian-mandiri-admin')->with('error', 'Peminjaman sudah dikembalikan, tidak bisa melakukan perpanjangan.');
        // }

        // Hitung tanggal perpanjangan peminjaman (tambahkan 3 hari dari tanggal pengembalian sebelumnya)
        $tgl_perpanjang = Carbon::parse($pinjam_mandiri->tgl_kembali)->addDays(3);

        // Pastikan tanggal perpanjangan tidak melebihi tanggal saat ini
        $tgl_perpanjang = $tgl_perpanjang->isPast() ? Carbon::now() : $tgl_perpanjang;

        // Update tanggal_pengembalian dengan tanggal perpanjangan
        $pinjam_mandiri->tgl_perpanjang = $tgl_perpanjang;
        $pinjam_mandiri->save();

        return redirect('/peminjamandanpengembalian-mandiri-admin')->with('success', 'Peminjaman berhasil diperpanjang.');
    }


    //delete/
    public function DeletePeminjamanMandiri($id)
    {
        $pinjam_mandiri = PpMandiri::find($id);
        $pinjam_mandiri->delete();
        return redirect()->route('pinjam-mandiri');
    }


    //PPKolektif/
    public function PeminjamandanPengembalianKolektif(Request $request)
    {
        // $data = PpKolektif::with('user', 'databuku')
        //     // ->whereBetween('tgl_pinjam', [$request->from_date, $request->to_date])
        //     ->get();
        // dd($data);
        if ($request->ajax()) {
            $data = PpKolektif::with('user', 'databuku')
                ->whereBetween('tgl_pinjam', [$request->from_date, $request->to_date])
                ->get();

            // ->get();
            // dd($data);

            if ($request->filled('from_date') && $request->filled('to_date')) {
                $data = $data->whereBetween('tgl_pinjam', [$request->from_date, $request->to_date]);
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn(
                    'status',
                    function ($row) {
                        if ($row->status == "booking") {
                            $sts = '<div class="btn btn-warning btn-sm">DiBooking</div>';
                        } else if ($row->status == "pinjam") {
                            $sts = '<div class="btn btn-success btn-sm">Dipinjam</div>';
                        } else {
                            $sts = '<div class="btn btn-secondary btn-sm">Dikembalikan</div>';
                        }
                        return $sts;
                    }
                )
                ->addColumn('action', function ($row) {
                    if (!$row->status == "booking") {
                        $btn = '<div class="form-button-action">
                <a href="/peminjamandanpengembalian-kolektif/update/' . $row->id . ' ">
                    <button type="submit" data-toggle="tooltip" title="" onclick="showSweetAlertKembali()"
                        class="btn btn-primary btn-round ml-auto" data-original-title="Kembalikan">
                        kembalikan
                    </button>
                </a>
                <a href="/konfirmasi-kolektif/' . $row->id . ' ">
                    <button type="submit" data-toggle="tooltip" title="" onclick="showSweetAlertKembali()"
                    ' . ($row->confirm ? 'disabled' : '') . '
                        class="btn btn-warning btn-round ml-2" data-original-title="Kembalikan">
                        Konfirmasi
                    </button>
                </a>
                <a href="/peminjamandanpengembalian-kolektif/delete/' . $row->id . ' ">
                    <button type="button" data-toggle="tooltip" title="" onclick="showSweetAlert()"
                        class="btn btn-link btn-danger" data-original-title="Hapus">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </a>
            </div>';
                    } else {
                        $btn = '<div class="form-button-action">
                <a href="/peminjamandanpengembalian-kolektif/update/' . $row->id . ' ">
                    <button type="submit" data-toggle="tooltip" title="" onclick="showSweetAlertKembali()"
                        class="btn btn-primary btn-round ml-auto" data-original-title="Kembalikan" ' . ($row->status === "kembali" ? 'disabled' : '') . ' ' . ($row->status === "booking" ? 'disabled' : '') . '>
                        kembalikan
                    </button>
                </a>
                <a href="/konfirmasi-kolektif/' . $row->id . ' ">
                    <button type="submit" data-toggle="tooltip" title="" onclick="showSweetAlertKembali()"
                    ' . ($row->status === "kembali" ? 'disabled' : '') . '
                    ' . ($row->status === "pinjam" ? 'disabled' : '') . '
                        class="ml-2 btn btn-warning btn-round ml-2" data-original-title="Kembalikan">
                        Konfirmasi
                    </button>
                </a>
                <a href="/peminjamandanpengembalian-kolektif/delete/' . $row->id . ' ">
                    <button type="button" data-toggle="tooltip" title="" onclick="showSweetAlert()"
                        class="btn btn-link btn-danger" data-original-title="Hapus">
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
                })->addColumn('judul', function ($row) {
                    return $row->databuku->judul;

                })
                ->rawColumns(['action', 'status', 'nisn', 'nama', 'judul', 'jumlah'])
                ->make(true);
        }
        $data = User::where('nisn', '!=', null)->get();
        // dd($data);
        $judul_buku = Databuku::get();
        // dd($judul_buku);
        $pp_kolektif = PpKolektif::all();


        return view('page.admin.peminjamandanpengembalian-kolektif', compact('judul_buku', 'pp_kolektif', 'data'));
    }

    public function kurangiStokKolektif($id)
    {

        $ppkolektif = PpKolektif::find($id);
        $id_buku = $ppkolektif->id_buku;
        $buku = Databuku::find($id_buku);

        // dd($buku);
        if (!$buku) {
            return redirect()->back()->with('error', 'Buku tidak ditemukan.');
        }

        // Ambil jumlah yang akan dikurangkan dari data jumlah pada tabel ppkolektif
        $jumlah = $ppkolektif->jumlah;

        // Kurangi stok buku
        $buku->stok -= $jumlah;

        if ($buku->stok < 0) {
            $buku->stok = 0; // Pastikan stok tidak negatif
        }

        $buku->save();
        // Mengatur kolom "confirm" menjadi true
        $ppkolektif->confirm = true;
        $ppkolektif->status = "pinjam";
        $ppkolektif->save();

        return redirect()->back()->with('success', 'buku berhasil di konfirmasi.');
    }




    //create/
    public function TambahPeminjamanKolektif(Request $request)
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

        // Ambil id_user dari input form
        $id_user = $request->input('id_user');

        // Ambil data buku yang dipinjam berdasarkan id_buku
        $id_buku = $request->input('id_buku');
        $buku = Databuku::find($id_buku);

        // Kurangkan stok buku sesuai dengan jumlah dipinjam
        $jumlah = $request->input('jumlah');
        if ($buku && $buku->stok >= $jumlah) {
            // Lanjutkan dengan membuat peminjaman kolektif
            $pinjam_kolektif = PpKolektif::create([
                'id_user' => $id_user,
                'id_buku' => $id_buku,
                'tgl_pinjam' => $request->input('tgl_pinjam'),
                'jumlah' => $jumlah,
                // 'status' => false,
                // ... (atribut lainnya)
                'confirm' => true, // Tambahkan 'confirm' => true
            ]);

            // Kurangkan stok buku
            $buku->stok -= $jumlah;
            $buku->save();

            return redirect()->route('pinjam-kolektif');
        } else {
            // Jika stok tidak mencukupi, berikan respon atau lakukan tindakan lainnya
            return redirect()->back()->with('error', 'Stok buku tidak mencukupi');
        }
    }




    // kembalikan
    public function KembalikanKolektif($id)
    {
        // Cari peminjaman berdasarkan ID
        $pinjam_kolektif = PpKolektif::findOrFail($id);

        // dd($pinjam_kolektif);

        // Jika status peminjaman adalah "Dikembalikan", tidak perlu melakukan apa-apa
        // Ubah status menjadi "dikembalikan"
        // dd($pinjam_kolektif->status);
        $pinjam_kolektif->status = "kembali";
        $pinjam_kolektif->tgl_kembali = Carbon::now()->toDateString();
        $pinjam_kolektif->save();

        // Ambil informasi buku yang dipinjam

        $jumlah_dikembalikan = $pinjam_kolektif->jumlah;
        // dd($jumlah_dikembalikan);
        // Tambahkan jumlah yang dikembalikan ke dalam stok buku
        $buku = Databuku::findOrFail($pinjam_kolektif->id_buku);
        $judul_buku = $buku->judul;
        if ($buku) {
            $buku->stok += $jumlah_dikembalikan;
            $buku->save();
        }
        // dd($buku->stok);
        // Redirect ke halaman sebelumnya atau halaman yang sesuai
        return redirect()->route('pinjam-kolektif');
    }


    //delete/
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

    public function pdfKolektif(Request $request)
    {
        $query = PpKolektif::query();

        if ($request->tglawal && $request->tglakhir) {
            $tglawal = Carbon::createFromFormat('m-d-Y', $request->tglawal)->format('Y-m-d');
            $tglakhir = Carbon::createFromFormat('m-d-Y', $request->tglakhir)->format('Y-m-d');
            $query->whereBetween('created_at', [$tglawal, $tglakhir]);
        }

        $data = $query->get();
        $pdfData = [];

        foreach ($data as $item) {
            $itemData = $item->toArray();

            // Assuming there's a relationship named 'user' on the PpMandiri model
            $siswaData = $item->user ? $item->user->toArray() : [];

            // Assuming there's a relationship named 'databuku' on the PpMandiri model
            $databukuData = $item->databuku ? $item->databuku->toArray() : [];

            // Merge PpMandiri data with related Siswa and DataBuku data
            $pdfData['data'][] = array_merge($itemData, $siswaData, $databukuData);
        }

        $pdfData['tglawal'] = $request->tglawal;
        $pdfData['tglakhir'] = $request->tglakhir;
        // dd($pdfData);

        $pdf = PDF::loadView('page.admin.pdfKolektif', compact('pdfData'));

        if ($pdfData['tglawal'] && $pdfData['tglakhir']) {
            return $pdf->download('lap-kolektif-' . $request->tglawal . ' sampai ' . $request->tglakhir . '.pdf');
        } else {
            return $pdf->download('lap-kolektif-semua-tanggal.pdf');
        }
    }

    public function pdfMandiri(Request $request)
    {
        $query = PpMandiri::query();

        if ($request->tglawal && $request->tglakhir) {
            $tglawal = Carbon::createFromFormat('m-d-Y', $request->tglawal)->format('Y-m-d');
            $tglakhir = Carbon::createFromFormat('m-d-Y', $request->tglakhir)->addDays(1)->format('Y-m-d');
            $query->whereBetween('created_at', [$tglawal, $tglakhir]);
        }
        $data = $query->get();
        $pdfData = [];

        foreach ($data as $item) {
            $itemData = $item->toArray();

            // Assuming there's a relationship named 'user' on the PpMandiri model
            $siswaData = $item->user ? $item->user->toArray() : [];

            // Assuming there's a relationship named 'databuku' on the PpMandiri model
            $databukuData = $item->databuku ? $item->databuku->toArray() : [];

            // Merge PpMandiri data with related Siswa and DataBuku data
            $pdfData['data'][] = array_merge($itemData, $siswaData, $databukuData);
        }

        $pdfData['tglawal'] = $request->tglawal;
        $pdfData['tglakhir'] = $request->tglakhir;
        // dd($pdfData);

        $pdf = PDF::loadView('page.admin.pdfMandiri', compact('pdfData'));

        if ($pdfData['tglawal'] && $pdfData['tglakhir']) {
            return $pdf->download('lap-mandiri-' . $request->tglawal . ' sampai ' . $request->tglakhir . '.pdf');
        } else {
            return $pdf->download('lap-kolektif-semua-tanggal.pdf');
        }
    }
}
