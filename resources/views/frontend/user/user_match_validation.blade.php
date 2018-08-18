<!DOCTYPE html>
<html>
<head>
	<title>Travels</title>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="{{asset('public/frontend/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/css/dropdown_com.css')}}" />
	
	<link rel="stylesheet" href="{{asset('public/frontend/css/login_register.css')}}">
	<link rel="stylesheet" href="{{asset('public/frontend/css/responsive.css')}}">
	
	<link rel="stylesheet" href="{{asset('public/frontend/css/custom.css')}}">
	<style>
		p { margin: 0 0 5px; }
		.form-group { margin-bottom: 0px;}
	</style>
</head>
<body style="color:#fff;">
	
<div class="main-section">
	<div class="main-map-section">
		<video autoplay muted loop id="myVideo">
		  <source src="{{asset('public/frontend/video/background.mp4')}}" type="video/mp4">
		</video>	
	</div>
	<div class="main-map-bottom">
		<div class="container">
			<div class="verification-section">
				<div class="row">
					<div class="col-sm-3">
						@include('frontend._partials.logo')		
					</div>
					<div class="col-sm-6">
						<div class="verification">
							<div class="overlay" style="border-radius: unset; min-height: 210px;"></div>
							<div class="verification-form">
								{!! Form::open(array('url' => 'users.check-code','class'=>'form-horizontal','method'=>'POST','files'=>'true')) !!} 
								{!! csrf_field() !!}
									<div class="verification-title">
										<div class="verification-heading">Enter Security Code</div>
										
										<div class="verification-body">
											<p>Please check your email for a message with your code. Your code is 4 numbers long</p>
										    <div class="row">
										    	<div class="col-md-6">
										    		<input type="hidden" name="id" class="id" value="{{$getUser->_id}}">
										    		<input type="hidden" name="email" class="userEmail" value="{{$getUser->email}}">
										    		<div class="form-group" style="margin-left: 0;">
													    <input type="text" name="code" class="form-control" id="code" placeholder="Type Code..." required>
													</div>
													<div id="message"></div>
													@if(Session::has('error'))
														<span style="color:red">{!! Session::get('error')!!}</span>
													@endif

										    	</div>
										    	<div class="col-md-6">
										    		<div class="confirm_email text-right">
										    			<p>We sent your code to:</p>
										    			<?php 
										    				$email = $getUser->email;
										    				$emailExp  = explode('@', $email);
										    				$emailPart1 = $emailExp[0];
										    				$emailPart2 = $emailExp[1];
										    				$emailcharFirst = $emailPart1[0]; 	
										    				$emailcharLast = substr($emailPart1, -1); 
										    				$emailExm = $emailcharFirst."******".$emailcharLast;

										    			 ?>
										    			<p>{{$emailExm.'@'.$emailPart2}}</p>
										    		</div>
										    	</div>
										    </div>
										</div>

										<div class="verification-footer">
											<div class="row">
												<div class="col-md-7">
													<a href="#" class="sendCode">Resend a code.</a>
												</div>
										    	<div class="col-md-5 pull-right">
										    		<button type="submit" class="btn btn-success btn-sm" style="    margin-left: 30px;">Continue</button>
										    		
										    		<a href="{{URL::to('index')}}" class="btn btn-default btn-sm" style="float: right;">Cancel</a>
										    	</div>	
											</div>
										</div>
									</div>
								{!! Form::close(); !!}
								
							</div>
							
						</div>
					</div>
					<div class="col-sm-1"></div>
					<div class="col-sm-2">
						<div class="home_profile">
							<div id="dl-menu" class="dl-menuwrapper">
								<button>
									<div class="home_profile_overlay"></div>
									<img class="min_profile_home" src="{{asset('public/frontend/img/user.jpg')}}" alt=""> {{$getUser->username}}  <i class="fa fa-chevron-down" aria-hidden="true"></i>
								</button>
								<ul class="dl-menu">
									<li><a href="{{URL::to('users/logout')}}" class="last">Logout</a> </li>
									<div class="home_submenu_overlay"></div>
								</ul>
							</div><!-- /dl-menuwrapper -->
							
						</div>
					</div>
				</div>
			</div>
				
		</div>
		<footer class="index_footer">
			<div class="footer_contianer">
				<div class="footer_overlay"></div>
				<div class="container">
					<div class="footer_top">
						<div class="row">
							<div class="col-md-10">
								
								<nav class="footer_nav">
									<ul>
										<li><a href="">Places</a></li>
										<li><a href="">Locations</a></li>
										<li><a href="{{URL::to('redirect-login-page')}}">Find Friends</a></li>
										<li><a href="" >Host a Travel</a></li>
										<li><a href="" >Mobile</a></li>
										<li><a href="{{URL::to('faqs-section')}}">FAQs</a></li>
										<li><a href="">Contact</a></li>
										<li><a href="{{URL::to('termsofuse')}}">Terms and Conditions</a></li>
										<li><a href="{{URL::to('privacy-policy')}}">Privacy and Policy</a></li>
									</ul>
								</nav>
									
							</div>
							<div class="col-md-2"><p class="copy-right">@ Adea 2018</p></div>
						</div>	
					</div>
					
				</div>
				
			</div>
		</footer>
	</div>
</div>

	



<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script src="{{asset('public/frontend/js/modernizr.custom.js')}}"></script>
<script src="{{asset('public/frontend/js/jquery.dlmenu.js')}}"></script>
<script>
	$(function() {
		$( '#dl-menu' ).dlmenu({
			animationClasses : { in : 'dl-animate-in-4', out : 'dl-animate-out-4' }
		});
	});
</script>
<script>
	$(".sendCode").click(function(){
		id = $(".id").val();
		_token = $('input[name="_token"]').val();
		userEmail = $('.userEmail').val();
		$.ajax({
			url: "{{URL::to('/')}}"+'/users/re-generate-code',
          	type: "post",
          	data: {_token : _token,
          		id:id,
          		email:userEmail
          		},
          	success:function(result)
          	{
            	console.log(result);
            
	          	if(result == 'success'){
	                $("#message").html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>An Activation Code Send Your Email .This code active in 24 hours</b></div>');
	            }
	            else
	            {
	                $("#message").html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>'+result+'</b></div>');
	            }
	        }
	        
        });
	});
</script>
	
</body>
</html>