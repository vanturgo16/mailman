@extends('layouts.blackand.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">
            <a href="/kelahiran">Surat Keterangan Lahir</a>
            </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Surat Keterangan Lahir</li>
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
                <h3 class="card-title">Form Edit <small>Surat Keterangan Lahir</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/kelahiran/update/{{ $kelahiran->id }}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('patch')

                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Nama Lengkap</label>
                          <input type="text" name="operator" hidden value="{{ Auth::user()->name }}">
                          <input type="text" name="nama"value="{{ old('nama',$kelahiran->nama) }}" 
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
                            @if($kelahiran->jk == $jenis->kode)
                                                
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
                          <input type="text" name="tempat"value="{{ old('tempat',$kelahiran->tempat) }}" 
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
                          <input type="text" name="tgl"value="{{ old('tgl',$kelahiran->tgl) }}" 
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
                            <label>Pekerjaan</label>
                            <input type="text" name="pekerjaan"value="{{ old('pekerjaan',$kelahiran->pekerjaan) }}" 
                            class="form-control @error('pekerjaan') is-invalid @enderror" id="exampleInputEmail1" 
                            placeholder="Masukan pekerjaan" required>
                            @error('pekerjaan')
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
                            <label>Anak Ke-</label>
                            <div class="select2-purple">
                            
                              <input type="text" name="anak_ke"value="{{ old('anak_ke',$kelahiran->anak_ke) }}" 
                              class="form-control @error('anak_ke') is-invalid @enderror" id="exampleInputEmail1" 
                              placeholder="Masukan anak_ke saatini" rows="3" required>
                              @error('anak_ke')
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
                            <label>Nama Ayah</label>
                            <input type="text" name="nama_ayah"value="{{ old('nama_ayah',$kelahiran->nama_ayah) }}" 
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
                            <label>Nama Ibu</label>
                            <div class="select2-purple">
                            
                              <input type="text" name="nama_ibu"value="{{ old('nama_ibu',$kelahiran->nama_ibu) }}" 
                              class="form-control @error('nama_ibu') is-invalid @enderror" id="exampleInputEmail1" 
                              placeholder="Masukan nama_ibu saatini" rows="3">
                              @error('nama_ibu')
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
                            <input type="text" name="alamat"value="{{ old('alamat',$kelahiran->alamat) }}" 
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
                        <!-- /.col -->
                       
                        <!-- /.col -->
                      </div>
                    <!-- /.row --> 
                    
                  </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i>Update & Proses</button>
                  <a href="/kelahiran/show/{{$kelahiran->id}}" target="_blank"  class="btn btn-outline-success"><i class="fa fa-print"></i>Print Surat Keterangan Lahir</a>
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
