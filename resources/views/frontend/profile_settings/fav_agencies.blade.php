@extends('frontend.layout.app')
@push('css-style')
	<link href="{{asset('public/css/map.css')}}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/css/dropdown_com.css')}}" />
	
	<link rel="stylesheet" href="{{asset('public/frontend/css/pages/aside_right_chat.css')}}" />
	<link href="{{asset('public/backend/css/style.min_2.css')}}" rel="stylesheet" />

	<link rel="stylesheet" href="{{asset('public/frontend/css/profile_settings/personal_information.css')}}">
	<link rel="stylesheet" href="{{asset('public/frontend/css/profile_settings/notifications.css')}}">
	<link rel="stylesheet" href="{{asset('public/frontend/css/profile_settings/friend_request.css')}}">
	
	
@endpush
@section('content')
@include('frontend._partials.nav')
<style>
	
	.right-section{padding: 0px !important;border: 1px solid #fff;border-bottom: none;border-top: none;border-right: none;height: 582px;z-index: 10;position: fixed;right: 5px;top: 55px;width: 285px;
	}
	.friend-header-thumb {
	    border-bottom: 1px solid #e6ecf5;
	    overflow: hidden;
	    height: 90px;
	}
	.friend-item {
	    border-radius: 5px;
	    overflow: hidden;
	}
	.friend-item-content {
	    padding: 0 25px 25px 25px;
	    text-align: center;
	    position: relative;
	}
	.friend-item-content .more {
	    z-index: 5;
	    position: absolute;
	    right: 150px;
	    top: 50px;
	    font-size: 16px;
	    padding: 10px;
	}
	.fa-ellipsis-h {
	    font-size: 15px;
	    color: #a1a3a6;
	}
	.friend-avatar {margin-top: -49px;position: relative;margin-bottom: 8px;}
	.friend-avatar .author-thumb {margin: 0 auto; height: 75px; width: 75px;margin-bottom: 10px;}
	.author-thumb {display: inline-block;position: relative;}
	.friend-avatar .author-thumb img {border: 4px solid #fff;}
	.author-thumb img {border-radius: 100%;overflow: hidden;max-width: 75px;max-height: 75px;}
	.more .dropdown-menu li a:hover {color: #ff5e3a;background-color: #fff;}
	.author-name{font-weight: bold;}
	.author-name:hover {color: #ff5e3a;}

		  
</style>


<section class="profile_page">
	 <div class="container-fluid">
	 	<div class="row">
	 		<div class="col-md-10 profile-left-section">
				<div class="row">
					<div class="col-md-3">
						@include('frontend.common.profile_setting_left')
					</div>
					<div class="col-md-9">
						<div class="row" style="display: flex;flex-wrap: wrap;margin-right: -10px;margin-left: -25px;">
							<div class="col-md-3">
								<div class="profileSet-ui-block">
									<div class="friend-item">
										<div class="friend-header-thumb">
											<img src="public/frontend/img/friend1.jpg" alt="friend">
										</div>

										<div class="friend-item-content">

											<div class="more dropdown">
												<i class="fa fa-ellipsis-h dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
												<ul class="dropdown-menu">
													<li>
														<a href="#">Unlike</a>
													</li>
													<li>
														<a href="#">Report</a>
													</li>
												</ul>
											</div>
											<div class="friend-avatar">
												<div class="author-thumb">
													<img src="public/frontend/img/avatar1.jpg" alt="author">
												</div>
												<div class="author-content">
													<a href="#" class="h5 author-name">Nicholas Grissom</a>
													<div class="country">San Francisco, CA</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="profileSet-ui-block">
									<div class="friend-item">
										<div class="friend-header-thumb">
											<img src="public/frontend/img/friend1.jpg" alt="friend">
										</div>

										<div class="friend-item-content">

											<div class="more dropdown">
												<i class="fa fa-ellipsis-h dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
												<ul class="dropdown-menu">
													<li>
														<a href="#">Unlike</a>
													</li>
													<li>
														<a href="#">Report</a>
													</li>
												</ul>
											</div>
											<div class="friend-avatar">
												<div class="author-thumb">
													<img src="public/frontend/img/avatar1.jpg" alt="author">
												</div>
												<div class="author-content">
													<a href="#" class="h5 author-name">Nicholas Grissom</a>
													<div class="country">San Francisco, CA</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="profileSet-ui-block">
									<div class="friend-item">
										<div class="friend-header-thumb">
											<img src="public/frontend/img/friend1.jpg" alt="friend">
										</div>

										<div class="friend-item-content">

											<div class="more dropdown">
												<i class="fa fa-ellipsis-h dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
												<ul class="dropdown-menu">
													<li>
														<a href="#">Unlike</a>
													</li>
													<li>
														<a href="#">Report</a>
													</li>
												</ul>
											</div>
											<div class="friend-avatar">
												<div class="author-thumb">
													<img src="public/frontend/img/avatar1.jpg" alt="author">
												</div>
												<div class="author-content">
													<a href="#" class="h5 author-name">Nicholas Grissom</a>
													<div class="country">San Francisco, CA</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="profileSet-ui-block">
									<div class="friend-item">
										<div class="friend-header-thumb">
											<img src="public/frontend/img/friend1.jpg" alt="friend">
										</div>

										<div class="friend-item-content">

											<div class="more dropdown">
												<i class="fa fa-ellipsis-h dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
												<ul class="dropdown-menu">
													<li>
														<a href="#">Unlike</a>
													</li>
													<li>
														<a href="#">Report</a>
													</li>
												</ul>
											</div>
											<div class="friend-avatar">
												<div class="author-thumb">
													<img src="public/frontend/img/avatar1.jpg" alt="author">
												</div>
												<div class="author-content">
													<a href="#" class="h5 author-name">Nicholas Grissom</a>
													<div class="country">San Francisco, CA</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-3">
								<div class="profileSet-ui-block">
									<div class="friend-item">
										<div class="friend-header-thumb">
											<img src="public/frontend/img/friend1.jpg" alt="friend">
										</div>

										<div class="friend-item-content">

											<div class="more dropdown">
												<i class="fa fa-ellipsis-h dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
												<ul class="dropdown-menu">
													<li>
														<a href="#">Unlike</a>
													</li>
													<li>
														<a href="#">Report</a>
													</li>
												</ul>
											</div>
											<div class="friend-avatar">
												<div class="author-thumb">
													<img src="public/frontend/img/avatar1.jpg" alt="author">
												</div>
												<div class="author-content">
													<a href="#" class="h5 author-name">Nicholas Grissom</a>
													<div class="country">San Francisco, CA</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="profileSet-ui-block">
									<div class="friend-item">
										<div class="friend-header-thumb">
											<img src="public/frontend/img/friend1.jpg" alt="friend">
										</div>

										<div class="friend-item-content">

											<div class="more dropdown">
												<i class="fa fa-ellipsis-h dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
												<ul class="dropdown-menu">
													<li>
														<a href="#">Unlike</a>
													</li>
													<li>
														<a href="#">Report</a>
													</li>
												</ul>
											</div>
											<div class="friend-avatar">
												<div class="author-thumb">
													<img src="public/frontend/img/avatar1.jpg" alt="author">
												</div>
												<div class="author-content">
													<a href="#" class="h5 author-name">Nicholas Grissom</a>
													<div class="country">San Francisco, CA</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
	 		</div>
	 		<div class="col-md-2 right-section">
	 			@include('frontend.common.aside_right_chat')
	 		</div>
	 	</div>
	 </div>
</section>
  
  @push('js')
  <script>
  	$(function(){
  	 $(".dropdown").hover(            
  	         function() {
  	             $('.dropdown-menu', this).stop( true, true ).fadeIn("fast");
  	             $(this).toggleClass('open');
  	             $('b', this).toggleClass("caret caret-up");                
  	         },
  	         function() {
  	             $('.dropdown-menu', this).stop( true, true ).fadeOut("fast");
  	             $(this).toggleClass('open');
  	             $('b', this).toggleClass("caret caret-up");                
  	         });
  	 });
  	 
  </script>

@endpush
@endsection