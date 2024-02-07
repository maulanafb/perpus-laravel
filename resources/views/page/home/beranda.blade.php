<!DOCTYPE html>
<html lang="en">

<head>
    <title>SEKOLAH MENENGAH KEJURUAN - AL MADANI PONTIANAK</title>
    @include('page.home.assets.head')
</head>

<body>


    <!-- ***** Header Area Start ***** -->
    <header class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @include('page.home.assets.navbar')
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Main Banner Area Start ***** -->
    <div class="swiper-container" id="top">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="slide-inner" style="background-image:url(/pengunjung/assets/images/slide-01.jpg)">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="header-text">
                                    <h2>Selamat <em>Datang</em> di <br> Perpustakaan <em> SMK <br> Al-Madani
                                            Pontianak</em></h2>
                                    <div class="div-dec"></div>
                                    <p>Situs ini merupakan situs yang dibangun oleh perpustakaan dengan tujuan sebagai
                                        sarana komunikasi antar pengelola dengan pengguna perpustakaan serta sebagai
                                        sarana layanan dan buku yang dimiliki perpustakaan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="slide-inner" style="background-image:url(/pengunjung/assets/images/1.png)">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="header-text">
                                    <h2>Selamat <em>Datang</em> di <br> Perpustakaan <em> SMK <br> Al-Madani
                                            Pontianak</em></h2>
                                    <div class="div-dec"></div>
                                    <p>Melaksanakan layanan perpustakaan yang ramah, mudah, menyenangkan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-button-next swiper-button-white"></div>
            <div class="swiper-button-prev swiper-button-white"></div>
        </div>


        {{-- <footer class="mt-4">
            @include('page.home.assets.footer')
        </footer>

        @include('page.home.assets.footer-js') --}}


        <!-- Scripts -->
        <!-- Bootstrap core JavaScript -->
        @include('page.home.assets.footer-js')
     @foreach ($ppMandiris as $ppMandiri)
        @if(now()->diffInDays($ppMandiri->tgl_pinjam) > 3 && $ppMandiri->status == "pinjam")
            <script>
    // SweetAlert notification for overdue book with a button
    Swal.fire({
        icon: 'warning',
        title: 'Perhatian!',
        text: 'Ada buku yang terlambat dikembalikan. Harap segera mengembalikan buku. Klik OK untuk menuju ke halaman History Peminjaman Mandiri untuk mengetahui Buku apa yang terlambat dikembalikan',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK',
        cancelButtonText: 'Tutup'
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirect to the History Peminjaman Mandiri page
            window.location.href = "{{ route('history-mandiri') }}";
        }
    });
</script>
        @endif
    @endforeach
        <script>
            var interleaveOffset = 0.5;
            var swiperOptions = {
                loop: true,
                speed: 1000,
                grabCursor: true,
                watchSlidesProgress: true,
                mousewheelControl: true,
                keyboardControl: true,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev"
                },
                on: {
                    progress: function() {
                        var swiper = this;
                        for (var i = 0; i < swiper.slides.length; i++) {
                            var slideProgress = swiper.slides[i].progress;
                            var innerOffset = swiper.width * interleaveOffset;
                            var innerTranslate = slideProgress * innerOffset;
                            swiper.slides[i].querySelector(".slide-inner").style.transform =
                                "translate3d(" + innerTranslate + "px, 0, 0)";
                        }
                    },
                    touchStart: function() {
                        var swiper = this;
                        for (var i = 0; i < swiper.slides.length; i++) {
                            swiper.slides[i].style.transition = "";
                        }
                    },
                    setTransition: function(speed) {
                        var swiper = this;
                        for (var i = 0; i < swiper.slides.length; i++) {
                            swiper.slides[i].style.transition = speed + "ms";
                            swiper.slides[i].querySelector(".slide-inner").style.transition =
                                speed + "ms";
                        }
                    }
                }
            };

            var swiper = new Swiper(".swiper-container", swiperOptions);
        </script>

        <!-- SweetAlert library -->
        {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script> --}}
        <script>
            // Add an event listener to the logout link
            document.getElementById('logout-link').addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default link behavior

                // Display the SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Yakin?',
                    text: 'Anda akan keluar dari akun Anda!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Ya, keluar',

                }).then((result) => {
                    // If the user clicks the "Yes, keluar" button, redirect to the logout URL
                    if (result.isConfirmed) {
                        window.location.href = "/logout";
                    }
                });
            });
        </script>

</body>

</html>
