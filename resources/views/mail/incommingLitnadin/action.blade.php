<div class="btn-group">
    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        Pilih Aksi
    </button>
    <div class="dropdown-menu dropdown-menu-right">
      <a href="{{ route('incommingmail.detailLitnadin', [
              'id' => encrypt($data->id),
              'entry_date' => request()->get('entry_date'),
              'mail_date' => request()->get('mail_date'),
              'mail_number' => request()->get('mail_number'),
              'litnadin_number' => request()->get('litnadin_number'),
              'org_unit' => request()->get('org_unit'),
              'letter' => request()->get('letter'),
              'receiver' => request()->get('receiver'),
              'jmlHal' => request()->get('jmlHal'),
              'status' => request()->get('status'),
          ]) }}" type="button" class="dropdown-item drpdwn" type="button">
          <span class="mdi mdi-information"></span> | Detail
      </a>
      @if($data->agenda_number != null)
        <a href="#" type="button"  data-toggle="modal" data-target="#updateProgress{{ $data->id }}" class="dropdown-item drpdwn"><span class="mdi mdi-file-edit"></span> | Perbaharui Progress</a>

        <a href="{{ route('incommingmail.editLitnadin', [
                'id' => encrypt($data->id),
                'entry_date' => request()->get('entry_date'),
                'mail_date' => request()->get('mail_date'),
                'mail_number' => request()->get('mail_number'),
                'litnadin_number' => request()->get('litnadin_number'),
                'org_unit' => request()->get('org_unit'),
                'letter' => request()->get('letter'),
                'receiver' => request()->get('receiver'),
                'jmlHal' => request()->get('jmlHal'),
                'status' => request()->get('status'),
            ]) }}" type="button" class="dropdown-item drpdwn" type="button">
            <span class="mdi mdi-file-edit"></span> | Ubah Data Keseluruhan
        </a>
      @endif
    </div>
</div>

{{-- Update Progress --}}
<div class="modal fade" id="updateProgress{{ $data->id }}" data-backdrop="static" data-keyboard="false" aria-labelledby="modalAddLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content text-left">
        <div class="modal-header" style="background-color: #0074F1; color: white;">
          <h5 class="modal-title font-weight-bold" id="modalAddLabel">Perbaharui Progress Surat Masuk</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('incommingmail.createProgressLitnadin', encrypt($data->id)) }}" method="POST" enctype="multipart/form-data" id="modalForm{{ $data->id }}">
          @csrf
          <div class="modal-body" style="max-height: 65vh; overflow-y: auto;">
            @if($data->countProgress < 3)
              <!-- Pass filters as hidden fields -->
              <input type="hidden" name="filt_entry_date" value="{{ request()->get('entry_date') }}">
              <input type="hidden" name="filt_mail_date" value="{{ request()->get('mail_date') }}">
              <input type="hidden" name="filt_mail_number" value="{{ request()->get('mail_number') }}">
              <input type="hidden" name="filt_litnadin_number" value="{{ request()->get('litnadin_number') }}">
              <input type="hidden" name="filt_org_unit" value="{{ request()->get('org_unit') }}">
              <input type="hidden" name="filt_letter" value="{{ request()->get('letter') }}">
              <input type="hidden" name="filt_receiver" value="{{ request()->get('receiver') }}">
              <input type="hidden" name="filt_jmlHal" value="{{ request()->get('jmlHal') }}">
              <input type="hidden" name="filt_status" value="{{ request()->get('status') }}">

              <div class="form-group">
                <label class="text-danger">Keterangan*</label>
                <textarea class="summernote-editor" type="text" name="information" placeholder="Masukkan Keterangan.." value="" style="width: 100%" required></textarea>
              </div>
              <div class="form-group">
                <label class="text-danger">Status*</label>
                <select class="form-control js-example-basic-single" name="status" style="width: 100%;" required>
                  <option value="">- Pilih -</option>
                  <option value="0">Revisi</option>
                  <option value="1">Selesai</option>
                </select>
              </div>
            @else
              <div class="text-center py-2">Tidak Dapat Melakukan Perubahan Progress Lagi, <br> Karena Sudah <b>3 Kali</b> Dilakukan Perubahan</div>
            @endif
            <hr>
            <label>Riwayat</label>
            <table class="table table-striped table-bordered">
              <thead class="thead-light">
                <tr>
                  <th class="align-middle text-center">No.</th>
                  <th class="align-middle text-center">Keterangan</th>
                  <th class="align-middle text-center">Status</th>
                  <th class="align-middle text-center">Tanggal<br>Diperbaharui</th>
                </tr>
              </thead>
              <tbody>
                @php $progressStatus = json_decode($data->progressStatus, true); @endphp
                @if (empty($progressStatus))
                  <tr>
                    <td colspan="4" class="align-middle text-center"> - Belum Ada Riwayat Perubahan - </td>
                  </tr>
                @else
                  @foreach ($progressStatus as $index => $item)
                      <tr>
                          <td class="align-middle text-center">{{ $index + 1 }}</td>
                          <td class="align-middle">{!! $item['information'] ?? 'Keterangan tidak tersedia' !!}</td>
                          <td class="align-middle text-center">
                              @php
                                  $badgeClasses = $item['status'] == '1' ? 'bg-success' : ($item['status'] == '0' ? 'bg-warning' : 'bg-secondary');
                                  $statusText = $item['status'] == '1' ? 'Selesai' : ($item['status'] == '0' ? 'Revisi' : 'Null');
                              @endphp
                              <span class="badge {{ $badgeClasses }} text-white">{{ $statusText }}</span>
                          </td>
                          <td class="align-middle">
                              {{ \Carbon\Carbon::parse($item['updated_at'])->format('Y-m-d H:i:s') }}
                          </td>
                      </tr>
                  @endforeach
                @endif
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            @if($data->countProgress < 3)
              <button type="submit" class="btn btn-primary" id="sbForm{{ $data->id }}">Perbaharui</button>
            @endif
          </div>
        </form>
        <script>
          document.getElementById('modalForm{{ $data->id }}').addEventListener('submit', function(event) {
              if (!this.checkValidity()) {
                  event.preventDefault();
                  return false;
              }
              var submitButton = this.querySelector('button[id="sbForm{{ $data->id }}"]');
              submitButton.disabled = true;
              submitButton.innerHTML  = '<i class="mdi mdi-loading mdi-spin"></i> Mohon Tunggu...';
              return true;
          });
        </script>
    </div>
  </div>
</div>