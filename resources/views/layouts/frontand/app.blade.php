<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="wpOceans">
    <link rel="shortcut icon" type="image/png" href="{{ asset('frontend/images/favicon_si_agen_126.png') }}">
    <title>SI-AGEN 126</title>
    <link href="{{ asset('frontend/css/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/flaticon.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/owl.theme.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/slick-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/swiper.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/owl.transitions.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/jquery.fancybox.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/odometer-theme-default.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/component.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/sass/style.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet">

    @if (request()->is('/'))
        <style>
            .template {
                display: grid;
                grid-template-columns: 1fr 1fr;
                grid-template-rows: 1fr 1fr;
                grid-gap: 20px;
                grid-template-areas:
                    'satu dua'
                    'satu tiga';
            }

            .satu {
                background-color: lightblue;
                grid-area: satu;
                background-image: url('{{ asset('storage/berita/' . $posts[0]->image) }}');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                min-height: 600px;
                border-radius: 25px;
                padding: 20px;
                display: grid;
                align-content: flex-end;
                transition: all .5s;
            }

            .satu:hover,
            .dua:hover,
            .tiga:hover {
                transform: scale(1.02);
                transition: all .2s;
            }

            .excerpt,
            .wpo-blog-content-new a,
            p,
            ul {
                color: white;
            }

            .wpo-blog-content-new ul li+li {
                margin-left: 20px;
            }


            .wpo-blog-content-new ul {
                display: -webkit-box;
                {{--  display: -ms-flexbox;  --}} display: flex;
                -webkit-box-align: center;
                {{--  -ms-flex-align: center;  --}} align-items: center;
                list-style: none;
            }

            .dua {
                background-color: steelblue;
                grid-area: dua;
                background-image: url('{{ asset('storage/berita/' . $posts[1]->image) }}');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                border-radius: 25px;
                padding: 20px;
                display: grid;
                align-content: flex-end;
                transition: all .5s;
            }

            .tiga {
                background-color: seagreen;
                grid-area: tiga;
                background-image: url('{{ asset('storage/berita/' . $posts[2]->image) }}');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                border-radius: 25px;
                padding: 20px;
                display: grid;
                align-content: flex-end;
                transition: all .5s;
            }

            @media only screen and (max-width: 961px) {
                .template {
                    display: grid;
                    grid-template-columns: 1fr;
                    grid-gap: 20px;
                    grid-template-areas:
                        'satu'
                        'dua'
                        'tiga';
                    margin: 5px;
                }

                .satu,
                .dua,
                .tiga {
                    min-height: 300px;
                    border-radius: 25px;
                    padding: 20px;
                    display: grid;
                    align-content: flex-end;
                }
            }
        </style>
    @endif
    @if (request()->is('juknis') or request()->is('agenda'))
        <style>
            * {
                box-sizing: border-box;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
            }

            body {
                font-family: Helvetica;
                -webkit-font-smoothing: antialiased;
                {{--  background: rgba(71, 147, 227, 1);  --}}
            }

            {{--  h2 {
                text-align: center;
                font-size: 18px;
                text-transform: uppercase;
                letter-spacing: 1px;
                color: white;
                padding: 30px 0;
            }  --}}
            /* Table Styles */

            .table-wrapper {
                {{--  margin: 10px 70px 70px;  --}} box-shadow: 0px 35px 50px rgba(0, 0, 0, 0.2);
            }

            .fl-table {
                border-radius: 5px;
                font-size: 12px;
                font-weight: normal;
                border: none;
                border-collapse: collapse;
                width: 100%;
                max-width: 100%;
                white-space: nowrap;
                background-color: white;
            }

            .fl-table td,
            .fl-table th {
                text-align: center;
                padding: 8px;
                font-size: 16px;
            }



            .fl-table td {
                border-right: 1px solid #f8f8f8;
                font-size: 16px;
            }

            .fl-table thead th {
                color: #ffffff;
                background: #4FC3A1;
            }


            .fl-table thead th:nth-child(odd) {
                color: #ffffff;
                background: #324960;
            }

            .fl-table tr:nth-child(even) {
                background: #F8F8F8;
            }

            /* Responsive */

            @media (max-width: 767px) {
                .fl-table {
                    display: block;
                    width: 100%;
                }

                .table-wrapper:before {
                    content: "Scroll horizontally >";
                    display: block;
                    text-align: right;
                    font-size: 11px;
                    color: white;
                    padding: 0 0 10px;
                }

                .fl-table thead,
                .fl-table tbody,
                .fl-table thead th {
                    display: block;
                }

                .fl-table thead th:last-child {
                    border-bottom: none;
                }

                .fl-table thead {
                    float: left;
                }

                .fl-table tbody {
                    width: auto;
                    position: relative;
                    overflow-x: auto;
                }

                .fl-table td,
                .fl-table th {
                    padding: 20px .625em .625em .625em;
                    height: 60px;
                    vertical-align: middle;
                    box-sizing: border-box;
                    overflow-x: hidden;
                    overflow-y: auto;
                    width: 120px;
                    font-size: 13px;
                    text-overflow: ellipsis;
                }

                .fl-table thead th {
                    text-align: left;
                    border-bottom: 1px solid #f7f7f9;
                }

                .fl-table tbody tr {
                    display: table-cell;
                }

                .fl-table tbody tr:nth-child(odd) {
                    background: none;
                }

                .fl-table tr:nth-child(even) {
                    background: transparent;
                }

                .fl-table tr td:nth-child(odd) {
                    background: #F8F8F8;
                    border-right: 1px solid #E6E4E4;
                }

                .fl-table tr td:nth-child(even) {
                    border-right: 1px solid #E6E4E4;
                }

                .fl-table tbody td {
                    display: block;
                    text-align: center;
                }
            }

            table {
                margin: auto;
                font-family: "Arial";
                font-size: 12px;

            }

            .table {
                border-collapse: collapse;
                font-size: 13px;
            }

            .table th,
            .table td {
                border-bottom: 1px solid #cccccc;
                border-left: 1px solid #cccccc;
                padding: 9px 21px;
            }

            .table th,
            .table td:last-child {
                border-right: 1px solid #cccccc;
            }

            .table td:first-child {
                border-top: 1px solid #cccccc;
            }

            caption {
                caption-side: top;
                margin-bottom: 10px;
                font-size: 16px;
            }

            /* Table Header */
            .table thead th {
                background-color: #2ECD71;
                background-color: #10b8eb;
                color: #FFFFFF;
            }

            /* Table Body */
            .table tbody td {
                color: #353535;
            }

            .table tbody tr:nth-child(odd) td {
                background-color: #f5fff9;
            }

            .table tbody tr:hover th,
            .table tbody tr:hover td {
                background-color: #f0f0f0;
                transition: all .2s;
            }

            /*Tabel Responsive 1*/
            .table-container {
                overflow: auto;
            }
        </style>
    @endif

</head>

<body>

    @include('layouts.frontand.navigasi')
    @yield('content')
    @include('layouts.frontand.footer')

    <!-- All JavaScript files
    ================================================== -->
    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Plugins for this template -->
    <script src="{{ asset('frontend/js/modernizr.custom.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery-plugin-collection.js') }}"></script>
    <!-- Custom script for this template -->
    <script src="{{ asset('frontend/js/script.js') }}"></script>
</body>

</html>
