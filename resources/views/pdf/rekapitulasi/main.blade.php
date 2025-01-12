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
        .force-font-size, .force-font-size * {
            font-size: 9px !important;
        }
    </style>

    <body>
        @if($mailType == 'Surat Masuk')
            @include('pdf.rekapitulasi.suratmasuk')
        @elseif($mailType == 'Surat Masuk Litnadin')
            @include('pdf.rekapitulasi.suratmasuk-litnadin')
        @elseif($mailType == 'Surat Keluar')
            @include('pdf.rekapitulasi.suratkeluar')
        @endif
    </body>
</html>