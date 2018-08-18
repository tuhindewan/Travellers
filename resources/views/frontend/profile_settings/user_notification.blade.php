
	
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
.notification-list .selectize-dropdown-content > *, .notification-list li {padding: 7px 25px;}
</style>

@endpush
@section('content')
@include('frontend._partials.nav')



<section class="profile_page" style="margin-top: 55px;">
	 <div class="container-fluid">
	 	<div class="row">
	 		<div class="col-md-9 profile-left-section">
				

				<div class="row">
					<div class="col-md-3">
					
						
						
					</div>
					
					<div class="col-md-9">
						<div class="tab-content">
							<div class="" id="all">
								
								@if(count($getNotification)>0)
								<div class="profileSet-ui-block">
									<div class="profileSet-ui-block-title" style="border-bottom: 1px solid #e6ecf5;">
										<h6 class="title" style="width: 725px;"><i class="fa fa-bell-o fa-lg"></i> Notification</h6>
										
									</div>
									
									<ul class="notification-list friend-requests">
										@foreach($getNotification as $notify )
										<?php $username = $notify->posts->users->username ;?>
										<a href='{{URL::to("$username/posts/$notify->thread_id")}}'>
										@if($notify->is_unread == 0)
										<li style="background: #e9e9e9">
											<div class="row" style="width:100%;">
												<div class="col-sm-2 col-md-1">
													<div class="author-thumb">
														<?php 
														
															$image = url('/images/users/profile/s160').$notify->users->profile_image;
														 ?>
														<img src="<?php echo $image; ?>" height="45px;" width="45px;" alt="author">
													</div>	
												</div>
												<div class="col-sm-10 col-md-11">
													<div class="search-name">
														<b class="capitalize">{{ $notify->users->fullname }}</b> {{ $notify->body_text }}
													</div>	
													<div>
														<?php 
															$created_at = $notify->created_at;
														    $cls_date = new DateTime($created_at); 
															$time= $cls_date->format('F j, Y');
														 ?>
														{{ $time }}
													</div>
												</div>
											
											</div>
											
										</li>
										@else
										<li>
											<div class="row" style="width:100%;">
												<div class="col-sm-2 col-md-1">
													<div class="author-thumb">
														<?php 
														
															$image = url('/images/users/profile/s160').$notify->users->profile_image;
														 ?>
														<img src="<?php echo $image; ?>" height="45px;" width="45px;" alt="author">
													</div>	
												</div>
												<div class="col-sm-10 col-md-11">
													<div class="search-name">
														<b class="capitalize">{{ $notify->users->fullname }}</b> {{ $notify->body_text }}
													</div>	
													<div>
														<?php 
															$created_at = $notify->created_at;
														    $cls_date = new DateTime($created_at); 
															$time= $cls_date->format('F j, Y');
														 ?>
														{{ $time }}
													</div>
												</div>
											
											</div>
											
										</li>
										@endif
										</a>

										@endforeach
									</ul>
									
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