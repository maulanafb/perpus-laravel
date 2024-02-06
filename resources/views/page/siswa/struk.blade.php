<!DOCTYPE html>
<html lang="en">

<head>
    <title>SEKOLAH MENENGAH KEJURUAN - AL MADANI PONTIANAK</title>
    @include('page.home.assets.head')
    <style>
        body {
            font-family: Arial, sans-serif;
        }

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

        .ringkasan {
            margin-top: 20px;
        }

        .ringkasan h4 {
            font-weight: bold;
            font-size: 18px;
        }

        .ringkasan ul {
            list-style: none;
            padding: 0;
            margin: 10px 0;
        }

        .ringkasan li {
            margin: 5px 0;
        }

        .info-buku {
            margin-top: 20px;
        }

        .info-buku p {
            margin: 5px 0;
        }

        .total {
            margin-top: 20px;
            font-size: 18px;
            text-align: center;
        }

        hr {
            margin: 15px 0;
            border: 0;
            border-top: 1px solid #ddd;
        }
    </style>
</head>

<body>

    {{-- struk --}}
    <div class="struk-container mb-3">
        <div class="judul">Struk Peminjaman Buku</div>
        <div class="ringkasan">
            <h4>Rincian Peminjaman</h4>
            <ul>
                <li>Tanggal Pinjam: {{ now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s') }}</li>
            </ul>
        </div>
        <div class="info-buku">
            @foreach ($cartItems as $cart)
                <p><strong>Judul Buku: {{ $cart->databuku->judul }}</strong></p>
                <p>Nama Peminjam: {{ $cart->user->name }}</p>
                <p>NISN: {{ $cart->user->nisn }}</p>
                <hr />
            @endforeach
        </div>
        <div class="total"><strong>*Tunjukkan Struk ini ke petugas perpustakaan untuk mengambil buku.</strong></div>
        <hr>
        <div class="total">Terima kasih telah meminjam buku. Selamat membaca!</div>
    </div>
    {{-- end struk --}}
      <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(isset($printStruk) && $printStruk)
                printStruk();
            @endif
        });

        function printStruk() {
            // Sembunyikan elemen-elemen yang tidak ingin dicetak
            var elementsToHide = document.querySelectorAll('body > *:not(.struk-container)');
            elementsToHide.forEach(function (element) {
                element.style.display = 'none';
            });

            // Cetak halaman
            window.print();

            // Tampilkan elemen-elemen yang disembunyikan setelah mencetak
            elementsToHide.forEach(function (element) {
                element.style.display = '';
            });

            // Tunggu 5 detik dan arahkan ke route 'historyMandiri'
            setTimeout(function () {
                window.location.href = "{{ route('history-mandiri') }}";
            }, 2000);
        }
    </script>
    <!-- Bagian lainnya ... -->
</body>

</html>
