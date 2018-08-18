@extends('frontend.layout.app')
@push('css-style')
<link href="{{asset('public/backend/css/style.min_2.css')}}" rel="stylesheet" />
	<link href="{{asset('public/css/map.css')}}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/css/dropdown_com.css')}}" />
	<!-- <link rel="stylesheet" href="{{asset('public/css/dialog.css')}}" /> -->
	<link rel="stylesheet" href="{{asset('public/frontend/css/pages/post_type_page.css')}}" />
	<link rel="stylesheet" href="{{asset('public/frontend/css/pages/post_page.css')}}" />
	<link rel="stylesheet" href="{{asset('public/frontend/css/pages/aside_right_chat.css')}}" />
	<link rel="stylesheet" href="{{asset('public/frontend/css/pages/welcome_page.css')}}" />
	
@endpush
@section('content')
@include('frontend._partials.nav')
<section class="home_main_container">
	<div class="home_container_top">

		<!-- map section start -->
		<public-map></public-map>
		<!-- map section end -->
		<div class="container_top_bar">
			<div class="container_section">
				<div class="hidden-md hidden-lg res_top_proImg">
					<?php 
					$user_id = Auth::user()->_id;
					$getUser = App\User::findOrFail($user_id);
					$image = Auth::user()->profile_image;
					if(!empty($image)){
						$profile_image = url('/images/users/profile/s80').$image;
					}else{
						if(Auth::user()->gender=='Mr'){
							$profile_image = url('/public/frontend/img/user.jpg');
						}else{
							$profile_image = url('/public/frontend/images/Anonymous_female.png');
						}
					}
					?>
					<a href="javascript:;">
						<img src="{{ $profile_image }}" alt="{{ Auth::user()->fullname }}" />
						<span class="hidden-xs">{{Auth::user()->fullname}}</span>
					</a>
				</div>
				
				<div class="col-md-4 res_home_top_panel home_top_panel no_padding">
				 
					<a class="show-dialog-pop" id="post-com-ed" onClick="showPostModal()"><textarea class="form-control home_set_box_panel show-dialog" id="" rows="3" placeholder="What's on your mind?"></textarea></a>
					<div class="home_post_overlay"></div>
					<create-post></create-post>
        			<!--  -->

				</div>

				<div class="col-md-2">
					
				</div>
				
				<div class="col-md-3 hidden-xs hidden-sm" style="padding-right: 0.5%; padding-left: 4%;" >
					
					@include('frontend.common.aside_right_chat')

				</div>
					
			</div>
		</div>
	</div>

	
		
</section>


@push('js')
	
	
	<script src="{{asset('public/frontend/js/modernizr.custom.js')}}"></script>
	<script src="{{asset('public/frontend/js/jquery.dlmenu.js')}}"></script>
	<script>
		$(function() {
			$( '#dl-menu' ).dlmenu({
				animationClasses : { in : 'dl-animate-in-4', out : 'dl-animate-out-4' }
			});
		});


		
	</script>

@endpush
@endsection