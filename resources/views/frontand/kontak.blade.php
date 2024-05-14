@extends('layouts.frontand.app')
@section('content')
    <div class="page-wrapper">
        <!-- start of breadcumb-section -->
        <div class="wpo-breadcumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="wpo-breadcumb-wrap">
                            <h2>Kontak Kami</h2>
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><span>Kontak</span></li>
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
                    <div class="col col-lg-10 offset-lg-1">
                        <div class="office-info">
                            <div class="row">
                                <div class="col col-xl-12 col-lg-12 col-md-12 col-12">
                                    <div class="office-info-item">
                                        <div class="office-info-icon">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/images/icon/home.svg') }}" alt="">
                                            </div>
                                        </div>
                                        <div class="office-info-text">
                                            <h2>Alamat</h2>
                                            <p>{{ $profil_desa->alamat }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col col-xl-6 col-lg-6 col-md-6 col-12">
                                    <div class="office-info-item">
                                        <div class="office-info-icon">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/images/icon/mail-2.svg') }}" alt="">
                                            </div>
                                        </div>
                                        <div class="office-info-text">
                                            <h2>Email</h2>
                                            <p>{{ $profil_desa->email }}</p>
                                            {{--  <p>helloyou@gmail.com</p>  --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-xl-6 col-lg-6 col-md-6 col-12">
                                    <div class="office-info-item">
                                        <div class="office-info-icon">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/images/icon/app.svg') }}" alt="">
                                            </div>
                                        </div>
                                        <div class="office-info-text">
                                            <h2>Telepon</h2>
                                            <p>{{ $profil_desa->tlpn }}</p>
                                            {{--  <p>+1 800 123 654 987</p>  --}}
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
