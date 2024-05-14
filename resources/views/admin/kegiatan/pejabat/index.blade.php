@extends('layouts.blackand.app')

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
                      <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Data Ajuan </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Sudah Di Proses</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false">Ditolak</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-settings" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false">Laporan Ajuan </a>
                    </li>
                  </ul>
                </div>
                <div class="card-body">
                  <div class="tab-content" id="custom-tabs-three-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">
                              <a href="/create-agenda-pejabat"><i class="fa fa-plus"></i> </a>
                                Tambah Data Ajuan Penomeran Surat</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <table id="example1"class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col" style="text-align: center;width: 2%">NO</th>
                                
                                    <th scope="col">Agenda</th>
                                    <th scope="col">No.Surat</th>
                                    <th scope="col">Perihal</th>
                                    <th scope="col">Penerima</th>
                                    <th scope="col">Tgl.Surat</th>
                                    <th scope="col"style="width: 10%;text-align: center">File</th>
                                    <th scope="col" style="width: 8%;text-align: center">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($pejabat as $no => $staff)
                                    <tr>
                                        <th scope="row" style="text-align: center">{{ ++$no}}</th>

                                        <td>
                                          {{ $staff->nm_pejabat }} <br>
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
                                          </td>
                                          <td>

                                          {{--  surat  --}}
                                            @if ($staff->file_surat <> '')
                                            <form action="/download-file-surat" method="post">
                                              @csrf
                                              <input type="hidden" name="file" value="{{$staff->file_surat}}">
                                              <center><button type="submit" class="btn btn-xs btn-primary"> surat</button>
                                              {{--  <a href="" data-toggle="modal" data-target="#modal-default"><span class="fa fa-xs fa-edit"></span></a>  --}}
                                             
                                            </center>
                                           </form>
                                            @else
                                            @endif

                                            {{--  acara  --}}
                                            {{--  @if ($staff->file_acara <> '')
                                            <form action="/download-file-acara" method="post">
                                              @csrf
                                              <input type="hidden" name="file" value="{{$staff->file_acara}}">
                                              <center><button type="submit" class="btn btn-xs btn-success"> acara</button>
                                               
                                              </center>
                                           </form>
                                         
                                            @else
                                            @endif  --}}

                                            {{--  sambutan  --}}
                                            {{--  @if ($staff->file_sambutan <> '')
                                            <form action="/download-file-sambutan" method="post">
                                              @csrf
                                              <input type="hidden" name="file" value="{{$staff->file_sambutan}}">
                                              <center><button type="submit" class="btn btn-xs btn-danger"> sambutan</button>
                                               
                                              </center>
                                           </form>
                                          
                                            @else
                                            @endif  --}}
                                          </td>
                                        <td class="text-center">
                                          @php              
                                          $id=Crypt::encryptString($staff->id);                                         
                                          @endphp

                                            {{--  @can('users.edit')  --}}
                                            <a href="/agenda-pejabat/edit/{{ $id}}" class="btn btn-xs btn-outline-primary">
                                                <i class="fa fa-check" title="Lihat & Update Status Ajuan"></i> 
                                            </a>
                                            <a href="edit/file/{{ $id}}" class="btn btn-xs btn-outline-success">
                                              <i class="fa fa-edit" title="Edit File"></i> 
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
                    <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">
                              <a href="/create-agenda-pejabat"><i class="fa fa-check"></i> </a>
                                 Data Agenda Kegiatan Pejabat</h3>
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
                                    <th scope="col">Perihal</th>
                                    <th scope="col">Penerima</th>
                                    <th scope="col">Tgl.Surat</th>
                                
                                    <th scope="col">File</th>
                                    <th scope="col" style="width: 8%;text-align: center">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($ag_proses as $no => $staff)
                                    <tr>
                                        <th scope="row" style="text-align: center">{{ ++$no}}</th>

                                        <td>
                                          {{ $staff->nm_pejabat }} <br>
                                          <b>{{ $staff->nm_jabatan }}</b>

                                         
                                          @if( $staff->sk == 2)
                                         <span class="badge badge-success">Diwakilkan oleh : <br>{{ $staff->id_wakil }}  </label>
                                           
                                            @endif  
                                      

                                        </td>
                                        {{--  <td><b>{{ $staff->pendamping }}</b></td>  --}}

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
                                                @else
                                                <center><span class="badge badge-success">private</label></center>
                                               
                                                   
                                              @endif
                                        </td>

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
                                        <td class="text-center">


                                            {{--  @can('users.edit')  --}}
                                            <a href="/agenda-pejabat/edit/{{ $staff->id}}" class="btn btn-xs btn-info">
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
                    <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">
                              <a href="/create-agenda-pejabat"><i class="fa fa-close"></i> </a>
                                 Data Agenda Kegiatan Pejabat <b>Ditolak</b></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <table id="example4"class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col" style="text-align: center;width: 2%">NO</th>


                                    <th scope="col">Pejabat</th>
                                    {{--  <th scope="col">Pendamping</th>  --}}

                                    <th scope="col">Agenda</th>
                                    <th scope="col">No.Surat</th>
                                    <th scope="col">Perihal</th>
                                    <th scope="col">Penerima</th>
                                    <th scope="col">Tgl.Surat</th>
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
                                        {{--  <td><b>{{ $staff->pendamping }}</b></td>  --}}

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
                                        </td>

                                        <td>
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
                                        </td>
                                        <td class="text-center">


                                            {{--  @can('users.edit')  --}}
                                            <a href="/agenda-pejabat/edit/{{ $staff->id}}" class="btn btn-xs btn-info">
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
                    <div class="tab-pane fade" id="custom-tabs-three-settings" role="tabpanel" aria-labelledby="custom-tabs-three-settings-tab">
                       {{--  Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.  --}}
                   <form action="cari-agenda" method="POST" enctype="multipart/form-data">
                @csrf

                    <input type="date" name="tgl_awal">
                    <input type="date" name="tgl_akhir">

                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i>Lihat Data</button>
                   </form>
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
  {{--  modal start ada 3 modal  --}}
{{--  modal surat  --}}
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <form action="/agenda-pejabat/update/" method="POST" enctype="multipart/form-data">
      @csrf
      @method('patch')
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Surat Undangan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>
          <div class="form-group">
            <label>File Surat Undangan *format file pdf || max:2 MB</label>
            <input type="file" name="file_surat"value="{{ old('file_surat') }}" 
            class="form-control @error('file_surat') is-invalid @enderror" id="exampleInputEmail1" 
            placeholder="Masukan Telpon " required>
            @error('file_surat')
            <div class="invalid-feedback" style="display: block">
                {{ $message }}
            </div>
            @enderror
          </div>
        </p>
      </div>
      <div class="modal-footer justify-content-between">
        {{--  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  --}}
        <button type="button" class="btn btn-primary">Update</button>
      </div>
    </div>
    <!-- /.modal-content -->
    </form>
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
{{--  modal surat  --}}
{{--  modal and  --}}
@endsection
