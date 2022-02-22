@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tabel Transaksi</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Transaksi</li>
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
                <h3 class="card-title">Transaksi Pending</h3>
                <a href="{{ route('cetak') }}" target="_blank" class="btn btn-primary float-right"> Cetak Laporan <i
                        class="fas fa-print"></i></a>

            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Nama User</th>
                            <th>Total</th>
                            <th>Kode Unik</th>
                            <th>Bank</th>
                            <th>Status</th>
                            <th style="width: 140px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listPending as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ 'Rp.' . number_format($data->total_transfer) }}</td>
                                <td>{{ $data->kode_unik }}</td>
                                <td>{{ $data->bank }}</td>
                                <td>{{ $data->status }}</td>
                                <td>

                                    <a href="{{ route('transaksiBatal', $data->id) }}">
                                        <button type="button" class="btn btn btn-danger btn-xs">Batal</button>
                                    </a>

                                    <a href="{{ route('transaksiConfirm', $data->id) }}">
                                        <button type="button" class="btn btn btn-success btn-xs">Proses</button>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <br>


        <div class="card-header">
            <h3 class="card-title">Transaksi Selesai</h3>
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
                        <th>Bukti Transfer</th>
                        <th>Tanggal Buat</th>
                        <th>Tanggal Selesai</th>
                        <th>Kirim Sebelum</th>
                        <th style="width: 140px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listDone as $data)
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->detail_lokasi }}</td>
                            <td>{{ 'Rp.' . number_format($data->total_transfer) }}</td>
                            <td>{{ $data->jasa_pengiriman }}</td>
                            <td>{{ $data->kode_unik }}</td>
                            <td>{{ $data->bank }}</td>
                            <td>{{ $data->status }}</td>
                            <td><a href={{ "/home/u7082880/public_html/wisnukripik/dist/transfer/".$data->buktiTransfer}} target="_blank">Lihat
                                    Bukti Transfer</a></td>
                            <td>{{ $data->created_at }}</td>
                            <td>{{ $data->updated_at }}</td>
                            <td>{{ $data->expired_at }}</td>
                            <td>


                                @if ($data->status == 'DIKIRIM')
                                    <a href="{{ route('transaksiSelesai', $data->id) }}">
                                        <button type="button" class="btn btn-block btn-primary btn-xs">Selesai</button>
                                    </a>

                                @elseif($data->status == 'DIBAYAR' || $data->status == 'BATAL')
                                    <a href="{{ route('transaksiConfirm', $data->id) }}">
                                        <button type="button" class="btn btn-block btn-info btn-xs">Proses</button>
                                    </a>

                                @elseif($data->status == 'PROSES')
                                    <a href="{{ route('transaksiKirim', $data->id) }}">
                                        <button type="button" class="btn btn-block btn-success btn-xs">Kirim</button>
                                    </a>

                                @elseif($data->status == 'SELESAI' || $data->status == 'BATAL')
                                    <a href="">
                                        <button type="button" class="btn btn-block btn-info btn-xs">Detail</button>
                                    </a>
                                @endif

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
