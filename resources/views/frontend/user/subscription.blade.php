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
                        <div id="container"></div>

<script>
/**
 * Define the version of the Google Pay API referenced when creating your
 * configuration
 *
 */
const baseRequest = {
  apiVersion: 2,
  apiVersionMinor: 0
};

/**
 * Card networks supported by your site and your gateway
 *
 */
const allowedCardNetworks = ["AMEX", "DISCOVER", "JCB", "MASTERCARD", "MIR", "VISA"];

/**
 * Card authentication methods supported by your site and your gateway
 *
 * supported card networks
 */
const allowedCardAuthMethods = ["PAN_ONLY", "CRYPTOGRAM_3DS"];

/**
 * Identify your gateway and your site's gateway merchant identifier
 *
 * The Google Pay API response will return an encrypted payment method capable
 * of being charged by a supported gateway after payer authorization
 *
 */
const tokenizationSpecification = {
  type: 'PAYMENT_GATEWAY',
  parameters: {
    'gateway': 'example',
    'gatewayMerchantId': 'exampleGatewayMerchantId'
  }
};

/**
 * Describe your site's support for the CARD payment method and its required
 * fields
 *
 */
const baseCardPaymentMethod = {
  type: 'CARD',
  parameters: {
    allowedAuthMethods: allowedCardAuthMethods,
    allowedCardNetworks: allowedCardNetworks
  }
};

/**
 * Describe your site's support for the CARD payment method including optional
 * fields
 *
 */
const cardPaymentMethod = Object.assign(
  {},
  baseCardPaymentMethod,
  {
    tokenizationSpecification: tokenizationSpecification
  }
);

/**
 * An initialized google.payments.api.PaymentsClient object or null if not yet set
 *
 */
let paymentsClient = null;

/**
 * Configure your site's support for payment methods supported by the Google Pay
 * API.
 *
 * Each member of allowedPaymentMethods should contain only the required fields,
 * allowing reuse of this base request when determining a viewer's ability
 * to pay and later requesting a supported payment method
 *
 */
function getGoogleIsReadyToPayRequest() {
  return Object.assign(
      {},
      baseRequest,
      {
        allowedPaymentMethods: [baseCardPaymentMethod]
      }
  );
}

/**
 * Configure support for the Google Pay API
 *
 */
function getGooglePaymentDataRequest() {
  const paymentDataRequest = Object.assign({}, baseRequest);
  paymentDataRequest.allowedPaymentMethods = [cardPaymentMethod];
  paymentDataRequest.transactionInfo = getGoogleTransactionInfo();
  paymentDataRequest.merchantInfo = {
    // merchantId: '12345678901234567890',
    merchantName: 'Example Merchant'
  };

  paymentDataRequest.callbackIntents = ["SHIPPING_ADDRESS",  "SHIPPING_OPTION", "PAYMENT_AUTHORIZATION"];
  paymentDataRequest.shippingAddressRequired = true;
  paymentDataRequest.shippingAddressParameters = getGoogleShippingAddressParameters();
  paymentDataRequest.shippingOptionRequired = true;

  return paymentDataRequest;
}

/**
 * Return an active PaymentsClient or initialize
 *
 */
function getGooglePaymentsClient() {
  if ( paymentsClient === null ) {
    paymentsClient = new google.payments.api.PaymentsClient({
      environment: "TEST",
      merchantInfo: {
        merchantName: "Example Merchant",
        merchantId: "01234567890123456789"
      },
      paymentDataCallbacks: {
        onPaymentAuthorized: onPaymentAuthorized,
        onPaymentDataChanged: onPaymentDataChanged
      }
    });
  }
  return paymentsClient;
}


function onPaymentAuthorized(paymentData) {
        return new Promise(function(resolve, reject){

  // handle the response
  processPayment(paymentData)
    .then(function() {
      resolve({transactionState: 'SUCCESS'});
    })
    .catch(function() {
        resolve({
        transactionState: 'ERROR',
        error: {
          intent: 'PAYMENT_AUTHORIZATION',
          message: 'Insufficient funds',
          reason: 'PAYMENT_DATA_INVALID'
        }
      });
    });

  });
}

/**
 * Handles dynamic buy flow shipping address and shipping options callback intents.
 *
 */
function onPaymentDataChanged(intermediatePaymentData) {
  return new Promise(function(resolve, reject) {

        let shippingAddress = intermediatePaymentData.shippingAddress;
    let shippingOptionData = intermediatePaymentData.shippingOptionData;
    let paymentDataRequestUpdate = {};

    if (intermediatePaymentData.callbackTrigger == "INITIALIZE" || intermediatePaymentData.callbackTrigger == "SHIPPING_ADDRESS") {
      if(shippingAddress.administrativeArea == "NJ")  {
        paymentDataRequestUpdate.error = getGoogleUnserviceableAddressError();
      }
      else {
        paymentDataRequestUpdate.newShippingOptionParameters = getGoogleDefaultShippingOptions();
        let selectedShippingOptionId = paymentDataRequestUpdate.newShippingOptionParameters.defaultSelectedOptionId;
        paymentDataRequestUpdate.newTransactionInfo = calculateNewTransactionInfo(selectedShippingOptionId);
      }
    }
    else if (intermediatePaymentData.callbackTrigger == "SHIPPING_OPTION") {
      paymentDataRequestUpdate.newTransactionInfo = calculateNewTransactionInfo(shippingOptionData.id);
    }

    resolve(paymentDataRequestUpdate);
  });
}

/**
 * Helper function to create a new TransactionInfo object.
 *
 */
function calculateNewTransactionInfo(shippingOptionId) {
        let newTransactionInfo = getGoogleTransactionInfo();

  let shippingCost = getShippingCosts()[shippingOptionId];
  newTransactionInfo.displayItems.push({
    type: "LINE_ITEM",
    label: "Shipping cost",
    price: shippingCost,
    status: "FINAL"
  });

  let totalPrice = 0.00;
  newTransactionInfo.displayItems.forEach(displayItem => totalPrice += parseFloat(displayItem.price));
  newTransactionInfo.totalPrice = totalPrice.toString();

  return newTransactionInfo;
}

/**
 * Initialize Google PaymentsClient after Google-hosted JavaScript has loaded
 *
 * Display a Google Pay payment button after confirmation of the viewer's
 * ability to pay.
 */
function onGooglePayLoaded() {
  const paymentsClient = getGooglePaymentsClient();
  paymentsClient.isReadyToPay(getGoogleIsReadyToPayRequest())
      .then(function(response) {
        if (response.result) {
          addGooglePayButton();
          // @todo prefetch payment data to improve performance after confirming site functionality
          // prefetchGooglePaymentData();
        }
      })
      .catch(function(err) {
        // show error in developer console for debugging
        console.error(err);
      });
}

/**
 * Add a Google Pay purchase button alongside an existing checkout button
 *
 */
function addGooglePayButton() {
  const paymentsClient = getGooglePaymentsClient();
  const button =
      paymentsClient.createButton({
        onClick: onGooglePaymentButtonClicked,
        allowedPaymentMethods: [baseCardPaymentMethod]
      });
  document.getElementById('container').appendChild(button);
}

/**
 * Provide Google Pay API with a payment amount, currency, and amount status
 *
 */
function getGoogleTransactionInfo() {
  return {
        displayItems: [
        {
          label: "Plan Price",
          type: "SUBTOTAL",
          price: "{{ $plan->price }}",
        },
      {
          label: "Plateform Fee",
          type: "TAX",
          price: "4.00",
        }
    ],
    countryCode: 'US',
    currencyCode: "USD",
    totalPriceStatus: "FINAL",
    totalPrice: "{{ $plan->price+4 }}",
    totalPriceLabel: "Total"
  };
}

/**
 * Provide a key value store for shippping options.
 */
function getShippingCosts() {
        return {
    "shipping-001": "0.00",
    "shipping-002": "1.99",
    "shipping-003": "10.00"
  }
}

/**
 * Provide Google Pay API with shipping address parameters when using dynamic buy flow.
 *
 */
function getGoogleShippingAddressParameters() {
        return  {
        allowedCountryCodes: ['US'],
    phoneNumberRequired: true
  };
}

/**
 * Provide Google Pay API with shipping options and a default selected shipping option.
 *
 */
function getGoogleDefaultShippingOptions() {
        return {
      defaultSelectedOptionId: "shipping-001",
      shippingOptions: [
        {
          "id": "shipping-001",
          "label": "Free: Standard shipping",
          "description": "Free Shipping delivered in 5 business days."
        },
        {
          "id": "shipping-002",
          "label": "$1.99: Standard shipping",
          "description": "Standard shipping delivered in 3 business days."
        },
        {
          "id": "shipping-003",
          "label": "$10: Express shipping",
          "description": "Express shipping delivered in 1 business day."
        },
      ]
  };
}

/**
 * Provide Google Pay API with a payment data error.
 *
 */
function getGoogleUnserviceableAddressError() {
        return {
    reason: "SHIPPING_ADDRESS_UNSERVICEABLE",
    message: "Cannot ship to the selected address",
    intent: "SHIPPING_ADDRESS"
        };
}

/**
 * Prefetch payment data to improve performance
 *
 */
function prefetchGooglePaymentData() {
  const paymentDataRequest = getGooglePaymentDataRequest();
  // transactionInfo must be set but does not affect cache
  paymentDataRequest.transactionInfo = {
    totalPriceStatus: 'NOT_CURRENTLY_KNOWN',
    currencyCode: 'USD'
  };
  const paymentsClient = getGooglePaymentsClient();
  paymentsClient.prefetchPaymentData(paymentDataRequest);
}


/**
 * Show Google Pay payment sheet when Google Pay payment button is clicked
 */
function onGooglePaymentButtonClicked() {
  const paymentDataRequest = getGooglePaymentDataRequest();
  paymentDataRequest.transactionInfo = getGoogleTransactionInfo();

  const paymentsClient = getGooglePaymentsClient();
  paymentsClient.loadPaymentData(paymentDataRequest);
}

/**
 * Process payment data returned by the Google Pay API
 *
 *
 */
function processPayment(paymentData) {
        return new Promise(function(resolve, reject) {
        setTimeout(function() {
                paymentToken = paymentData.paymentMethodData.tokenizationData.token;
                  if(paymentToken != ''){
              jQuery.ajax({
                 url: "{{ url('payment') }}",
                 method: 'POST',
                 data: { data : paymentData,
                 amount: 12,
                  _token: "{{ csrf_token() }}"},
                 success: function(result){
                     if(result.success){
                         window.location.href = result.url;
                     }else{
                     alert('Some thing went wrong, please tray again');
                     }
                 }});  
         }

        resolve({});
    }, 3000);
  });
}</script>
<script async
  src="https://pay.google.com/gp/p/js/pay.js"
  onload="onGooglePayLoaded()"></script>
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