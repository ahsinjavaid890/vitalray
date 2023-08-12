@extends('frontend.layouts.front-app-home')
@section('meta-tags')
<title>Vital Ray</title>
@endsection
@section('content')
<div class="container">
    @if(Auth::check())
    <a class="btn btn-primary"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
    @else
    <a class="btn btn-primary" href="{{ url('signin') }}">Sign In</a>
    <a class="btn btn-primary" href="{{ url('signup') }}">Sign Up</a>
    @endif
    @foreach(DB::table('dynamicpages')->where('visible_status' , 'Published')->get() as $r)
    <a class="btn btn-primary" href="{{ url('page') }}/{{ $r->slug }}">{{ $r->name }}</a>
    @endforeach
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<div class="container">
    @if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        </button>
    </div>
    @endif
    @if (Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ Session::get('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        </button>
    </div>
    @endif
</div>


<section class="mt-3">
    <div style="background: #386bc0;border-radius:10px" class="container  p-4">
        <div class="row">
            <div class="col-6">
                <h3 class="head">Information</h3>
                <form role="form" action="{{ url('/stripepayment') }}" method="post" class="require-validation"
                    data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="">Name</label>
                            <input type="text" onkeyup="copyname(this.value)" name="name" required class="form-control"
                                placeholder="">
                        </div>
                        <div class="col">
                            <label for="">Email</label>
                            <input type="email" onkeyup="copyemail(this.value)" name="email" required
                                class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="">Phone Number</label>
                            <input type="text" onkeyup="copyphone(this.value)" name="phonenumber" required
                                class="form-control" placeholder="">
                        </div>
                        <div class="col">
                            <label for="">Zipcode</label>
                            <input type="text" onkeyup="copyzipcode(this.value)" name="zipcode" required
                                class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="">State</label>
                            <input type="text" onkeyup="copystate(this.value)" name="state" required
                                class="form-control" placeholder="">
                        </div>
                        <div class="col">
                            <label for="">City</label>
                            <input type="text" name="city" onkeyup="copycity(this.value)" required class="form-control"
                                placeholder="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="">Address</label>
                            <textarea name="address" onkeyup="copyaddress(this.value)" class="form-control" cols="30"
                                rows="3"></textarea>

                        </div>

                    </div>

            </div>
            @php
            $url = request()->segment(count(request()->segments()));
            $product = DB::table('products')->where('url',$url)->first();
            @endphp
            <div class="col-6">
                <div class="row px-3 ">

                    <h3 class="head">Payment Information</h3>

                    <div class='form-row row'>
                        <div class='col-xs-12 form-group required'>
                            <label class='control-label'>Name on Card</label> <input class='form-control' size='4'
                                type='text'>
                        </div>
                    </div>

                    <div class='form-row row'>
                        <div class='col-xs-12 form-group  required'>
                            <label class='control-label'>Card Number</label> <input autocomplete='off'
                                class='form-control card-number' maxlength="16" required type='text'>
                        </div>
                    </div>

                    <div class='form-row row'>
                        <div class='col-xs-12 col-md-4 form-group cvc required'>
                            <label class='control-label'>CVC</label> <input required autocomplete='off'
                                class='form-control card-cvc' placeholder='ex. 311' maxlength="4" size='4' type='text'>
                        </div>
                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                            <label class='control-label'>Expiration Month</label> <input
                                class='form-control card-expiry-month' required placeholder='MM' maxlength="2" size='2'
                                type='text'>
                        </div>
                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                            <label class='control-label'>Expiration Year</label> <input
                                class='form-control card-expiry-year' required placeholder='YYYY' maxlength="4" size='4'
                                type='text'>
                        </div>
                    </div>

                    <div class='form-row row'>
                        <div class='col-md-12 error form-group mt-2 d-none'>
                            <div class='alert-danger alert'>Please correct the errors and try
                                again.</div>
                        </div>
                    </div>


                    <div class="bill-box ">
                        {{-- <ul class=" billing">
                            <li class="heading-with-action ">
                                <p class="">{{ $product->name }}
                                </p>
                            </li>
                            <li class="heading-with-action grand-total cart-total">
                                <strong class="total-bill">Total Price</strong>
                                <strong class="total-price">Rs: {{ $product->price }}</strong>
                            </li>
                        </ul> --}}
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <input type="hidden" name="price" value="{{$product->price}}">
                        <button type="submit" style="font-size: 18px" class="btn-block mt-4 btn btn-warning text-white"> Pay With
                            Credit Card</button>
                    </div>
                    
                    </form>
                    <h4 class="my-2 text-center">OR</h4>

                    <form action="{{route('data')}}" method="post">
                        @csrf
                        <input type="hidden" required id="name_hidden" name="name">
                        <input type="hidden" required id="email_hidden" name="email">
                        <input type="hidden" required id="phonenumber_hidden" name="phonenumber">
                        <input type="hidden" required id="zipcode_hidden" name="zipcode">
                        <input type="hidden" required id="city_hidden" name="city">
                        <input type="hidden" required id="state_hidden" name="state">
                        <input type="hidden" required id="address_hidden" name="address">
                        <input type="hidden" required name="product_id" value="{{$product->id}}">
                        <input type="hidden" required name="price" value="{{$product->price}}">

                        <button type="submit" style="font-size: 18px" class=" btn-block btn btn-info text-white">
                            Pay With
                            Paypal</button>

                    </form>

                    @include('frontend.layouts.include.googlepay')


                </div>
            </div>


        </div>
    </div>
</section>


<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
    function copyname(value) {
        $('#name_hidden').val(value);
    }
    function copyemail(value) {
        $('#email_hidden').val(value);
    }
    function copyphone(value) {
        $('#phonenumber_hidden').val(value);
    }
    function copyzipcode(value) {
        $('#zipcode_hidden').val(value);
    }
    function copycity(value) {
        $('#city_hidden').val(value);
    }
    function copystate(value) {
        $('#state_hidden').val(value);
    }
    function copyaddress(value) {
        $('#address_hidden').val(value);
    }
</script>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
    $(function() {
  
    /*------------------------------------------
    --------------------------------------------
    Stripe Payment Code
    --------------------------------------------
    --------------------------------------------*/
    
    var $form = $(".require-validation");
     
    $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid = true;
        $errorMessage.addClass('d-none');
    
        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
          var $input = $(el);
          if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('d-none');
            e.preventDefault();
          }
        });
     
        if (!$form.data('cc-on-file')) {
          e.preventDefault();
          Stripe.setPublishableKey($form.data('stripe-publishable-key'));
          Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
          }, stripeResponseHandler);
        }
    
    });
      
    /*------------------------------------------
    --------------------------------------------
    Stripe Response Handler
    --------------------------------------------
    --------------------------------------------*/
    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('d-none')
                .find('.alert')
                .text(response.error.message);
        } else {
            /* token contains id, last4, and card type */
            var token = response['id'];
                 
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }
     
});
</script>




@endsection