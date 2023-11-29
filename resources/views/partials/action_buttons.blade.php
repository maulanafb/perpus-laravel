<div class="form-button-action">
    <button type="button" data-toggle="modal" data-target="#{{ $editModalId }}" data-toggle="tooltip" title="Edit"
        class="btn btn-link btn-primary btn-lg" data-original-title="Edit">
        <i class="fa fa-edit"></i>
    </button>
    <a href="#" class="delete" data-id="{{ $row->id }}" data-nama="{{ $row->judul }}" data-toggle="tooltip"
        title="Delete">
        <i class="fa-solid fa-trash-can btn-link btn-danger btn-lg"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('.delete').click(function(event) {
            event.preventDefault();

            var databukuid = $(this).data('id');
            var judul = $(this).data('nama');

            Swal.fire({
                title: "Yakin?",
                text: "Kamu akan menghapus data buku dengan judul " + judul + " ",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/data-buku/delete/" + databukuid;
                }
            });
        });
    </script>






    <button type="button" data-toggle="modal" data-target="#{{ $detailModalId }}" data-toggle="tooltip" title="Detail"
        class="btn btn-link btn-success btn-lg" data-original-title="Detail">
        <i class="fa-solid fa-circle-info"></i>
    </button>
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
                                    <label>Foto Buku (kosongkan jika
                                        tidak ingin
                                        mengubah)</label>
                                </div>
                                <div class="col-md-9">
                                    <input id="addName" name="img" type="file" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <div class="row ">
                                <div class="col-md-3 d-flex align-items-center">
                                    <label>Judul</label>
                                </div>
                                <div class="col-md-9">
                                    <input id="addName" value="{{ $row->judul }}" name="judul" type="text"
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
                                    <input id="addName" value="{{ $row->pengarang }}" name="pengarang" type="text"
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
                                    <input id="addName" value="{{ $row->penerbit }}" name="penerbit" type="text"
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
                                    <input id="addName" value="{{ $row->thn_terbit }}" name="thn_terbit"
                                        type="number" class="form-control" placeholder="" required>
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
                                    <input id="addName" value="{{ $row->ISBN }}" name="ISBN" type="text"
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
                                    <input id="addName" value="{{ $row->stok }}" name="stok" type="text"
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
                                    <input id="addName" value="{{ $row->sumber }}" name="sumber" type="text"
                                        class="form-control" placeholder="" required>
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
<!-- end Modal edit-->

<div class="modal-detail">
    <div class="modal fade" id="detail{{ $row->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                        <p class="fw-mediumbold">Detail Buku </p>
                        <span class="fw-light">
                        </span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <div class="detail-heading">
                            <p>Foto Buku</p>
                        </div>
                        <div class="detail-text">
                            <img src="{{ asset('storage/' . $row->img) }}" alt="Foto Buku" width="200">
                        </div>
                    </div>
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
