@extends('layouts.blackand.appother')
@section('content')

@include('mail.head')

<div class="content-header">
  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6"><h1 class="m-0"><i class="mdi mdi-file-edit"></i> Formulir Ubah Surat Masuk</h1></div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Beranda</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('incommingmail.index') }}"> Daftar Surat Masuk</a></li>
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
      <form action="{{ route('incommingmail.update', encrypt($data->id)) }}" method="POST" enctype="multipart/form-data" id="formIncommingMail">
        @csrf
        <!-- Pass filters as hidden fields -->
        <input type="hidden" name="filt_entry_date" value="{{ request()->get('entry_date') }}">
        <input type="hidden" name="filt_mail_date" value="{{ request()->get('mail_date') }}">
        <input type="hidden" name="filt_mail_number" value="{{ request()->get('mail_number') }}">
        <input type="hidden" name="filt_placeman" value="{{ request()->get('placeman') }}">
        <input type="hidden" name="filt_letter" value="{{ request()->get('letter') }}">
        <input type="hidden" name="filt_complain" value="{{ request()->get('complain') }}">
        <input type="hidden" name="filt_org_unit" value="{{ request()->get('org_unit') }}">

        <div class="card-body" style="max-height: 55vh; overflow-y: auto;">
          <div class="row px-1">
            <div class="col-md-12">
              <table class="table table-bordered">
                <tbody>
                  {{-- Pengirim --}}
                  <tr>
                    <td><label>Pengirim</label></td>
                    <td>
                      <input type="text" name="senderInput" value="{{ $data->sender }}" placeholder="Masukkan Pengirim.." class="form-control">
                    </td>
                  </tr>
                  {{-- Pejabat / Naskah --}}
                  <tr>
                    <td><label class="text-danger">Pejabat / Naskah *</label></td>
                    <td>
                      <input type="text" class="form-control" name="placeman" value="{{ $data->placeman }}" style="width: 100%;" readonly>
                    </td>
                  </tr>
                  {{-- Jenis Naskah --}}
                  <tr>
                    <td><label class="text-danger" id="labeljenisNaskah">Jenis Naskah *</label></td>
                    <td>
                      <div id="jenisNaskah">
                        <input type="hidden" name="id_mst_letter" value="{{ $data->id_mst_letter }}">
                        <input type="text" class="form-control" value="{{ $data->let_name }}" style="width: 100%;" readonly>
                      </div>

                      <div id="jenisPengaduan" hidden>
                        <input type="hidden" name="id_mst_complain" value="{{ $data->id_mst_complain }}">
                        <input type="text" class="form-control" value="{{ $data->com_name }}" style="width: 100%;" readonly>
                      </div>
                    </td>
                  </tr>
                  {{-- No Surat --}}
                  <tr>
                    <td><label id="labelnoSurat">Nomor Surat</label></td>
                    <td>
                      <input type="text" name="mail_number" value="{{ $data->mail_number }}" placeholder="Masukkan Nomor Surat.." class="form-control">
                    </td>
                  </tr>
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
                          <label  class="text-danger">Tanggal Masuk *</label>
                          <input type="date" name="entry_date" value="{{ \Carbon\Carbon::parse($data->entry_date)->format('Y-m-d') }}" class="form-control" required>
                        </div>
                        <div class="col-6">
                          <label>Tanggal Surat</label>
                          <input type="datetime-local" name="mail_date" value="{{ $data->mail_date }}" class="form-control">
                        </div>
                      </div>
                    </td>
                  </tr>
                  {{-- Penerima / Penandatanganan --}}
                  <tr>
                    <td><label class="text-danger" id="labelPenerima">Penerima *</label></td>
                    <td>
                      <div class="row">
                        <div class="col-md-9">
                          <select class="form-control js-example-basic-single" name="receiver" style="width: 100%;" required>
                            <option value="">- Pilih -</option>
                            @foreach($receiverMails as $receiver)
                              <option value="{{ $receiver->name_value }}" @if($data->receiver == $receiver->name_value) selected="selected" @endif>{{ $receiver->name_value }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-3">
                          <button type="button" class="btn btn-secondary" style="width: 100%" data-toggle="modal" data-target="#penerimaSurat"><i class="fa fa-plus"></i> Tambah Baru</button>
                        </div>
                      </div>
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
                                <option value="{{ $unitletter->id }}" @if($data->mail_unit == $unitletter->id) selected="selected" @endif>{{ $unitletter->unit_name }}</option>
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
                  {{-- Jenis Surat --}}
                  <tr id="jenisSurat">
                    <td><label>Jenis Surat</label></td>
                    <td>
                      <div class="row">
                        <div class="col-md-9">
                          <div class="form-group">
                            <select class="form-control js-example-basic-single" id="jenisSuratselect" name="mail_type" style="width: 100%;">
                              <option value="">- Pilih -</option>
                              @foreach($mailtypes as $item)
                                <option value="{{ $item->name_value }}" @if($data->mail_type == $item->name_value) selected="selected" @endif>{{ $item->name_value }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <button type="button" class="btn btn-secondary" style="width: 100%" data-toggle="modal" data-target="#mailType"><i class="fa fa-plus"></i> Tambah Baru</button>
                        </div>
                      </div>
                    </td>
                  </tr>
                  {{-- Hasil Penelitian --}}
                  <tr id="hasilPenelitian" hidden>
                    <td><label>Hasil Penelitian</label></td>
                    <td>
                      <select class="form-control js-example-basic-single" id="resultSelect" name="result" style="width: 100%;">
                        <option value="">- Pilih -</option>
                        @foreach($results as $item)
                          <option value="{{ $item->name_value }}" @if($data->result == $item->name_value) selected="selected" @endif>{{ $item->name_value }}</option>
                        @endforeach
                      </select>
                    </td>
                  </tr>
                  {{-- Disetujui Oleh --}}
                  <tr id="disetujuiOleh" hidden>
                    <td><label>Disetujui Oleh</label></td>
                    <td>
                      <div class="row">
                        <div class="col-md-9">
                          <div class="form-group">
                            <select class="form-control js-example-basic-single" id="approvedSelect" name="approved_by" style="width: 100%;">
                              <option value="">- Pilih -</option>
                              @foreach($approveds as $item)
                                <option value="{{ $item->name_value }}" @if($data->approved_by == $item->name_value) selected="selected" @endif>{{ $item->name_value }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <button type="button" class="btn btn-secondary" style="width: 100%" data-toggle="modal" data-target="#approved"><i class="fa fa-plus"></i> Tambah Baru</button>
                        </div>
                      </div>
                    </td>
                  </tr>
                  {{-- Diterima Via --}}
                  <tr>
                    <td><label>Diterima Via</label></td>
                    <td>
                      <div id="selectDiterimaVia">
                        <select class="form-control js-example-basic-single" name="received_viaSelect" style="width: 100%;">
                          <option value="">- Pilih -</option>
                          @foreach($receivedvias as $receivedvia)
                            <option value="{{ $receivedvia->name_value }}" @if($data->received_via == $receivedvia->name_value) selected="selected" @endif>{{ $receivedvia->name_value }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div id="inputDiterimaVia" hidden>
                        <textarea class="summernote-editor" type="text" name="received_viaInput" placeholder="Diterima Via.." style="width: 100%">{!! $data->received_via !!}</textarea>
                      </div>
                    </td>
                  </tr>
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
        <div class="card-footer">
          <div class="row">
            <div class="col-12" style="text-align: right">
              <a href="{{ route('incommingmail.index') }}" type="button" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
              <button type="submit" class="btn btn-primary" id="sbformIncommingMail"><i class="mdi mdi-update"></i> Ubah Data</button>
            </div>
          </div>
        </div>
      </form>
      <script>
          document.getElementById('formIncommingMail').addEventListener('submit', function(event) {
              if (!this.checkValidity()) {
                  event.preventDefault();
                  return false;
              }
              var submitButton = this.querySelector('button[id="sbformIncommingMail"]');
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
  $(document).ready(function() {
    const labeljenisNaskah = document.getElementById('labeljenisNaskah');
    const jenisNaskah = document.getElementById('jenisNaskah');
    const jenisPengaduan = document.getElementById('jenisPengaduan');
    const labelnoSurat = document.getElementById('labelnoSurat');
    const labelPenerima = document.getElementById('labelPenerima');
    const jenisSurat = document.getElementById('jenisSurat');
    const hasilPenelitian = document.getElementById('hasilPenelitian');
    const disetujuiOleh = document.getElementById('disetujuiOleh');
    const selectDiterimaVia = document.getElementById('selectDiterimaVia');
    const inputDiterimaVia = document.getElementById('inputDiterimaVia');

    const jenisSuratselect = document.getElementById('jenisSuratselect');
    const resultSelect = document.getElementById('resultSelect');
    const approvedSelect = document.getElementById('approvedSelect');

    var placemanBefore = "{{ $data->placeman }}";
    if (placemanBefore == 'PENGADUAN') {
      labeljenisNaskah.textContent = "Jenis Pengaduan *";
      jenisNaskah.hidden = true;
      jenisPengaduan.hidden = false;
      labelnoSurat.textContent = "Nomor Surat";
      labelPenerima.textContent = "Penerima *";
      jenisSurat.hidden = false;
      hasilPenelitian.hidden = true;
      disetujuiOleh.hidden = true;
      selectDiterimaVia.hidden = false;
      inputDiterimaVia.hidden = true;
      resultSelect.required = false;
      approvedSelect.required = false;
    } else {
      labeljenisNaskah.textContent = "Jenis Naskah *";
      jenisNaskah.hidden = false;
      jenisPengaduan.hidden = true;
      labelnoSurat.textContent = "Nomor Surat";
      labelPenerima.textContent = "Penerima *";
      jenisSurat.hidden = false;
      hasilPenelitian.hidden = true;
      disetujuiOleh.hidden = true;
      selectDiterimaVia.hidden = false;
      inputDiterimaVia.hidden = true;
      resultSelect.required = false;
      approvedSelect.required = false;
    }
    $('select[id="placeman"]').on('change', function() {
        const placeman = $(this).val();
        if (placeman == 'PENGADUAN') {
          labeljenisNaskah.textContent = "Jenis Pengaduan *";
          jenisNaskah.hidden = true;
          jenisPengaduan.hidden = false;
          labelnoSurat.textContent = "Nomor Surat";
          labelPenerima.textContent = "Penerima *";
          jenisSurat.hidden = false;
          hasilPenelitian.hidden = true;
          disetujuiOleh.hidden = true;
          selectDiterimaVia.hidden = false;
          inputDiterimaVia.hidden = true;
          resultSelect.required = false;
          approvedSelect.required = false;
        } else {
          labeljenisNaskah.textContent = "Jenis Naskah *";
          jenisNaskah.hidden = false;
          jenisPengaduan.hidden = true;
          labelnoSurat.textContent = "Nomor Surat";
          labelPenerima.textContent = "Penerima *";
          jenisSurat.hidden = false;
          hasilPenelitian.hidden = true;
          disetujuiOleh.hidden = true;
          selectDiterimaVia.hidden = false;
          inputDiterimaVia.hidden = true;
          resultSelect.required = false;
          approvedSelect.required = false;
        }
    });
  });
</script>

@endsection