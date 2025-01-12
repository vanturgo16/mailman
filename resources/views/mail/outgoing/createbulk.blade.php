@extends('layouts.blackand.appother')
@section('content')

@include('mail.head')
<div class="content-header">
  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6"><h1 class="m-0"><i class="fas fa-plus"></i> Formulir Tambah Surat Keluar (Bulk)</h1></div>
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

@include('mail.alert')
<div class="container-fluid">
  <div class="card card-primary card-outline">
      <div class="card-header"><h3 class="card-title"></h3></div>

      <form action="{{ route('outgoingmail.storebulk') }}" method="POST" enctype="multipart/form-data" id="formOutgoingMail">
        @csrf
        <div class="card-body" style="max-height: 55vh; overflow-y: auto;">
          <div class="card p-3" style="background-color:rgb(240, 240, 240);">
            {{-- Jenis Naskah --}}
            <div class="row row-separator">
              <div class="col-3">
                <label class="text-danger">Jenis Naskah *</label>
              </div>
              <div class="col-9">
                <select class="form-control js-example-basic-single" id="mst_letter" name="id_mst_letter" style="width: 100%;" required>
                  <option value="">- Pilih -</option>
                  @foreach($letters as $letter)
                    <option value="{{ $letter->id }}">{{ $letter->let_name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            {{-- KKA Type --}}
            <div class="row row-separator" id="typeKka" style="display:none;">
              <div class="col-3">
                <label class="text-danger">KKA Type *</label>
              </div>
              <div class="col-9">
                <select class="form-control js-example-basic-single" name="kka_type" style="width: 100%;">
                  <option value="">- Pilih -</option>
                  @foreach($kkaTypes as $item)
                    <option value="{{ $item->id }}">{{ $item->kka_primary_code." - ".$item->kka_type }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            {{-- KKA Code --}}
            <div class="row row-separator" id="codeKka" style="display:none;">
              <div class="col-3">
                <label class="text-danger">KKA Code *</label>
              </div>
              <div class="col-9">
                <select class="form-control js-example-basic-single" name="kka_code" id="kka_code" style="width: 100%;">
                  <option value="">- Pilih -</option>
                </select>
              </div>
            </div>
            
            <script>
              $(document).ready(function() {
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

                // Show Hide KKA
                $('select[name="id_mst_letter"]').on('change', function() {
                  const id_mst_letter = $(this).val();
                  var url = '{{ route("outgoingmail.checkNumberingKka", ":id") }}';
                  url = url.replace(':id', id_mst_letter);

                  if (id_mst_letter) {
                    $.ajax({
                      url: url,
                      type: "GET",
                      dataType: "json",
                      success: function(data) {
                        if (data == true) {
                          $('#typeKka').show();
                          $('#codeKka').show();
                          $('select[name="kka_type"]').attr('required', 'required');
                          $('select[name="kka_code"]').attr('required', 'required');
                        } else {
                          $('#typeKka').hide();
                          $('#codeKka').hide();
                          $('select[name="kka_type"]').removeAttr('required');
                          $('select[name="kka_code"]').removeAttr('required');
                        }
                      }
                    });
                  } else {
                    $('#typeKka').hide();
                    $('select[name="kka_type"]').removeAttr('required');
                  }
                });
              });
            </script>
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
                    <select class="form-control js-example-basic-single" name="org_unit" style="width: 100%;" required>
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
                    <label id="labelSubSator" class="text-danger">Konseptor *</label>
                  </div>
                  <div class="col-9">
                    <select class="form-control js-example-basic-single" name="sub_org_unit" id="sub_org_unit" style="width: 100%;" required>
                      <option value="">- Pilih -</option>
                    </select>
                  </div>
                  <div class="col-3">
                  </div>
                  <script>
                    $(document).ready(function() {
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
                      <textarea class="summernote-editor" type="text" name="mail_regarding" placeholder="Masukkan Hal / Tentang Surat.." value="" required style="width: 100%"></textarea>
                    </td>
                  </tr>
                  {{-- Tanggal --}}
                  <tr>
                    <td><label class="text-danger">Tanggal *</label></td>
                    <td>
                      <div class="row">
                        <div class="col-6">
                          <label  class="text-danger">Tanggal Keluar *</label>
                          <input type="date" name="out_date" value="{{ old('out_date') }}" class="form-control" required>
                        </div>
                        <div class="col-6">
                          <label>Tanggal Surat</label>
                          <input type="date" name="mail_date" value="{{ old('mail_date') }}" class="form-control">
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
                              <option value="{{ $workunit->id }}">{{ $workunit->work_name }}</option>
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
                      <textarea class="summernote-editor" type="text" name="signing_other" placeholder="Masukkan Pihak Instansi Lain.." value="{{ old('signing_other') }}" style="width: 100%"></textarea>
                    </td>
                  </tr>
                  {{-- Penerima --}}
                  <tr>
                    <td><label class="text-danger">Penerima *</label></td>
                    <td>
                      <textarea class="summernote-editor" type="text" name="receiver" placeholder="Masukkan Penerima.." value="{{ old('receiver') }}" style="width: 100%" required></textarea>
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
                                <option value="{{ $unitletter->id }}" {{ $unitletter->unit_name == 'Lembar' ? 'selected' : '' }}>{{ $unitletter->unit_name }}</option>
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
                                <option value="{{ $archive_remain->name_value }}">{{ $archive_remain->name_value }}</option>
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
              <a href="{{ route('outgoingmail.index') }}" type="button" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
              <button type="submit" class="btn btn-primary" id="sbFormOutgoingMail"><i class="fa fa-paper-plane"></i> Kirim Data</button>
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

@endsection