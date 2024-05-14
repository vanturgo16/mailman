@extends('layouts.suratonline.app')

@section('content')



<div class="content-header">
  <div class="container">
    <div class="row mb-2">
      <div class="col-sm-6">
        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-lg">
          Klik di Sini Untuk Mencari SK Berkelakuan Baik Yang Telah Anda Ajukan
        </button>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Pengajuan Surat Online</a></li>
          
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<div class="content">
  <div class="container">
    <div class="row">
  
      <!-- /.col-md-6 -->
      <div class="col-lg-12">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h5 class="card-title m-0">Formulir Surat Keterangan Berkelakuan Baik</h5>
          </div>
          <form action="/surat-online-skck" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Nama Lengkap</label>
                      <input type="text" name="nama"value="{{ old('nama') }}" maxlength="50"
                  class="form-control @error('nama') is-invalid @enderror" id="exampleInputEmail1" 
                  placeholder="Masukan Nama Lengkap" required>
                  @error('nama')
                  <div class="invalid-feedback" style="display: block">
                      {{ $message }}
                  </div>
                  @enderror
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                      <label>Jenis Kelamin</label>
                      <select class="form-control select2" name="jk" style="width: 100%;">
                       
                        @foreach ($jenis as $jenis)
    
                        <option value="{{ $jenis->kode  }}">{{ $jenis->nama}}</option>
                      

                    @endforeach
                      
                      </select>
                    </div>
                    <!-- /.form-group -->
                  </div>
                  <!-- /.col -->


                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Tempat Lahir</label>
                      <input type="text" name="tempat"value="{{ old('tempat') }}" 
                      class="form-control @error('tempat') is-invalid @enderror" id="exampleInputEmail1" 
                      placeholder="Masukan tempat lahir" required>
                      @error('tempat')
                      <div class="invalid-feedback" style="display: block">
                          {{ $message }}
                      </div>
                      @enderror
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                      <label>Tanggal Lahir</label>
                      <input type="date" name="tgl"value="{{ old('tgl') }}" 
                      class="form-control @error('tgl') is-invalid @enderror" id="exampleInputEmail1" 
                      placeholder="Masukan tgl lahir" required>
                      @error('tgl')
                      <div class="invalid-feedback" style="display: block">
                          {{ $message }}
                      </div>
                      @enderror
                    </div>
                    <!-- /.form-group -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
    
               
                <div class="row">
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label>Agama</label>
                      <select class="form-control select2 select2-danger" name="agama" data-dropdown-css-class="select2-danger" style="width: 100%;">
                        
                         @foreach ($agama as $agama)
                         
                            <option value="{{ $agama->kode  }}">{{ $agama->nama}}</option>
                            

                        @endforeach
                       
                      </select>
                    </div>
                    <!-- /.form-group -->
                  </div>
                  <!-- /.col -->
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label>NIK</label>
                      <div class="select2-purple">
                        <input type="number" name="nik"value="{{ old('nik') }}" 
                          class="form-control @error('nik') is-invalid @enderror" id="exampleInputEmail1" 
                          placeholder="Masukan nik saatini" rows="3">
                          @error('nik')
                          <div class="invalid-feedback" style="display: block">
                              {{ $message }}
                          </div>
                          @enderror
                      </div>
                    </div>
                    <!-- /.form-group -->
                  </div>
                  <!-- /.col -->
                </div>

                <div class="row">
                    <div class="col-12 col-sm-6">
                      <div class="form-group">
                        <label>Status</label>
                        <input type="text" name="status_kawin"value="{{ old('status_kawin') }}" 
                        class="form-control @error('status_kawin') is-invalid @enderror" id="exampleInputEmail1" 
                        placeholder="Masukan status_kawin saatini" rows="3">
                        @error('status_kawin')
                        <div class="invalid-feedback" style="display: block">
                            {{ $message }}
                        </div>
                        @enderror
                      </div>
                      <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6">
                      <div class="form-group">
                        <label>Pekerjaan</label>
                        <div class="select2-purple">
                          <input type="text" name="pekerjaan"value="{{ old('pekerjaan') }}" 
                            class="form-control @error('pekerjaan') is-invalid @enderror" id="exampleInputEmail1" 
                            placeholder="Masukan pekerjaan saatini" rows="3">
                            @error('pekerjaan')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                      </div>
                      <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                  </div>


                <div class="row">
                    <div class="col-12 col-sm-12">
                      <div class="form-group">
                        <label>Suku / Kewarganegaraan</label>
                        <input type="text" name="negara"value="Indonesia" 
                        class="form-control @error('negara') is-invalid @enderror" id="exampleInputEmail1" 
                        placeholder="Masukan negara" required>
                        @error('negara')
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
                        <label>Alamat</label>
                        <div class="select2-purple">
                        
                          <input type="text" name="alamat"value="{{ old('alamat') }}" 
                          class="form-control @error('alamat') is-invalid @enderror" id="exampleInputEmail1" 
                          placeholder="Masukan alamat saatini" rows="3">
                          @error('alamat')
                          <div class="invalid-feedback" style="display: block">
                              {{ $message }}
                          </div>
                          @enderror
                        </div>
                      </div>
                      <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                  </div>
                <!-- /.row -->
              </div>

            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i>Kirim Data</button>
              <button type="reset" class="btn btn-danger"><i class="fa fa-undo"></i>Batal</button>
            </div>
         

        </form> 
        </div>
      </div>
      <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<div class="modal fade" id="modal-lg">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Form Pencarian Ajuan Surat Keterangan Berkelakuan Baik</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/surat-online-skck/cari" method="GET">
          {{--  @csrf  --}}
          <div class="input-group input-group-lg">
            <input type="text" class="form-control @error('cari') is-invalid @enderror" maxlength="50"
             name="cari"  placeholder="Cari Berdasarkan Nama "value="{{ old('cari') }}">
         
            <div class="input-group-append">
              <button type="submit" class="btn  btn-primary" >Cari Data</button>
            
            </div>
        </div>
    </form>
    @error('cari')
    <div class="invalid-feedback" style="display: block">
        {{ $message }}
    </div>
    @enderror
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection