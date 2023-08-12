<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Data Pengunjung</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="../assets/img/icon.ico" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="../assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../assets/css/fonts.min.css']},
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
                                <h4 class="card-title"></h4>
                                <button class="btn btn-primary btn-round ml-auto"  style="background: #5BC8AC!important;border-color:#5BC8AC !important;" data-toggle="modal" data-target="#addRowModal">
                                    <i class="fa fa-plus"></i>
                                    Tambah Data
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
							<div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>	
											<th>Kelas</th>
											<th>Tanggal Kunjungan</th>
                                            <th style="width: 10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php $i=1;?>
										@foreach ($datapengunjung as $row)
										@csrf
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $row->nama }}</td>
											<td>{{ $row->kelas }}</td>
											<td>{{ $row->tgl_kunjungan }}</td>

                                            <td>
                                                <div class="form-button-action">
                                                    <button type="button" data-toggle="modal" data-target="#edit{{$row->id}}" data-toggle="tooltip" title="Edit" class="btn btn-link btn-primary btn-lg" data-original-title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
													<a href="/data-pengunjung/delete/{{ $row->id }}">
                                                    <button type="button" data-toggle="tooltip" title="" onclick="showSweetAlert()" onclick="btnHapus" class="btn btn-link btn-danger" data-original-title="Hapus">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
													</a>
                                                </div>
                                            </td>
                                        </tr>

											<!-- Modal Edit -->
											<div class="modal fade" id="edit{{$row->id}}" tabindex="-1" role="dialog" aria-hidden="true">
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
															<p class="small">Silahkan Mengisi Data Anggota Dibawah !</p>
															<form action="/data-pengunjung/{{$row->id}}" method="POST" enctype="multipart/form-data">
																@csrf
																<div class="row">
																	<div class="col-sm-12 mb-3">
																		<div class="row ">
																			<div class="col-md-3 d-flex align-items-center">
																				<label>Nama</label>
																			</div>
																			<div class="col-md-9">
																				<input id="addName" value="{{ $row->nama}}" name="nama" type="text" class="form-control" placeholder="">
																			</div>
																		</div>
																	</div>
																	<div class="col-sm-12 mb-3">
																		<div class="row ">
																			<div class="col-md-3 d-flex align-items-center">
																				<label>Kelas</label>
																			</div>
																			<div class="col-md-9">
																				<input id="addName" value="{{ $row->kelas}}" name="kelas" type="text" class="form-control" placeholder="">
																			</div>
																		</div>
																	</div>
																	<div class="col-sm-12 mb-3">
																		<div class="row ">
																			<div class="col-md-3 d-flex align-items-center">
																				<label>Tanggal Kunjungan</label>
																			</div>
																			<div class="col-md-9">
																				<input id="addName" value="{{ $row->tgl_kunjungan}}" name="tgl_kunjungan" type="date" class="form-control" placeholder="">
																			</div>
																		</div>
																	</div>
																</div>
																<div class="modal-footer no-bd">
																	<button type="submit" onclick="showSweetAlertEdit()" class="btn btn-primary">Edit</button>
																	<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
																</div>
															</form>
														</div>
														
													</div>
												</div>
											</div>
										<!-- end Modal Edit -->
	
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
					<p class="small">Silahkan Mengisi Data Pengunjung Dibawah !</p>
					<form action="/data-pengunjung" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="col-sm-12 mb-3">
								<div class="row ">
									<div class="col-md-3 d-flex align-items-center">
										<label>Nama</label>
									</div>
									<div class="col-md-9">
										<input id="addName" name="nama" type="text" class="form-control" placeholder="">
									</div>
								</div>
							</div>
							<div class="col-sm-12 mb-3">
								<div class="row ">
									<div class="col-md-3 d-flex align-items-center">
										<label>Kelas</label>
									</div>
									<div class="col-md-9">
										<input id="addName" name="kelas" type="text" class="form-control" placeholder="">
									</div>
								</div>
							</div>
							<div class="col-sm-12 mb-3">
								<div class="row ">
									<div class="col-md-3 d-flex align-items-center">
										<label>Tanggal Kunjungan</label>
									</div>
									<div class="col-md-9">
										<input id="addName" name="tgl_kunjungan" type="date" class="form-control" placeholder="">
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer no-bd">
							<button type="submit" onclick="showSweetAlertTambah()" class="btn btn-primary">Tambah</button>
							<button type="button"  class="btn btn-danger" data-dismiss="modal">Batal</button>
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
	<script >
		$(document).ready(function() {
			$('#basic-datatables').DataTable({
			});

			$('#multi-filter-select').DataTable( {
				"pageLength": 5,
				initComplete: function () {
					this.api().columns().every( function () {
						var column = this;
						var select = $('<select class="form-control"><option value=""></option></select>')
						.appendTo( $(column.footer()).empty() )
						.on( 'change', function () {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
								);

							column
							.search( val ? '^'+val+'$' : '', true, false )
							.draw();
						} );

						column.data().unique().sort().each( function ( d, j ) {
							select.append( '<option value="'+d+'">'+d+'</option>' )
						} );
					} );
				}
			});

			// Add Row
			$('#add-row').DataTable({
				"pageLength": 5,
			});

			var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

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
