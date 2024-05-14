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
          </div>
            <div class="card-body">
            
                <table id="example5"class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col" style="text-align: center;width: 6%">NO.</th>
                        {{--  <th scope="col">NO INDUK</th>  --}}
                        <th scope="col">Nama </th>
                        <th scope="col">Email</th>
                        <th scope="col">Prihal</th>
                        <th scope="col" style="width: 15%;text-align: center">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($pesan_trash as $no => $kat)
                        <tr>
                            <th scope="row" style="text-align: center">{{ ++$no}}</th>
                            
                            <td>{{ $kat->nama }}</td>
                            <td>{{ $kat->email }}</td>
                            <td>{{ $kat->subjek }}</td>
                        
                          
                            <td class="text-center">
                               
                                  
                                     <form method="POST" action="/pesan-trash/{{ $kat->id }}/restore" class="d-inline">
                                        @csrf
                                        <button type="submit" value="Restore" class="btn btn-xs btn-success"/>
                                        Restor <i class="fas fa-undo"></i>
                                    </form>
                                   

                                  <form method="POST" class="d-inline" onsubmit="return confirm('Hapus Permanen?')" action="/pesan-trash/{{ $kat->id }}/delete-permanent">
                                    @csrf
                                    <input type="hidden" value="DELETE" name="_method">
                                    <button type="submit" value="Delete" class="btn btn-xs btn-danger">
                                      <i class="fas fa-trash-alt"></i> Hapus </button>
                                </form>
                               
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
         
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
