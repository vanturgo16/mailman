@extends('layouts.blackand.app')
@section('content')

{{-- Jquery --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-envelope"></i> Daftar Surat Keluar</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Daftar Surat Keluar</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a href="{{ route('outgoingmail.create') }}"><i class="fa fa-plus"></i> </a>
                Tambah Surat Keluar Baru
            </h3>
        </div>
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

            <table id="server-side-table" class="table table-bordered" style="font-size: small">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Konseptor</th>
                        <th class="text-center">No. Surat</th>
                        <th class="text-center">Tgl. Surat</th>
                        <th class="text-center">Perihal / Tentang</th>
                        <th class="text-center">Penerima</th>
                        <th class="text-center">Tgl. Perubahan</th>
                        <th class="text-center">Pengubah</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
            </table>

        </div>
    </div>
</div>

<script>
    $(function() {
        $('#server-side-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('outgoingmail.index') !!}',
            columns: [{
                data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    orderable: false,
                    searchable: false,
                    className: 'align-middle text-center',
                },
                {
                    data: 'drafter_name',
                    name: 'drafter_name',
                    orderable: true,
                    searchable: true,
                    className: 'align-middle text-center',
                },
                {
                    data: 'mail_number',
                    name: 'mail_number',
                    orderable: true,
                    searchable: true,
                    className: 'align-middle text-center',
                    render: function(data, type, row) {
                        var html
                        if(row.mail_number == null){
                            html = '<span class="badge bg-info text-white">Menunggu..</span>';
                        } else {
                            html = row.mail_number;
                        }
                        return html;
                    },
                },
                {
                    data: 'mail_date',
                    name: 'mail_date',
                    orderable: true,
                    searchable: true,
                    className: 'align-middle text-center',
                },
                {
                    data: 'mail_regarding',
                    name: 'mail_regarding',
                    orderable: true,
                    searchable: true,
                    className: 'align-middle',
                },
                {
                    data: 'receiver',
                    name: 'receiver',
                    orderable: true,
                    searchable: true,
                    className: 'align-middle text-center',
                },
                {
                    data: 'updated_at',
                    name: 'updated_at',
                    orderable: true,
                    searchable: true,
                    className: 'align-middle text-center',
                    render: function(data, type, row) {
                        var html
                        if(row.updated_by == null){
                            html = '<span class="badge bg-secondary text-white">Null</span>';
                        } else {
                            html = row.updated_at;
                        }
                        return html;
                    },
                },
                {
                    data: 'updated_by',
                    name: 'updated_by',
                    orderable: true,
                    searchable: true,
                    className: 'align-middle text-center',
                    render: function(data, type, row) {
                        var html
                        if(row.updated_by == null){
                            html = '<span class="badge bg-secondary text-white">Null</span>';
                        } else {
                            html = row.updated_by;
                        }
                        return html;
                    },
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'align-middle text-center',
                },
            ],
        });
    });
</script>

@endsection
