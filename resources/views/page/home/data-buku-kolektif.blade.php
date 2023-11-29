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
                        <h2>Data Buku</h2>
                        <div class="div-dec"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section>
        <div class="container">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $key => $book)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $book->judul }}</td>
                                <td>{{ $book->kategori_buku }}</td>
                                <td><a href="{{ url('/detail-buku-kolektif', ['id' => $book->id]) }}"
                                        class="btn btn-primary">Detail</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <footer class="mt-4">
        @include('page.home.assets.footer')
    </footer>

    @include('page.home.assets.footer-js')
    <script></script>
</body>

</html>
