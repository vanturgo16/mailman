@extends('layouts.blackand.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">
           <a href="#"> Edit Potensi Alam</h1></a>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Potensi Alam</li>
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
                <h3 class="card-title">Form Edit  <small>Potensi Alam</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/about-profil/update-potensi/{{ $potensi->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('patch')

                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Batas Utara</label>
                          <input type="text" name="batas_utara"value="{{ old('batas_utara',$potensi->batas_utara) }}" 
                      class="form-control @error('batas_utara') is-invalid @enderror" id="exampleInputEmail1" 
                      placeholder="Masukan Judul Berita" required>
                      @error('batas_utara')
                      <div class="invalid-feedback" style="display: block">
                          {{ $message }}
                      </div>
                      @enderror
                        </div>
                        <div class="form-group">
                            <label>Batas Timur</label>
                            <input type="text" name="batas_timur"value="{{ old('batas_timur',$potensi->batas_timur) }}" 
                        class="form-control @error('batas_timur') is-invalid @enderror" id="exampleInputEmail1" 
                        placeholder="Masukan Judul Berita" required>
                        @error('batas_timur')
                        <div class="invalid-feedback" style="display: block">
                            {{ $message }}
                        </div>
                        @enderror
                          </div>

                          <div class="form-group">
                            <label>Batas Selatan</label>
                            <input type="text" name="batas_selatan"value="{{ old('batas_selatan',$potensi->batas_selatan) }}" 
                        class="form-control @error('batas_selatan') is-invalid @enderror" id="exampleInputEmail1" 
                        placeholder="Masukan Judul Berita" required>
                        @error('batas_selatan')
                        <div class="invalid-feedback" style="display: block">
                            {{ $message }}
                        </div>
                        @enderror
                          </div>

                          <div class="form-group">
                            <label>Batas Barat</label>
                            <input type="text" name="batas_barat"value="{{ old('batas_barat',$potensi->batas_barat) }}" 
                        class="form-control @error('batas_barat') is-invalid @enderror" id="exampleInputEmail1" 
                        placeholder="Masukan Judul Berita" required>
                        @error('batas_barat')
                        <div class="invalid-feedback" style="display: block">
                            {{ $message }}
                        </div>
                        @enderror
                          </div>
                        <!-- /.form-group -->
                        <div class="form-group">

                          <label>Foto Kades *format file jpeg,jpg,png || max:2000</label>
                          <input type="file" name="image"value="{{ old('image') }}" 
                      class="form-control @error('image') is-invalid @enderror" id="exampleInputEmail1" 
                      placeholder="Masukan Telpon " >
                      <p></p>
                <img src="{{ Storage::url('public/staff/'.$potensi->image) }}" style="width: 100px">

                      @error('image')
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
                            <label>Hanya Isi Paragrap pertama</label>
                            <textarea  class="form-control content @error('des') is-invalid @enderror" name="des" placeholder="Masukkan sambutan" rows="5">
                              {!! old('des',$potensi->des) !!}  
                            </textarea>
                            @error('des')
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

                      <div class="row">
                        <div class="col-12 col-sm-12">
                          <div class="form-group">
                            <label>Paragraf Selanjutnya</label>
                            <textarea  class="form-control content @error('des1') is-invalid @enderror" name="des1" placeholder="Masukkan sambutan" rows="5">
                              {!! old('des1',$potensi->des1) !!}  
                            </textarea>
                            @error('des1')
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
                  <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i>Simpan</button>
                  <button type="reset" class="btn btn-danger"><i class="fa fa-undo"></i>Batal</button>
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
