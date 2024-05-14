@extends('layouts.blackand.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">
           <a href="/pejabat"> Form Data Pejabat</h1></a>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Beranda</a></li>
            <li class="breadcrumb-item active">Form Data Pejabat</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Pejabat</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/pejabat" method="POST" enctype="multipart/form-data">
                @csrf

                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Nama</label>
                          <input type="text" name="operator" hidden value="{{ Auth::user()->name }}">
                          <input type="text" name="nm_pejabat"value="{{ old('nm_pejabat') }}"
                      class="form-control @error('nm_pejabat') is-invalid @enderror" id="exampleInputEmail1"
                      placeholder="Masukan Nama" required>
                      @error('nm_pejabat')
                      <div class="invalid-feedback" style="display: block">
                          {{ $message }}
                      </div>
                      @enderror
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group">
                          <label>Jabatan</label>
                          <select class="form-control select2 select2-danger" name="id_jabatan" data-dropdown-css-class="select2-danger" style="width: 100%;">

                            @foreach ($jabatan as $jabatan)
                               <option value="{{ $jabatan->id  }}" selected> {{ $jabatan->nm_jabatan}}</option>
                           @endforeach

                         </select>
                        </div>
                        <!-- /.form-group -->
                      </div>
                      <!-- /.col -->



                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-12 col-sm-12">
                          <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email"value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1"
                            placeholder="Masukan Email">
                            @error('email')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                          </div>
                          <!-- /.form-group -->
                        </div>
                        <!-- /.col -->

                        <!-- /.col -->
                      </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-12 col-sm-12">
                          <div class="form-group">
                            <label>Gambar *format file jpeg,jpg,png</label>
                            <input type="file" name="image"value="{{ old('image') }}"
                            class="form-control @error('image') is-invalid @enderror" id="exampleInputEmail1"
                            placeholder="Masukan Telpon " required>
                            @error('image')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                          </div>
                          <!-- /.form-group -->
                        </div>
                        <!-- /.col -->

                        <!-- /.col -->
                      </div>
                    <!-- /.row -->

                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                  <button type="reset" class="btn btn-danger"><i class="fa fa-undo"></i> Batal</button>
                </div>


            </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


@endsection
