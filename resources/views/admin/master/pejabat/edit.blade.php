@extends('layouts.blackand.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">
           <a href="/data-staff">Form Data Pejabat</h1></a>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Beranda</a></li>
            <li class="breadcrumb-item active">Data Pejabat</li>
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
                <h3 class="card-title">Form Ubah Pejabat</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/pejabat/update/{{ $staff->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('patch')

                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Nama Pejabat</label>
                          <input type="text" name="operator" hidden value="{{ Auth::user()->name }}">
                          <input type="text" name="nm_pejabat"value="{{ old('nm_pejabat',$staff->nm_pejabat) }}"
                      class="form-control @error('nm_pejabat') is-invalid @enderror" id="exampleInputEmail1"
                      placeholder="Masukan Judul Nama" required>
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

                            @foreach ($ag as $ag)
                               @if($staff->id_jabatan == $ag->id)

                               <option value="{{ $ag->id  }}" selected> {{ $ag->nm_jabatan}}</option>
                                @else
                               <option value="{{ $ag->id  }}">{{ $ag->nm_jabatan}}</option>
                               @endif

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
                            <input type="text" name="email"value="{{ old('email',$staff->email) }}"
                            class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1"
                            placeholder="Masukan Telpon ">
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
                            <input type="file" name="image"value="{{ old('image',$staff->image) }}"
                            class="form-control @error('image') is-invalid @enderror" id="exampleInputEmail1"
                            placeholder="Masukan gambar">
                            @error('image',$staff->image)
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                            <p></p>
                            <img src="{{ Storage::url('public/staff/'.$staff->image) }}" style="width: 100px">

                          </div>
                          <!-- /.form-group -->
                        </div>
                        <!-- /.col -->

                        <!-- /.col -->
                      </div>
                    <!-- /.row -->

                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Ubah</button>
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
