@extends('layouts.blackand.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">
           <a href="/profil"> Profil User</h1></a>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Profil User</li>
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
                <h3 class="card-title">Form Edit <small>Profil User</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/profil/update" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('patch')

                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Nama</label>
                          <input type="text" name="name"value="{{ old('name',$profil->name) }}" 
                      class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1" 
                      placeholder="Masukan Nama Desa" required>
                      @error('name')
                      <div class="invalid-feedback" style="display: block">
                          {{ $message }}
                      </div>
                      @enderror
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group">
                          <label>Email</label>
                          <input type="email" name="email"value="{{ old('email',$profil->email) }}" 
                      class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" 
                      placeholder="Masukan Telpon " required>
                      @error('email')
                      <div class="invalid-feedback" style="display: block">
                          {{ $message }}
                      </div>
                      @enderror
                        </div>
                        <!-- /.form-group -->
                      </div>
                      <!-- /.col -->


                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" value="{{ old('password') }}"
                          placeholder="Masukkan Password"
                          class="form-control @error('password') is-invalid @enderror">
                        
                        </div>
                        <!-- /.form-group -->
                        
                        <!-- /.form-group -->
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
        

            
                  </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i>Update</button>
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

    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- jquery validation -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Form Edit <small>Foto Profil User</small></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="/foto-profil/update" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  @method('patch')
  
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Foto</label>
                            <input type="file" name="profile_photo_path"value="{{ old('profile_photo_path') }}" 
                        class="form-control @error('profile_photo_path') is-invalid @enderror" id="exampleInputEmail1" 
                        placeholder="Masukan Nama Desa">
                        <p></p>
                        <img src="{{ Storage::url('public/staff/'.Auth::user()->profile_photo_path.'') }}" class="img-thumbnail" alt="{{ Auth::user()->name }}"/>
                        @error('profile_photo_path')
                        <div class="invalid-feedback" style="display: block">
                            {{ $message }}
                        </div>
                        @enderror
                          </div>                        
                        </div>                      
                      </div>
                    </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i>Update</button>
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
