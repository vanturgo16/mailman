@extends('layouts.suratonline.app')

@section('content')

<div class="content-header">
  <div class="container">
    <div class="row mb-2">
      <div class="col-sm-6">
        {{--  <h1 class="m-0"> Pengajuan <small>Surat Online</small></h1>  --}}
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Pengajuan Surat Online</a></li>
          
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<div class="content">
  <div class="container">
    <div class="row">
  
      <!-- /.col-md-6 -->
      <div class="col-lg-12">
       

        <div class="card card-primary card-outline">
          {{-- <div class="card-header">
            <h5 class="card-title m-0">Alur Kerja</h5>
          </div> --}}
          <div class="card-body">

            {{-- <p class="card-text">
              <input type="text" class="form-control" placeholder="Cari Berdasarkan Nama">
            </p>
            <a href="#" class="btn btn-primary">Cari Data</a> --}}
      
        <center>
        <img src="{{ asset('blackend/img_sk/alur.jpeg')}}" alt="">
      </center>
      </div>
    </div>
      </div>
      <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

@endsection