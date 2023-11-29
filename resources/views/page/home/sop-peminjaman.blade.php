<!DOCTYPE html>
<html lang="en">

<head>
    <title>SEKOLAH MENENGAH KEJURUAN - AL MADANI PONTIANAK</title>
    @include('page.home.assets.head')
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
    <!-- ***** Header Area End ***** -->

    <!-- ***** Main Banner Area Start ***** -->


    <div class="page-heading">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-text">
                        <h2>SOP Peminjaman</h2>
                        <div class="div-dec"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="top-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="accordions is-first-expanded">
                        <div class="text-center" style="padding: 20px">
                            <div style="padding: 50px">
                              <h2 style="font-weight: bolder">SOP Peminjaman</h2>
                              <br>
                              <p class="mb-5 px-5">
                                Bagi siswa yang ingin melakukan peminjaman berikut adalah SOP Peminjaman : <br>
                                1. siswa datang ke perpustakaan <br>
                                2. Kartu Pelajar di serahkan ke petugas perpustakaan 
                                <br>3. sudah mempunyai akun dan login untuk meminjam buku
                                <br>4. memilih buku yang ingin di pinjam 
                                <br> 5. siswa menyerahkan bukti peminjaman
                                <br>6. Batas waktu peminjaman paling lama tiga hari (3 hari) dan <br> dapat diperpanjang sesuai kebutuhan peminjaman dan ketersedian buku.
                              </p>
                             
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="mt-4">
        @include('page.home.assets.footer')
    </footer>

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    @include('page.home.assets.footer-js')
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
</body>

</html>
