<header class="header">
    <div id="rt-sticky-placeholder"></div>
    <div id="header-menu" class="header-menu menu-layout1">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-2">
                    <div class="temp-logo">
                        <a href="{{ url('') }}"><img width="140px" src="{{ asset('public/images/') }}/{{ Cmf::get_store_value('footer_logo') }}" alt="Logo"></a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-7 col-sm-7 col-8 d-flex justify-content-xl-start justify-content-center">
                    <div class="mobile-nav-item hide-on-desktop-menu">
                        <div class="mobile-toggler">
                            <button type="button" class="mobile-menu-toggle">
                                <i class="icofont-navigation-menu"></i>
                            </button>
                        </div>
                        <div class="mobile-logo">
                            <a href="index.html">
                                <img src="{{ asset('public/front/media/logo.png')}}" alt="Logo" width="100px">
                            </a>
                        </div>
                    </div>
                    <nav id="dropdown" class="template-main-menu">
                        <button type="button" class="mobile-menu-toggle mobile-toggle-close">
                            <i class="icofont-close"></i>
                        </button>
                        <ul class="menu-content">
                            <li class="header-nav-item">
                                <a href="{{ url('') }}" class="menu-link active">Home</a>
                            </li>

                            <li class="header-nav-item">
                                <a href="{{ url('about-us') }}" class="menu-link active">About Us</a>
                            </li>

                            <li class="header-nav-item">
                                <a href="{{ url('blogs') }}" class="menu-link active">Blog</a>
                            </li>
                            
                            <li class="header-nav-item">
                                <a href="{{ url('contact-us') }}" class="menu-link">Contact Us</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-xl-4 col-lg-3 col-sm-5 col-4 d-flex justify-content-end">
                    <div class="header-action">
                        <ul>
                            <li class="header-social">
                                @if(Cmf::get_store_value('facebook'))
                                <a href="{{ Cmf::get_store_value('facebook') }}"><i class="icofont-facebook"></i></a>
                                @endif
                                @if(Cmf::get_store_value('twitter'))
                                <a href="{{ Cmf::get_store_value('twitter') }}"><i class="icofont-twitter"></i></a>
                                @endif
                                @if(Cmf::get_store_value('instagram'))
                                <a href="{{ Cmf::get_store_value('instagram') }}"><i class="icofont-instagram"></i></a>
                                @endif
                                @if(Cmf::get_store_value('youtube'))
                                <a href="{{ Cmf::get_store_value('youtube') }}"><i class="icofont-youtube"></i></a>
                                @endif

                            </li>
                            
                            <li class="login-btn">

                                @if(Auth::check())
                                <a href="{{ url('signin') }}" class="item-btn"><i class="fas fa-user"></i>My Profile</a>
                                @else
                                <a href="{{ url('signin') }}" class="item-btn"><i class="fas fa-user"></i>Sign In</a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>