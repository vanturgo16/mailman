@extends('layouts.blackand.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                    <a href="/ajuan-benner"> Form Benner</h1></a>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Form Benner</li>
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
                            <h3 class="card-title">Form <small>Benner</small></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="/adm-benner" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="card-body">
              
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="form-group">
                            <label>Judul Benner</label>
                            <input type="text" name="title" value="{{ old('title') }}"
                                class="form-control @error('title') is-invalid @enderror" id="exampleInputEmail1"
                                placeholder="Masukan Judul Benner " required>
                            @error('title')
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
                            <label>Deskripsi</label>
                            <textarea name="des" class="form-control @error('des') is-invalid @enderror"
                                id="exampleInputEmail1"></textarea>
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
                <!-- /.row -->
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="form-group">
                            <label>File Gambar Spanduk/Benner *format file jpg,jpeg,png || max:2 MB</label>
                            <input type="file" name="image" value="{{ old('image') }}"
                                class="form-control @error('image') is-invalid @enderror" id="exampleInputEmail1"
                                placeholder="Masukan Telpon " required>
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
