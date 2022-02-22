@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          
        </div><!-- /.col -->
        <div class="col-sm-6">
          
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      

        


        <br>
        

        <div class="card-header">
          <h3 class="card-title">Cetak Laporan Transaksi</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <table class="table table-striped">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Nama User</th>
                <th>Alamat</th>
                <th>Total + Ongkir</th>
                <th>Kurir</th>
                <th>Kode Unik</th>
                <th>Bank</th>
                <th>Status</th>
                {{-- <th>Bukti Transfer</th> --}}
                <th>Tanggal Buat</th>
                <th>Tanggal Selesai</th>
                <th>Kirim Sebelum</th>
                
              </tr>
            </thead>
            <tbody>
            @foreach($listDone as $data)
              <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->detail_lokasi }}</td>
                <td>{{"Rp.".number_format($data->total_transfer)}}</td>
                <td>{{ $data->jasa_pengiriman }}</td>
                <td>{{ $data->kode_unik }}</td>
                <td>{{ $data->bank }}</td>
                <td>{{ $data->status }}</td>
                {{-- <td><a href="{{ asset('storage/transfer/'.$data->buktiTransfer) }}" target="_blank">Lihat Bukti Transfer</a></td> --}}
                <td>{{ $data->created_at }}</td>
                <td>{{ $data->updated_at }}</td>
                <td>{{ $data->expired_at }}</td>
                <td>


                    
                    
               </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
      
     
      

    </div><!-- /.container-fluid -->
    
  </section>
  
  <!-- /.content -->
@endsection
