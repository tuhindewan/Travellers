
	
@extends('frontend.layout.app')
@push('css-style')
	
	<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/css/dropdown_com.css')}}" />

	<link rel="stylesheet" href="{{asset('public/frontend/css/pages/post_type_page.css')}}" />
	<link rel="stylesheet" href="{{asset('public/frontend/css/pages/post_page.css')}}" />
	<link rel="stylesheet" href="{{asset('public/css/like/like.css')}}">

	<!-- <link rel="stylesheet" href="{{asset('public/css/dialog.css')}}" /> -->
	<link rel="stylesheet" href="{{asset('public/frontend/css/pages/aside_right_chat.css')}}" />
	<link href="{{asset('public/backend/css/style.min_2.css')}}" rel="stylesheet" />
	<link rel="stylesheet" href="{{asset('public/frontend/css/profile_settings/personal_information.css')}}">
	<link rel="stylesheet" href="{{asset('public/frontend/css/profile_settings/notifications.css')}}">
	<!-- <link rel="stylesheet" href="{{asset('public/frontend/css/profile_settings/friend_request.css')}}"> -->
	<link rel="stylesheet" href="{{asset('public/frontend/css/new/profile_settings/all_search_list.css')}}">
	
	<style>
	.notification-list.friend-requests .search-event { width: 90%;}
	.fb-image-lg{width: 100%; height: 100%;}
	.right-section{padding: 0px !important;border: 1px solid #fff;border-bottom: none;border-top: none;border-right: none;height: 582px;z-index: 10;position: fixed;right: 5px;top: 55px;width: 285px;
	}
	.aside-right{position: fixed;}
	.popover{ min-width: 330px !important;/*top: 228px !important;
    left: 355.805px!important;*/
    display: block;min-height: 220px !important;}
    .popover.bottom>.arrow {
        top: -11px;
        left: 40% !important;
        margin-left: -11px;
        padding: 0px;
        border-top-width: 0;
        border-bottom-color: #999;
        border-bottom-color: rgba(0,0,0,.25);
    }
    .popover-content{padding: 0px;}
    .fb-image-lg{width: 100%;margin-top: -30px;z-index: 0;height: 110px;}
    .fb-image-profile {
        margin: -20px 10px 0px 5px;
        z-index: 9;
        width: 20%;
        border-radius: 50%;
    }
    .popover-username{position: absolute;
    color: #000;
    top: 25%;
    left: 25%;
    font-size: 15px;
    font-weight: bold;}
    .popover-userinfo{position: absolute;
    color: #fff;
    top: 57%;
    left: 25%;}
    .popover-mutual{margin-top: 20px;padding-top: 90px;padding-left: 81px;}
    .popover-live{margin-left: 80px;}
    .popover-place{margin-left: 82px;}
    .popover-friend{width: 85px; margin: 0px auto; margin-top: 10px;}
    .accept-request svg {
    width: 14px;
    height: 14px;
}

.fb-profile{position: absolute;left: 0%;}

</style>

@endpush
@section('content')
@include('frontend._partials.nav')



