@extends('layouts.blackand.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3 class="m-0">
           <a href="/opd"> Form Organisasi Perangkat Daerah (OPD)</h3></a>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Beranda</a></li>
            <li class="breadcrumb-item active">Form OPD</li>
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
                <h3 class="card-title">Form OPD</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/opd" method="POST" enctype="multipart/form-data">
                @csrf

                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Nama OPD</label>
                          <input type="text" name="operator" hidden value="{{ Auth::user()->name }}">
                          <input type="text" name="nm_opd"value="{{ old('nm_opd') }}"
                      class="form-control @error('nm_opd') is-invalid @enderror" id="exampleInputEmail1"
                      placeholder="Masukan Nama OPD" required>
                      @error('nm_opd')
                      <div class="invalid-feedback" style="display: block">
                          {{ $message }}
                      </div>
                      @enderror
                        </div>
                        <!-- /.form-group -->

                        <!-- /.form-group -->
                      </div>
                    </div>

                          <div class="form-group">
                            <label>Singkatan OPD</label>
                            <input type="text" name="singkatan"value="{{ old('singkatan') }}"
                        class="form-control @error('singkatan') is-invalid @enderror" id="exampleInputEmail1"
                        placeholder="Masukan Singkatan OPD" required>
                        @error('singkatan')
                        <div class="invalid-feedback" style="display: block">
                            {{ $message }}
                        </div>
                        @enderror
                          </div>
                          <div class="form-group">
                            <label>Jenis OPD</label>
                            <select class="form-control select2" name="jenis" style="width: 100%;">

                              @foreach ($jenis as $jenis)
                              <option value="{{ $jenis->id  }}" selected> {{ $jenis->nm_jenis}}</option>
                           @endforeach


                            </select>
                          </div>
                          <!-- /.form-group -->
                        </div>



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
