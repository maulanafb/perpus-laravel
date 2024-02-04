<!DOCTYPE html>
<html lang="en">

<head>
    <title>SEKOLAH MENENGAH KEJURUAN - AL MADANI PONTIANAK</title>
    @include('page.home.assets.head')
    <style>
          .struk-container {
            max-width: 600px;
            margin: auto;
            border: 1px solid #ddd;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .judul {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
        }

        .info-buku {
            margin-top: 20px;
        }

        .info-buku p {
            margin: 5px 0;
        }

        .ringkasan {
            margin-top: 20px;
            font-weight: bold;
        }

        .ringkasan li {
            list-style: none;
            margin: 5px 0;
        }

        .total {
            margin-top: 20px;
            font-size: 18px;
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
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
                        <h2>Keranjang Buku</h2>
                        <div class="div-dec"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Main Banner Area Start ***** -->
    <section class="h-100 gradient-custom">
        <div class="container py-5">
            <button class="btn btn-secondary btn-block mb-5 px-3" onclick="history.back()">
                <i class="fas fa-arrow-left"></i> Kembali ke Halaman sebelumnya
            </button>
            <div class="row d-flex justify-content-centersx my-4">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h5 class="mb-0">Keranjang Buku - ({{ $total }}) Buku</h5>
                        </div>
                        <div class="card-body">
                            <!-- Single item -->
                            <div class="row">
                                <div class="col-lg-12 col-md-12 mb-4 mb-lg-0 ">
                                    <!-- Data -->
                                    @foreach ($carts as $cart)
                                    <form action="{{ route('deletecart', ['id' => $cart->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="row align-items-center">
                                            <div class="col-md-11">
                                                <p><strong>Judul Buku : {{ $cart->databuku->judul  }}</strong></p>
                                                <p>Nama Peminjam : {{ $cart->user->name }}</p>
                                                <p>NISN : {{ $cart->user->nisn }}</p>
                                            </div>
                                            <div class="col-md-1 ms-auto">
                                                <button type="submit" class="btn btn-danger btn-sm me-1 mb-2"
                                                    data-mdb-toggle="tooltip" title="Remove item">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <hr class="my-4" />
                                    @endforeach
                                </div>
                                <!-- Data -->

                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-header py-3">
                                <h5 class="mb-0">Ringkasan</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                        Tanggal Pinjam
                                        <span>{{ now()->format('Y-m-d') }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0 mt-2 mb-2">
                                        <strong>*Durasi peminjaman maksimal 3 hari</strong>
                                    </li>
                                </ul>

                                <form method="post" action="{{ route('checkout', ['userId' => Auth::id()]) }}">
    @csrf
    <button type="submit" class="btn btn-primary btn-lg btn-block">
        Pinjam Sekarang
    </button>
</form>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </section>

    {{-- struk --}}



    {{-- end struk --}}


    <footer>
        @include('page.home.assets.footer')
    </footer>

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    @include('page.home.assets.footer-js')
<script>
    @if(Session::has('success'))
        printStruk()
    @endif

    function printStruk() {
        // Sembunyikan elemen-elemen yang tidak ingin dicetak
        var elementsToHide = document.querySelectorAll('body > *:not(.struk-container)');
        elementsToHide.forEach(function (element) {
            element.style.display = 'none';
        });

        // Cetak halaman
        window.print();

        // Kembalikan tampilan elemen-elemen yang disembunyikan
        elementsToHide.forEach(function (element) {
            element.style.display = '';
        });
    }
</script>
</body>

</html>
