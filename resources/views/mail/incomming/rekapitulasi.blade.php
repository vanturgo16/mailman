@extends('layouts.blackand.appother')
@section('content')
@include('mail.head')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1 class="m-0"><i class="fas fa-envelope"></i> Rekapitulasi Surat Masuk</h1></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('incommingmail.index') }}"> Daftar Surat Masuk</a></li>
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
                <div class="d-flex justify-content-start align-items-center" id="export-buttons-container">
                </div>
                <div class="d-flex justify-content-end align-items-center">
                    <a href="{{ route('incommingmail.rekapitulasi') }}" type="button" class="btn btn-sm btn-secondary ml-1"><span class="mdi mdi-reload"></span> Reset Filter </a>
                    <a href="" type="button" class="btn btn-sm btn-info ml-1" data-toggle="modal" data-target="#search"><span class="mdi mdi-filter"></span> Filter & Cari </a>
                </div>
            </div>
        </div>

        <!-- MODAL -->
        <!-- Filter & Search -->
        <div class="modal fade" id="search" data-backdrop="static" data-keyboard="false" aria-labelledby="modalAddLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #0074F1; color: white;">
                        <h5 class="modal-title font-weight-bold" id="modalAddLabel">Filter & Cari</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('incommingmail.rekapitulasi.post') }}" method="POST" enctype="multipart/form-data" id="modalSearch">
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
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nomor Surat / Perihal / Pengirim / No.Agenda / Ket.</label>
                                        <input type="text" name="mail_number" value="{{ $mail_number }}" class="form-control" placeholder="Masukkan Kata Kunci..">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label>Pejabat / Naskah</label>
                                    <select class="form-control js-example-basic-single" id="placeman" name="placeman" style="width: 100%;">
                                        <option value="">- Pilih -</option>
                                        @foreach($placemans as $item)
                                            <option value="{{ $item->name_value }}" @if($placeman == $item->name_value) selected="selected" @endif>{{ $item->name_value }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label id="labeljenisNaskah">Jenis Naskah</label>{{ $letter }}
                                        <div id="jenisNaskah">
                                            <select class="form-control js-example-basic-single" id="mst_letter" name="letter" style="width: 100%;">
                                                <option value="">- Pilih -</option>
                                                @foreach($letters as $item)
                                                <option value="{{ $item->id }}" @if($letter == $item->id) selected="selected" @endif>{{ $item->let_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div id="jenisPengaduan" hidden>
                                            <select class="form-control js-example-basic-single" id="mst_complain" name="id_mst_complain" style="width: 100%;">
                                                <option value="">- Pilih -</option>
                                                @foreach($complains as $item)
                                                <option value="{{ $item->id }}" @if($complain == $item->id) selected="selected" @endif>{{ $item->com_code }} - {{ $item->com_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
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
                    <script>
                        $(document).ready(function() {
                            const labeljenisNaskah = document.getElementById('labeljenisNaskah');
                            const jenisNaskah = document.getElementById('jenisNaskah');
                            const jenisPengaduan = document.getElementById('jenisPengaduan');
                            const idLetter = document.getElementById('mst_letter');
                            const idComplain = document.getElementById('mst_complain');
            
                            var placemanBefore = "{{ $placeman }}";
                            if (placemanBefore == 'PENGADUAN') {
                                labeljenisNaskah.textContent = "Jenis Pengaduan";
                                jenisNaskah.hidden = true;
                                jenisPengaduan.hidden = false;
                            } else {
                                labeljenisNaskah.textContent = "Jenis Naskah";
                                jenisNaskah.hidden = false;
                                jenisPengaduan.hidden = true;
                            }
                            $('select[name="placeman"]').on('change', function() {
                                const placeman = $(this).val();
                                if (placeman == 'PENGADUAN') {
                                    labeljenisNaskah.textContent = "Jenis Pengaduan";
                                    jenisNaskah.hidden = true;
                                    idLetter.value = "";
                                    jenisPengaduan.hidden = false;
                                } else {
                                    labeljenisNaskah.textContent = "Jenis Naskah";
                                    jenisNaskah.hidden = false;
                                    idComplain.value = "";
                                    jenisPengaduan.hidden = true;
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>

        <div class="card-body">
            @include('mail.alert')
            <table id="server-side-table" class="table table-bordered" style="font-size: small" width="100%">
                <thead>
                    <tr>
                        <th rowspan="2" class="align-middle text-center">No.</th>
                        <th rowspan="2" class="align-middle text-center">Tgl. Agenda</th>
                        <th rowspan="2" class="align-middle text-center">No. Agenda</th>
                        <th colspan="3" class="align-middle text-center">Naskah / Surat</th>
                        <th rowspan="2" class="align-middle text-center">Lampiran</th>
                        <th rowspan="2" class="align-middle text-center">Kepada</th>
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
                url: '{!! route('incommingmail.rekapitulasi') !!}',
                type: 'GET',
                data: {
                    startdate: '{{ $startdate }}',
                    enddate: '{{ $enddate }}',
                    mail_number: '{{ $mail_number }}',
                    placeman: '{{ $placeman }}',
                    complain: '{{ $complain }}',
                    letter: '{{ $letter }}',
                }
            },
            columns: [
                {
                data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                },
                // {
                //     data: 'no_order',
                //     name: 'no_order',
                //     orderable: false,
                //     searchable: true,
                //     className: 'text-center',
                //     render: function(data, type, row) {
                //         var html
                //         if(row.no_order == null){
                //             html = '';
                //         } else {
                //             html = row.no_order;
                //         }
                //         return html;
                //     },
                // },
                {
                    data: 'entry_date',
                    name: 'entry_date',
                    orderable: false,
                    searchable: true,
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
                    data: 'agenda_number',
                    name: 'agenda_number',
                    orderable: false,
                    searchable: true,
                    render: function(data, type, row) {
                        var html
                        if(row.agenda_number == null){
                            html = '<span class="badge bg-warning"><i class="fas fa-spinner"></i> Menunggu..</span>';
                        } else {
                            html = '<span class="text-bold">'+row.agenda_number+'</span>';
                        }
                        return html;
                    },
                },
                {
                    data: 'mail_number',
                    name: 'mail_number',
                    orderable: false,
                    searchable: true,
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
                    data: 'sender',
                    name: 'sender',
                    orderable: false,
                    searchable: true,
                    render: function(data, type, row) {
                        var html
                        if(row.sender == null){
                            html = '';
                        } else {
                            html = row.sender;
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
                            quantity = '<div class="mt-2"><b>'+row.mail_quantity+' '+row.unit_name+'</b></div>';
                        }
                        var mailType;
                        if (row.mail_type == null) {
                            mailType = '';
                        } else {
                            mailType = row.mail_type;
                        }
                        return html+quantity+mailType;
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
                    data: 'information',
                    name: 'information',
                    orderable: false,
                    searchable: true,
                    render: function(data, type, row) {
                        var html;
                        if(html == null){
                            html = '';
                        } else {
                            var html;
                            html = $('<div/>').html(data).text();
                            html = html.replace(/<p>/g, '<p class="custom-paragraph">');
                        }
                        // html = $('<div/>').html(data).text();
                        var sendVia;
                        if (row.received_via == null) {
                            sendVia = '-';
                        } else {
                            sendVia = row.received_via;
                        }
                        return html+'Dikirim Via: '+sendVia;
                    },
                },
            ],
            dom: '<"d-flex justify-content-between align-items-center"lBf>rtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel"></i> Ekspor Ke Excel',
                    className: 'btn btn-success',
                    exportOptions: {
                        columns: ':visible',
                    },
                    title: 'Surat Masuk_' + new Date().toLocaleString(),
                    messageTop: `Diekspor Oleh:  ${'{{ auth()->user()->name }}'}, Waktu Ekspor:  ${new Date().toLocaleString()}`,
                },
                // {
                //     extend: 'print',
                //     text: '<i class="fas fa-print"></i> Print Ke PDF',
                //     className: 'btn btn-danger',
                //     exportOptions: {
                //         columns: ':visible',
                //         stripHtml: false,
                //         format: {
                //             body: function (data, row, column, node) {
                //                 return data;
                //             }
                //         }
                //     },
                //     title: 'Surat Masuk_' + new Date().toLocaleString(),
                //     messageTop: `Exported by: ${'{{ auth()->user()->name }}'}<br>Export time: ${new Date().toLocaleString()}`,
                // }

                // {
                //     extend: 'print',
                //     text: '<i class="fas fa-print"></i> Cetak Ke PDF',
                //     className: 'btn btn-danger',
                //     exportOptions: {
                //         columns: ':visible',
                //         stripHtml: false,
                //         format: {
                //             body: function (data, row, column, node) {
                //                 return data;
                //             }
                //         }
                //     },
                //     title: 'Rekapitulasi Surat Masuk',
                //     messageTop: `Dicetak Oleh:  ${'{{ auth()->user()->name }}'}`,
                //     customize: function (win) {
                //         let css = '@page { size: landscape; }';
                //         let head = win.document.head || win.document.getElementsByTagName('head')[0];
                //         let style = win.document.createElement('style');

                //         style.type = 'text/css';
                //         style.appendChild(win.document.createTextNode(css));
                //         head.appendChild(style);

                //         $(win.document.body)
                //             .css('font-size', '10pt')
                //             .css('text-align', 'left')
                //             .find('table')
                //             .addClass('compact')
                //             .css('width', '100%');

                //         let filename = 'Rekapitulasi_Surat_Masuk_' + new Date().toLocaleString();
                //         win.document.title = filename;
                //     }
                // }
                {
                    extend: 'print',
                    text: '<i class="fas fa-print"></i> Cetak Ke PDF',
                    className: 'btn btn-danger',
                    exportOptions: {
                        columns: ':visible',
                        stripHtml: false,
                        format: {
                            body: function (data, row, column, node) {
                                return data;
                            }
                        }
                    },
                    title: 'Rekapitulasi Surat Masuk',
                    messageTop: `Dicetak Oleh:  ${'{{ auth()->user()->name }}'}`,
                    customize: function (win) {
                        let css = `
                            @page { size: landscape; }
                            body { font-size: 9pt !important; }
                            table { font-size: 7.5pt !important; width: 100%; }
                            th, td { padding: 4px !important; }
                        `;
                        let head = win.document.head || win.document.getElementsByTagName('head')[0];
                        let style = win.document.createElement('style');

                        style.type = 'text/css';
                        style.appendChild(win.document.createTextNode(css));
                        head.appendChild(style);

                        $(win.document.body)
                            .css('font-size', '8pt')
                            .css('text-align', 'left')
                            .find('table')
                            .addClass('compact')
                            .css('width', '100%');

                        let filename = 'Rekapitulasi_Surat_Masuk_' + new Date().toLocaleString();
                        win.document.title = filename;
                    }
                }
            ],
            responsive: true,
            lengthChange: true,
            autoWidth: false,
            paging: true,
            serverSide: false,
        });
        
        $('#server-side-table_wrapper .dt-buttons').appendTo('#export-buttons-container');
    });
</script>

@endsection
