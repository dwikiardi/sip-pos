@extends('templates.master')

@section('pwd', 'Laporan')

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div class="row printableArea">
    <div class="col-md-12" style="text-align: center">
        <h2><strong>Koperasi SD N 3 Saba</strong></h2>
        <h3>
            <b>Laporan Data Transaksi</b>
        </h3>
        <div class="pull-left py-5">
            <address>
                <p class="m-t-30">
                    <img src="{{asset('assets/images/logo.png')}}" height="100">
                </p>
                <p class="m-t-30">
                    <b>Dicetak oleh :</b>
                    <i class="fa fa-user"></i> {{username()}}
                </p>
                <p class="m-t-30">
                    <b>Tanggal Laporan :</b>
                    <i class="fa fa-calendar"></i> {{date('d-m-Y')}}
                </p>
            </address>
        </div>
    </div>
    <div class="col-md-12 mt-4">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered text-nowrap border-bottom dataTable no-footer" role="grid" id="tableData">
                    <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Staff</th>
                        <th>Tanggal Transaksi</th>
                        <th>Detail Transaksi</th>
                        <th>Total Transaksi</th>
                    </tr>
                    @foreach ($data as $data)
                        <tr>
                            <td class="align-middle">{{$loop->iteration}}</td>
                            <td class="align-middle">{{$data->transaction_code}}</td>
                            <td class="align-middle">{{$data->user->username}}</td>
                            <td class="align-middle">{{$data->sale_date}}</td>
                            <td>
                                <table class="table no-borderless">
                                    <tr>
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                    </tr>
                                    @foreach ($data->detail as $detail)
                                    <tr>
                                        <td>{{$detail->product->name}}</td>
                                        <td>{{convertToRupiah($detail->product->price)}}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </td>
                            <td class="align-middle">{{convertToRupiah($data->total)}}</td>
                        </tr>
                        @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

