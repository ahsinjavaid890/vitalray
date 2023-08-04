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
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="d-flex flex-column text-center">
                                    <div>
                                        <img class="img-thumbnail" style="width:100%; height: 300px" src="{{ url('public/images') }}/{{ $data->image }}">
                                    </div>
                                    <div>
                                        <h4 class="mt-3">{{ $data->name }}</h4>
                                    </div>
                                    <div>
                                        <div class="mp3-player">
                                          <audio id="myAudio" class="form-control" controls>
                                            <source src="{{ url('public/images') }}/{{ $data->freequency }}" type="audio/mpeg">
                                            Your browser does not support the audio element.
                                          </audio>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-column mt-2">
                                    <div class="">
                                        <label>vibration</label>
                                        <div><b>{{ $data->vibration }}</b></div>
                                    </div>
                                    <div>
                                        <label>emitter</label>
                                        <div><b>{{ $data->emitter }}</b></div>
                                    </div>
                                    <div>
                                        <label>description</label>
                                        <div><b>{{ $data->description }}</b></div>
                                    </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </main>
    </div>
</section>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <h4>Do you Expereince something New?</h4>
        <p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. Wikipedia</p>

        <a href="" class="btn btn-primary">Share</a>
      </div>
    </div>
  </div>
</div>
<script>
let aud = document.getElementById("myAudio");
aud.onpause = function() {
  $('#myModal').modal('show');
};
</script>
@endsection