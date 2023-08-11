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
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ Session::get('success') }}
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
                            <input type="text" name="name" required class="form-control" placeholder="Name">
                        </div>
                        <div class="col">
                            <label for="">Email</label>
                            <input type="email" name="email" required class="form-control" placeholder="demo@gmail.com">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="">Address</label>
                            <input type="text" name="address" required class="form-control" placeholder="Address">
                        </div>

                    </div>
                    <hr>
                    <div>

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
                                    class='form-control card-cvc' placeholder='ex. 311' maxlength="4" size='4'
                                    type='text'>
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

                    </div>
            </div>
            @php
            $url = request()->segment(count(request()->segments()));
            $product = DB::table('products')->where('url',$url)->first();
            @endphp
            <div class="col-6">
                <div class="row px-3 ">
                    <h3 class="head">Billing</h3>
                    <div class="bill-box ">
                        <ul class=" billing">
                            <li class="heading-with-action ">
                                <p class="">{{ $product->name }}
                                </p>
                            </li>
                            <li class="heading-with-action grand-total cart-total">
                                <strong class="total-bill">Total Price</strong>
                                <strong class="total-price">Rs: {{ $product->price }}</strong>
                            </li>
                        </ul>
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <input type="hidden" name="price" value="{{$product->price}}">
                    </div>
                    <button type="submit" class="mt-4 btn btn-warning text-dark"> Pay With Strip</button>
                    <h4 class="my-4 text-center">OR</h4>
                </div>
            </div>
            </form>

        </div>
    </div>
</section>



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