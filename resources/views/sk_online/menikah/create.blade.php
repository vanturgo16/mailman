@extends('layouts.suratonline.app')

@section('content')



<div class="content-header">
  <div class="container">
    <div class="row mb-2">
      <div class="col-sm-6">
        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-lg">
          Klik di Sini Untuk Mencari SK Menikah Yang Telah Anda Ajukan
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
          <form action="/surat-online-menikah" method="POST" enctype="multipart/form-data">
            @csrf
           {{--  biodata diri ayah  --}}
           <div class="card-body">
            <div class="row">
                
              <div class="col-md-6">
                  
                <div class="form-group">
                    Yang bertanda tangan dibawah ini :
                    <hr>
                  <label>Nama Lengkap Ayah</label>
                  <input type="text" name="nama_ayah"value="{{ old('nama_ayah') }}" 
              class="form-control @error('nama_ayah') is-invalid @enderror" id="exampleInputEmail1" 
              placeholder="Masukan Nama_ayah Lengkap" required>
              @error('nama_ayah')
              <div class="invalid-feedback" style="display: block">
                  {{ $message }}
              </div>
              @enderror
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Bin</label>
                  <input type="text" name="bin_ayah"value="{{ old('bin_ayah') }}" 
              class="form-control @error('bin_ayah') is-invalid @enderror" id="exampleInputEmail1" 
              placeholder="Masukan bin_ayah Lengkap" required>
              @error('bin_ayah')
              <div class="invalid-feedback" style="display: block">
                  {{ $message }}
              </div>
              @enderror
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->


              <div class="col-md-6">
                <div class="form-group">
                  <a href=""> <b> Data Ayah</b></a>
                    <hr>
                  <label>Tempat Lahir</label>
                  <input type="text" name="tempat_ayah"value="{{ old('tempat_ayah') }}" 
                  class="form-control @error('tempat_ayah') is-invalid @enderror" id="exampleInputEmail1" 
                  placeholder="Masukan tempat_ayah lahir" required>
                  @error('tempat_ayah')
                  <div class="invalid-feedback" style="display: block">
                      {{ $message }}
                  </div>
                  @enderror
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Tanggal Lahir</label>
                  <input type="date" name="tgl_ayah"value="{{ old('tgl_ayah') }}" 
                  class="form-control @error('tgl_ayah') is-invalid @enderror" id="exampleInputEmail1" 
                  placeholder="Masukan tgl_ayah lahir" required>
                  @error('tgl_ayah')
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
                  <select class="form-control select2 select2-danger" name="agama_ayah" data-dropdown-css-class="select2-danger" style="width: 100%;">
                    
                        <option value="1">Islam</option>
                        <option value="2">Kristen</option>
                        <option value="3">Hindu</option>
                        <option value="4">Buddha</option>
                        <option value="5">Konghucu</option>
                      

                  </select>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label>Kewarganegaraan</label>
                  <div class="select2-purple">
                    <input type="text" name="negara_ayah"value="{{ old('negara_ayah') }}" 
                    class="form-control @error('negara_ayah') is-invalid @enderror" id="exampleInputEmail1" 
                    placeholder="Masukan negara_ayah" required>
                    @error('negara_ayah')
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
                    <label>Nomor Induk Kependudukan (NIK)</label>
                    <input type="number" name="nik_ayah"value="{{ old('nik_ayah') }}" 
                    class="form-control @error('nik_ayah') is-invalid @enderror" id="exampleInputEmail1" 
                    placeholder="Masukan nik_ayah" required>
                    @error('nik_ayah')
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
                    
                      <input type="text" name="alamat_ayah"value="{{ old('alamat_ayah') }}" 
                      class="form-control @error('alamat_ayah') is-invalid @enderror" id="exampleInputEmail1" 
                      placeholder="Masukan alamat_ayah saatini" rows="3">
                      @error('alamat_ayah')
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

