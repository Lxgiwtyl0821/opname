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
                                    <li class="breadcrumb-item active">transaksi_barang</li>
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
                            <h1 class="text-center"> Data Transaksi Barang</h1>
                            <div class="button mb-2" style="float:right;">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                    Tambah Data
                                </button>
                            </div>
                            <table id="table" class="table table-striped table-bordered mt-5">
                                <thead>
                                    <tr>
                                        <th>ID Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Jenis Transaksi</th>
                                        <th>QTY</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transaksi_barang as $d)
                                    <tr>
                                        <td>{{ $d->barang->id }}</td>
                                        <td>{{ $d->barang->nama_barang  }}</td>
                                        <td>Barang {{ $d->jenis}}</td>
                                        <td>{{ $d->qty }}</td>
                                        <td>{{ $d->tanggal_transaksi }}</td>
                                        <td style="text-align:left;">
                                            <a href="{{ route('transaksi_barang.destroy', $d->id) }}" class="btn btn-danger hapus">Hapus</a>
                                            <button class="btn btn-warning edit" data-id="{{ $d->id }}"> Edit </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Data transaksi barang</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('transaksi_barang.add') }}" method="POST"  enctype="multipart/form-data"> 
            @csrf
            <div class="modal-body">
              <div class="form-group">
                <select name="jenis" class="form-control">
                  <option value="" selected disabled>-- Pilih Jenis Transaksi --</option>
                  <option value="Masuk">Barang Masuk</option>
                  <option value="Keluar">Barang Keluar</option>
                </select>
              </div>
              <div class="form-group">
                <select name="id_barang" class="form-control">
                  <option value="" selected>-- Pilih Barang --</option>
                  @foreach($barang as $b)
                    <option value="{{ $b->id }}">{{ $b->id }} - {{ $b->nama_barang }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <input type="number" name="qty" class="form-control" placeholder="Masukan qty transaksi barang" required>
              </div>
              <div class="form-group">
                <input type="date" name="tanggal_transaksi" class="form-control" placeholder="Masukan tanggal transaksi barang" required>
              </div>
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
          </div>
        </div>
      </div>


      <div class="modal fade" id="editData" tabindex="-1" role="dialog" aria-labelledby="editDataLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editDataLabel">Update Data transaksi barang</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('transaksi_barang.update') }}" method="POST"  enctype="multipart/form-data"> 
            @csrf
            <input type="hidden" id="id_mobil" name="id">
            <div class="modal-body">
              <div class="form-group">
                <select name="jenis" id="jenis" class="form-control">
                  <option value="" selected disabled>-- Pilih Jenis Transaksi --</option>
                  <option value="Masuk">Barang Masuk</option>
                  <option value="Keluar">Barang Keluar</option>
                </select>
              </div>
              <div class="form-group">
                <select name="id_satuan" id="id_barang" class="form-control">
                  <option value="" selected>-- Pilih Barang --</option>
                  @foreach($barang as $b)
                    <option value="{{ $b->id }}">{{ $b->id }} - {{ $b->nama_barang }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <input id="qty" type="number" name="qty" class="form-control" placeholder="Masukan qty transaksi barang" required>
              </div>
              <div class="form-group">
                <input type="date" name="tanggal_transaksi" class="form-control" placeholder="Masukan tanggal transaksi barang" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
          </div>
        </div>
      </div>

    
@extends('transaksi_barang.script')                    
@extends('template.footer')