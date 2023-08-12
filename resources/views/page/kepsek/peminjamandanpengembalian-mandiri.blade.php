<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Peminjaman dan Pengembalian Mandiri</title>
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
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

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
                        <h4 class="page-title">Peminjaman dan Pengembalian Mandiri</h4>
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
                                <a href="#">Peminjaman dan Pengembalian Mandiri</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        {{-- filter tanggal  --}}

                                        <div style="margin: 20px 0px;">
                                            <strong>Date Filter:</strong>
                                            <input type="text" name="daterange" value="" />
                                            <button class="btn btn-primary filter ml-2">Filter</button>
                                        </div>
                                        <button id="excelExport" class="btn btn-success ml-2"><i
                                                class="fa fa-file-excel-o"></i>
                                            Excell</button>

                                        <button id="pdfExport" class="btn btn-danger ml-2"><i
                                                class="fa fa-file-pdf-o"></i>
                                            Pdf</button>
                                        <h4 class="card-title"></h4>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="add-row" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nisn</th>
                                                    <th>Nama</th>
                                                    <th>Judul Buku</th>
                                                    <th>No Panggil</th>
                                                    <th>Tanggal Peminjaman</th>
                                                    <th>Tanggal Pengembalian</th>
                                                    <th>Tanggal Perpanjang</th>
                                                    <th>Denda</th>
                                                    <th>Status</th>
                                                    <th style="width: 10%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>

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


                                </span>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p class="small">Silahkan Mengisi Data Peminjaman Dibawah !</p>
                            <form action="/peminjamandanpengembalian-mandiri" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12 mb-3">
                                        <div class="row ">
                                            <div class="col-md-3 d-flex align-items-center">
                                                <label>Nisn</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input id="addName" name="nisn" type="text" class="form-control"
                                                    placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-3">
                                        <div class="row ">
                                            <div class="col-md-3 d-flex align-items-center">
                                                <label>Nama</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input id="addName" name="nama" type="text" class="form-control"
                                                    placeholder="">
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
                                                    class="form-control" placeholder="">
                                                {{-- <select name="no_panggil" id="addName" class="form-select">
											<option value="">pilih</option>
											@foreach ($no_panggil as $np)
											<option value="{{$np->no_panggil}}">{{$np->no_panggil}}</option>
											@endforeach
										</select> --}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 mb-3">
                                        <div class="row ">
                                            <div class="col-md-3 d-flex align-items-center">
                                                <label>Judul</label>
                                            </div>
                                            <div class="col-md-9">
                                                {{-- <input id="addName" type="text" class="form-control" placeholder="fill name"> --}}

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-3">
                                        <div class="row ">
                                            <div class="col-md-3 d-flex align-items-center">
                                                <label>Tanggal Peminjaman</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input id="addName" name="tgl_pinjam" type="date"
                                                    class="form-control" placeholder="">
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
        {{-- {{ button datatable }} --}}
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
        {{-- <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.js"></script> --}}
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.js"></script>
        <script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.js"></script>
        <script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
        {{-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script> --}}
        {{-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.jqueryui.js"></script> --}}
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.jqueryui.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.flash.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.js"></script>


        <!--DataTables -->


        <!--DateRangePicker -->
        <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script src="https://cdn.datatables.net/plug-ins/1.11.2/filtering/date-range.js"></script>

        <script>
            $("#excelExport").on("click", function() {
                $(".buttons-excel").trigger("click");
            });
            $("#pdfExport").on("click", function() {
                $(".buttons-pdf").trigger("click");
            });
            $(function() {

                $('input[name="daterange"]').daterangepicker({
                    startDate: moment().subtract(1, 'M'),
                    endDate: moment()
                });

                var table = $('#add-row').DataTable({
                    processing: true,
                    serverSide: true,
                    "pageLength": 5,
                    dom: 'lBfrtip',
                    buttons: [{
                            extend: 'copy',
                            className: 'btn btn-primary glyphicon glyphicon-duplicate d-none'
                        },
                        {
                            extend: 'csv',
                            className: 'btn btn-primary glyphicon glyphicon-save-file d-none'
                        },
                        {
                            extend: 'excel',
                            className: 'btn btn-primary glyphicon glyphicon-list-alt d-none'
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Rekap Data Peminjaman dan Pengembalian Mandiri',
                            // orientation: 'landscape',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 5, 6, 7, 8]
                            },
                            styles: {
                                tableHeader: {
                                    alignment: 'center',
                                }
                            },
                            className: 'btn btn-danger glyphicon glyphicon-file d-none'
                        },
                        {
                            extend: 'print',
                            className: 'btn btn-primary glyphicon glyphicon-print d-none'
                        }
                    ],
                    ajax: {
                        url: "{{ route('lp-mandiri-kepsek') }}",
                        data: function(d) {
                            d.from_date = $('input[name="daterange"]').data('daterangepicker').startDate
                                .format('YYYY-MM-DD');
                            d.to_date = $('input[name="daterange"]').data('daterangepicker').endDate.format(
                                'YYYY-MM-DD');
                        }
                    },
                    columns: [{
                            "data": null,
                            "sortable": false,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'nisn',
                            name: 'nisn'
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'judul',
                            name: 'judul'
                        },
                        {
                            data: 'no_panggil',
                            name: 'no_panggil'
                        },
                        {
                            data: 'tgl_pinjam',
                            name: 'tgl_pinjam'
                        },
                        {
                            data: 'tgl_kembali',
                            name: 'tgl_kembali'
                        },
                        {
                            data: 'tgl_perpanjang',
                            name: 'tgl_perpanjang'
                        },
                        {
                            data: 'denda',
                            name: 'denda'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });

                $(".filter").click(function() {
                    table.draw();
                });

            });
            $(document).ready(function() {


                $('input[name="daterange"]').daterangepicker({
                    startDate: moment().subtract(1, 'M'),
                    endDate: moment()
                });

                //filter data


                $(".filter").click(function() {
                    table.draw();
                });





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



            // Event listener untuk input tanggal
            $("#startDate, #endDate").change(function() {
                var startDate = $("#startDate").val();
                var endDate = $("#endDate").val();

                // Lakukan filter berdasarkan rentang tanggal
                table
                    .columns(0)
                    .search(startDate + " - " + endDate)
                    .draw();
            });
        </script>

    </div>
    <!-- Modal Detail -->
    <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">
                            Detail Data</span>
                        <span class="fw-light">
                        </span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="small">Create a new row using this form, make sure you fill them all</p>
                    <form>
                        <div class="row">
                            <div class="col-sm-12 mb-3">
                                <div class="row ">
                                    <div class="col-md-2 d-flex align-items-center">
                                        <label>Nama</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input id="addName" type="text" class="form-control" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <div class="row ">
                                    <div class="col-md-2 d-flex align-items-center">
                                        <label>Kelas</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input id="addName" type="text" class="form-control" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <div class="row ">
                                    <div class="col-md-2 d-flex align-items-center">
                                        <label>Tgl_Kunjungan</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input id="addName" type="text" class="form-control" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer no-bd">
                    <button type="button" id="addRowButton" class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-hidden="true">
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
                    <p class="small">Create a new row using this form, make sure you fill them all</p>
                    <form>
                        <div class="row">
                            <div class="col-sm-12 mb-3">
                                <div class="row ">
                                    <div class="col-md-2 d-flex align-items-center">
                                        <label>Nama</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input id="addName" type="text" class="form-control" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <div class="row ">
                                    <div class="col-md-2 d-flex align-items-center">
                                        <label>Kelas</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input id="addName" type="text" class="form-control" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <div class="row ">
                                    <div class="col-md-2 d-flex align-items-center">
                                        <label>Tgl_Kunjungan</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input id="addName" type="text" class="form-control" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer no-bd">
                    <button type="button" id="addRowButton" class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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

    function showSweetAlertKembali() {
        swal({
            title: 'KEMBALI',
            text: 'Buku Telah di Kembalikan',
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

    function showSweetAlertPerpanjang() {
        swal({
            title: 'PERPANJANG',
            text: 'Tanggal Berhasil di Perpanjang',
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
