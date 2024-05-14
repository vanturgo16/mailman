@extends('layouts.blackand.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        <a href="#"> Edit Sambutan
                    </h1></a>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Sambutan</li>
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
                                <h3 class="card-title">Form Edit <small>Sambutan</small></h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="/about-profil/update/{{ $sambutan->id }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('patch')

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Nama Kepala Desa</label>
                                                <input type="text" name="email" hidden
                                                    value="{{ Auth::user()->name }}">
                                                <input type="text"
                                                    name="nm_kep"value="{{ old('nm_kep', $sambutan->nm_kep) }}"
                                                    class="form-control @error('nm_kep') is-invalid @enderror"
                                                    id="exampleInputEmail1" placeholder="Masukan Judul Berita" required>
                                                @error('nm_kep')
                                                    <div class="invalid-feedback" style="display: block">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <!-- /.form-group -->
                                            <div class="form-group">

                                                <label>Foto Kades *format file jpeg,jpg,png || max:2000</label>
                                                <input type="file" name="foto"value="{{ old('foto') }}"
                                                    class="form-control @error('foto') is-invalid @enderror"
                                                    id="exampleInputEmail1" placeholder="Masukan Telpon ">
                                                <p></p>
                                                <img src="{{ Storage::url('public/staff/' . $sambutan->foto) }}"
                                                    style="width: 100px">

                                                @error('foto')
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
                                                <textarea id="summernote" class="form-control content @error('des') is-invalid @enderror" name="des" placeholder="Masukkan sambutan"
                                                    rows="5">
                              {!! old('des', $sambutan->des) !!}  
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

                                    {{--  <div class="row">
                                        <div class="col-12 col-sm-12">
                                            <div class="form-group">
                                                <label>Paragraf Selanjutnya</label>
                                                <textarea class="form-control content @error('des1') is-invalid @enderror" name="des1"
                                                    placeholder="Masukkan sambutan" rows="5">
                              {!! old('des1', $sambutan->des1) !!}  
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
                                    </div>  --}}
                                    <!-- /.row -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary"><i
                                            class="fa fa-paper-plane"></i>Simpan</button>
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
