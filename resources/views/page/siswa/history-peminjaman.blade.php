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
        #table_print {
            text-align: center;
        }

        #table_print p, #table_print b, #table_print i {
            font-family: 'Poppins', sans-serif; /* Menggunakan font Poppins */
            font-size: 14px; /* Ukuran font 14px */
            text-align: center; /* Tengahkan teks horizontal */
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
                        <h2>Peminjaman Kolektif</h2>
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


        </div>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>

    <footer class="mt-4">
        @include('page.home.assets.footer')
    </footer>

    @include('page.home.assets.footer-js')


</body>

</html>
