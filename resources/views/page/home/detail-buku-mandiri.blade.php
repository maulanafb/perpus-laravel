<!DOCTYPE html>
<html lang="en">

<head>
    <title>SEKOLAH MENENGAH KEJURUAN - AL MADANI PONTIANAK</title>
    @include('page.home.assets.head')
    <style>
        /* Gaya untuk memusatkan teks pada header tabel */
        .table thead th {
            text-align: center;
        }

        td {
            text-align: center;
        }
    </style>
</head>

<body>

    <header class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @include('page.home.assets.navbar')
                </div>
            </div>
        </div>
    </header>

    <div class="page-heading">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-text">
                        <h2>Peminjaman Mandiri</h2>
                        <div class="div-dec"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="pb-5">

        <div class="container">
            <button class="btn btn-secondary btn-block mb-5 px-3" onclick="history.back()">
                <i class="fas fa-arrow-left"></i> Kembali ke Halaman sebelumnya
            </button>


            <div class="row justify-content-center align-items-center">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="{{ Storage::url('public/' . $book->img) }}" alt="Cover Buku" class="img-fluid"
                                    style="max-width: 300px; max-height: 400px;">
                            </div>
                            <h3 class="text-center mb-3">Judul : {{ $book->judul }}</h3>
                            <div class="row text-center">
                                <div class="col-md-6">
                                    <p><strong>Pengarang:</strong> {{ $book->pengarang }}</p>
                                    <p><strong>Penerbit:</strong> {{ $book->penerbit }}</p>
                                    <p><strong>Tahun Terbit:</strong> {{ $book->thn_terbit }}</p>
                                    <p><strong>Kategori:</strong> {{ $book->kategori_buku }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>ISBN:</strong> {{ $book->ISBN }}</p>
                                    <p><strong>Nomor Panggil:</strong> {{ $book->nomor_panggil }}</p>
                                    <p><strong>Stok Tersedia:</strong> {{ $book->stok }}</p>
                                    <p><strong>Sumber:</strong> {{ $book->sumber }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-4">
                    <div class="card">
                        <div class="card-body">
                             <label for="inputQuantity" class="form-label">Jumlah Buku yang Ingin
                                Dipinjam:</label>
                            <input type="hidden" id="inputQuantity" class="form-control mb-3" min="1"
                                max="{{ $book->stok }}" onchange="validateInput()" value="1">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <button class="btn btn-primary btn-block d-flex justify-align-center" class="text-center" id="pinjamButton">Pinjam Langsung</button>
                                </div>
                                <div class="col-12 col-md-6">
                                    <form action="{{ route('addcart') }}" method="post">
        @csrf
        <input type="hidden" name="id_buku" value="{{ $book->id }}" >
        <button type="submit" class="btn btn-secondary btn-block d-flex justify-align-center text-center" id="pinjamButton">Masukkan Keranjang</button>
    </form>
                                    <button type="button" class="dt-button buttons-print d-none" onclick="printJS({ printable: 'table_print', type: 'html', header: 'Title' })">Print</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @php
     use Carbon\Carbon;

     function currentDate(){
        return Carbon::now()->format('Y-m-d');
     }

     $tanggal = currentDate();
    @endphp
     <section class="d-none table_print text-center" id="table_print">
        <p style="font-family: 'Poppins', sans-serif; font-size: 20px; text-align: center; ">
        <b>Struk Peminjaman Buku Mandiri</b>
        </p>
        <p style="font-family: 'Poppins', sans-serif; font-size: 16px; ">
            Nama                : {{Auth::user()->name}}
        </p>
        <p style="font-family: 'Poppins', sans-serif; font-size: 16px; ">
            Kelas               : {{Auth::user()->kelas}}
        </p>
        <p style="font-family: 'Poppins', sans-serif; font-size: 16px; ">
            Judul Buku          : {{$book->judul}}
        </p>
        <p style="font-family: 'Poppins', sans-serif; font-size: 16px; ">
            Tanggal Pinjam      : {{ $tanggal }}
        </p>
        <br>
        {{-- <p>Jumlah : <div id="jumlahbuku"></div></p> --}}
        <p style="font-family: 'Poppins', sans-serif; font-size: 14px; text-align: center;">
            <i>
               * Mohon pastikan untuk menyerahkan kertas ini kepada petugas perpustakaan saat meminjam buku di perpustakaan, rawat buku dengan baik dan mengembalikannya sesuai dengan tanggal yang telah ditetapkan. Terima kasih atas kerjasamanya!.
            </i>
        </p>
    </section>

    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const inputQuantity = document.getElementById("inputQuantity");
        const pinjamButton = document.getElementById("pinjamButton");

        function validateInput() {
            if (inputQuantity.value === "" || parseInt(inputQuantity.value) < 1) {
                pinjamButton.disabled = true;
            } else {
                pinjamButton.disabled = false;
            }
        }

        // Panggil fungsi validateInput saat halaman dimuat
        validateInput();

        // Tambahkan event listener untuk memeriksa perubahan input
        inputQuantity.addEventListener("input", validateInput);
    </script>



    <script>
    document.addEventListener("DOMContentLoaded", function() {
    const pinjamButton = document.getElementById("pinjamButton");
    const inputQuantity = document.getElementById("inputQuantity");
    const maxStock = {{ $book->stok }};
    const csrfToken = '{{ csrf_token() }}';

    pinjamButton.addEventListener("click", function() {
        const requestedQuantity = parseInt(inputQuantity.value);

        if (requestedQuantity <= 0 || requestedQuantity > maxStock) {
            Swal.fire('Invalid Input', 'Jumlah buku yang ingin dipinjam tidak valid.', 'error');
        } else {
            const currentDate = new Date();
            const formattedDate = currentDate.toISOString().split('T')[0];

            Swal.fire({
                title: 'Konfirmasi Peminjaman',
                html: `<p>Judul Buku: {{ $book->judul }}</p>` +
                    `<p>Nama Peminjam: {{ Auth::user()->name }}</p>` +
                    `<p>Jumlah Stok Tersedia: {{ $book->stok }}</p>` +
                    `<p>Jumlah Buku yang Ingin Dipinjam: ${requestedQuantity}</p>`,
                showCancelButton: true,
                confirmButtonText: 'Konfirmasi Pinjam',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send the loan request to the server
                    $.ajax({
                        method: "POST",
                        url: "{{ route('pp-mandiri-siswa') }}", // Change this to your route
                        data: {
                            _token: csrfToken,
                            id_buku: {{ $book->id }},
                            id_user: {{ Auth::user()->id }},
                            tgl_pinjam: formattedDate,
                            jumlah: requestedQuantity
                        },
                        success: function(response) {
                            Swal.fire('Berhasil',
                                'Permintaan peminjaman berhasil dikirim!',
                                'success');

                            // Call the printJS function here
                            printJS({ printable: 'table_print', type: 'html', header: '' });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire('Gagal',
                                'Permintaan peminjaman gagal. Silakan coba lagi.',
                                'error');
                        }
                    });
                }
            });
        }
    });
});
    </script>










    <footer class="mt-4">
        @include('page.home.assets.footer')
    </footer>

    @include('page.home.assets.footer-js')


</body>

</html>
