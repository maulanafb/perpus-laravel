<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Data Buku</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="../assets/img/icon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="../assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ['../assets/css/fonts.min.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/atlantis.min.css">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="../assets/css/demo.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    {{-- Font awesome --}}
    <script src="https://kit.fontawesome.com/1266dcde92.js" crossorigin="anonymous"></script>
    {{-- Sweetalert --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


</head>

<body>
    <div class="wrapper">
        <div class="main-header">
            <!-- Logo Header -->
            @include('component.header')
            <!-- End Logo Header -->

            <!-- Navbar Header -->
            @include('component.navbar')
            <!-- End Navbar -->
        </div>

        <!-- Sidebar -->
        @include('component.sidebar')
        <!-- End Sidebar -->
        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    <div class="page-header">
                        <h4 class="page-title">Data Buku</h4>
                        <ul class="breadcrumbs">
                            <li class="nav-home">
                                <a href="#">
                                    <i class="flaticon-home"></i>
                                </a>
                            </li>
                            <li class="separator">
                                <i class="flaticon-right-arrow"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">Data Buku</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title"></h4>
                                        <button class="btn btn-primary btn-round ml-auto"
                                            style="background: #5BC8AC!important;border-color:#5BC8AC !important;"
                                            data-toggle="modal" data-target="#addRowModal">
                                            <i class="fa fa-plus"></i>
                                            Tambah Data
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="add-row" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    {{-- <th>Id Buku</th> --}}
                                                    <th>Judul</th>
                                                    <th>Pengarang</th>
                                                    <th style="width: 10%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                @foreach ($databukus as $row)
                                                    @csrf
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        {{-- <td>{{ $row->id }}</td> --}}
                                                        <td>{{ $row->judul }}</td>
                                                        <td>{{ $row->pengarang }}</td>
                                                        <td>
                                                            <div class="form-button-action">
                                                                <button type="button" data-toggle="modal"
                                                                    data-target="#edit{{ $row->id }}"
                                                                    data-toggle="tooltip" title="Edit"
                                                                    class="btn btn-link btn-primary btn-lg"
                                                                    data-original-title="Edit">
                                                                    <i class="fa fa-edit"></i>
                                                                </button>
                                                                <a href="/data-buku/delete/{{ $row->id }}">
                                                                    <button type="button" data-toggle="tooltip"
                                                                        onclick="showSweetAlert()" title="Delete"
                                                                        class="btn btn-link btn-danger"
                                                                        data-original-title="Delete ">
                                                                        <i class="fa-solid fa-trash-can"></i>
                                                                    </button>
                                                                </a>
                                                                <button type="button" data-toggle="modal"
                                                                    data-target="#detail{{ $row->id }}"
                                                                    data-toggle="tooltip" title="Detail"
                                                                    class="btn btn-link btn-success"
                                                                    data-original-title="Detail">
                                                                    <i class="fa-solid fa-circle-info"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- Modal Edit -->

                                                    <!-- end Modal edit-->

                                                    <!-- Modal Detail -->
                                                    <div class="modal-detail">
                                                        <div class="modal fade" id="detail{{ $row->id }}"
                                                            tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header no-bd">
                                                                        <h5 class="modal-title">
                                                                            <p class="fw-mediumbold">Detail Buku </p>
                                                                            <span class="fw-light">
                                                                            </span>
                                                                        </h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="mb-2">
                                                                            <div class="detail-heading">
                                                                                <p>Judul Buku</p>
                                                                            </div>
                                                                            <div class="detail-text">
                                                                                <p>{{ $row->judul }}</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-2">
                                                                            <div class="detail-heading">
                                                                                <p>Pengarang</p>
                                                                            </div>
                                                                            <div class="detail-text">
                                                                                <p>{{ $row->pengarang }}</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-2">
                                                                            <div class="detail-heading">
                                                                                <p>Penerbit</p>
                                                                            </div>
                                                                            <div class="detail-text">
                                                                                <p>{{ $row->penerbit }}</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-2">
                                                                            <div class="detail-heading">
                                                                                <p>Tahun Terbit</p>
                                                                            </div>
                                                                            <div class="detail-text">
                                                                                <p>{{ $row->thn_terbit }}</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-2">
                                                                            <div class="detail-heading">
                                                                                <p>Kategori Buku</p>
                                                                            </div>
                                                                            <div class="detail-text">
                                                                                <p>{{ $row->kategori_buku }}</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-2">
                                                                            <div class="detail-heading">
                                                                                <p>ISBN</p>
                                                                            </div>
                                                                            <div class="detail-text">
                                                                                <p>{{ $row->ISBN }}</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-2">
                                                                            <div class="detail-heading">
                                                                                <p>No. Panggil</p>
                                                                            </div>
                                                                            <div class="detail-text">
                                                                                <p>{{ $row->no_panggil }}</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-2">
                                                                            <div class="detail-heading">
                                                                                <p>Stok</p>
                                                                            </div>
                                                                            <div class="detail-text">
                                                                                <p>{{ $row->stok }}</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-2">
                                                                            <div class="detail-heading">
                                                                                <p>Sumber</p>
                                                                            </div>
                                                                            <div class="detail-text">
                                                                                <p>{{ $row->sumber }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            @include('component.footer')
            <!-- End Footer -->

            <!-- Modal tambah-->
            <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header no-bd">
                            <h5 class="modal-title">
                                <span class="fw-mediumbold">
                                    Tambah Data</span>
                                <span class="fw-light">

                                </span>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p class="small">Silahkan Mengisi Data Buku Dibawah !</p>
                            <form action="/data-buku/tambah" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12 mb-3">
                                        <div class="row ">
                                            <div class="col-md-3 d-flex align-items-center">
                                                <label>Judul</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input id="addName" name="judul" type="text"
                                                    class="form-control" placeholder="" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-3">
                                        <div class="row ">
                                            <div class="col-md-3 d-flex align-items-center">
                                                <label>Pengarang</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input id="addName" name="pengarang" type="text"
                                                    class="form-control" placeholder="" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-3">
                                        <div class="row ">
                                            <div class="col-md-3 d-flex align-items-center">
                                                <label>Penerbit</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input id="addName" name="penerbit" type="text"
                                                    class="form-control" placeholder="" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-3">
                                        <div class="row ">
                                            <div class="col-md-3 d-flex align-items-center">
                                                <label>Tahun Terbit</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input id="addName" name="thn_terbit" type="text"
                                                    class="form-control" placeholder="" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-3">
                                        <div class="row ">
                                            <div class="col-md-3 d-flex align-items-center">
                                                <label>Kategori Buku</label>
                                            </div>
                                            <div class="col-md-9">
                                                <select class="form-select" aria-label="Default select example"
                                                    name="kategori_buku" required>
                                                    <option selected>Pilih Kategori</option>
                                                    <option value="Fiksi">Fiksi</option>
                                                    <option value="Non Fiksi">Non Fiksi</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-3">
                                        <div class="row ">
                                            <div class="col-md-3 d-flex align-items-center">
                                                <label>ISBN</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input id="addName" name="ISBN" type="text"
                                                    class="form-control" placeholder="" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-3">
                                        <div class="row ">
                                            <div class="col-md-3 d-flex align-items-center">
                                                <label>No Panggil</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input id="addName" name="no_panggil" type="text"
                                                    class="form-control" placeholder="" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-3">
                                        <div class="row ">
                                            <div class="col-md-3 d-flex align-items-center">
                                                <label>Stok</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input id="addName" name="stok" type="text"
                                                    class="form-control" placeholder="" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-3">
                                        <div class="row ">
                                            <div class="col-md-3 d-flex align-items-center">
                                                <label>Sumber</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input id="addName" name="sumber" type="text"
                                                    class="form-control" placeholder="" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer no-bd">
                                    <button type="submit" onclick="showSweetAlertTambah()"
                                        class="btn btn-primary">Tambah</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end Modal tambah-->

        </div>
        <!--   Core JS Files   -->
        <script src="../../assets/js/core/jquery.3.2.1.min.js"></script>
        <script src="../../assets/js/core/popper.min.js"></script>
        <script src="../../assets/js/core/bootstrap.min.js"></script>
        <!-- jQuery UI -->
        <script src="../../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
        <script src="../../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

        <!-- jQuery Scrollbar -->
        <script src="../../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
        <!-- Datatables -->
        <script src="../../assets/js/plugin/datatables/datatables.min.js"></script>
        <!-- Atlantis JS -->
        <script src="../../assets/js/atlantis.min.js"></script>
        <!-- Atlantis DEMO methods, don't include it in your project! -->
        <script src="../../assets/js/setting-demo2.js"></script>
        <script>
            $(document).ready(function() {
                $('#basic-datatables').DataTable({});

                $('#multi-filter-select').DataTable({
                    "pageLength": 5,
                    initComplete: function() {
                        this.api().columns().every(function() {
                            var column = this;
                            var select = $(
                                    '<select class="form-control"><option value=""></option></select>'
                                )
                                .appendTo($(column.footer()).empty())
                                .on('change', function() {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );

                                    column
                                        .search(val ? '^' + val + '$' : '', true, false)
                                        .draw();
                                });

                            column.data().unique().sort().each(function(d, j) {
                                select.append('<option value="' + d + '">' + d +
                                    '</option>')
                            });
                        });
                    }
                });

                // Add Row
                $('#add-row').DataTable({
                    "pageLength": 5,
                });

                var action =
                    '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

                $('#addRowButton').click(function() {
                    $('#add-row').dataTable().fnAddData([
                        $("#addName").val(),
                        $("#addPosition").val(),
                        $("#addOffice").val(),
                        action
                    ]);
                    $('#addRowModal').modal('hide');

                });
            });
        </script>

    </div>
    <div class="modal fade" id="edit{{ $row->id }}" tabindex="-1" role="dialog" aria-hidden="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">
                            Edit Data</span>
                        <span class="fw-light">

                        </span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="small">Silahkan Mengisi Data Buku Dibawah
                        !</p>
                    <form action="/data-buku/{{ $row->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 mb-3">
                                <div class="row ">
                                    <div class="col-md-3 d-flex align-items-center">
                                        <label>Judul</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input id="addName" value="{{ $row->judul }}" name="judul"
                                            type="text" class="form-control" placeholder="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <div class="row ">
                                    <div class="col-md-3 d-flex align-items-center">
                                        <label>Pengarang</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input id="addName" value="{{ $row->pengarang }}" name="pengarang"
                                            type="text" class="form-control" placeholder="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <div class="row ">
                                    <div class="col-md-3 d-flex align-items-center">
                                        <label>Penerbit</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input id="addName" value="{{ $row->penerbit }}" name="penerbit"
                                            type="text" class="form-control" placeholder="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <div class="row ">
                                    <div class="col-md-3 d-flex align-items-center">
                                        <label>Tahun Terbit</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input id="addName" value="{{ $row->thn_terbit }}" name="thn_terbit"
                                            type="text" class="form-control" placeholder="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <div class="row ">
                                    <div class="col-md-3 d-flex align-items-center">
                                        <label>Kategori Buku</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input id="addName" value="{{ $row->kategori_buku }}" name="kategori_buku"
                                            type="text" class="form-control" placeholder="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <div class="row ">
                                    <div class="col-md-3 d-flex align-items-center">
                                        <label>ISBN</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input id="addName" value="{{ $row->ISBN }}" name="ISBN"
                                            type="text" class="form-control" placeholder="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <div class="row ">
                                    <div class="col-md-3 d-flex align-items-center">
                                        <label>No Panggil</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input id="addName" value="{{ $row->no_panggil }}" name="no_panggil"
                                            type="text" class="form-control" placeholder="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <div class="row ">
                                    <div class="col-md-3 d-flex align-items-center">
                                        <label>Stok</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input id="addName" value="{{ $row->stok }}" name="stok"
                                            type="text" class="form-control" placeholder="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <div class="row ">
                                    <div class="col-md-3 d-flex align-items-center">
                                        <label>Sumber</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input id="addName" value="{{ $row->sumber }}" name="sumber"
                                            type="text" class="form-control" placeholder="" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer no-bd">
                            <button type="submit" onclick="showSweetAlertEdit()"
                                class="btn btn-primary">Edit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</body>

</html>

<script>
    function showSweetAlert() {
        swal({
            title: 'HAPUS DATA',
            text: 'Data Berhasil di Hapus',
            icon: 'success',
            buttons: {
                cancel: {
                    text: 'OK',
                    value: null,
                    visible: true,
                    className: 'btn btn-primary'
                }
            }
        });
    }

    function showSweetAlertTambah() {
        swal({
            title: 'TAMBAH DATA',
            text: 'Data Berhasil di Tambah',
            icon: 'success',
            buttons: {
                cancel: {
                    text: 'OK',
                    value: null,
                    visible: true,
                    className: 'btn btn-primary'
                }
            }
        });
    }

    function showSweetAlertEdit() {
        swal({
            title: 'EDIT DATA',
            text: 'Data Berhasil di Edit',
            icon: 'success',
            buttons: {
                cancel: {
                    text: 'OK',
                    value: null,
                    visible: true,
                    className: 'btn btn-primary'
                }
            }
        });
    }
</script>

<script>
    function display
    element.style.display = "none";
</script>
