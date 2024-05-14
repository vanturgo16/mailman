@extends('layouts.blackand.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><a href="/skck"> Surat Keterangan Berkelakuan Baik</a>
           </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Surat Keterangan Berkelakuan Baik</li>
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
                <h3 class="card-title">Form Edit <small>Surat Keterangan Berkelakuan Baik</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/skck/update/{{ $skck->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('patch')
               
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Nama Lengkap</label>
                          <input type="text" name="operator" hidden value="{{ Auth::user()->name }}">
                          <input type="text" name="nama"value="{{ old('nama',$skck->nama) }}" 
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
                            @if($skck->jk == $jenis->kode)
                                                
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
                          <input type="text" name="tempat"value="{{ old('tempat',$skck->tempat) }}" 
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
                          <input type="text" name="tgl"value="{{ old('tgl',$skck->tgl) }}" 
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
                                @if($skck->agama == $agama->kode)
                                                    
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
                          <label>NIK</label>
                          <div class="select2-purple">
                            <input type="number" name="nik"value="{{ old('nik',$skck->nik) }}" 
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
                            <input type="text" name="status_kawin"value="{{ old('status_kawin',$skck->status_kawin) }}" 
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
                              <input type="text" name="pekerjaan"value="{{ old('pekerjaan',$skck->pekerjaan) }}" 
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
                            <input type="text" name="negara"value="{{ old('negara',$skck->negara) }}" 
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
                            
                              <input type="text" name="alamat"value="{{ old('alamat',$skck->alamat) }}" 
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
                  <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i>Update & Proses</button>
                  <a href="/skck/show/{{$skck->id}}" target="_blank"  class="btn btn-outline-success"><i class="fa fa-print"></i>Print Surat Keterangan Berkelakuan Baik</a>
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