{{--  biodata diri ayah  --}}
        <div class="card-body">
            <div class="row">
                
              <div class="col-md-6">
                  
                <div class="form-group">
                    Yang bertanda tangan dibawah ini :
                    <hr>
                  <label>Nama Lengkap Ibu</label>
                  <input type="text" name="nama_ibu"value="{{ old('nama_ibu') }}" 
              class="form-control @error('nama_ibu') is-invalid @enderror" id="exampleInputEmail1" 
              placeholder="Masukan Nama_ibu Lengkap" required>
              @error('nama_ibu')
              <div class="invalid-feedback" style="display: block">
                  {{ $message }}
              </div>
              @enderror
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Bin</label>
                  <input type="text" name="bin_ibu"value="{{ old('bin_ibu') }}" 
              class="form-control @error('bin_ibu') is-invalid @enderror" id="exampleInputEmail1" 
              placeholder="Masukan bin_ibu Lengkap" required>
              @error('bin_ibu')
              <div class="invalid-feedback" style="display: block">
                  {{ $message }}
              </div>
              @enderror
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->


              <div class="col-md-6">
                <div class="form-group">
                <a href=""><b>  Data Ibu</b></a>
                    <hr>
                  <label>Tempat Lahir</label>
                  <input type="text" name="tempat_ibu"value="{{ old('tempat_ibu') }}" 
                  class="form-control @error('tempat_ibu') is-invalid @enderror" id="exampleInputEmail1" 
                  placeholder="Masukan tempat_ibu lahir" required>
                  @error('tempat_ibu')
                  <div class="invalid-feedback" style="display: block">
                      {{ $message }}
                  </div>
                  @enderror
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Tanggal Lahir</label>
                  <input type="date" name="tgl_ibu"value="{{ old('tgl_ibu') }}" 
                  class="form-control @error('tgl_ibu') is-invalid @enderror" id="exampleInputEmail1" 
                  placeholder="Masukan tgl_ibu lahir" required>
                  @error('tgl_ibu')
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
                  <select class="form-control select2 select2-danger" name="agama_ibu" data-dropdown-css-class="select2-danger" style="width: 100%;">
                    
                    <option value="1">Islam</option>
                    <option value="2">Kristen</option>
                    <option value="3">Hindu</option>
                    <option value="4">Buddha</option>
                    <option value="5">Konghucu</option>
                   
                  </select>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label>Kewarganegaraan</label>
                  <div class="select2-purple">
                    <input type="text" name="negara_ibu"value="{{ old('negara_ibu') }}" 
                    class="form-control @error('negara_ibu') is-invalid @enderror" id="exampleInputEmail1" 
                    placeholder="Masukan negara_ibu" required>
                    @error('negara_ibu')
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
                    <label>Nomor Induk Kependudukan (NIK)</label>
                    <input type="number" name="nik_ibu"value="{{ old('nik_ibu') }}" 
                    class="form-control @error('nik_ibu') is-invalid @enderror" id="exampleInputEmail1" 
                    placeholder="Masukan nik_ibu" required>
                    @error('nik_ibu')
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
                    
                      <input type="text" name="alamat_ibu"value="{{ old('alamat_ibu') }}" 
                      class="form-control @error('alamat_ibu') is-invalid @enderror" id="exampleInputEmail1" 
                      placeholder="Masukan alamat_ibu saatini" rows="3">
                      @error('alamat_ibu')
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
{{--  biodata dari anak dari  --}}
        <div class="card-body">
            <div class="row">
                
              <div class="col-md-6">
                  
                <div class="form-group">
                    Adalah benar ayah kandung dan ibu kandung dari seorang :
                    <hr>
                  <label>Nama Lengkap </label>
                  <input type="text" name="nama_anak"value="{{ old('nama_anak') }}" 
              class="form-control @error('nama_anak') is-invalid @enderror" id="exampleInputEmail1" 
              placeholder="Masukan Nama_anak Lengkap" required>
              @error('nama_anak')
              <div class="invalid-feedback" style="display: block">
                  {{ $message }}
              </div>
              @enderror
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Pekerjaan</label>
                  <input type="text" name="pekerjaan_anak"value="{{ old('pekerjaan_anak') }}" 
              class="form-control @error('pekerjaan_anak') is-invalid @enderror" id="exampleInputEmail1" 
              placeholder="Masukan pekerjaan_anak Lengkap" required>
              @error('pekerjaan_anak')
              <div class="invalid-feedback" style="display: block">
                  {{ $message }}
              </div>
              @enderror
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->


              <div class="col-md-6">
                <div class="form-group">
                <a href=""><b>  Data Anak</b></a>
                    <hr>
                  <label>Tempat Lahir</label>
                  <input type="text" name="tempat_anak"value="{{ old('tempat_anak') }}" 
                  class="form-control @error('tempat_anak') is-invalid @enderror" id="exampleInputEmail1" 
                  placeholder="Masukan tempat_anak lahir" required>
                  @error('tempat_anak')
                  <div class="invalid-feedback" style="display: block">
                      {{ $message }}
                  </div>
                  @enderror
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Tanggal Lahir</label>
                  <input type="date" name="tgl_anak"value="{{ old('tgl_anak') }}" 
                  class="form-control @error('tgl_anak') is-invalid @enderror" id="exampleInputEmail1" 
                  placeholder="Masukan tgl_anak lahir" required>
                  @error('tgl_anak')
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
                  <select class="form-control select2 select2-danger" name="agama_anak" data-dropdown-css-class="select2-danger" style="width: 100%;">
                    <option value="1">Islam</option>
                    <option value="2">Kristen</option>
                    <option value="3">Hindu</option>
                    <option value="4">Buddha</option>
                    <option value="5">Konghucu</option>
                   
                  </select>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label>Kewarganegaraan</label>
                  <div class="select2-purple">
                    <input type="text" name="negara_anak"value="{{ old('negara_anak') }}" 
                    class="form-control @error('negara_anak') is-invalid @enderror" id="exampleInputEmail1" 
                    placeholder="Masukan negara_anak" required>
                    @error('negara_anak')
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
                    <label>Status Perkawinan</label>
                    <input type="text" name="status_kawin_p"value="{{ old('status_kawin_p') }}" 
                      class="form-control @error('status_kawin_p') is-invalid @enderror" id="exampleInputEmail1" 
                      placeholder="Masukan status_kawin_p" required>
                      @error('status_kawin_p')
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
                    <label>Nama Suami/Istri terdahulu</label>
                    <div class="select2-purple">
                      <input type="text" name="nm_suami_atau_istri"value="{{ old('nm_suami_atau_istri') }}" 
                      class="form-control @error('nm_suami_atau_istri') is-invalid @enderror" id="exampleInputEmail1" 
                      placeholder="Masukan nm_suami_atau_istri" required>
                      @error('nm_suami_atau_istri')
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
                    <label>Laki-laki:Jejaka,Duda:atau beristri ke
                        </label>
                    <input type="text" name="istri_ke"value="{{ old('istri_ke') }}" 
                      class="form-control @error('istri_ke') is-invalid @enderror" id="exampleInputEmail1" 
                      placeholder="Masukan istri_ke" required>
                      @error('istri_ke')
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
                    <label>Nomor Induk Kependudukan (NIK)</label>
                    <div class="select2-purple">
                      <input type="number" name="nik_anak"value="{{ old('nik_anak') }}" 
                      class="form-control @error('nik_anak') is-invalid @enderror" id="exampleInputEmail1" 
                      placeholder="Masukan nik_anak" required>
                      @error('nik_anak')
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
             
                <!-- /.col -->
                <div class="col-12 col-sm-12">
                  <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <div class="select2-purple">
                    
                      <select class="form-control select2" name="jk_anak" style="width: 100%;">
                   
                        <option value="L">Laki-Laki</option>
                        <option value="P">Perempuan</option>
                      
                      </select>
                    </div>
                  </div>
                  <!-- /.form-group -->
                </div>
                <!-- /.col -->
              </div>

              <div class="row">
             
                <!-- /.col -->
                <div class="col-12 col-sm-12">
                  <div class="form-group">
                    <label>Alamat</label>
                    <div class="select2-purple">
                    
                      <input type="text" name="alamat_anak"value="{{ old('alamat_anak') }}" 
                      class="form-control @error('alamat_anak') is-invalid @enderror" id="exampleInputEmail1" 
                      placeholder="Masukan alamat_anak saatini" rows="3">
                      @error('alamat_anak')
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
{{--  biodata calon  --}}
<div class="card-body">
<div class="row">

