<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Data Pengunjung</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="../assets/img/icon.ico" type="image/x-icon" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />
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


    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="../assets/css/demo.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    {{-- Font awesome --}}
    <script src="https://kit.fontawesome.com/1266dcde92.js" crossorigin="anonymous"></script>


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
                        <h4 class="page-title">Data Pengunjung</h4>
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
                                <a href="#">Data Pengunjung</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <!-- Date Filter -->
                                        <div style="margin: 20px 0px;">
                                            <strong>Date Filter:</strong>
                                            <input type="text" name="daterange" value="" />
                                            <button class="btn btn-primary filter">Filter</button>
                                        </div>
                                        <button id="excelExport" class="btn btn-success ml-2"><i
                                                class="fa fa-file-excel-o"></i>
                                            Excell</button>
                                        <button id="pdfExport" class="btn btn-danger ml-2"><i
                                                class="fa fa-file-pdf-o"></i>
                                            PDF</button>
                                        <h4 class="card-title"></h4>
                                        {{-- <button class="btn btn-primary btn-round ml-auto"
                                            style="background: #5BC8AC!important;border-color:#5BC8AC !important;"
                                            data-toggle="modal" data-target="#addRowModal">
                                            <i class="fa fa-plus"></i>
                                            Tambah Data
                                        </button> --}}
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="add-row" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Kelas</th>
                                                    <th>Tanggal Kunjungan</th>
                                                    {{-- <th style="width: 10%">Aksi</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>

                                                {{-- <?php $i = 1; ?>
                                                @foreach ($datapengunjung as $row)
                                                    @csrf
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td>{{ $row->user->name }}</td>
                                                        <td>{{ $row->user->kelas }}</td>
                                                        <td>{{ $row->tgl_kunjungan }}</td>

                                                        <td>
                                                            <div class="form-button-action">
                                                                <button type="button" data-toggle="modal"
                                                                    data-target="#edit{{ $row->id }}"
                                                                    data-toggle="tooltip" title="Edit"
                                                                    class="btn btn-link btn-primary btn-lg"
                                                                    data-original-title="Edit">
                                                                    <i class="fa fa-edit"></i>
                                                                </button>
                                                                <a href="#">
                                                                    <button type="button" data-toggle="tooltip"
                                                                        title=""
                                                                        class="btn btn-link btn-danger btn-lg delete"
                                                                        data-original-title="Delete"
                                                                        data-id="{{ $row->id }}"
                                                                        data-nama="{{ $row->nama }}">
                                                                        <i class="fa-solid fa-trash-can"></i>
                                                                    </button>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- Modal Edit -->

                                                    <div class="modal fade" id="edit{{ $row->id }}" tabindex="-1"
                                                        role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header no-bd">
                                                                    <h5 class="modal-title">
                                                                        <span class="fw-mediumbold">
                                                                            Edit Data</span>
                                                                        <span class="fw-light">

                                                                        </span>
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p class="small">Silahkan Mengisi Data Pengunjung
                                                                        Dibawah !</p>
                                                                    <form action="/data-pengunjung/{{ $row->id }}"
                                                                        method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <div class="row">
                                                                            <div class="col-sm-12 mb-3">
                                                                                <div class="row">
                                                                                    <div
                                                                                        class="col-md-3 d-flex align-items-center">
                                                                                        <label>Siswa</label>
                                                                                    </div>
                                                                                    <div class="col-md-9 ">
                                                                                        <select name="nama"
                                                                                            id="addNamess"
                                                                                            class="form-select">
                                                                                            <option value="">
                                                                                                Pilih
                                                                                                Siswa
                                                                                            </option>
                                                                                            @foreach ($data as $d)
                                                                                                <option
                                                                                                    value="{{ $d->id }}">
                                                                                                    {{ $d->name }}
                                                                                                    -
                                                                                                    {{ $d->kelas }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                            <div class="col-sm-12 mb-3">
                                                                                <div class="row ">
                                                                                    <div
                                                                                        class="col-md-3 d-flex align-items-center">
                                                                                        <label>Tanggal Kunjungan</label>
                                                                                    </div>
                                                                                    <div class="col-md-9">
                                                                                        <input id="addName"
                                                                                            value="{{ $row->tgl_kunjungan }}"
                                                                                            name="tgl_kunjungan"
                                                                                            type="date"
                                                                                            class="form-control"
                                                                                            placeholder="">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer no-bd">
                                                                            <button type="submit"
                                                                                onclick="showSweetAlertEdit()"
                                                                                class="btn btn-primary">Edit</button>
                                                                            <button type="button"
                                                                                class="btn btn-danger"
                                                                                data-dismiss="modal">Batal</button>
                                                                        </div>
                                                                    </form>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end Modal Edit -->
                                                @endforeach --}}
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
            <div class="modal fade" id="addRowModal" role="dialog" aria-hidden="true">
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
                            <p class="small">Silahkan Mengisi Data Pengunjung Dibawah !</p>
                            <form action="/data-pengunjung" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="col-sm-12 mb-3">
                                        <div class="row">
                                            <div class="col-md-3 d-flex align-items-center">
                                                <label>Siswa</label>
                                            </div>
                                            <div class="col-md-9 ">
                                                <select name="id_user" id="addNames" class="form-select">
                                                    <option value="">Pilih Siswa
                                                    </option>
                                                    @foreach ($data as $d)
                                                        <option value="{{ $d->id }}">
                                                            {{ $d->name }} - {{ $d->kelas }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="col-sm-12 mb-3">
                                        <div class="row ">
                                            <div class="col-md-3 d-flex align-items-center">
                                                <label>Tanggal Kunjungan</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input id="addName" name="tgl_kunjungan" type="date"
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
        {{-- css button data table --}}

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


        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>


        <!--DataTables -->


        <!--DateRangePicker -->
        <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script src="https://cdn.datatables.net/plug-ins/1.11.2/filtering/date-range.js"></script>

        <!-- SweetAlert library -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#addNamess').select2({
                    placeholder: 'Pilih Siswa',
                    allowClear: true // Mengizinkan pengguna menghapus pilihan
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#addNames').select2({
                    placeholder: 'Pilih Siswa',
                    allowClear: true // Mengizinkan pengguna menghapus pilihan
                });
            });
        </script>
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
                    endDate: moment().add(1, 'days')
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
                            extend: 'pdf',
                            title: 'Data Pengunjung',
                            exportOptions: {
                                    columns: [0, 1, 2, 3 ]
                                },
                                customize: function(doc) {
                                doc.content[1].margin = [ 100, 0, 100, 0 ] //left, top, right, bottom
                                },
                            className: 'btn btn-danger glyphicon glyphicon-file d-none'
                        },
                        {
                            extend: 'print',
                            className: 'btn btn-primary glyphicon glyphicon-print d-none'
                        }
                    ],
                    ajax: {
                        url: "{{ route('data-pengunjung-kepsek') }}",
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
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'kelas',
                            name: 'kelas'
                        },
                        {
                            data: 'tgl_kunjungan',
                            name: 'tgl_kunjungan'
                        },
                        // {
                        //     data: 'action',
                        //     name: 'action',
                        //     orderable: false,
                        //     searchable: false
                        // },
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



    <script>
        $('.delete').click(function() {
            var datapengunjungid = $(this).attr('data-id');
            var judul = $(this).attr('data-nama');

            swal({
                    title: "Yakin?",
                    text: "Kamu akan menghapus data pengunjung dengan nama " + judul + " ",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = "/data-pengunjung/delete/" + datapengunjungid + " "
                        swal("Data berhasil di hapus", {
                            icon: "success",
                        });
                    } else {
                        swal("Data tidak jadi dihapus");
                    }
                });
        });
    </script>
</body>

</html>
<script>
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
