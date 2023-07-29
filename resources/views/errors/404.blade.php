@extends('frontend.layouts.front-app-home')
@section('title')
<title>404 - Baeecay</title>
@endsection
@section('content')
<style type="text/css">
	
/*======================
    404 page
=======================*/


.page_404{ padding:40px 0; background:#fff; font-family: 'Arvo', serif;
}

.page_404  img{ width:100%;}

.four_zero_four_bg{
 
 background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif);
height: 400px;
background-position: center;
width: 50%;
text-align: center;
margin: auto;
 }
 
 
 .four_zero_four_bg h1{
 font-size:80px;
 color: black;
 }
 
  .four_zero_four_bg h3{
			 font-size:80px;
			 color: black;
			 }
			 
			 .link_404{			 
	color: #fff!important;
    padding: 10px 20px;
    background: #39ac31;
    margin: 20px 0;
    display: inline-block;}
	.contant_box_404{ margin-top:-50px;}
</style>
<section class="page_404 about-us-contents">
	<div class="container">
		<div class="row">	
		<div class="col-sm-12 ">
		<div class="col-sm-12  text-center">
		<div class="four_zero_four_bg">
			<h1 class="text-center ">404</h1>
		
		
		</div>
		
		<div class="contant_box_404">
		<h3 style="color: black;" class="h2">
			Oh no!!
		</h3>
		
		<p style="color: black;">You’re either misspelling the URL</p>
		<p style="color: black;">or requesting a page that's no longer here.</p>
		<div style="margin-bottom: 100px;" class="about-us-btn">
            <a style=" color: #fff; background-image: linear-gradient(to right, #E1505E , #F88F96); padding: 8px 25px; font-weight: 700; border-radius: 4px; " href="{{ url('') }}">Home</a>
        </div>
	</div>
		</div>
		</div>
		</div>
	</div>
</section>


@endsection