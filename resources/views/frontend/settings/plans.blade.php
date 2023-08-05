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
  .btn-sm {
    padding: 10px 0px;
    font-size: 16px;
}
</style>
<section class="gradient-form background-radial-gradient">
    @include('includes.sidebar')

    <div class="col-md-9 col-lg-10 ml-md-auto px-0 ms-md-auto">
      <!-- main content -->
      <main class="p-4 min-vh-100" style="overflow-y:auto !important; height: 100vh;">
        <div class="container">
          <div class="row section-header">
            <div class="col-md-12">
              <h3>Profile Settings</h3>
              <p>Update your personal and security Information</p>
            </div>
          </div>
            <div class="row">
                @include('includes.profile-sidebar')
                <div class="col-md-8">
                  <div class="card">
                    <div class="card-body">
                        <h4>Your Plan</h4>

                        <div class="row mt-4">
                            @foreach($plans as $plan)
                              <div class="col-md-6">
                                <div class="card mb-4 plan-card login-left-section">
                                  <div class="card-body">
                                    <h5 class="card-title">{{ $plan->name }}</h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    <h2 class="card-price">${{ $plan->price }}
                                      <span class="card-duration">/{{ $plan->no_of_days }} Days</span>
                                    </h2>
                                    <div class="mt-4">
                                      @if(Auth::user()->plan == $plan->id)
                                      <a href="{{ url('profile/cancelsubscription') }}" class="btn primary-button btn-sm pull-right btn-block">Cancel Subscription</a>
                                      @else
                                      <a href="{{ route('plans.show', $plan->slug) }}" class="btn primary-button btn-sm pull-right btn-block">Purchase Plan</a>
                                      @endif
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
      </main>
    </div>
</section>
@endsection