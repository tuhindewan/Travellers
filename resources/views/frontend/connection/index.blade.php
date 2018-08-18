@extends('frontend.layout.app')

@push('css-style')

<link href="{{asset('public/frontend/css/style.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('public/frontend/css/images-grid.css')}}">
<link rel="stylesheet" href="{{asset('public/frontend/css/connection/connection_index.css')}}">
<link rel="stylesheet" href="{{asset('public/frontend/css/pages/post_type_page.css')}}" />
<link rel="stylesheet" href="{{asset('public/frontend/css/pages/post_page.css')}}" />
<link rel="stylesheet" href="{{asset('public/frontend/css/pages/aside_right_chat.css')}}" />
<link rel="stylesheet" href="{{asset('public/css/like/like.css')}}">
<link rel="stylesheet" href="{{asset('public/frontend/css/profile/profile_timeline.css')}}" />
<link rel="stylesheet" href="{{asset('public/frontend/css/connection/connection_index.css')}}">
<style>
	.post_activity_left { width: 13.5% !important; }
	small{font-size: 13px !important;}
	.button_gly {margin-top: 0 !important;}
	.comment_add_section{margin-top: 10px;}
	.create_post{ margin: 66px 16.9% !important;}
</style>
@endpush
@section('content')
@include('frontend._partials.nav')
<section class="connection_page">
	
	 <div class="container-fluid connection_section">
	 	<div class="row">
	 		
	 		<connection-section></connection-section>
			
	 		
	 		<div class="col-md-2 hidden-xs hidden-sm right-section">
	 			@include('frontend.common.aside_right_chat')
	 		</div>
	 	</div>
	 </div>
</section>
@push('js')
	
	
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<script type="text/javascript" src="{{asset('public/js/dialog.min.js')}}"></script>

	<script src="{{asset('public/frontend/js/images-grid.js')}}"></script>
	
	<!-- mousewheel scroll up and down -->
	<script>
		$(function(){
		
        $(window).scroll(function(){
            if( $(window).scrollTop() > 680 ) {
                if($(".newsletter-scroll").height() > 680 ){

                	$('.top_section').css({position: 'fixed' ,top:'-630px', width: '24.8%',bottom:'0'});
                }

            } else {
             	$('.top_section').css({position: 'absolute' ,top:'0', width: '100%', height:'100%'});
                
            }
        });
  	});
	</script>
	
@endpush
@endsection