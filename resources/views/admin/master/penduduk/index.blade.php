@extends('layouts.blackand.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Data Jumlah Penduduk</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Jumlah Penduduk</li>
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
                  <a href="/data-jml-penduduk/create"><i class="fa fa-plus"></i> </a>
                    Tambah Data Jumlah Penduduk</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            
                <table id="example1"class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col" style="text-align: center;width: 6%">NO.</th>
                    
                        <th scope="col">Jumlah Laki-Laki</th>
                        <th scope="col">Jumlah Perempuan</th>
                        <th scope="col">Tahun</th>
                        
                        <th scope="col">Operator</th>
                        <th scope="col">Tgl Update</th>
                        <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($jml as $no => $jml)
                        <tr>
                            <th scope="row" style="text-align: center">{{ ++$no}}</th>
                          
                           
                            <td>{{ $jml->jml_laki }}</td>
                            <td>{{ $jml->jml_perempuan }}</td>
                            <td>{{ $jml->th }}</td>
                            <td>{{ $jml->operator }}</td>
                            <td>{{ $jml->updated_at }}</td>
                            
                            <td class="text-center">
                                {{--  @can('users.edit')  --}}
                                <form method="POST" class="d-inline" onsubmit="return confirm('Hapus Data?')" action="/data-jml-penduduk/{{ $jml->id }}/destroy">
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