<div class="col-md-6">
  
<div class="form-group">
    Memberikan Izin kepadanya untuk melakukan perkawinan dengan
    <hr>
  <label>Nama Lengkap </label>
  <input type="text" name="nama_dgn"value="{{ old('nama_dgn') }}" 
class="form-control @error('nama_dgn') is-invalid @enderror" id="exampleInputEmail1" 
placeholder="Masukan Nama_dgn Lengkap" required>
@error('nama_dgn')
<div class="invalid-feedback" style="display: block">
  {{ $message }}
</div>
@enderror
</div>
<!-- /.form-group -->
<div class="form-group">
  <label>Bin</label>
  <input type="text" name="bin_dgn"value="{{ old('bin_dgn') }}" 
class="form-control @error('bin_dgn') is-invalid @enderror" id="exampleInputEmail1" 
placeholder="Masukan bin_dgn Lengkap" required>
@error('bin_dgn')
<div class="invalid-feedback" style="display: block">
  {{ $message }}
</div>
@enderror
</div>
<!-- /.form-group -->
</div>
<!-- /.col -->


<div class="col-md-6">
<div class="form-group">
    Seorang :<a href=""><b>   Data Calon Mempelai</b></a>
    <hr>
  <label>Tempat Lahir</label>
  <input type="text" name="tempat_dgn"value="{{ old('tempat_dgn') }}" 
  class="form-control @error('tempat_dgn') is-invalid @enderror" id="exampleInputEmail1" 
  placeholder="Masukan tempat_dgn lahir" required>
  @error('tempat_dgn')
  <div class="invalid-feedback" style="display: block">
      {{ $message }}
  </div>
  @enderror
