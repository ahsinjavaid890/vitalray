@extends('frontend.layouts.front-app')

@section('title')
<title>Invitations | {{ Cmf::get_store_value('site_name') }}</title>
@endsection

@section('content')



<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <center>
                <button id="btn-nft-enable" onclick="initFirebaseMessagingRegistration()" class="btn btn-danger btn-xs btn-flat">Allow for Notification</button>
            </center>
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
  
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
  
                    <form action="{{ route('send.notification') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <div class="form-group">
                            <label>Body</label>
                            <textarea class="form-control" name="body"></textarea>
                          </div>
                        <button type="submit" class="btn btn-primary">Send Notification</button>
                    </form>
  
                </div>
            </div>
        </div>
    </div>
</div> -->
  
<script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>
<script>
    var firebaseConfig = {
        apiKey: "asasas",
        authDomain: "itdemo-push-notification.firebaseapp.com",
        databaseURL: "https://itdemo-push-notification.firebaseio.com",
        projectId: "itdemo-push-notification",
        storageBucket: "itdemo-push-notification.appspot.com",
        messagingSenderId: "asas",
        appId: "asas",
        measurementId: "G-VMJ68DFLXL"
    };
    // measurementId: G-R1KQTR3JBN
      // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();
    function initFirebaseMessagingRegistration() {
            messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken()
            })
            .then(function(token) {
                console.log(token);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ route("save-token") }}',
                    type: 'POST',
                    data: {
                        token: token
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        alert('Token saved successfully.');
                    },
                    error: function (err) {
                        console.log('User Chat Token Error'+ err);
                    },
                });
            }).catch(function (err) {
                console.log('User Chat Token Error'+ err)
            });
     }  
    
    messaging.onMessage(function(payload) {
        const noteTitle = payload.notification.title;
        const noteOptions = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        new Notification(noteTitle, noteOptions);
    });
</script>
<div class="container">
    <div class="block-box user-about widget-comment">
        <div class="widget-heading">
            <h3 class="widget-title">All Notifications</h3>
        </div>
        <div class="group-list">
        @foreach($data as $r)
        <div class="media">
            <div class="media-body">
                <div class="post-date">{{ Cmf::date_format($r->created_at) }}</div>
                <h4 class="item-title"><a @if($r->read_status == 1) style="color: #ef8089;" @else style="color: white;" @endif href="{{ $r->url }}">{{ $r->notification }}</a></h4>
            </div>
        </div>
        @endforeach



    </div>
    </div>
    
</div>
@endsection