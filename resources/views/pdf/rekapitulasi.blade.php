<!DOCTYPE html>
<html>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

  <style>
    .styled-table-service {
      width: 100%;
      border-collapse: collapse;
      font-size: 9px;
    }

    .styled-table-service thead {
      background-color: #C9C9C9;
    }

    .styled-table-service th,
    .styled-table-service td {
      border: 0.75px solid black;
      text-align: left;
    }

    .styled-table-service tbody tr:nth-child(even) {
      background-color: #ffffff;
    }

    @page {
      margin-top: 50px;
      margin-bottom: 30px;
      margin-left: 30px;
      margin-right: 30px;
      @top-right {
        content: counter(page);
        font-size: 12px;
        color: #000;
      }
    }

    .page-number:after {
      content: counter(page);
    }

    .header {
      position: fixed;
      top: -40px;
      right: 0px;
      font-size: 12px;
    }
  </style>

  <body>
    <div class="header">
      Halaman <span class="page-number"></span>
    </div>

    <table cellspacing="0" cellpadding="0" width="100%">
      <tr>
        <td align="center">
          <h4>Verbal</h4>
        </td>
      </tr>
    </table>
    <br>
    <br>

    <span>
      <table cellspacing="0" cellpadding="0" style="font-size: 12px;">
        <tr>
          <td>
            <span><b>Periode</b> </span>
          </td>
          <td>
            <span> &nbsp; : &nbsp; </span>
          </td>
          <td>
            <span>
              @if($startdate != null)
                {{ date('d-m-Y', strtotime($startdate)) }}
              @else
                -
              @endif
                s.d 
              @if($enddate != null)
                {{ date('d-m-Y', strtotime($enddate)) }}
              @else
                -
              @endif
            </span>
          </td>
          <td>
          </td>
        </tr>
        <tr>
          <td>
            <span><b>Tgl. Cetak</b> </span>
          </td>
          <td>
            <span> &nbsp; : &nbsp; </span>
          </td>
          <td>
            <span>{{ date('d-m-Y H:i:s', strtotime($print_date)) }}</span>
          </td>
          <td>
          </td>
        </tr>
        <tr>
          <td>
            <span><b>User</b> </span>
          </td>
          <td>
            <span> &nbsp; : &nbsp; </span>
          </td>
          <td>
            <span>{{ $user }}</span>
          </td>
          <td>
          </td>
        </tr>
        <tr>
          <td>
            <span><b>Jenis Naskah</b> </span>
          </td>
          <td>
            <span> &nbsp; : &nbsp; </span>
          </td>
          <td>
            <span>
              @if($letter != null)
                {{ $letter }}
              @else
                -
              @endif
            </span>
          </td>
          <td>
          </td>
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
            <tr>
              <td colspan="8" class="align-middle text-center py-2">- Tidak Ada Data -</td>
            </tr>
          @else
            <?php $no = 0; ?>
            @foreach ($datas as $item)
              <?php $no++; ?>
              <tr>
                <td class="align-top text-center">{{ $no }}</td>
                <td class="align-top px-2">{{ date('d-m-Y', strtotime($item->out_date)) }}</td>
                <td class="align-top px-2">
                  @if($item->mail_number == null)
                    -
                  @else
                    <b>{{ $item->mail_number }}</b>
                  @endif
                </td>
                <td class="align-top text-left px-2">
                  @if($item->receiver == null)
                    -
                  @else
                    {!! $item->receiver !!}
                  @endif
                </td>
                <td class="align-top text-left px-2">
                  @if($item->mail_regarding == null)
                    -
                  @else
                    {!! $item->mail_regarding !!}
                  @endif
                  @if($item->mail_quantity == null)
                  @else
                    <br><br><b>{{ $item->mail_quantity }} {{ $item->unit_name }}</b>
                  @endif
                </td>
                <td class="align-top px-2">
                  @if($item->attachment_text == null)
                    -
                  @else
                    {!! $item->attachment_text !!}
                  @endif
                </td>
                <td class="align-top text-left px-2">
                  {{ $item->sub_sator_name }}
                  <br><br><b>Tanda Tangan:</b><br>
                  {{ $item->signer }}
                </td>
                <td class="align-top text-left px-2">
                  @if($item->archive_remains == null)
                    (Tanpa Arsip)<br>
                  @else
                    {{ $item->archive_remains }}<br>
                  @endif

                  @if($item->information == null)
                    -
                  @else
                    {!! $item->information !!}
                  @endif
                </td>
              </tr>
            @endforeach
          @endif
        </tbody>
      </table>
    </span>
  </body>
</html>
