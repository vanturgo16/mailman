@extends('layouts.blackand.app')

@section('content')
 <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Surat Keterangan Domisili</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Surat Keterangan Domisili</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <div class="row">
  
    <div class="col-12 col-sm-12">
      <div class="card card-default card-tabs">
        <div class="card-header p-0 pt-1">
          <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
            
            <li class="nav-item">
              <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Pengajuan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Sudah di Proses</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill" href="#custom-tabs-two-messages" role="tab" aria-controls="custom-tabs-two-messages" aria-selected="false">Tempat Sampah</a>
            </li>
            {{--  <li class="nav-item">
              <a class="nav-link" id="custom-tabs-two-settings-tab" data-toggle="pill" href="#custom-tabs-two-settings" role="tab" aria-controls="custom-tabs-two-settings" aria-selected="false">Settings</a>
            </li>  --}}
          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content" id="custom-tabs-two-tabContent">
            <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
              
             {{--  Table Data Ajuan Surat Online   --}}
             
                <div class="card-body">
                
                    <table id="example3"class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col" style="text-align: center;width: 6%">NO.</th>
                            
                            <th scope="col">Ayah</th>
                            <th scope="col">Ibu</th>
                            <th scope="col">Nama Anak</th>
                            <th scope="col">Nama Calon</th>
                        
                          
                            <th scope="col" style="width: 15%;text-align: center">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($menikah as $no => $kat)
                            <tr>
                                <th scope="row" style="text-align: center">{{ ++$no}}</th>
                             
                                <td>
                                    {{ $kat->nama_ayah }}<br> <b> Bin </b><br>
                                    {{ $kat->bin_ayah }}<br>
                                    {{ $kat->nik_ayah }}<br>

                                </td>
                                <td>
                                    {{ $kat->nama_ibu }}<br> <b> Bin </b><br>
                                    {{ $kat->bin_ibu }}<br>
                                    {{ $kat->nik_ibu }}
                                </td>
                                <td>
                                    {{ $kat->nama_anak }}<br>
                                     <b> Bin </b><br>
                                    {{ $kat->bin_anak }}<br>
                                    {{ $kat->nik_anak }}
                                </td>
                                <td>
                                    {{ $kat->nama_dgn }}<br>
                                     <b> Bin </b><br>
                                    {{ $kat->bin_dgn }}<br>
                                    {{ $kat->nik_dgn }}
                                </td>
                           
                               
                               
                              
                                <td class="text-center">
                                    {{--  @can('users.edit')  --}}
                                  
                        {{--  <a href="/menikah/show/{{$kat->id}}" rel="noopener" target="_blank" class="btn btn-xs btn-default">
                          <i class="fas fa-print"></i> Print
                        </a>  --}}

                          <a href="/menikah/edit/{{$kat->id}}" class="btn btn-xs btn-info">
                             <i class="fa fa-check"></i> Lihat
                          </a>

                          <form method="POST" class="d-inline" onsubmit="return confirm('Masukan ke tempat sampah?')" action="/menikah/{{ $kat->id }}/destroy">
                            @csrf
                            <input type="hidden" value="DELETE" name="_method">
                            <button type="submit" value="Delete" class="btn btn-xs btn-danger">
                              <i class="fas fa-trash"></i> Hapus </button>
                        </form>

                        
                                        
                                    {{--  @endcan  --}}
                                    
                                   
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
              

            </div>
            <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
              
              
                <div class="card-body">
                
                    <table id="example1"class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col" style="text-align: center;width: 6%">NO.</th>
                            
                            <th scope="col">Ayah</th>
                            <th scope="col">Ibu</th>
                            <th scope="col">Nama Anak</th>
                            <th scope="col">Nama Calon</th>
                            <th scope="col">Tgl & Petugas</th>
                          
                            <th scope="col" style="width: 15%;text-align: center">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($menikah_ok as $no => $kat)
                            <tr>
                                <th scope="row" style="text-align: center">{{ ++$no}}</th>
                             
                                <td>
                                    {{ $kat->nama_ayah }}<br> <b> Bin </b><br>
                                    {{ $kat->bin_ayah }}<br>
                                    {{ $kat->nik_ayah }}<br>
                                </td>
                             
                                <td>
                                    {{ $kat->nama_ibu }}<br> <b> Bin </b><br>
                                    {{ $kat->bin_ibu }}<br>
                                    {{ $kat->nik_ibu }}
                                </td>
                                <td>
                                    {{ $kat->nama_anak }}<br>
                                    <b> Bin </b><br>
                                   {{ $kat->bin_anak }}<br>
                                   {{ $kat->nik_anak }}

                                </td>
                                <td>
                                    {{ $kat->nama_dgn }}<br> <b> Bin </b><br>
                                    {{ $kat->bin_dgn }}<br>
                                    {{ $kat->nik_dgn }}

                                </td>
                                <td>{{ $kat->updated_at }} {{ $kat->operator }}</td>                            
                                                             
                                <td class="text-center">
                                    {{--  @can('users.edit')  --}}
                                    <a href="/menikah/edit/{{$kat->id}}" class="btn btn-xs btn-info">
                                      <i class="fa fa-check"></i> Lihat
                                   </a>
                                   
                                   <form method="POST" class="d-inline" onsubmit="return confirm('Masukan ke tempat sampah?')" action="/menikah/{{ $kat->id }}/destroy">
                                    @csrf
                                    <input type="hidden" value="DELETE" name="_method">
                                    <button type="submit" value="Delete" class="btn btn-xs btn-danger">
                                      <i class="fas fa-trash"></i> Hapus </button>
                                </form>
                                        
                                    {{--  @endcan  --}}

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
              
            </div>
            <div class="tab-pane fade" id="custom-tabs-two-messages" role="tabpanel" aria-labelledby="custom-tabs-two-messages-tab">
           
           {{--  tempat sampeh  --}}
           <div class="card-body">
                
            <table id="example4"class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col" style="text-align: center;width: 6%">NO.</th>
                    
                    <th scope="col">Ayah</th>
                    <th scope="col">Ibu</th>
                    <th scope="col">Nama Anak</th>
                    <th scope="col">Nama Calon</th>
                    <th scope="col">Tgl Hapus</th>
                  
                    <th scope="col" style="width: 15%;text-align: center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($menikah_trash as $no => $kat)
                    <tr>
                        <th scope="row" style="text-align: center">{{ ++$no}}</th>
                     
                        <td>
                            {{ $kat->nama_ayah }}<br> <b> Bin </b><br>
                            {{ $kat->bin_ayah }}<br>
                            {{ $kat->nik_ayah }}<br>
                        </td>
                     
                        <td>
                            {{ $kat->nama_ibu }}<br> <b> Bin </b><br>
                            {{ $kat->bin_ibu }}<br>
                            {{ $kat->nik_ibu }}
                        </td>
                        <td>
                            {{ $kat->nama_anak }}<br>
                            <b> Bin </b><br>
                           {{ $kat->bin_anak }}<br>
                           {{ $kat->nik_anak }}

                        </td>
                        <td>
                            {{ $kat->nama_dgn }}<br> <b> Bin </b><br>
                            {{ $kat->bin_dgn }}<br>
                            {{ $kat->nik_dgn }}

                        </td>
                       
                        <td>{{ $kat->deleted_at }} {{ $kat->operator }}</td>

                        <td class="text-center">
                          <form method="POST" action="/menikah/{{ $kat->id }}/restore" class="d-inline">
                            @csrf
                            <button type="submit" value="Restore" class="btn btn-xs btn-success"/>
                            Restor <i class="fas fa-undo"></i>
                        </form>
                        
                        <form method="POST" action="/menikah/{{ $kat->id }}/delete-permanent" class="d-inline" onsubmit="return confirm('
                          Hapus data ini secara permanen ?')">
                          @csrf
                          <input type="hidden" name="_method" value="DELETE">
                          <button type="submit" value="Delete" class="btn btn-xs btn-danger">
                          Hapus Permanen <i class="fas fa-trash-alt"></i></button>
                      </form>
                           
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
            </div>
            <div class="tab-pane fade" id="custom-tabs-two-settings" role="tabpanel" aria-labelledby="custom-tabs-two-settings-tab">
               Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
            </div>
          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
<div class="row">
      
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
         
          <!-- /.card -->
    
        
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
  </div>
@endsection