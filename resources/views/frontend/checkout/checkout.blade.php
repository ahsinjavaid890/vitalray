@extends('frontend.layouts.front-app-home')
@section('meta-tags')
<title>Product Checkout</title>
@endsection
@section('content')
@php
$url = request()->segment(count(request()->segments()));
$product = DB::table('products')->where('url',$url)->first();
@endphp
<style type="text/css">
    #card-element{
      padding: 10px;
      border: 1px solid #fff;
      background-color: transparent;
      border-radius: 3px;
      height: 40px;
    }
    .hideallforms{
        display: none;
    }
    .activepayementbutton{
        background: linear-gradient(90deg, #4192DD 0%, #B45DE6 100%) !important;
    }
    .h-lg{
        font-size: 15px !important;
    }
    .btn-default{
        padding: 12px 0px !important;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>

<section class="h-100 gradient-form background-radial-gradient overflow-hidden">
  <div class="container py-4">
    <div class="row">
      <div class="col-md-7">
        <div class="card rounded-5 text-black">
          <div class="row g-0">
            <div class="col-lg-12 login-left-section">
              <div class="card-body p-md-5 mx-md-4">
                <div class="text-left">
                  <h4 class="mt-1 mb-1 pb-1">Product Checkout</h4>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <button onclick="showcreditcardpay()" id="creditcard" class="activepayementbutton payementbuttons btn btn-default text-white h-lg d-flex align-items-center justify-content-center">
                                    <img src="{{ asset('public/front/media/master-card.png')}}" class="me-2">Credit/Debit Card
                                </button>
                            </div>
                            <div class="col-md-4">
                                <button onclick="showgooglepay()" id="googlepay" class="payementbuttons btn btn-default text-white h-lg d-flex align-items-center justify-content-center">
                                    <img src="{{ asset('public/front/media/google.png')}}" class="me-2">Google
                                </button>
                            </div>
                            <div class="col-md-4">
                                <button onclick="showpaypalpay()" id="paypalpay" class="payementbuttons btn btn-default text-white h-lg d-flex align-items-center justify-content-center">
                                    <img src="{{ asset('public/front/media/Paypal.png')}}" class="me-2">Paypal
                                </button>
                            </div>
                        </div>
                        <script type="text/javascript">
                          function showcreditcardpay() {
                              $('.payementbuttons').removeClass('activepayementbutton');
                              $('#creditcard').addClass('activepayementbutton');
                              $('.googlepaydiv').hide();
                              $('.paypalpaydiv').hide();
                              $('.cardpaydiv').show();
                          }
                          function showgooglepay() {
                              $('.payementbuttons').removeClass('activepayementbutton');
                              $('#googlepay').addClass('activepayementbutton');
                              $('.paypalpaydiv').hide();
                              $('.cardpaydiv').hide();
                              $('.googlepaydiv').show();
                          }
                          function showpaypalpay() {
                              $('.payementbuttons').removeClass('activepayementbutton');
                              $('#paypalpay').addClass('activepayementbutton');

                              $('.cardpaydiv').hide();
                              $('.googlepaydiv').hide();
                              $('.paypalpaydiv').show();
                          }
                        </script>
                        <div class="googlepaydiv hideallforms mt-5 mb-5">
                            @include('frontend.layouts.include.googlepay')
                        </div>
                        <div class="paypalpaydiv hideallforms mt-5 mb-5">
                            <a style="height: 40px;" href="{{ url('paypalpayement') }}/{{$product->id}}" class="btn btn-default mt-4 d-flex align-items-center justify-content-center">Pay ${{ number_format($product->price+4, 2) }} from Paypal</a>
                        </div>
                        <form role="form" action="{{ url('stripepayment') }}" method="post" class="require-validation cardpaydiv" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                         @csrf
                        <div class="row mt-5">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-outline form-black mb-4">
                                            <input required type="text" name="name" class="form-control form-control-lg" value="">
                                            <label class="form-label">Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-outline form-black mb-4">
                                            <input required type="text" name="email" class="form-control form-control-lg" value="">
                                            <label class="form-label">Email</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-outline form-black mb-4">
                                            <input required type="text" name="phonenumber" class="form-control form-control-lg" value="">
                                            <label class="form-label">Phone Number</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-outline form-black mb-4">
                                            <input required type="text" name="zipcode" class="form-control form-control-lg" value="">
                                            <label class="form-label">Zipcode</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-outline form-black mb-4">
                                            <input required type="text" name="state" class="form-control form-control-lg" value="">
                                            <label class="form-label">State</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-outline form-black mb-4">
                                            <input required type="text" name="city" class="form-control form-control-lg" value="">
                                            <label class="form-label">City</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-outline form-black mb-4">
                                            <textarea required name="address" class="form-control form-control-lg"></textarea>
                                            <label class="form-label">Address</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-outline form-black mb-4">
                                            <input type="text" name="name_on_card" class="form-control form-control-lg" value="">
                                            <label class="form-label">Name on Card</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-outline form-black mb-4">
                                            <input autocomplete='off' id="cc" class='form-control card-number form-control-lg' size='20' type='text'>
                                            <label class="form-label">Card Number</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-outline form-black mb-4">
                                            <input id="cvv" autocomplete='off' class='form-control form-control-lg card-cvc' placeholder='ex. 311' maxlength="4" type='text'>
                                            <label class="form-label">CVC</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-outline form-black mb-4">
                                            <input class='form-control form-control-lg card-expiry-month' maxlength="2" id="month" placeholder='MM' size='2' type='text'>
                                            <label class="form-label">Expiration Month</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-outline form-black mb-4">
                                            <input class='form-control form-control-lg card-expiry-year' maxlength="4" id="year" placeholder='YYYY' size='4' type='text'>
                                            <label class="form-label">Expiration Year</label>
                                        </div>
                                    </div>
                                </div>                 
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-lg-6 text-right">
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <input type="hidden" name="price" value="{{$product->price}}">
                                    <button type="submit" class="btn primary-button btn-block form-control">Complete Purchase</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="card rounded-5 text-black">
          <div class="row g-0">
            <div class="col-lg-12 login-left-section">
              <div class="card-body p-md-5 mx-md-4">
                <div class="text-left">
                  <h4 class="mt-1 mb-1 pb-1">Product Information</h4>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p>Product Name</p>
                            </div>
                            <div>
                                <p>{{ $product->name }}</p>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <div>
                                <p>Plateform Free</p>
                            </div>
                            <div>
                                <p>${{number_format(4, 2)}}</p>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <div>
                                <p>Total</p>
                            </div>
                            <div>
                                <p>${{ number_format($product->price+4, 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript" src="{{ asset('public/front/assets/payement.js') }}"></script>
@endsection