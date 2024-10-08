@extends('layouts.blackand.appother')
@section('content')

@include('mail.head')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-envelope"></i> Rekapitulasi Surat Keluar</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('outgoingmail.index') }}"> Daftar Surat Keluar</a></li>
                    <li class="breadcrumb-item active">Rekapitulasi</li>
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
                    <form action="{{ route('outgoingmail.rekapitulasiPrint') }}" method="POST" target="_blank" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="startdate" value="{{ $startdate }}">
                        <input type="hidden" name="enddate" value="{{ $enddate }}">
                        <input type="hidden" name="mail_number" value="{{ $mail_number }}">
                        <input type="hidden" name="drafter" value="{{ $drafter }}">
                        <input type="hidden" name="id_mst_letter" value="{{ $id_mst_letter }}">
                        <input type="hidden" name="workunit" value="{{ $workunit }}">
                        <input type="hidden" name="archive_remain" value="{{ $archive_remain }}">
                        <button type="submit" class="btn btn-sm btn-danger"><i class="mdi mdi-file-pdf-box"></i> Cetak Ke PDF</button>
                    </form>
                </div>
                <div class="d-flex justify-content-end align-items-center">
                    <form action="{{ route('outgoingmail.rekapitulasi.post') }}" method="POST" id="resetForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="startdate" value="">
                        <input type="hidden" name="enddate" value="">
                        <input type="hidden" name="mail_number" value="">
                        <input type="hidden" name="drafter" value="">
                        <input type="hidden" name="id_mst_letter" value="">
                        <input type="hidden" name="workunit" value="">
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

            <table id="server-side-table" class="table table-bordered" style="font-size: small" width="100%">
                <thead>
                    <tr>
                        <th class="align-middle text-center">No.</th>
                        <th class="align-middle text-center">Tgl. Surat</th>
                        <th class="align-middle text-center">No. Verbal</th>
                        <th class="align-middle text-center">Kepada</th>
                        <th class="align-middle text-center">Isi / Perihal</th>
                        <th class="align-middle text-center">Lampiran</th>
                        <th class="align-middle text-center">Dari / Konseptor</th>
                        <th class="align-middle text-center">Keterangan</th>
                    </tr>
                </thead>
            </table>

        </div>
    </div>
</div>

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
            <form action="{{ route('outgoingmail.rekapitulasi.post') }}" method="POST" enctype="multipart/form-data" id="modalSearch">
                @csrf
                <div class="modal-body" style="max-height: 65vh; overflow-y: auto;">
                    <div class="row">
                        <div class="col-12">
                            <label>Tanggal Terima / Tanggal Keluar</label>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Dari</label>
                                <input type="date" name="startdate" value="{{ $startdate }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Hingga</label>
                                <input type="date" name="enddate" value="{{ $enddate }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                            <label>Nomor Surat / Perihal</label>
                            <input type="text" name="mail_number" value="{{ $mail_number }}" class="form-control" placeholder="Masukkan Kata Kunci..">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                            <label>Konseptor</label>
                            <select class="form-control js-example-basic-single" name="drafter" style="width: 100%;">
                                <option value="">- Pilih -</option>
                                {{-- @foreach($workunits as $item)
                                    <option value="{{ $item->id }}" @if($drafter == $item->id) selected="selected" @endif>{{ $item->work_name }}</option>
                                @endforeach --}}
                                @foreach($sators as $item)
                                    <option value="{{ $item->id }}" @if($drafter == $item->id) selected="selected" @endif>{{ $item->sator_name }}</option>
                                @endforeach
                            </select>
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
                            <label>Penandatangan</label>
                            <select class="form-control js-example-basic-single" name="workunit" style="width: 100%;">
                                <option value="">- Pilih -</option>
                                @foreach($workunits as $item)
                                    <option value="{{ $item->id }}" @if($workunit == $item->id) selected="selected" @endif>{{ $item->work_name }}</option>
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
            scrollX: true,
            ajax: {
                url: '{!! route('outgoingmail.rekapitulasi') !!}',
                type: 'GET',
                data: {
                    startdate: '{{ $startdate }}',
                    enddate: '{{ $enddate }}',
                    mail_number: '{{ $mail_number }}',
                    drafter: '{{ $drafter }}',
                    id_mst_letter: '{{ $id_mst_letter }}',
                    workunit: '{{ $workunit }}',
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
                    data: 'out_date',
                    name: 'out_date',
                    orderable: true,
                    searchable: true,
                    className: 'text-center',
                    render: function(data, type, row) {
                        var html
                        if(row.out_date == null){
                            html = '';
                        } else {
                            const formattedDate = formatDateToDMY(row.out_date);
                            html = formattedDate;
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
                    data: 'receiver',
                    name: 'receiver',
                    orderable: true,
                    searchable: true,
                    render: function(data, type, row) {
                        return $('<div/>').html(data).text();
                    }
                },
                {
                    data: 'mail_regarding',
                    name: 'mail_regarding',
                    orderable: true,
                    searchable: true,
                    render: function(data, type, row) {
                        var html;
                        html = $('<div/>').html(data).text();
                        var quantity;
                        if (row.mail_quantity == null) {
                            quantity = '';
                        } else {
                            quantity = '<br><br><b>'+row.mail_quantity+' '+row.unit_name+'</b>';
                        }
                        return html+quantity;
                    },
                },
                {
                    data: 'attachment_text',
                    name: 'attachment_text',
                    orderable: true,
                    searchable: true,
                    render: function(data, type, row) {
                        return $('<div/>').html(data).text();
                    }
                },
                {
                    data: 'sub_sator_name',
                    name: 'sub_sator_name',
                    orderable: true,
                    searchable: true,
                    render: function(data, type, row) {
                        var html
                        if(row.sub_sator_name == null){
                            html = '';
                        } else {
                            html = row.sub_sator_name;
                        }
                        return html+'<br><br><b>Tanda Tangan:</b><br>'+row.signer;
                    },
                },
                {
                    data: 'information',
                    name: 'information',
                    orderable: true,
                    searchable: true,
                    render: function(data, type, row) {
                        var html;
                        html = $('<div/>').html(data).text();
                        var archiveRemains;
                        if(row.archive_remains == null){
                            archiveRemains = 'Tanpa Arsip';
                        } else {
                            archiveRemains = row.archive_remains;
                        }
                        var result;
                        result = '('+archiveRemains+')<br><br>'+html;

                        return result;
                    },
                },
            ],
        });
    });
</script>

<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).on("shown.bs.modal", ".modal", function () {
        $(".js-example-basic-single").select2({
            dropdownParent: this,
        });
    });
    $(".js-example-basic-single").select2();
    $(document).on("hidden.bs.modal", ".modal", function () {
        $(".js-example-basic-single").select2();
    });
</script>

@endsection
