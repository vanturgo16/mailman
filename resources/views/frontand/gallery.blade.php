@extends('layouts.frontand.app')
@section('content')
    <div class="page-wrapper">
        <!-- start of breadcumb-section -->
        <div class="wpo-breadcumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="wpo-breadcumb-wrap">
                            <h2>Galeri</h2>
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><span>Galeri</span></li>
                                <li><span>Photo</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of wpo-breadcumb-section-->

        <!-- start wpo-contact-pg-section -->
        <div class="cart-area section-padding">
            <div class="container">
                <div class="form">
                    <div class="cart-wrapper">
                        <div class="row">
                            <div class="col-12">
                                <div class="row row-cols-1 row-cols-md-3 g-4">
                                    @foreach ($gallery as $g)
                                        <a target="_blank" href="{{ Storage::url('public/gallery/' . $g->image) }}">
                                            <div class="col">
                                                <div class="card h-100">
                                                    <img src="{{ Storage::url('public/gallery/' . $g->image) }}"
                                                        class="card-img-top" alt="..." width="20%">

                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            {{ $gallery->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end wpo-contact-pg-section -->
    @endsection
