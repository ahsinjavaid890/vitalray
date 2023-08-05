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
              <h3>{{ $data->name }}</h3>
            </div>
          </div>
            <div class="row">
                <div class="col-md-12">
                  <div class="card">
                        <div class="card-body">
                            {!! $data->content  !!}
                        </div>
                   </div>
                </div>
            </div>
          </div>
      </main>
    </div>
</section>
@endsection