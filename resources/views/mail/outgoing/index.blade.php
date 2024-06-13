@extends('layouts.blackand.app')
@section('content')

@include('mail.head')

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
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex justify-content-start align-items-center">
                    <a href="{{ route('outgoingmail.create') }}" type="button" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Baru</a>
                    <a href="" type="button" class="btn btn-sm btn-info ml-1" data-toggle="modal" data-target="#addBulk"><i class="mdi mdi-plus-box-multiple"></i> Tambah Baru (Bulk) </a>
                    {{-- <a href="" type="button" class="btn btn-sm btn-warning ml-1" data-toggle="modal" data-target="#genNumber"><i class="mdi mdi-reload-alert"></i> Generate No. Surat</a> --}}
                    <a href="{{ route('outgoingmail.rekapitulasi') }}" type="button" class="btn btn-sm btn-primary ml-1"><i class="mdi mdi-printer-search"></i> Rekapitulasi</a>
                </div>
                <div class="d-flex justify-content-end align-items-center">
                    <form action="{{ route('outgoingmail.index') }}" method="POST" id="resetForm" enctype="multipart/form-data">
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
                        <th class="align-middle text-center">No. Surat</th>
                        <th class="align-middle text-center">Jenis</th>
                        <th class="align-middle text-center">Konseptor</th>
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

{{-- Add Bulk --}}
<div class="modal fade" id="addBulk" data-backdrop="static" data-keyboard="false" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #0074F1; color: white;">
                <h5 class="modal-title font-weight-bold" id="modalAddLabel">Tambah Surat Keluar Baru (Dalam Jumlah Besar)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('outgoingmail.storebulk') }}" method="POST" enctype="multipart/form-data" id="modalFormBulk">
                @csrf
                <div class="modal-body" style="max-height: 65vh; overflow-y: auto;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                            <label  class="text-danger">Jenis Naskah *</label>
                            <select class="form-control js-example-basic-single" id="mst_letter" name="id_mst_letter" style="width: 100%;" required>
                                <option value="">- Pilih -</option>
                                @foreach($letters as $letter)
                                <option value="{{ $letter->id }}">{{ $letter->let_name }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-danger">Tanggal Surat *</label>
                                <input type="date" name="mail_date" value="{{ old('mail_date') }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label id="labelkso">Kode Satuan Organisasi</label>
                                <select class="form-control js-example-basic-single" name="org_unit" style="width: 100%;">
                                    <option value="">- Pilih -</option>
                                    @foreach($sators as $sator)
                                        <option value="{{ $sator->id }}">{{ $sator->sator_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                            <label  class="text-danger">Jumlah Naskah *</label>
                            <input type="number" name="amount_letter" class="form-control" placeholder="Masukkan Jumlah Naskah Dalam Angka.." required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" id="sbFormBulk">Tambah</button>
                </div>
            </form>
            <script>
                document.getElementById('modalFormBulk').addEventListener('submit', function(event) {
                    if (!this.checkValidity()) {
                        event.preventDefault();
                        return false;
                    }
                    var submitButton = this.querySelector('button[id="sbFormBulk"]');
                    submitButton.disabled = true;
                    submitButton.innerHTML  = '<i class="mdi mdi-loading mdi-spin"></i> Mohon Tunggu...';
                    return true;
                });
            </script>
        </div>
    </div>
</div>

<script>
    $('select[id="mst_letter"]').on('change', function() {
        const id_mst_letter = $(this).val();
        var url = '{{ route("outgoingmail.checkpattern", ":id") }}';
        url = url.replace(':id', id_mst_letter);
        if (id_mst_letter) {
            $.ajax({
                url: url,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    const label = document.getElementById('labelkso');
                    const select = document.querySelector('select[name="org_unit"]');
                    if (data === "R") {
                        label.classList.add('text-danger');
                        label.textContent = "Kode Satuan Organisasi *";
                        select.setAttribute('required', 'required');
                    } else {
                        label.classList.remove('text-danger');
                        label.textContent = "Kode Satuan Organisasi";
                        select.removeAttribute('required');
                    }
                }
            });
        }
    });
</script>

{{-- Modal Generate Mail Number --}}
{{-- <div class="modal fade" id="genNumber" data-backdrop="static" data-keyboard="false" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #0074F1; color: white;">
                <h5 class="modal-title font-weight-bold" id="modalAddLabel">Generate Nomor Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('outgoingmail.generate') }}" method="POST" enctype="multipart/form-data" id="modalGenNumber">
                @csrf
                <div class="modal-body" style="max-height: 65vh; overflow-y: auto;">
                    <div class="row">
                        <div class="col-md-12">
                            <br>
                            <h6 class="text-center">Generate Nomor Surat Yang Belum Ada ?</h6>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" id="sbGenNumber">Generate</button>
                </div>
            </form>
            <script>
                document.getElementById('modalGenNumber').addEventListener('submit', function(event) {
                    if (!this.checkValidity()) {
                        event.preventDefault();
                        return false;
                    }
                    var submitButton = this.querySelector('button[id="sbGenNumber"]');
                    submitButton.disabled = true;
                    submitButton.innerHTML  = '<i class="mdi mdi-loading mdi-spin"></i> Mohon Tunggu...';
                    return true;
                });
            </script>
        </div>
    </div>
</div> --}}

