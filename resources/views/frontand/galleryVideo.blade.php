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
                                <li><span>Video</span></li>
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
                                    @foreach ($videos as $g)
                                        <div class="card">
                                            {{--  <div class="card-header">  --}}
                                                <iframe height="200"
                                                    src="https://www.youtube.com/embed/{{ $g->video }}"
                                                    title="{{ $g->keterangan }}" frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen>
                                                </iframe>
                                            {{--  </div>  --}}
                                            {{--  <div class="card-body">  --}}
                                                <h5 align="center">{{ $g->keterangan }}</h5>
                                            {{--  </div>  --}}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            {{ $videos->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end wpo-contact-pg-section -->
    @endsection
