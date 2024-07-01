@extends('layouts.blackand.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-building"></i> Daftar Baris</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Daftar Baris</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
                                            Tambah Daftar Baris
                                        </h3>

                                        <!-- Modal -->
                                        <form action="{{ route('baris.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal fade" id="modalAdd" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="modalAddLabel">Tambah Data Baris</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Nama Gedung</label>
                                                            <select class="form-control" id="nama_gedung" name="nama_gedung">
                                                                    <option value="">Pilih Gedung</option>
                                                                @foreach ($gedungs as $gedung)
                                                                    <option value="{{ $gedung->id }}">{{ $gedung->kode_gedung . "-" . $gedung->nama_gedung }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Nama Lantai</label>
                                                            <select class="form-control" id="nama_lantai" name="nama_lantai">
                                                                <option value="">Pilih Lantai</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Nama Ruang</label>
                                                            <select class="form-control" id="nama_ruang" name="nama_ruang">
                                                                <option value="">Pilih Ruang</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="text-danger">Nama Rak*</label>
                                                            <select class="form-control" id="nama_rak" name="nama_rak" required>
                                                                <option value="">Pilih Rak</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="text-danger">Kode Baris*</label>
                                                            <input type="text" class="form-control" id="" name="kode_baris" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="text-danger">Nama Baris*</label>
                                                            <input type="text" class="form-control" id="" name="nama_baris" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="text-danger">Kapasitas (Kolom)*</label>
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
                                        <table id="server-side-table" class="table table-bordered" style="font-size: small" width="100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col" style="text-align: center;width: 6%">No.</th>
                                                    <th scope="col">Gedung</th>
                                                    <th scope="col">Lantai</th>
                                                    <th scope="col">Ruang</th>
                                                    <th scope="col">Rak</th>
                                                    <th scope="col">Kode Baris</th>
                                                    <th scope="col">Nama Baris</th>
                                                    <th scope="col">Tanggal Perubahan</th>
                                                    <th scope="col">Pengubah</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col" style="width: 15%;text-align: center">Aksi</th>
                                                </tr>
                                            </thead>
                                            @foreach ($datas as $data)    
                                            <tbody>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->nama_gedung }}</td>
                                                <td>{{ $data->nama_lantai }}</td>
                                                <td>{{ $data->nama_ruang }}</td>
                                                <td>{{ $data->nama_rak }}</td>
                                                <td>{{ $data->kode_baris }}</td>
                                                <td>{{ $data->nama_baris }}</td>
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
                                                        <form action="{{ route('baris.destroy', $data->id) }}" method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Yakin Hapus baris?')">Hapus Data</button>
                                                        </form>
                                                    @else
                                                        <form action="{{ url('/baris/aktif', encrypt($data->id)) }}" method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-success btn-xs" onclick="return confirm('Yakin Aktifkan baris?')">Aktif Data</button>
                                                        </form>
                                                        {{-- <a href="{{ url('/gedung/aktif', encrypt($data->id)) }}" class="btn btn-success btn-xs" onclick="return confirm('Yakin Aktifkan Gedung?')">Aktif Data</a> --}}
                                                    @endif

                                                    <!-- Modal -->
                                                    <form action="{{ route('baris.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal fade" id="editModal{{ $data->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title" id="editModalLabel">Edit Data Rak</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label>Nama Gedung</label>
                                                                        <select class="form-control" id="nama_gedung2" name="nama_gedung">
                                                                                <option value="">Pilih Gedung</option>
                                                                            @foreach ($gedungs as $gedung)
                                                                                <option value="{{ $gedung->id }}" @if ($gedung->id == $data->id_gedung)selected @endif>{{ $gedung->kode_gedung . "-" . $gedung->nama_gedung }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Nama Lantai</label>
                                                                        <select class="form-control" id="nama_lantai2" name="nama_lantai">
                                                                            <option value="{{ $data->id_lantai }}">{{ $data->nama_lantai }}</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Nama Ruang</label>
                                                                        <select class="form-control" id="nama_ruang2" name="nama_ruang2" required>
                                                                            <option value="{{ $data->id_ruang }}">{{ $data->nama_ruang }}</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="text-danger">Nama Rak*</label>
                                                                        <select class="form-control" id="nama_rak2" name="nama_rak" required>
                                                                            <option value="{{ $data->id_rak }}">{{ $data->nama_rak }}</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="text-danger">Kode Baris*</label>
                                                                        <input type="text" class="form-control" id="" name="kode_baris" value="{{ $data->kode_baris }}" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="text-danger">Nama baris*</label>
                                                                        <input type="text" class="form-control" id="" name="nama_baris" value="{{ $data->nama_baris }}" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="text-danger">Kapasitas (Kolom)*</label>
                                                                        <input type="number" min="1" class="form-control w-25" id="" name="kapasitas" value="{{ $data->kapasitas_baris }}" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Keterangan</label>
                                                                        <textarea class="form-control" id="" rows="3" name="keterangan">{{ $data->keterangan_baris }}</textarea>
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
    
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            $('#nama_gedung').change(function() {
                var table = $('#server-side-table').DataTable({
                    "scrollX": true,
                });

                var gedungId = $(this).val();
                var url = '{{ route("mappingLantai", ":id") }}';
                url = url.replace(':id', gedungId);
                if(gedungId) {
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            //console.log("AJAX Success Data:", gedungId); // Debugging
                            $('#nama_lantai').empty();
                            $('#nama_ruang').empty();
                            $('#nama_rak').empty();
                            $('#nama_lantai').append('<option value="">Pilih Lantai</option>');
                            $('#nama_ruang').append('<option value="">Pilih Ruang</option>');
                            $('#nama_rak').append('<option value="">Pilih Rak</option>');
                            $.each(data, function(key, value) {
                                $('#nama_lantai').append('<option value="' + value.id + '">' + value.kode_lantai + '-' + value.nama_lantai + '</option>');
                            });
                        }
                    });
                } else {
                    $('#nama_lantai').empty();
                    $('#nama_ruang').empty();
                    $('#nama_rak').empty();
                    $('#nama_lantai').append('<option value="">Pilih Lantai</option>');
                    $('#nama_ruang').append('<option value="">Pilih Ruang</option>');
                    $('#nama_rak').append('<option value="">Pilih Rak</option>');
                }
            });

            $('#nama_lantai').change(function() {
                var lantaiId = $(this).val();
                var url = '{{ route("mappingRuang", ":id") }}';
                url = url.replace(':id', lantaiId);
                if(lantaiId) {
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            //console.log("AJAX Success Data:", gedungId); // Debugging
                            $('#nama_ruang').empty();
                            $('#nama_rak').empty();
                            $('#nama_ruang').append('<option value="">Pilih Ruang</option>');
                            $('#nama_rak').append('<option value="">Pilih Rak</option>');
                            $.each(data, function(key, value) {
                                $('#nama_ruang').append('<option value="' + value.id + '">' + value.kode_ruang + '-' + value.nama_ruang + '</option>');
                            });
                        }
                    });
                } else {
                    $('#nama_ruang').empty();
                    $('#nama_rak').empty();
                    $('#nama_ruang').append('<option value="">Pilih Ruang</option>');
                    $('#nama_rak').append('<option value="">Pilih Rak</option>');
                }
            });

            $('#nama_ruang').change(function() {
                var ruangId = $(this).val();
                var url = '{{ route("mappingRak", ":id") }}';
                url = url.replace(':id', ruangId);
                if(ruangId) {
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            //console.log("AJAX Success Data:", gedungId); // Debugging
                            $('#nama_rak').empty();
                            $('#nama_rak').append('<option value="">Pilih Rak</option>');
                            $.each(data, function(key, value) {
                                $('#nama_rak').append('<option value="' + value.id + '">' + value.kode_rak + '-' + value.nama_rak + '</option>');
                            });
                        }
                    });
                } else {
                    $('#nama_rak').empty();
                    $('#nama_rak').append('<option value="">Pilih Rak</option>');
                }
            });

            $('#nama_gedung2').change(function() {
                var gedungId = $(this).val();
                var url = '{{ route("mappingLantai", ":id") }}';
                url = url.replace(':id', gedungId);
                if(gedungId) {
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            //console.log("AJAX Success Data:", gedungId); // Debugging
                            $('#nama_lantai2').empty();
                            $('#nama_ruang2').empty();
                            $('#nama_rak2').empty();
                            $('#nama_lantai2').append('<option value="">Pilih Lantai</option>');
                            $('#nama_ruang2').append('<option value="">Pilih Ruang</option>');
                            $('#nama_rak2').append('<option value="">Pilih Rak</option>');
                            $.each(data, function(key, value) {
                                $('#nama_lantai2').append('<option value="' + value.id + '">' + value.kode_lantai + '-' + value.nama_lantai + '</option>');
                            });
                        }
                    });
                } else {
                    $('#nama_lantai2').empty();
                    $('#nama_ruang2').empty();
                    $('#nama_rak2').empty();
                    $('#nama_lantai2').append('<option value="">Pilih Lantai</option>');
                    $('#nama_ruang2').append('<option value="">Pilih Ruang</option>');
                    $('#nama_rak2').append('<option value="">Pilih Rak</option>');
                }
            });

            $('#nama_lantai2').change(function() {
                var lantaiId = $(this).val();
                var url = '{{ route("mappingRuang", ":id") }}';
                url = url.replace(':id', lantaiId);
                if(lantaiId) {
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            //console.log("AJAX Success Data:", gedungId); // Debugging
                            $('#nama_ruang2').empty();
                            $('#nama_rak2').empty();
                            $('#nama_ruang2').append('<option value="">Pilih Ruang</option>');
                            $('#nama_rak2').append('<option value="">Pilih Rak</option>');
                            $.each(data, function(key, value) {
                                $('#nama_ruang2').append('<option value="' + value.id + '">' + value.kode_ruang + '-' + value.nama_ruang + '</option>');
                            });
                        }
                    });
                } else {
                    $('#nama_ruang2').empty();
                    $('#nama_rak2').empty();
                    $('#nama_ruang2').append('<option value="">Pilih Ruang</option>');
                    $('#nama_rak2').append('<option value="">Pilih Rak</option>');
                }
            });

            $('#nama_ruang2').change(function() {
                var ruangId = $(this).val();
                var url = '{{ route("mappingRak", ":id") }}';
                url = url.replace(':id', ruangId);
                if(ruangId) {
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            //console.log("AJAX Success Data:", gedungId); // Debugging
                            $('#nama_rak2').empty();
                            $('#nama_rak2').append('<option value="">Pilih Rak</option>');
                            $.each(data, function(key, value) {
                                $('#nama_rak2').append('<option value="' + value.id + '">' + value.kode_rak + '-' + value.nama_rak + '</option>');
                            });
                        }
                    });
                } else {
                    $('#nama_rak2').empty();
                    $('#nama_rak2').append('<option value="">Pilih Rak</option>');
                }
            });
        });
    </script>
</div>
    @endsection
