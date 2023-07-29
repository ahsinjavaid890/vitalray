@extends('frontend.layouts.front-app')
@section('content')
@section('title')
<title>UPSC Singles</title>
<meta name="DC.Title" content="UPSC Singles">
<meta name="rating" content="general">
<meta name="description" content="UPSC Singles">
<meta property="og:type" content="website">
<meta property="og:image" content="">
<meta property="og:title" content="UPSC Singles">
<meta property="og:description" content="UPSC Singles">
<meta property="og:site_name" content="UPSC Singles">
<meta property="og:url" content="{{ url('') }}">
<meta property="og:locale" content="it_IT">
@endsection
<style type="text/css">
    #hiddenmobile{
        display: none;
    }
    .chatroom{
        padding-left: 20px;
        padding-right: 20px;
    }
    .page-content {
        padding: 110px 90px 0;
        background-color: #13151B;
    }
</style>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<div class="chatroom">
    <div class="row h-100">
        @include('frontend.chat.sidebar')
        <div class="col-lg-8"> 
            <div class="card mb-sm-3 mb-md-0 contacts_card">
                <div class="card-body contacts_body">
                    <p style="text-align:center;margin-top: 50px;font-size: 22px;">Please Select Group or Person Chat</p>
                </div>
                <div class="card-footer"></div>
            </div>
         </div>
    </div>
</div>
@endsection