@extends('layouts.blackand.appother')
@section('content')

    <style>
        .select2-container .select2-selection--single {
        height: 30px;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        }
        .select2-container--default
            .select2-selection--single
            .select2-selection__rendered {
            line-height: 20px;
            color: #495057;
        }
        .small-date-input {
            width: 50px;
        }
    </style>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex justify-content-start align-items-center">
                        <a href="{{ route('incommingmail.create') }}" type="button" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Baru</a>
                        <a href="{{ route('incommingmail.createbulk') }}" type="button" class="btn btn-sm btn-info ml-1"><i class="mdi mdi-plus-box-multiple"></i> Tambah Baru (Bulk) </a>
                        <a href="{{ route('incommingmail.rekapitulasi') }}" type="button" class="btn btn-sm btn-primary ml-1"><i class="mdi mdi-printer-search"></i> Rekapitulasi</a>
                    </div>
                    <div class="d-flex justify-content-end align-items-center">
                        <form action="{{ route('incommingmail.index.post') }}" method="POST" id="resetForm" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="entry_date" value="">
                            <input type="hidden" name="mail_date" value="">
                            <input type="hidden" name="mail_number" value="">
                            <input type="hidden" name="placeman" value="">
                            <input type="hidden" name="org_unit" value="">
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
                            <th rowspan="2" class="align-middle text-center">No. Agenda</th>
                            <th colspan="3" class="align-middle text-center">Naskah / Surat</th>
                            <th rowspan="2" class="align-middle text-center">Kepada</th>
                            <th rowspan="2" class="align-middle text-center">Jumlah</th>
                            <th rowspan="2" class="align-middle text-center">Lampiran</th>
                            <th rowspan="2" class="align-middle text-center">Keterangan</th>
                            <th rowspan="2" class="align-middle text-center">Tgl. Dibuat</th>
                            <th rowspan="2" class="align-middle text-center">Ubah</th>
                            <th rowspan="2" class="align-middle text-center">Aksi</th>
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
                <form action="{{ route('incommingmail.index.post') }}" method="POST" enctype="multipart/form-data" id="modalSearch">
                    @csrf
                    <div class="modal-body" style="max-height: 65vh; overflow-y: auto;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tanggal Agenda</label>
                                    <input type="date" name="entry_date" value="{{ $entry_date }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
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
                                    <label id="labeljenisNaskah">Jenis Naskah</label>
                                    <div id="jenisNaskah">
                                        <select class="form-control js-example-basic-single" id="mst_letter" name="letter" style="width: 100%;">
                                            <option value="">- Pilih -</option>
                                            @foreach($letters as $item)
                                            <option value="{{ $item->id }}" @if($letter == $item->id) selected="selected" @endif>{{ $item->let_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
            
                                    <div id="jenisPengaduan" hidden>
                                        <select class="form-control js-example-basic-single" id="mst_complain" name="complain" style="width: 100%;">
                                            <option value="">- Pilih -</option>
                                            @foreach($complains as $item)
                                            <option value="{{ $item->id }}" @if($complain == $item->id) selected="selected" @endif>{{ $item->com_code }} - {{ $item->com_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
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
                <script>
                    const labeljenisNaskah = document.getElementById('labeljenisNaskah');
                    const jenisNaskah = document.getElementById('jenisNaskah');
                    const jenisPengaduan = document.getElementById('jenisPengaduan');
                    const idLetter = document.getElementById('mst_letter');
                    const idComplain = document.getElementById('mst_complain');
    
                    var placemanBefore = "{{ $placeman }}";
                    if (placemanBefore == 'LITNADIN') {
                        labeljenisNaskah.textContent = "Jenis Naskah *";
                        jenisNaskah.hidden = false;
                        jenisPengaduan.hidden = true;
                    } 
                    else if (placemanBefore == 'PENGADUAN') 
                    {
                        labeljenisNaskah.textContent = "Jenis Pengaduan *";
                        jenisNaskah.hidden = true;
                        jenisPengaduan.hidden = false;
                    } 
                    else 
                    {
                        labeljenisNaskah.textContent = "Jenis Naskah *";
                        jenisNaskah.hidden = false;
                        jenisPengaduan.hidden = true;
                    }
    
                    $('select[id="placeman"]').on('change', function() {
                        const placeman = $(this).val();
                        if (placeman == 'LITNADIN') {
                            labeljenisNaskah.textContent = "Jenis Naskah *";
                            jenisNaskah.hidden = false;
                            jenisPengaduan.hidden = true;
                        } 
                        else if (placeman == 'PENGADUAN') 
                        {
                            labeljenisNaskah.textContent = "Jenis Pengaduan *";
                            jenisNaskah.hidden = true;
                            jenisPengaduan.hidden = false;
                        } 
                        else 
                        {
                            labeljenisNaskah.textContent = "Jenis Naskah *";
                            jenisNaskah.hidden = false;
                            jenisPengaduan.hidden = true;
                        }
                    });
                </script>
            </div>
        </div>
    </div>

    <!-- Modal for Success -->
    <div class="modal fade" id="successModal" data-backdrop="static" data-keyboard="false" aria-labelledby="modalAddLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #0074F1; color: white;">
                <h5 class="modal-title font-weight-bold" id="modalAddLabel">Sukses</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h6 id="successMessage"></h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Error -->
    <div class="modal fade" id="errorModal" data-backdrop="static" data-keyboard="false" aria-labelledby="modalAddLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #0074F1; color: white;">
                <h5 class="modal-title font-weight-bold" id="modalAddLabel">Gagal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h6 id="errorMessage"></h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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

            var table = $('#server-side-table').DataTable({
                "processing": true,
                "serverSide": true,
                "scrollX": true,
                "ajax": {
                    "url": '{!! route('incommingmail.index') !!}', // Replace with your server URL
                    "type": "GET",
                    "data": {
                        entry_date: '{{ $entry_date }}',
                        mail_date: '{{ $mail_date }}',
                        mail_number: '{{ $mail_number }}',
                        placeman: '{{ $placeman }}',
                        org_unit: '{{ $org_unit }}',
                        letter: '{{ $letter }}',
                    }
                },
                "columns": [
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
                        data: 'entry_date',
                        name: 'entry_date',
                        orderable: true,
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
                        data: 'agenda_number',
                        name: 'agenda_number',
                        orderable: true,
                        searchable: true,
                        className: 'text-center',
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
                        orderable: true,
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
                    // {
                    //     data: 'sub_sator_name',
                    //     name: 'sub_sator_name',
                    //     orderable: true,
                    //     searchable: true,
                    //     className: 'text-center',
                    //     render: function(data, type, row) {
                    //         var html
                    //         if(row.sub_sator_name == null){
                    //             html = '';
                    //         } else {
                    //             html = row.sub_sator_name;
                    //         }
                    //         return html;
                    //     },
                    // },
                    {
                        data: 'sender',
                        name: 'sender',
                        orderable: true,
                        searchable: true,
                        className: 'text-center',
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
                        orderable: true,
                        searchable: true,
                        render: function(data, type, row) {
                            return $('<div/>').html(data).text();
                        }
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
                                html = '';
                            } else {
                                html = row.receiver;
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
                            return $('<div/>').html(data).text();
                        }
                    },
                    {
                        data: 'created',
                        name: 'created',
                        orderable: true,
                        searchable: true,
                        render: function(data, type, row) {
                            var html
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
                    {
                        data: 'placeman',
                        name: 'placeman',
                        searchable: false,
                        visible: false
                    },
                ]
            });

            //Check Table Update
            var lastUpdated = '{{ $lastUpdated }}';
            setTimeout(() => checkForChangeIncomming(lastUpdated), 10);

            // setTimeout(checkForChanges, 10);
            // setTimeout(checkForChanges, 20);
            // setTimeout(checkForChangeUpdate, 10);
            // setTimeout(checkForChangeUpdate, 20);

            function makeRowEditable($row) {
                if (editingRow && editingRow.index() !== $row.index()) {
                    cancelRowEditing(editingRow);
                }

                originalData[$row.index()] = $row.find('td').map(function() {
                return $(this).html();
                }).get();

                $row.find('td').each(function(index) {
                    if (index >= 1 && index <= 9) {
                        var $this = $(this);
                        var currentValue = $this.text().trim();
                        currentValue = (currentValue === "Null") ? "" : currentValue;
                        if(index === 1) {
                            var dateVal = table.row($row).data().entry_date;
                            if(dateVal === null) {
                                dateVal = "";
                            } else {
                                dateVal = dateVal;
                            }
                            $this.html('<input type="datetime-local" class="form-control form-control-sm small-date-input" value="' + dateVal + '">');
                        }
                        // else if(index === 2) {
                        //     $this.html('<input type="text" placeholder="Masukkan Perubahan.."  class="form-control form-control-sm" value="' + currentValue + '">');
                        // }
                        else if(index === 3) {
                            $this.html('<input type="text" placeholder="Masukkan Perubahan.."  class="form-control form-control-sm" value="' + currentValue + '">');
                        }
                        else if(index === 4) {
                            $this.html('<input type="text" placeholder="Masukkan Perubahan.."  class="form-control form-control-sm" value="' + currentValue + '">');
                        }
                        // else if(index === 4) {
                        //     var placemanVal = table.row($row).data().placeman;
                        //     if(placemanVal === "LITNADIN"){
                        //         var selectValue = $this.text();
                        //         var options = '<select class="form-control js-example-basic-single">';
                        //         options += '<option value="">- Pilih -</option>';
                        //         @foreach($workunits as $workunit)
                        //             var work_name = '{{ $workunit->work_name }}';
                        //             options += '<option value="{{ $workunit->work_name }}" ' + (work_name === selectValue ? 'selected' : '') + '>{{ $workunit->work_name }}</option>';
                        //         @endforeach
                        //         options += '</select>';
                        //         $this.html(options);
                        //         $this.find('.js-example-basic-single').select2();
                        //     } else {
                        //         $this.html('<input type="text" placeholder="Masukkan Perubahan.."  class="form-control form-control-sm" value="' + currentValue + '">');
                        //     }
                        // }
                        else if(index === 5) {
                            var mail_regarding = table.row($row).data().mail_regarding;
                            $this.html('<textarea class="summernote-editor" type="text" value="' + mail_regarding + '" style="width: 100%">' + mail_regarding + '</textarea>');
                            $this.find('.summernote-editor').summernote({ toolbar: [] });
                        }
                        else if(index === 6) {
                            var selectValue = $this.text();
                            var options = '<select class="form-control js-example-basic-single">';
                            options += '<option value="">- Pilih -</option>';
                            @foreach($receiverMails as $receiver)
                                var receiver = '{{ $receiver->name_value }}';
                                options += '<option value="{{ $receiver->name_value }}" ' + (receiver === selectValue ? 'selected' : '') + '>{{ $receiver->name_value }}</option>';
                            @endforeach
                            options += '</select>';
                            $this.html(options);
                            $this.find('.js-example-basic-single').select2();
                        }
                        else if(index === 7) {
                            let number = null;
                            if (currentValue) {
                                let parts = currentValue.split(' ', 2);
                                number = parts[0];
                            }
                            $this.html('<input type="number" placeholder="Masukkan Perubahan.."  class="form-control form-control-sm" value="' + number + '">');
                        } 
                        else if(index === 8) {
                            var attachment_text = table.row($row).data().attachment_text;
                            $this.html('<textarea class="summernote-editor" type="text" value="' + attachment_text + '" style="width: 100%">' + attachment_text + '</textarea>');
                            $this.find('.summernote-editor').summernote({ toolbar: [] });
                        }
                        else if(index === 9) {
                            var information = table.row($row).data().information;
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
                    if (index >= 1 && index <= 9) {
                        var $this = $(this);
                        var newValue;
                        if(index == 1) {
                            newValue = $this.find('input').val();
                        }
                        // else if(index == 2) {
                        //     newValue = $this.find('input').val();
                        // }
                        else if(index == 3) {
                            newValue = $this.find('input').val();
                        }
                        else if(index == 4) {
                            newValue = $this.find('input').val();
                        }
                        // else if(index == 4) {
                        //     var placemanVal = table.row($row).data().placeman;
                        //     if(placemanVal === "LITNADIN"){
                        //         newValue = $this.find('select').val();
                        //     } else {
                        //         newValue = $this.find('input').val();
                        //     }
                        // }
                        else if(index == 5) {
                            newValue = $this.find('textarea').val();
                        }
                        else if(index == 6) {
                            newValue = $this.find('select').val();
                        }
                        else if(index == 7) {
                            newValue = $this.find('input').val();
                        } 
                        else if(index == 8) {
                            newValue = $this.find('textarea').val();
                        }
                        else if(index == 9) {
                            newValue = $this.find('textarea').val();
                        }
                        $this.html(newValue);
                        rowData[index] = newValue;
                    }
                });

                var idData = table.row($row).data().id;
                var url = '{{ route("incommingmail.directupdate", ":id") }}';
                url = url.replace(':id', idData);

                $row.find('.save-btn').prop('disabled', true).html('<i class="mdi mdi-loading mdi-spin"></i>').removeClass('btn-success save-btn').addClass('btn-primary edit-btn');
                $row.find('.cancel-btn').hide();

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: rowData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if(response.success === "Same"){
                            $('#errorModal').modal('show');
                            $('#errorMessage').text('Tidak Ada Perubahan, Data Sama Dengan Sebelumnya');
                            $row.find('.edit-btn').text('Edit').prop('disabled', false);
                        } else if(response.success) {
                            $('#successModal').modal('show');
                            $('#successMessage').text('Data Sukses Diubah!');
                            $row.find('.edit-btn').text('Edit').prop('disabled', false);
                            $("#server-side-table").DataTable().ajax.reload();
                        } else {
                            $('#errorModal').modal('show');
                            $('#errorMessage').text('Data Gagal Diubah!');
                            $row.find('.edit-btn').text('Edit').prop('disabled', false);
                        }
                    },
                    error: function(error) {
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
                if (index >= 1 && index <= 9) {
                    $(this).html(originalData[$row.index()][index]);
                }
                });
                $row.find('.save-btn').text('Edit').removeClass('btn-success save-btn').addClass('btn-primary edit-btn');
                $row.find('.cancel-btn').hide();

                editingRow = null;
            }

            $('#server-side-table tbody').on('click', '.edit-btn', function() {
                var $row = $(this).closest('tr');
                makeRowEditable($row);
            });

            $('#server-side-table tbody').on('click', '.save-btn', function() {
                var $row = $(this).closest('tr');
                saveRowData($row);
            });

            $('#server-side-table tbody').on('click', '.cancel-btn', function() {
                var $row = $(this).closest('tr');
                cancelRowEditing($row);
            });

            // $(document.body).on('click', function(e) {
            //     if (!$(e.target).closest('tr').length && editingRow) {
            //     cancelRowEditing(editingRow);
            //     }
            // });
        });

        // Function Table Update
        function checkForChangeIncomming(lastUpdated) {
            $.ajax({
                url: '{{ route("incommingmail.checkChangeIncomming") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    lastUpdated: lastUpdated
                },
                success: function (response) {
                    // console.log('Last : ' + lastUpdated);
                    // console.log('Now : ' + response.lastUpdatedNow);
                    if (response.changes) {
                        $("#server-side-table").DataTable().ajax.reload();
                        lastUpdated = response.lastUpdatedNow;
                    }
                },
                complete: function () {
                    setTimeout(() => checkForChangeIncomming(lastUpdated), 5000); // every 5s
                },
                error: function (xhr, status, error) {
                    console.error("Error in checkForChangeIncomming:", error);
                    setTimeout(() => checkForChangeIncomming(lastUpdated), 5000);
                }
            });
        }
        // function checkForChanges() {
        //     $.ajax({
        //         url: '{{ route("incommingmail.checkChanges") }}',
        //         method: 'GET',
        //         success: function(response) {
        //             if (response.changes) {
        //                 $("#server-side-table").DataTable().ajax.reload();
        //             }
        //         },
        //         complete: function() {
        //             setTimeout(checkForChanges, 10);
        //         }
        //     });
        // }
        // function checkForChangeUpdate() {
        //     $.ajax({
        //         url: '{{ route("incommingmail.checkChangeUpdate") }}',
        //         method: 'GET',
        //         success: function(response) {
        //             if (response.changes) {
        //                 $("#server-side-table").DataTable().ajax.reload();
        //             }
        //         },
        //         complete: function() {
        //             setTimeout(checkForChangeUpdate, 10);
        //         }
        //     });
        // }
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
