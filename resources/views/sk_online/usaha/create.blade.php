@extends('layouts.suratonline.app')

@section('content')



<div class="content-header">
  <div class="container">
    <div class="row mb-2">
      <div class="col-sm-6">
        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-lg">
          Klik di Sini Untuk Mencari Surat Keterangan Usaha Baik Yang Telah Anda Ajukan
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
            <h5 class="card-title m-0">Formulir Surat Keterangan Usaha</h5>
          </div>
          <form action="/surat-online-usaha" method="POST" enctype="multipart/form-data">
            @csrf
          
                              <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Nama </label>
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
                          <label>NIK</label>
                          <input type="number" name="nik"value="{{ old('nik') }}" 
                          class="form-control @error('nik') is-invalid @enderror" id="exampleInputEmail1" 
                          placeholder="Masukan nik " rows="3" required>
                          @error('nik')
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
                              placeholder="Masukan pekerjaan saatini" rows="3" required>
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
                            <label>Alamat</label>
                            <input type="text" name="alamat"value="{{ old('alamat') }}" 
                            class="form-control @error('alamat') is-invalid @enderror" id="exampleInputEmail1" 
                            placeholder="Masukan alamat" required>
                            @error('alamat')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                          </div>
                          <!-- /.form-group -->
                        </div>
                      </div>
                    <!-- /.row -->

<hr>
<h5>Keterangan Lain-lain	:</h5>

<div class="row">
    <div class="col-12 col-sm-6">
      <div class="form-group">
        <label>Jenis Usaha</label>
        <input type="text" name="jns_usaha"value="{{ old('jns_usaha') }}" 
        class="form-control @error('jns_usaha') is-invalid @enderror" id="exampleInputEmail1" 
        placeholder="Masukan jns_usaha" required>
        @error('jns_usaha')
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
        <label>Merek Usaha</label>
        <div class="select2-purple">
            <input type="text" name="merek_usaha"value="{{ old('merek_usaha') }}" 
            class="form-control @error('merek_usaha') is-invalid @enderror" id="exampleInputEmail1" 
            placeholder="Masukan merek_usaha" required>
            @error('merek_usaha')
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

<div class="row">
    <div class="col-12 col-sm-6">
      <div class="form-group">
        <label>Karyawan</label>
        <input type="text" name="kry"value="{{ old('kry') }}" 
        class="form-control @error('kry') is-invalid @enderror" id="exampleInputEmail1" 
        placeholder="Masukan kry saatini" rows="3" required>
        @error('kry')
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
        <label>Modal Usaha</label>
        <div class="select2-purple">
        
          <input type="number" name="modal"value="{{ old('modal') }}" 
          class="form-control @error('modal') is-invalid @enderror" id="exampleInputEmail1" 
          placeholder="Masukan modal saatini" rows="3" required>
          @error('modal')
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

<div class="row">
    <div class="col-12 col-sm-6">
      <div class="form-group">
        <label>Luas Bangunan</label>
        <input type="text" name="luas_bangunan"value="{{ old('luas_bangunan') }}" 
        class="form-control @error('luas_bangunan') is-invalid @enderror" id="exampleInputEmail1" 
        placeholder="Masukan luas_bangunan" required>
        @error('luas_bangunan')
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
        <label>Bangunan Toko</label>
        <div class="select2-purple">
        
          <input type="text" name="bangunan_toko"value="{{ old('bangunan_toko') }}" maxlength="50"
          class="form-control @error('bangunan_toko') is-invalid @enderror" id="exampleInputEmail1" 
          placeholder="Masukan bangunan_toko " rows="3">
          @error('bangunan_toko')
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


<div class="row">
    <div class="col-12 col-sm-6">
      <div class="form-group">
        <label>NO HP</label>
        <input type="number" name="no_hp"value="{{ old('no_hp') }}" 
        class="form-control @error('no_hp') is-invalid @enderror" id="exampleInputEmail1" 
        placeholder="Masukan no_hp" required>
        @error('no_hp')
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
        <label>Pendidikan</label>
        <div class="select2-purple">
          <select class="form-control select2" name="pendidikan" style="width: 100%;">
                           
            @foreach ($pen as $pen)
        
            <option value="{{ $pen->kode  }}">{{ $pen->nama}}</option>
         

        @endforeach
          
          </select>
        </div>
      </div>
      <!-- /.form-group -->
    </div>
    <!-- /.col -->
  </div>
<!-- /.row -->


<div class="row">
    <div class="col-12 col-sm-12">
      <div class="form-group">
        <label>Alamat Usaha</label>
        <input type="text" name="alamat_usaha"value="{{ old('alamat_usaha') }}" 
        class="form-control @error('alamat_usaha') is-invalid @enderror" id="exampleInputEmail1" 
        placeholder="Masukan alamat_usaha" required>
        @error('alamat_usaha')
        <div class="invalid-feedback" style="display: block">
            {{ $message }}
        </div>
        @enderror
      </div>
      <!-- /.form-group -->
    </div>
  </div>
<!-- /.row -->
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
        <h4 class="modal-title">Form Pencarian Ajuan Surat Keterangan Usaha</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/surat-online-usaha/cari" method="GET">
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