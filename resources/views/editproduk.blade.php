<div class="modal fade" id="editexampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form method="POST" action="{{ route('updateproduk.update', $data->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama Barang" name="name" value="{{ $data->name }}">
          </div>

          <div class="row">
            <div class="col-sm-6">
              <!-- text input -->
              <div class="form-group">
                <label>Harga</label>
                <input type="text" class="form-control" placeholder="Harga" name="harga" value="{{ $data->harga }}">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Kategori</label>
                <select class="form-control" name="kategori_id" value="{{ $data->kategori_id }}">
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
            <textarea class="form-control" rows="3" placeholder="Deskripsi" name="deskripsi" value="{{ $data->deskripsi }}"></textarea>
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
          <button type="submit" class="btn btn-primary">Simpan Data</button>
        </div>
      </form>

      
    </div>
  </div>
</div>
