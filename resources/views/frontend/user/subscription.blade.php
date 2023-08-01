@extends('frontend.layouts.front-app-home')
@section('meta-tags')
<title>Subscription</title>
@endsection

@section('content')
@include('admin.alerts')
<style type="text/css">
    #card-element{
        color: #fff;
        padding: 10px;
        border:1px solid #F08089;
        background-color: transparent;
        border-radius: 4px;
        height: 50px;
    }
    .hideallforms{
        display: none !important;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    You will be charged ${{ number_format($plan->price, 2) }} for {{ $plan->name }} Plan<br>
                    Plateform Free {{number_format(4, 2)}}<br>
                    Total  = {{ number_format($plan->price+4, 2) }}
                </div>
                <div class="card-body">
                    <div class="row mb-5">
                        <div class="col-md-4">
                            <a  onclick="showform('cardpay')" class="btn btn-primary form-control" href="javascript:void(0)">Credit/Debit Card</a>
                        </div>
                        <div class="col-md-4">
                            <a  onclick="showform('paypalpay')" class="btn btn-success form-control" href="javascript:void(0)">Paypal</a>
                        </div>
                        <div class="col-md-4">
                            <a  onclick="showform('googlepay')" class="btn btn-warning form-control" href="javascript:void(0)">Google Pay</a>
                        </div>
                    </div>

                    <div class="hideallforms googlepay">
                        <h5>Pay With Google Pay</h5>
                    </div>
                    <div class="hideallforms paypalpay">
                        <h5>Pay With Google Paypal</h5>
                        <a href="{{ url('paypalpayement') }}/{{$plan->id}}" class="btn btn-success form-control">Pay ${{ number_format($plan->price+4, 2) }} from Paypal</a>
                    </div>
                    <form id="payment-form" class="cardpay" action="{{ route('subscription.create') }}" method="POST">
                        @csrf
                        <input type="hidden" name="plan" id="plan" value="{{ $plan->id }}">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="name" id="card-holder-name" class="form-control" value="" placeholder="Name on the card">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="form-group">
                                    <label for="card-element">Credit or debit card</label>
                                    <div id="card-element"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 mt-5">
                                <button type="submit" class="btn btn-primary" id="card-button" data-secret="{{ $intent->client_secret }}">Purchase</button>
                            </div>
                        </div>
                    </form>
  
                </div>
            </div>
        </div>
    </div>
</div>
  
<script src="https://js.stripe.com/v3/"></script>
<script>

    function showform(id) {
        $('.cardpay').addClass('hideallforms');
        $('.paypal').addClass('hideallforms');
        $('.googlepay').addClass('hideallforms');
        $('.'+id).removeClass('hideallforms');
        $('.'+id).show();
    }


    const stripe = Stripe('{{ env('STRIPE_KEY') }}')
  
    const elements = stripe.elements()
    // const cardElement = elements.create('card')
  
    const cardElement = elements.create('card', { style:
      {
        base: {
          fontSize: '16px',
          color: '#fff'
        }
      }
    });

    cardElement.mount('#card-element')
  
    const form = document.getElementById('payment-form')
    const cardBtn = document.getElementById('card-button')
    const cardHolderName = document.getElementById('card-holder-name')
  
    form.addEventListener('submit', async (e) => {
        e.preventDefault()
  
        cardBtn.disabled = true
        const { setupIntent, error } = await stripe.confirmCardSetup(
            cardBtn.dataset.secret, {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: cardHolderName.value
                    }   
                }
            }
        )
  
        if(error) {
            cardBtn.disable = false
        } else {
            let token = document.createElement('input')
            token.setAttribute('type', 'hidden')
            token.setAttribute('name', 'token')
            token.setAttribute('value', setupIntent.payment_method)
            form.appendChild(token)
            form.submit();
        }
    })
</script>
@endsection