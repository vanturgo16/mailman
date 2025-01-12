<div class="btn-group">
    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        Pilih Aksi
    </button>
    <div class="dropdown-menu dropdown-menu-right">
      <a href="{{ route('outgoingmail.detail', encrypt($data->id)) }}" type="button" class="dropdown-item drpdwn" type="button"><span class="mdi mdi-information"></span> | Detail</a>
      @if($data->mail_number != null)
        <a href="{{ route('outgoingmail.edit', encrypt($data->id)) }}" type="button" class="dropdown-item drpdwn" type="button"><span class="mdi mdi-file-edit"></span> | Ubah Data Keseluruhan</a>
      @endif
      {{-- <div class="dropdown-divider"></div>
      <a href="#" type="button" class="dropdown-item drpdwn-dgr" type="button"><span class="mdi mdi-delete-alert"></span> | Hapus</a> --}}
    </div>
</div>