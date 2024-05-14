
@extends('layouts.blackand.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Data Permission</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                <li class="breadcrumb-item active">Data Permission</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- jquery validation -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Form Data Permission</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="/role" method="POST" enctype="multipart/form-data">
                    @csrf
                  <div class="card-body">
                    <div class="form-group mb-0">
                      <label for="exampleInputEmail1">Nama Role</label>
                      <input type="text" name="name"value="{{ old('name') }}"
                      class="form-control @error('title') is-invalid @enderror" id="exampleInputEmail1"
                      placeholder="Masukan Nama Role">
                      @error('name')
                      <div class="invalid-feedback" style="display: block">
                          {{ $message }}
                      </div>
                      @enderror
                    </div>



                    <div class="form-group mb-0">
                        <label class="font-weight-bold">Permission</label>
                        @foreach ($permissions as $permission)

                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" class="custom-control-input" id="exampleCheck1-{{ $permission->id }}">
                        <label class="custom-control-label" for="exampleCheck1-{{ $permission->id }}">{{ $permission->name }} <a href="#"></label>

                        </div>
                        @endforeach
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    <button type="reset" class="btn btn-danger"><i class="fa fa-undo"></i> Batal</button>
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
