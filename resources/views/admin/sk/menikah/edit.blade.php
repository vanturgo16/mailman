@extends('layouts.blackand.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">
           <a href="/menikah"> Surat Keterangan Menikah</h1></a>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Surat Keterangan Menikah</li>
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
                <h3 class="card-title">Form Edit <small>Surat Keterangan Menikah</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/menikah/update/{{ $menikah->id }}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('patch')
{{--  biodata diri ayah  --}}
                  <div class="card-body">
                    <div class="row">
                        
                      <div class="col-md-6">
                          
                        <div class="form-group">
                            Yang bertanda tangan dibawah ini :
                            <hr>
                          <label>Nama Lengkap Ayah</label>
                          <input type="text" name="operator" hidden value="{{ Auth::user()->name }}">
                          <input type="text" name="nama_ayah"value="{{ old('nama_ayah',$menikah->nama_ayah) }}" 
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
                          <input type="text" name="bin_ayah"value="{{ old('bin_ayah',$menikah->bin_ayah) }}" 
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
                          <input type="text" name="tempat_ayah"value="{{ old('tempat_ayah',$menikah->tempat_ayah) }}" 
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
                          <input type="text" name="tgl_ayah"value="{{ old('tgl_ayah',$menikah->tgl_ayah) }}" 
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
                            
                             @foreach ($ag as $agama)
                                @if($menikah->agama_ayah == $agama->kode)
                                                    
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
                          <label>Kewarganegaraan</label>
                          <div class="select2-purple">
                            <input type="text" name="negara_ayah"value="{{ old('negara_ayah',$menikah->negara_ayah) }}" 
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
                            <input type="text" name="nik_ayah"value="{{ old('nik_ayah',$menikah->nik_ayah) }}" 
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
                            
                              <input type="text" name="alamat_ayah"value="{{ old('alamat_ayah',$menikah->alamat_ayah) }}" 
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
                          <input type="text" name="operator" hidden value="{{ Auth::user()->name }}">
                          <input type="text" name="nama_ibu"value="{{ old('nama_ibu',$menikah->nama_ibu) }}" 
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
                          <input type="text" name="bin_ibu"value="{{ old('bin_ibu',$menikah->bin_ibu) }}" 
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
                          <input type="text" name="tempat_ibu"value="{{ old('tempat_ibu',$menikah->tempat_ibu) }}" 
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
                          <input type="text" name="tgl_ibu"value="{{ old('tgl_ibu',$menikah->tgl_ibu) }}" 
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
                            
                             @foreach ($ag as $agama)
                                @if($menikah->agama_ibu == $agama->kode)
                                                    
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
                          <label>Kewarganegaraan</label>
                          <div class="select2-purple">
                            <input type="text" name="negara_ibu"value="{{ old('negara_ibu',$menikah->negara_ibu) }}" 
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
                            <input type="text" name="nik_ibu"value="{{ old('nik_ibu',$menikah->nik_ibu) }}" 
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
                            
                              <input type="text" name="alamat_ibu"value="{{ old('alamat_ibu',$menikah->alamat_ibu) }}" 
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
                          <input type="text" name="nama_anak"value="{{ old('nama_anak',$menikah->nama_anak) }}" 
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
                          <input type="text" name="pekerjaan_anak"value="{{ old('pekerjaan_anak',$menikah->pekerjaan_anak) }}" 
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
                          <input type="text" name="tempat_anak"value="{{ old('tempat_anak',$menikah->tempat_anak) }}" 
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
                          <input type="text" name="tgl_anak"value="{{ old('tgl_anak',$menikah->tgl_anak) }}" 
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
                            
                             @foreach ($ag as $agama)
                                @if($menikah->agama_anak == $agama->kode)
                                                    
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
                          <label>Kewarganegaraan</label>
                          <div class="select2-purple">
                            <input type="text" name="negara_anak"value="{{ old('negara_anak',$menikah->negara_anak) }}" 
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
                            <input type="text" name="status_kawin_p"value="{{ old('status_kawin_p',$menikah->status_kawin_p) }}" 
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
                              <input type="text" name="nm_suami_atau_istri"value="{{ old('nm_suami_atau_istri',$menikah->nm_suami_atau_istri) }}" 
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
                            <input type="text" name="istri_ke"value="{{ old('istri_ke',$menikah->istri_ke) }}" 
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
                              <input type="text" name="nik_anak"value="{{ old('nik_anak',$menikah->nik_anak) }}" 
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
                           
                                @foreach ($jk as $jenis)
                                @if($menikah->jk_anak == $jenis->kode)
                                                    
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

                      <div class="row">
                     
                        <!-- /.col -->
                        <div class="col-12 col-sm-12">
                          <div class="form-group">
                            <label>Alamat</label>
                            <div class="select2-purple">
                            
                              <input type="text" name="alamat_anak"value="{{ old('alamat_anak',$menikah->alamat_anak) }}" 
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
          <input type="text" name="nama_dgn"value="{{ old('nama_dgn',$menikah->nama_dgn) }}" 
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
          <input type="text" name="bin_dgn"value="{{ old('bin_dgn',$menikah->bin_dgn) }}" 
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
          <input type="text" name="tempat_dgn"value="{{ old('tempat_dgn',$menikah->tempat_dgn) }}" 
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
          <input type="text" name="tgl_dgn"value="{{ old('tgl_dgn',$menikah->tgl_dgn) }}" 
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
                            
            @foreach ($ag as $agama)
               @if($menikah->agama_dgn == $agama->kode)
                                   
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
          <label>Kewarganegaraan</label>
          <div class="select2-purple">
            <input type="text" name="negara_dgn"value="{{ old('negara_dgn',$menikah->negara_dgn) }}" 
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
            <input type="text" name="nik_dgn"value="{{ old('nik_dgn',$menikah->nik_dgn) }}" 
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
            
              <input type="text" name="pekerjaan_dgn"value="{{ old('pekerjaan_dgn',$menikah->pekerjaan_dgn) }}" 
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
          
            <input type="text" name="alamat_dgn"value="{{ old('alamat_dgn',$menikah->alamat_dgn) }}" 
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

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i>Update & Proses</button>
                  <a href="/menikah/show/{{$menikah->id}}" target="_blank"  class="btn btn-outline-success"><i class="fa fa-print"></i> Print Izin Orang Tua</a>
                  <a href="/menikah/sk-pengantar/{{$menikah->id}}" target="_blank"  class="btn btn-outline-success"><i class="fa fa-print"></i> Print Pengantar Perkawinan</a>
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
