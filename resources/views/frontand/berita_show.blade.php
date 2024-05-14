@extends('layouts.frontand.app')
@section('content')
    <!-- Detail Start -->
    <!-- start of breadcumb-section -->
    {{--  <div class="wpo-breadcumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="wpo-breadcumb-wrap">
                        <h2>Blog Single</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Blog</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>  --}}
    <!-- end of wpo-breadcumb-section-->
    <section class="wpo-blog-single-section section-padding">
        <div class="container">
            <div class="row">
                <div class="col col-lg-10 offset-lg-1 col-12">
                    <div class="wpo-blog-content">
                        <div class="post format-standard-image">
                            <div class="entry-media">
                                <img src="{{ asset('storage/berita/' . $post->image) }}" alt>
                            </div>
                            <div class="entry-meta">
                                <ul>
                                    <li><i class="fi flaticon-user"></i> By <b>{{ $post->operator }}</b> </li>
                                    {{--  <li><i class="fi flaticon-comment-white-oval-bubble"></i> Comments 35 </li>  --}}
                                    <li><i class="fi flaticon-calendar"></i> {{ $post->created_at->diffForHumans() }}</li>
                                </ul>
                            </div>
                            <h2>{{ $post->title }}</h2>
                            <p>{!! $post->content !!}</p>
                        </div>

                        <div class="more-posts">
                            <div class="previous-post">
                                @if ($previous)
                                    <a href="{{ URL::to('berita/' . $previous . '/' . Str::slug($post_previous->title)) }}">
                                        <span class="post-control-link">Previous Post</span>
                                        <span class="post-name">{{ $post_previous->title }}</span>
                                    </a>
                                @endif
                            </div>
                            <div class="next-post">
                                @if ($next)
                                    <a href="{{ URL::to('berita/' . $next . '/' . Str::slug($post_next->title)) }}">
                                        <span class="post-control-link">Next Post</span>
                                        <span class="post-name">{{ $post_next->title }}</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end container -->
    </section>
    <!-- Detail End -->
@endsection
