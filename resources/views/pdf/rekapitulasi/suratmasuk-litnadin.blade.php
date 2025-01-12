<div class="header">Halaman <span class="page-number"></span></div>

<table cellspacing="0" cellpadding="0" width="100%">
    <tr><td class="align-middle text-center px-1"><h4>AGENDA</h4></td></tr>
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
    </table>
</span>

<br>
<span>
    <table class="styled-table-service">
        <thead>
            <tr>
                <th rowspan="2" class="align-middle text-center px-1" style="font-weight: normal; width:5%;">No. <br>Litnadin</th>
                <th rowspan="2" class="align-middle text-center px-1" style="font-weight: normal;">Tgl. Agenda</th>
                <th colspan="3" class="align-middle text-center px-1" style="font-weight: normal;">Naskah / Surat</th>
                <th rowspan="2" class="align-middle text-center px-1" style="font-weight: normal;">Jumlah<br>Lampiran</th>
                <th rowspan="2" class="align-middle text-center px-1" style="font-weight: normal;">Kepada</th>
                <th rowspan="2" class="align-middle text-center px-1" style="font-weight: normal;">Status</th>
                <th rowspan="2" class="align-middle text-center px-1" style="font-weight: normal;">Keterangan</th>
            </tr>
            <tr>
                <th class="align-middle text-center px-1" style="font-weight: normal;">No. Surat</th>
                <th class="align-middle text-center px-1" style="font-weight: normal;">Terima Dari</th>
                <th class="align-middle text-center px-1" style="font-weight: normal;">Isi / Perihal</th>
            </tr>
        </thead>
        <tbody>
            @if(empty($datas))
                <tr><td colspan="9" class="align-middle text-center py-2">- Tidak Ada Data -</td></tr>
            @else
                @foreach ($datas as $item)
                <tr>
                    <td class="align-top text-center">{{ $item->litnadin_number ?? '' }}</td>
                    <td class="align-top text-left px-2">{{ date('d-m-Y', strtotime($item->entry_date)) }}</td>
                    <td class="align-top text-left px-2">{{ $item->mail_number ?? '-' }}</td>
                    <td class="align-top text-left px-2">{{ $item->sub_sator_name ?? '-' }}</td>
                    <td class="align-top text-left px-2">
                        {!! $item->mail_regarding ?? '-' !!}
                        @if($item->mail_quantity)
                            <br><br><b>{{ $item->mail_quantity }} {{ $item->unit_name }}</b>
                        @endif
                    </td>
                    <td class="align-top text-left px-2">{!! $item->attachment_text ?? '-' !!}</td>
                    <td class="align-top text-left px-2">{{ $item->receiver ?? '-' }}</td>
                    <td class="align-top text-left px-1">
                        {{ $item->status === null ? '-' : ($item->status == 1 ? 'Selesai' : 'Revisi') }}
                    </td>
                    <td class="align-top text-left px-1">
                        {!! $item->information ?? '-' !!}
                        <br><br>Dikirim Via: {{ $item->received_via ?? '-' }}
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</span>