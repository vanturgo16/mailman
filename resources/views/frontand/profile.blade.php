@extends('layouts.frontand.app')
@section('content')
    <div class="page-wrapper">
        <!-- start of breadcumb-section -->
        <div class="wpo-breadcumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="wpo-breadcumb-wrap">
                            <h2>Profil</h2>
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><span>Profil</span></li>
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
                                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-home" type="button" role="tab"
                                                aria-controls="pills-home" aria-selected="true">Sambutan</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-profile" type="button" role="tab"
                                                aria-controls="pills-profile" aria-selected="false">Visi & Misi</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-contact" type="button" role="tab"
                                                aria-controls="pills-contact" aria-selected="false">Sejarah Singkat</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                            aria-labelledby="pills-home-tab" tabindex="0">
                                            @isset($sambutan)
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <img src="{{ asset('storage/staff/' . $sambutan->foto) }}"
                                                            alt="Foto Ketua" style="max-width: 240px">
                                                    </div>
                                                    <div class="col-lg-9">
                                                        <h2>Sambutan {{ $sambutan->nm_kep }}</h2>
                                                        <hr>
                                                        {!! $sambutan->des !!}
                                                        <br><br>
                                                        {!! $sambutan->des1 !!}
                                                    </div>
                                                </div>
                                            @endisset
                                        </div>
                                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                            aria-labelledby="pills-profile-tab" tabindex="0">
                                            @isset($visi)
                                                <h2>Visi</h2>
                                                {!! $visi->visi !!}<br><br>
                                                <hr>
                                                <h2>Misi</h2>
                                                {!! $visi->misi !!}
                                            @endisset
                                        </div>
                                        <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                            aria-labelledby="pills-contact-tab" tabindex="0">
                                            @isset($sejarah)
                                                <h2>Sejarah Singkat</h2>
                                                <hr>
                                                {!! $sejarah->des !!}
                                            @endisset
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
