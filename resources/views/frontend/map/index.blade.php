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
	<style>
		.travel_dialog { margin: 55px 346px !important;}
		
	</style>
@endpush
@section('content')
@include('frontend._partials.nav')
<section class="home_main_container" style="height: 91.5%;top: 54px !important;">
	<div class="home_container_top" style="height: 100%">

		<!-- map section start -->
		<friend-map></friend-map>
		<!-- map section end -->
		<div class="container_top_bar">
			<div class="container_section">
				
				<div class="col-md-4 home_top_panel no_padding">
				 
					<a class="show-dialog-pop" id="post-com-ed" onClick="showPostModal()"><textarea class="form-control home_set_box_panel show-dialog" id="" rows="3" placeholder="What's on your mind?"></textarea></a>
					<div class="home_post_overlay"></div>
					<create-post></create-post>
        			<!--  -->

				</div>

				<div class="col-md-2">
					
				</div>
				
				<div class="col-sm-3" style="padding-right: 0.5%; padding-left: 4%;" >
					
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