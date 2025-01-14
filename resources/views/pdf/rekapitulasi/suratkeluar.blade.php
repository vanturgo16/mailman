<div class="header">Halaman <span class="page-number"></span></div>

<table cellspacing="0" cellpadding="0" width="100%">
    <tr><td class="align-middle text-center px-1"><h4>Verbal</h4></td></tr>
</table>
<br><br>

<span>
    <table cellspacing="0" cellpadding="0" style="font-size: 12px;">
        <tr>
            <td><span><b>Periode</b> </span></td>
            <td><span> &nbsp; : &nbsp; </span></td>
            <td>
                <span>
                    {{ $startdate ? date('d-m-Y', strtotime($startdate)) : '-' }} s.d 
                    {{ $enddate ? date('d-m-Y', strtotime($enddate)) : '-' }}
                </span>            
            </td>
            <td></td>
        </tr>
        <tr>
            <td><span><b>Tgl. Cetak</b> </span></td>
            <td><span> &nbsp; : &nbsp; </span></td>
            <td>
                <span>{{ date('d-m-Y H:i:s', strtotime($print_date)) }}</span>            
            </td>
            <td></td>
        </tr>
        <tr>
            <td><span><b>User</b> </span></td>
            <td><span> &nbsp; : &nbsp; </span></td>
            <td>
                <span>{{ $user }}</span>            
            </td>
            <td></td>
        </tr>
        <tr>
            <td><span><b>Jenis Naskah</b> </span></td>
            <td><span> &nbsp; : &nbsp; </span></td>
            <td>
                <span>{{ $letter ?? '-' }}</span>            
            </td>
            <td></td>
        </tr>
    </table>
</span>

<br>
<span>
    <table class="styled-table-service">
        <thead>
            <tr>
                <th class="align-middle text-center px-1" style="font-weight: normal; width:5%;"><b>No.</b></th>
                <th class="align-middle text-center px-1" style="font-weight: normal;"><b>Tgl. Surat</b></th>
                <th class="align-middle text-center px-1" style="font-weight: normal;"><b>No. Verbal</b></th>
                <th class="align-middle text-center px-1" style="font-weight: normal;"><b>Kepada</b></th>
                <th class="align-middle text-center px-1" style="font-weight: normal;"><b>Isi / Perihal</b></th>
                <th class="align-middle text-center px-1" style="font-weight: normal;"><b>Lampiran</b></th>
                <th class="align-middle text-center px-1" style="font-weight: normal;"><b>Dari / Konseptor</b></th>
                <th class="align-middle text-center px-1" style="font-weight: normal;"><b>Keterangan</b></th>
            </tr>
        </thead>
        <tbody>
            @if(empty($datas))
                <tr><td colspan="8" class="align-middle text-center py-2">- Tidak Ada Data -</td></tr>
            @else
                @foreach ($datas as $item)
                <tr>
                    <td class="align-top text-center">{{ $loop->iteration }}</td>
                    {{-- <td class="align-top text-center">{{ $item->no_order }}</td> --}}
                    <td class="align-top text-left px-2">{{ date('d-m-Y', strtotime($item->out_date)) }}</td>
                    <td class="align-top text-left px-2">{{ $item->mail_number ?? '-' }}</td>
                    <td class="align-top text-left px-2">{!! $item->receiver ?? '-' !!}</td>
                    <td class="align-top text-left px-2">
                        {!! $item->mail_regarding ?? '-' !!}
                        @if($item->mail_quantity)
                            <br><br><b>{{ $item->mail_quantity }} {{ $item->unit_name }}</b>
                        @endif
                    </td>
                    <td class="align-top text-left px-2">{!! $item->attachment_text ?? '-' !!}</td>
                    <td class="align-top text-left px-2">
                        {{ $item->sub_sator_name ?? '-' }}
                        <br><br><b>Tanda Tangan:</b><br>
                        {{ $item->signer ?? '-' }}
                    </td>
                    <td class="align-top text-left px-2">
                        {{ $item->archive_remains ?? '(Tanpa Arsip)' }}
                        {!! $item->information ?? '-' !!}
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</span>