</div>
<!-- /.form-group -->
<div class="form-group">
  <label>Tanggal Lahir</label>
  <input type="date" name="tgl_dgn"value="{{ old('tgl_dgn') }}" 
  class="form-control @error('tgl_dgn') is-invalid @enderror" id="exampleInputEmail1" 
  placeholder="Masukan tgl_dgn lahir" required>
  @error('tgl_dgn')
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
  <select class="form-control select2 select2-danger" name="agama_dgn" data-dropdown-css-class="select2-danger" style="width: 100%;">
    <option value="1">Islam</option>
    <option value="2">Kristen</option>
    <option value="3">Hindu</option>
    <option value="4">Buddha</option>
    <option value="5">Konghucu</option>
  
 </select>
</div>
<!-- /.form-group -->
</div>
<!-- /.col -->
<div class="col-12 col-sm-6">
<div class="form-group">
  <label>Kewarganegaraan</label>
  <div class="select2-purple">
    <input type="text" name="negara_dgn"value="{{ old('negara_dgn') }}" 
    class="form-control @error('negara_dgn') is-invalid @enderror" id="exampleInputEmail1" 
    placeholder="Masukan negara_dgn" required>
    @error('negara_dgn')
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
    <label>Nomor Induk Kependudukan (NIK)</label>
    <input type="number" name="nik_dgn"value="{{ old('nik_dgn') }}" 
    class="form-control @error('nik_dgn') is-invalid @enderror" id="exampleInputEmail1" 
    placeholder="Masukan nik_dgn" required>
    @error('nik_dgn')
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
    <label>Pekerjaan</label>
    <div class="select2-purple">
    
      <input type="text" name="pekerjaan_dgn"value="{{ old('pekerjaan_dgn') }}" 
      class="form-control @error('pekerjaan_dgn') is-invalid @enderror" id="exampleInputEmail1" 
      placeholder="Masukan pekerjaan_dgn saatini" rows="3">
      @error('pekerjaan_dgn')
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

<div class="col-12 col-sm-12">
<div class="form-group">
  <label>Alamat</label>
  <div class="select2-purple">
  
    <input type="text" name="alamat_dgn"value="{{ old('alamat_dgn') }}" 
    class="form-control @error('alamat_dgn') is-invalid @enderror" id="exampleInputEmail1" 
    placeholder="Masukan alamat_dgn saatini" rows="3">
    @error('alamat_dgn')
    <div class="invalid-feedback" style="display: block">
        {{ $message }}
    </div>
    @enderror
  </div>
</div>
<!-- /.form-gro
<!-- /.row -->
</div>


<!-- /.card-body -->

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
        <h4 class="modal-title">Form Pencarian Ajuan Surat Keterangan Menikah</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/surat-online-menikah/cari" method="GET">
          {{--  @csrf  --}}
          <div class="input-group input-group-lg">
            <input type="text" class="form-control @error('cari') is-invalid @enderror" maxlength="50"
             name="cari"  placeholder="Cari Berdasarkan Nama Ayah "value="{{ old('cari') }}">
         
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