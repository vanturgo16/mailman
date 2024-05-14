@extends('layouts.blackand.app')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Pengajuan Benner</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Pengajuan Benner</li>
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
     
        <!-- /.card -->

        <!-- About Me Box -->
     
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-12">
        <div class="card">
          <div class="card card-warning card-outline">
            <div class="card-header">
              <h3 class="card-title">
                <a href="/create-adm-benner">
                  @php
                  $tgl = date ('Y-m-d');
                  @endphp
                 <span class="fa fa-edit"></span> List Pengajuan Benner</a>
                
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>File</th>
                  <th>Judul</th>
                  <th>Des</th>
                  <th>Catatn</th>
                  <th>Status</th>
                  <th>Updated</th>
                  <th>Aksi</th>
                  
                </tr>
                </thead>
                <tbody>

                    @foreach ($benner as $b)
                        
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                  @if($b->image <> '')
                  <center> <a href="{{ Storage::url('public/benner/'.$b->image) }}"
                    target="blank"  class="btn btn-app bg-info">
                    <i class="fas fa-image"></i>Lihat Gambar</a>
                  
                  </center>
                    @else
                    -
                  @endif
                 
                </td>
                <td>{{ $b->title }}</td>
                <td>{{ $b->des }}</td>
                <td>{{ $b->catatan }}</td>
                <td>
                  @if($b->status == 1)
                  <a href="" class="badge badge-primary">disetujui</a>
                @elseif($b->status ==2)
                  <a href="" class="badge badge-warning">Revisi</a>
                  @elseif($b->status ==0)
                
                  <center>-</center>
                   
                  @endif
                
                </td>
                <td>{{ $b->updated_at }}</td>
                <td>
                    <a href="http://" class="btn btn-info">Edit</a>
                  @if($b->status == 0)

                  <form method="POST" class="d-inline" 
                  onsubmit="return confirm('Data akan di hapus permanen?')" 
                  action="/adm-benner/{{ $b->id }}/destroy">
                    @csrf
                    <input type="hidden" value="DELETE" name="_method">
                    <button type="submit" value="Delete" class="btn btn-xs btn-danger">
                      <i class="fas fa-trash"></i> Hapus</button>
                </form>
                    @else
                    <button type="button" disabled>Not Delete</button>
                  @endif
                </td>
              </tr>
              @endforeach

                </tbody>


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
