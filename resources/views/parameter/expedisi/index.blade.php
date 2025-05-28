@extends('layouts.blackand.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-building"></i> Daftar Ekspedisi</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Daftar Ekspedisi</li>
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
                                        {{-- <h3 class="card-title">
                                            <a href="#" data-toggle="modal" data-target="#modalAdd"><i class="fa fa-plus"></i> </a>
                                            Tambah Daftar Instansi
                                        </h3> --}}

                                        <!-- Modal -->
                                        {{-- <form action="{{ route('instansi.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal fade" id="modalAdd" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="modalAddLabel">Tambah Daftar Instansi</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label class="text-danger">Nama Instansi*</label>
                                                            <input type="text" class="form-control" id="" name="nama_instansi" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Alamat</label>
                                                            <textarea class="form-control" id="" rows="2" name="alamat" required></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Kode Pos</label>
                                                            <input type="text" class="form-control" id="" name="kode_pos" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Telepon</label>
                                                            <input type="text" class="form-control" id="" name="telepon" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Fax</label>
                                                            <input type="text" class="form-control" id="" name="fax">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </form> --}}
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <!-- Notifikasi menggunakan flash session data -->
                                        @if (session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('success') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @endif

                                        @if (session('fail'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ session('fail') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @endif
                                        <table id="example3" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Tanggal</th>
                                                    <th scope="col">Nomor Surat</th>
                                                    <th scope="col">Kepada</th>
                                                    <th scope="col">Perihal</th>
                                                    <th scope="col">Penerima</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($datas as $data)    
                                                <tr>
                                                    <td>{{ $data->created_at ? $data->created_at->format('Y-m-d') : '' }}</td> <!-- Tanggal surat -->
                                                    <td>{{ $data->mail_number }}</td>
                                                    <td>{{ $data->receiver }}</td> <!-- Asumsi 'Kepada' adalah 'Penerima' -->
                                                    <td>{{ strip_tags(html_entity_decode($data->mail_regarding)) }}</td> <!-- Perihal surat -->
                                                    <td>{{ $data->receiver }}</td> <!-- Nama penerima surat -->
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
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </div>
    @endsection
