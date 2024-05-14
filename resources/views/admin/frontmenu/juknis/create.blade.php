@extends('layouts.blackand.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        <a href="/data-juknis"> Data Juknis</a>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Juknis</li>
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
                                <h3 class="card-title">Form Juknis</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="/data-juknis" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Format file .pdf</label>
                                                <input type="text" name="operator" hidden
                                                    value="{{ Auth::user()->name }}">
                                                <input type="file" name="nm_file"value=""
                                                    class="form-control @error('nm_file') is-invalid @enderror"
                                                    id="exampleInputEmail1" placeholder="Masukan Judul Berita"
                                                    accept="application/pdf" required>
                                                @error('nm_file')
                                                    <div class="invalid-feedback" style="display: block">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <!-- /.form-group -->
                                            <div class="form-group">
                                                <label>Keterangan</label>
                                                <input type="text" name="judul_file" value="" class="form-control "
                                                    id="exampleInputEmail1" placeholder="Masukan Keterangan"
                                                    required="">
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->


                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>
                                            Simpan</button>
                                        <button type="reset" class="btn btn-danger"><i class="fa fa-undo"></i>
                                            Batal</button>
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
