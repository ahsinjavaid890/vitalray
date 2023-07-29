@php
    $useragent=$_SERVER['HTTP_USER_AGENT'];
@endphp

@if(Cmf::checkmobile() == 'mobile')

<?php
    $currenturl =  Request::url();
    $base =  basename($currenturl);
?>

@if($base != 'chatroom')
<!-- <div style="margin-bottom: 20px;" class="col-md-4 col-xl-4">
	<a href="{{ url('chatroom') }}">	<button class="btn btn-primary"><i class="icofont-arrow-left"></i> Chat Room</button></a>
</div> -->
@endif
@endif

<div @if(Cmf::checkmobile() == 'mobile') id="hiddenmobile" @endif class="col-md-3 col-xl-3">
	<div class="card mb-sm-3 mb-md-0 contacts_card">
	<div class="card-body contacts_body">
		<ui class="contacts">
       @if($chatUsers)
		@foreach($chatUsers as $r)
		@php
			if($r->sendTo == Auth::user()->id)
			{
				$user_id = $r->sendBy;
			}else{
				$user_id = $r->sendTo;
			}
			$user = DB::table('users')->where('id' , $user_id)->get()->first();
		@endphp
		<li class="{{ $user->name }}" @if(isset($chat))  @if($chat == $user->id) id="activechat" @endif  @endif>
			<a  href="{{ url('chat') }}/{{ $user->username }}">
			<div class="d-flex bd-highlight">
				<div class="img_cont">
					@if($user->profileimage)
		          <img style="height: 60px; width: 60px;" class="rounded-circle user_img"  src="{{ asset('public/images') }}/{{ $user->profileimage }}" alt="{{ $user->name }}">
		           @elseif($user->profileimage_social)
		          <img style="height: 60px; width: 60px;" class="rounded-circle user_img" src="{{ $user->profileimage_social }}">
		          @else
		          <img style="height: 60px; width: 60px;" class="rounded-circle user_img"  src="{{ asset('public/front/media/profileavatar.png') }}">
		          @endif
					@if($user->online == 1)  
					<span style="bottom: 1.5em;right: 0.3em;" class="online_icon"></span>
					 @endif
				</div>
				<div class="user_info">
					<span>{{ $user->name }}</span>
					<p>{{ base64_decode($r->message) }}</p>
				</div>
				@if(DB::table('chat')->where('sendTo' , Auth::user()->id)->where('sendBy' , $user->id)->where('read' , 0)->count() > 0)
				<span style="position: absolute; right: 20px; margin-top: 20px;" class="badge badge-primary">{{ DB::table('chat')->where('sendTo' , Auth::user()->id)->where('sendBy' , $user->id)->where('read' , 0)->count() }}</span>
				@endif
			</div>
			</a>
		</li>
		@endforeach
		@else
			@php
				$oneurl = request()->segment(2);
			@endphp

			@if($oneurl)

				@php
					$user = DB::table('users')->where('username' , $oneurl)->first();

				@endphp
				<ui class="contacts">
				   <li id="activechat">
				      <a href="{{ url('chat') }}/{{ $user->username }}">
				         <div class="d-flex bd-highlight">
				            <div class="img_cont">
				               @if($user->profileimage)
					          <img style="height: 60px; width: 60px;" class="rounded-circle user_img"  src="{{ asset('public/images') }}/{{ $user->profileimage }}" alt="{{ $user->name }}">
					           @elseif($user->profileimage_social)
					          <img style="height: 60px; width: 60px;" class="rounded-circle user_img" src="{{ $user->profileimage_social }}">
					          @else
					          <img style="height: 60px; width: 60px;" class="rounded-circle user_img"  src="{{ asset('public/front/media/profileavatar.png') }}">
	          				  @endif
				            </div>
				            <div class="user_info">
				               <span>{{ $user->name }}</span>
				            </div>
				         </div>
				      </a>
				   </li>
				</ui>
			@else
			<p style="text-align:center;margin-top: 50px;font-size: 22px;">No User For Chat</p>
			@endif
		@endif
		</ui>
	</div>
	<div class="card-footer"></div>