<section class="profile_page" style="margin-top: 55px;">
	 <div class="container-fluid">
	 	<div class="row">
	 		<div class="col-md-9 profile-left-section">
				<nav class="navbar navbar-default navbar-xs search-navbar" role="navigation">
				  <!-- Brand and toggle get grouped for better mobile display -->
				  <div class="navbar-header">
				    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				      <span class="sr-only">Toggle navigation</span>
				      <span class="icon-bar"></span>
				      <span class="icon-bar"></span>
				      <span class="icon-bar"></span>
				    </button>
				  </div>

				  <!-- Collect the nav links, forms, and other content for toggling -->
				  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="margin-top: 10px;padding-left: 80px;">
				    <ul class="nav navbar-nav nav-tabs" role="tablist" >
					    <li role="presentation" class="active"><a href="#all" role="tab" data-toggle="tab"><i class="fa fa-globe" aria-hidden="true"></i> All</a></li>
					    <li role="presentation"><a href="#post" role="tab" data-toggle="tab"><i class="fa fa-envelope-o" aria-hidden="true"></i> Posts</a></li>
					    <li role="presentation"><a href="#people" role="tab" data-toggle="tab"><i class="fa fa-fw fa-users"></i> People</a></li>
					    <!-- <li role="presentation"><a href="#photos" role="tab" data-toggle="tab"><i class="fa fa-fw fa-image"></i> Photos</a></li>
					    <li role="presentation"><a href="#videos" role="tab" data-toggle="tab"><i class="fa fa-file-video-o" aria-hidden="true"></i> Videos</a></li>
					    <li role="presentation"><a href="#agencies" role="tab" data-toggle="tab"><i class="fa fa-file-text-o" aria-hidden="true"></i> Agencies</a></li> -->
				    </ul>
				  </div><!-- /.navbar-collapse -->
				</nav>

				<div class="row">
					<div class="col-md-3">
						<!-- <div class="profileSet-ui-block">
							<div class="your-profile">
								<div class="profileSet-ui-block-title profileSet-ui-block-title-small">
									<h6 class="title">Filter Results</h6>
								</div>
						
								<div id="accordion" role="tablist" aria-multiselectable="true">
									<div class="card">
										<div class="card-header chat-card-header" role="tab" id="headingOne">
											<h6 class="mb-0">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
													Posted By
												</a>
											</h6>
										</div>
						
										<div role="tabpanel" aria-labelledby="headingOne">
											<form style="margin-left: 25px;">
											    <div class="radio">
											      <label class="filterlist"><input style="margin-top: 2px;" type="radio" name="optradio" checked="checked">Anyone</label>
											    </div>
											    <div class="radio">
											      <label class="filterlist" ><input style="margin-top: 2px;"  type="radio" name="optradio">You</label>
											    </div>
											    <div class="radio">
											      <label class="filterlist"><input style="margin-top: 2px;" type="radio" name="optradio">Your Friends</label>
											    </div>
											    <div class="radio">
											      <label class="filterlist"><input style="margin-top: 2px;" type="radio" name="optradio">Agencies</label>
											    </div>
											    <div class="radio">
											      <label class="filterlist"><input style="margin-top: 2px;" type="radio" name="optradio">Admins</label>
											    </div>
											 </form>
										</div>
									</div>
									<div class="card">
										<div class="card-header chat-card-header" role="tab" id="headingOne">
											<h6 class="mb-0">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
													Tagged Location
												</a>
											</h6>
										</div>
						
										<div role="tabpanel" aria-labelledby="headingOne">
											<form style="margin-left: 25px;">
											    <div class="radio">
											      <label class="filterlist"><input style="margin-top: 2px;" type="radio" name="optradio" checked="checked">Anywhere</label>
											    </div>
											    <div class="radio">
											      <label class="filterlist" ><input style="margin-top: 2px;"  type="radio" name="optradio">will appeared last visited place</label>
											    </div>
											    <div class="radio">
											      <label class="filterlist" ><input style="margin-top: 2px;"  type="radio" name="optradio">will appeared last visited place</label>
											    </div>
											    <div class="radio tag-location-search">
											      <button type="button" class="btn btn-tag-location btn-xs"><i class="fa fa-plus-circle" style="font-size: 14px;" aria-hidden="true"></i> Choose a Location</button>
											    </div>
											 </form>
										</div>
									</div>
						
									<div class="card">
										<div class="card-header chat-card-header" role="tab" id="headingOne">
											<h6 class="mb-0">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
													Date Posted
												</a>
											</h6>
										</div>
						
										<div role="tabpanel" aria-labelledby="headingOne">
											<form style="margin-left: 25px;">
											    <div class="radio">
											      <label class="filterlist"><input style="margin-top: 2px;" type="radio" name="optradio" checked="checked">Any Date</label>
											    </div>
											    <div class="radio">
											      <label class="filterlist" ><input style="margin-top: 2px;"  type="radio" name="optradio">2017</label>
											    </div>
											    <div class="radio">
											      <label class="filterlist" ><input style="margin-top: 2px;"  type="radio" name="optradio">2016</label>
											    </div>
											    <div class="radio">
											      <label class="filterlist" ><input style="margin-top: 2px;"  type="radio" name="optradio">2015</label>
											    </div>
											    <div class="radio tag-date-search">
											      <button type="button" class="btn btn-tag-date btn-xs"><i class="fa fa-plus-circle" style="font-size: 14px;" aria-hidden="true"></i> Choose a Date</button>
											    </div>
											 </form>
										</div>
									</div>
						
									<div class="card">
										<div class="card-header chat-card-header" role="tab" id="headingOne">
											<h6 class="mb-0">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
													City
												</a>
											</h6>
										</div>
						
										<div role="tabpanel" aria-labelledby="headingOne">
											<form style="margin-left: 25px;">
											    <div class="radio">
											      <label class="filterlist"><input style="margin-top: 2px;" type="radio" name="optradio" checked="checked">Anywhere</label>
											    </div>
											    <div class="radio">
											      <label class="filterlist" ><input style="margin-top: 2px;"  type="radio" name="optradio">will appeared last visited place</label>
											    </div>
											    <div class="radio">
											      <label class="filterlist" ><input style="margin-top: 2px;"  type="radio" name="optradio">will appeared last visited place</label>
											    </div>
											    <div class="radio tag-city-search">
											      <button type="button" class="btn btn-tag-city btn-xs"><i class="fa fa-plus-circle" style="font-size: 14px;" aria-hidden="true"></i> Choose a City</button>
											    </div>
											 </form>
										</div>
									</div>
						
									<div class="card">
										<div class="card-header chat-card-header" role="tab" id="headingOne">
											<h6 class="mb-0">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
													Mutual Friends
												</a>
											</h6>
										</div>
						
										<div role="tabpanel" aria-labelledby="headingOne">
											<form style="margin-left: 25px;">
											    <div class="radio">
											      <label class="filterlist"><input style="margin-top: 2px;" type="radio" name="optradio" checked="checked">Anyone</label>
											    </div>
											    <div class="radio">
											      <label class="filterlist" ><input style="margin-top: 2px;"  type="radio" name="optradio">Friends</label>
											    </div>
											    <div class="radio">
											      <label class="filterlist" ><input style="margin-top: 2px;"  type="radio" name="optradio">Friends of Friends</label>
											    </div>
											    <div class="radio tag-friends-search">
											      <button type="button" class="btn btn-tag-friends btn-xs"><i class="fa fa-plus-circle" style="font-size: 14px;" aria-hidden="true"></i> Mutuak Friends With</button>
											    </div>
											 </form>
										</div>
									</div>
								</div>
							</div>
						</div> -->
						
						
					</div>
					
	<div class="col-md-9">
		<div class="tab-content">
			<div class="tab-pane active" id="all">
				@if(count($getUser) == 0 && count($getPosts) == 0 )
				<div class="panel panel-default">
				  <div class="panel-body no_results">
				    <img src="{{asset('public/img/no-results.png')}}" alt=""> <span>We couldn't find anything for <mark>{{ $search }}</mark></span>
				  </div>
				</div>
				@endif
				@if(count($getUser)>0)
				<div class="profileSet-ui-block">
					<div class="profileSet-ui-block-title" style="border-bottom: 1px solid #e6ecf5;">
						<h6 class="title" style="width: 725px;"><i class="fa fa-fw fa-users"></i> People</h6>
						
					</div>
					
					<ul class="notification-list friend-requests">
						@foreach($getUser as $user )
						<?php 
							if($user->profile_image=='' && $user->gender == 'Mr'){
								$image = url('/public/frontend/img/user.jpg');

							}elseif($user->profile_image=='' && $user->gender != 'Mr'){
								$image = url('/public/frontend/images/Anonymous_female.png');
							}else{
								$image = url('/')."/images/users/profile/s160$user->profile_image";
							}
						 	 
						?>
						<li>
							<div class="row" style="width:100%;">
								<div class="col-sm-2 col-md-1">
									<div class="author-thumb">
										<img src="<?php echo $image; ?>" height="45px;" width="45px;" alt="author">
									</div>	
								</div>
								<div class="col-sm-6 col-md-7">
									<div class="search-name">
										<user-link :userinfo="{{ json_encode($user) }}":highlight="{{ json_encode($search) }}"></user-link>
									</div>	
									<div>
										<p><i class="fa fa-home"></i>
	                                    <span>Lives in 
	                                    <a class="capitalize">{{ $user->current_city['city_name'] }}</a></span></p>
									</div>
								</div>
								<div class="col-sm-4">
									<span class="notification-icon">
										<relationship class="pull-right" :userid="{{ json_encode($user->_id) }}"></relationship>
									</span>	
								</div>
							</div>
							
						</li>


						@endforeach
					</ul>
					<div class="profileSet-ui-block-title" style="border: none;">
						<a href="#people" class="title" style="width: 725px;text-align: center;">See All</a>
					</div>
				</div>
				@endif
				
				@if(count($getPosts)>0)
				<div class="profileSet-ui-block">
					<div class="profileSet-ui-block-title" style="border-bottom: 1px solid #e6ecf5;">
						<h6 class="title" style="width: 725px;"><i class="fa fa-fw fa-file-text-o"></i> Posts</h6>
						
					</div>

					<ul class="notification-list friend-requests">
						@foreach($getPosts as $post)
						<?php $image = $post->users['profile_image']; ?>
						<li>
							<div class="row" style="width: 100%;">
								
								<div class="col-sm-12">
									<div class="search-event single_post_top">
										<div class="author-thumb user_profile" style="width: 9%;">
											<img src='{{asset("images/users/profile/s160$image")}}' alt="author">
										</div>
										
										<user-link :userinfo="{{ json_encode($post->users) }}"></user-link>
										<div>
											<?php 
											$username = $post->users->username;
											$created_at = $post->created_at;
										    $cls_date = new DateTime($created_at); 
											$time= $cls_date->format('F j, Y');

											 ?>
											<a href='{{URL::to("/$username/posts/$post->_id")}}' class="show_time">{{ $time }}</a>
										</div>
										
									</div>
									<div class="chat-message-item single_post_body">
									<?php

									$str = $post->description;
									$keyword = $search;
									echo str_ireplace($keyword, '<span style="color: #daa732;">'.$keyword.'</span>', $str);
									 
									?>
										
									</div>
									
								</div>
							</div>
							
						</li>
						@endforeach
						

					</ul>

					<div class="profileSet-ui-block-title" style="border: none;">
						<a href="#post" class="title" style="width: 725px;text-align: center;">See All</a>
					</div>

				</div>
				@endif


			</div>

			<div class="tab-pane" id="people">
				@if(count($getUser) == 0)
				<div class="panel panel-default">
				  <div class="panel-body no_results">
				    <img src="{{asset('public/img/no-results.png')}}" alt=""> <span>We couldn't find user for <mark>{{ $search }}</mark></span>
				  </div>
				</div>
				@endif
				@if(count($getUser)>0)
				<div class="profileSet-ui-block">
					<div class="profileSet-ui-block-title" style="border-bottom: 1px solid #e6ecf5;">
						<h6 class="title" style="width: 725px;"><i class="fa fa-fw fa-users"></i> People</h6>
						
					</div>
					
					<ul class="notification-list friend-requests">
						@foreach($getUser as $user )
						<?php 
						 	$image = url('/')."/images/users/profile/s160$user->profile_image"; 
						?>
						<li>
							<div class="row" style="width:100%;">
								<div class="col-sm-2 col-md-1">
									<div class="author-thumb">
										<img src="<?php echo $image; ?>" height="45px;" width="45px;" alt="author">
									</div>	
								</div>
								<div class="col-sm-6 col-md-7">
									<div class="search-name">
										<user-link :userinfo="{{ json_encode($user) }}":highlight="{{ json_encode($search) }}"></user-link>
									</div>	
								</div>
								<div class="col-sm-4">
									<span class="notification-icon">
										<relationship class="pull-right" :userid="{{ json_encode($user->_id) }}"></relationship>
									</span>	
								</div>
							</div>

						</li>
						@endforeach
					</ul>
					<div class="profileSet-ui-block-title" style="border: none;">
						<a href="#people" class="title" style="width: 725px;text-align: center;">See All</a>
					</div>
				</div>
				@endif
				
			</div>

			<div class="tab-pane" id="post">
				@if(count($getPosts) == 0)
				<div class="panel panel-default">
				  <div class="panel-body no_results">
				    <img src="{{asset('public/img/no-results.png')}}" alt=""> <span>We couldn't find post for <mark>{{ $search }}</mark></span>
				  </div>
				</div>
				@endif
				@if(count($getPosts)>0)
				<div class="profileSet-ui-block">
					<div class="profileSet-ui-block-title" style="border-bottom: 1px solid #e6ecf5;">
						<h6 class="title" style="width: 725px;"><i class="fa fa-fw fa-file-text-o"></i> Posts</h6>
						
					</div>

					<ul class="notification-list friend-requests">
						@foreach($getPosts as $post)
						<?php $image = $post->users['profile_image']; ?>
						<li>
							<div class="author-thumb">
								<img src='{{asset("images/users/profile/s160$image")}}' alt="author">
							</div>
							<div class="search-event">
								
								<user-link :userinfo="{{ json_encode($post->users) }}"></user-link>

								<span class="chat-message-item"><?php

								$str = $post->description;
								$keyword = $search;
								echo str_ireplace($keyword, '<span style="color: #daa732;">'.$keyword.'</span>', $str);
								 
								?></span>
							</div>
							
						</li>
						@endforeach
						

					</ul>

					<div class="profileSet-ui-block-title" style="border: none;">
						<a href="#post" class="title" style="width: 725px;text-align: center;">See All</a>
					</div>

				</div>
				@endif
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


@endsection