@extends('layouts.frontand.app')
@section('content')
    <!-- start of breadcumb-section -->
    <div class="wpo-breadcumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="wpo-breadcumb-wrap">
                        <h2>Berita</h2>
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><span>Berita</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end of wpo-breadcumb-section-->
    <!-- Blog Start -->
    <div class="container-fluid bg-light pt-5">
        <div class="container py-5">
            {{--  <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 col text-center mb-4">
                    <h6 class="text-primary font-weight-normal text-uppercase mb-3">Berita Desa</h6>
                    <h1 class="mb-4">Baca Berita & Artikel Terbaru Dari Blog Kami</h1>
                </div>
            </div>  --}}
            <div class="row pb-3">
                @forelse ($posts as $post)
                    <div class="col-md-4 mb-4">
                        <div class="card border-0 mb-2">
                            <a href="{{ url('berita/' . $post->id . '/' . Str::slug($post->title)) }}" style="text-decoration: none;">
                                <img class="card-img-top" src="{{ Storage::url('public/berita/' . $post->image) }}"
                                    alt="">
                                <div class="card-body bg-white p-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="m-0 ml-3">{{ $post->title }}</h4>
                                    </div>
                                    {{--  <p class="m-0 ml-3 text-truncate">
                                    {{ $post->content }}
                                </p>  --}}
                                    <p></p>
                                    <div class="d-flex">
                                        <small class="mr-3"><i class="fa fa-user text-primary"></i> {{ $post->operator }}
                                        </small>
                                        &emsp;
                                        <small class="mr-3"><i class="fa fa-clock text-primary"></i>
                                            {{ $post->updated_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                @empty
                    <p>Tidak Ada Berita!</p>
                @endforelse

            </div>
            <div style="text-align: center">
                {{ $posts->links('vendor.pagination.bootstrap-4') }}
            </div>


        </div>
    </div>
    <!-- Blog End -->
@endsection
