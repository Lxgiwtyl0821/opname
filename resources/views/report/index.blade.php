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
                                    <li class="breadcrumb-item active">Reporting Barang</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <section id="main-content">
                        <div class="row">
                        <form action="{{ route('report.filter') }}" method="post">\
                          @csrf
                          <div class="container">
                            <h1 class="text-center"> Reporting Barang</h1>
                            <div class="container" style="margin-top:50px;">
                              <label for="">Barang : </label>
                              <select name="id_barang" id="" class="form-control">
                                @foreach($barang as $b)
                                <option value="{{ $b->id }}"> {{ $b->nama_barang }} </option>
                                @endforeach
                              </select>
                            </div>
                        </div>
                        <div class="container">
                            <div class="container" style="margin-top:20px;">
                              <label for="">Filter By : </label>
                              <select name="filter" id="" class="form-control" required>
                                <option value="all">Report Barang</option>
                                <option value="barang_masuk">Report Transaksi Barang Masuk</option>
                                <option value="barang_keluar">Report Transaksi Barang Keluar</option>
                              </select>
                            </div>
                        </div>
                        <div class="container">
                          <div class="container" style="margin-top:20px;">
                            <label for="">From:</label>
                            <input type="date" class="form-control" name="from" required>
                          </div>
                        </div>
                        <div class="container">
                          <div class="container" style="margin-top:20px;">
                            <label for="">To :</label>
                            <input type="date" class="form-control" name="to" required>
                          </div>
                        </div>
                        <div class="container mt-4" >
                          <div class="container">
                            <button class="btn btn-primary">Filter</button>
                          </div>
                        </div>
                    </div>
                  </form>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="footer" style="margin-top:400px;">
                                <p class="text-center">2023 ©STOCK OPNAME (OPNAME)</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    
@extends('barang.script')                    
@extends('template.footer')