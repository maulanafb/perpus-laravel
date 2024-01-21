<nav class="main-nav  d-flex align-items-center justify-content-between">
    <!-- ***** Logo Start ***** -->
    <a href="/" class="logo">
        <img src="/pengunjung/assets/images/log1.png" alt="">
    </a>
    <!-- ***** Logo End ***** -->
    <!-- ***** Menu Start ***** -->
    <ul class="nav m-0">
        <li class="scroll-to-section"><a href="/"
                class="{{ Route::currentRouteNamed('index') ? 'active' : '' }}">Beranda</a></li>
        <li class="scroll-to-section"><a href="/profile"
                class="{{ Route::currentRouteNamed('profile') ? 'active' : '' }}">Profil</a></li>
        <li class="has-sub">
            <a href="javascript:void(0)">Layanan</a>
            <ul class="sub-menu">
                <li><a href="/sop-anggota">SOP Anggota</a></li>
                <li><a href="/sop-peminjam">SOP Peminjaman</a></li>
                <li><a href="/sop-pengembalian">SOP Pengembalian</a></li>
            </ul>
        </li>
        <li class="has-sub">
            <a class="{{ Route::currentRouteNamed('list-buku-kolektif') || Route::currentRouteNamed('list-buku-mandiri') ? 'active' : '' }}"
                href="javascript:void(0)">Peminjaman</a>
            <ul class="sub-menu">
                <li><a href="{{ route('list-buku-kolektif') }}">Pinjam Kolektif</a></li>
                <li><a href="{{ route('list-buku-mandiri') }}">Pinjam Mandiri</a></li>
            </ul>
        </li>
        @auth
            <li class="has-sub">
                <a href="javascript:void(0)">Hai, {{ Auth::user()->name }}</a>
                <ul class="sub-menu">

                    <li>
                        <a href="{{ route('history') }}"
                           >History </a>

                    </li>
                    <li>
                        <a href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        @else
            <li><a href="{{ route('login') }}">Masuk</a></li>
        @endauth
    </ul>
    <a class='menu-trigger'>
        <span>Menu</span>
    </a>
    <!-- ***** Menu End ***** -->
</nav>
