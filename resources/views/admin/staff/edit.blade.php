@extends('layouts.blackand.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">
           <a href="/data-staff"> Data Staff</h1></a>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Staff</li>
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
                <h3 class="card-title">Form  <small>Staff</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/data-staff/update/{{ $staff->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('patch')

                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Nama</label>
                          <input type="text" name="operator" hidden value="{{ Auth::user()->name }}">
                          <input type="text" name="name"value="{{ old('name',$staff->name) }}" 
                      class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1" 
                      placeholder="Masukan Judul Nama" required>
                      @error('name')
                      <div class="invalid-feedback" style="display: block">
                          {{ $message }}
                      </div>
                      @enderror
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group">
                          <label>NIP</label>
                          <input type="text" name="nip"value="{{ old('nip',$staff->nip) }}" 
                      class="form-control @error('nip') is-invalid @enderror" id="exampleInputEmail1" 
                      placeholder="Masukan NIP" >
                      @error('nip')
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
                            <label>Gambar *format file jpeg,jpg,png || max:2000</label>
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
