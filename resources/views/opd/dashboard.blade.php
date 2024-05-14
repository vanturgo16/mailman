@extends('layouts.opd.app')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Profile User</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">User Profile</li>
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

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <div class="image">
                @if (Auth::user()->profile_photo_path!=null)
                <img src="{{ Storage::url('public/staff/'.Auth::user()->profile_photo_path.'') }}" class="img-thumbnail"
                    alt="{{ Auth::user()->name }}" />

                @else
                <img src="{{ asset('blackend/dist/img/avatar5.png')}}" class="img-circle elevation-2" alt="User Image">

                @endif

            </div>
            </div>

            <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

            <p class="text-muted text-center">{{ Auth::user()->phone }}
              {{ Auth::user()->email }}
            </p>

            {{--  <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
               <a href="">
                <center>
                <b>
                    {{ $profile->nm_opd }}

                </b> 
              </center>
            </a>
              </li>
             
            </ul>  --}}

            <a href="/profile/edit" class="btn btn-primary btn-block"><b>Edit Profil</b></a>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- About Me Box -->
     
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="card">
          <div class="card card-warning card-outline">
            <div class="card-header">
              <h3 class="card-title">
                <a href="/data-pesan">
                  @php
                  $tgl = date ('Y-m-d');
                  @endphp
               Pengajuan Hari ini <b>  {{hari_ini()}},
                  {{ dateIndonesia($tgl) }} </b></a></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Buku Agenda</th>
                  <th>No Agenda</th>
                  <th>No Surat</th>
                  <th>Tgl Surat</th>
                  <th>Status</th>
                  <th>penerima</th>
                  <th>Aksi</th>
                 
                </tr>
                </thead>
                <tbody>
                  @foreach ($agenda as $pesan)

                <tr>
                  <td>{{  $loop->iteration }}</td>
                  <td>
                    {{ $pesan->id_pejabat }}
                  <td>
                      {{ $pesan->nm_kegiatan }}
                  </td>
                  <td>{{ $pesan->tempat }}
                    @if ($pesan->map <> '')
                    <a href="{{ $pesan->map }}"
                       target="blank"  class="btn btn-xs btn-outline-primary"><span class="fas fa-map-marker-alt"></span> Link Maps</a>
                     
                      @else
                      @endif
                  </td>
                  <td>{{ $pesan->tgl }}
                   <b> {{ $pesan->jam_mulai }} - {{ $pesan->jam_selsai }}</b>
                  </td>

                  <td>
                    @if ($pesan->sk == 1)
                    <center><span class="badge badge-primary">Diterima</label></center>
                        @elseif( $pesan->sk == 2)
                        <center><span class="badge badge-success">Diwakilkan</label></center>
                            @elseif( $pesan->sk == 3)
                            <center><span class="badge badge-secondary">Ditolak</label></center>
                               
                           
                      @endif 
                  </td>
                  <td>
                     {{--  surat  --}}
                     @if ($pesan->file_surat <> '')
                     <center> <a href="{{ Storage::url('public/surat/'.$pesan->file_surat) }}"
                        target="blank"  class="badge badge-primary">surat</a>
                      </center>
                       @else
                       @endif

                       {{--  acara  --}}
                       @if ($pesan->file_acara <> '')
                     <center> <a href="{{ Storage::url('public/acara/'.$pesan->file_acara) }}"
                        target="blank"  class="badge badge-success">acara</a>
                      </center>
                       @else
                       @endif

                       {{--  sambutan  --}}
                       @if ($pesan->file_sambutan <> '')
                     <center> <a href="{{ Storage::url('public/sambutan/'.$pesan->file_sambutan) }}"
                        target="blank"  class="badge badge-danger">sambutan</a>
                      </center>
                       @else
                       @endif
                  </td>
                </tr>
                @endforeach


              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->


  </section>
@endsection
