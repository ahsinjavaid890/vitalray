@extends('frontend.layouts.front-app-home')
@section('meta-tags')
<title>Plans</title>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Select Plane:</div>
 
                <div class="card-body">
 
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
@endsection