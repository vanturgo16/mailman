@extends('layouts.opd.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">
           <a href="/pejabat"> Form Data Pejabat</h1></a>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Form Agenda Pejabat</li>
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
                <h3 class="card-title">Form  <small> Agenda Pejabat</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/agenda-pejabat/update/{{ $pejabat->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @csrf
                @method('patch')
           
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                              <div class="form-group">
                                <label>Pejabat yang di Undang</label>
                                <select class="form-control select2 select2-danger" name="id_pejabat" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                   
                                    @foreach ($pd as $pd)
                                    @if($pejabat->id_pejabat == $pd->id)
                                                        
                                    <option value="{{ $pd->id  }}" selected> {{ $pd->nm_pejabat}} - <b>{{ $pd->nm_jabatan}}</b></option>
                                     @else
                                    <option value="{{ $pd->id  }}">{{ $pd->nm_pejabat}} - <b>{{ $pd->nm_jabatan}}</b></option>
                                    @endif
    
                                @endforeach
                                 
                                </select>
                              </div>
                              <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <div class="col-12 col-sm-6">
                              <div class="form-group">
                                <label>Penanggung Jawab</label>
                                <div class="select2-purple">
                                  <select class="form-control select2 select2-danger" name="pj"
                                  data-dropdown-css-class="select2-danger" style="width: 100%;">


                                  <option value="{{ $opd->id  }}" selected> {{ $opd->nm_opd}}</option>


                              </select>
                               
                                 
                                </div>
                              </div>
                              <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                          </div>
                        <!-- /.form-group -->
                       
                    {{--  <div class="row">
                        <div class="col-12 col-sm-12">
                          <div class="form-group">
                            <label>Pendamping</label>
                            <input type="text" name="pendamping"value="{{ old('pendamping',$pejabat->pendamping) }}" 
                            class="form-control @error('pendamping') is-invalid @enderror" id="exampleInputEmail1" 
                            placeholder="Masukan Pendamping " required>
                            @error('pendamping')
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
                    <!-- /.row -->  --}}
                    <div class="row">
                        <div class="col-12 col-sm-12">
                          <div class="form-group">
                            <label>Tanggal Kegiatan</label>
                            <input type="date" name="tgl"value="{{ old('tgl',$pejabat->tgl) }}" 
                            class="form-control @error('tgl') is-invalid @enderror" id="exampleInputEmail1" 
                            placeholder="Masukan Telpon " required>
                            @error('tgl')
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

                    <div class="row">
                        <div class="col-12 col-sm-12">
                          <div class="form-group">
                            <label>Jam Mulai Kegiatan</label>
                            <input type="time" name="jam_mulai"value="{{ old('jam_mulai',$pejabat->jam_mulai) }}" 
                            class="form-control @error('jam_mulai') is-invalid @enderror" id="exampleInputEmail1" 
                            placeholder="Masukan Telpon " required>
                            @error('jam_mulai')
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

                    <div class="row">
                        <div class="col-12 col-sm-12">
                          <div class="form-group">
                            <label>Jam Selesai Kegiatan</label>
                            <input type="time" name="jam_selsai"value="{{ old('jam_selsai',$pejabat->jam_selsai) }}" 
                            class="form-control @error('jam_selsai') is-invalid @enderror" id="exampleInputEmail1" 
                            placeholder="Masukan Telpon " required>
                            @error('jam_selsai')
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
                    <div class="row">
                        <div class="col-12 col-sm-12">
                          <div class="form-group">
                            <label>Tempat Kegiatan</label>
                            <input type="text" name="tempat"value="{{ old('tempat',$pejabat->tempat) }}" 
                            class="form-control @error('tempat') is-invalid @enderror" id="exampleInputEmail1" 
                            placeholder="Masukan Telpon " required>
                            @error('tempat')
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
                    <div class="row">
                      <div class="col-12 col-sm-12">
                          <div class="form-group">
                              <label>Link Google Maps Tempat Kegiatan</label>
                              <input type="url" name="map" value="{{ old('map',$pejabat->map) }}"
                                  class="form-control @error('map') is-invalid @enderror" id="exampleInputEmail1"
                                  placeholder="Masukan Link Google Maps Tempat Kegiatan " required>
                              @error('map')
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
                    <div class="row">
                        <div class="col-12 col-sm-12">
                          <div class="form-group">
                            <label>Nama Kegiatan</label>
                            <textarea id="summernote" class="form-control content @error('nm_kegiatan',$pejabat->nm_kegiatan) is-invalid @enderror" name="nm_kegiatan" placeholder="Masukkan nama kegiatan" >

                            {{--  <textarea name="nm_kegiatan"  class="form-control @error('nm_kegiatan') is-invalid @enderror" id="exampleInputEmail1">  --}}

                                {!! old('nm_kegiatan',$pejabat->nm_kegiatan) !!}
                            </textarea>
                            @error('nm_kegiatan')
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
                    <div class="row">
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <label>Status Keterangan </label><br>
                            @if ($pejabat->sk == 0)                 
                     
                            <span class="badge badge-dark">Belum Ada keterangan</label>
                          
                            @else
                            @if ($pejabat->sk == 1)
                            <span class="badge badge-primary">Diterima/sudah di acc</label>
                                @elseif( $pejabat->sk == 2)
                                <span class="badge badge-success">Diwakilkan</label>
                                    @elseif( $pejabat->sk == 3)
                                    <span class="badge badge-secondary">Ditolak</label>
                                       
                                   
                              @endif
                            @endif
                          </div>
                          <!-- /.form-group -->
                        </div>
                       
                       
                      </div>
                      <input type="text" name="creator" hidden value="{{ Auth::user()->email }}">
                      <div class="row">
                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label>File Surat Undangan *format file pdf || max:2 MB</label>
                                <input type="file" name="file_surat" value="{{ old('file_surat') }}"
                                    class="form-control @error('file_surat') is-invalid @enderror" id="exampleInputEmail1"
                                    placeholder="Masukan Telpon " required>
                                @error('file_surat')
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
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label>File Rundown Acara *format file pdf || max:2 MB</label>
                                <input type="file" name="file_acara" value="{{ old('file_acara') }}"
                                    class="form-control @error('file_acara') is-invalid @enderror" id="exampleInputEmail1"
                                    placeholder="Masukan Telpon " required>
                                @error('file_acara')
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
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label>File Sambutan Untuk Pejabat *format file pdf || max:2 MB</label>
                                <input type="file" name="file_sambutan" value="{{ old('file_sambutan') }}"
                                    class="form-control @error('file_sambutan') is-invalid @enderror"
                                    id="exampleInputEmail1" placeholder="Masukan Telpon " required>
                                @error('file_sambutan')
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
                <!-- /.card-body -->
                <div class="card-footer">
                  
                  @if ($pejabat->sk == 0)
                  <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i>Update Data</button>                
                      @else                  
                  {{--  <a href="" target="_blank"  class="btn btn-outline-success"><i class="fa fa-print"></i>Print Surat Keterangan Domisili </a>  --}}
                         
                    @endif 

                  <a href="/ajuan-agenda"  class="btn btn-danger"><i class="fa fa-undo"></i>Kembali ke List</a>
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
