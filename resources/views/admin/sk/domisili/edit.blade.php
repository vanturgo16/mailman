@extends('layouts.blackand.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">
           <a href="/domisili"> Surat Keterangan Domisili</h1></a>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Surat Keterangan Domisili</li>
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
                <h3 class="card-title">Form Edit <small>Surat Keterangan Domisili</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/domisili/update/{{ $domisili->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('patch')

                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Nama Lengkap</label>
                          <input type="text" name="operator" hidden value="{{ Auth::user()->name }}">
                          <input type="text" name="nama"value="{{ old('nama',$domisili->nama) }}" 
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
                            @if($domisili->jk == $jenis->kode)
                                                
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
                          <input type="text" name="tempat"value="{{ old('tempat',$domisili->tempat) }}" 
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
                          <input type="text" name="tgl"value="{{ old('tgl',$domisili->tgl) }}" 
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
                                @if($domisili->agama == $agama->kode)
                                                    
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
                          <label>Negara</label>
                          <div class="select2-purple">
                            <input type="text" name="negara"value="{{ old('negara',$domisili->negara) }}" 
                            class="form-control @error('negara') is-invalid @enderror" id="exampleInputEmail1" 
                            placeholder="Masukan negara" required>
                            @error('negara')
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
                            <label>Pekerjaan</label>
                            <input type="text" name="pekerjaan"value="{{ old('pekerjaan',$domisili->pekerjaan) }}" 
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
                        <div class="col-12 col-sm-12">
                          <div class="form-group">
                            <label>Alamat</label>
                            <div class="select2-purple">
                            
                              <input type="text" name="alamat"value="{{ old('alamat',$domisili->alamat) }}" 
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
                  <a href="/domisili/show/{{$domisili->id}}" target="_blank"  class="btn btn-outline-success"><i class="fa fa-print"></i>Print Surat Keterangan Domisili </a>
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

    <script type="text/javascript">
 
      $('.show_confirm').click(function(event) {
           var form =  $(this).closest("form");
           var name = $(this).data("name");
           event.preventDefault();
           swal({
               title: `Are you sure you want to delete this record?`,
               text: "If you delete this, it will be gone forever.",
               icon: "warning",
               buttons: true,
               dangerMode: true,
           })
           .then((willDelete) => {
             if (willDelete) {
               form.submit();
             }
           });
       });
   
  </script>
@endsection
