@extends('layouts.blackand.app')

@section('content')
<div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
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
<section class="content">
    <div class="container-fluid">
        <div class="row">
            
        </div>
        <div class="row mt-3">
            <div class="col-md-10 offset-md-1">
                <div class="list-group">
                    <div class="list-group-item">
                        <div class="row">
                           
                            <div class="modal-body">
                              <form action="/cari-arsip/cari" method="GET">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="start_date">
                                    <input type="text" class="form-control" name="end_date">
                                    <button class="btn btn-primary" type="submit">GET</button>
                                </div>
                            </form>
                            </div>

                        </div>
                    </div>
                 
                   
                </div>
            </div>
        </div>
    </div>
</section>
</div>


@endsection