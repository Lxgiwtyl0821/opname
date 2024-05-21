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
                                    <li class="breadcrumb-item active">user</li>
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
                            <h1 class="text-center"> Data User</h1>
                            <div class="button mb-2" style="float:right;">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                    Tambah Data
                                </button>
                            </div>
                            <table id="table" class="table table-striped table-bordered mt-5">
                                <thead>
                                    <tr>
                                        <th>Nama User</th>
                                        <th>Nama Konversi</th>
                                        <th>Nilai Konversi</th>
                                        <th>Stock</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user as $d)
                                    <tr>
                                        <td>{{ $d->name }}</td>
                                        <td>{{ $d->alamat  }}</td>
                                        <td>{{ $d->email }}</td>
                                        <td>{{ $d->no_telp }}</td>
                                        <td>{{ $d->role }}</td>
                                        <td style="text-align:left;">
                                            <a href="{{ route('user.destroy', $d->id) }}" class="btn btn-danger hapus">Hapus</a>
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
              <h5 class="modal-title" id="exampleModalLabel">Tambah Data user</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('user.add') }}" method="POST"  enctype="multipart/form-data"> 
            @csrf
            <div class="modal-body">
              <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Masukan Nama User" required>
              </div>
              <div class="form-group">
                <input  type="text" name="alamat" class="form-control" placeholder="Masukan Alamat" required>
              </div>
              <div class="form-group">
                <input  type="email" name="email" class="form-control" placeholder="Masukan Email" required>
              </div>
              <div class="form-group">
                <select name="role" class="form-control">
                  <option value="" selected>-- Pilih Role User --</option>
                  <option value="manager" >Manager</option>
                  <option value="warehouse" >Warehouse</option>
                </select>
              </div>
              <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Masukan Password" required>
              </div>
              <div class="form-group">
                <input type="number" name="no_telp" class="form-control" placeholder="Masukan no telp user" required>
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
              <h5 class="modal-title" id="editDataLabel">Update Data user</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('user.update') }}" method="POST"  enctype="multipart/form-data"> 
            @csrf
            <input type="hidden" id="id_mobil" name="id">
            <div class="modal-body">
              <div class="form-group">
                <input id="name" type="text" name="name" class="form-control" placeholder="Masukan Nama User" required>
              </div>
              <div class="form-group">
                <input id="alamat" type="text" name="alamat" class="form-control" placeholder="Masukan Alamat" required>
              </div>
              <div class="form-group">
                <input id="email" type="email" name="email" class="form-control" placeholder="Masukan Email" required>
              </div>
              <div class="form-group">
                <select name="role" id="role" class="form-control">
                  <option value="" selected>-- Pilih Role User --</option>
                  <option value="manager" >Manager</option>
                  <option value="warehouse" >Warehouse</option>
                </select>
              </div>
              <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Isi Form jika ingin mengubah password">
              </div>
              <div class="form-group">
                <input id="no_telp" type="number" name="no_telp" class="form-control" placeholder="Masukan no telp user" required>
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

    
@extends('user.script')                    
@extends('template.footer')