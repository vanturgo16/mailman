@extends('layouts.blackand.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Kategori Ajuan</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Kategori Ajuan</li>
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
    
          <div class="card card-cyan card-outline">
            <div class="card-header">
              <h3 class="card-title">
                  <a href="/kategori/create"><i class="fa fa-plus"></i> </a>
                  Kategori Ajuan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            
                <table id="example1"class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col" style="text-align: center;width: 6%">NO.</th>
                        {{--  <th scope="col">NO INDUK</th>  --}}
                        <th scope="col">Nama Kategori</th>
                        <th scope="col">Status Ajuan</th>
                        <th scope="col" style="width: 15%;text-align: center">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($kategori as $no => $kat)
                        <tr>
                            <th scope="row" style="text-align: center">{{ ++$no}}</th>
                            {{--  <td>{{ $user->no_induk }}</td>  --}}
                            <td>{{ $kat->keterangan }}</td>
                            <td>
                              @if ($kat->status == 1)
                              <center><span class="badge badge-info">AKTIF</label></center>
                              @else
                              <center><span class="badge badge-danger">NON AKTIF</label></center>
                              @endif
                              </td>
                          
                            <td class="text-center">
                                {{--  @can('users.edit')  --}}
                                    <a href="/kategori/edit/{{$kat->id}}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-pen"></i>
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
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
  </div>
@endsection