</div>
</div>


		<style type="text/css">

			.msg_card_body::-webkit-scrollbar {
			    width: 10px;
			}

			.msg_card_body::-webkit-scrollbar-track {
			    -webkit-box-shadow: inset 0 0 12px rgb(92 56 63);
			    border-radius: 10px;
			}

			.msg_card_body::-webkit-scrollbar-thumb {
			    border-radius: 10px;
			    -webkit-box-shadow: inset 0 0 100px #f08089; 
			}





			.meessage_image{
				width: 200px;
				height: 200px;
				margin-top: 15px;
				text-align: center;
			}
			#activechat{
				background-color: #f08089;
				border-radius: 5px;
			}
			.form-group .form-control{
				padding: 5px !important;
			}
			.chat{
			margin-top: auto;
			margin-bottom: auto;
		}
		.card{
			height: 80vh;
			background-color: #242424;
			padding: 0px;
		}
		.contacts_body{
			padding:  0 0 !important;
			overflow-y: auto;
			white-space: nowrap;
		}
		.msg_card_body{
			overflow-y: auto;
		}
		.card-header{
			height: 60px;
		}
	 .card-footer{
		border-radius: 0 0 15px 15px !important;
			border-top: 0 !important;
	}
		.container{
			align-content: center;
		}
		.search{
			border-radius: 15px 0 0 15px !important;
			background-color: rgba(0,0,0,0.3) !important;
			border:0 !important;
			color:white !important;
		}
		.search:focus{
		     box-shadow:none !important;
           outline:0px !important;
		}
		.type_msg{
			background-color: rgba(0,0,0,0.3) !important;
			border:0 !important;
			color:white !important;
			height: 60px !important;
			overflow-y: auto;
		}
			.type_msg:focus{
		     box-shadow:none !important;
           outline:0px !important;
		}
		.attach_btn{
	border-radius: 15px 0 0 15px !important;
	background-color: rgba(0,0,0,0.3) !important;
			border:0 !important;
			color: white !important;
			cursor: pointer;
		}
		.send_btn{
	border-radius: 0 15px 15px 0 !important;
	background-color: rgba(0,0,0,0.3) !important;
			border:0 !important;
			color: white !important;
			cursor: pointer;
		}
		.search_btn{
			border-radius: 0 15px 15px 0 !important;
			background-color: rgba(0,0,0,0.3) !important;
			border:0 !important;
			color: white !important;
			cursor: pointer;
		}
		.contacts{
			list-style: none;
			padding: 0;
		}
		.contacts li{
			width: 100% !important;
			padding: 5px 10px;
			/*margin-bottom: 15px !important;*/
			/*border-bottom: 1px solid #ddd;*/
		}

		.user_img{
			height: 40px;
			width: 40px;
			border:1.5px solid #f5f6fa;
		
		}
		.user_img_msg{
			height: 40px;
			width: 40px;
			border:1.5px solid #f5f6fa;
		
		}
	.img_cont{
			position: relative;
			height: 70px;
			width: 70px;
	}
	.img_cont_msg{
			height: 40px;
			width: 40px;
	}
	.online_icon{
		position: absolute;
	    height: 15px;
	    width: 15px;
	    background-color: #4cd137;
	    border-radius: 50%;
	    bottom: 2.2em;
	    right: 1.4em;
	    border: 1.5px solid white;
	}
	.offline{
		background-color: #c23616 !important;
	}
	.user_info span{
		font-size: 20px;
		color: white;
	}
	@media only screen and (max-width: 768px){
	.user_info span{
		font-size: 17px;
	}
}
	.user_info p{
	font-size: 12px;
    color: white;
    width: 200px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
	}
	.video_cam{
		margin-left: 50px;
		margin-top: 5px;
	}
	.video_cam span{
		color: white;
		font-size: 20px;
		cursor: pointer;
		margin-right: 20px;
	}
	.msg_cotainer{
		margin-top: auto;
		margin-bottom: auto;
		margin-left: 10px;
		border-radius: 10px;
		min-width: 200px;
		background-color: #5c383f;
		padding: 10px;
		position: relative;
	}
	.msg_cotainer_send{
		margin-top: auto;
		margin-bottom: auto;
		margin-right: 10px;
		border-radius: 10px;
		background-color: #f08089;
		min-width: 200px;
		padding: 18px;
		position: relative;
	}
	.msg_time{
		position: absolute;
		left: 13px;
		bottom: -23px;
		color: white;
		font-size: 10px;
	}
	@media only screen and (max-width: 768px){
	.msg_time{
		position: absolute;
		left: 13pxpx;
		bottom: -23px;
		color: white;
		font-size: 10px;
	}
}

	.msg_time_send{
		position: absolute;
    right: 16px;
    bottom: -23px;
    color: white;
    font-size: 10px;
	}
	.msg_head{
		position: relative;
	}
	@media(max-width: 576px){
	.contacts_card{
		margin-bottom: 15px !important;
	}
	}
</style>