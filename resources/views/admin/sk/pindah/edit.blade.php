@extends('layouts.blackand.app')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <a href="/pindah">
        <h1>Edit Formulir SK Pindah</h1>
      </a>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Edit Formulir</li>
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
      <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">DATA DAERAH ASAL</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="/sk-pindah/update/{{ $pindah->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Nomer Kartu Keluarga</label>
                <input type="number" class="form-control" name="kk"value="{{ old('kk',$pindah->kk) }}"
                 id="exampleInputEmail1" placeholder="Nomer Kartu Keluarga">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Nama Kepala Keluarga</label>
                <input type="text" class="form-control @error('nm_kk') is-invalid @enderror"
                 name="nm_kk" value="{{ old('nm_kk',$pindah->nm_kk) }}" id="exampleInputPassword1"
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
                  <input type="number" name="rt_asal" value="{{ old('rt_asal',$pindah->rt_asal) }}" 
                  required class="form-control @error('rt_asal') is-invalid @enderror" placeholder="RT">
                  @error('rt_asal')
                  <div class="invalid-feedback" style="display: block">
                      {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="col-3">
                  <input type="number" name="rw_asal"value="{{ old('rw_asal',$pindah->rw_asal) }}"
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
                  <input type="text" required name="desa_asal" value="{{ old('desa_asal',$pindah->desa_asal) }}"
                  class="form-control @error('desa_asal') is-invalid @enderror" placeholder="Kelurahan">
                  @error('desa_asal')
                  <div class="invalid-feedback" style="display: block">
                      {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="col-6">
                  <input type="text" required name="kec_asal" value="{{ old('kec_asal',$pindah->kec_asal) }}"
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
                  <input type="text" name="kab_kota_asal" value="{{ old('kab_kota_asal',$pindah->kab_kota_asal) }}"
                  class="form-control @error('kab_kota_asal') is-invalid @enderror"
                   placeholder="Kab/Kota" required>
                  @error('kab_kota_asal')
                  <div class="invalid-feedback" style="display: block">
                      {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="col-6">
                  <input type="text" name="provinsi_asal"  value="{{ old('provinsi_asal',$pindah->provinsi_asal) }}"
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
              <center>
              <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-lg">
                Klik di Sini Untuk  Menambahkan Data Keluarga Yang Akan Pindah
              </button>
            </center>
            </div>
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
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Update & Proses</button>
              <a href="/pindah/show/{{$pindah->id}}" target="_blank"  class="btn btn-outline-success">
                <i class="fa fa-print"></i> Print Surat Keterangan Pindah</a>

            </div>
          
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
                name="alasan_pindaj" value="{{ old('alasan_pindaj',$pindah->alasan_pindaj) }}" 
                 id="exampleInputEmail1" placeholder="Nomer Kartu Keluarga">
                @error('alasan_pindaj')
                  <div class="invalid-feedback" style="display: block">
                      {{ $message }}
                  </div>
                  @enderror
              </div>
            
              <label for="exampleInputFile">Alamat</label>
    
              <div class="row">
                <div class="col-3">
                  <input type="number" name="rt_tujuan"value="{{ old('rt_tujuan',$pindah->rt_tujuan) }}"
                   class="form-control @error('rt_tujuan') is-invalid @enderror" required placeholder="RT">
                  @error('rt_tujuan')
                  <div class="invalid-feedback" style="display: block">
                      {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="col-3">
                  <input type="number" name="rw_tujuan" value="{{ old('rw_tujuan',$pindah->rw_tujuan) }}"
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
                  <input type="text" name="desa_tujuan" value="{{ old('desa_tujuan',$pindah->desa_tujuan) }}"
                  required class="form-control @error('desa_tujuan') is-invalid @enderror" placeholder="Kelurahan">
                  @error('desa_tujuan')
                  <div class="invalid-feedback" style="display: block">
                      {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="col-6">
                  <input type="text" name="kec_tujuan" value="{{ old('kec_tujuan',$pindah->kec_tujuan) }}"
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
                  <input type="text" name="kab_kota_tujuan" value="{{ old('kab_kota_tujuan',$pindah->kab_kota_tujuan) }}"
                  required class="form-control @error('kab_kota_tujuan') is-invalid @enderror" placeholder="Kab/Kota">
                  @error('kab_kota_tujuan')
                  <div class="invalid-feedback" style="display: block">
                      {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="col-6">
                  <input type="text" name="provinsi_tujuan" value="{{ old('provinsi_tujuan',$pindah->provinsi_tujuan) }}"
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
                <input type="text" name="kls_pindah" value="{{ old('kls_pindah',$pindah->kls_pindah) }}"
                required class="form-control @error('kls_pindah') is-invalid @enderror" name="nm_kk" id="exampleInputPassword1" placeholder="Nama Kepala Keluarga">
                @error('kls_pindah')
                  <div class="invalid-feedback" style="display: block">
                      {{ $message }}
                  </div>
                  @enderror
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Jenis Kepindahan	</label>
                <input type="text" name="jns_pindah" value="{{ old('jns_pindah',$pindah->jns_pindah) }}"
                required class="form-control @error('jns_pindah') is-invalid @enderror" name="jns_pindah" id="exampleInputPassword1" placeholder="Nama Kepala Keluarga">
                @error('jns_pindah')
                  <div class="invalid-feedback" style="display: block">
                      {{ $message }}
                  </div>
                  @enderror
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Status KK bagi yang tidak pindah</label>
                <input type="text" name="sts_kk_tdk_pindah" value="{{ old('sts_kk_tdk_pindah',$pindah->sts_kk_tdk_pindah) }}"
                required class="form-control @error('sts_kk_tdk_pindah') is-invalid @enderror" name="sts_kk_tdk_pindah" id="exampleInputPassword1" placeholder="Status KK bagi yang tidak pindah">
                @error('sts_kk_tdk_pindah')
                  <div class="invalid-feedback" style="display: block">
                      {{ $message }}
                  </div>
                  @enderror
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Status KK yang Pindah	</label>
                <input type="text" name="sts_kk_yg_pindah" value="{{ old('sts_kk_yg_pindah',$pindah->sts_kk_yg_pindah) }}"
                required class="form-control @error('sts_kk_yg_pindah') is-invalid @enderror" name="sts_kk_yg_pindah" id="exampleInputPassword1" placeholder="Status KK yang Pindah">
                @error('sts_kk_yg_pindah')
                  <div class="invalid-feedback" style="display: block">
                      {{ $message }}
                  </div>
                  @enderror
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1"> Jumlah Keluarga yang pindah</label>
                <input type="number" name="jml" value="{{ old('jml',$pindah->jml) }}"
                required class="form-control @error('jml') is-invalid @enderror" name="jml" id="exampleInputPassword1" placeholder="Jumlah Keluarga yang pindah">
                @error('jml')
                  <div class="invalid-feedback" style="display: block">
                      {{ $message }}
                  </div>
                  @enderror
              </div>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
      </form>
        <!-- /.card -->
        <div class="col-md-12">
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title"> Data Keluarga Yang Pindah</h3>
          </div>
          <div class="card-body">
          
            <table id="example5"class="table table-bordered">
              <thead>
              <tr>
                <th>Nama</th>
                <th>TTL</th>
                <th>JK</th>
                <th>Status Perkawinan</th>
                <th>Pekerjaan</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($kk_pindah as $ket)
                    
              
              <tr>
                <td>{{ $ket->nama }}</td>
                <td>{{ $ket->tempat }}, {{ $ket->tgl }}</td>
                <td>{{ $ket->jk }}</td>
                <td>{{ $ket->status_kawin }}</td>
                <td>{{ $ket->pekerjaan }}</td>
                <td>
                  <a href="" class="btn btn-xs btn-info">
                    <i class="fa fa-edit"></i>
                 </a>
                 <form method="POST" class="d-inline" onsubmit="return confirm('Masukan ke tempat sampah?')" action="">
                   @csrf
                   <input type="hidden" value="DELETE" name="_method">
                   <button type="submit" value="Delete" class="btn btn-xs btn-danger">
                     <i class="fas fa-trash"></i>  </button>
               </form>


                </td>
              </tr>
              @endforeach
              </tbody>
            </table>

          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->


        <!-- /.card -->
      </div>
      <!--/.col (right) -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<div class="modal fade" id="modal-lg">
  <div class="modal-dialog modal-lg">
    <form action="/pindah" method="POST" enctype="multipart/form-data">
      @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Formulir Tambah Data Keluarga</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
          <div class="form-group">
            <input type="text" hidden readonly  name="id_pindah" value="{{ old('id_pindah',$pindah->id) }}">
             
            <input type="text" required class="form-control @error('nama') is-invalid @enderror" 
            name="nama" id="exampleInputPassword1" placeholder="Masukan Nama Lengkap">
            @error('nama')
                  <div class="invalid-feedback" style="display: block">
                      {{ $message }}
                  </div>
                  @enderror</div>
          <div class="row">
            <div class="col-4">
              <input type="text" name="tempat" required class="form-control @error('tempat') is-invalid @enderror" placeholder="Tempat Lahir">
              @error('tempat')
                  <div class="invalid-feedback" style="display: block">
                      {{ $message }}
                  </div>
                  @enderror
            </div>
            <div class="col-4">
              <input type="date" name="tgl" class="form-control @error('tgl') is-invalid @enderror" placeholder="Tanggal Lahir">
              @error('tgl')
                  <div class="invalid-feedback" style="display: block">
                      {{ $message }}
                  </div>
                  @enderror
            </div>
            <div class="col-4">
              <select class="form-control select2" name="jk" style="width: 100%;">
                           
                @foreach ($jenis as $jk)
                                
                <option value="{{ $jk->kode  }}" selected> {{ $jk->nama}}</option>
              

            @endforeach
              
              </select>
            </div>
          </div>
          <p></p>
          <div class="form-group">

            <select class="form-control select2" name="status_kawin" style="width: 100%;">
             
              <option value="Kawin" selected>Kawin</option>
              <option value="Tidak Kawin" selected> Tidak Kawin</option>
              <option value="Janda" selected>Janda</option>
              <option value="Duda" selected>Duda</option>
            </select>
          </div>
          <div class="form-group">
            <input type="text" name="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror" name="nm_kk" id="exampleInputPassword1" placeholder="Pekerjaan">
            @error('pekerjaan')
                  <div class="invalid-feedback" style="display: block">
                      {{ $message }}
                  </div>
                  @enderror
          </div>
          
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan Data</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection
