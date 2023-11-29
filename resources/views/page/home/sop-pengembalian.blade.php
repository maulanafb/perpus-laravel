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
                        <h2>SOP Pengembalian</h2>
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
                              <h2 style="font-weight: bolder">SOP Pengembalian</h2>
                              <br>
                              <p class="mb-5 px-5">
                                Bagi siswa yang ingin mengembalikan buku berikut adalah SOP Pengembalian :
                                <br>1. Siswa datang ke perpustakaan 
                                <br>2. siswa menyerahkan buku yang telah di pinjam 
                                <br>3. Petugas mengkonfirmasi pengembalian 
                                <br>4. Petugas melihat keterlambatan pengembalian jika telat dari <br> 3 hari maka akan dikenakan denda 1000/hari.
                                <br>5. Petugas mengembalikan kartu pelajar
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
