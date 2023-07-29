@extends('frontend.layouts.front-app')
@section('content')
@include('admin.alerts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
<style type="text/css">
    .hide{
        display: none;
    }
</style>
<div class="container">
    @include('frontend.user.profileheader')
    <div class="row">
    	
    	<div class="col-lg-12 widget-block widget-break-lg">
            <div class="widget widget-user-about">
                <div class="widget-heading">
                    <h3 class="widget-title">Plan : {{ $plan->name }}</h3>
                </div>
                <div class="user-info">
                    <div class="block-box">
                                
                                <form
                                        role="form"
                                        action="{{ route('stripe.post') }}"
                                        method="post"
                                        class="require-validation"
                                        data-cc-on-file="false"
                                        data-stripe-publishable-key="{{Cmf::get_site_settings_by_colum_name('published_stripe')}}"
                                        id="payment-form">
                                        @csrf
                                        
                                        <input type="hidden" value="{{ $plan->id }}" name="planid">
                                        <input type="hidden" value="upgradeplan" name="page">
                                        <div class="form-group">
                                          <label >Card Number</label> 
                                          <input autocomplete='off' id="cc" class='form-control card-number' size='20' type='text'>
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
                                       <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Pay ${{ $plan->price }}</button>
                                        </div>
                                     </form>
                                     <div class="row">
                                         <div class="col-md-12">
                                             <h2 style="text-align: center;">OR</h2>
                                         </div>
                                     </div>
                                     <br>
                                     <form class="form-horizontal" method="POST" id="payment-form" role="form" action="{!! URL::route('paypal') !!}" >
                                        {{ csrf_field() }}

                              
                                        <input type="hidden" value="{{ $plan->id }}" name="planid">

                                
                                        
                                        <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-block">
                                                    Pay with Paypal
                                                </button>
                                        </div>
                                    </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript" src="{{ asset('public/front/assets/js/checkout.js') }}"></script>
@endsection