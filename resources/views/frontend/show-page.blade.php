@extends('frontend.layout.app')
@push('css-style')
<link href="{{asset('public/backend/css/style.min_2.css')}}" rel="stylesheet" />
	<link href="{{asset('public/css/map.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('public/frontend/css/images-grid.css')}}">
	<!-- <link rel="stylesheet" href="{{asset('public/css/dialog.css')}}" /> -->
	
	<!-- <link rel="stylesheet" type="text/css" href="{{asset('public/frontend/css/dropdown_com.css')}}" /> -->

	<link rel="stylesheet" href="{{asset('public/frontend/css/pages/post_type_page.css')}}" />
	<link rel="stylesheet" href="{{asset('public/frontend/css/pages/post_page.css')}}" />
	<link rel="stylesheet" href="{{asset('public/frontend/css/pages/aside_right_chat.css')}}" />
	<link rel="stylesheet" href="{{asset('public/css/like/like.css')}}">
	<link rel="stylesheet" href="{{asset('public/frontend/css/pages/show_home_page.css')}}" />
	<style>
		hr{margin-top: 10px;margin-bottom: 5px;}
		.newsletter-scroll { width: 485px;}
		.create_post{ margin: 60px 43% !important;}
	</style>
@endpush


@section('content')
@include('frontend._partials.nav')

<section class="place_news_main_container" style="height: 91.5%;top: 54px !important;">
	<div class="home_container_top" style="height: 100%">
				
		
			<div class="hidden-sm hidden-xs">
				<place-map></place-map>
			</div>
		
		
		<div class="col-md-7 col-sm-12 col-xs-12 pull-right res_mt_5">
			<div class="row row-newsletter">
				<div class="col-md-8 col-sm-12 col-xs-12 newsletter-scroll res_newsletter-scroll">


					<div class="row res_show_page_form_control" style="position: relative;">
						
						<a class=" show-dialog-pop" id="post-com-ed" onClick="showPostModal()"><textarea class=" form-control home_set_box_panel show-dialog" id="" rows="3" placeholder="What's on your mind?" readonly style="background: #fff;"></textarea></a>
						
						<create-post></create-post>
						
						
					</div>
				    <div class="row news-setion-scroll res_mt_35">
				    	<input type="hidden" value="{{$placeId}}" id="place">
				    	<post-sections></post-sections>
				    </div>
				</div>
		 		<div class="col-md-4 hidden-sm hidden-xs right-section">
		 			@include('frontend.common.aside_right_chat')
		 		</div>
			</div>
		</div>

	</div>

	
		
</section>


@push('js')
	<!-- <script src="{{asset('public/js/post-section/post-section.js')}}"></script> -->
	<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script> -->
	<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCALSYjrJyQ3R9ONak9nVMaAkOuRetWv4&v=3.exp&libraries=places&callback=initMap"></script> -->
	<!-- <script src="{{asset('public/js/map.js')}}"></script> -->
	<script type="text/javascript" src="{{asset('public/js/dialog.min.js')}}"></script>

	<script src="{{asset('public/frontend/js/images-grid.js')}}"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	
	<!-- mousewheel scroll up and down -->
	
	
@endpush
@endsection