@extends('layouts.blackand.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><a href="/sktm">
            Surat Keterangan Kurang Mampu</h1></a>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Surat Keterangan Kurang Mampu</li>
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
                <h3 class="card-title">Form Edit <small>Surat Keterangan Kurang Mampu</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/sktm/update/{{ $sktm->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('patch')
               
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Nama Lengkap</label>
                          <input type="text" name="operator" hidden value="{{ Auth::user()->name }}">
                          <input type="text" name="nama"value="{{ old('nama',$sktm->nama) }}" 
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
                            @if($sktm->jk == $jenis->kode)
                                                
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
                          <input type="text" name="tempat"value="{{ old('tempat',$sktm->tempat) }}" 
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
                          <input type="text" name="tgl"value="{{ old('tgl',$sktm->tgl) }}" 
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
                            
                             @foreach ($ag as $agama)
                                @if($sktm->agama == $agama->kode)
                                                    
                                <option value="{{ $agama->kode  }}" selected> {{ $agama->nama}}</option>
                                 @else
                                <option value="{{ $agama->kode  }}">{{ $agama->nama}}</option>
                                @endif

                            @endforeach
                           
                          </select>
                        </div>
                        <!-- /.form-group -->
                      </div>
                      <!-- /.col -->
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label>Pekerjaan</label>
                          <div class="select2-purple">
                            <input type="text" name="pekerjaan"value="{{ old('pekerjaan',$sktm->pekerjaan) }}" 
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
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <label>Status</label>
                            <input type="text" name="status"value="{{ old('status',$sktm->status) }}" 
                            class="form-control @error('status') is-invalid @enderror" id="exampleInputEmail1" 
                            placeholder="Masukan status" required>
                            @error('status')
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
                            <label>NIK</label>
                            <div class="select2-purple">
                            
                              <input type="number" name="nik"value="{{ old('nik',$sktm->nik) }}" 
                              class="form-control @error('nik') is-invalid @enderror" id="exampleInputEmail1" 
                              placeholder="Masukan nik saatini" rows="3"required >
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
                    <!-- /.row -->

                    <div class="row">
                        <div class="col-12 col-sm-12">
                          <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" name="alamat"value="{{ old('alamat',$sktm->alamat) }}" 
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
<h5>Data Ibu</h5>

<div class="row">
    <div class="col-12 col-sm-6">
      <div class="form-group">
        <label>Nama Ibu</label>
        <input type="text" name="nama_ibu"value="{{ old('nama_ibu',$sktm->nama_ibu) }}" 
        class="form-control @error('nama_ibu') is-invalid @enderror" id="exampleInputEmail1" 
        placeholder="Masukan nama_ibu" required>
        @error('nama_ibu')
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
        <label>Jenis Kelamin</label>
        <div class="select2-purple">
            <select class="form-control select2" name="jk_ibu" style="width: 100%;">
                           
                @foreach ($jk as $jenis)
                @if($sktm->jk_ibu == $jenis->kode)
                                    
                <option value="{{ $jenis->kode  }}" selected> {{ $jenis->nama}}</option>
                 @else
                <option value="{{ $jenis->kode  }}">{{ $jenis->nama}}</option>
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
    <div class="col-12 col-sm-6">
      <div class="form-group">
        <label>Agama</label>
                          <select class="form-control select2 select2-danger" name="agama_ibu" data-dropdown-css-class="select2-danger" style="width: 100%;">
                            
                             @foreach ($ag as $agama)
                                @if($sktm->agama_ibu == $agama->kode)
                                                    
                                <option value="{{ $agama->kode  }}" selected> {{ $agama->nama}}</option>
                                 @else
                                <option value="{{ $agama->kode  }}">{{ $agama->nama}}</option>
                                @endif

                            @endforeach
                           
                          </select>
      </div>
      <!-- /.form-group -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6">
      <div class="form-group">
        <label>Pekerjaan Ibu</label>
        <div class="select2-purple">
        
          <input type="text" name="pekerjaan_ibu"value="{{ old('pekerjaan_ibu',$sktm->pekerjaan_ibu) }}" 
          class="form-control @error('pekerjaan_ibu') is-invalid @enderror" id="exampleInputEmail1" 
          placeholder="Masukan pekerjaan_ibu saatini" rows="3" required>
          @error('pekerjaan_ibu')
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
        <label>Status</label>
        <input type="text" name="status_ibu"value="{{ old('status_ibu',$sktm->status_ibu) }}" 
        class="form-control @error('status_ibu') is-invalid @enderror" id="exampleInputEmail1" 
        placeholder="Masukan status_ibu" required>
        @error('status_ibu')
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
        <label>Tanggal Lahir</label>
        <div class="select2-purple">
        
          <input type="text" name="tgl_ibu"value="{{ old('tgl_ibu',$sktm->tgl_ibu) }}" 
          class="form-control @error('tgl_ibu') is-invalid @enderror" id="exampleInputEmail1" 
          placeholder="Masukan tgl_ibu " rows="3">
          @error('tgl_ibu')
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
    <div class="col-12 col-sm-12">
      <div class="form-group">
        <label>Alamat Ibu</label>
        <input type="text" name="alamat_ibu"value="{{ old('alamat_ibu',$sktm->alamat_ibu) }}" 
        class="form-control @error('alamat_ibu') is-invalid @enderror" id="exampleInputEmail1" 
        placeholder="Masukan alamat_ibu" required>
        @error('alamat_ibu')
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
<h5>Data Ayah</h5>

<div class="row">
    <div class="col-12 col-sm-6">
      <div class="form-group">
        <label>Nama Ayah</label>
        <input type="text" name="nama_ayah"value="{{ old('nama_ayah',$sktm->nama_ayah) }}" 
        class="form-control @error('nama_ayah') is-invalid @enderror" id="exampleInputEmail1" 
        placeholder="Masukan nama_ayah" required>
        @error('nama_ayah')
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
        <label>Jenis Kelamin</label>
        <div class="select2-purple">
            <select class="form-control select2" name="jk_ayah" style="width: 100%;">
                           
                @foreach ($jk as $jenis)
                @if($sktm->jk_ayah == $jenis->kode)
                                    
                <option value="{{ $jenis->kode  }}" selected> {{ $jenis->nama}}</option>
                 @else
                <option value="{{ $jenis->kode  }}">{{ $jenis->nama}}</option>
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
    <div class="col-12 col-sm-6">
      <div class="form-group">
        <label>Agama</label>
                          <select class="form-control select2 select2-danger" name="agama_ayah" data-dropdown-css-class="select2-danger" style="width: 100%;">
                            
                             @foreach ($ag as $agama)
                                @if($sktm->agama_ayah == $agama->kode)
                                                    
                                <option value="{{ $agama->kode  }}" selected> {{ $agama->nama}}</option>
                                 @else
                                <option value="{{ $agama->kode  }}">{{ $agama->nama}}</option>
                                @endif

                            @endforeach
                           
                          </select>
      </div>
      <!-- /.form-group -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6">
      <div class="form-group">
        <label>Pekerjaan Ayah</label>
        <div class="select2-purple">
        
          <input type="text" name="pekerjaan_ayah"value="{{ old('pekerjaan_ayah',$sktm->pekerjaan_ayah) }}" 
          class="form-control @error('pekerjaan_ayah') is-invalid @enderror" id="exampleInputEmail1" 
          placeholder="Masukan pekerjaan_ayah saatini" rows="3" required>
          @error('pekerjaan_ayah')
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
        <label>Status</label>
        <input type="text" name="status_ayah"value="{{ old('status_ayah',$sktm->status_ayah) }}" 
        class="form-control @error('status_ayah') is-invalid @enderror" id="exampleInputEmail1" 
        placeholder="Masukan status_ayah" required>
        @error('status_ayah')
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
        <label>Tanggal Lahir</label>
        <div class="select2-purple">
        
          <input type="text" name="tgl_ayah"value="{{ old('tgl_ayah',$sktm->tgl_ayah) }}" 
          class="form-control @error('tgl_ayah') is-invalid @enderror" id="exampleInputEmail1" 
          placeholder="Masukan tgl_ayah " rows="3" required>
          @error('tgl_ayah')
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
    <div class="col-12 col-sm-12">
      <div class="form-group">
        <label>Alamat Ayah</label>
        <input type="text" name="alamat_ayah"value="{{ old('alamat_ayah',$sktm->alamat_ayah) }}" 
        class="form-control @error('alamat_ayah') is-invalid @enderror" id="exampleInputEmail1" 
        placeholder="Masukan alamat_ayah" required>
        @error('alamat_ayah')
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
                  <a href="/sktm/show/{{$sktm->id}}" target="_blank"  class="btn btn-outline-success"><i class="fa fa-print"></i>Print SKTM</a>
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
