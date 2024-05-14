@extends('layouts.blackand.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Detail Pesan Warga</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Detail Pesan Warga</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Folder</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <ul class="nav nav-pills flex-column">
                <li class="nav-item active">
                  <a href="/data-pesan" class="nav-link">
                    <i class="fas fa-inbox"></i> Inbox
                    <span class="badge bg-primary float-right"></span>
                  </a>
                </li>
           
                <li class="nav-item">
                  <a href="/pesan-trash" class="nav-link">
                    <i class="far fa-trash-alt"></i> Trash
                  </a>
                </li>
              </ul>
            </div>
            <!-- /.card-body -->
          </div>
        
        </div>
        <!-- /.col -->
      <div class="col-md-9">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">Detail Pesan </h3>

            <div class="card-tools">
              <a href="#" class="btn btn-tool" title="Previous"><i class="fas fa-chevron-left"></i></a>
              <a href="#" class="btn btn-tool" title="Next"><i class="fas fa-chevron-right"></i></a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <div class="mailbox-read-info">
              <h5>{{ $warga->nama }}</h5>
              <h6>{{ $warga->email }}
                <span class="mailbox-read-time float-right">Waktu Pengiriman {{ $warga->updated_at }}</span></h6>
            </div>
            <!-- /.mailbox-read-info -->
           
            <!-- /.mailbox-controls -->
            <div class="mailbox-read-message">
              <p>Hello {{ $profil_desa->nm_desa }},</p>

              <p>
                  {{ $warga->pesan }}
              </p>

             

                           <p>Thanks,<br>{{ $profil_desa->nm_desa }}</p>
            </div>
            <!-- /.mailbox-read-message -->
          </div>

          <div class="card-footer">
            <div class="float-right">
              <a href="/" class="btn btn-default"><i class="fas fa-reply"></i> Reply</a>
            </div>
            <form method="POST" class="d-inline" onsubmit="return confirm('Masukan ke tempat sampah?')" action="/data-pesan/{{ $warga->id }}/destroy">
              @csrf
              <input type="hidden" value="DELETE" name="_method">
              <button type="submit" value="Delete" class="btn btn-default">
                <i class="fas fa-trash-alt"></i> Hapus </button>
          </form>
         
          </div>
          <!-- /.card-footer -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection
