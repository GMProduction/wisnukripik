@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tabel Produk</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Produk</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="card-header">
                <h3 class="card-title">Produk Table</h3>
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal"><i
                        class="fas fa-plus"></i> Tambah Produk </button>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Terahir Update</th>
                            <th style="width: 40px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listUser as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ 'Rp.' . number_format($data->harga) }}</td>
                                <td>{{ $data->updated_at }}</td>
                                <td>
                                    <a href="#">
                                        <i class="fa fa-edit blue" data-mdata="{{ $data }}" data-toggle="modal"
                                            data-target="#edit"></i>
                                    </a>
                                    /
                                    <a href="#">
                                        <i class="fa fa-trash red" data-id="{{ $data->id }}" data-toggle="modal"
                                            data-target="#delete"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Tambah Produk --}}

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form method="POST" action="{{ route('produk.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama Barang"
                                    name="name">
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Harga</label>
                                        <input type="text" class="form-control" placeholder="Harga" name="harga">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Kategori</label>
                                        <select class="form-control" name="kategori_id">
                                            <option value="1">option 1</option>
                                            <option value="1">option 2</option>
                                            <option value="1">option 3</option>
                                            <option value="1">option 4</option>
                                            <option value="1">option 5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea class="form-control" rows="3" placeholder="Deskripsi"
                                    name="deskripsi"></textarea>
                            </div>



                            <div class="form-group">
                                <label for="exampleInputFile">File Gambar</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>


        {{-- Edit Produk --}}

        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Produk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" class="form-control" id="edt_name" placeholder="Nama Barang"
                                    name="name">
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Harga</label>
                                        <input type="text" class="form-control" id="edt_harga" placeholder="Harga"
                                            name="harga">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Kategori</label>
                                        <select class="form-control" name="kategori_id">
                                            <option value="1">option 1</option>
                                            <option value="1">option 2</option>
                                            <option value="1">option 3</option>
                                            <option value="1">option 4</option>
                                            <option value="1">option 5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea class="form-control" id="edt_desc" rows="3" placeholder="Deskripsi"
                                    name="deskripsi"></textarea>
                            </div>



                            <div class="form-group">
                                <label for="exampleInputFile">File Gambar</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="button" id="btn_simpan" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>



        {{-- delete --}}

        <div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="addNewLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="addNewLabel">Tambah Produk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                    </div>

                    <form method="POST" action="#">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="iddata" value="">

                            <p class="text-center"> Apa Anda Yakin Ingin Menghapus Produk ini ? </p>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                            <button type="button" id="btn_delete" class="btn btn-primary">Ya, Hapus Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('js')
    <script>
        $('#delete').on('show.bs.modal', function(event) {
            var data = $(event.relatedTarget)
            var iddata = data.data('id')

            var modal = $(this)
            modal.find('.modal-body #iddata').val(iddata)

            $('#btn_delete').click(function(e) {
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '{{ route('deleteProduct') }}',
                    data: {
                        'id': iddata
                    },
                    success: function(data) {
                        console.log(data)
                        location.reload();
                    }
                })
            })
        })

        $('#edit').on('show.bs.modal', function(event) {
            var data = $(event.relatedTarget)
            var iddata = data.data('id')
            let mData = data.data('mdata')

            let edtName = document.getElementById("edt_name")
            let edtHarga = document.getElementById("edt_harga")
            let edtDesc = document.getElementById("edt_desc")

            var modal = $(this)
            $('#edt_name').val(mData.name)
            $('#edt_harga').val(mData.harga)
            $('#edt_desc').val(mData.deskripsi)
            modal.find('.modal-body #iddata').val(iddata)

            $('#btn_simpan').click(function(e) {
                // alert("Name:" +mData.name)

                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '{{ route('updateProduct') }}',
                    data: {
                        'id': mData.id,
                        'name': edtName.value,
                        'harga': edtHarga.value,
                        'deskripsi': edtDesc.value
                    },
                    success: function(data) {
                        console.log(data)
                        location.reload();
                    }
                })
            })
        })
    </script>
@endsection
