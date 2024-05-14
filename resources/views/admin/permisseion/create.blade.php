
@extends('layouts.blackand.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Create Permission</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Create Permission</li>
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
                  <h3 class="card-title">Form <small>Create Permission</small></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="/permission" method="POST" enctype="multipart/form-data">
                    @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Permission</label>
                      <input type="text" name="name"value="{{ old('name') }}" 
                      class="form-control @error('title') is-invalid @enderror" id="exampleInputEmail1" 
                      placeholder="Masukan Nama Permission">
                      @error('name')
                      <div class="invalid-feedback" style="display: block">
                          {{ $message }}
                      </div>
                      @enderror
                    </div>
                    
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i>Submit</button>
                    <button type="reset" class="btn btn-danger"><i class="fa fa-undo"></i>Reset</button>
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