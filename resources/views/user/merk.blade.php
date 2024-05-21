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
                                    <li class="breadcrumb-item active">mobil</li>
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
                            <h1 class="text-center"> Data Mobil</h1>
                            <div class="button mb-2" style="float:right;">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                    Tambah Data
                                </button>
                            </div>
                            <table id="table" class="table table-striped table-bordered mt-5">
                                <thead>
                                    <tr>
                                        <th>Merk</th>
                                        <th>Model</th>
                                        <th>Foto</th>
                                        <th>Plat Nomor</th>
                                        <th>Tahun</th>
                                        <th>BBM</th>
                                        <th>Transmisi</th>
                                        <th>Harga Sewa</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($barang as $d)
                                    <tr>
                                        <td>{{ $d->merk }}</td>
                                        <td><img src="{{ url('file/barang') . "/" . $d->foto }}" style="width: 200px; height:200px;" alt=""></td>
                                        <td>{{ $d->model }}</td>
                                        <td>{{ $d->plat_no }}</td>
                                        <td>{{ $d->tahun }}</td>
                                        <td>{{ $d->bbm }}</td>
                                        <td>{{ $d->transmisi }}</td>
                                        <td>{{ "Rp." . $d->harga_sewa }}</td>
                                        <td>
                                            @if($d->status == 0)
                                            <button class="btn btn-success">Ready</button>
                                            @else
                                            <button class="btn btn-danger">Danger</button>
                                            @endif
                                        </td>
                                        <td style="text-align:left;">
                                            <a href="{{ route('barang.destroy', $d->id) }}" class="btn btn-danger hapus">Hapus</a>
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
              <h5 class="modal-title" id="exampleModalLabel">Tambah Data mobil</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('barang.add') }}" method="POST"  enctype="multipart/form-data"> 
            @csrf
            <div class="modal-body">
              <div class="form-group">
                <input type="text" name="merk" class="form-control" placeholder="Masukan Merk mobil" required>
              </div>
              <div class="form-group">
                <input type="text" name="model" class="form-control" placeholder="Masukan Model mobil" required>
              </div>
              <div class="form-group">
                <input type="text" name="plat_no" class="form-control" placeholder="Masukan Plat Nomor" required>
              </div>
              <div class="form-group">
                <input type="file" name="foto" class="form-control" placeholder="Masukan Foto" required>
              </div>
              <div class="form-group">
                <input type="number" name="tahun" class="form-control" placeholder="Masukan Tahun mobil" required>
              </div>
              <div class="form-group">
                <input type="number" name="harga_sewa" class="form-control" placeholder="Masukan Harga Sewa mobil" required>
              </div>
              <div class="form-group">
                <select  name="bbm" class="form-control" required>
                    <option value="" disabled selected>-- PILIH BAHAN BAKAR --</option>                    
                    <option value="bensin">Bensin</option>
                    <option value="Listrik">Listrik</option>
                </select>
              </div>
              <div class="form-group">
                <select  name="transmisi" class="form-control" required>
                    <option value="" disabled selected>-- PILIH JENIS TRANSMISI --</option>                    
                    <option value="matic">Matic</option>
                    <option value="manual">Manual</option>
                </select>
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
              <h5 class="modal-title" id="editDataLabel">Update Data mobil</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('barang.update') }}" method="POST"  enctype="multipart/form-data"> 
            @csrf
            <input type="hidden" id="id_mobil" name="id">
            <div class="modal-body">
              <div class="form-group">
                <input type="text" name="merk" id="merk" class="form-control" placeholder="Masukan Merk mobil" required>
              </div>
              <div class="form-group">
                <input type="text" name="model"  id="model" class="form-control" placeholder="Masukan Model mobil" required>
              </div>
              <div class="form-group">
                <input type="text" name="plat_no"  id="plat_no" class="form-control" placeholder="Masukan Plat Nomor" required>
              </div>
              <div class="form-group">
                <input type="file" name="foto"  class="form-control" placeholder="Masukan Foto">
              </div>
              <div class="form-group">
                <input type="number" name="tahun" id="tahun" class="form-control" placeholder="Masukan Tahun mobil" required>
              </div>
              <div class="form-group">
                <input type="number" name="harga_sewa"  id="harga_sewa" class="form-control" placeholder="Masukan Harga Sewa mobil" required>
              </div>
              <div class="form-group">
                <select  name="bbm" class="form-control" id="bbm" required>
                    <option value="" disabled selected>-- PILIH BAHAN BAKAR --</option>                    
                    <option value="bensin">Bensin</option>
                    <option value="Listrik">Listrik</option>
                </select>
              </div>
              <div class="form-group">
                <select  name="transmisi" id="transmisi" class="form-control" required>
                    <option value="" disabled selected>-- PILIH JENIS TRANSMISI --</option>                    
                    <option value="matic">Matic</option>
                    <option value="manual">Manual</option>
                </select>
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

    
@extends('barang.script')                    
@extends('template.footer')