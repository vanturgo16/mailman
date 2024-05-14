@extends('layouts.blackand.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Data Kegiatan Pimpinan</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Beranda</a></li>
            <li class="breadcrumb-item active">Data Kegiatan Pimpinan</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
<div class="row">

    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                  <a href="/agenda-pejabat"> 
         
                   Laporan Kegiatan Pimpinan </a> </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <table id="example1"class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col" style="text-align: center;width: 6%">No.</th>

                        <th scope="col">Pejabat</th>
                        <th scope="col">PJ</th>
                        <th scope="col">Nama Kegiatan</th>
                        <th scope="col">Tempat</th>
                        <th scope="col">Waktu</th>
                        <th scope="col">Sts</th>
                        <th scope="col">File</th>
                        <th scope="col">Updated</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($cari as $no => $staff)
                        <tr>
                            <th scope="row" style="text-align: center">{{ ++$no}}</th>

                            <td>{{ $staff->nm_pejabat }} <br>
                              <b>{{ $staff->nm_jabatan }}</b>
                            </td>
                            <td>{{ $staff->nm_opd }}</td>
                            <td>{{ $staff->nm_kegiatan }}</td>
                            <td>{{ $staff->tempat }}</td>
                            <td>{{ $staff->tgl }}
                              <br> {{ $staff->jam_mulai }} <b>sd</b> {{ $staff->jam_selsai }}</td>
                             
                            
                              <td>
                              @if ($staff->sk == 1)
                              <center><span class="badge badge-primary">Diterima</label></center>
                                  @elseif( $staff->sk == 2)
                                  <center><span class="badge badge-success">Diwakilkan</label></center>
                                      @elseif( $staff->sk == 3)
                                      <center><span class="badge badge-secondary">Ditolak</label></center>
                                         
                                     
                                @endif 

                                @if ($staff->status_t == 1)
                                <center><span class="badge badge-primary">Public</label></center>
                                    @elseif( $staff->sk == 2)
                                    <center><span class="badge badge-success">private</label></center>
                                        @elseif( $staff->sk == 0)
                                        <center><span class="badge badge-secondary">private</label></center>
                                           
                                       
                                  @endif

                              <td>
                                {{--  surat  --}}
                                @if ($staff->file_surat <> '')
                                <form action="/download-file-surat" method="post">
                                 @csrf
                                 <input type="hidden" name="file" value="{{$staff->file_surat}}">
                                 <center><button type="submit" class="btn btn-xs btn-primary"> surat</button></center>
                              </form>
                                  @else
                                  @endif

                                  {{--  acara  --}}
                                  @if ($staff->file_acara <> '')
                                  <form action="/download-file-acara" method="post">
                                   @csrf
                                   <input type="hidden" name="file" value="{{$staff->file_acara}}">
                                   <center><button type="submit" class="btn btn-xs btn-success"> acara</button></center>
                                </form>
                                  @else
                                  @endif

                                  {{--  sambutan  --}}
                                  @if ($staff->file_sambutan <> '')
                                  <form action="/download-file-sambutan" method="post">
                                   @csrf
                                   <input type="hidden" name="file" value="{{$staff->file_sambutan}}">
                                   <center><button type="submit" class="btn btn-xs btn-danger"> sambutan</button></center>
                                </form>
                                  @else
                                  @endif
                             </td>
                             
                             <td>{{ $staff->eksekutor }} <br>
                                {{ $staff->updated_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
  </div>
@endsection
