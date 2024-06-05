@extends('layouts.blackand.app')
@section('content')

@include('mail.head')

<div class="content-header">
  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1 class="m-0"><i class="fas fa-plus"></i> Tambah Surat Keluar</h1>
          </div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Beranda</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('outgoingmail.index') }}"> Daftar Surat Keluar</a></li>
                    <li class="breadcrumb-item active">Tambah</li>
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

<div class="container-fluid">
  <div class="card card-primary card-outline">
      <div class="card-header">
          <h3 class="card-title">
              Formulir Tambah Surat Keluar
          </h3>
      </div>
      <form action="#" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body" style="max-height: 65vh; overflow-y: auto;">
          <div class="card p-3" style="background-color:rgb(240, 240, 240);">
            <div class="row">
              {{-- Jenis Naskah --}}
              <div class="col-md-6">
                <div class="form-group">
                  <label>Jenis Naskah<i style="color: red;"> *</i></label>
                  <select class="form-control js-example-basic-single" name="scripture_type" style="width: 100%;" required>
                    <option value="">- Pilih -</option>
                    @foreach($letters as $letter)
                      <option value="{{ $letter->id }}" @if(old('sender') == $letter->id) selected="selected" @endif>{{ $letter->let_name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6"></div>
              {{-- Konseptor --}}
              <div class="col-md-6">
                <label>Konseptor<i style="color: red;"> *</i></label>
                <div class="row">
                  <div class="col-md-8">
                    <select class="form-control js-example-basic-single" name="drafter" style="width: 100%;" required>
                      <option value="">- Pilih -</option>
                      @foreach($workunits as $workunit)
                        <option value="{{ $workunit->id }}" @if(old('drafter') == $workunit->id) selected="selected" @endif>{{ $workunit->work_name }}</option>
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
                        <option value="{{ $sator->id }}" @if(old('org_unit') == $sator->id) selected="selected" @endif>{{ $sator->sator_name }}</option>
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
                <label>Perihal / Tentang<i style="color: red;"> *</i></label>
                <textarea class="form-control" rows="3" type="text" name="mail_regarding" placeholder="Masukkan Perihal / Tentang Surat.." value="{{ old('mail_regarding') }}" required></textarea>
              </div>
            </div>
            {{-- Tanggal --}}
            <div class="col-md-3">
              <div class="form-group">
                <label>Tanggal Keluar<i style="color: red;"> *</i></label>
                <input type="date" name="out_date" value="{{ old('out_date') }}" class="form-control" required>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Tanggal Surat<i style="color: red;"> *</i></label>
                <input type="datetime-local" name="mail_date" value="{{ old('mail_date') }}" class="form-control" required>
              </div>
            </div>
            {{-- Penandatanganan --}}
            <div class="col-md-6">
              <label>Penandatanganan<i style="color: red;"> *</i></label>
              <div class="row">
                <div class="col-md-8">
                  <select class="form-control js-example-basic-single" name="signing" style="width: 100%;" required>
                    <option value="">- Pilih -</option>
                    @foreach($workunits as $workunit)
                      <option value="{{ $workunit->id }}" @if(old('signing') == $workunit->id) selected="selected" @endif>{{ $workunit->work_name }}</option>
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
                <textarea class="form-control" rows="3" type="text" name="signing_other" placeholder="Masukkan Pihak Instansi Lain.." value="{{ old('signing_other') }}"></textarea>
              </div>
            </div>
            {{-- Penerima --}}
            <div class="col-md-6">
              <div class="form-group">
                <label>Penerima<i style="color: red;"> *</i></label>
                <textarea class="form-control" rows="3" type="text" name="receiver" placeholder="Masukkan Penerima.." value="{{ old('receiver') }}"></textarea>
              </div>
            </div>
            {{-- Jumlah --}}
            <div class="col-md-2">
              <div class="form-group">
                <label>Jumlah<i style="color: red;"> *</i></label>
                <input type="number" name="mail_quantity" value="{{ old('mail_quantity') }}" class="form-control" placeholder="Masukkan Jumlah.." required>
              </div>
            </div>
            {{-- Satuan --}}
            <div class="col-md-2">
              <div class="form-group">
                <label>Satuan<i style="color: red;"> *</i></label>
                <select class="form-control js-example-basic-single" name="mail_unit" style="width: 100%;" required>
                  <option value="">- Pilih -</option>
                  @foreach($unitletters as $unitletter)
                    <option value="{{ $unitletter->id }}" @if(old('mail_unit') == $unitletter->id) selected="selected" @endif>{{ $unitletter->unit_name }}</option>
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
                <label>Arsip Pertinggal<i style="color: red;"> *</i></label>
                <select class="form-control js-example-basic-single" name="archive_remain" style="width: 100%;" required>
                  <option value="">- Pilih -</option>
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
                    <option value="{{ $classification->id }}" @if(old('archive_classification') == $classification->id) selected="selected" @endif>{{ $classification->classification_name }}</option>
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
                <input type="date" name="mail_retention_from" value="{{ old('mail_retention_from') }}" class="form-control">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Retensi Surat (Hingga)</label>
                <input type="date" name="mail_retention_to" value="{{ old('mail_retention_to') }}" class="form-control">
              </div>
            </div>
            {{-- Lokasi Simpan --}}
            <div class="col-md-5">
              <div class="form-group">
                <label>Lokasi Simpan</label>
                <input type="text" name="save_location" id="saveLocation" value="{{ old('save_location') }}" class="form-control" placeholder="Pilih Lokasi Simpan.." readonly required>
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
                <select class="form-control js-example-basic-single" name="sent_via" style="width: 100%;">
                  <option value="">- Pilih -</option>
                  @foreach($receivedvias as $receivedvia)
                    <option value="{{ $receivedvia->name_value }}" @if(old('sent_via') == $receivedvia->name_value) selected="selected" @endif>{{ $receivedvia->name_value }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            {{-- Nomor Referensi --}}
            <div class="col-md-6">
              <div class="form-group">
                <label>Nomor Referensi</label>
                <input type="text" name="ref_number" value="{{ old('ref_number') }}" class="form-control" placeholder="Masukan Nomor Referensi..">
              </div>
            </div>
            {{-- Referensi Surat --}}
            <div class="col-md-5">
              <div class="form-group">
                <label>Referensi Surat</label>
                <input type="text" name="mail_ref" value="{{ old('mail_ref') }}" class="form-control" placeholder="Pilih Referensi Surat.." readonly>
              </div>
            </div>
            <div class="col-md-1">
              <div class="form-group">
                <label>&nbsp;</label>
                <button type="button" class="btn btn-secondary" style="width: 100%" data-toggle="modal" data-target="#klasifikasi">...</button>
              </div>
            </div>
            {{-- Lampiran --}}
            <div class="col-md-6">
              <div class="form-group">
                <label>Lampiran</label>
                <textarea class="form-control" rows="3" type="text" name="attachment_text" placeholder="Masukkan Lampiran.." value="{{ old('attachment_text') }}"></textarea>
              </div>
            </div>
            {{-- Keterangan --}}
            <div class="col-md-6">
              <div class="form-group">
                <label>Keterangan</label>
                <textarea class="form-control" rows="3" type="text" name="attachment_text" placeholder="Masukkan Keterangan.." value="{{ old('attachment_text') }}"></textarea>
              </div>
            </div>

          </div>
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="col-12" style="text-align: right">
              <button type="reset" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</button>
              <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Kirim Data</button>
            </div>
          </div>
        </div>
      </form>
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