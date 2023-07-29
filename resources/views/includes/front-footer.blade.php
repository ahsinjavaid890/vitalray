<footer class="footer-wrap">
    <ul class="footer-top-image">
        <li data-sal="slide-up" data-sal-duration="500" data-sal-delay="400"><img src="{{ asset('public/front/media/figure/man_5.png')}}" alt="Man"></li>
        <li data-sal="slide-up" data-sal-duration="500" data-sal-delay="500"><img src="{{ asset('public/front/media/figure/man_6.png')}}" alt="Man"></li>
        <li data-sal="slide-up" data-sal-duration="500" data-sal-delay="300"><img src="{{ asset('public/front/media/figure/man_4.png')}}" alt="Man"></li>
        <li data-sal="slide-up" data-sal-duration="500" data-sal-delay="600"><img src="{{ asset('public/front/media/figure/man_7.png')}}" alt="Man"></li>
        <li data-sal="slide-up" data-sal-duration="500" data-sal-delay="200"><img src="{{ asset('public/front/media/figure/man_3.png')}}" alt="Man"></li>
        <li data-sal="slide-up" data-sal-duration="500" data-sal-delay="700"><img src="{{ asset('public/front/media/figure/man_8.png')}}" alt="Man"></li>
        <li data-sal="slide-up" data-sal-duration="500" data-sal-delay="100"><img src="{{ asset('public/front/media/figure/man_2.png')}}" alt="Man"></li>
        <li data-sal="slide-up" data-sal-duration="500" data-sal-delay="800"><img src="{{ asset('public/front/media/figure/man_9.png')}}" alt="Man"></li>
        <li data-sal="slide-up" data-sal-duration="500"><img src="{{ asset('public/front/media/figure/man_1.png')}}" alt="Man"></li>
    </ul>
    <div class="main-footer">
        <div class="container">
            <div class="row row-cols-lg-4 row-cols-sm-2 row-cols-1">
                <div class="col">
                    <div class="footer-box">
                        <div class="footer-logo">
                            <a href="{{ url('') }}"><img src="{{ asset('public/images/') }}/{{ Cmf::get_store_value('footer_logo') }}" alt="Logo"></a>
                        </div>
                        <p>Dorem ipsum dolor sit amet consec adipisicing elit sed do eiusmod por incidiut labore et loreLorem ipsum kelly amieo dolorey.</p>
                    </div>
                </div>
                <div class="col d-flex justify-content-lg-center">
                    <div class="footer-box">
                        <h3 class="footer-title">
                            Important Links
                        </h3>
                        <div class="footer-link">
                            <ul>
                                <li><a href="{{ url('') }}">Home</a></li>
                                <li><a href="{{ url('about-us') }}">About us</a></li>
                                <li><a href="{{ url('blogs') }}">Blog</a></li>
                                <li><a href="{{ url('contact-us') }}">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col d-flex justify-content-lg-center">
                    <div class="footer-box">
                        <h3 class="footer-title">
                            Other Links
                        </h3>
                        <div class="footer-link">
                            <ul>
                                <li><a href="{{ url('privacy-policy') }}">Privacy Policy</a></li>
                                <li><a href="{{ url('cookies-policy') }}">Cookie Policy</a></li>
                                <li><a href="{{ url('terms-and-conditions') }}">Terms and Conditions</a></li>
                                @foreach(DB::table('dynamicpages')->where('show_on_footer' , 'Yes')->where('visible_status' , 'Published')->where('delete_status' , 'Active')->get() as $r)
                                <li><a href="{{ url('page') }}/{{ $r->slug }}">{{ $r->name }}</a></li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col d-flex justify-content-lg-center">
                    <div class="footer-box">
                        <h3 class="footer-title">
                            Followers
                        </h3>
                        <div class="footer-link">
                            <ul>
                                @if(Cmf::get_store_value('facebook'))
                                <li><a href="{{ Cmf::get_store_value('facebook') }}">Facebook</a></li>
                                @endif
                                @if(Cmf::get_store_value('twitter'))
                                <li><a href="{{ Cmf::get_store_value('twitter') }}">Twitter</a></li>
                                @endif
                                @if(Cmf::get_store_value('instagram'))
                                <li><a href="{{ Cmf::get_store_value('instagram') }}">Instagram</a></li>
                                @endif
                                @if(Cmf::get_store_value('youtube'))
                                <li><a href="{{ Cmf::get_store_value('youtube') }}">Youtube</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="footer-copyright">Copy© BAEECAY 2021. All Rights Reserved</div>
    </div>
</footer>
<div id="header-search" class="header-search">
    <button type="button" class="close">×</button>
    <form class="header-search-form">
        <input type="search" value="" placeholder="Search here..." />
        <button type="submit" class="search-btn">
            <i class="flaticon-search"></i>
        </button>
    </form>
</div>