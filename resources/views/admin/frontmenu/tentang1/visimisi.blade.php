@extends('layouts.blackand.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">
           <a href="/about-desa"> Edit Visi & Misi</h1></a>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Visi & Misi</li>
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
                <h3 class="card-title">Form Edit  <small>Visi & Misi</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/about-desa/update_visimisi/{{ $visimisi->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('patch')

                  <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-12">
                          <div class="form-group">
                            <label>Isi Visi</label>
                            <textarea rows="5" class="form-control content @error('visi') is-invalid @enderror" name="visi" placeholder="Masukkan sejarah" >
                              {!! old('visi',$visimisi->visi) !!}  
                            </textarea>
                            @error('visi')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                              
                          </div>
                          <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                              <label>Isi Misi</label>
                              <textarea rows="5" class="form-control content @error('misi') is-invalid @enderror" name="misi" placeholder="Masukkan sejarah" >
                                {!! old('misi',$visimisi->misi) !!}  
                              </textarea>
                              @error('misi')
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
                  </div>
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
