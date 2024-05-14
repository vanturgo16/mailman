@extends('layouts.suratonline.app')

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
                           
                            <div class="col px-4">
                              @forelse ($pindah as $p)
                              <div>
                                <div class="float-right"> waktu ajuan :{{ $p->created_at }}</div>
                                <h3>{{ $p->nm_kk }}</h3>
                                <p class="mb-0">RT.{{ $p->rt_asal }} RW.{{ $p->rw_asal }}
                                    Dusun {{ $p->desa_asal }}
                                </p>
                            </div>
                            <hr>    
                              @empty
                              <center>
                                <div class="alert alert-danger alert-dismissible">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                  <h5><i class="icon fas fa-ban"></i> Pesan!</h5>
                                 Data yaang anda cari tidak di temukan
                                </div> 
                              </center>
                              @endforelse
                               
                                
                               
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