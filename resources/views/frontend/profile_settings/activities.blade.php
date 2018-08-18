@extends('frontend.layout.app')
@push('css-style')
	<link href="{{asset('public/css/map.css')}}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/css/dropdown_com.css')}}" />
	
	<link rel="stylesheet" href="{{asset('public/frontend/css/pages/aside_right_chat.css')}}" />
	<link href="{{asset('public/backend/css/style.min_2.css')}}" rel="stylesheet" />

	<link rel="stylesheet" href="{{asset('public/frontend/css/profile_settings/personal_information.css')}}">
	<link rel="stylesheet" href="{{asset('public/frontend/css/profile_settings/notifications.css')}}">
	<link rel="stylesheet" href="{{asset('public/frontend/css/profile_settings/notifications.css')}}">
	<link rel="stylesheet" href="{{asset('public/frontend/css/profile_settings/friend_request.css')}}">
	
	
@endpush
@section('content')
@include('frontend._partials.nav')
<style>
	
	.right-section{padding: 0px !important;border: 1px solid #fff;border-bottom: none;border-top: none;border-right: none;height: 582px;z-index: 10;position: fixed;right: 5px;top: 55px;width: 285px;
	}
	

		  
</style>


<section class="profile_page" style="margin-top: 55px">
	 <div class="container-fluid">
	 	<div class="row">
	 		<div class="col-md-10 profile-left-section">
				<div class="row">
					<div class="col-md-3">
						@include('frontend.common.profile_setting_left')
					</div>
					<div class="col-md-9">
						<div class="profileSet-ui-block">
							<div class="profileSet-ui-block-title" style="border-bottom: 1px solid #e6ecf5;">
								<h6 class="title" style="width: 725px;">Your recent activities</h6>
								<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
							</div>

							<ul class="notification-list">
							@foreach($notis as $noti)
								@if($noti['type']==1)
									<li class="un-read">
											<span><i class="fa fa-user-plus" aria-hidden="true" style="font-size: 17px;padding-bottom: 17px;color: #5972aa" ></i></span>
										<div class="notification-event">
											<?php $s_id = $noti['sender']; $n_id = $noti['_id'];?>
											You and <a href="{{URL::to('view_profile')}}/{{$s_id}}/{{$n_id}}" class="h6 notification-friend">{{ $noti->senderuser['firstname'] }} {{ $noti->senderuser['middlename'] }} {{ $noti->senderuser['lastname'] }}</a> just became friends.
											<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">{{$noti['created_at']->diffForHumans()}}</time></span>
										</div>
											<span class="notification-icon">
												<svg class="olymp-happy-face-icon"><use xlink:href="icons/icons.svg#olymp-happy-face-icon"></use></svg>
											</span>

										<div class="more">
											<svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg>
											<svg class="olymp-little-delete"><use xlink:href="icons/icons.svg#olymp-little-delete"></use></svg>
										</div>
									</li>
								@endif
								<!-- <li>
									<div class="author-thumb">
										<img src="public/frontend/img/avatar1-sm.jpg" alt="author">
									</div>
									<div class="notification-event">
										<a href="#" class="h6 notification-friend">Mathilda Brinker</a> commented on your new <a href="#" class="notification-link">profile status</a>.
										<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">4 hours ago</time></span>
									</div>
										<span class="notification-icon">
											<svg class="olymp-comments-post-icon"><use xlink:href="icons/icons.svg#olymp-comments-post-icon"></use></svg>
										</span>
								
									<div class="more">
										<svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg>
										<svg class="olymp-little-delete"><use xlink:href="icons/icons.svg#olymp-little-delete"></use></svg>
									</div>
								</li>
								
								
								
								<li class="with-comment-photo">
									<div class="author-thumb">
										<img src="public/frontend/img/avatar3-sm.jpg" alt="author">
									</div>
									<div class="notification-event">
										<a href="#" class="h6 notification-friend">Sarah Hetfield</a> commented on your <a href="#" class="notification-link">photo</a>.
										<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">Yesterday at 5:32am</time></span>
									</div>
										<span class="notification-icon">
											<svg class="olymp-comments-post-icon"><use xlink:href="icons/icons.svg#olymp-comments-post-icon"></use></svg>
										</span>
								
									<div class="comment-photo">
										<img src="public/frontend/img/comment-photo.jpg" alt="photo">
										<span>“She looks incredible in that outfit! We should see each...”</span>
									</div>
									<div class="more">
										<svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg>
										<svg class="olymp-little-delete"><use xlink:href="icons/icons.svg#olymp-little-delete"></use></svg>
									</div>
								</li>
								
								<li>
									<div class="author-thumb">
										<img src="public/frontend/img/avatar4-sm.jpg" alt="author">
									</div>
									<div class="notification-event">
										<a href="#" class="h6 notification-friend">Chris Greyson</a> liked your <a href="#" class="notification-link">profile status</a>.
										<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">March 18th at 8:22pm</time></span>
									</div>
									<span class="notification-icon">
										<svg class="olymp-heart-icon"><use xlink:href="icons/icons.svg#olymp-heart-icon"></use></svg>
									</span>
									<div class="more">
										<svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg>
										<svg class="olymp-little-delete"><use xlink:href="icons/icons.svg#olymp-little-delete"></use></svg>
									</div>
								</li>
								
								<li>
									<div class="author-thumb">
										<img src="public/frontend/img/avatar5-sm.jpg" alt="author">
									</div>
									<div class="notification-event">
										<a href="#" class="h6 notification-friend">Green Goo Rock</a> invited you to attend to his event Goo in <a href="#" class="notification-link">Gotham Bar</a>.
										<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">March 5th at 6:43pm</time></span>
									</div>
										<span class="notification-icon">
											<svg class="olymp-calendar-icon"><use xlink:href="icons/icons.svg#olymp-calendar-icon"></use></svg>
										</span>
								
									<div class="more">
										<svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg>
										<svg class="olymp-little-delete"><use xlink:href="icons/icons.svg#olymp-little-delete"></use></svg>
									</div>
								</li>
								
								<li>
									<div class="author-thumb">
										<img src="public/frontend/img/avatar6-sm.jpg" alt="author">
									</div>
									<div class="notification-event">
										<a href="#" class="h6 notification-friend">James Summers</a> commented on your new <a href="#" class="notification-link">profile status</a>.
										<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">March 2nd at 8:29pm</time></span>
									</div>
										<span class="notification-icon">
											<svg class="olymp-comments-post-icon"><use xlink:href="icons/icons.svg#olymp-comments-post-icon"></use></svg>
										</span>
								
									<div class="more">
										<svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg>
										<svg class="olymp-little-delete"><use xlink:href="icons/icons.svg#olymp-little-delete"></use></svg>
									</div>
								</li>
								
								<li>
									<div class="author-thumb">
										<img src="public/frontend/img/avatar7-sm.jpg" alt="author">
									</div>
									<div class="notification-event">
										<a href="#" class="h6 notification-friend">Marina Valentine</a> commented on your new <a href="#" class="notification-link">profile status</a>.
										<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">March 2nd at 10:07am</time></span>
									</div>
										<span class="notification-icon">
											<svg class="olymp-comments-post-icon"><use xlink:href="icons/icons.svg#olymp-comments-post-icon"></use></svg>
										</span>
								
									<div class="more">
										<svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg>
										<svg class="olymp-little-delete"><use xlink:href="icons/icons.svg#olymp-little-delete"></use></svg>
									</div>
								</li> -->
								@endforeach
							</ul>

						</div>
						<nav aria-label="Page navigation" style="padding-left: 180px;">
							<ul class="pagination notify_pagination justify-content-center">
								<li class="page-item disabled">
									<a class="page-link" href="#" tabindex="-1">Previous</a>
								</li>
								<li class="page-item"><a class="page-link" href="#">1<div class="ripple-container"><div class="ripple ripple-on ripple-out" style="left: -10.3833px; top: -16.8333px; background-color: rgb(255, 255, 255); transform: scale(16.7857);"></div></div></a></li>
								<li class="page-item"><a class="page-link" href="#">2</a></li>
								<li class="page-item"><a class="page-link" href="#">3</a></li>
								<li class="page-item"><a class="page-link" href="#">...</a></li>
								<li class="page-item"><a class="page-link" href="#">12</a></li>
								<li class="page-item">
									<a class="page-link" href="#">Next</a>
								</li>
							</ul>
						</nav>
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