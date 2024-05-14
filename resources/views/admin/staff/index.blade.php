@extends('layouts.blackand.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Data Staff</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Staff</li>
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
                  <a href="/data-staff/create"><i class="fa fa-plus"></i> </a>
                    Tambah Data Staff</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            
                <table id="example1"class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col" style="text-align: center;width: 6%">NO.</th>
                    
                        <th scope="col">Gambar</th>
                        <th scope="col">Nama</th>
                        <th scope="col">NIP</th>
                        <th scope="col">Email</th>
                        <th scope="col">Operator</th>
                        <th scope="col">Tgl Update</th>
                        <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($staff as $no => $staff)
                        <tr>
                            <th scope="row" style="text-align: center">{{ ++$no}}</th>
                          
                            <td>   <center>
                                <img src="{{ Storage::url('public/staff/'.$staff->image) }}" style="width: 100px">

                                </center>
                            </td>
                            <td>{{ $staff->name }}</td>
                            <td>{{ $staff->nip }}</td>
                            <td>{{ $staff->email }}</td>
                            <td>{{ $staff->operator }}</td>
                            <td>{{ $staff->updated_at }}</td>
                            
                            <td class="text-center">
                                {{--  @can('users.edit')  --}}
                                    <a href="/data-staff/edit/{{ $staff->id}}" class="btn btn-xs btn-primary">
                                        <i class="fa fa-pen"></i>Edit
                                    </a>
                                {{--  @endcan  --}}
                                
                                {{--  @can('users.delete')  --}}
                                <form method="POST" class="d-inline" onsubmit="return confirm('Hapus Data?')" action="/data-staff/{{ $staff->id }}/destroy">
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