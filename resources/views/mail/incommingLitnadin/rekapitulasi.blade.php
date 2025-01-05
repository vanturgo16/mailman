@extends('layouts.blackand.appother')
@section('content')

@include('mail.head')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-envelope"></i> Rekapitulasi Surat Masuk (Litnadin)</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('incommingmail.indexLitnadin') }}"> Daftar Surat Masuk (Litnadin)</a></li>
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
                    <form action="{{ route('incommingmail.rekapitulasiPrintLitnadin') }}" method="POST" target="_blank" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="startdate" value="{{ $startdate }}">
                        <input type="hidden" name="enddate" value="{{ $enddate }}">
                        <input type="hidden" name="mail_number" value="{{ $mail_number }}">
                        <input type="hidden" name="status" value="{{ $status }}">
                        <input type="hidden" name="letter" value="{{ $letter }}">
                        <button type="submit" class="btn btn-sm btn-danger"><i class="mdi mdi-file-pdf-box"></i> Cetak Ke PDF</button>
                    </form>
                </div>
                <div class="d-flex justify-content-end align-items-center">
                    <form action="{{ route('incommingmail.rekapitulasiLitnadin.post') }}" method="POST" id="resetForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="startdate" value="">
                        <input type="hidden" name="enddate" value="">
                        <input type="hidden" name="mail_number" value="">
                        <input type="hidden" name="status" value="">
                        <input type="hidden" name="letter" value="">
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
                        <th rowspan="2" class="align-middle text-center">No.</th>
                        <th rowspan="2" class="align-middle text-center">Tgl. Agenda</th>
                        <th colspan="3" class="align-middle text-center">Naskah / Surat</th>
                        <th rowspan="2" class="align-middle text-center">Jumlah<br>Lampiran</th>
                        <th rowspan="2" class="align-middle text-center">Kepada</th>
                        <th rowspan="2" class="align-middle text-center">Status</th>
                        <th rowspan="2" class="align-middle text-center">Keterangan</th>
                    </tr>
                    <tr>
                        <th class="align-middle text-center">No. Surat</th>
                        <th class="align-middle text-center">Terima Dari</th>
                        <th class="align-middle text-center">Isi / Perihal</th>
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
            <form action="{{ route('incommingmail.rekapitulasiLitnadin.post') }}" method="POST" enctype="multipart/form-data" id="modalSearch">
                @csrf
                <div class="modal-body" style="max-height: 65vh; overflow-y: auto;">
                    <div class="row">
                        <div class="col-12">
                            <label>Tanggal Agenda</label>
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
                                <label>Nomor Surat / Perihal / Pengirim / No.Agenda / Ket.</label>
                                <input type="text" name="mail_number" value="{{ $mail_number }}" class="form-control" placeholder="Masukkan Kata Kunci..">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label id="labeljenisNaskah">Jenis Naskah</label>
                                <div id="jenisNaskah">
                                    <select class="form-control js-example-basic-single" id="mst_letter" name="letter" style="width: 100%;">
                                        <option value="">- Pilih -</option>
                                        @foreach($letters as $item)
                                        <option value="{{ $item->id }}" @if($letter == $item->id) selected="selected" @endif>{{ $item->let_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                            <label>Status</label>
                            <select class="form-control js-example-basic-single" name="status" style="width: 100%;">
                                <option value="">- Pilih -</option>
                                <option value="1" @if($status == "1") selected="selected" @endif>Selesai</option>
                                <option value="0" @if($status == "0") selected="selected" @endif>Revisi</option>
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
                url: '{!! route('incommingmail.rekapitulasiLitnadin') !!}',
                type: 'GET',
                data: {
                    startdate: '{{ $startdate }}',
                    enddate: '{{ $enddate }}',
                    mail_number: '{{ $mail_number }}',
                    status: '{{ $status }}',
                    letter: '{{ $letter }}',
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
                    data: 'entry_date',
                    name: 'entry_date',
                    orderable: false,
                    searchable: true,
                    className: 'text-center',
                    render: function(data, type, row) {
                        var html
                        if(row.entry_date == null){
                            html = '';
                        } else {
                            const formattedDate = formatDateToDMY(row.entry_date);
                            html = formattedDate;
                        }
                        return html;
                    },
                },
                {
                    data: 'mail_number',
                    name: 'mail_number',
                    orderable: false,
                    searchable: true,
                    className: 'text-center',
                    render: function(data, type, row) {
                        var html
                        if(row.mail_number == null){
                            html = '';
                        } else {
                            html = '<span class="text-bold">'+row.mail_number+'</span>';
                        }
                        return html;
                    },
                },
                {
                    data: 'sub_sator_name',
                    name: 'sub_sator_name',
                    orderable: false,
                    searchable: true,
                    className: 'text-center',
                    render: function(data, type, row) {
                        var html
                        if(row.sub_sator_name == null){
                            html = '';
                        } else {
                            html = row.sub_sator_name;
                        }
                        return html;
                    },
                },
                {
                    data: 'mail_regarding',
                    name: 'mail_regarding',
                    orderable: false,
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
                    orderable: false,
                    searchable: true,
                    render: function(data, type, row) {
                        return $('<div/>').html(data).text();
                    }
                },
                {
                    data: 'receiver',
                    name: 'receiver',
                    orderable: false,
                    searchable: true,
                    className: 'text-center',
                    render: function(data, type, row) {
                        var html
                        if(row.receiver == null){
                            html = '';
                        } else {
                            html = row.receiver;
                        }
                        return html;
                    },
                },
                {
                    data: 'status',
                    name: 'status',
                    orderable: false,
                    searchable: true,
                    render: function(data, type, row) {
                        var html
                        if(row.status == 1){
                            html = '<div class="text-center"><span class="badge bg-success text-white">Selesai</span></div>';
                        } else if(row.status == 0) {
                            html = '<div class="text-center"><span class="badge bg-warning text-white">Revisi</span></div>';
                        } else {
                            html = '';
                        }
                        return html;
                    },
                },
                {
                    data: 'information',
                    name: 'information',
                    orderable: false,
                    searchable: true,
                    render: function(data, type, row) {
                        var html;
                        html = $('<div/>').html(data).text();
                        var sendVia;
                        if (row.received_via == null) {
                            sendVia = '-';
                        } else {
                            sendVia = row.received_via;
                        }
                        return html+'<br><br>Dikirim Via: '+sendVia;
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
