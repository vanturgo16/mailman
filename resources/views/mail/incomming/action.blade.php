<div class="btn-group">
    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        Pilih Aksi
    </button>
    <div class="dropdown-menu dropdown-menu-right">
      <a href="{{ route('incommingmail.detail', [
              'id' => encrypt($data->id),
              'entry_date' => request()->get('entry_date'),
              'mail_date' => request()->get('mail_date'),
              'mail_number' => request()->get('mail_number'),
              'placeman' => request()->get('placeman'),
              'letter' => request()->get('letter'),
              'complain' => request()->get('complain'),
              'org_unit' => request()->get('org_unit'),
          ]) }}" type="button" class="dropdown-item drpdwn" type="button">
          <span class="mdi mdi-information"></span> | Detail
      </a>
      @if($data->agenda_number != null)
        <a href="{{ route('incommingmail.edit', [
                'id' => encrypt($data->id),
                'entry_date' => request()->get('entry_date'),
                'mail_date' => request()->get('mail_date'),
                'mail_number' => request()->get('mail_number'),
                'placeman' => request()->get('placeman'),
                'letter' => request()->get('letter'),
                'complain' => request()->get('complain'),
                'org_unit' => request()->get('org_unit'),
            ]) }}" type="button" class="dropdown-item drpdwn" type="button">
            <span class="mdi mdi-file-edit"></span> | Ubah Data Keseluruhan
        </a>
      @endif
    </div>
</div>