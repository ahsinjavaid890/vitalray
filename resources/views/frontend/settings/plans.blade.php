@extends('frontend.layouts.front-app-home')
@section('meta-tags')
<title>Plans</title>
@endsection

@section('content')
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

                        <div class="row">
                        @foreach($plans as $plan)
                            <div class="col-md-6">
                                <div class="card mb-3">
                                  <div class="card-header"> 
                                        ${{ $plan->price }}/Mo
                                  </div>
                                  <div class="card-body">
                                    <h5 class="card-title">{{ $plan->name }}</h5>
  
                                    @if(Auth::user()->plan == $plan->id)
                                        <a href="{{ url('profile/cancelsubscription') }}" class="btn btn-primary pull-right">Cancel Subscription</a>
                                    @else


                                    <a href="{{ route('plans.show', $plan->slug) }}" class="btn btn-primary pull-right">Change Plan</a>
  
                                    @endif
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