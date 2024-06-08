@extends('layouts.blackand.app')
@section('content')

@include('mail.head')

<div class="content-header">
  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1 class="m-0"><i class="mdi mdi-file-edit"></i> Ubah Surat Keluar</h1>
          </div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Beranda</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('outgoingmail.index') }}"> Daftar Surat Keluar</a></li>
                    <li class="breadcrumb-item active">Ubah</li>
              </ol>
          </div>
      </div>
  </div>
</div>

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

<!--validasi form with $validate-->
@if (count($errors)>0)
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <i class="mdi mdi-block-helper label-icon"></i><strong>&nbsp; Data Gagal Disimpan!</strong>
  <ul class="mb-0">
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
  </ul>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

<div class="container-fluid">
  <div class="card card-primary card-outline">
      <div class="card-header">
          <h3 class="card-title">
              Formulir Ubah Surat Keluar
          </h3>
      </div>
      <form action="{{ route('outgoingmail.update', encrypt($data->id)) }}" method="POST" enctype="multipart/form-data" id="formOutgoingMail">
        @csrf
        <div class="card-body" style="max-height: 65vh; overflow-y: auto;">
          <div class="card p-3" style="background-color:rgb(240, 240, 240);">
            <div class="row">
              {{-- Jenis Naskah --}}
              <div class="col-md-6">
                <div class="form-group">
                  <label  class="text-danger">Jenis Naskah *</label>
                  <input type="hidden" name="id_mst_letter" value="{{ $data->id_mst_letter }}" class="form-control">
                  <input type="text" value="{{ $data->let_name }}" class="form-control" readonly>

                  {{-- <select class="form-control js-example-basic-single" name="id_mst_letter" style="width: 100%;" required>
                    <option value="">- Pilih -</option>
                    @foreach($letters as $letter)
                      <option value="{{ $letter->id }}" @if($data->id_mst_letter == $letter->id) selected="selected" @endif>
                        {{ $letter->let_name }}
                      </option>
                    @endforeach
                  </select> --}}
                </div>
              </div>
              <div class="col-md-6"></div>
              {{-- Konseptor --}}
              <div class="col-md-6">
                <label  class="text-danger">Konseptor *</label>
                <div class="row">
                  <div class="col-md-8">
                    <select class="form-control js-example-basic-single" name="drafter" style="width: 100%;" required>
                      <option value="">- Pilih -</option>
                      @foreach($workunits as $workunit)
                        <option value="{{ $workunit->id }}" @if($data->drafter == $workunit->id) selected="selected" @endif>
                          {{ $workunit->work_name }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-4">
                    <button type="button" class="btn btn-secondary" style="width: 100%" data-toggle="modal" data-target="#unitKerja"><i class="fa fa-plus"></i> Tambah Baru</button>
                  </div>
                </div>
              </div>
              {{-- Kode Satuan Organisasi --}}
              <div class="col-md-6 mb-3">
                <label>Kode Satuan Organisasi</label>
                <div class="row">
                  <div class="col-md-8">
                    <select class="form-control js-example-basic-single" name="org_unit" style="width: 100%;">
                      <option value="">- Pilih -</option>
                      @foreach($sators as $sator)
                        <option value="{{ $sator->id }}" @if($data->org_unit == $sator->id) selected="selected" @endif>
                          {{ $sator->sator_name }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-4">
                    <button type="button" class="btn btn-secondary" style="width: 100%" data-toggle="modal" data-target="#satuanOrg"><i class="fa fa-plus"></i> Tambah Baru</button>
                  </div>
                </div>
                <small>(Harus diisi khusus untuk Jenis Naskah Surat, Nota Dinas, Surat Pengantar dan Telaahan Staf jika bukan ditandatangani oleh Kapolri/Wakapolri)</small>
              </div>
            </div>
          </div>
          <hr>
          <div class="row px-1">
            {{-- Perihal --}}
            <div class="col-md-12">
              <div class="form-group">
                <label  class="text-danger">Perihal / Tentang *</label>
                <textarea class="form-control editor" rows="3" type="text" name="mail_regarding" placeholder="Masukkan Perihal / Tentang Surat.." required>{{ $data->mail_regarding }}</textarea>
              </div>
            </div>
            {{-- Tanggal --}}
            <div class="col-md-3">
              <div class="form-group">
                <label  class="text-danger">Tanggal Keluar *</label>
                <input type="date" name="out_date" value="{{ \Carbon\Carbon::parse($data->out_date)->format('Y-m-d') }}" class="form-control" required>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label  class="text-danger">Tanggal Surat *</label>
                <input type="datetime-local" name="mail_date" value="{{ $data->mail_date }}" class="form-control" required>
              </div>
            </div>
            {{-- Penandatanganan --}}
            <div class="col-md-6">
              <label  class="text-danger">Penandatanganan *</label>
              <div class="row">
                <div class="col-md-8">
                  <select class="form-control js-example-basic-single" name="signing" style="width: 100%;" required>
                    <option value="">- Pilih -</option>
                    @foreach($workunits as $workunit)
                      <option value="{{ $workunit->id }}" @if($data->signing == $workunit->id) selected="selected" @endif>
                        {{ $workunit->work_name }}
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-4">
                  <button type="button" class="btn btn-secondary" style="width: 100%" data-toggle="modal" data-target="#unitKerja"><i class="fa fa-plus"></i> Tambah Baru</button>
                </div>
              </div>
            </div>
            {{-- Penandatanganan Pihak Instansi Lain --}}
            <div class="col-md-6">
              <div class="form-group">
                <label>Penandatanganan Pihak Instansi Lain</label>
                <textarea class="form-control" rows="3" type="text" name="signing_other" placeholder="Masukkan Pihak Instansi Lain..">{{ $data->signing_other }}</textarea>
              </div>
            </div>
            {{-- Penerima --}}
            <div class="col-md-6">
              <div class="form-group">
                <label  class="text-danger">Penerima *</label>
                <textarea class="form-control" rows="3" type="text" name="receiver" placeholder="Masukkan Penerima..">{{ $data->receiver }}</textarea>
              </div>
            </div>
            {{-- Jumlah --}}
            <div class="col-md-2">
              <div class="form-group">
                <label  class="text-danger">Jumlah *</label>
                <input type="number" name="mail_quantity" value="{{ $data->mail_quantity }}" class="form-control" placeholder="Masukkan Jumlah.." required>
              </div>
            </div>
            {{-- Satuan --}}
            <div class="col-md-2">
              <div class="form-group">
                <label  class="text-danger">Satuan *</label>
                <select class="form-control js-example-basic-single" name="mail_unit" style="width: 100%;" required>
                  <option value="">- Pilih -</option>
                  @foreach($unitletters as $unitletter)
                    <option value="{{ $unitletter->id }}" @if($data->mail_unit == $unitletter->id) selected="selected" @endif>
                      {{ $unitletter->unit_name }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>&nbsp;</label>
                <button type="button" class="btn btn-secondary" style="width: 100%" data-toggle="modal" data-target="#satuan"><i class="fa fa-plus"></i> Tambah Baru</button>
              </div>
            </div>
            {{-- Arsip Pertinggal --}}
            <div class="col-md-4">
              <div class="form-group">
                <label  class="text-danger">Arsip Pertinggal *</label>
                <select class="form-control js-example-basic-single" name="archive_remain" style="width: 100%;" required>
                  <option value="">- Pilih -</option>
                  <option value="Test" @if($data->archive_remains == 'Test') selected="selected" @endif>Test</option>
                </select>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>&nbsp;</label>
                <button type="button" class="btn btn-secondary" style="width: 100%" data-toggle="modal" data-target="#archiveRemain"><i class="fa fa-plus"></i> Tambah Baru</button>
              </div>
            </div>
            {{-- Klasifikasi Arsip --}}
            <div class="col-md-4">
              <div class="form-group">
                <label>Klasifikasi Arsip</label>
                <select class="form-control js-example-basic-single" name="archive_classification" style="width: 100%;">
                  <option value="">- Pilih -</option>
                  @foreach($classifications as $classification)
                    <option value="{{ $classification->id }}" @if($data->archive_classification == $classification->id) selected="selected" @endif>
                      {{ $classification->classification_name }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>&nbsp;</label>
                <button type="button" class="btn btn-secondary" style="width: 100%" data-toggle="modal" data-target="#klasifikasi"><i class="fa fa-plus"></i> Tambah Baru</button>
              </div>
            </div>
            {{-- Retensi Surat --}}
            <div class="col-md-3">
              <div class="form-group">
                <label>Retensi Surat (Dari)</label>
                <input type="date" name="mail_retention_from" value="{{ \Carbon\Carbon::parse($data->mail_retention_from)->format('Y-m-d') }}" class="form-control">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Retensi Surat (Hingga)</label>
                <input type="date" name="mail_retention_to" value="{{ \Carbon\Carbon::parse($data->mail_retention_to)->format('Y-m-d') }}" class="form-control">
              </div>
            </div>
            {{-- Lokasi Simpan --}}
            <div class="col-md-5">
              <div class="form-group">
                <label>Lokasi Simpan</label>
                <input type="text" name="save_location" id="saveLocation" value="{{ $data->location_save }}" class="form-control" placeholder="Pilih Lokasi Simpan.." readonly>
              </div>
            </div>
            <div class="col-md-1">
              <div class="form-group">
                <label>&nbsp;</label>
                <button type="button" class="btn btn-secondary" style="width: 100%" data-toggle="modal" data-target="#locSave">...</button>
              </div>
            </div>
            {{-- Dikirim Via --}}
            <div class="col-md-6">
              <div class="form-group">
                <label>Dikirim Via</label>
                <select class="form-control js-example-basic-single" name="received_via" style="width: 100%;">
                  <option value="">- Pilih -</option>
                  @foreach($receivedvias as $receivedvia)
                    <option value="{{ $receivedvia->name_value }}" @if($data->received_via == $receivedvia->name_value) selected="selected" @endif>
                      {{ $receivedvia->name_value }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>
            {{-- Nomor Referensi --}}
            <div class="col-md-6">
              <div class="form-group">
                <label>Nomor Referensi</label>
                <input type="text" name="ref_number" value="{{ $data->ref_number }}" class="form-control" placeholder="Masukan Nomor Referensi..">
              </div>
            </div>
            {{-- Referensi Surat --}}
            <div class="col-md-5">
              <div class="form-group">
                <label>Referensi Surat</label>
                <input type="text" id="mail_ref" name="mail_ref" value="{{ $data->ref_mail }}" class="form-control" placeholder="Pilih Referensi Surat.." readonly>
              </div>
            </div>
            <div class="col-md-1">
              <div class="form-group">
                <label>&nbsp;</label>
                <button type="button" class="btn btn-secondary" style="width: 100%" data-toggle="modal" data-target="#refMail">...</button>
              </div>
            </div>
            {{-- Lampiran --}}
            <div class="col-md-6">
              <div class="form-group">
                <label>Lampiran</label>
                <textarea class="form-control editor" rows="3" type="text" name="attachment_text" placeholder="Masukkan Lampiran..">{{ $data->attachment_text }}</textarea>
              </div>
            </div>
            {{-- Keterangan --}}
            <div class="col-md-6">
              <div class="form-group">
                <label>Keterangan</label>
                <textarea class="form-control editor" rows="3" type="text" name="information" placeholder="Masukkan Keterangan..">{{ $data->information }}</textarea>
              </div>
            </div>

          </div>
        </div>
        {{-- Lokasi Simpan --}}
        <div class="modal fade" id="locSave" data-backdrop="static" data-keyboard="false" aria-labelledby="modalAddLabel" aria-hidden="true">
          <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #0074F1; color: white;">
                  <h5 class="modal-title font-weight-bold" id="modalAddLabel">Pilih Lokasi Simpan</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white">
                      <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" style="max-height: 65vh; overflow-y: auto;">
                  <div class="form-group">
                    <label class="text-danger">Nama Gedung*</label>
                    <select class="form-control js-example-basic-single" name="namaGedung" id="namaGedung" style="width: 100%;">
                      <option value="">- Pilih -</option>
                      <option value="1">Gedung A</option>
                      <option value="2">Gedung B</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="text-danger">Nama Lantai*</label>
                    <select class="form-control js-example-basic-single" name="namaLantai" id="namaLantai" style="width: 100%;">
                      <option value="">- Pilih -</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="text-danger">Nama Ruang*</label>
                    <select class="form-control js-example-basic-single" name="namaRuang" id="namaRuang" style="width: 100%;">
                      <option value="">- Pilih -</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="text-danger">Nama Rak*</label>
                    <select class="form-control js-example-basic-single" name="namaRak" id="namaRak" style="width: 100%;">
                      <option value="">- Pilih -</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="text-danger">Nama Baris*</label>
                    <select class="form-control js-example-basic-single" name="namaBaris" id="namaBaris" style="width: 100%;">
                      <option value="">- Pilih -</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="text-danger">Nama Kolom*</label>
                    <select class="form-control js-example-basic-single" name="namaKolom" id="namaKolom" style="width: 100%;">
                      <option value="">- Pilih -</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="text-danger">Nama Boks*</label>
                    <select class="form-control js-example-basic-single" name="namaBoks" id="namaBoks" style="width: 100%;">
                      <option value="">- Pilih -</option>
                    </select>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  <button type="button" class="btn btn-primary" id="chooseLocSave" disabled>Pilih</button>
                </div>
                <script>
                  function populateSelect($select, data, idField, textField) {
                    $select.empty().append('<option value="">- Pilih -</option>');
                    $.each(data, function(index, item) {
                      $select.append($('<option>', { 
                        value: item[idField],
                        'data-Text': item[textField],
                        text : item[textField],
                      }));
                    });
                  }
        
                  const lantais = [
                    { id: 1, gedungId: 1, name: "Lantai 1" },
                    { id: 2, gedungId: 1, name: "Lantai 2" },
                    { id: 3, gedungId: 2, name: "Lantai 1" },
                    { id: 4, gedungId: 2, name: "Lantai 2" }
                  ];
        
                  const ruangs = [
                    { id: 1, lantaiId: 1, name: "Ruang 101" },
                    { id: 2, lantaiId: 1, name: "Ruang 102" },
                    { id: 3, lantaiId: 2, name: "Ruang 201" },
                    { id: 4, lantaiId: 2, name: "Ruang 202" },
                    { id: 5, lantaiId: 3, name: "Ruang 101" },
                    { id: 6, lantaiId: 3, name: "Ruang 102" },
                    { id: 7, lantaiId: 4, name: "Ruang 201" },
                    { id: 8, lantaiId: 4, name: "Ruang 202" }
                  ];
        
                  const raks = [
                    { id: 1, ruangId: 1, name: "Rak 1" },
                    { id: 2, ruangId: 1, name: "Rak 2" },
                    { id: 3, ruangId: 2, name: "Rak 1" },
                    { id: 4, ruangId: 2, name: "Rak 2" },
                    { id: 5, ruangId: 3, name: "Rak 1" },
                    { id: 6, ruangId: 3, name: "Rak 2" }
                  ];
        
                  const bariss = [
                    { id: 1, rakId: 1, name: "Baris 1" },
                    { id: 2, rakId: 1, name: "Baris 2" },
                    { id: 3, rakId: 2, name: "Baris 1" },
                    { id: 4, rakId: 2, name: "Baris 2" }
                  ];
        
                  const koloms = [
                    { id: 1, barisId: 1, name: "Kolom 1" },
                    { id: 2, barisId: 1, name: "Kolom 2" },
                    { id: 3, barisId: 2, name: "Kolom 1" },
                    { id: 4, barisId: 2, name: "Kolom 2" }
                  ];
        
                  const boks = [
                    { id: 1, kolomId: 1, name: "Boks 1" },
                    { id: 2, kolomId: 1, name: "Boks 2" },
                    { id: 3, kolomId: 2, name: "Boks 1" },
                    { id: 4, kolomId: 2, name: "Boks 2" }
                  ];
        
                  $('select[id="namaGedung"]').on('change', function() {
                    $('#saveLocation').val("");
                    const gedungId = $(this).val();
                    const filteredLantais = lantais.filter(lantai => lantai.gedungId == gedungId);
                    populateSelect($('#namaLantai'), filteredLantais, 'id', 'name');
                    
                    $('#namaRuang').empty().append('<option value="">- Pilih -</option>');
                    $('#namaRak').empty().append('<option value="">- Pilih -</option>');
                    $('#namaBaris').empty().append('<option value="">- Pilih -</option>');
                    $('#namaKolom').empty().append('<option value="">- Pilih -</option>');
                    $('#namaBoks').empty().append('<option value="">- Pilih -</option>');
                    $('#chooseLocSave').attr('disabled', 'disabled');
                  });
                  $('select[id="namaLantai"]').on('change', function() {
                    $('#saveLocation').val("");
                    const lantaiId = $(this).val();
                    const filteredRuangs = ruangs.filter(ruang => ruang.lantaiId == lantaiId);
                    populateSelect($('#namaRuang'), filteredRuangs, 'id', 'name');
                    
                    $('#namaRak').empty().append('<option value="">- Pilih -</option>');
                    $('#namaBaris').empty().append('<option value="">- Pilih -</option>');
                    $('#namaKolom').empty().append('<option value="">- Pilih -</option>');
                    $('#namaBoks').empty().append('<option value="">- Pilih -</option>');
                    $('#chooseLocSave').attr('disabled', 'disabled');
                  });
                  $('select[id="namaRuang"]').on('change', function() {
                    $('#saveLocation').val("");
                    const ruangId = $(this).val();
                    const filteredRaks = raks.filter(rak => rak.ruangId == ruangId);
                    populateSelect($('#namaRak'), filteredRaks, 'id', 'name');
                    
                    $('#namaBaris').empty().append('<option value="">- Pilih -</option>');
                    $('#namaKolom').empty().append('<option value="">- Pilih -</option>');
                    $('#namaBoks').empty().append('<option value="">- Pilih -</option>');
                    $('#chooseLocSave').attr('disabled', 'disabled');
                  });
                  $('select[id="namaRak"]').on('change', function() {
                    $('#saveLocation').val("");
                    const rakId = $(this).val();
                    const filteredBariss = bariss.filter(baris => baris.rakId == rakId);
                    populateSelect($('#namaBaris'), filteredBariss, 'id', 'name');
                    
                    $('#namaKolom').empty().append('<option value="">- Pilih -</option>');
                    $('#namaBoks').empty().append('<option value="">- Pilih -</option>');
                    $('#chooseLocSave').attr('disabled', 'disabled');
                  });
                  $('select[id="namaBaris"]').on('change', function() {
                    $('#saveLocation').val("");
                    const barisId = $(this).val();
                    const filteredKoloms = koloms.filter(kolom => kolom.barisId == barisId);
                    populateSelect($('#namaKolom'), filteredKoloms, 'id', 'name');
        
                    $('#namaBoks').empty().append('<option value="">- Pilih -</option>');
                    $('#chooseLocSave').attr('disabled', 'disabled');
                  });
                  $('select[id="namaKolom"]').on('change', function() {
                    $('#saveLocation').val("");
                    const kolomId = $(this).val();
                    const filteredBoks = boks.filter(boks => boks.kolomId == kolomId);
                    populateSelect($('#namaBoks'), filteredBoks, 'id', 'name');
        
                    $('#chooseLocSave').attr('disabled', 'disabled');
                  });
        
                  $('select[id="namaBoks"]').on('change', function() {
                    $('#saveLocation').val("");
                    var namaBoks = $(this).val();
                    if(namaBoks == null || namaBoks == ""){
                      $('#chooseLocSave').attr('disabled', 'disabled');
                    } else {
                      $('#chooseLocSave').removeAttr('disabled');
                    }
                  });
                  $('#chooseLocSave').on('click', function() {
                    var namaBoks = $('select[id="namaBoks"]').find('option:selected').attr('data-Text');
                    $('#saveLocation').val(namaBoks);
                    $('#chooseLocSave').attr('data-dismiss', 'modal').trigger('click');
                  });
                </script>
            </div>
          </div>
        </div>
        {{-- Referensi Surat --}}
        <div class="modal fade" id="refMail" data-backdrop="static" data-keyboard="false" aria-labelledby="modalAddLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #0074F1; color: white;">
                  <h5 class="modal-title font-weight-bold" id="modalAddLabel">Pilih Referensi Surat</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white">
                      <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" style="height: 70vh">
                  <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Nomor Dokumen / Perihal</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="searchInput" placeholder="Masukkan Nomor Dokumen / Perihal.." aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary btn-primary text-white" type="button" id="button-addon2">Gunakan Filter & Cari</button>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="col-12" style="height: 50vh; overflow-y: auto;">
                        <table id="server-side-table" class="table table-bordered" style="font-size: small; width:100%;">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Perihal / Tentang</th>
                                    <th scope="col">Tipe</th>
                                    <th scope="col">Tgl. Perubahan</th>
                                    <th scope="col">Pengubah</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <script>
                    $(function() {
                        var table = $('#server-side-table').DataTable({
                            processing: true,
                            serverSide: true,
                            ajax: '{!! route('outgoingmail.edit', encrypt($data->id)) !!}',
                            lengthMenu: [5],
                            columns: [
                                { data: null,
                                    render: function(data, type, row, meta) {
                                        return meta.row + meta.settings._iDisplayStart + 1;
                                    },
                                    orderable: false,
                                    searchable: false,
                                    className: 'align-middle text-center',
                                },
                                { data: 'mail_regarding', name: 'mail_regarding', orderable: true, searchable: true, className: 'align-middle text-center' },
                                { data: 'receiver', name: 'receiver', orderable: true, searchable: true, className: 'align-middle text-center' },
                                { data: 'updated_at', name: 'updated_at', orderable: true, searchable: true, className: 'align-middle text-center' },
                                { data: 'created_by', name: 'created_by', orderable: true, searchable: true, className: 'align-middle text-center' },
                                { data: 'action', name: 'action', orderable: false, searchable: false, className: 'align-middle text-center' },
                            ],
                        });
                        $('.dataTables_wrapper .dataTables_length').hide();
                        $('.dataTables_wrapper .dataTables_filter').hide();
                
                        $('#button-addon2').on('click', function() {
                            var searchTerm = $('#searchInput').val();
                            table.search(searchTerm).draw();
                        });
                    });
                </script>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeRef">Tutup</button>
                </div>
            </div>

          </div>
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="col-12" style="text-align: right">
              <a href="{{ route('outgoingmail.index') }}" type="button" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
              <button type="submit" class="btn btn-primary" id="sbFormOutgoingMail"><i class="mdi mdi-update"></i> Ubah Data</button>
            </div>
          </div>
        </div>
      </form>
      <script>
          document.getElementById('formOutgoingMail').addEventListener('submit', function(event) {
              if (!this.checkValidity()) {
                  event.preventDefault();
                  return false;
              }
              var submitButton = this.querySelector('button[id="sbFormOutgoingMail"]');
              submitButton.disabled = true;
              submitButton.innerHTML  = '<i class="mdi mdi-loading mdi-spin"></i> Mohon Tunggu...';
              return true;
          });
      </script>
  </div>
</div>

{{-- MODAL ADD --}}
@include('mail.modal')

{{-- CKEDITOR --}}
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
  // Get all textareas with the class 'editor' and initialize CKEditor for each
  document.querySelectorAll('.editor').forEach(textarea => {
      ClassicEditor
          .create(textarea)
          .catch(error => {
              console.error(error);
          });
  });
</script>

<script>
  $(".js-example-basic-single").select2().on("select2:open", function () {
      document.querySelector(".select2-search__field").focus();
  });
</script>

@endsection