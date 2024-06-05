@extends('layouts.blackand.app')
@section('content')
@extends('mail.head')

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
                    <button type="button" class="btn btn-secondary" style="width: 100%" data-toggle="modal" data-target="#unitKerja"><i class="fa fa-plus"></i> Tambah Baru</button>
                  </div>
                </div>
                <small>(Harus diisi khusus untuk Jenis Naskah Surat, Nota Dinas, Surat Pengantar dan Telaahan Staf jika bukan ditandatangani oleh Kapolri/Wakapolri)</small>
              </div>
              {{-- Perihal --}}
              <div class="col-md-6">
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

              <div class="col-md-6">
                <div class="form-group">
                  <label>Pengirim<i style="color: red;"> *</i></label>
                  <input type="text" name="sender" value="{{ old('sender') }}" class="form-control" placeholder="Masukan Pengirim.." required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Nomor Surat</label>
                  <input type="text" name="mail_number" value="{{ old('mail_number') }}" class="form-control" placeholder="Masukan Nomor Surat.." required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Perihal / Tentang<i style="color: red;"> *</i></label>
                  <textarea class="form-control" rows="3" type="text" name="mail_regarding" placeholder="Masukkan Perihal / Tentang Surat.." value="{{ old('mail_regarding') }}" required></textarea>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Tanggal Masuk<i style="color: red;"> *</i></label>
                  <input type="date" name="entry_date" value="{{ old('entry_date') }}" class="form-control" required>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Tanggal Surat<i style="color: red;"> *</i></label>
                  <input type="datetime-local" name="mail_date" value="{{ old('mail_date') }}" class="form-control" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Penerima<i style="color: red;"> *</i></label>
                  <select class="form-control js-example-basic-single" name="receiver" style="width: 100%;" required>
                    <option value="">- Pilih -</option>
                    @foreach($workunits as $workunit)
                      <option value="{{ $workunit->id }}" @if(old('receiver') == $workunit->id) selected="selected" @endif>{{ $workunit->work_name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>&nbsp;</label>
                  <button type="button" class="btn btn-secondary" style="width: 100%" data-toggle="modal" data-target="#unitKerja"><i class="fa fa-plus"></i> Tambah Baru</button>
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label>Jumlah<i style="color: red;"> *</i></label>
                  <input type="number" name="mail_quantity" value="{{ old('mail_quantity') }}" class="form-control" placeholder="Masukkan Jumlah.." required>
                </div>
              </div>
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
              
              <div class="col-md-3">
                <div class="form-group">
                  <label>Retensi Surat (Dari)</label>
                  <input type="date" name="Retensi Surat (Dari)" value="{{ old('Retensi Surat (Dari)') }}" class="form-control">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Retensi Surat (Hingga)</label>
                  <input type="datetime-local" name="Retensi Surat (Dari)" value="{{ old('Retensi Surat (Dari)') }}" class="form-control">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label>Jenis Surat</label>
                  <select class="form-control js-example-basic-single" name="mail_type" style="width: 100%;">
                    <option value="">- Pilih -</option>
                    <option value="-">-</option>
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>&nbsp;</label>
                  <button type="button" class="btn btn-secondary" style="width: 100%"><i class="fa fa-plus"></i> Tambah Baru</button>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Diterima Via</label>
                  <select class="form-control js-example-basic-single" name="received_via" style="width: 100%;">
                    <option value="">- Pilih -</option>
                    @foreach($receivedvias as $receivedvia)
                      <option value="{{ $receivedvia->name_value }}" @if(old('received_via') == $receivedvia->name_value) selected="selected" @endif>{{ $receivedvia->name_value }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Lampiran</label>
                  <textarea class="form-control" rows="3" type="text" name="attachment_text" placeholder="Masukkan Lampiran.." value="{{ old('attachment_text') }}"></textarea>
                </div>
              </div>
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
{{-- Unit Kerja --}}
<div class="modal fade" id="unitKerja" data-backdrop="static" data-keyboard="false" aria-labelledby="modalAddLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header" style="background-color: #0074F1; color: white;">
          <h5 class="modal-title font-weight-bold" id="modalAddLabel">Tambah Daftar Unit Kerja Internal</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('unitkerja.store') }}" method="POST" enctype="multipart/form-data" id="modalForm1">
          @csrf
          <div class="modal-body" style="max-height: 65vh; overflow-y: auto;">
              <div class="form-group">
                <label class="text-danger">Kode Unit Kerja*</label>
                <select class="form-control js-example-basic-single" name="kode_unit" style="width: 100%;" required>
                  <option value="">- Pilih -</option>
                  @foreach($sators as $sator)
                    <option value="{{ $sator->sator_name }}">{{ $sator->sator_name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                  <label class="text-danger">Nama Unit Kerja*</label>
                  <input type="text" class="form-control" id="" name="nama_unit" placeholder="Masukkan Unit Kerja.." required>
              </div>
              <div class="form-group">
                  <label class="text-danger">Nama Kepala Unit Kerja*</label>
                  <input type="text" class="form-control" id="" name="nama_kepala_unit" placeholder="Masukkan Kepala Unit Kerja.." required>
              </div>  
              <div class="form-group">
                  <label>Keterangan</label>
                  <textarea class="form-control" id="" rows="3" name="keterangan" placeholder="Keterangan..(Opsional)"></textarea>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary" id="sbForm1">Simpan</button>
          </div>
        </form>
        <script>
            document.getElementById('modalForm1').addEventListener('submit', function(event) {
                if (!this.checkValidity()) {
                    event.preventDefault();
                    return false;
                }
                var submitButton = this.querySelector('button[id="sbForm1"]');
                submitButton.disabled = true;
                submitButton.innerHTML  = '<i class="mdi mdi-loading mdi-spin"></i> Mohon Tunggu...';
                return true;
            });
        </script>
    </div>
  </div>
</div>
{{-- Satuan --}}
<div class="modal fade" id="satuan" data-backdrop="static" data-keyboard="false" aria-labelledby="modalAddLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header" style="background-color: #0074F1; color: white;">
          <h5 class="modal-title font-weight-bold" id="modalAddLabel">Tambah Daftar Satuan Naskah</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('satnas.store') }}" method="POST" enctype="multipart/form-data" id="modalForm2">
          @csrf
          <div class="modal-body" style="max-height: 65vh; overflow-y: auto;">
            <div class="form-group">
              <label class="text-danger">Nama Satuan*</label>
              <input type="text" class="form-control" name="nama_satuan_naskah" placeholder="Masukkan Nama Satuan.." required>
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <textarea class="form-control" rows="3" name="keterangan" placeholder="Masukkan Keterangan..(Opsional)"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary" id="sbForm2">Simpan</button>
          </div>
        </form>
        <script>
            document.getElementById('modalForm2').addEventListener('submit', function(event) {
                if (!this.checkValidity()) {
                    event.preventDefault();
                    return false;
                }
                var submitButton = this.querySelector('button[id="sbForm2"]');
                submitButton.disabled = true;
                submitButton.innerHTML  = '<i class="mdi mdi-loading mdi-spin"></i> Mohon Tunggu...';
                return true;
            });
        </script>
    </div>
  </div>
</div>
{{-- Klasifikasi --}}
<div class="modal fade" id="klasifikasi" data-backdrop="static" data-keyboard="false" aria-labelledby="modalAddLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header" style="background-color: #0074F1; color: white;">
          <h5 class="modal-title font-weight-bold" id="modalAddLabel">Tambah Daftar Klasifikasi Arsip</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('klasifikasi.store') }}" method="POST" enctype="multipart/form-data" id="modalForm3">
          @csrf
          <div class="modal-body" style="max-height: 65vh; overflow-y: auto;">
            <div class="form-group">
              <label class="text-danger">Nama Klasifikasi Arsip*</label>
              <input type="text" class="form-control" name="nama_klasifikasi" placeholder="Masukkan Nama.." required>
            </div>
            <div class="form-group">
                <label>Retensi (Tahun)</label>
                <input type="number" min="0" class="form-control" name="tahun_retensi" placeholder="Retensi Tahun..(Opsional)" required>
            </div>
            <div class="form-group">
                <label>Retensi (Bulan)</label>
                <input type="text" min="0" class="form-control" name="bulan_retensi" placeholder="Retensi Bulan..(Opsional)" required>
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <textarea class="form-control" rows="3" name="keterangan" placeholder="Masukkan Keterangan..(Opsional)"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary" id="sbForm3">Simpan</button>
          </div>
        </form>
        <script>
            document.getElementById('modalForm3').addEventListener('submit', function(event) {
                if (!this.checkValidity()) {
                    event.preventDefault();
                    return false;
                }
                var submitButton = this.querySelector('button[id="sbForm3"]');
                submitButton.disabled = true;
                submitButton.innerHTML  = '<i class="mdi mdi-loading mdi-spin"></i> Mohon Tunggu...';
                return true;
            });
        </script>
    </div>
  </div>
</div>

<script>
  $(".js-example-basic-single").select2().on("select2:open", function () {
      document.querySelector(".select2-search__field").focus();
  });
</script>

@endsection