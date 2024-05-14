@extends('layouts.frontand.app')
@section('content')
    <div class="page-wrapper">
        <!-- start of breadcumb-section -->
        <div class="wpo-breadcumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="wpo-breadcumb-wrap">
                            <h2>Agenda</h2>
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><span>Agenda</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of wpo-breadcumb-section-->

        <!-- start wpo-contact-pg-section -->
        <section class="wpo-contact-pg-section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col col-lg-12">
                        <div class="office-info">
                            <div class="row">
                                <div class="col col-xl-12 col-lg-12 col-md-12 col-12">
                                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            @php
                                                $tgl = date('Y-m-d');
                                            @endphp
                                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-home" type="button" role="tab"
                                                aria-controls="pills-home" aria-selected="true">Agenda Hari Ini
                                                {{ hari_ini() }},{{ dateIndonesia($tgl) }}</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-profile" type="button" role="tab"
                                                aria-controls="pills-profile" aria-selected="false">Agenda
                                                Terlaksana</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                            aria-labelledby="pills-home-tab" tabindex="0">
                                            <div class="col-12">
                                                {{--  <table class="table">
                                                    <thead class="table-dark">
                                                        <tr>
                                                            <th>Nama Kegiatan</th>
                                                            <th>Tempat</th>
                                                            <th>PJ</th>
                                                            <th>Pejabat</th>
                                                            <th>Tanggal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($pejabat_hari_ini as $ag_hari_ini)
                                                            <tr>
                                                                <td>{{ $ag_hari_ini->nm_kegiatan }}</td>
                                                                <td>{{ $ag_hari_ini->tempat }}</td>
                                                                <td>{{ $ag_hari_ini->nm_opd }}</td>
                                                                <td>{{ $ag_hari_ini->nm_pejabat }}</td>
                                                                <td>{{ dateIndonesia($ag_hari_ini->tgl) }}</td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="5" align="center">Tidak ada agenda</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>  --}}

                                                <div class="table-container">
                                                    <table class="table">
                                                        {{--  <h3 class="text-center">Tabel Responsive 1</h3>
                                                        <caption>Tabel responsive dengan container</caption>  --}}
                                                        <thead>
                                                            <tr>
                                                                <th>Nama Kegiatan</th>
                                                                <th>Tempat</th>
                                                                <th>PJ</th>
                                                                <th>Pejabat</th>
                                                                <th>Tanggal</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($pejabat_hari_ini as $ag_hari_ini)
                                                                <tr>
                                                                    <td>{{ $ag_hari_ini->nm_kegiatan }}</td>
                                                                    <td>{{ $ag_hari_ini->tempat }}</td>
                                                                    <td>{{ $ag_hari_ini->nm_opd }}</td>
                                                                    <td>{{ $ag_hari_ini->nm_pejabat }}</td>
                                                                    <td>{{ dateIndonesia($ag_hari_ini->tgl) }}</td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="5" align="center">Tidak ada agenda</td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                            aria-labelledby="pills-profile-tab" tabindex="0">
                                            <div class="col-12">
                                                {{--  <table class="table">
                                                    <thead class="table-dark">
                                                        <tr>
                                                            <th>Nama Kegiatan</th>
                                                            <th>Tempat</th>
                                                            <th>PJ</th>
                                                            <th>Pejabat</th>
                                                            <th>Tanggal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($pejabat as $ag)
                                                            <tr>
                                                                <td>{{ $ag->nm_kegiatan }}</td>
                                                                <td>{{ $ag->tempat }}</td>
                                                                <td>{{ $ag->nm_opd }}</td>
                                                                <td>{{ $ag->nm_pejabat }}</td>
                                                                <td>{{ dateIndonesia($ag->tgl) }}</td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="5"></td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>  --}}
                                                <div class="table-container">
                                                    <table class="table">
                                                        {{--  <h3 class="text-center">Tabel Responsive 1</h3>
                                                        <caption>Tabel responsive dengan container</caption>  --}}
                                                        <thead>
                                                            <tr>
                                                                <th>Nama Kegiatan</th>
                                                                <th>Tempat</th>
                                                                <th>PJ</th>
                                                                <th>Pejabat</th>
                                                                <th>Tanggal</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($pejabat as $ag)
                                                                <tr>
                                                                    <td>{{ $ag->nm_kegiatan }}</td>
                                                                    <td>{{ $ag->tempat }}</td>
                                                                    <td>{{ $ag->nm_opd }}</td>
                                                                    <td>{{ $ag->nm_pejabat }}</td>
                                                                    <td>{{ dateIndonesia($ag->tgl) }}</td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="5">Tidak ada agenda</td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    {{ $pejabat->links() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end container -->
        </section>
        <!-- end wpo-contact-pg-section -->
    @endsection
