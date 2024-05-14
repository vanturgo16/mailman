
@extends('layouts.blackand.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1> Kategori Ajuan</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active"> Kategori Ajuan</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- jquery validation -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Form <small> Kategori Ajuan</small></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="/kategori/update/{{ $kategori->id }}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Kategori Ajuan</label>
                     <input type="text" hidden name="email" value="{{ Auth::user()->email }}">
                      <input type="text" name="keterangan"value="{{ old('keterangan',$kategori->keterangan) }}" 
                      class="form-control @error('keterangan') is-invalid @enderror" id="exampleInputEmail1" 
                      placeholder="Masukan Nama Kategori Ajuan">
                      @error('keterangan')
                      <div class="invalid-feedback" style="display: block">
                          {{ $message }}
                      </div>
                      @enderror
                    </div>

                    <div class="form-group">
                        <label>STATUS</label>
                        <select class="form-control select2" style="width: 100%;" name="status">
                          
                          <option value="1">AKTIF</option>
                          <option value="2">NON AKTIF</option>
                         
                          
                        </select>
                      </div>
                    
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i>Submit</button>
                    <button type="reset" class="btn btn-danger"><i class="fa fa-undo"></i>Reset</button>
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