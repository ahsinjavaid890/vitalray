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
    @media only screen and (max-width: 767px)
    {
        .page-content {
            padding: 90px 0 0;
        }
    }
        
</style>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<div class="chatroom">
	<div class="row h-100">
		@include('frontend.chat.sidebar')
		@php
			$usertwo = DB::table('users')->where('id' , $chat)->get()->first();
		@endphp
		<div class="col-md-9 col-xl-9">
			<div class="card">
				<div class="card-header msg_head">
					<div class="d-flex bd-highlight">
						<div class="img_cont">
							@if($usertwo->profileimage)
		                    <img class="rounded-circle user_img" src="{{ asset('public/images') }}/{{ $usertwo->profileimage }}" alt="{{ $usertwo->name }}">
		                     @elseif($usertwo->profileimage_social)
		                    <img class="rounded-circle user_img" src="{{ $usertwo->profileimage_social }}">
		                    @else
                            @if($usertwo->gender == 'Male')

                                <img class="rounded-circle user_img" src="{{ asset('public/front/media/profileavatar.png') }}">

                            @else

                            <img class="rounded-circle user_img" src="{{ asset('public/front/media/profilefemailavatar.jpg') }}">
                            @endif


                            @endif
                            @if($usertwo->online == 1)  
							<span class="online_icon"></span>
							@endif
						</div>
						<div class="user_info">
							<span>{{ $usertwo->name }}</span>
						</div>
					</div>
				</div>
				<div class="card-body msg_card_body">
					
				</div>
				<div class="card-footer">
	                
					<div style="display:none;" class="emogiebox">
                        <div class="emoji-items-wrap1">
                            <div onclick="addemogiechatroom(1)" class="emogie-list">😂</div>
                            <div onclick="addemogiechatroom(2)" class="emogie-list">😱</div>
                            <div onclick="addemogiechatroom(3)" class="emogie-list">👌</div>
                            <div onclick="addemogiechatroom(4)" class="emogie-list">😡</div>
                            <div onclick="addemogiechatroom(5)" class="emogie-list">😕</div>
                        </div>
                        <div class="emoji-items-wrap1">
                            <div onclick="addemogiechatroom(6)" class="emogie-list">🙊</div>
                            <div onclick="addemogiechatroom(7)" class="emogie-list">😭</div>
                            <div onclick="addemogiechatroom(8)" class="emogie-list">😋</div>
                            <div onclick="addemogiechatroom(9)" class="emogie-list">😐</div>
                            <div onclick="addemogiechatroom(10)" class="emogie-list">😝</div>
                        </div>
                        <div class="emoji-items-wrap1">
                            <div onclick="addemogiechatroom(11)" class="emogie-list">😀</div>
                            <div onclick="addemogiechatroom(12)" class="emogie-list">😌</div>
                            <div onclick="addemogiechatroom(13)" class="emogie-list">😚</div>
                            <div onclick="addemogiechatroom(14)" class="emogie-list">😅</div>
                            <div onclick="addemogiechatroom(15)" class="emogie-list">😞</div>
                        </div>
                        <div class="emoji-items-wrap1">
                            <div onclick="addemogiechatroom(16)" class="emogie-list">😢</div>
                            <div onclick="addemogiechatroom(17)" class="emogie-list">😃</div>
                            <div onclick="addemogiechatroom(18)" class="emogie-list">😉</div>
                            <div onclick="addemogiechatroom(19)" class="emogie-list">🙈</div>
                            <div onclick="addemogiechatroom(20)" class="emogie-list">😜</div>
                        </div>
                        <div class="emoji-items-wrap1">
                            <div onclick="addemogiechatroom(21)" class="emogie-list">😍</div>
                            <div onclick="addemogiechatroom(22)" class="emogie-list">😊</div>
                            <div onclick="addemogiechatroom(23)" class="emogie-list">😁</div>
                            <div onclick="addemogiechatroom(24)" class="emogie-list">👍</div>
                            <div onclick="addemogiechatroom(25)" class="emogie-list">😔</div>
                        </div>
                        <div class="emoji-items-wrap1">
                            <div onclick="addemogiechatroom(26)" class="emogie-list">👌</div>
                            <div onclick="addemogiechatroom(27)" class="emogie-list">😱</div>
                            <div onclick="addemogiechatroom(28)" class="emogie-list">😂</div>
                            <div onclick="addemogiechatroom(29)" class="emogie-list">🐶</div>
                            <div onclick="addemogiechatroom(30)" class="emogie-list">🐺</div>
                        </div>
                        <div class="emoji-items-wrap1">
                            <div onclick="addemogiechatroom(31)" class="emogie-list">🐱</div>
                            <div onclick="addemogiechatroom(32)" class="emogie-list">🐭</div>
                            <div onclick="addemogiechatroom(33)" class="emogie-list">🐹</div>
                            <div onclick="addemogiechatroom(34)" class="emogie-list">🐰</div>
                            <div onclick="addemogiechatroom(35)" class="emogie-list">🐸</div>
                        </div>
                        
                    </div>
	                <div style="width: 80px;height: 80px;display: none;" class="image-show">
                        <img id="blah" src="http://127.0.0.1:8000/chat/images/1645931771.jpg">
                    </div>
	                <form class="needs-validation" novalidate="" onsubmit="event.preventDefault();" name="chatroom-form" id="chatroom-form">
	                    {{ csrf_field() }}
	                    <input type="hidden" value="{{ Auth::user()->id }}" id="sendBy">
	                    <input type="hidden" id="sendTo" value="{{ $usertwo->id }}" name="sendTo">
	                    <div class="form-group">
	                    	<input autocomplete="off" type="text" id="inputMessage" class="form-control" placeholder="Write your text here.....">
	                        <div style="position: absolute; top: 10px; right: 15px; font-size: 22px;" onclick="sendchatroomMessage()" class="chat-plus-icon"><i style="color: #f08089;font-size: 30px;" class="icofont-location-arrow"></i></div>
	                        <input onchange="readchatroom(this);" type="file" id="imgupload" accept="image/*"/ style="display: none;" name="image">
	                        <div class="file-attach-icon">
	                            <a onclick="chatroomemogie()"><i class="icofont-slightly-smile"></i></a>
	                            <a onclick="OpenImgUploadchatroom()"><i class="icofont-image"></i></a>
	                        </div>
	                    </div>
	                </form>
	            </div>
			</div>
		</div>
	</div>
