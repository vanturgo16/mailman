@extends('layouts.blackand.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-8">
                <h1 class="m-0">Selamat Datang <b>Administrator</b></h1>
            </div>
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- Grafik Surat Masuk Bulanan -->
            <div class="col-md-6">
                <div class="card card-warning card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Grafik Surat Masuk Bulanan</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="incomingMailChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Grafik Surat Keluar Bulanan -->
            <div class="col-md-6">
                <div class="card card-warning card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Grafik Surat Keluar Bulanan</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="outgoingMailChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card card-warning card-outline">
                <div class="card-header">
                    <h3 class="card-title">Grafik Surat Keluar Berdasarkan Jenis Surat</h3>
                </div>
                <div class="card-body">
                    
                    <div style="width: 60%; margin: auto;">
                        <canvas id="mailChart"></canvas>
                    </div>

                </div>
            </div>
        </div>

        <!-- Surat Keluar Hari Ini -->
        <div class="card card-warning card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <a href="">
                        @php
                        $tgl = date('Y-m-d');
                        @endphp
                        Surat Keluar Hari ini <b>{{ hari_ini() }}, {{ dateIndonesia($tgl) }}</b>
                    </a>
                </h3>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tgl. Surat</th>
                            <th>No. Surat</th>
                            <th>Penerima</th>
                            <th>Perihal / Tentang</th>
                            <th>Lampiran</th>
                            <th>Dari / Konseptor</th>
                            <th>Keterangan</th>
                            <th>Tgl. Dibuat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $no => $sk_keluar)
                        <tr>
                            <td>{{ ++$no }}</td>
                            <td>{{ \Carbon\Carbon::parse($sk_keluar->mail_date)->format('Y-m-d') }}</td>
                            <td>{{ $sk_keluar->mail_number }}</td>
                            <td>{!! $sk_keluar->receiver !!}</td>
                            <td>{!! $sk_keluar->mail_regarding !!}</td>
                            <td>{!! $sk_keluar->attachment_text !!}</td>
                            <td>{{ $sk_keluar->drafter_name }}</td>
                            <td>{!! $sk_keluar->information !!}</td>
                            <td>{{ $sk_keluar->created_at }}<br><b>{{ $sk_keluar->updated_by }}</b></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Surat Masuk Hari Ini -->
        <div class="card card-warning card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <a href="">
                        @php
                        $tgl = date('Y-m-d');
                        @endphp
                        Surat Masuk Hari ini <b>{{ hari_ini() }}, {{ dateIndonesia($tgl) }}</b>
                    </a>
                </h3>
            </div>
            <div class="card-body">
                <table id="example3" class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th rowspan="2" class="align-middle text-center">No.</th>
                            <th rowspan="2" class="align-middle text-center">Tgl. Agenda</th>
                            <th rowspan="2" class="align-middle text-center">No. Agenda</th>
                            <th colspan="3" class="align-middle text-center">Naskah / Surat</th>
                            <th rowspan="2" class="align-middle text-center">Lampiran</th>
                            <th rowspan="2" class="align-middle text-center">Kepada</th>
                            <th rowspan="2" class="align-middle text-center">Keterangan</th>
                            <th rowspan="2" class="align-middle text-center">Tgl. Dibuat</th>
                        </tr>
                        <tr>
                            <th class="align-middle text-center">No. Surat</th>
                            <th class="align-middle text-center">Terima Dari</th>
                            <th class="align-middle text-center">Isi / Perihal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas_in as $no => $sk_masuk)
                        <tr>
                            <td class="align-middle text-center">{{ $no + 1 }}</td>
                            <td class="align-middle text-center">{{ \Carbon\Carbon::parse($sk_masuk->mail_date)->format('Y-m-d') }}</td>
                            <td class="align-middle text-center">{{ $sk_masuk->agenda_number }}</td>
                            <td class="align-middle text-center">{{ $sk_masuk->mail_number }}</td>
                            <td class="align-middle text-center">{{ $sk_masuk->sender }}</td>
                            <td class="align-middle text-center">{!! $sk_masuk->mail_regarding !!}</td>
                            <td class="align-middle text-center">{{ $sk_masuk->attachment_text }}</td>
                            <td class="align-middle text-center">{!! $sk_masuk->receiver !!}</td>
                            <td class="align-middle text-center">{!! $sk_masuk->information !!}</td>
                            <td class="align-middle text-center">{{ $sk_masuk->created_at }}<br><b>{{ $sk_masuk->updated_by }}</b></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var incomingCtx = document.getElementById('incomingMailChart').getContext('2d');
    var incomingMailChart = new Chart(incomingCtx, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
                label: 'Number of Incoming Mails',
                data: @json(array_values($monthlyIncomingMails)),
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var outgoingCtx = document.getElementById('outgoingMailChart').getContext('2d');
    var outgoingMailChart = new Chart(outgoingCtx, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
                label: 'Number of Outgoing Mails',
                data: @json(array_values($monthlyOutgoingMails)),
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<script>
    var ctx = document.getElementById('mailChart').getContext('2d');
    var mailChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! $mails->pluck('let_name')->toJson() !!},
            datasets: [{
                label: 'Total Mails',
                data: {!! $mails->pluck('total')->toJson() !!},
                backgroundColor: {!! json_encode($colorData) !!},
                borderColor: {!! json_encode($colorData) !!}.map(color => color.replace('0.2', '1')),
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
