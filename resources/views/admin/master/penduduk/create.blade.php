@extends('layouts.blackand.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">
           <a href="/data-jml-penduduk"> Data Jumlah Penduduk</h1></a>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Jumlah Penduduk</li>
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
                <h3 class="card-title">Form  <small>Jumlah Penduduk</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/data-jml-penduduk" method="POST" enctype="multipart/form-data">
                @csrf

                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Jumlah Laki-Laki</label>
                          <input type="number" name="jml_laki"value="{{ old('jml_laki') }}" 
                      class="form-control @error('jml_laki') is-invalid @enderror" id="exampleInputEmail1" 
                      placeholder="Masukan Judul Nama" required>
                      @error('jml_laki')
                      <div class="invalid-feedback" style="display: block">
                          {{ $message }}
                      </div>
                      @enderror
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group">
                          <label>Jumlah Perempuan</label>
                          <input type="number" name="jml_perempuan"value="{{ old('jml_perempuan') }}" 
                      class="form-control @error('jml_perempuan') is-invalid @enderror" id="exampleInputEmail1" 
                      placeholder="Masukan jml_perempuan" >
                      @error('jml_perempuan')
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
                            <label>Tahun</label>
                            <input type="text" name="th"value="{{ old('th') }}" 
                            class="form-control @error('th') is-invalid @enderror"
                            placeholder="Masukan Telpon ">
                            @error('th')
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
                  <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i>Simpan</button>
                  <button type="reset" class="btn btn-danger"><i class="fa fa-undo"></i>Batal</button>
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