</div>
<style type="text/css">
	.emogiebox{
		left: 40px !important;
        bottom: 110px !important;
	}
</style>
<style type="text/css">
    .emogiebox{
        position: absolute;
        left: 0;
        bottom: 73px;
        z-index: 999;
        width: 180px;
        border: 1px #dfdfdf solid;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        overflow: auto;
        height: 160px;
        -webkit-box-shadow: 0px 1px 1px rgb(0 0 0 / 10%);
        -moz-box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.1);
        box-shadow: 0px 1px 1px rgb(0 0 0 / 10%);
    }
    .emoji-items-wrap1{
        background: #ffffff;
        padding: 5px 2px 5px 5px;
        display: flex;
    }
    .emogie-list{
        cursor: pointer;
        width: 37px;
        text-align: center;
        margin: -1px 0 0 -1px;
        padding: 5px;
        display: block;
        float: left;
        border-radius: 2px;
        border: 0;
    }
    .emogie-list:hover{
        background-color: #ddd;
    }

</style>
<script type="text/javascript">


$('#inputMessage').keypress(function (e) {
  if (e.which == 13) {
    sendchatroomMessage();
  }
});
function addemogiechatroom(emogie)
{
    if(emogie == 1)
    {
        document.getElementById('inputMessage').value = document.getElementById('inputMessage').value + "😂";
    }
    if(emogie == 2)
    {
        document.getElementById('inputMessage').value = document.getElementById('inputMessage').value + "😱";
    }
    if(emogie == 3)
    {
        document.getElementById('inputMessage').value = document.getElementById('inputMessage').value + "👌";
    }
    if(emogie == 4)
    {
        document.getElementById('inputMessage').value = document.getElementById('inputMessage').value + "😡";
    }
    if(emogie == 5)
    {
        document.getElementById('inputMessage').value = document.getElementById('inputMessage').value + "😕";
    }
    if(emogie == 6)
    {
        document.getElementById('inputMessage').value = document.getElementById('inputMessage').value + "🙊";
    }
    if(emogie == 7)
    {
        document.getElementById('inputMessage').value = document.getElementById('inputMessage').value + "😭";
    }
    if(emogie == 8)
    {
        document.getElementById('inputMessage').value = document.getElementById('inputMessage').value + "😋";
    }
    if(emogie == 9)
    {
        document.getElementById('inputMessage').value = document.getElementById('inputMessage').value + "😐";
    }
    if(emogie == 10)
    {
        document.getElementById('inputMessage').value = document.getElementById('inputMessage').value + "😝";
    }
    if(emogie == 11)
    {
        document.getElementById('inputMessage').value = document.getElementById('inputMessage').value + "😀";
    }
    if(emogie == 12)
    {
        document.getElementById('inputMessage').value = document.getElementById('inputMessage').value + "😌";
    }
    if(emogie == 13)
    {
        document.getElementById('inputMessage').value = document.getElementById('inputMessage').value + "😚";
    }
    if(emogie == 14)
    {
        document.getElementById('inputMessage').value = document.getElementById('inputMessage').value + "😅";
    }
    if(emogie == 15)
    {
        document.getElementById('inputMessage').value = document.getElementById('inputMessage').value + "😞";
    }
    if(emogie == 16)
    {
        document.getElementById('inputMessage').value = document.getElementById('inputMessage').value + "😢";
    }
    if(emogie == 17)
    {
        document.getElementById('inputMessage').value = document.getElementById('inputMessage').value + "😃";
    }
    if(emogie == 18)
    {
        document.getElementById('inputMessage').value = document.getElementById('inputMessage').value + "😉";
    }
    if(emogie == 19)
    {
        document.getElementById('inputMessage').value = document.getElementById('inputMessage').value + "🙈";
    }
    if(emogie == 20)
    {
        document.getElementById('inputMessage').value = document.getElementById('inputMessage').value + "😜";
    }
    if(emogie == 21)
    {
        document.getElementById('inputMessage').value = document.getElementById('inputMessage').value + "😍";
    }
    if(emogie == 22)
    {
        document.getElementById('inputMessage').value = document.getElementById('inputMessage').value + "😊";
    }
    if(emogie == 23)
    {
        document.getElementById('inputMessage').value = document.getElementById('inputMessage').value + "😁";
    }
    if(emogie == 24)
    {
        document.getElementById('inputMessage').value = document.getElementById('inputMessage').value + "👍";
    }
    if(emogie == 25)
    {
        document.getElementById('inputMessage').value = document.getElementById('inputMessage').value + "😔";
    }
    if(emogie == 26)
    {
        document.getElementById('inputMessage').value = document.getElementById('inputMessage').value + "👌";
    }
    if(emogie == 27)
    {
        document.getElementById('inputMessage').value = document.getElementById('inputMessage').value + "😱";
    }
    if(emogie == 28)
    {
        document.getElementById('inputMessage').value = document.getElementById('inputMessage').value + "😂";
    }
    if(emogie == 29)
    {
        document.getElementById('inputMessage').value = document.getElementById('inputMessage').value + "🐶";
    }
    if(emogie == 30)
    {
        document.getElementById('inputMessage').value = document.getElementById('inputMessage').value + "🐺";
    }
    if(emogie == 31)
    {
        document.getElementById('inputMessage').value = document.getElementById('inputMessage').value + "🐱";
    }
    if(emogie == 32)
    {
        document.getElementById('inputMessage').value = document.getElementById('inputMessage').value + "🐭";
    }
    if(emogie == 33)
    {
        document.getElementById('inputMessage').value = document.getElementById('inputMessage').value + "🐹";
    }
    if(emogie == 34)
    {
        document.getElementById('inputMessage').value = document.getElementById('inputMessage').value + "🐰";
    }
    if(emogie == 35)
    {
        document.getElementById('inputMessage').value = document.getElementById('inputMessage').value + "🐸";
    }
}	
function chatroomemogie()
{
	$('.emogiebox').slideToggle('slow');
}
function OpenImgUploadchatroom()
{
    $('#imgupload').trigger('click');
}
function sendchatroomMessage(){

    var file_data = $('#imgupload').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    form_data.append('sendBy', $('#sendBy').val());
    form_data.append('sendTo', $('#sendTo').val());
    form_data.append('_token', $('meta[name="csrf-token"]').attr('content'));
    form_data.append('message',$('#inputMessage').val());

    if($('#inputMessage').val()!='' || file_data!=undefined){
        $.ajax({
            type: "POST",
            url: app_url()+'/details/save/Chatroom',
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(res) {
                $('.image-show').hide();
                $('#inputMessage').val('')
                $('.emogiebox').hide('slow');
                $('#imgupload').val('')
                $('.msg_card_body').html(res);
                $('.msg_card_body').scrollTop($('.msg_card_body').get(0).scrollHeight);
            }
        });
    }
}

$( document ).ready(function() {
    checkchatroommessage();
    getchatroommessages();
});


function checkchatroommessage()
{
    $.ajax({
        type: "GET",
        url: app_url()+'/profile/details/checkchatroommessage/',
        success: function(resp) {

            if(resp > 0)
            {
                getchatroommessages();
            }
             setTimeout(function() { 
                checkchatroommessage();
            }, 2000);
        }
    });
}

function getchatroommessages()
{
	var id = '{{ $usertwo->username }}'
	$.ajax({
        type: "GET",
        url: app_url()+'/profile/getchatroommessages/'+id,
        success: function(resp) {
        	$('.msg_card_body').html(resp);
            $('.msg_card_body').scrollTop($('.msg_card_body').get(0).scrollHeight);
        }
    });
}
</script>
@endsection