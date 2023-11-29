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
                        <h2>Profil</h2>
                        <div class="div-dec"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="service-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="naccs">
                        <div class="tabs">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="menu">
                                        <div class="active gradient-border"><span>Visi dan Misi</span></div>
                                        <div class="gradient-border"><span>Struktur Organisasi</span></div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <ul class="nacc">
                                        <li class="active">
                                            <div>
                                                <div class="text-center" style="padding: 20px">
                                                    <div style="padding: 50px">
                                                    <h2 style="font-weight: bolder">Visi</h2>
                                                    <p class="mb-5 px-5">Mampu berperan dalam menigkatkan mutu pendidikan dengan 
                                                      mengembangkan perpustakaan manjadi pusat belajar di sekolah 
                                                    </p>
                                                    <h2 style="font-weight: bolder">Misi</h2>
                                                    <p class="px-5">Meningkatkan kualitas layanan yang diberikan ,terutama dalam memenuhi
                                                      kebutuhan atau kelengkapan sarana belajar guna mencapai tujuan 
                                                      pendidikan di sekolah.        
                                                    </p>
                                                    </div>
                                                  </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                <div class="">
                                                    <img src="{{ asset('assets/img/almadani.png') }}" alt="" width="auto">
                                                </div>
                                        
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="partners">
        <div class="container">

        </div>
    </section>

    <footer>
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
