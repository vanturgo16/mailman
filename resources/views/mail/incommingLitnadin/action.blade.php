<div class="btn-group">
    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        Pilih Aksi
    </button>
    <div class="dropdown-menu dropdown-menu-right">
      <a href="{{ route('incommingmail.detailLitnadin', encrypt($data->id)) }}" type="button" class="dropdown-item drpdwn" type="button"><span class="mdi mdi-information"></span> | Detail</a>
      @if($data->agenda_number != null)
        <a href="#" type="button"  data-toggle="modal" data-target="#updateProgress{{ $data->id }}" class="dropdown-item drpdwn"><span class="mdi mdi-file-edit"></span> | Perbaharui Progress</a>
        <a href="{{ route('incommingmail.editLitnadin', encrypt($data->id)) }}" type="button" class="dropdown-item drpdwn" type="button"><span class="mdi mdi-file-edit"></span> | Ubah Data Keseluruhan</a>
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
            <div class="form-group">
              <label class="text-danger">Keterangan*</label>
              <input type="text" class="form-control" name="information" placeholder="Masukkan Keterangan.." required>
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
                @if($data->progressStatus == [])
                  <tr>
                    <td colspan="4" class="align-middle text-center"> - Belum Ada Riwayat Perubahan - </td>
                  </tr>
                @else
                  @php $i = 0; @endphp
                  @foreach ($data->progressStatus as $item)
                    @php $i++; @endphp
                    <tr>
                      <td class="align-middle text-center">{{ $i }}</td>
                      <td class="align-middle">{{ $item['information'] }}</td>
                      <td class="align-middle text-center">
                        @if($item['status'] == 1)
                          <span class="badge bg-success text-white">Selesai</span>
                        @elseif($item['status'] == 0)
                          <span class="badge bg-warning text-white">Revisi</span>
                        @else
                          <span class="badge bg-secondary text-white">Null</span>
                        @endif
                      </td>
                      <td class="align-middle">
                        {{ \Illuminate\Support\Facades\Date::parse($item['created_at'])->format('Y-m-d H:i:s') }}
                        <br><b>{{ $item['created_by'] }}</b>
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