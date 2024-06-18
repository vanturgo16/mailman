@extends('layouts.blackand.app')
@section('content')

@include('mail.head')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-envelope"></i> Daftar Surat Masuk</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Daftar Surat Masuk</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex justify-content-start align-items-center">
                    <a href="{{ route('incommingmail.create') }}" type="button" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Baru</a>
                    <a href="" type="button" class="btn btn-sm btn-info ml-1" data-toggle="modal" data-target="#addBulk"><i class="mdi mdi-plus-box-multiple"></i> Tambah Baru (Bulk) </a>
                    <a href="#" type="button" class="btn btn-sm btn-primary ml-1"><i class="mdi mdi-printer-search"></i> Rekapitulasi</a>
                </div>
                <div class="d-flex justify-content-end align-items-center">
                    <form action="{{ route('incommingmail.index') }}" method="POST" id="resetForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="out_date" value="">
                        <input type="hidden" name="mail_date" value="">
                        <input type="hidden" name="mail_number" value="">
                        <input type="hidden" name="id_mst_letter" value="">
                        <input type="hidden" name="archive_remain" value="">
                        <button type="submit" class="btn btn-sm btn-secondary" id="resetbtn"><i class="mdi mdi-reload"></i> Reset Filter</button>
                    </form>
                    <a href="" type="button" class="btn btn-sm btn-info ml-1" data-toggle="modal" data-target="#search"><span class="mdi mdi-filter"></span> Filter & Cari </a>
                </div>
            </div>
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
            @if (session('info'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ session('info') }}
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
                        <th class="align-middle text-center">No.</th>
                        <th class="align-middle text-center">Buku Agenda</th>
                        <th class="align-middle text-center">Pengirim</th>
                        <th class="align-middle text-center">No. Surat</th>
                        <th class="align-middle text-center">No. Agenda</th>
                        <th class="align-middle text-center">Tgl. Surat</th>
                        <th class="align-middle text-center">Perihal / Tentang</th>
                        <th class="align-middle text-center">Penerima</th>
                        <th class="align-middle text-center">Tgl. Perubahan</th>
                        <th class="align-middle text-center">Tgl. Dibuat</th>
                        <th class="align-middle text-center">Aksi</th>
                    </tr>
                </thead>
            </table>

        </div>
    </div>
</div>

<script>
    function formatDateToDMY(dateString) {
        const [datePart] = dateString.split(' ');
        const [year, month, day] = datePart.split('-');
        return `${day}-${month}-${year}`;
    }
    
    $(function() {
        $('#server-side-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{!! route('incommingmail.index') !!}'
            },
            columns: [{
                data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                },
                {
                    data: 'placeman',
                    name: 'placeman',
                    orderable: true,
                    searchable: true,
                    render: function(data, type, row) {
                        var html
                        if(row.placeman == null){
                            html = '<div class="text-center"><span class="badge bg-secondary">Null</span></div>';
                        } else {
                            html = '<span class="text-bold">'+row.placeman+'</span>';
                        }
                        return html;
                    },
                },
                {
                    data: 'sender',
                    name: 'sender',
                    orderable: true,
                    searchable: true,
                    className: 'text-center',
                    render: function(data, type, row) {
                        var html
                        if(row.sender == null){
                            html = '<span class="badge bg-secondary">Null</span>';
                        } else {
                            html = row.sender;
                        }
                        return html;
                    },
                },
                {
                    data: 'mail_number',
                    name: 'mail_number',
                    orderable: true,
                    searchable: true,
                    className: 'text-center',
                    render: function(data, type, row) {
                        var html
                        if(row.mail_number == null){
                            html = '<span class="badge bg-warning"><i class="fas fa-spinner"></i> Menunggu..</span>';
                        } else {
                            html = '<span class="text-bold">'+row.mail_number+'</span>';
                        }
                        return html;
                    },
                },
                {
                    data: 'mail_number',
                    name: 'mail_number',
                    orderable: true,
                    searchable: true,
                    className: 'text-center',
                    render: function(data, type, row) {
                        var html
                        if(row.mail_number == null){
                            html = '<span class="badge bg-warning"><i class="fas fa-spinner"></i> Menunggu..</span>';
                        } else {
                            html = '<span class="text-bold">'+row.mail_number+'</span>';
                        }
                        return html;
                    },
                },
                {
                    data: 'mail_date',
                    name: 'mail_date',
                    orderable: true,
                    searchable: true,
                    className: 'text-center',
                    render: function(data, type, row) {
                        var html
                        if(row.mail_date == null){
                            html = '<span class="badge bg-secondary">Null</span>';
                        } else {
                            const formattedDate = formatDateToDMY(row.mail_date);
                            html = formattedDate;
                        }
                        return html;
                    },
                },
                {
                    data: 'mail_regarding',
                    name: 'mail_regarding',
                    orderable: true,
                    searchable: true,
                    render: function(data, type, row) {
                        var html;
                        if (row.mail_regarding == null) {
                            html = '<div class="text-center"><span class="badge bg-secondary">Null</span></div>';
                        } else {
                            var truncatedData = row.mail_regarding.length > 150 ? row.mail_regarding.substr(0, 150) + '...' : row.mail_regarding;
                            html = truncatedData;
                        }
                        return html;
                    },
                },
                {
                    data: 'receiver',
                    name: 'receiver',
                    orderable: true,
                    searchable: true,
                    className: 'text-center',
                    render: function(data, type, row) {
                        var html
                        if(row.receiver == null){
                            html = '<span class="badge bg-secondary">Null</span>';
                        } else {
                            html = row.receiver;
                        }
                        return html;
                    },
                },
                {
                    data: 'last_update',
                    name: 'last_update',
                    orderable: true,
                    searchable: true,
                    render: function(data, type, row) {
                        var html
                        if(row.updated_by == null){
                            html = '<div class="text-center"><span class="badge bg-secondary text-white">Null</span></div>';
                        } else {
                            var date = row.last_update.replace('T', ' ').split('.')[0];
                            html = date+'<br><b>'+row.updated_by;
                        }
                        return html;
                    },
                },
                {
                    data: 'created',
                    name: 'created',
                    orderable: true,
                    searchable: true,
                    render: function(data, type, row) {
                        var html
                        if(row.created == null){
                            html = '<div class="text-center"><span class="badge bg-secondary text-white">Null</span></div>';
                        } else {
                            var date = row.created.replace('T', ' ').split('.')[0];
                            html = date+'<br><b>'+row.created_by;
                        }
                        return html;
                    },
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                },
            ],
        });
    });
</script>

<script>
    $(".js-example-basic-single").select2().on("select2:open", function () {
        document.querySelector(".select2-search__field").focus();
    });
</script>

@endsection
