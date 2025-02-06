@extends('layouts.blackand.appother')
@section('content')
@include('mail.head')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1 class="m-0"><i class="fas fa-envelope"></i> Daftar Surat Keluar</h1></div>
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
                    <a href="{{ route('outgoingmail.createbulk') }}" type="button" class="btn btn-sm btn-info ml-1"><i class="mdi mdi-plus-box-multiple"></i> Tambah Baru (Bulk) </a>
                    <a href="{{ route('outgoingmail.rekapitulasi') }}" type="button" class="btn btn-sm btn-primary ml-1"><i class="mdi mdi-printer-search"></i> Rekapitulasi</a>
                </div>
                <div class="d-flex justify-content-end align-items-center">
                    <a href="{{ route('outgoingmail.index') }}" type="button" class="btn btn-sm btn-secondary ml-1"><span class="mdi mdi-reload"></span> Reset Filter </a>
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
                    <form action="{{ route('outgoingmail.index.post') }}" method="POST" enctype="multipart/form-data" id="modalSearch">
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Kode Satuan Organisasi (Induk)</label>
                                        <select class="form-control js-example-basic-single" name="org_unit" style="width: 100%;">
                                            <option value="">- Pilih -</option>
                                            @foreach($sators as $sator)
                                                <option value="{{ $sator->id }}" @if($org_unit == $sator->id) selected="selected" @endif>{{ $sator->sator_name }}</option>
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
        
        <div class="card-body">
            @include('mail.alert')
            <div class="table-responsive">
                <table id="server-side-table" class="table table-bordered" style="font-size: small" width="100%">
                    <thead>
                    <tr>
                        <th class="align-middle text-center">No.</th>
                        <th class="align-middle text-center">Tgl. Surat</th>
                        <th class="align-middle text-center">No. Surat</th>
                        <th class="align-middle text-center">Penerima</th>
                        <th class="align-middle text-center">Hal / Tentang</th>
                        <th class="align-middle text-center">Dari / Konseptor</th>
                        <th class="align-middle text-center">Jumlah</th>
                        <th class="align-middle text-center">Lampiran</th>
                        <th class="align-middle text-center">Keterangan</th>
                        <th class="align-middle text-center">Tgl. Dibuat</th>
                        <th class="align-middle text-center">Ubah</th>
                        <th class="align-middle text-center">Aksi</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function formatDateToDMY(dateString) {
        const [datePart] = dateString.split(' ');
        const [year, month, day] = datePart.split('-');
        return `${day}-${month}-${year}`;
    }

    $(document).ready(function() {
        var originalData = {};
        var editingRow = null;

        var idUpdated = '{{ $idUpdated }}';
        var pageNumber = '{{ $page_number }}';
        var pageLength = 10;
        var displayStart = (pageNumber - 1) * pageLength;
        var firstReload = true;

        var table = $('#server-side-table').DataTable({
            "processing": true,
            "serverSide": true,
            "scrollX": true,
            "ajax": {
                "url": '{!! route('outgoingmail.index') !!}',
                "type": "GET",
                "data": {
                    out_date: '{{ $out_date }}',
                    mail_date: '{{ $mail_date }}',
                    mail_number: '{{ $mail_number }}',
                    id_mst_letter: '{{ $id_mst_letter }}',
                    archive_remain: '{{ $archive_remain }}',
                    org_unit: '{{ $org_unit }}',
                }
            },
            "displayStart": displayStart,
            "pageLength": pageLength,
            "columns": [
                // {
                //     data: 'no_order',
                //     name: 'no_order',
                //     orderable: true,
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
                    var html;
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
                    var html;
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
                        return $('<div/>').html(data).text();
                    }
                },
                {
                    data: 'sub_sator_name',
                    name: 'sub_sator_name',
                    orderable: true,
                    searchable: true,
                    className: 'text-center',
                    render: function(data, type, row) {
                    var html;
                    if(row.sub_sator_name == null){
                        html = '';
                    } else {
                        html = row.sub_sator_name;
                    }
                    return html;
                    },
                },
                {
                    data: 'mail_quantity',
                    name: 'mail_quantity',
                    orderable: true,
                    searchable: true,
                    render: function(data, type, row) {
                    var html;
                    if(row.mail_quantity == null){
                        html = '';
                    } else {
                        html = '<b>'+row.mail_quantity+'</b> '+row.unit_name;
                    }
                    return html;
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
                    data: 'information',
                    name: 'information',
                    orderable: true,
                    searchable: true,
                    render: function(data, type, row) {
                        var html;
                        html = $('<div/>').html(data).text();
                        let archiveRemains = row.archive_remains || 'Tanpa Arsip';
                        return `(${archiveRemains})<br>${html}`;
                    }
                },
                {
                    data: 'created',
                    name: 'created',
                    orderable: true,
                    searchable: true,
                    render: function(data, type, row) {
                    var html;
                    if(row.created == null){
                        html = '';
                    } else {
                        var date = row.created.replace('T', ' ').split('.')[0];
                        html = date+'<br><b>'+row.created_by;
                    }
                    return html;
                    },
                },
                {
                    "data": null,
                    "defaultContent": '<button class="btn btn-primary btn-sm edit-btn">Edit</button> <button class="btn btn-sm btn-secondary cancel-btn" style="display: none;"><span class="mdi mdi-close-circle-outline"></span></button>',
                    "orderable": false,
                    className: 'text-center',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                },
                {
                    data: 'id',
                    name: 'id',
                    searchable: false,
                    visible: false
                },
            ],
            "drawCallback": function(settings) {
                if (firstReload) {
                    // Reset URL
                    let urlParams = new URLSearchParams(window.location.search);
                    if (urlParams.toString()) {
                        let newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
                        history.pushState({}, "", newUrl);
                    }
                    // Find the row with the `idUpdated` value
                    var row = table.row(function(idx, data, node) {
                        return data.id == idUpdated;
                    });
                    if (row.length) {
                        var rowNode = row.node();
                        // Scroll to the row
                        $('html, body').animate({
                            scrollTop: $(rowNode).offset().top - $(window).height() / 2
                        }, 500);
                        // Highlight the row for 5 seconds
                        $(rowNode).addClass('highlight');
                        setTimeout(function() {
                            $(rowNode).removeClass('highlight');
                        }, 3000);
                    }
                    firstReload = false;
                }
            }
        });

        $('<style>.highlight { background-color: #ffeb3b; transition: background-color 0.5s ease; }</style>').appendTo('head');

        //Check Table Update
        var lastUpdated = '{{ $lastUpdated }}';
        setTimeout(() => checkForChangeTable(lastUpdated), 10);
        var isCheckChange = true;

        $('#server-side-table tbody').on('click', '.edit-btn', function() {
            isCheckChange = false;
            var $row = $(this).closest('tr');
            makeRowEditable($row);
        });

        $('#server-side-table tbody').on('click', '.save-btn', function() {
            var $row = $(this).closest('tr');
            saveRowData($row);
        });

        $('#server-side-table tbody').on('click', '.cancel-btn', function() {
            isCheckChange = true;
            checkForChangeTable(lastUpdated);
            var $row = $(this).closest('tr');
            cancelRowEditing($row);
        });

        function makeRowEditable($row) {
            if (editingRow && editingRow.index() !== $row.index()) {
                cancelRowEditing(editingRow); // Cancel editing of previous row
            }

            originalData[$row.index()] = $row.find('td').map(function() {
            return $(this).html();
            }).get();

            $row.find('td').each(function(index) {
                if (index >= 3 && index <= 8) {
                    var $this = $(this);
                    var currentValue = $this.text().trim();
                    currentValue = (currentValue === "Null") ? "" : currentValue;
                    if(index === 3) {
                        var receiver = table.row($row).data().receiver;
                        receiver = receiver === null ? '' : receiver;
                        receiver = receiver || '';
                        $this.html('<textarea class="summernote-editor" type="text" value="' + receiver + '" style="width: 100%">' + receiver + '</textarea>');
                        $this.find('.summernote-editor').summernote({ toolbar: [] });
                    }
                    else if(index === 4) {
                        var mail_regarding = table.row($row).data().mail_regarding;
                        mail_regarding = mail_regarding === null ? '' : mail_regarding;
                        mail_regarding = mail_regarding || '';
                        $this.html('<textarea class="summernote-editor" type="text" value="' + mail_regarding + '" style="width: 100%">' + mail_regarding + '</textarea>');
                        $this.find('.summernote-editor').summernote({ toolbar: [] });
                    }
                    else if(index === 6) {
                        let number = null;
                        if (currentValue) {
                            let parts = currentValue.split(' ', 2);
                            number = parts[0];
                        }
                        $this.html('<input type="number" placeholder="Masukkan Perubahan.."  class="form-control form-control-sm" value="' + number + '">');
                    }
                    else if(index === 7) {
                        var attachment_text = table.row($row).data().attachment_text;
                        attachment_text = attachment_text === null ? '' : attachment_text;
                        attachment_text = attachment_text || '';
                        $this.html('<textarea class="summernote-editor" type="text" value="' + attachment_text + '" style="width: 100%">' + attachment_text + '</textarea>');
                        $this.find('.summernote-editor').summernote({ toolbar: [] });
                    }
                    else if(index === 8) {
                        var information = table.row($row).data().information;
                        information = information === null ? '' : information;
                        information = information || '';
                        $this.html('<textarea class="summernote-editor" type="text" value="' + information + '" style="width: 100%">' + information + '</textarea>');
                        $this.find('.summernote-editor').summernote({ toolbar: [] });
                    }
                }
            });

            $row.find('.edit-btn').html('<i class="fas fa-save"></i>').removeClass('btn-primary edit-btn').addClass('btn-success save-btn');
            $row.find('.cancel-btn').show();

            editingRow = $row;
        }

        function saveRowData($row) {
            var rowData = {};
            $row.find('td').each(function(index) {
                if (index >= 3 && index <= 8) {
                    var $this = $(this);
                    var newValue;
                    if(index == 3) {
                        newValue = $this.find('textarea').val();
                    }
                    else if(index == 4) {
                        newValue = $this.find('textarea').val();
                    }
                    else if(index == 6) {
                        newValue = $this.find('input').val();
                    } 
                    else if(index == 7) {
                        newValue = $this.find('textarea').val();
                    }
                    else if(index == 8) {
                        newValue = $this.find('textarea').val();
                    }
                    $this.html(newValue);
                    rowData[index] = newValue;
                }
            });

            var idData = table.row($row).data().id;
            var url = '{{ route("outgoingmail.directupdate", ":id") }}';
            url = url.replace(':id', idData);
            $row.find('.save-btn').prop('disabled', true).html('<i class="mdi mdi-loading mdi-spin"></i>').removeClass('btn-success save-btn').addClass('btn-primary edit-btn');
            $row.find('.cancel-btn').hide();
            isCheckChange = false;

            $.ajax({
                url: url,
                method: 'POST',
                data: rowData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    if(response.success === "Same"){
                        isCheckChange = true;
                        $('#errorModal').modal('show');
                        $('#errorMessage').text('Tidak Ada Perubahan, Data Sama Dengan Sebelumnya');
                        $row.find('.edit-btn').text('Edit').prop('disabled', false);
                    } else if(response.success) {
                        $('#successModal').modal('show');
                        $('#successMessage').text('Data Sukses Diubah!');
                        $row.find('.edit-btn').text('Edit').prop('disabled', false);

                        table.ajax.reload(null, false);
                        var row = table.row(function(idx, data, node) {
                            return data.id == response.idUpdated;
                        });
                        if (row.length) {
                            var rowNode = row.node();
                            $('html, body').animate({
                                scrollTop: $(rowNode).offset().top - $(window).height() / 2
                            }, 500);
                            $(rowNode).addClass('highlight');
                            setTimeout(function() {
                                $(rowNode).removeClass('highlight');
                            }, 3000);
                        }
                        lastUpdated = response.updatedAt;
                        setTimeout(() => {
                            isCheckChange = true;
                            checkForChangeTable(lastUpdated);
                        }, 5000);
                    } else {
                        isCheckChange = true;
                        $('#errorModal').modal('show');
                        $('#errorMessage').text('Data Gagal Diubah!');
                        $row.find('.edit-btn').text('Edit').prop('disabled', false);
                    }
                },
                error: function(error) {
                    isCheckChange = true;
                    $('#errorModal').modal('show');
                    $('#errorMessage').text('Data Gagal Diubah!');
                    $row.find('.edit-btn').text('Edit').prop('disabled', false);
                }
            });

            
            editingRow = null;
            cancelRowEditing($row);
        }

        function cancelRowEditing($row) {
            $row.find('td').each(function(index) {
            if (index >= 3 && index <= 8) {
                $(this).html(originalData[$row.index()][index]);
            }
            });
            $row.find('.save-btn').text('Edit').removeClass('btn-success save-btn').addClass('btn-primary edit-btn');
            $row.find('.cancel-btn').hide();

            editingRow = null;
        }

        // Function Table Update
        function checkForChangeTable(lastUpdated) {
            if (isCheckChange) {
                $.ajax({
                    url: '{{ route("outgoingmail.checkChanges") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        lastUpdated: lastUpdated
                    },
                    success: function (response) {
                        if (response.changes) {
                            $("#server-side-table").DataTable().ajax.reload();
                            lastUpdated = response.lastUpdatedNow;
                        }
                    },
                    complete: function () {
                        setTimeout(() => checkForChangeTable(lastUpdated), 5000);
                    },
                    error: function (xhr, status, error) {
                        console.error("Error in checkForChangeTable:", error);
                        setTimeout(() => checkForChangeTable(lastUpdated), 5000);
                    }
                });
            }
        }
    });
</script>

@endsection
