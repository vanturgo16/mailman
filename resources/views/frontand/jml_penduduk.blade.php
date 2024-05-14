@extends('layouts.suratonline.app')

@section('content')

<div class="content-header">
  <div class="container">
    <div class="row mb-2">
      <div class="col-sm-6">
        {{--  <h1 class="m-0"> Pengajuan <small>Surat Online</small></h1>  --}}
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Data Jumlah Penduduk</a></li>
          
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<div class="content">
  <div class="container">
    <div class="row">
  
      <!-- /.col-md-6 -->
      <div class="col-lg-12">
       

        <div class="card card-primary card-outline">
         
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                      
                         Data Jumlah Penduduk
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                
                  <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th scope="col" style="text-align: center;width: 6%">NO.</th>
                        
                            <th scope="col">Jumlah Laki-Laki</th>
                            <th scope="col">Jumlah Perempuan</th>
                            <th scope="col">Tahun</th>
                            
                            
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($jml as $no => $jml)
                            <tr>
                                <th scope="row" style="text-align: center">{{ ++$no}}</th>
                              
                               
                                <td>{{ $jml->jml_laki }}</td>
                                <td>{{ $jml->jml_perempuan }}</td>
                                <td>{{ $jml->th }}</td>
                               
                                
                             
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
    </div>
      </div>
      <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

@endsection