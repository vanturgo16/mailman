@extends('layouts.blackand.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <a href="/usaha">
          <h1 class="m-0">Surat Keterangan Usaha</h1>
        </a>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Surat Keterangan Usaha</li>
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
                <h3 class="card-title">Form Edit <small>Surat Keterangan Usaha</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/usaha/update/{{ $usaha->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('patch')
               
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Nama </label>
                          <input type="text" name="operator" hidden value="{{ Auth::user()->name }}">
                          <input type="text" name="nama"value="{{ old('nama',$usaha->nama) }}" 
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
                           
                            @foreach ($jk as $jenis)
                            @if($usaha->jk == $jenis->kode)
                                                
                            <option value="{{ $jenis->kode  }}" selected> {{ $jenis->nama}}</option>
                             @else
                            <option value="{{ $jenis->kode  }}">{{ $jenis->nama}}</option>
                            @endif

                        @endforeach
                          
                          </select>
                        </div>
                        <!-- /.form-group -->
                      </div>
                      <!-- /.col -->


                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Tempat Lahir</label>
                          <input type="text" name="tempat"value="{{ old('tempat',$usaha->tempat) }}" 
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
                          <input type="text" name="tgl"value="{{ old('tgl',$usaha->tgl) }}" 
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
                          <input type="number" name="nik"value="{{ old('nik',$usaha->nik) }}" 
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
                            <input type="text" name="pekerjaan"value="{{ old('pekerjaan',$usaha->pekerjaan) }}" 
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
                            <input type="text" name="alamat"value="{{ old('alamat',$usaha->alamat) }}" 
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
        <input type="text" name="jns_usaha"value="{{ old('jns_usaha',$usaha->jns_usaha) }}" 
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
            <input type="text" name="merek_usaha"value="{{ old('merek_usaha',$usaha->merek_usaha) }}" 
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
        <input type="text" name="kry"value="{{ old('kry',$usaha->kry) }}" 
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
        
          <input type="number" name="modal"value="{{ old('modal',$usaha->modal) }}" 
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
        <input type="text" name="luas_bangunan"value="{{ old('luas_bangunan',$usaha->luas_bangunan) }}" 
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
        
          <input type="text" name="bangunan_toko"value="{{ old('bangunan_toko',$usaha->bangunan_toko) }}" 
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
        <input type="number" name="no_hp"value="{{ old('no_hp',$usaha->no_hp) }}" 
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
            @if($usaha->pendidikan == $pen->kode)
                                
            <option value="{{ $pen->kode  }}" selected> {{ $pen->nama}}</option>
             @else
            <option value="{{ $pen->kode  }}">{{ $pen->nama}}</option>
            @endif

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
        <input type="text" name="alamat_usaha"value="{{ old('alamat_usaha',$usaha->alamat_usaha) }}" 
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
                  </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i>Update & Proses</button>
                  <a href="/usaha/show/{{$usaha->id}}" target="_blank"  class="btn btn-outline-success"><i class="fa fa-print"></i>Print Surat Keterangan Usaha</a>
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
