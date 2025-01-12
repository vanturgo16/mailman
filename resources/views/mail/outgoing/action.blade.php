<div class="btn-group">
    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        Pilih Aksi
    </button>
    <div class="dropdown-menu dropdown-menu-right">
      <a href="{{ route('outgoingmail.detail', [
              'id' => encrypt($data->id),
              'out_date' => request()->get('out_date'),
              'mail_date' => request()->get('mail_date'),
              'mail_number' => request()->get('mail_number'),
              'id_mst_letter' => request()->get('id_mst_letter'),
              'archive_remain' => request()->get('archive_remain'),
              'org_unit' => request()->get('org_unit'),
          ]) }}" type="button" class="dropdown-item drpdwn" type="button">
          <span class="mdi mdi-information"></span> | Detail
      </a>
      @if($data->mail_number != null)
        <a href="{{ route('outgoingmail.edit', [
              'id' => encrypt($data->id),
              'out_date' => request()->get('out_date'),
              'mail_date' => request()->get('mail_date'),
              'mail_number' => request()->get('mail_number'),
              'id_mst_letter' => request()->get('id_mst_letter'),
              'archive_remain' => request()->get('archive_remain'),
              'org_unit' => request()->get('org_unit'),
            ]) }}" type="button" class="dropdown-item drpdwn" type="button">
            <span class="mdi mdi-file-edit"></span> | Ubah Data Keseluruhan
        </a>
      @endif
    </div>
</div>