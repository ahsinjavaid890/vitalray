@extends('auth.authlayout')
@section('title')
<title>Sign Up | Payement</title>
@endsection
@section('content')
<style type="text/css">
    .paypal-buy-now-button {
  display: inline-flex;
    position: relative;
    background: #FFC439;
    border-radius: 5px;
    border: 1px solid #DC911D;
    box-shadow: inset 0 1px 0 0 #ffd699;
    font-family: 'Helvetica Neue', Arial, sans-serif;
    font-weight: 700;
    font-size: 25px;
    padding: 0 23px;
    height: 42px;
    width: 100%;
    justify-content: center;
    align-items: center;
    color: #df5965;
    text-decoration: none;
    cursor: pointer;
}

.paypal-buy-now-button span {
    padding-top: 3px;
    padding-right: 7px;
    text-shadow: 0 1px 0 #FFD699;
    z-index: 2;
  }

svg {
    filter: drop-shadow(0 1px 0 #FFFFFF);
    z-index: 2;
  }
</style>
<!-- <div id="preloader"></div> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
<div id="wrapper" class="wrapper overflow-hidden">
    <div class="login-page-wrap">
    <div class="content-wrap">
        <div class="login-content">
            <div class="item-logo">
                <a href="{{ url('') }}"><img src="{{ asset('public/images/') }}/{{ Cmf::get_store_value('footer_logo') }}" alt="logo" width="220px"></a>
            </div>
            <div class="login-form-wrap">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link"  href="{{ url('signin') }}"><i class="icofont-users-alt-4"></i> Sign In </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link active"  href="{{ url('signup') }}"><i class="icofont-download"></i> Registration</a>
                    </li>
                </ul>
                
                <div class="tab-content">
                    <h3 class="item-title">Sign Up Your Account</h3>
                    <p></p>
                    <h5>Payement</h5>
                    <div class="row">
                         <div class="col-md-12">
                            <a onclick="submitpaypalform()" href="javascript:void(0)" class="paypal-buy-now-button">
                           <span>Pay with</span> 
                           <svg aria-label="PayPal" xmlns="http://www.w3.org/2000/svg" width="90" height="33" viewBox="34.417 0 90 33">
                              <path fill="#253B80" d="M46.211 6.749h-6.839a.95.95 0 0 0-.939.802l-2.766 17.537a.57.57 0 0 0 .564.658h3.265a.95.95 0 0 0 .939-.803l.746-4.73a.95.95 0 0 1 .938-.803h2.165c4.505 0 7.105-2.18 7.784-6.5.306-1.89.013-3.375-.872-4.415-.972-1.142-2.696-1.746-4.985-1.746zM47 13.154c-.374 2.454-2.249 2.454-4.062 2.454h-1.032l.724-4.583a.57.57 0 0 1 .563-.481h.473c1.235 0 2.4 0 3.002.704.359.42.469 1.044.332 1.906zM66.654 13.075h-3.275a.57.57 0 0 0-.563.481l-.146.916-.229-.332c-.709-1.029-2.29-1.373-3.868-1.373-3.619 0-6.71 2.741-7.312 6.586-.313 1.918.132 3.752 1.22 5.03.998 1.177 2.426 1.666 4.125 1.666 2.916 0 4.533-1.875 4.533-1.875l-.146.91a.57.57 0 0 0 .562.66h2.95a.95.95 0 0 0 .939-.804l1.77-11.208a.566.566 0 0 0-.56-.657zm-4.565 6.374c-.316 1.871-1.801 3.127-3.695 3.127-.951 0-1.711-.305-2.199-.883-.484-.574-.668-1.392-.514-2.301.295-1.855 1.805-3.152 3.67-3.152.93 0 1.686.309 2.184.892.499.589.697 1.411.554 2.317zM84.096 13.075h-3.291a.955.955 0 0 0-.787.417l-4.539 6.686-1.924-6.425a.953.953 0 0 0-.912-.678H69.41a.57.57 0 0 0-.541.754l3.625 10.638-3.408 4.811a.57.57 0 0 0 .465.9h3.287a.949.949 0 0 0 .781-.408l10.946-15.8a.57.57 0 0 0-.469-.895z"></path>
                              <path fill="#179BD7" d="M94.992 6.749h-6.84a.95.95 0 0 0-.938.802l-2.767 17.537a.57.57 0 0 0 .563.658h3.51a.665.665 0 0 0 .656-.563l.785-4.971a.95.95 0 0 1 .938-.803h2.164c4.506 0 7.105-2.18 7.785-6.5.307-1.89.012-3.375-.873-4.415-.971-1.141-2.694-1.745-4.983-1.745zm.789 6.405c-.373 2.454-2.248 2.454-4.063 2.454h-1.031l.726-4.583a.567.567 0 0 1 .562-.481h.474c1.233 0 2.399 0 3.002.704.358.42.467 1.044.33 1.906zM115.434 13.075h-3.272a.566.566 0 0 0-.562.481l-.146.916-.229-.332c-.709-1.029-2.289-1.373-3.867-1.373-3.619 0-6.709 2.741-7.312 6.586-.312 1.918.131 3.752 1.22 5.03 1 1.177 2.426 1.666 4.125 1.666 2.916 0 4.532-1.875 4.532-1.875l-.146.91a.57.57 0 0 0 .563.66h2.949a.95.95 0 0 0 .938-.804l1.771-11.208a.57.57 0 0 0-.564-.657zm-4.565 6.374c-.314 1.871-1.801 3.127-3.695 3.127-.949 0-1.711-.305-2.199-.883-.483-.574-.666-1.392-.514-2.301.297-1.855 1.805-3.152 3.67-3.152.93 0 1.686.309 2.184.892.501.589.699 1.411.554 2.317zM119.295 7.23l-2.807 17.858a.569.569 0 0 0 .562.658h2.822c.469 0 .866-.34.938-.803l2.769-17.536a.57.57 0 0 0-.562-.659h-3.16a.571.571 0 0 0-.562.482z"></path>
                           </svg>
                        </a>
                         </div>
                    </div>

                    <div style="margin-top: 50px;" class="row">
                        <div class="col-md-12 text-center">
                            <h3>OR</h3>
                        </div>
                    </div>
                    <script type="text/javascript">
                        function submitpaypalform()
                        {
                            $('#paypalform').submit();
                        }
                    </script>
                    <form method="POST" id="paypalform" action="{{ url('paypal') }}">
                        @csrf
                        <input type="hidden" value="{{ $selectedplan }}" name="planid">

                    </form>

                    <form role="form"
                                        action="{{ route('stripe.post') }}"
                                        method="post"
                                        class="require-validation"
                                        data-cc-on-file="false"
                                        data-stripe-publishable-key="{{Cmf::get_site_settings_by_colum_name('published_stripe')}}"
                                        id="payment-form">
                     @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class='form-row row'>
                               <div class='col-md-12 form-group required'>
                                    <label class='control-label'>Zip Code</label> 
                                    <input class='form-control' name="zip_code" type='text'>
                               </div>
                            </div>
                            <div class='form-row row'>
                               <div class='col-md-12 form-group required'>
                                  <label class='control-label'>Complete Address</label> 
                                  <input class='form-control' name="address" type='text'>
                               </div>
                            </div>
                            <div class='form-row row'>
                               <div class='col-md-12 form-group required'>
                                  <label class='control-label'>Name on Card</label> <input
                                     class='form-control' size='4' type='text'>
                               </div>
                            </div>
                            <input type="hidden" value="{{ $selectedplan }}" name="planid">
                            <div class='form-row row'>
                               <div class='col-md-12 form-group card required'>
                                  <label class='control-label'>Card Number</label> <input
                                     autocomplete='off' id="cc" class='form-control card-number' size='20'
                                     type='text'>
                               </div>
                            </div>
                            <div class='form-row row'>
                               <div class='col-xs-12 col-md-4 form-group cvc required'>
                                  <label class='control-label'>CVC</label> <input id="cvv" autocomplete='off'
                                     class='form-control card-cvc' placeholder='ex. 311' maxlength="4"
                                     type='text'>
                               </div>
                               <div class='col-xs-12 col-md-4 form-group expiration required'>
                                  <label class='control-label'>Expiration Month</label> <input
                                     class='form-control card-expiry-month' maxlength="2" id="month" placeholder='MM' size='2'
                                     type='text'>
                               </div>
                               <div class='col-xs-12 col-md-4 form-group expiration required'>
                                  <label class='control-label'>Expiration Year</label> <input
                                     class='form-control card-expiry-year' maxlength="4" id="year" placeholder='YYYY' size='4'
                                     type='text'>
                               </div>
                            </div>
                            <div class='form-row row'>
                               <div class='col-md-12 error form-group hide'>
                                  <div class='alert-danger alert'>Please correct the errors and try
                                     again.
                                  </div>
                               </div>
                            </div>
                      
                        </div>
                    </div>
                    <input type="hidden" name="selectedplan" id="planselect">
                        <div class="row">
                            <div class="col-lg-6 text-left">
                                <a style="text-align: center;" href="{{ route('user.stepthree') }}" class="btn btn-primary">Back</a>
                            </div>
                            <div class="col-lg-6 text-right">
                                <button id="submitbutton" type="submit" class="btn btn-primary">Next</button>
                            </div>
                        </div>
                    </form>
                        
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="map-line">
            <img src="{{ asset('public/front/media/banner/map_line2.png') }}" alt="map">
            <ul class="map-marker">
                <li><img src="{{ asset('public/front/media/banner/marker_1.png') }}" alt="marker"></li>
                <li><img src="{{ asset('public/front/media/banner/marker_2.png') }}" alt="marker"></li>
                <li><img src="{{ asset('public/front/media/banner/marker_3.png') }}" alt="marker"></li>
                <li><img src="{{ asset('public/front/media/banner/marker_4.png') }}" alt="marker"></li>
            </ul>
        </div>
    </div>
</div>
</div>
<style type="text/css">
    .selectedplan{
        background-color: #F88F96 !important;
    }
    .hide{
        display: none;
    }
</style>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript" src="{{ asset('public/front/assets/payement.js') }}"></script>
@endsection