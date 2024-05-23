@extends('layouts.blackand.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-building"></i> Daftar Gedung</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Daftar Gedung</li>
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
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <a href="#" data-toggle="modal" data-target="#modalAddGedung"><i class="fa fa-plus"></i> </a>
                                            Tambah Data Gedung
                                        </h3>

                                        <!-- Modal -->
                                        <form action="{{ route('gedung.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal fade" id="modalAddGedung" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalAddGedungLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="modalAddGedungLabel">Tambah Data Gedung</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Kode Gedung</label>
                                                            <input type="text" class="form-control" id="" name="" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Nama Gedung</label>
                                                            <input type="text" class="form-control" id="" name="" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Kapasitas (Lantai)</label>
                                                            <input type="number" min="1" class="form-control w-25" id="" name="" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Keterangan</label>
                                                            <textarea class="form-control" id="" rows="3"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">

                                        <table id="example3" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col" style="text-align: center;width: 6%">No.</th>
                                                    <th scope="col">Kode</th>
                                                    <th scope="col">Nama</th>
                                                    <th scope="col">Kapasitas</th>
                                                    <th scope="col" style="width: 15%;text-align: center">Aksi</th>
                                                </tr>
                                            </thead>
                                            @foreach ($gedungs as $data)    
                                            <tbody>
                                                <td>{{ $loop->iteration }}</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tbody>
                                            @endforeach
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
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
