<!DOCTYPE html>
<html>
<head>
	<title>Travels</title>
	<link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="{{asset('public/frontend/css/bootstrap.min.css')}}">

	<link rel="stylesheet" href="{{asset('public/frontend/css/login_register.css')}}">
	
	<link rel="stylesheet" href="{{asset('public/frontend/css/custom.css')}}">
	<link rel="stylesheet" href="{{asset('public/frontend/css/responsive.css')}}">
	<style>
		p { margin: 0 0 5px; }
		.form-group { margin-bottom: 0px;}
		.alert { padding: 5px; margin-bottom: 5px;}
	</style>
</head>
<body style="color:#fff;">
	
<div class="main-section">
	<div class="main-map-section">
		<input type="hidden" value="{{URL::to('/')}}" id="url-get">
		<video autoplay muted loop id="myVideo">
		  <source src="{{asset('public/frontend/video/background.mp4')}}" type="video/mp4">
		</video>	
	</div>