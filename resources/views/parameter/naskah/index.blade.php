@extends('layouts.blackand.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-building"></i> Daftar Jenis Naskah Dinas</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Daftar Jenis Naskah Dinas</li>
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
                                            Tambah Daftar Jenis Naskah Dinas
                                        </h3>

                                        <!-- Modal -->
                                        <form action="{{ route('naskah.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal fade" id="modalAdd" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="modalAddLabel">Tambah Daftar Jenis Naskah Dinas</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label class="text-danger">Kode Naskah Dinas*</label>
                                                            <input type="text" class="form-control" id="" name="kode_naskah" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="text-danger">Nama Naskah Dinas*</label>
                                                            <input type="text" class="form-control" id="" name="nama_naskah" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Keterangan</label>
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
                                                    <th scope="col">Kode Naskah Dinas</th>
                                                    <th scope="col">Nama Naskah Dinas</th>
                                                    <th scope="col">Tipe Penomoran</th>
                                                    <th scope="col">Tanggal Perubahan</th>
                                                    <th scope="col">Pengubah</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col" style="width: 15%;text-align: center"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($datas as $data)    
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $data->let_code }}</td>
                                                    <td>{{ $data->let_name }}</td>
                                                    <td>{{ $data->pat_type }}</td>
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
                                                        <div class="dropdown">
                                                            <button class="btn btn-xs btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                                                Pilih Aksi
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="text-primary dropdown-item" href="{{ url('/pattern/create/'.encrypt($data->id)) }}"><i class="far fa-file-alt"></i> Penomeran Surat Keluar</a>
                                                                <a class="text-primary dropdown-item" data-toggle="modal" data-target="#editModal{{ $data->id }}"><i class="far fa-edit"></i> Edit Data</a>
                                                                @if ($data->is_active == '1')
                                                                    <form action="{{ route('naskah.destroy', $data->id) }}" method="POST" style="display:inline-block;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="text-danger dropdown-item" onclick="return confirm('Yakin Hapus Naskah Dinas?')"><i class="far fa-times-circle"></i> Hapus Data</button>
                                                                    </form>
                                                                @else
                                                                    <form action="{{ url('/naskah/aktif', encrypt($data->id)) }}" method="POST" style="display:inline-block;">
                                                                        @csrf
                                                                        @method('PATCH')
                                                                        <button type="submit" class="text-success dropdown-item" onclick="return confirm('Yakin Aktifkan Naskah Dinas?')"><i class="far fa-check-circle"></i> Aktif Data</button>
                                                                    </form>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <!-- Modal -->
                                                        <form action="{{ route('naskah.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal fade" id="editModal{{ $data->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                    <h5 class="modal-title" id="editModalLabel">Ubah Data Naskah Dinas</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label class="text-danger">Kode Naskah Dinas*</label>
                                                                            <input type="text" class="form-control" id="" name="kode_naskah" value="{{ $data->let_code }}" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="text-danger">Nama Naskah Dinas*</label>
                                                                            <input type="text" class="form-control" id="" name="nama_naskah" value="{{ $data->let_name }}" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Keterangan</label>
                                                                            <textarea class="form-control" id="" rows="2" name="keterangan">{{ $data->let_desc }}</textarea>
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
