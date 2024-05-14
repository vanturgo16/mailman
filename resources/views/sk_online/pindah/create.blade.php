@extends('layouts.suratonline.app')

@section('content')

<div class="content-header">
  <div class="container">
    <div class="row mb-2">
      <div class="col-sm-6">
        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-lg">
          Klik di Sini Untuk Mencari Surat Keterangan Pindah Yang Telah Anda Ajukan
        </button>
        @error('cari')
        <div class="invalid-feedback" style="display: block">
            {{ $message }}
        </div>
        @enderror
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
            <h5 class="card-title m-0">Formulir Surat Keterangan Domisili 
                <br>
            </h5>
          </div>
          {{--  <form action="/surat-online-pindah" method="POST" enctype="multipart/form-data">
            @csrf  --}}
            <!-- Main content -->
            <section class="content">
              <div class="container-fluid">
                <div class="row">
                  <!-- left column -->
                  <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        
                      <div class="card-header">
                        <h3 class="card-title">DATA DAERAH ASAL</h3>
                      </div>
                      <!-- /.card-header -->
                      <!-- form start -->
                      <form action="/surat-online-pindah" method="POST" enctype="multipart/form-data">
                        @csrf
                       
            
                        <div class="card-body">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Nomer Kartu Keluarga</label>
                            <input type="number"class="form-control" name="kk"value="{{ old('kk') }}"
                             id="exampleInputEmail1" placeholder="Nomer Kartu Keluarga">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Nama Kepala Keluarga</label>
                            <input type="text" class="form-control @error('nm_kk') is-invalid @enderror"
                             name="nm_kk" value="{{ old('nm_kk') }}" id="exampleInputPassword1"
                              placeholder="Nama Kepala Keluarga" required>
                             @error('nm_kk')
                             <div class="invalid-feedback" style="display: block">
                                 {{ $message }}
                             </div>
                             @enderror
                            </div>
                          <label for="exampleInputFile">Alamat</label>
                
                          <div class="row">
                            <div class="col-3">
                              <input type="number" name="rt_asal" value="{{ old('rt_asal') }}" 
                              required class="form-control @error('rt_asal') is-invalid @enderror" placeholder="RT">
                              @error('rt_asal')
                              <div class="invalid-feedback" style="display: block">
                                  {{ $message }}
                              </div>
                              @enderror
                            </div>
                            <div class="col-3">
                              <input type="number" name="rw_asal"value="{{ old('rw_asal') }}"
                               class="form-control @error('rw_asal') is-invalid @enderror" required  placeholder="RW">
                               @error('rw_asal')
                               <div class="invalid-feedback" style="display: block">
                                   {{ $message }}
                               </div>
                               @enderror
                              </div>
                          </div>
            <P></P>
                          <div class="row">
                            <div class="col-6">
                              <input type="text" required name="desa_asal" value="{{ old('desa_asal') }}"
                              class="form-control @error('desa_asal') is-invalid @enderror" placeholder="Kelurahan">
                              @error('desa_asal')
                              <div class="invalid-feedback" style="display: block">
                                  {{ $message }}
                              </div>
                              @enderror
                            </div>
                            <div class="col-6">
                              <input type="text" required name="kec_asal" value="{{ old('kec_asal') }}"
                               class="form-control @error('kec_asal') is-invalid @enderror" placeholder="Kecamatan">
                              @error('kec_asal')
                              <div class="invalid-feedback" style="display: block">
                                  {{ $message }}
                              </div>
                              @enderror
                            </div>
                          </div>
                          <P></P>
            
                          <div class="row">
                            <div class="col-6">
                              <input type="text" name="kab_kota_asal" value="{{ old('kab_kota_asal') }}"
                              class="form-control @error('kab_kota_asal') is-invalid @enderror"
                               placeholder="Kab/Kota" required>
                              @error('kab_kota_asal')
                              <div class="invalid-feedback" style="display: block">
                                  {{ $message }}
                              </div>
                              @enderror
                            </div>
                            <div class="col-6">
                              <input type="text" name="provinsi_asal"  value="{{ old('provinsi_asal') }}"
                              class="form-control @error('provinsi_asal') is-invalid @enderror"
                               placeholder="Provinsi" required>
                              @error('provinsi_asal')
                              <div class="invalid-feedback" style="display: block">
                                  {{ $message }}
                              </div>
                              @enderror
                            </div>
                          </div>
                          <br>
                          <br>
                          
                        </div>
                        <!-- /.card-body -->
            <!-- /.card-body -->
           
         
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
          
          
        </div>
        <!-- /.card -->

      


      </div>
      <!--/.col (left) -->
      <!-- right column -->
      <div class="col-md-6">
        <!-- Form Element sizes -->
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">DATA KEPINDAHAN</h3>
          </div>
          <div class="card-body">
           
              <div class="form-group">
                <label for="exampleInputEmail1">Alasan Kepindahan</label>
                <input type="text" class="form-control @error('alasan_pindaj') is-invalid @enderror" 
                name="alasan_pindaj" value="{{ old('alasan_pindaj') }}" 
                 id="exampleInputEmail1" placeholder="Alasan Kepindahan">
                @error('alasan_pindaj')
                  <div class="invalid-feedback" style="display: block">
                      {{ $message }}
                  </div>
                  @enderror
              </div>
            
              <label for="exampleInputFile">Alamat</label>
    
              <div class="row">
                <div class="col-3">
                  <input type="number" name="rt_tujuan"value="{{ old('rt_tujuan') }}"
                   class="form-control @error('rt_tujuan') is-invalid @enderror" required placeholder="RT">
                  @error('rt_tujuan')
                  <div class="invalid-feedback" style="display: block">
                      {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="col-3">
                  <input type="number" name="rw_tujuan" value="{{ old('rw_tujuan') }}"
                  class="form-control @error('rw_tujuan') is-invalid @enderror" required placeholder="RW">
                  @error('rw_tujuan')
                  <div class="invalid-feedback" style="display: block">
                      {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
<P></P>
              <div class="row">
                <div class="col-6">
                  <input type="text" name="desa_tujuan" value="{{ old('desa_tujuan') }}"
                  required class="form-control @error('desa_tujuan') is-invalid @enderror" placeholder="Kelurahan">
                  @error('desa_tujuan')
                  <div class="invalid-feedback" style="display: block">
                      {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="col-6">
                  <input type="text" name="kec_tujuan" value="{{ old('kec_tujuan') }}"
                  required class="form-control @error('kec_tujuan') is-invalid @enderror" placeholder="Kecamatan">
                  @error('kec_tujuan')
                  <div class="invalid-feedback" style="display: block">
                      {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
              <P></P>

              <div class="row">
                <div class="col-6">
                  <input type="text" name="kab_kota_tujuan" value="{{ old('kab_kota_tujuan') }}"
                  required class="form-control @error('kab_kota_tujuan') is-invalid @enderror" placeholder="Kab/Kota">
                  @error('kab_kota_tujuan')
                  <div class="invalid-feedback" style="display: block">
                      {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="col-6">
                  <input type="text" name="provinsi_tujuan" value="{{ old('provinsi_tujuan') }}"
                  required class="form-control @error('provinsi_tujuan') is-invalid @enderror" placeholder="Provinsi">
                  @error('provinsi_tujuan')
                  <div class="invalid-feedback" style="display: block">
                      {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
<p></p>
              <div class="form-group">
                <label for="exampleInputPassword1">Klasifikasi Pindah</label>
                <input type="text" name="kls_pindah" value="{{ old('kls_pindah') }}"
                required class="form-control @error('kls_pindah') is-invalid @enderror" name="kls_pindah" id="exampleInputPassword1" placeholder="Klasifikasi Pindah">
                @error('kls_pindah')
                  <div class="invalid-feedback" style="display: block">
                      {{ $message }}
                  </div>
                  @enderror
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Jenis Kepindahan	</label>
                <input type="text" name="jns_pindah" value="{{ old('jns_pindah') }}"
                required class="form-control @error('jns_pindah') is-invalid @enderror" name="jns_pindah" id="exampleInputPassword1" placeholder="Jenis Kepindahan">
                @error('jns_pindah')
                  <div class="invalid-feedback" style="display: block">
                      {{ $message }}
                  </div>
                  @enderror
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Status KK bagi yang tidak pindah</label>
                <input type="text" name="sts_kk_tdk_pindah" value="{{ old('sts_kk_tdk_pindah') }}"
                required class="form-control @error('sts_kk_tdk_pindah') is-invalid @enderror" name="sts_kk_tdk_pindah" id="exampleInputPassword1" placeholder="Status KK bagi yang tidak pindah">
                @error('sts_kk_tdk_pindah')
                  <div class="invalid-feedback" style="display: block">
                      {{ $message }}
                  </div>
                  @enderror
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Status KK yang Pindah	</label>
                <input type="text" name="sts_kk_yg_pindah" value="{{ old('sts_kk_yg_pindah') }}"
                required class="form-control @error('sts_kk_yg_pindah') is-invalid @enderror" name="sts_kk_yg_pindah" id="exampleInputPassword1" placeholder="Status KK yang Pindah">
                @error('sts_kk_yg_pindah')
                  <div class="invalid-feedback" style="display: block">
                      {{ $message }}
                  </div>
                  @enderror
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1"> Jumlah Keluarga yang pindah</label>
                <input type="number" name="jml" value="{{ old('jml') }}"
                required class="form-control @error('jml') is-invalid @enderror" name="jml" id="exampleInputPassword1" placeholder="Jumlah Keluarga yang pindah">
                @error('jml')
                  <div class="invalid-feedback" style="display: block">
                      {{ $message }}
                  </div>
                  @enderror
              </div>
            </div>
          </div>
          
            <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i>Kirim Data</button>
            <button type="reset" class="btn btn-danger"><i class="fa fa-undo"></i>Batal</button>
          <p></p>
          <!-- /.card-body -->
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
        <h4 class="modal-title">Form Pencarian Ajuan Pindah</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/surat-online-pindah/cari" method="GET" >
          {{--  @csrf  --}}
              <div class="input-group input-group-lg">
                  <input type="text" class="form-control @error('cari') is-invalid @enderror" maxlength="50"
                   name="cari"  placeholder="Cari Berdasarkan No Kartu Keluarga"value="{{ old('cari') }}">
               
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