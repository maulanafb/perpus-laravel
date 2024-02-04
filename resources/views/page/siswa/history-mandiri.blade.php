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

<table class="table">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Judul</th>
      <th scope="col">Status</th>

    </tr>
  </thead>
<tbody>
@php $nomor_urut = 1 @endphp
@foreach ($history as $item)
    <tr>
        <td>{{ $nomor_urut++ }}</td>
        <td>{{ $item->databuku->judul }}</td>

        <td>
            @if ($item->status == 'kembali')
                <button class="btn btn-success">Dikembalikan</button>
            @elseif ($item->status == 'booking')
                <button class="btn btn-secondary">Booking</button>
            @else
                <button class="btn btn-warning">Sedang Dipinjam</button>
            @endif
        </td>
    </tr>
@endforeach
</tbody>
</table>

        </div>
    </section>




    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>

    <footer class="mt-4">
        @include('page.home.assets.footer')
    </footer>

    @include('page.home.assets.footer-js')
     <script>   @if(Session::has('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ Session::get('success') }}',
            showConfirmButton: false,
            timer: 1500
        });
    @endif
    </script>


</body>

</html>
