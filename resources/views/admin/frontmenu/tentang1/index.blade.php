@extends('layouts.blackand.app')

@section('content')
<div class="row">
    <div class="col-12 col-sm-12">
      <div class="card card-primary card-outline">
        <div class="card-header p-0 pt-1">
          <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Sambutan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Visi & Misi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Sejarah Singkat</a>
            </li>
            {{--  <li class="nav-item">
              <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Potensi Alam</a>
            </li>  --}}
          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content" id="custom-tabs-one-tabContent">
            <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                <div class="input-group-prepend">
                    
                    <a href="/about-desa/edit/{{ $sambutan->id }}" class="btn btn-primary" style="padding-top: 10px;">
                        <i class="fa fa-edit"></i> Edit Sambutan</a>
                </div>
                <table id="example1"class="table table-bordered">
                    <tr>
                        <th>Foto</th>
                        <th>Nama </th>
                        <th>Isi Sambutan</th>
                        <th>Created_at</th>
                        <th>Operator</th>
                    </tr>
                    <tr>
                        <td>
                <img src="{{ Storage::url('public/staff/'.$sambutan->foto) }}" style="width: 100px">
    
                        </td>
                        <td>{{ $sambutan->nm_kep }}</td>
                        <td>{{ $sambutan->des }}</td>
                        <td>{{ $sambutan->created_at }}</td>
                        <td>{{ $sambutan->email }}</td>
                    </tr>
                    </table>
            </div>
            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                <div class="input-group-prepend">
                    
                    <a href="/about-desa/edit_visimisi/{{ $visi->id }}" class="btn btn-primary" style="padding-top: 10px;">
                        <i class="fa fa-edit"></i> Edit Visi & Misi</a>
                </div>
                <p></p>
                <table id="example1"class="table table-bordered">
                    <tr>
                      
                        <th>Visi</th>
                        <th>Misi</th>
                        <th>Created_at</th>
                        <th>Operator</th>
                    </tr>
                    <tr>
              
                        <td>{{ $visi->visi }}</td>
                        <td>{{ $visi->misi }}</td>
                        <td>{{ $visi->created_at }}</td>
                        <td>{{ $visi->email }}</td>
                    </tr>
                </table>
            </div>
            <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                <div class="input-group-prepend">
                    
                    <a href="/about-desa/edit_sejarah/{{ $sejarah->id }}" class="btn btn-primary" style="padding-top: 10px;">
                        <i class="fa fa-edit"></i> Sejarah Singkat</a>
                </div>
                <p></p>
                <table id="example1"class="table table-bordered">
                    <tr>
                      
                        <th>Deskripsi</th>
                        <th>Created_at</th>
                        <th>Operator</th>
                    </tr>
                    <tr>
              
                        <td>{{ $sejarah->des }}</td>
                        <td>{{ $sejarah->created_at }}</td>
                        <td>{{ $sejarah->email }}</td>
                    </tr>
                </table>
            </div>
            <div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
              <div class="input-group-prepend">
                    
                <a href="/about-desa/edit-potensi/{{ $potensi->id }}" class="btn btn-primary" style="padding-top: 10px;">
                    <i class="fa fa-edit"></i> Potensi Alam Desa</a>
            </div>
            <p></p>
            <table id="example1"class="table table-bordered">
                <tr>
                  
                    <th>Gambar</th>
                    <th>Deskripsi</th>
                    
                    <th>Batas Wilayah</th>
                    <th>Operator</th>
                </tr>
                <tr>
          
                    <td>
                <img src="{{ Storage::url('public/staff/'.$potensi->image) }}" style="width: 100px">

                    </td>
                    <td>{{ $potensi->des }}</td>
                    <td>
                    <b> Batas Utara</b> {{ $potensi->batas_utara }} <br>
                  <b>Batas Timur</b> {{ $potensi->batas_timur }} <br>
                <b> Batas Selatan</b> {{ $potensi->batas_selatan }} <br>
              <b> Batas Barat</b> {{ $potensi->batas_barat }} <br>

                    </td>
                    
                    <td>{{ $potensi->operator }}</td>
                </tr>
            </table>
            </div>
          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>
  
  </div>
@endsection
