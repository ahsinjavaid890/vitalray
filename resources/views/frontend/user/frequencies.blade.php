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
 
                    @foreach($data as $r)
                    <div style="background-color: #ddd;padding: 10px;border-radius: 10px;color: black;" class="row mb-3">
                        <div class="col-md-2">
                            <img class="img-thumbnail" width="100" src="{{ url('public/images') }}/{{ $r->image }}">
                        </div>
                        <div class="col-md-10">
                            <div class="mp3-player">
                              <audio class="form-control" controls>
                                <source src="{{ url('public/images') }}/{{ $r->freequency }}" type="audio/mpeg">
                                Your browser does not support the audio element.
                              </audio>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Name</label>
                            <div><b>{{ $r->name }}</b></div>
                        </div>
                        <div class="col-md-4">
                            <label>vibration</label>
                            <div><b>{{ $r->vibration }}</b></div>
                        </div>
                        <div class="col-md-4">
                            <label>emitter</label>
                            <div><b>{{ $r->emitter }}</b></div>
                        </div>
                        <div class="col-md-12">
                            <label>description</label>
                            <div><b>{{ $r->description }}</b></div>
                        </div>
                    </div>
                    @endforeach
                    <div class="row">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4">
                            {!! $data->links('admin.pagination') !!}
                        </div> 
                        <div class="col-md-4">
                            
                        </div>                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection