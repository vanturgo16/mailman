@extends('layouts.blackand.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">
           <a href="/domisili"> Profil Aplikasi</h1></a>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Profil Aplikasi</li>
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
                <h3 class="card-title">Form Edit <small>Profil Aplikasi</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/profildesa/update" method="POST" enctype="multipart/form-data">
                @csrf
                @method('patch')

                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Nama Aplikasi</label>
                          <input type="text" name="operator" hidden value="{{ Auth::user()->name }}">
                          <input type="text" name="nm_desa"value="{{ old('nm_desa',$profil_desa->nm_desa) }}" 
                      class="form-control @error('nm_desa') is-invalid @enderror" id="exampleInputEmail1" 
                      placeholder="Masukan Nama Desa" required>
                      @error('nm_desa')
                      <div class="invalid-feedback" style="display: block">
                          {{ $message }}
                      </div>
                      @enderror
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group">
                          <label>Nomer Telpon</label>
                          <input type="text" name="tlpn"value="{{ old('tlpn',$profil_desa->tlpn) }}" 
                      class="form-control @error('tlpn') is-invalid @enderror" id="exampleInputEmail1" 
                      placeholder="Masukan Telpon " required>
                      @error('tlpn')
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
                          <label>Email</label>
                          <input type="text" name="email"value="{{ old('email',$profil_desa->email) }}" 
                          class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" 
                          placeholder="Masukan email lahir" required>
                          @error('email')
                          <div class="invalid-feedback" style="display: block">
                              {{ $message }}
                          </div>
                          @enderror
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group">
                          <label>Facebook</label>
                          <input type="text" name="fb"value="{{ old('fb',$profil_desa->fb) }}" 
                          class="form-control @error('fb') is-invalid @enderror" id="exampleInputEmail1" 
                          placeholder="Masukan fb lahir" required>
                          @error('fb')
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
                          <label>Kecamatan</label>
                          <input type="text" name="kecamatan"value="{{ old('kecamatan',$profil_desa->kecamatan) }}" 
                          class="form-control @error('kecamatan') is-invalid @enderror" id="exampleInputEmail1" 
                          placeholder="Masukan kecamatan lahir" required>
                          @error('kecamatan')
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
                          <label>Instagram</label>
                          <div class="select2-purple">
                            <input type="text" name="ig"value="{{ old('ig',$profil_desa->ig) }}" 
                            class="form-control @error('ig') is-invalid @enderror" id="exampleInputEmail1" 
                            placeholder="Masukan ig" required>
                            @error('ig')
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
                          <label>Kabupaten/Kota</label>
                          <input type="text" name="kota_kab"value="{{ old('kota_kab',$profil_desa->kota_kab) }}" 
                          class="form-control @error('kota_kab') is-invalid @enderror" id="exampleInputEmail1" 
                          placeholder="Masukan kota_kab lahir" required>
                          @error('kota_kab')
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
                          <label>Twitter</label>
                          <div class="select2-purple">
                            <input type="text" name="tw"value="{{ old('tw',$profil_desa->tw) }}" 
                            class="form-control @error('tw') is-invalid @enderror" id="exampleInputEmail1" 
                            placeholder="Masukan tw" required>
                            @error('tw')
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
                          <label>Kode Pos</label>
                          <input type="text" name="kd_pos"value="{{ old('kd_pos',$profil_desa->kd_pos) }}" 
                          class="form-control @error('kd_pos') is-invalid @enderror" id="exampleInputEmail1" 
                          placeholder="Masukan kd_pos " required>
                          @error('kd_pos')
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
                          <label>Youtube</label>
                          <div class="select2-purple">
                            <input type="text" name="youtube"value="{{ old('youtube',$profil_desa->youtube) }}" 
                            class="form-control @error('youtube') is-invalid @enderror" id="exampleInputEmail1" 
                            placeholder="Masukan youtube" required>
                            @error('youtube')
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
                            <label>Provinsi</label>
                            <input type="text" name="provinsi"value="{{ old('provinsi',$profil_desa->provinsi) }}" 
                            class="form-control @error('provinsi') is-invalid @enderror" id="exampleInputEmail1" 
                            placeholder="Masukan provinsi" required>
                            @error('provinsi')
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
                            <label>Alamat Lengkap</label>
                            <div class="select2-purple">
                              <textarea class="form-control content @error('alamat') is-invalid @enderror" name="alamat" placeholder="Masukkan Alamat lengkap" rows="10">{{ old('alamat',$profil_desa->alamat) }}</textarea>
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
                  <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i>Update</button>
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
