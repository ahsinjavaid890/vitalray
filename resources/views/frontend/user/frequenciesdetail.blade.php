@extends('frontend.layouts.front-app-home')
@section('meta-tags')
<title>Plans</title>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Frequencies:</div>
 
                <div class="card-body">
 
                    <div style="background-color: #ddd;padding: 10px;border-radius: 10px;color: black;" class="row mb-3">
                        <div class="col-md-2">
                            <a href="{{ url('profile/frequency') }}/{{ $data->id }}/{{ $data->slug }}">
                                <img class="img-thumbnail" width="100" src="{{ url('public/images') }}/{{ $data->image }}">
                            </a>
                        </div>
                        <div class="col-md-10">
                            <div class="mp3-player">
                              <audio id="myAudio" class="form-control" controls>
                                <source src="{{ url('public/images') }}/{{ $data->freequency }}" type="audio/mpeg">
                                Your browser does not support the audio element.
                              </audio>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Name</label>
                            <div><b>{{ $data->name }}</b></div>
                        </div>
                        <div class="col-md-4">
                            <label>vibration</label>
                            <div><b>{{ $data->vibration }}</b></div>
                        </div>
                        <div class="col-md-4">
                            <label>emitter</label>
                            <div><b>{{ $data->emitter }}</b></div>
                        </div>
                        <div class="col-md-12">
                            <label>description</label>
                            <div><b>{{ $data->description }}</b></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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