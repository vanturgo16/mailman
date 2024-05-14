<!-- start preloader -->
<div class="preloader">
    <div class="angular-shape">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div class="spinner">
        <div class="double-bounce1"></div>
        <div class="double-bounce2"></div>
    </div>
</div>
<!-- end preloader -->
<!-- Start header -->
<header id="header" class="wpo-site-header">
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col col-lg-7 col-md-9 col-sm-12 col-12">
                    {{--  <div class="contact-intro">
                        <ul>
                            <li class="update"><span>New Update</span></li>
                            <li>Betting against meme stocks could get you seriously burned</li>
                        </ul>
                    </div>  --}}
                </div>
                <div class="col  col-lg-5 col-md-3 col-sm-12 col-12">
                    <div class="contact-info">
                        <ul>
                            <li><a href="{{ $profil_desa->fb }}" target="_blank"><i class="ti-facebook"></i></a></li>
                            <li><a href="{{ $profil_desa->tw }}" target="_blank"><i class="ti-twitter-alt"></i></a></li>
                            <li><a href="{{ $profil_desa->ig }}" target="_blank"><i class="ti-instagram"></i></a></li>
                            <li><a href="{{ $profil_desa->youtube }}" target="_blank"><i class="ti-youtube"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end topbar -->
    <nav class="navigation navbar navbar-expand-lg navbar-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-3 col-3 d-lg-none dl-block">
                    <div class="mobail-menu">
                        <button type="button" class="navbar-toggler open-btn">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar first-angle"></span>
                            <span class="icon-bar middle-angle"></span>
                            <span class="icon-bar last-angle"></span>
                        </button>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-6">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="{{ url('/') }}"><img
                                src="{{ asset('frontend/images/heading_si_agen_126.jpg') }}" alt="" width="170%"></a>
                        {{--  <h4 style="display: inline">SI-AGEN</h4>  --}}
                    </div>
                </div>
                <div class="col-lg-8 col-md-1 col-1">
                    <div id="navbar" class="collapse navbar-collapse navigation-holder">
                        <button class="menu-close"><i class="ti-close"></i></button>
                        <ul class="nav navbar-nav mb-2 mb-lg-0">
                            {{--  <li class="menu-item-has-children">
                                <a class="active" href="#">Home</a>
                                <ul class="sub-menu">
                                    <li><a class="active" href="index.html">Home style 1</a></li>
                                    <li><a href="index-2.html">Home style 2</a></li>
                                    <li><a href="index-3.html">Home style 3</a></li>
                                </ul>
                            </li>  --}}
                            {{--  <li class="menu-item-has-children">
                                <a href="#">Pages</a>
                                <ul class="sub-menu">
                                    <li><a href="blog.html">Archive</a></li>
                                    <li><a href="contact.html">Contact Us</a></li>
                                    <li><a href="shop.html">Shop</a></li>
                                    <li><a href="shop-single.html">Shop Single</a></li>
                                    <li><a href="cart.html">Cart</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="404.html">Error 404</a></li>
                                    <li><a href="login.html">Login</a></li>
                                    <li><a href="register.html">Register</a></li>
                                </ul>
                            </li>  --}}
                            <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#" class="{{ request()->is('galeri') || request()->is('galeriVideo') ? 'active' : '' }}">Galeri</a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('/galeri') }}">Photo</a></li>
                                    <li><a href="{{ url('/galeriVideo') }}">Video</a></li>
                                </ul>
                            </li>

                            <li><a href="{{ url('/profile') }}"
                                    class="{{ request()->is('profile') ? 'active' : '' }}">Profil</a></li>
                            <li><a href="{{ url('/agenda') }}"
                                    class="{{ request()->is('agenda') ? 'active' : '' }}">Agenda Pimpinan</a></li>
                            <li><a href="{{ url('/juknis') }}"
                                    class="{{ request()->is('juknis') ? 'active' : '' }}">Juknis</a></li>
                            <li><a href="{{ url('/kontak') }}"
                                    class="{{ request()->is('kontak') ? 'active' : '' }}">Kontak</a></li>
                            @auth
                                <li class="menu-item-has-children">
                                    <a href="#">Akun Saya</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <li><a href="route('logout')"
                                                    onclick="event.preventDefault();
                              this.closest('form').submit();">Logout</a>
                                            </li>
                                        </form>
                                    </ul>
                                </li>
                            @else
                                <li><a href="{{ url('/login') }}"
                                        class="{{ request()->is('login') ? 'active' : '' }}">Login</a></li>
                            @endauth

                            {{--  <li class="menu-item-has-children">
                                <a href="#">Post</a>
                                <ul class="sub-menu">
                                    <li><a href="blog.html">Post right sidebar</a></li>
                                    <li><a href="blog-left-sidebar.html">Post left sidebar</a></li>
                                    <li><a href="blog-fullwidth.html">Post fullwidth</a></li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Post details</a>
                                        <ul class="sub-menu">
                                            <li><a href="blog-single.html">Post details right sidebar</a></li>
                                            <li><a href="blog-single-left-sidebar.html">Post details left
                                                    sidebar</a></li>
                                            <li><a href="blog-single-fullwidth.html">Post details fullwidth</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>  --}}
                        </ul>
                    </div><!-- end of nav-collapse -->
                </div>
                <div class="col-lg-2 col-md-2 col-2">
                    <div class="header-right">
                        {{--  <div class="header-search-form-wrapper">
                            <div class="cart-search-contact">
                                <button class="search-toggle-btn"><i class="fi flaticon-magnifiying-glass"></i></button>
                                <div class="header-search-form">
                                    <form>
                                        <div>
                                            <input type="text" class="form-control" placeholder="Search here...">
                                            <button type="submit"><i
                                                    class="fi flaticon-magnifiying-glass"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>  --}}
                        {{--  <div class="header-right-menu-wrapper">
                            <div class="header-right-menu">
                                <div class="right-menu-toggle-btn">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                                <div class="header-right-menu-wrap">
                                    <button class="right-menu-close"><i class="ti-close"></i></button>
                                    <div class="logo"><img src="{{ asset('frontend/images/logo2.png') }}"
                                            alt=""></div>
                                    <div class="header-right-sec">
                                        <div class="project-widget widget">
                                            <h3>Our Latest News</h3>
                                            <div class="posts">
                                                <div class="post">
                                                    <div class="img-holder">
                                                        <img src="{{ asset('frontend/images/recent-posts/img-1.jpg') }}"
                                                            alt>
                                                    </div>
                                                    <div class="details">
                                                        <span class="date">19 Jun 2022 </span>
                                                        <h4><a href="blog-single.html">Perfect Photo Clicking
                                                                Idea You Must
                                                                Know.</a></h4>
                                                    </div>
                                                </div>
                                                <div class="post">
                                                    <div class="img-holder">
                                                        <img src="{{ asset('frontend/images/recent-posts/img-2.jpg') }}"
                                                            alt>
                                                    </div>
                                                    <div class="details">
                                                        <span class="date">22 May 2022 </span>
                                                        <h4><a href="blog-single.html">Best tourism site all
                                                                over the world.</a>
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="post">
                                                    <div class="img-holder">
                                                        <img src="{{ asset('frontend/images/recent-posts/img-3.jpg') }}"
                                                            alt>
                                                    </div>
                                                    <div class="details">
                                                        <span class="date">12 Apr 2022 </span>
                                                        <h4><a href="blog-single.html">Whats In Trend in Now
                                                                Woman Fashion.</a></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>  --}}
                    </div>
                </div>
            </div>
        </div><!-- end of container -->
    </nav>
</header>
<!-- end of header -->
