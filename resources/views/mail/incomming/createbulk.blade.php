@extends('layouts.blackand.appother')
@section('content')

@include('mail.head')
<div class="content-header">
  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6"><h1 class="m-0"><i class="fas fa-plus"></i> Formulir Tambah Surat Masuk (BULK)</h1></div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Beranda</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('incommingmail.index') }}"> Daftar Surat Masuk</a></li>
                  <li class="breadcrumb-item active">Tambah</li>
              </ol>
          </div>
      </div>
  </div>
</div>

@include('mail.alert')
<div class="container-fluid">
  <div class="card card-primary card-outline">
      <div class="card-header"><h3 class="card-title"></h3></div>
      
      <form action="{{ route('incommingmail.storebulk') }}" method="POST" enctype="multipart/form-data" id="formIncommingMail">
        @csrf
        <div class="card-body" style="max-height: 55vh; overflow-y: auto;">
          <div class="row px-1">
            <div class="col-md-12">
              <table class="table table-bordered">
                <tbody>
                  {{-- Pengirim --}}
                  <tr>
                    <td><label>Pengirim</label></td>
                    <td>
                      <input type="text" name="senderInput" value="{{ old('sender') }}" placeholder="Masukkan Pengirim.." class="form-control">
                    </td>
                  </tr>
                  {{-- Pejabat / Naskah --}}
                  <tr>
                    <td><label class="text-danger">Pejabat / Naskah *</label></td>
                    <td>
                      <select class="form-control js-example-basic-single" id="placeman" name="placeman" style="width: 100%;" required>
                        <option value="">- Pilih -</option>
                        @foreach($placemans as $item)
                          <option value="{{ $item->name_value }}">{{ $item->name_value }}</option>
                        @endforeach
                      </select>
                    </td>
                  </tr>
                  {{-- Jenis Naskah --}}
                  <tr>
                    <td><label class="text-danger" id="labeljenisNaskah">Jenis Naskah *</label></td>
                    <td>
                      <div id="jenisNaskah">
                        <select class="form-control js-example-basic-single" id="mst_letter" name="id_mst_letter" style="width: 100%;" required>
                          <option value="">- Pilih -</option>
                          @foreach($letters as $letter)
                            <option value="{{ $letter->id }}">{{ $letter->let_name }}</option>
                          @endforeach
                        </select>
                      </div>

                      <div id="jenisPengaduan" hidden>
                        <select class="form-control js-example-basic-single" id="mst_complain" name="id_mst_complain" style="width: 100%;" required>
                          <option value="">- Pilih -</option>
                          @foreach($complains as $item)
                            <option value="{{ $item->id }}" @if($item->com_code == 'I') selected="selected" @endif>{{ $item->com_code }} - {{ $item->com_name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </td>
                  </tr>
                  {{-- No Surat --}}
                  <tr>
                    <td><label id="labelnoSurat">Nomor Surat</label></td>
                    <td>
                      <input type="text" name="mail_number" value="{{ old('mail_number') }}" placeholder="Masukkan Nomor Surat.." class="form-control">
                    </td>
                  </tr>
                  {{-- Perihal --}}
                  <tr>
                    <td><label class="text-danger">Hal / Tentang *</label></td>
                    <td>
                      <textarea class="summernote-editor" type="text" name="mail_regarding" placeholder="Masukkan Hal / Tentang Surat.." value="" required style="width: 100%"></textarea>
                    </td>
                  </tr>
                  {{-- Tanggal --}}
                  <tr>
                    <td><label class="text-danger">Tanggal *</label></td>
                    <td>
                      <div class="row">
                        <div class="col-6">
                          <label  class="text-danger">Tanggal Masuk *</label>
                          <input type="date" name="entry_date" value="{{ old('entry_date') }}" class="form-control" required>
                        </div>
                        <div class="col-6">
                          <label>Tanggal Surat</label>
                          <input type="datetime-local" name="mail_date" value="{{ old('mail_date') }}" class="form-control">
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
                              <option value="{{ $receiver->name_value }}">{{ $receiver->name_value }}</option>
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
                            <input type="number" name="mail_quantity" value="{{ old('mail_quantity') }}" class="form-control" placeholder="Masukkan Jumlah.." required>
                          </div>
                        </div>
                        {{-- Satuan --}}
                        <div class="col-md-4">
                          <div class="form-group">
                            <label  class="text-danger">Satuan *</label>
                            <select class="form-control js-example-basic-single" name="mail_unit" style="width: 100%;" required>
                              <option value="">- Pilih -</option>
                              @foreach($unitletters as $unitletter)
                                <option value="{{ $unitletter->id }}">{{ $unitletter->unit_name }}</option>
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
                                <option value="{{ $item->name_value }}">{{ $item->name_value }}</option>
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
                          <option value="{{ $item->name_value }}">{{ $item->name_value }}</option>
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
                                <option value="{{ $item->name_value }}">{{ $item->name_value }}</option>
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
                            <option value="{{ $receivedvia->name_value }}">{{ $receivedvia->name_value }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div id="inputDiterimaVia" hidden>
                        <textarea class="summernote-editor" type="text" name="received_viaInput" placeholder="Diterima Via.." value="{{ old('received_via') }}" style="width: 100%"></textarea>
                      </div>
                    </td>
                  </tr>
                  {{-- Lampiran --}}
                  <tr>
                    <td><label>Lampiran</label></td>
                    <td>
                      <textarea class="summernote-editor" type="text" name="attachment_text" placeholder="Masukkan Lampiran.." value="{{ old('attachment_text') }}" style="width: 100%"></textarea>
                    </td>
                  </tr>
                  {{-- Keterangan --}}
                  <tr>
                    <td><label>Keterangan</label></td>
                    <td>
                      <textarea class="summernote-editor" type="text" name="information" placeholder="Masukkan Keterangan.." value="{{ old('information') }}" style="width: 100%"></textarea>
                    </td>
                  </tr>
                  {{-- Jumlah --}}
                  <tr>
                    <td><label class="text-danger">Jumlah Naskah *</label></td>
                    <td>
                      <input type="number" name="amount_letter" class="form-control" placeholder="Masukkan Jumlah Naskah Dalam Angka.." required>
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
              <button type="submit" class="btn btn-primary" id="sbFormIncommingMail"><i class="fa fa-paper-plane"></i> Kirim Data</button>
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
              var submitButton = this.querySelector('button[id="sbFormIncommingMail"]');
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
    const idLetter = document.getElementById('mst_letter');
    const idComplain = document.getElementById('mst_complain');
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

    $('select[id="placeman"]').on('change', function() {
        const placeman = $(this).val();
        if (placeman == 'PENGADUAN') {
          labeljenisNaskah.textContent = "Jenis Pengaduan *";
          jenisNaskah.hidden = true;
          jenisPengaduan.hidden = false;
          idLetter.required = false;
          idComplain.required = true;
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
          idLetter.required = true;
          idComplain.required = false;
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