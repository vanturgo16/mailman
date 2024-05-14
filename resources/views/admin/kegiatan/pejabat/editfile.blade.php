@extends('layouts.blackand.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">
           <a href="/agenda-pejabat"> Form Edit File Agenda</h1></a>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"> Edit File</li>
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
                  <h3 class="card-title">Form Edit Surat Undangan </h3> 
                 
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="/update/surat/{{ $pejabat->id }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  @method('patch')
  
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>File Surat Undangan *format file pdf || max:2 MB</label>
                            <input type="file" name="file_surat"value="{{ old('file_surat') }}" 
                        class="form-control @error('file_surat') is-invalid @enderror" id="exampleInputEmail1" 
                        required>
                        <p></p>
                        Nama Kegiatan:<b> {{ $pejabat->nm_kegiatan }}</b>
                        {{--  <img src="{{ Storage::url('public/staff/'.Auth::user()->file_surat.'') }}" class="img-thumbnail" alt="{{ Auth::user()->name }}"/>  --}}
                        @error('file_surat')
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

    {{--  acara  --}}
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- jquery validation -->
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Form Edit File Rundown Acara</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="/update/acara/{{ $pejabat->id }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  @method('patch')
  
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>File File Rundown Acara *format file pdf || max:2 MB</label>
                            <input type="file" name="file_acara"value="{{ old('file_acara') }}" 
                        class="form-control @error('file_acara') is-invalid @enderror" id="exampleInputEmail1" 
                        required>
                        <p></p>
                        Nama Kegiatan:<b> {{ $pejabat->nm_kegiatan }}</b>
                        {{--  <img src="{{ Storage::url('public/staff/'.Auth::user()->file_acara.'') }}" class="img-thumbnail" alt="{{ Auth::user()->name }}"/>  --}}
                        @error('file_acara')
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
    {{--  acara and  --}}

    {{--  sambutan  --}}
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- jquery validation -->
              <div class="card card-danger">
                <div class="card-header">
                  <h3 class="card-title">Form Edit File Sambutan Untuk Pejabat</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="/update/sambutan/{{ $pejabat->id }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  @method('patch')
  
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>File File Sambutan Untuk Pejabat *format file pdf || max:2 MB</label>
                            <input type="file" name="file_sambutan"value="{{ old('file_sambutan') }}" 
                        class="form-control @error('file_sambutan') is-invalid @enderror" id="exampleInputEmail1" 
                        required>
                        <p></p>
                        Nama Kegiatan:<b> {{ $pejabat->nm_kegiatan }}</b>
                        {{--  <img src="{{ Storage::url('public/staff/'.Auth::user()->file_sambutan.'') }}" class="img-thumbnail" alt="{{ Auth::user()->name }}"/>  --}}
                        @error('file_sambutan')
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
    {{--  sambutan and  --}}

    
@endsection
