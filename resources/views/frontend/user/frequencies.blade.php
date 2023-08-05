@extends('frontend.layouts.front-app-home')
@section('meta-tags')
<title>Freqeuncies List</title>
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
                <h3>Freqeuncies List</h3>
                <p>Find the relavant lists</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="row">
                    @foreach($data as $r)
                    <div class="col-md-6">
                      <a href="{{ url('profile/frequency') }}/{{ $r->id }}/{{ $r->slug }}" class="single-frequency">
                        <div class="card mb-2">
                          <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                              <div class="p-2 flex-grow-1">
                                <div class="d-flex flex-row">
                                  <div class="p-2">
                                    <img class="img-preview" src="{{ url('public/images') }}/{{ $r->image }}">
                                  </div>
                                  <div class="p-2">
                                    <h4>{{ $r->name }}</h4>
                                    <small>{{ $r->vibration }}</small>
                                  </div>
                                </div>
                              </div>
                              <div class="p-2">
                                <img src="{{ asset('public/front/media/play-gradient.svg') }}" width="50">
                              </div>
                            </div>
                          </div>
                        </div>
                      </a>
                    </div>
                    
                    <!-- <div style="background-color: #ddd;padding: 10px;border-radius: 10px;color: black;" class="row mb-3">
                        <div class="col-md-2">
                            <a href="{{ url('profile/frequency') }}/{{ $r->id }}/{{ $r->slug }}">
                                <img class="img-thumbnail" width="100" src="{{ url('public/images') }}/{{ $r->image }}">
                            </a>
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
                    </div> -->
                    @endforeach

                </div>
              </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    {!! $data->links('admin.pagination') !!}
                </div> 
                <div class="col-md-4">
                </div>                       
            </div>
          </div>
      </main>
    </div>
</section>
@endsection