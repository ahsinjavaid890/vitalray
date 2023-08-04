@extends('frontend.layouts.front-app-home')
@section('meta-tags')
<title>Plans</title>
@endsection

@section('content')
<style type="text/css">
  .card-title{
    position: unset;
  }
  .card-text{
    position: unset;
  }
</style>
<section class="h-100 gradient-form background-radial-gradient overflow-hidden">
  <div class="container py-4 h-90">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-5 text-black">
          <div class="row g-0">
            <div class="col-lg-12 login-left-section">
              <div class="card-body p-md-5 mx-md-4">
                <div class="text-left">
                  <h4 class="mt-1 mb-1 pb-1">Choose your package</h4>
                  <p>Choose the plan that best suits you.</p>
                </div>
                <div class="row mt-4">
                    @foreach($plans as $plan)
                      <div class="col-md-6">
                        <div class="card mb-4 plan-card">
                          <div class="card-body">
                            <h5 class="card-title">{{ $plan->name }}</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <h2 class="card-price">${{ $plan->price }}
                              <span class="card-duration">/{{ $plan->no_of_days }}</span>
                            </h2>
                            <div class="mt-4">
                              <a href="{{ route('plans.show', $plan->slug) }}" class="btn primary-button btn-sm pull-right btn-block">Purchase Plan</a>   
                            </div>
                            
                          </div>
                        </div>
                      </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection