@extends('layouts.blackand.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-building"></i> Daftar Jenis Pengaduan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Daftar Jenis Pengaduan</li>
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
                                            <a href="#" data-toggle="modal" data-target="#modalAdd"><i class="fa fa-plus"></i> </a>
                                            Tambah Daftar Jenis Pengaduan
                                        </h3>

                                        <!-- Modal -->
                                        <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal fade" id="modalAdd" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="modalAddLabel">Tambah Daftar Jenis Pengaduan</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label class="text-danger">Kode jenis Pengaduan*</label>
                                                            <input type="text" class="form-control" id="" name="kode_pengaduan" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="text-danger">Nama jenis Pengaduan*</label>
                                                            <input type="text" class="form-control" id="" name="nama_pengaduan" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>keterangan</label>
                                                            <textarea class="form-control" id="" rows="2" name="keterangan"></textarea>
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
                                                    <th scope="col" style="text-align: center;width: 6%">No.</th>
                                                    <th scope="col">Kode Pengaduan</th>
                                                    <th scope="col">Nama Jenis Pengaduan</th>
                                                    <th scope="col">Tanggal Perubahan</th>
                                                    <th scope="col">Pengubah</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col" style="width: 15%;text-align: center">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($datas as $data)    
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $data->com_code }}</td>
                                                    <td>{{ $data->com_name }}</td>
                                                    <td>{{ $data->updated_at }}</td>
                                                    <td>{{ $data->created_by }}</td>
                                                    <td>
                                                        @if ($data->is_active == '1')
                                                            <label class="text text-success"><i>AKTIF</i></label>
                                                        @else
                                                            <label class="text text-danger"><i>TIDAK AKTIF</i></label>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editModal{{ $data->id }}">
                                                            Edit Data
                                                        </button>
                                                        
                                                        @if ($data->is_active == '1')
                                                            <form action="{{ route('pengaduan.destroy', $data->id) }}" method="POST" style="display:inline-block;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Yakin Hapus Jenis Pengaduan?')">Hapus Data</button>
                                                            </form>
                                                        @else
                                                            <form action="{{ url('/pengaduan/aktif', encrypt($data->id)) }}" method="POST" style="display:inline-block;">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-success btn-xs" onclick="return confirm('Yakin Aktifkan Jenis Pengaduan?')">Aktif Data</button>
                                                            </form>
                                                            {{-- <a href="{{ url('/gedung/aktif', encrypt($data->id)) }}" class="btn btn-success btn-xs" onclick="return confirm('Yakin Aktifkan Gedung?')">Aktif Data</a> --}}
                                                        @endif

                                                        <!-- Modal -->
                                                        <form action="{{ route('pengaduan.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal fade" id="editModal{{ $data->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                    <h5 class="modal-title" id="editModalLabel">Ubah Data Jenid Pengaduan</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label class="text-danger">Kode jenis Pengaduan*</label>
                                                                            <input type="text" class="form-control" id="" name="kode_pengaduan" value="{{ $data->com_code }}" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="text-danger">Nama jenis Pengaduan*</label>
                                                                            <input type="text" class="form-control" id="" name="nama_pengaduan" value="{{ $data->com_name }}" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>keterangan</label>
                                                                            <textarea class="form-control" id="" rows="2" name="keterangan">{{ $data->com_desc }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </td>
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
