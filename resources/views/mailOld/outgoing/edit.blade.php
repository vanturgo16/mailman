@extends('layouts.blackand.appother')
@section('content')

@include('mail.head')

<div class="content-header">
  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1 class="m-0"><i class="mdi mdi-file-edit"></i> Formulir Ubah Surat Keluar</h1>
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
@include('mail.alert')

<div class="container-fluid">
  <div class="card card-primary card-outline">
      <div class="card-header"><h3 class="card-title"></h3></div>
      <form action="{{ route('outgoingmail.update', encrypt($data->id)) }}" method="POST" enctype="multipart/form-data" id="formOutgoingMail">
        @csrf
        <div class="card-body" style="max-height: 55vh; overflow-y: auto;">
          <div class="card p-3" style="background-color:rgb(240, 240, 240);">
            {{-- Jenis Naskah --}}
            <div class="row row-separator">
              <div class="col-3">
                <label class="text-danger">Jenis Naskah *</label>
              </div>
              <div class="col-9">
                <input type="hidden" name="id_mst_letter" value="{{ $data->id_mst_letter }}" class="form-control">
                <input type="text" value="{{ $data->let_name }}" class="form-control" readonly>
              </div>
            </div>
            @if($data->kka_type)
              {{-- KKA Type --}}
              <div class="row row-separator">
                <div class="col-3">
                  <label class="text-danger">KKA Type *</label>
                </div>
                <div class="col-9">
                  <select class="form-control js-example-basic-single" name="kka_type" style="width: 100%;" required>
                    <option value="">- Pilih -</option>
                    @foreach($kkaTypes as $item)
                      <option value="{{ $item->id }}" @if($data->kka_type == $item->id) selected="selected" @endif>{{ $item->kka_primary_code." - ".$item->kka_type }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              {{-- KKA Code --}}
              <div class="row row-separator">
                <div class="col-3">
                  <label class="text-danger">KKA Code *</label>
                </div>
                <div class="col-9">
                  <input type="hidden" name="kka_code_before" value="{{ $data->kka_code }}">
                  <select class="form-control js-example-basic-single" name="kka_code" id="kka_code" style="width: 100%;" required>
                    <option value="">- Pilih -</option>
                    @foreach($kkaCodes as $item)
                      <option value="{{ $item->kka_code }}" @if($data->kka_code == $item->kka_code) selected="selected" @endif>{{ $item->kka_code." - ".$item->kka_desc }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <script>
                // Map KKA 
                $('select[name="kka_type"]').on('change', function() {
                  const typeKka = $(this).val();
                  var url = '{{ route("outgoingmail.mapKka", ":id") }}';
                  url = url.replace(':id', typeKka);
                  if (typeKka) {
                      $.ajax({
                          url: url,
                          type: "GET",
                          dataType: "json",
                          success: function(data) {
                              $('#kka_code').empty().append('<option value="">- Pilih -</option>');
                              $.each(data, function(div, value) {
                                  $('#kka_code').append(
                                      '<option value="' + value.kka_code + '">' + value.kka_code + ' - ' + value.kka_desc + '</option>');
                              });
                          }
                      });
                  } else {
                      $('#kka_code').empty().append('<option value="">- Pilih -</option>');
                  }
                });
              </script>
            @endif
            {{-- Konseptor --}}
            {{-- <div class="row row-separator">
              <div class="col-3">
                <label class="text-danger">Konseptor *</label>
              </div>
              <div class="col-9">
                <select class="form-control js-example-basic-single" name="drafter" style="width: 100%;" required>
                  <option value="">- Pilih -</option>
                  @foreach($workunits as $workunit)
                    <option value="{{ $workunit->id }}" @if($data->drafter == $workunit->id) selected="selected" @endif>
                      {{ $workunit->work_name }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div> --}}
            {{-- Kode Satuan Organisasi --}}
            <div class="row row-separator">
              <div class="col-3">
                <label id="labelkso" class="text-danger">Kode Satuan Organisasi *</label>
                <br>
                <small>* (Harus diisi khusus untuk Jenis Naskah Surat, Nota Dinas, Surat Pengantar dan Telaahan Staf jika bukan ditandatangani oleh Kapolri/Wakapolri)</small>
              </div>
              <div class="col-9">
                <div class="row">
                  <div class="col-12">
                    <label class="text-danger">Induk Satuan Organisasi *</label>
                  </div>
                  <div class="col-9">
                    <select class="form-control js-example-basic-single" name="org_unit" style="width: 100%;">
                      <option value="">- Pilih -</option>
                      @foreach($sators as $sator)
                        <option value="{{ $sator->id }}" @if($data->org_unit == $sator->id) selected="selected" @endif>
                          {{ $sator->sator_name }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-3">
                    <button type="button" class="btn btn-secondary" style="width: 100%" data-toggle="modal" data-target="#satuanOrg"><i class="fa fa-plus"></i> Tambah Baru</button>
                  </div>
                  <div class="col-12 mt-3">
                    <label class="text-danger">Konseptor *</label>
                  </div>
                  <div class="col-9">
                    <select class="form-control js-example-basic-single" name="sub_org_unit" id="sub_org_unit" style="width: 100%;">
                      <option value="">- Pilih -</option>
                    </select>
                  </div>
                  <div class="col-3">
                  </div>
                  <script>
                    var satorBefore = "{{ $data->org_unit }}";
                    var subSatorBefore = "{{ $data->sub_org_unit }}";
                    if(satorBefore != null){
                      var url = '{{ route("sator.mapSator", ":id") }}';
                      url = url.replace(':id', satorBefore);
                      if (satorBefore) {
                          $.ajax({
                              url: url,
                              type: "GET",
                              dataType: "json",
                              success: function(data) {
                                  $('#sub_org_unit').empty().append('<option value="">- Pilih -</option>');
                                  $.each(data, function(div, value) {
                                      var selected = (subSatorBefore == value.id) ? ' selected' : '';
                                      $('#sub_org_unit').append(
                                          '<option value="' + value.id + '"' + selected + '>' + value.sub_sator_name + '</option>'
                                      );
                                  });
                              }
                          });
                      } else {
                          $('#sub_org_unit').empty().append('<option value="">- Pilih -</option>');
                      }
                    }
                    // Map Sator 
                    $('select[name="org_unit"]').on('change', function() {
                      const sator = $(this).val();
                      var url = '{{ route("sator.mapSator", ":id") }}';
                      url = url.replace(':id', sator);
                      if (sator) {
                          $.ajax({
                              url: url,
                              type: "GET",
                              dataType: "json",
                              success: function(data) {
                                  $('#sub_org_unit').empty().append('<option value="">- Pilih -</option>');
                                  $.each(data, function(div, value) {
                                      $('#sub_org_unit').append(
                                          '<option value="' + value.id + '">' + value.sub_sator_name + '</option>');
                                  });
                              }
                          });
                      } else {
                          $('#sub_org_unit').empty().append('<option value="">- Pilih -</option>');
                      }
                    });
                  </script>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <div class="row px-1">
            <div class="col-md-12">
              <table class="table table-bordered">
                <tbody>
                  {{-- Perihal --}}
                  <tr>
                    <td><label class="text-danger">Hal / Tentang *</label></td>
                    <td>
                      <textarea class="summernote-editor" type="text" name="mail_regarding" placeholder="Masukkan Hal / Tentang Surat.." required style="width: 100%">{!! $data->mail_regarding !!}</textarea>
                    </td>
                  </tr>
                  {{-- Tanggal --}}
                  <tr>
                    <td><label class="text-danger">Tanggal *</label></td>
                    <td>
                      <div class="row">
                        <div class="col-6">
                          <label  class="text-danger">Tanggal Keluar *</label>
                          <input type="date" name="out_date" value="{{ \Carbon\Carbon::parse($data->out_date)->format('Y-m-d') }}" class="form-control" required>
                        </div>
                        <div class="col-6">
                          <label>Tanggal Surat</label>
                          <input type="date" name="mail_date" value="{{ \Carbon\Carbon::parse($data->mail_date)->format('Y-m-d') }}" class="form-control">
                        </div>
                      </div>
                    </td>
                  </tr>
                  {{-- Penandatangan --}}
                  <tr>
                    <td><label class="text-danger">Penanda Tangan *</label></td>
                    <td>
                      <div class="row">
                        <div class="col-md-9">
                          <select class="form-control js-example-basic-single" name="signing" style="width: 100%;" required>
                            <option value="">- Pilih -</option>
                            @foreach($workunits as $workunit)
                              <option value="{{ $workunit->id }}" @if($data->signing == $workunit->id) selected="selected" @endif>
                                {{ $workunit->work_name }}
                              </option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-3">
                          <button type="button" class="btn btn-secondary" style="width: 100%" data-toggle="modal" data-target="#unitKerja"><i class="fa fa-plus"></i> Tambah Baru</button>
                        </div>
                      </div>
                    </td>
                  </tr>
                  {{-- Penandatanganan Pihak Instansi Lain --}}
                  <tr>
                    <td><label>Penanda Tangan Pihak Instansi Lain</label></td>
                    <td>
                      <textarea class="summernote-editor" type="text" name="signing_other" placeholder="Masukkan Pihak Instansi Lain.." style="width: 100%">{!! $data->signing_other !!}</textarea>
                    </td>
                  </tr>
                  {{-- Penerima --}}
                  <tr>
                    <td><label class="text-danger">Penerima *</label></td>
                    <td>
                      <textarea class="summernote-editor" type="text" name="receiver" placeholder="Masukkan Penerima.." style="width: 100%" required>{!! $data->receiver !!}</textarea>
                    </td>
                  </tr>
                  {{-- Jumlah --}}
                  <tr>
                    <td><label class="text-danger">Jumlah *</label></td>
                    <td>
                      <div class="row">
                        <div class="col-md-5">
                          <div class="form-group">
                            <label  class="text-danger">Jumlah *</label>
                            <input type="number" name="mail_quantity" value="{{ $data->mail_quantity }}" class="form-control" placeholder="Masukkan Jumlah.." required>
                          </div>
                        </div>
                        {{-- Satuan --}}
                        <div class="col-md-4">
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
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>&nbsp;</label>
                            <button type="button" class="btn btn-secondary" style="width: 100%" data-toggle="modal" data-target="#satuan"><i class="fa fa-plus"></i> Tambah Baru</button>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  {{-- Arsip Pertinggal --}}
                  <tr>
                    <td><label class="text-danger">Arsip Pertinggal *</label></td>
                    <td>
                      <div class="row">
                        <div class="col-md-9">
                          <div class="form-group">
                            <select class="form-control js-example-basic-single" name="archive_remain" style="width: 100%;" required>
                              <option value="">- Pilih -</option>
                              @foreach($archive_remains as $archive_remain)
                                <option value="{{ $archive_remain->name_value }}" @if($data->archive_remains == $archive_remain->name_value) selected="selected" @endif>{{ $archive_remain->name_value }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <button type="button" class="btn btn-secondary" style="width: 100%" data-toggle="modal" data-target="#archiveRemain"><i class="fa fa-plus"></i> Tambah Baru</button>
                        </div>
                      </div>
                    </td>
                  </tr>
                  {{-- Klasifikasi Arsip --}}
                  {{-- <tr>
                    <td><label>Klasifikasi Arsip</label></td>
                    <td>
                      <div class="row">
                        <div class="col-md-9">
                          <div class="form-group">
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
                        <div class="col-md-3">
                          <button type="button" class="btn btn-secondary" style="width: 100%" data-toggle="modal" data-target="#klasifikasi"><i class="fa fa-plus"></i> Tambah Baru</button>
                        </div>
                      </div>
                    </td>
                  </tr> --}}
                  {{-- Retensi Surat --}}
                  {{-- <tr>
                    <td><label>Retensi Surat</label></td>
                    <td>
                      <div class="row">
                        <div class="col-6">
                          <label>Dari</label>
                          <input type="date" name="mail_retention_from" value="{{ \Carbon\Carbon::parse($data->mail_retention_from)->format('Y-m-d') }}" class="form-control">
                        </div>
                        <div class="col-6">
                          <label>Hingga</label>
                          <input type="date" name="mail_retention_to" value="{{ \Carbon\Carbon::parse($data->mail_retention_to)->format('Y-m-d') }}" class="form-control">
                        </div>
                      </div>
                    </td>
                  </tr> --}}
                  {{-- Lokasi Simpan --}}
                  {{-- <tr>
                    <td><label>Lokasi Simpan</label></td>
                    <td>
                      <div class="row">
                        <div class="col-md-9">
                          <input type="text" name="save_location" id="saveLocation" value="{{ $data->location_save }}" class="form-control" placeholder="Pilih Lokasi Simpan.." readonly>
                        </div>
                        <div class="col-md-3">
                          <button type="button" class="btn btn-secondary" style="width: 100%" data-toggle="modal" data-target="#locSave">...</button>
                        </div>
                      </div>
                    </td>
                  </tr> --}}
                  {{-- Dikirim Via --}}
                  {{-- <tr>
                    <td><label>Dikirim Via</label></td>
                    <td>
                      <select class="form-control js-example-basic-single" name="received_via" style="width: 100%;">
                        <option value="">- Pilih -</option>
                        @foreach($receivedvias as $receivedvia)
                          <option value="{{ $receivedvia->name_value }}" @if($data->received_via == $receivedvia->name_value) selected="selected" @endif>
                            {{ $receivedvia->name_value }}
                          </option>
                        @endforeach
                      </select>
                    </td>
                  </tr> --}}
                  {{-- Nomor Referensi --}}
                  {{-- <tr>
                    <td><label>Nomor Referensi</label></td>
                    <td>
                      <input type="text" name="ref_number" value="{{ $data->ref_number }}" class="form-control" placeholder="Masukan Nomor Referensi..">
                    </td>
                  </tr> --}}
                  {{-- Referensi Surat --}}
                  {{-- <tr>
                    <td><label>Referensi Surat</label></td>
                    <td>
                      <input type="text" id="mail_ref" name="mail_ref" value="{{ $data->ref_mail }}" class="form-control" placeholder="Masukkan Referensi Surat..">
                    </td>
                  </tr> --}}
                  {{-- Lampiran --}}
                  <tr>
                    <td><label>Lampiran</label></td>
                    <td>
                      <textarea class="summernote-editor" type="text" name="attachment_text" placeholder="Masukkan Lampiran.." style="width: 100%">{!! $data->attachment_text !!}</textarea>
                    </td>
                  </tr>
                  {{-- Keterangan --}}
                  <tr>
                    <td><label>Keterangan</label></td>
                    <td>
                      <textarea class="summernote-editor" type="text" name="information" placeholder="Masukkan Keterangan.." style="width: 100%">{!! $data->information !!}</textarea>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        {{-- Lokasi Simpan --}}
        {{-- <div class="modal fade" id="locSave" data-backdrop="static" data-keyboard="false" aria-labelledby="modalAddLabel" aria-hidden="true">
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
                      @foreach($gedungs as $gedung)
                        <option value="{{ $gedung->id }}" @if($path->idGedung == $gedung->id) selected="selected" @endif>{{ $gedung->nama_gedung }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="text-danger">Nama Lantai*</label>
                    <select class="form-control js-example-basic-single" name="namaLantai" id="namaLantai" style="width: 100%;">
                      <option value="">- Pilih -</option>
                      @foreach($listLantai as $lantai)
                        <option value="{{ $lantai->id }}" @if($path->idLantai == $lantai->id) selected="selected" @endif>{{ $lantai->nama_lantai }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="text-danger">Nama Ruang*</label>
                    <select class="form-control js-example-basic-single" name="namaRuang" id="namaRuang" style="width: 100%;">
                      <option value="">- Pilih -</option>
                      @foreach($listRuang as $ruang)
                        <option value="{{ $ruang->id }}" @if($path->idRuang == $ruang->id) selected="selected" @endif>{{ $ruang->nama_ruang }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="text-danger">Nama Rak*</label>
                    <select class="form-control js-example-basic-single" name="namaRak" id="namaRak" style="width: 100%;">
                      <option value="">- Pilih -</option>
                      @foreach($listRak as $rak)
                        <option value="{{ $rak->id }}" @if($path->idRak == $rak->id) selected="selected" @endif>{{ $rak->nama_rak }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="text-danger">Nama Baris*</label>
                    <select class="form-control js-example-basic-single" name="namaBaris" id="namaBaris" style="width: 100%;">
                      <option value="">- Pilih -</option>
                      @foreach($listBaris as $baris)
                        <option value="{{ $baris->id }}" @if($path->idBaris == $baris->id) selected="selected" @endif>{{ $baris->nama_baris }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="text-danger">Nama Kolom*</label>
                    <select class="form-control js-example-basic-single" name="namaKolom" id="namaKolom" style="width: 100%;">
                      <option value="">- Pilih -</option>
                      @foreach($listKolom as $kolom)
                        <option value="{{ $kolom->id }}" @if($path->idKolom == $kolom->id) selected="selected" @endif>{{ $kolom->nama_kolom }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="text-danger">Nama Boks*</label>
                    <select class="form-control js-example-basic-single" name="namaBoks" id="namaBoks" style="width: 100%;">
                      <option value="">- Pilih -</option>
                      @foreach($listBoks as $boks)
                        <option value="{{ $boks->id }}" @if($path->idBoks == $boks->id) selected="selected" @endif>{{ $boks->nama_box }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  <button type="button" class="btn btn-primary" id="chooseLocSave" disabled>Pilih</button>
                </div>
                <script>
                  $('select[id="namaGedung"]').on('change', function() {
                    $('#saveLocation').val("");
                    const gedungId = $(this).val();
                    var url = '{{ route("mapsaveloc.listLantai", ":id") }}';
                    url = url.replace(':id', gedungId);
                    if (gedungId) {
                        $.ajax({
                            url: url,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                $('#namaLantai').empty().append('<option value="">- Pilih -</option>');

                                $.each(data, function(div, value) {
                                    $('#namaLantai').append(
                                        '<option value="' +
                                        value.id + '" data-Text="' + value.nama_lantai +
                                        '">' + value.nama_lantai + '</option>');
                                });
                            }
                        });
                    } else {
                        $('#namaLantai').empty().append('<option value="">- Pilih -</option>');
                    }
                    
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
                    var url = '{{ route("mapsaveloc.listRuang", ":id") }}';
                    url = url.replace(':id', lantaiId);
                    if (lantaiId) {
                        $.ajax({
                            url: url,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                $('#namaRuang').empty().append('<option value="">- Pilih -</option>');

                                $.each(data, function(div, value) {
                                    $('#namaRuang').append(
                                        '<option value="' +
                                        value.id + '" data-Text="' + value.nama_ruang +
                                        '">' + value.nama_ruang + '</option>');
                                });
                            }
                        });
                    } else {
                        $('#namaRuang').empty().append('<option value="">- Pilih -</option>');
                    }
                    
                    $('#namaRak').empty().append('<option value="">- Pilih -</option>');
                    $('#namaBaris').empty().append('<option value="">- Pilih -</option>');
                    $('#namaKolom').empty().append('<option value="">- Pilih -</option>');
                    $('#namaBoks').empty().append('<option value="">- Pilih -</option>');
                    $('#chooseLocSave').attr('disabled', 'disabled');
                  });
                  $('select[id="namaRuang"]').on('change', function() {
                    $('#saveLocation').val("");
                    const ruangId = $(this).val();
                    var url = '{{ route("mapsaveloc.listRak", ":id") }}';
                    url = url.replace(':id', ruangId);
                    if (ruangId) {
                        $.ajax({
                            url: url,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                $('#namaRak').empty().append('<option value="">- Pilih -</option>');

                                $.each(data, function(div, value) {
                                    $('#namaRak').append(
                                        '<option value="' +
                                        value.id + '" data-Text="' + value.nama_rak +
                                        '">' + value.nama_rak + '</option>');
                                });
                            }
                        });
                    } else {
                        $('#namaRak').empty().append('<option value="">- Pilih -</option>');
                    }
                    
                    $('#namaBaris').empty().append('<option value="">- Pilih -</option>');
                    $('#namaKolom').empty().append('<option value="">- Pilih -</option>');
                    $('#namaBoks').empty().append('<option value="">- Pilih -</option>');
                    $('#chooseLocSave').attr('disabled', 'disabled');
                  });
                  $('select[id="namaRak"]').on('change', function() {
                    $('#saveLocation').val("");
                    const rakId = $(this).val();
                    var url = '{{ route("mapsaveloc.listBaris", ":id") }}';
                    url = url.replace(':id', rakId);
                    if (rakId) {
                        $.ajax({
                            url: url,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                $('#namaBaris').empty().append('<option value="">- Pilih -</option>');

                                $.each(data, function(div, value) {
                                    $('#namaBaris').append(
                                        '<option value="' +
                                        value.id + '" data-Text="' + value.nama_baris +
                                        '">' + value.nama_baris + '</option>');
                                });
                            }
                        });
                    } else {
                        $('#namaBaris').empty().append('<option value="">- Pilih -</option>');
                    }
                    
                    $('#namaKolom').empty().append('<option value="">- Pilih -</option>');
                    $('#namaBoks').empty().append('<option value="">- Pilih -</option>');
                    $('#chooseLocSave').attr('disabled', 'disabled');
                  });
                  $('select[id="namaBaris"]').on('change', function() {
                    $('#saveLocation').val("");
                    const barisId = $(this).val();
                    var url = '{{ route("mapsaveloc.listKolom", ":id") }}';
                    url = url.replace(':id', barisId);
                    if (barisId) {
                        $.ajax({
                            url: url,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                $('#namaKolom').empty().append('<option value="">- Pilih -</option>');

                                $.each(data, function(div, value) {
                                    $('#namaKolom').append(
                                        '<option value="' +
                                        value.id + '" data-Text="' + value.nama_kolom +
                                        '">' + value.nama_kolom + '</option>');
                                });
                            }
                        });
                    } else {
                        $('#namaKolom').empty().append('<option value="">- Pilih -</option>');
                    }
        
                    $('#namaBoks').empty().append('<option value="">- Pilih -</option>');
                    $('#chooseLocSave').attr('disabled', 'disabled');
                  });
                  $('select[id="namaKolom"]').on('change', function() {
                    $('#saveLocation').val("");
                    const kolomId = $(this).val();
                    var url = '{{ route("mapsaveloc.listBoks", ":id") }}';
                    url = url.replace(':id', kolomId);
                    if (kolomId) {
                        $.ajax({
                            url: url,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                $('#namaBoks').empty().append('<option value="">- Pilih -</option>');

                                $.each(data, function(div, value) {
                                    $('#namaBoks').append(
                                        '<option value="' +
                                        value.id + '" data-Text="' + value.nama_box +
                                        '">' + value.nama_box + '</option>');
                                });
                            }
                        });
                    } else {
                        $('#namaBoks').empty().append('<option value="">- Pilih -</option>');
                    }
        
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
        </div> --}}
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

<script>
  $(".js-example-basic-single").select2().on("select2:open", function () {
      document.querySelector(".select2-search__field").focus();
  });
</script>

@endsection