@extends('layouts.blackand.appother')
@section('content')

@include('mail.head')
<div class="content-header">
  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6"><h1 class="m-0"><i class="fas fa-plus"></i> Formulir Tambah Surat Masuk</h1></div>
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
      <form action="{{ route('incommingmail.store') }}" method="POST" enctype="multipart/form-data" id="formIncommingMail">
        @csrf
        <div class="card-body" style="max-height: 55vh; overflow-y: auto;">
          {{-- <div class="card p-3" style="background-color:rgb(240, 240, 240);"> --}}
            {{-- Kode Satuan Organisasi --}}
            {{-- <div class="row row-separator">
              <div class="col-3">
                <label id="labelkso">Kode Satuan Organisasi</label>
                <br>
                <small>* (Harus diisi khusus untuk Jenis Naskah Surat, Nota Dinas, Surat Pengantar dan Telaahan Staf jika bukan ditandatangani oleh Kapolri/Wakapolri)</small>
              </div>
              <div class="col-9">
                <div class="row">
                  <div class="col-12">
                    <label>Induk Satuan Organisasi</label>
                  </div>
                  <div class="col-9">
                    <select class="form-control js-example-basic-single" name="org_unit" style="width: 100%;">
                      <option value="">- Pilih -</option>
                      @foreach($sators as $sator)
                        <option value="{{ $sator->id }}">{{ $sator->sator_name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-3">
                    <button type="button" class="btn btn-secondary" style="width: 100%" data-toggle="modal" data-target="#satuanOrg"><i class="fa fa-plus"></i> Tambah Baru</button>
                  </div>
                  <div class="col-12 mt-3">
                    <label id="labelSubSator">Konseptor</label>
                  </div>
                  <div class="col-9">
                    <select class="form-control js-example-basic-single" name="sub_org_unit" id="sub_org_unit" style="width: 100%;">
                      <option value="">- Pilih -</option>
                    </select>
                  </div>
                  <div class="col-3">
                  </div>
                  <script>
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
            </div> --}}
          {{-- </div> --}}

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
                            <option value="{{ $item->id }}">{{ $item->com_code }} - {{ $item->com_name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </td>
                  </tr>
                  {{-- Pengirim --}}
                  {{-- <tr>
                    <td><label class="text-danger" id="labelpengirim">Pengirim *</label></td>
                    <td>
                      <input type="text" name="senderInput" id="pengirim1" value="{{ old('sender') }}" class="form-control" placeholder="Masukkan Pengirim.." required>
                      
                      <div class="row" id="pengirim2" hidden>
                        <div class="col-md-9">
                          <select class="form-control js-example-basic-single" id="pengirimselect" name="senderSelect" style="width: 100%;" required>
                            <option value="">- Pilih -</option>
                            @foreach($workunits as $workunit)
                              <option value="{{ $workunit->work_name }}">{{ $workunit->work_name }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-3">
                          <button type="button" class="btn btn-secondary" style="width: 100%" data-toggle="modal" data-target="#unitKerja"><i class="fa fa-plus"></i> Tambah Baru</button>
                        </div>
                      </div>
                    </td>
                    </td>
                  </tr> --}}
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
                  {{-- Retensi Surat --}}
                  {{-- <tr>
                    <td><label>Retensi Surat</label></td>
                    <td>
                      <div class="row">
                        <div class="col-6">
                          <label>Dari</label>
                          <input type="date" name="mail_retention_from" value="{{ old('mail_retention_from') }}" class="form-control">
                        </div>
                        <div class="col-6">
                          <label>Hingga</label>
                          <input type="date" name="mail_retention_to" value="{{ old('mail_retention_to') }}" class="form-control">
                        </div>
                      </div>
                    </td>
                  </tr> --}}
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
  $(".js-example-basic-single").select2().on("select2:open", function () {
      document.querySelector(".select2-search__field").focus();
  });
</script>

<script>
  // const labelpengirim = document.getElementById('labelpengirim');
  // const pengirim1 = document.getElementById('pengirim1');
  // const pengirim2 = document.getElementById('pengirim2');
  // const pengirimselect = document.getElementById('pengirimselect');
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
      if (placeman == 'LITNADIN') {
        // labelpengirim.textContent = "Pengirim / Konseptor *";
        // pengirim1.hidden = true;
        // pengirim2.hidden = false;
        // pengirim1.required = false;
        // pengirimselect.required = true;
        labeljenisNaskah.textContent = "Jenis Naskah *";
        jenisNaskah.hidden = false;
        jenisPengaduan.hidden = true;
        idLetter.required = true;
        idComplain.required = false;
        labelnoSurat.textContent = "Nomor Surat Pengantar";
        labelPenerima.textContent = "Penandatanganan *";
        jenisSurat.hidden = true;
        hasilPenelitian.hidden = false;
        disetujuiOleh.hidden = false;
        selectDiterimaVia.hidden = true;
        inputDiterimaVia.hidden = false;
        // jenisSuratselect.required = false;
        resultSelect.required = true;
        approvedSelect.required = true;
      } 
      else if (placeman == 'PENGADUAN') 
      {
        // labelpengirim.textContent = "Pengirim *";
        // pengirim1.hidden = false;
        // pengirim2.hidden = true;
        // pengirim1.required = true;
        // pengirimselect.required = false;
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
        // jenisSuratselect.required = true;
        resultSelect.required = false;
        approvedSelect.required = false;
      } 
      else 
      {
        // labelpengirim.textContent = "Pengirim *";
        // pengirim1.hidden = false;
        // pengirim2.hidden = true;
        // pengirim1.required = true;
        // pengirimselect.required = false;
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
        // jenisSuratselect.required = true;
        resultSelect.required = false;
        approvedSelect.required = false;
      }
  });
</script>

@endsection