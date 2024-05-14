@extends('layouts.frontand.app')
@section('content')
    <!-- start page-wrapper -->
    <br>
    <div class="page-wrapper">
        <!-- start of wpo-blog-hero -->
        <div class="wpo-blog-hero-area">
            <div class="container">
                <div class="sortable-gallery">
                    <div class="gallery-filters"></div>
                    <div class="row template">
                        <div class="item satu">
                            <div class="wpo-blog-content-new">
                                <h1><a
                                        href="{{ url('berita/' . $posts[0]->id . '/' . Str::slug($posts[0]->title)) }}">{{ $posts[0]->title }}</a>
                                </h1>
                                <ul>
                                    <li>By <b>{{ ucwords($posts[0]->operator) }}</b>
                                    </li>
                                    <li>{{ $posts[0]->created_at->diffForHumans() }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="item dua">
                            <div class="wpo-blog-content-new">
                                <h2><a
                                        href="{{ url('berita/' . $posts[1]->id . '/' . Str::slug($posts[1]->title)) }}">{{ $posts[1]->title }}</a>
                                </h2>
                                <ul>
                                    <li>By <b>{{ ucwords($posts[1]->operator) }}</b>
                                    </li>
                                    <li>{{ $posts[1]->created_at->diffForHumans() }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="item tiga">
                            <div class="wpo-blog-content-new">
                                <h2><a
                                        href="{{ url('berita/' . $posts[2]->id . '/' . Str::slug($posts[2]->title)) }}">{{ $posts[2]->title }}</a>
                                </h2>
                                <ul>
                                    <li>By <b>{{ ucwords($posts[2]->operator) }}</b>
                                    </li>
                                    <li>{{ $posts[2]->created_at->diffForHumans() }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    {{--  <div class="row">
                        <div class="col-lg-12">
                            <div class="wpo-blog-grids gallery-container clearfix">
                                <div class="grid">
                                    <div class="img-holder">
                                        <img src="{{ asset('storage/berita/' . $posts[0]->image) }}" alt
                                            class="img img-responsive"
                                            style="min-height: 600px; min-width:800px; overflow: hidden;">
                                        <div class="wpo-blog-content">
                                            <h2><a
                                                    href="{{ url('berita/' . $posts[0]->id . '/' . Str::slug($posts[0]->title)) }}">{{ $posts[0]->title }}</a>
                                            </h2>
                                            <p>{!! Str::limit($posts[0]->content, 100) !!}</p>
                                            <ul>
                                                <li>By <b>{{ ucwords($posts[0]->operator) }}</b>
                                                </li>
                                                <li>{{ $posts[0]->created_at->diffForHumans() }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid">
                                    <div class="img-holder">
                                        <img src="{{ asset('storage/berita/' . $posts[1]->image) }}" alt
                                            class="img img-responsive" style="max-height: 100%">
                                        <div class="wpo-blog-content">
                                            <h2><a
                                                    href="{{ url('berita/' . $posts[1]->id . '/' . Str::slug($posts[1]->title)) }}">{{ $posts[1]->title }}</a>
                                            </h2>
                                            <ul>
                                                <li>By <b>{{ ucwords($posts[1]->operator) }}</b>
                                                </li>
                                                <li>{{ $posts[1]->created_at->diffForHumans() }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid s2">
                                    <div class="img-holder">
                                        <img src="{{ asset('storage/berita/' . $posts[2]->image) }}" alt
                                            class="img img-responsive" style="max-height: 100%;">
                                        <div class="wpo-blog-content">
                                            <h2><a
                                                    href="{{ url('berita/' . $posts[2]->id . '/' . Str::slug($posts[2]->title)) }}">{{ $posts[2]->title }}</a>
                                            </h2>
                                            <ul>
                                                <li>By <b>{{ ucwords($posts[2]->operator) }}</b>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="img-holder">
                                        <img src="{{ asset('storage/berita/' . $posts[3]->image) }}" alt
                                            class="img img-responsive" style="height: 100%;">
                                        <div class="wpo-blog-content">
                                            <h2><a
                                                    href="{{ url('berita/' . $posts[3]->id . '/' . Str::slug($posts[3]->title)) }}">{{ $posts[3]->title }}?</a>
                                            </h2>
                                            <ul>
                                                <li>By <b>{{ ucwords($posts[3]->operator) }}</b>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  --}}
                </div>

            </div>
        </div>
        <!-- end of wpo-blog-hero -->
        <!-- start wpo-blog-sponsored-section -->
        <section class="wpo-blog-sponsored-section section-padding">
            <div class="container">
                <div class="wpo-section-title">
                    <h2>Berita Lainnya</h2>
                </div>
                <div class="row">
                    <div class="wpo-blog-sponsored-wrap">
                        <div class="wpo-blog-items">
                            <div class="row">
                                @forelse ($posts->skip(4) as $post)
                                    <div class="col col-xl-3 col-lg-6 col-md-6 col-12">
                                        <div class="wpo-blog-item">
                                            <div class="wpo-blog-img"
                                                style="height: 170px; overflow: hidden; margin: 0px; position: relative;">
                                                <img src="{{ asset('storage/berita/' . $post->image) }}" alt=""
                                                    style=" position: absolute; left: -1000%; right: -1000%; top: -1000%; bottom: -1000%; margin: auto; min-height: 100%; min-width: 100%;">
                                                {{--  <div class="thumb">Travel</div>  --}}
                                            </div>
                                            <div class="wpo-blog-content">
                                                <h2><a
                                                        href="{{ url('berita/' . $post->id . '/' . Str::slug($post->title)) }}">{{ $post->title }}</a>
                                                </h2>
                                                <ul style="display: none">
                                                    {{--  <li><img src="{{ asset('frontend/images/blog/blog-avater/img-1.jpg') }}"
                                                            alt=""></li>  --}}
                                                    <li>By <b>{{ ucwords($post->operator) }}</b></li>
                                                    {{--  <li>{{ $post->created_at->diffForHumans() }}</li>  --}}
                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <a href="/berita" class="btn btn-outline-primary">
                        Lihat berita lainnya
                    </a>
                </div>
            </div> <!-- end container -->
        </section>
        <!-- end wpo-blog-sponsored-section -->

    </div>
@endsection
