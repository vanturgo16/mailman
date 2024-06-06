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
{{-- Satuan Organisasi --}}
<div class="modal fade" id="satuanOrg" data-backdrop="static" data-keyboard="false" aria-labelledby="modalAddLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header" style="background-color: #0074F1; color: white;">
          <h5 class="modal-title font-weight-bold" id="modalAddLabel">Tambah Daftar Satuan Organisasi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('sator.store') }}" method="POST" enctype="multipart/form-data" id="modalForm4">
          @csrf
          <div class="modal-body" style="max-height: 65vh; overflow-y: auto;">
            <div class="form-group">
              <label class="text-danger">Nama Satuan Organisasi*</label>
              <input type="text" class="form-control" id="" name="nama_satuan" required>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea class="form-control" id="" rows="2" name="alamat"></textarea>
            </div>
            <div class="form-group">
                <label>keterangan</label>
                <textarea class="form-control" id="" rows="2" name="keterangan"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary" id="sbForm4">Simpan</button>
          </div>
        </form>
        <script>
            document.getElementById('modalForm4').addEventListener('submit', function(event) {
                if (!this.checkValidity()) {
                    event.preventDefault();
                    return false;
                }
                var submitButton = this.querySelector('button[id="sbForm4"]');
                submitButton.disabled = true;
                submitButton.innerHTML  = '<i class="mdi mdi-loading mdi-spin"></i> Mohon Tunggu...';
                return true;
            });
        </script>
    </div>
  </div>
</div>
{{-- Arsip Pertinggal --}}
<div class="modal fade" id="archiveRemain" data-backdrop="static" data-keyboard="false" aria-labelledby="modalAddLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header" style="background-color: #0074F1; color: white;">
          <h5 class="modal-title font-weight-bold" id="modalAddLabel">Tambah Daftar Arsip Pertinggal</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="#" method="POST" enctype="multipart/form-data" id="modalForm5">
          @csrf
          <div class="modal-body" style="max-height: 65vh; overflow-y: auto;">
            <div class="form-group">
              <label class="text-danger">Jenis Arsip Pertinggal*</label>
              <input type="text" class="form-control" id="" name="archive_remain_type" placeholder="Masukkan Type Arsip.." required>
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <textarea class="form-control" id="" rows="3" name="information" placeholder="Masukkan Keterangan..(Opsional)"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary" id="sbForm5">Simpan</button>
          </div>
        </form>
        <script>
            document.getElementById('modalForm5').addEventListener('submit', function(event) {
                if (!this.checkValidity()) {
                    event.preventDefault();
                    return false;
                }
                var submitButton = this.querySelector('button[id="sbForm5"]');
                submitButton.disabled = true;
                submitButton.innerHTML  = '<i class="mdi mdi-loading mdi-spin"></i> Mohon Tunggu...';
                return true;
            });
        </script>
    </div>
  </div>
</div>
