@extends('layouts.opd.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Data Ajuan Penomeran Surat</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Beranda</a></li>
            <li class="breadcrumb-item active">Data Ajuan Penomeran Surat</li>
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

          <div class="row">
            <div class="col-12 col-sm-12">
              <div class="card card-primary card-outline card-tabs">
                <div class="card-header p-0 pt-1 border-bottom-0">
                  <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Ajuan Penomeran Surat</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Sudah Di Proses</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false">Ditolak</a>
                    </li>
                    <li class="nav-item">
                      {{--  <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-settings" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false">Settings</a>  --}}
                    </li>
                  </ul>
                </div>
                <div class="card-body">
                  <div class="tab-content" id="custom-tabs-three-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">
                              <a href="/create-ajuan-agenda"><i class="fa fa-edit"></i> </a>
                                Tambah Data Ajuan </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <table id="example1"class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col" style="text-align: center;width: 2%">NO</th>


                                    <th scope="col">Agenda</th>
                                    <th scope="col">No.Surat</th>
                                    <th scope="col">Tgl.Surat</th>
                                    <th scope="col">Penerima</th>
                                    <th scope="col">Perihal</th>
                                    <th scope="col">Sts</th>
                                    <th scope="col">File</th>
                                    {{--  <th scope="col">Status</th>  --}}
                                    <th scope="col" style="width: 8%;text-align: center">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($pejabat as $no => $staff)
                                    <tr>
                                        <th scope="row" style="text-align: center">{{ ++$no}}</th>

                                        <td>{{ $staff->nm_pejabat }} <br>
                                          <b>{{ $staff->nm_jabatan }}</b>
                                        </td>
                                        {{--  <td><b>{{ $staff->pendamping }}</b></td>  --}}

                                        <td>{{ $staff->nm_opd }}</td>
                                        <td>{{ $staff->nm_kegiatan }}</td>
                                        <td>{{ $staff->tempat }}
                                          @if ($staff->map <> '')
                                          <a href="{{ $staff->map }}"
                                             target="blank"  class="btn btn-xs btn-primary"><span class="fas fa-map-marker-alt"></span> Link Maps</a>
                                           
                                            @else
                                            @endif
                                        </td>
                                        <td>{{ $staff->tgl }}
                                          <br> {{ $staff->jam_mulai }} <b>sd</b> {{ $staff->jam_selsai }}</td>
                                          <td>

                                          {{--  surat  --}}
                                            @if ($staff->file_surat <> '')
                                            <form action="/download-opd-surat" method="post">
                                              @csrf
                                              <input type="hidden" name="file" value="{{$staff->file_surat}}">
                                              <center><button type="submit" class="btn btn-xs btn-primary"> surat</button></center>
                                           </form>
                                            @else
                                            @endif

                                            {{--  acara  --}}
                                            @if ($staff->file_acara <> '')
                                            <form action="/download-opd-acara" method="post">
                                              @csrf
                                              <input type="hidden" name="file" value="{{$staff->file_acara}}">
                                              <center><button type="submit" class="btn btn-xs btn-success"> acara</button></center>
                                           </form>
                                            @else
                                            @endif

                                            {{--  sambutan  --}}
                                            @if ($staff->file_sambutan <> '')
                                            <form action="/download-opd-sambutan" method="post">
                                              @csrf
                                              <input type="hidden" name="file" value="{{$staff->file_sambutan}}">
                                              <center><button type="submit" class="btn btn-xs btn-danger"> sambutan</button></center>
                                           </form>
                                            @else
                                            @endif
                                          </td>
                                        <td class="text-center">

                                          
                                            {{--  @can('users.edit')  --}}
                                            <a href="/ajuan-agenda/edit/{{ $staff->id}}"  class="btn btn-xs btn-outline-info">
                                                <i class="fa fa-check"></i> Lihat
                                            </a>
                                         
                                            {{--  @endcan  --}}

                                            {{--  @can('users.delete')  --}}
                                            {{--  <form method="POST" class="d-inline" onsubmit="return confirm('Hapus Data?')" action="/pejabat/{{ $staff->id }}/destroy">
                                              @csrf
                                              <input type="hidden" value="DELETE" name="_method">
                                              <button type="submit" value="Delete" class="btn btn-xs btn-danger">
                                                <i class="fas fa-trash"></i> Hapus</button>
                                          </form>  --}}
                                            {{--  @endcan  --}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                      </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">
                              <a href="/create-agenda-pejabat"><i class="fa fa-check"></i> </a>
                                 Data Ajuan Penomeran Surat</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <table id="example3"class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col" style="text-align: center;width: 2%">NO</th>


                                    <th scope="col">Pejabat</th>
                                    {{--  <th scope="col">Pendamping</th>  --}}

                                    <th scope="col">Agenda</th>
                                    <th scope="col">No.Surat</th>
                                    <th scope="col">Tgl.Surat</th>
                                    <th scope="col">Penerima</th>
                                    <th scope="col">Perihal</th>
                                    <th scope="col">Sts</th>
                                    <th scope="col">File</th>
                                    <th scope="col" style="width: 8%;text-align: center">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($ag_proses as $no => $staff)
                                    <tr>
                                        <th scope="row" style="text-align: center">{{ ++$no}}</th>

                                        <td>
                                          @if($staff->id_wakil <> 0)
                                          {{ $staff->id_wakil }}
                                          @else
                                          {{ $staff->nm_pejabat }} <br>
                                          <b>{{ $staff->nm_jabatan }}</b>
                                         @endif 
                                        </td>
                                        {{--  <td><b>{{ $staff->pendamping }}</b></td>  --}}

                                        <td>{{ $staff->nm_opd }}</td>
                                        <td>{{ $staff->nm_kegiatan }}</td>
                                        <td>{{ $staff->tempat }}
                                          @if ($staff->map <> '')
                                          <a href="{{ $staff->map }}"
                                             target="blank"  class="btn btn-xs btn-primary"><span class="fas fa-map-marker-alt"></span> Link Maps</a>
                                           
                                            @else
                                            @endif
                                        </td>
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
                                                @else
                                                <center><span class="badge badge-success">private</label></center>
                                               
                                                   
                                              @endif
                                        </td>

                                        <td>
                                           {{--  surat  --}}
                                           @if ($staff->file_surat <> '')
                                           <center> <a href="{{ Storage::url('public/surat/'.$staff->file_surat) }}"
                                              target="blank"  class="badge badge-primary">surat</a>
                                            </center>
                                             @else
                                             @endif
 
                                             {{--  acara  --}}
                                             @if ($staff->file_acara <> '')
                                           <center> <a href="{{ Storage::url('public/acara/'.$staff->file_acara) }}"
                                              target="blank"  class="badge badge-success">acara</a>
                                            </center>
                                             @else
                                             @endif
 
                                             {{--  sambutan  --}}
                                             @if ($staff->file_sambutan <> '')
                                           <center> <a href="{{ Storage::url('public/sambutan/'.$staff->file_sambutan) }}"
                                              target="blank"  class="badge badge-danger">sambutan</a>
                                            </center>
                                             @else
                                             @endif
                                        </td>
                                        <td class="text-center">

                                            <a href="/ajuan-agenda/edit/{{ $staff->id}}"  class="btn btn-xs btn-outline-info">
                                                <i class="fa fa-check"></i> Lihat
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                      </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">
                              <a href="/create-agenda-pejabat"><i class="fa fa-close"></i> </a>
                                 Data Ajuan Penomeran Surat<b>Ditolak</b></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <table id="example4"class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col" style="text-align: center;width: 2%">NO</th>


                                    <th scope="col">Agenda</th>
                                    <th scope="col">No.Surat</th>
                                    <th scope="col">Tgl.Surat</th>
                                    <th scope="col">Penerima</th>
                                    <th scope="col">Perihal</th>
                                    <th scope="col">Sts</th>
                                    <th scope="col">File</th>
                                    <th scope="col" style="width: 8%;text-align: center">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($ag_tolak as $no => $staff)
                                    <tr>
                                        <th scope="row" style="text-align: center">{{ ++$no}}</th>

                                        <td>{{ $staff->nm_pejabat }} <br>
                                          <b>{{ $staff->nm_jabatan }}</b>
                                        </td>
                                     

                                        <td>{{ $staff->nm_opd }}</td>
                                        <td>{{ $staff->nm_kegiatan }}</td>
                                        <td>{{ $staff->tempat }}
                                          @if ($staff->map <> '')
                                          <a href="{{ $staff->map }}"
                                             target="blank"  class="btn btn-xs btn-primary"><span class="fas fa-map-marker-alt"></span> Link Maps</a>
                                           
                                            @else
                                            @endif
                                        </td>
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
                                        </td>

                                        <td>

                                          {{--  surat  --}}
                                            @if ($staff->file_surat <> '')
                                            <form action="/download-opd-surat" method="post">
                                              @csrf
                                              <input type="hidden" name="file" value="{{$staff->file_surat}}">
                                              <center><button type="submit" class="btn btn-xs btn-primary"> surat</button></center>
                                           </form>
                                            @else
                                            @endif

                                            {{--  acara  --}}
                                            @if ($staff->file_acara <> '')
                                            <form action="/download-opd-acara" method="post">
                                              @csrf
                                              <input type="hidden" name="file" value="{{$staff->file_acara}}">
                                              <center><button type="submit" class="btn btn-xs btn-success"> acara</button></center>
                                           </form>
                                            @else
                                            @endif

                                            {{--  sambutan  --}}
                                            @if ($staff->file_sambutan <> '')
                                            <form action="/download-opd-sambutan" method="post">
                                              @csrf
                                              <input type="hidden" name="file" value="{{$staff->file_sambutan}}">
                                              <center><button type="submit" class="btn btn-xs btn-danger"> sambutan</button></center>
                                           </form>
                                            @else
                                            @endif
                                          </td>
                                        <td class="text-center">


                                            {{--  @can('users.edit')  --}}
                                            <a href="/agenda-pejabat/edit/{{ $staff->id}}" class="btn btn-xs btn-outline-info">
                                                <i class="fa fa-check"></i> Lihat
                                            </a>
                                         
                                            {{--  @endcan  --}}

                                           
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                      </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-settings" role="tabpanel" aria-labelledby="custom-tabs-three-settings-tab">
                       Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                    </div>
                  </div>
                </div>
                <!-- /.card -->
              </div>
            </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
  </div>
@endsection
