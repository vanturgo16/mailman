@extends('layouts.blackand.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-building"></i> Master Dropdown</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Master Dropdown</li>
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
                                            Tambah Dropdown
                                        </h3>

                                        <!-- Modal -->
                                        <form action="{{ route('dropdown.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal fade" id="modalAdd" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="modalAddLabel">Tambah Dropdown</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label class="text-danger">Kategori*</label>
                                                            <input type="text" class="form-control" name="category" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="text-danger">Value*</label>
                                                            <input type="text" class="form-control" name="name_value" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="text-danger">Kode*</label>
                                                            <input type="text" class="form-control" name="code_format" required>
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
                                                    <th scope="col">Kategori</th>
                                                    <th scope="col">Value</th>
                                                    <th scope="col">Kode</th>
                                                    <th scope="col">Tanggal Perubahan</th>
                                                    <th scope="col" style="width: 15%;text-align: center">Aksi</th>
                                                </tr>
                                            </thead>
                                            @foreach ($datas as $data)    
                                            <tbody>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->category }}</td>
                                                <td>{{ $data->name_value }}</td>
                                                <td>{{ $data->code_format }}</td>
                                                <td>{{ $data->updated_at }}</td>
                                                <td class="text-center">
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editModal{{ $data->id }}">
                                                        Edit Data
                                                    </button>
                                                    {{-- <form action="{{ route('dropdown.destroy', $data->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Yakin Hapus Dropdown?')">Hapus Data</button>
                                                    </form> --}}

                                                    <!-- Modal -->
                                                    <form action="{{ route('dropdown.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal fade" id="editModal{{ $data->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title" id="editModalLabel">Ubah Dropdown</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label class="text-danger">Kategori*</label>
                                                                        <input type="text" class="form-control" name="category" value="{{ $data->category }}" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="text-danger">Value*</label>
                                                                        <input type="text" class="form-control" name="name_value" value="{{ $data->name_value }}" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="text-danger">Kode*</label>
                                                                        <input type="text" class="form-control" name="code_format" value="{{ $data->code_format }}" required>
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
