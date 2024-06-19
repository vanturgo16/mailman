<div class="btn-group">
    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        Pilih Aksi
    </button>
    <div class="dropdown-menu dropdown-menu-right">
      <a href="{{ route('incommingmail.detail', encrypt($data->id)) }}" type="button" class="dropdown-item drpdwn" type="button"><span class="mdi mdi-information"></span> | Detail</a>
      @if($data->agenda_number != null)
        <a href="{{ route('incommingmail.edit', encrypt($data->id)) }}" type="button" class="dropdown-item drpdwn" type="button"><span class="mdi mdi-file-edit"></span> | Ubah Data</a>
      @endif
    </div>
</div>