

@extends('frontend.layouts.front-app')


@section('content')
<div class="container">

<div class="row">
    @include('frontend.settings.sidebar')
    <div class="col-lg-8 widget-block widget-break-lg">
        <div class="widget widget-user-about">
            <div class="widget-heading">
                <h3 class="widget-title">General Settings</h3>
            </div>
            <div class="user-info">
                <div class="block-box">
                    <form method="POST" action="{{ url('profile/updategeneraldetails') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" value="{{ $data->name }}" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input readonly type="text" value="{{ $data->username }}" class="form-control" name="username">
                        </div>
                        <div class="form-group">
                            <label>About Info</label>
                            <textarea name="about" id="message" class="form-control textarea" cols="30" rows="5">{{ $data->about }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input readonly type="text" value="{{ $data->email }}" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="submit-btn" name="btn-add" value="Submit Now">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
@endsection