{{-- Filter & Search --}}
<div class="modal fade" id="search" data-backdrop="static" data-keyboard="false" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #0074F1; color: white;">
            <h5 class="modal-title font-weight-bold" id="modalAddLabel">Filter & Cari</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="{{ route('outgoingmail.index') }}" method="POST" enctype="multipart/form-data" id="modalSearch">
                @csrf
                <div class="modal-body" style="max-height: 65vh; overflow-y: auto;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Keluar</label>
                                <input type="date" name="out_date" value="{{ $out_date }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Surat</label>
                                <input type="date" name="mail_date" value="{{ $mail_date }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                            <label>Nomor Surat</label>
                            <input type="text" name="mail_number" value="{{ $mail_number }}" class="form-control" placeholder="Masukkan Kata Kunci Nomor Surat..">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                            <label>Jenis Naskah</label>
                            <select class="form-control js-example-basic-single" name="id_mst_letter" style="width: 100%;">
                                <option value="">- Pilih -</option>
                                @foreach($letters as $letter)
                                <option value="{{ $letter->id }}" @if($id_mst_letter == $letter->id) selected="selected" @endif>{{ $letter->let_name }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                            <label>Arsip Pertinggal</label>
                            <select class="form-control js-example-basic-single" name="archive_remain" style="width: 100%;">
                                <option value="">- Pilih -</option>
                                @foreach($archive_remains as $item)
                                    <option value="{{ $item->name_value }}" @if($archive_remain == $item->name_value) selected="selected" @endif>{{ $item->name_value }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" id="sbSearch">Cari</button>
                </div>
            </form>
            <script>
                document.getElementById('modalSearch').addEventListener('submit', function(event) {
                    if (!this.checkValidity()) {
                        event.preventDefault();
                        return false;
                    }
                    var submitButton = this.querySelector('button[id="sbSearch"]');
                    submitButton.disabled = true;
                    submitButton.innerHTML  = '<i class="mdi mdi-loading mdi-spin"></i> Mohon Tunggu...';
                    return true;
                });
            </script>
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
                url: '{!! route('outgoingmail.index') !!}',
                type: 'GET',
                data: {
                    out_date: '{{ $out_date }}',
                    mail_date: '{{ $mail_date }}',
                    mail_number: '{{ $mail_number }}',
                    id_mst_letter: '{{ $id_mst_letter }}',
                    archive_remain: '{{ $archive_remain }}'
                }
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
                    data: 'let_name',
                    name: 'let_name',
                    orderable: true,
                    searchable: true,
                    render: function(data, type, row) {
                        var html
                        if(row.let_name == null){
                            html = '<div class="text-center"><span class="badge bg-secondary">Null</span></div>';
                        } else {
                            html = '<span class="text-bold">'+row.let_name+'</span>';
                        }
                        return html;
                    },
                },
                {
                    data: 'drafter_name',
                    name: 'drafter_name',
                    orderable: true,
                    searchable: true,
                    className: 'text-center',
                    render: function(data, type, row) {
                        var html
                        if(row.drafter_name == null){
                            html = '<span class="badge bg-secondary">Null</span>';
                        } else {
                            html = row.drafter_name;
                            // html = '<span class="text-bold">'+row.drafter_name+'</span>';
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
                            // html = row.mail_date;
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
                            // html = row.mail_regarding_filtered;
                            var truncatedData = row.mail_regarding_filtered.length > 150 ? row.mail_regarding_filtered.substr(0, 150) + '...' : row.mail_regarding_filtered;
                            html = truncatedData;
                        }
                        return html;
                    },
                },
                // {
                //     data: 'mail_regarding',
                //     name: 'mail_regarding',
                //     orderable: true,
                //     searchable: true,
                //     className: 'align-middle',
                //     render: function(data, type, row) {
                //         var html;
                //         if (row.mail_regarding == null) {
                //             html = '<div class="text-center"><span class="badge bg-secondary">Null</span></div>';
                //         } else {
                //             var tempElement = document.createElement('div');
                //             tempElement.innerHTML = row.mail_regarding;
                //             var textContent = tempElement.textContent || tempElement.innerText || '';
                //             var truncatedData = textContent.length > 150 ? textContent.substr(0, 150) + '...' : textContent;
                //             html = truncatedData;
                //         }
                //         return html;
                //     },
                // },
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
                {
                    data: 'id', // Ensure that 'id' is included in your data source
                    visible: false, // Hide the 'id' column
                },
            ],
        });

        setTimeout(checkForChanges, 10);
    });

    function checkForChanges() {
        let lastChecked = new Date().toISOString();
        var url = '{{ route("outgoingmail.checkChanges", ":id") }}';
        url = url.replace(':id', lastChecked);
        
        $.ajax({
            url: url,
            method: 'GET',
            success: function(response) {
                console.log(response);
                if (response.changes) {
                    $("#server-side-table").DataTable().ajax.reload();
                }
            },
            complete: function() {
                setTimeout(checkForChanges, 10);
            }
        });
    }
</script>

<script>
    $(".js-example-basic-single").select2().on("select2:open", function () {
        document.querySelector(".select2-search__field").focus();
    });
</script>

@endsection
