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
	

		  
</style>
  
<section class="profile_page" style="margin-top: 55px">
	 <div class="container-fluid">
	 	<div class="row">
	 		<div class="col-md-10 profile-left-section">
				<div class="row">
					<div class="col-md-3">
						<div class="profileSet-ui-block">
							<div class="your-profile">
								<div class="profileSet-ui-block-title profileSet-ui-block-title-small">
									<h6 class="title">Your PROFILE</h6>
								</div>

								<div id="accordion" role="tablist" aria-multiselectable="true">
									<div class="card">
										<div class="card-header" role="tab" id="headingOne">
											<h6 class="mb-0">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
													Profile Settings
													<!-- <svg class="olymp-dropdown-arrow-icon"><use xlink:href="icons/icons.svg#olymp-dropdown-arrow-icon"></use></svg> -->
												</a>
											</h6>
										</div>

										<div role="tabpanel" aria-labelledby="headingOne">
											<ul class="your-profile-menu">
												<li>
													<a href="{{ URL::to('personal_information')}}">Personal Information</a>
												</li>
												<li>
													<a href="{{ URL::to('account_settings')}}">Account Settings</a>
												</li>
												<li>
													<a href="{{ URL::to('change_password')}}">Change Password</a>
												</li>
											</ul>
										</div>
									</div>
								</div>


								<div class="profileSet-ui-block-title">
									<a href="{{ URL::to('all_notifications')}}" class="h6 title">Notifications</a>
									<a href="#" class="items-round-little bg-primary-notty">8</a>
								</div>
								<div class="profileSet-ui-block-title">
									<a href="{{ URL::to('all_activity')}}" class="h6 title">Activity Log</a>
								</div>
								<div class="profileSet-ui-block-title">
									<a href="{{ URL::to('friend_request')}}" class="h6 title">Friend Requests</a>
									<?php 
									$pending = DB::collection('relationships')
												->where('user_id_two','=',Auth::user()->_id)
												->where('status',0)
												->count();
									?>
									<a href="#" class="items-round-little bg-blue-request">{{$pending}}</a>
								</div>
								<div class="profileSet-ui-block-title">
									<a href="{{ URL::to('all_messages')}}" class="h6 title">Chat / Messages</a>
									<a href="#" class="items-round-little bg-green-message">10</a>
								</div>
								<div class="profileSet-ui-block-title">
									<a href="{{ URL::to('fav_agencies')}}" class="h6 title">Favourite Agencies</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-9">
						<div class="profileSet-ui-block">
							<div class="profileSet-ui-block-title" style="border-bottom: 1px solid #e6ecf5;">
								<h6 class="title" style="width: 725px;">Friend Requests</h6>
								<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
							</div>

							<ul class="notification-list friend-requests">
								@foreach($requesters as $requester)

								<li>
									<div class="author-thumb">
										<?php 
											$image = $requester->users->user_image['image']; 

										?>
										<img src='{{asset("images/users$image")}}' width="40px" height="40px" alt="author">
									</div>
									<div class="notification-event">
										<a href="#" class="h6 notification-friend">{{$requester->users->firstname}} {{$requester->users->middlename}} {{$requester->users->lastname}}</a>
										<span class="chat-message-item">Mutual Friend: Sarah Hetfield</span>
									</div>
									<span class="notification-icon">
										<!-- <a href="#" class="accept-request">
											<span class="icon-add">
												<svg class="olymp-happy-face-icon"><use xlink:href="icons/icons.svg#olymp-happy-face-icon"></use></svg>
											</span>
											Accept Friend Request
										</a> -->

										


										<?php 
											$check = DB::collection('relationships')
													->where('user_id_two','=',Auth::user()->_id)
													->where('user_id_one','=',$requester->user_id_one)
													->where('status','=',1)
													->first();
											if($check==''){		
											?>
											<p><a href="{{url('/accepterequest')}}/{{$requester->user_id_one}}" class="accept-request">
												<span class="icon-add">
													<svg class="olymp-happy-face-icon"><use xlink:href="public/frontend/icons/icons.svg#olymp-happy-face-icon"></use></svg>
												</span>Accept Friend Request
											</a></p>
											<?php }else{ ?>
											<p class="btn btn-info btn-sm">Friend</p>
											<?php } ?>


										<a href="#" class="accept-request request-del">
											<span class="icon-minus">
												<svg class="olymp-happy-face-icon"><use xlink:href="icons/icons.svg#olymp-happy-face-icon"></use></svg>
											</span>
										</a>

									</span>

									<div class="more">
										<svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg>
										<svg class="olymp-little-delete"><use xlink:href="icons/icons.svg#olymp-little-delete"></use></svg>
									</div>
								</li>

								@endforeach

							</ul>

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