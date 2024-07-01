@extends('layouts.blackand.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-8">
                <h1 class="m-0">Selamat Datang <b> Administrator </b></h1>
            </div><!-- /.col -->
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        {{-- <div class="row">

            <!-- ./col -->
            <div class="col-lg-6 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>44</h3>

                        <p>Jumlah Surat Masuk</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-file-export"></i>
                    </div>
                  
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-6 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>44</h3>

                        <p>Surat Keluar Sudah Diproses</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-check"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
        </div> --}}
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <!-- /.card -->

                        <div class="card card-warning card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <a href="/data-pesan">
                                        @php
                                        $tgl = date ('Y-m-d');
                                        @endphp
                                        Surat Keluar Hari ini <b> {{hari_ini()}},
                                            {{ dateIndonesia($tgl) }} </b></a></h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
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
                                            <td>{{ \Carbon\Carbon::parse($sk_keluar->mail_date)->format('Y-m-d') }}
                                            </td>
                                            <td>{{ $sk_keluar->mail_number }}</td>
                                            <td>{{ $sk_keluar->receiver }}</td>
                                            <td>{{ $sk_keluar->mail_regarding }}</td>
                                            <td>{{ $sk_keluar->attachment_text }}</td>
                                            <td>{{ $sk_keluar->drafter_name }}</td>
                                            <td>{{ $sk_keluar->information }}</td>
                                            <td>
                                                {{ $sk_keluar->created_at }}-<br><b>{{ $sk_keluar->updated_by }}</b>
                                               
                                            </td>
                                        </tr>
                                        @endforeach

                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>


                        <div class="card card-warning card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <a href="/data-pesan">
                                        @php
                                        $tgl = date ('Y-m-d');
                                        @endphp
                                        Surat Masuk Hari ini <b> {{hari_ini()}},
                                            {{ dateIndonesia($tgl) }} </b></a></h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example3" class="table table-bordered table-striped">
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
                                            <td class="align-middle text-center">{{ $sk_masuk->mail_regarding }}</td>
                                            <td class="align-middle text-center">{{ $sk_masuk->attachment_text }}</td>
                                            <td class="align-middle text-center">{{ $sk_masuk->receiver_name }}</td>
                                            <td class="align-middle text-center">{{ $sk_masuk->information }}</td>
                                            <td class="align-middle text-center">{{ $sk_masuk->created_at }} <br><b>{{ $sk_masuk->updated_by }}</b></td>

                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->

</section>

@endsection
