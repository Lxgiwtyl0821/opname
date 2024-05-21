@include('template.header')
@include('template.navbar')
    <div class="content-wrap">
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Hello, <span>Welcome Here</span></h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active">reporting</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <section id="main-content">
                    <div class="row">
                        <div class="container">
                            <span id="dt-title">
                              <h1 class="text-center"> Report Data Barang</h1>
                              <h5 class="text-center" id="periode"> Periode : {{ $periode }}</h5>
                            </span>
                            <table id="table" class="table display" width="100%;">
                                <thead>
                                    <tr>
                                        <th>ID Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Nama Konversi</th>
                                        <th>Nama Satuan</th>
                                        <th>Jenis Transaksi</th>
                                        <th>Tanggal Transaksi</th>
                                        {{-- <th>QTY</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data2 as $d)
                                    <tr>
                                        <td>{{ $d->barang_id }}</td>
                                        <td>{{ $d->nama_barang  }}</td>
                                        <td>{{ $d->nama_konversi }}</td>
                                        <td>{{ $d->name_satuan . " / 1 " . $d->name_satuan}}</td>
                                        <td>{{ $d->jenis}}</td>
                                        <td>{{ $d->tanggal_transaksi }}</td>
                                    </tr>
                                    @endforeach
                                    @foreach($data as $d1)  
                                    <tr>
                                      <td>Jumlah Barang {{ $d1->jenis}}</td>
                                      <td> : {{ $d1->jumlah }}  </td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="container">
                      <div class="form-group">
                        <a href="https://wa.me/{{$no_manager}}" class="btn btn-success">Send To Manager</a>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="footer">
                                <p class="text-center">2023 ©STOCK OPNAME (OPNAME)</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>


    
@extends('report.script')                    
@extends('template.footer')