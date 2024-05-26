@extends('layouts.blackand.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-building"></i> Daftar Lantai</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Daftar Lantai</li>
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
                                            <a href="#" data-toggle="modal" data-target="#modalAddLantai"><i class="fa fa-plus"></i> </a>
                                            Tambah Data Lantai
                                        </h3>

                                        <!-- Modal -->
                                        <form action="{{ route('lantai.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal fade" id="modalAddLantai" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalAddLantaiLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="modalAddLantaiLabel">Tambah Data Lantai</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="exampleFormControlSelect1">Nama Gedung</label>
                                                            <select class="form-control" id="nama_gedung" name="nama_gedung" required>
                                                                    <option value="">Pilih Gedung</option>
                                                                @foreach ($gedungs as $gedung)
                                                                    <option value="{{ $gedung->id }}">{{ $gedung->kode_gedung . "-" . $gedung->nama_gedung }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Kode Lantai</label>
                                                            <input type="text" class="form-control" id="" name="kode_lantai" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Nama Lantai</label>
                                                            <input type="text" class="form-control" id="" name="nama_lantai" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Kapasitas (Ruang)</label>
                                                            <input type="number" min="1" class="form-control w-25" id="" name="kapasitas" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Keterangan</label>
                                                            <textarea class="form-control" id="" rows="3" name="keterangan"></textarea>
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
                                                    <th scope="col">Nama Gedung</th>
                                                    <th scope="col">Kode</th>
                                                    <th scope="col">Nama</th>
                                                    <th scope="col">Kapasitas</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col" style="width: 15%;text-align: center">Aksi</th>
                                                </tr>
                                            </thead>
                                            @foreach ($lantais as $data)    
                                            <tbody>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->nama_gedung }}</td>
                                                <td>{{ $data->kode_lantai }}</td>
                                                <td>{{ $data->nama_lantai }}</td>
                                                <td>{{ $data->kapasitas_lantai . " Ruang" }}</td>
                                                <td>
                                                    @if ($data->is_active == '1')
                                                        <label class="text text-success"><i>AKTIF</i></label>
                                                    @else
                                                        <label class="text text-danger"><i>TIDAK AKTIF</i></label>
                                                    @endif
                                                </td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editModalLantai{{ $data->id }}">
                                                        Edit Data
                                                    </button>
                                                    
                                                    @if ($data->is_active == '1')
                                                        <form action="{{ route('lantai.destroy', $data->id) }}" method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Yakin Hapus lantai?')">Hapus Data</button>
                                                        </form>
                                                    @else
                                                        <form action="{{ url('/lantai/aktif', encrypt($data->id)) }}" method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Yakin Aktifkan lantai?')">Aktif Data</button>
                                                        </form>
                                                        {{-- <a href="{{ url('/gedung/aktif', encrypt($data->id)) }}" class="btn btn-success btn-xs" onclick="return confirm('Yakin Aktifkan Gedung?')">Aktif Data</a> --}}
                                                    @endif
                                                </td>
                                            </tbody>
                                            <!-- Modal -->
                                            <form action="{{ route('lantai.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal fade" id="editModalLantai{{ $data->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="editModalLantaiLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLantaiLabel">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="exampleFormControlSelect1">Nama Gedung</label>
                                                            <select class="form-control" id="nama_gedung" name="nama_gedung" required>
                                                                    <option value="">Pilih Gedung</option>
                                                                @foreach ($gedungs as $gedung)
                                                                    <option value="{{ $gedung->id }}" @if ($gedung->id == $data->id_gedung) selected @endif>{{ $gedung->kode_gedung . "-" . $gedung->nama_gedung }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Kode lantai</label>
                                                            <input type="text" class="form-control" value="{{ $data->kode_lantai }}" name="kode_lantai" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Nama lantai</label>
                                                            <input type="text" class="form-control" value="{{ $data->nama_lantai }}" name="nama_lantai" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Kapasitas (Ruang)</label>
                                                            <input type="number" min="1" class="form-control w-25" value="{{ $data->kapasitas_lantai }}" name="kapasitas" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Keterangan</label>
                                                            <textarea class="form-control" rows="3" name="keterangan">{{ $data->keterangan_lantai }}</textarea>
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
