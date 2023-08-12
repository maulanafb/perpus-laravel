@role('admin')
    <div class="sidebar sidebar-style-2">
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
            <div class="sidebar-content">
                <ul class="nav nav-light">
                    <li class="nav-item active">
                        <a href="beranda" class="collapsed" aria-expanded="false">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a data-toggle="collapse" href="#forms">
                            <i class="fas fa-pen-square"></i>
                            <p>Data Master</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="forms">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="data-buku-admin">
                                        <span class="sub-item">Data Buku</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="data-anggota">
                                        <span class="sub-item">Data Anggota</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="data-pengunjung">
                                        <span class="sub-item">Data Pengunjung</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item active">
                        <a data-toggle="collapse" href="#tables">
                            <i class="fas fa-table"></i>
                            <p>Sirkulasi</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="tables">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="peminjamandanpengembalian-mandiri-admin">
                                        <span class="sub-item">Peminjaman dan Pengembalian Mandiri</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="peminjamandanpengembalian-kolektif-admin">
                                        <span class="sub-item">Peminjaman dan Pengembalian Kolektif</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    {{-- <li class="mx-4 mt-2">
                    <a href="http://themekita.com/atlantis-bootstrap-dashboard.html" class="btn btn-danger btn-block"><span class="btn-label mr-2"> <i class="fa fa-heart"></i> </span>Logout</a>
                </li> --}}
                </ul>
            </div>
        </div>
    </div>
    @elserole('kepsek')
    <div class="sidebar sidebar-style-2">
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
            <div class="sidebar-content">
                <ul class="nav nav-light">
                    <li class="nav-item active">
                        <a href="beranda" class="collapsed" aria-expanded="false">
                            <i class="fas fa-home"></i>
                            <p>Dashboard Kepsek</p>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a data-toggle="collapse" href="#forms">
                            <i class="fas fa-chart-bar"></i>
                            <p>Data Laporan</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="forms">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="data-buku-kepsek">
                                        <span class="sub-item">Data Buku</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="data-anggota-kepsek">
                                        <span class="sub-item">Data Anggota</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="data-pengunjung-kepsek">
                                        <span class="sub-item">Data Pengunjung</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="pp-mandiri-kepsek">
                                        <span class="sub-item">Peminjaman dan Pengembalian Mandiri</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="pp-kolektif-kepsek">
                                        <span class="sub-item">Peminjaman dan Pengembalian Kolektif</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    {{-- <li class="mx-4 mt-2">
                    <a href="http://themekita.com/atlantis-bootstrap-dashboard.html" class="btn btn-danger btn-block"><span class="btn-label mr-2"> <i class="fa fa-heart"></i> </span>Logout</a>
                </li> --}}
                </ul>
            </div>
        </div>
    </div>
@else
    <div class="sidebar sidebar-style-2">
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
            <div class="sidebar-content">
                <ul class="nav nav-light">
                    <li class="nav-item active">
                        <a href="beranda-siswa" class="collapsed" aria-expanded="false">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a data-toggle="collapse" href="#forms">
                            <i class="fas fa-pen-square"></i>
                            <p>Data Master</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="forms">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="data-buku">
                                        <span class="sub-item">Data Buku</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item active">
                        <a data-toggle="collapse" href="#tables">
                            <i class="fas fa-table"></i>
                            <p>Sirkulasi</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="tables">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="peminjamandanpengembalian-mandiri">
                                        <span class="sub-item">Peminjaman dan Pengembalian Mandiri</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="peminjamandanpengembalian-kolektif">
                                        <span class="sub-item">Peminjaman dan Pengembalian Kolektif</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    {{-- <li class="mx-4 mt-2">
                    <a href="http://themekita.com/atlantis-bootstrap-dashboard.html" class="btn btn-danger btn-block"><span class="btn-label mr-2"> <i class="fa fa-heart"></i> </span>Logout</a>
                </li> --}}
                </ul>
            </div>
        </div>
    </div>
@endrole
