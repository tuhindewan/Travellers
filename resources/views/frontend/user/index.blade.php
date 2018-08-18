@extends('frontend.layout.app')

@push('css-style')
	<link href="{{asset('public/backend/css/style.min_2.css')}}" rel="stylesheet" />
	<!-- <link href="{{asset('public/css/map.css')}}" rel="stylesheet"> -->
	<!-- <link rel="stylesheet" href="{{asset('public/frontend/css/images-grid.css')}}"> -->
	<!-- <link rel="stylesheet" href="{{asset('public/frontend/css/custom.css')}}"> -->
	<!-- <link rel="stylesheet" href="{{asset('public/css/dialog.css')}}" /> -->
	<!-- <link rel="stylesheet" href="{{asset('public/frontend/css/new/errors.css')}}"> -->
	
	
	<link rel="stylesheet" href="{{asset('public/frontend/css/pages/post_type_page.css')}}" />
	<link rel="stylesheet" href="{{asset('public/frontend/css/pages/post_page.css')}}" />
	<link rel="stylesheet" href="{{asset('public/css/like/like.css')}}">
	<link rel="stylesheet" href="{{asset('public/frontend/css/pages/aside_right_chat.css')}}" />
	
	<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/css/fullscreen.css')}}" media="screen" />
	<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/css/settings.css')}}" media="screen" />
    <!-- Picker -->	
	<link rel="stylesheet" href="{{asset('public/frontend/css/jquery-ui.css')}}" />
	<link rel="stylesheet" href="{{asset('public/frontend/css/form-wizard-purple.css')}}">
	<link rel="stylesheet" href="{{asset('public/frontend/css/switcher.css')}}">

	<link rel="stylesheet" href="{{asset('public/frontend/css/animate.min.css')}}">
	<link rel="stylesheet" href="{{asset('public/frontend/css/cover.css')}}">
	<link rel="stylesheet" href="{{asset('public/frontend/css/profile/profile_timeline.css')}}">
	<link rel="stylesheet" href="{{asset('public/frontend/css/profile/profile_about.css')}}">
	<link rel="stylesheet" href="{{asset('public/frontend/css/profile/profile_friends.css')}}">
	<link rel="stylesheet" href="{{asset('public/frontend/css/profile/profile_photos.css')}}">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.3/css/swiper.min.css" />
    <link href="{{asset('public/backend/plugins/jquery-jvectormap/jquery-jvectormap_2.css')}}" rel="stylesheet" />
    <link href="{{asset('public/backend/plugins/bootstrap-calendar/css/bootstrap_calendar_2.css')}}" rel="stylesheet" />
    <link href="{{asset('public/backend/plugins/gritter/css/jquery.gritter_2.css')}}" rel="stylesheet" />
    <link href="{{asset('public/backend/plugins/morris/morris_2.css')}}" rel="stylesheet" />

	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.3/js/swiper.js"></script> 
	<style type="text/css">
		.checkbox input[type="checkbox"], .checkbox-inline input[type="checkbox"], .radio input[type="radio"], .radio-inline input[type="radio"] { margin-top: 3px;}
	</style>
@endpush
@section('content')
@include('frontend._partials.nav')

<section class="profile_page">
	 <div class="container-fluid">
	 	<div class="row">
	 		<div class="col-md-10 col-xs-12 col-sm-12 profile-left-section">
	 			
 			    <div class="cover profile">
 			      <div class="wrapper">
 			        <div class="image">
 			          <div class="cover-image picture-container">
	 			          	<?php 
	 			      		$coverImage = $user_info['cover_image'];
		 			      	?>
		 			        @if(!empty($coverImage))
		 			        <?php $coverPic = url('/images/users/cover/').$coverImage; ?>
		 			          
							@else
							    <?php $coverPic = url('/public/frontend/images/Cover/blank-cover-template-1.jpg'); ?>
		 			        @endif
								
		 			        <input type="hidden" value="{{ $coverPic }}" id="coverPic">

							<img style="position: absolute;" id="blah" class="headerimage ui-corner-all" :src="coverDataUrl" >

	 			          	@if($getUser->_id == $user_info->_id)

								<!-- <div class="overlay overlay-dark"></div> -->
 			          		<div class="dropdown cover-add-icon">
								<button @click="toggleShowCover" class="btn btn-update-cover dropdown-toggle hidden-sm hidden-xs" type="button" data-toggle="dropdown"><i class="fa fa-camera" aria-hidden="true"></i> Update cover photo</button>

								<button @click="toggleShowCover" class="btn btn-update-cover dropdown-toggle hidden-md hidden-lg" type="button" data-toggle="dropdown"><i class="fa fa-camera" aria-hidden="true"></i> Edit</button>

								<my-upload field="img"
							        @crop-success="cropSuccess"
							        @crop-upload-success="cropUploadSuccess"
							        @crop-upload-fail="cropUploadFail"
							        v-model="showCover"
									:width="746"
									:height="300"
									:url="coverUploadPath"
									:params="params"
									:headers="headers"
									lang-type="en"
									img-format="png"></my-upload>
 			          		</div>
 			          		

	 			          	@endif
 			          		
 			          </div>
 			        </div>

 			        <div class="hidden-xs hidde-sm"><user-featured-photo :featuredphoto="{{ json_encode($getFeaturedPhoto)}}" :userid="{{ json_encode($user_info->_id) }}"></user-featured-photo></div>
 			        
 			      </div>
 			      
 			    </div>
 			    <div class="user_info_profile">
 			    	<div class="col-md-3 col-sm-4 col-xs-4">
 			    		<div class="user_profile_photo">

		 			      	<?php 
		 			      		$image = $user_info['profile_image'];
		 			      	?>
		 			        <div class="avatar">
		 			          @if(!empty($image))
		 			          <?php $profilePic = url('/images/users/profile/s160').$image; ?>
		 			          @elseif(Auth::user()->gender=='Mr')
								<?php $profilePic = url('/public/frontend/img/user.jpg'); ?>
							  @else
							    <?php $profilePic = url('/public/frontend/images/Anonymous_female.jpg'); ?>
		 			          @endif
								
		 			          <input type="hidden" value="{{ $profilePic }}" id="profilePic">
		 			          <div class="profile_img">
		 			          	<img v-if=imgDataUrl :src="imgDataUrl">
		 			          </div class="profile_img">
		 			          <!-- 
		 			          <div class="profile_img">
		 			          	<img id="profile-picture" src='{{asset("public/frontend/images/Anonymous_male.jpg")}}' alt="people">
		 			          </div>
		 			           -->
		 			          @if($getUser->_id == $user_info->_id)
		 			          	<button @click="toggleShowProfile" class="btn btn-update-propic hidden-sm hidden-xs" type="button" style="width: 100%; color: #0e1626; background: #d4d9dd; height: 34px; font-size: 12px;"><i class="fa fa-camera" aria-hidden="true"></i> Update profile picture</button>

		 			          	<button @click="toggleShowProfile" class="btn btn-update-propic hidden-md hidden-lg" type="button" style="background: #fff;opacity: 0.8;color: black;border: none !important;padding: 3px 6px;font-size: 9px;top: 78%;left: 44%;"><i class="fa fa-camera" aria-hidden="true"></i> Edit</button>
				
								<my-upload field="img"
							        @crop-success="cropSuccess"
							        @crop-upload-success="cropUploadSuccess"
							        @crop-upload-fail="cropUploadFail"
							        v-model="showProfile"
									:width="160"
									:height="160"
									:url="profileUploadPath"
									:params="params"
									:headers="headers"
									lang-type="en"
									img-format="png"></my-upload>
								
		 			          @endif
		 			        </div>

		 			    </div>
 			    	</div>
	 			    <div class="col-md-5 col-sm-8 col-xs-8">
	 			    	<div class="user_profile_name">
		 			    	<a >{{$user_info['fullname']}}</a>
		 			    </div>
	 			    </div>
	 			    <div class="col-sm-4 hidden-sm hidden-xs">
	 			    	<div class="basic_section">
	 			    		@if($getUser->_id !== $user_info->_id)
								
								<input type="hidden" value="{{ $user_info->_id }}" id="vUserId">
								<reports class="pull-right" :reportid="{{ json_encode($user_info->_id) }}"></reports>
								
								<relationship class="pull-right" :userid="{{ json_encode($user_info->_id) }}"></relationship>

								<message-traveler class="pull-right" :userid="{{ json_encode($user_info->_id) }}" v-on:getcurrentuser="getCurrentUser"></message-traveler>
	 			    		@else
								<a href="{{URL::to('/settings')}}" class="btn btn-success btn-sm user-btn pull-right">Update Info</a>
							
	 			    		@endif
	 			    	</div>
	 			    </div>
 			    </div>
 			    <input type="hidden" id="uId" value="{{$user_info->_id}}">
 			    <input type="hidden" id="uName" value="{{$user_info->username}}">
 			    <user-section></user-section>
	 			  
	 		</div>
	 		<div class="col-md-2 right-section hidden-sm hidden-xs">
	 			@include('frontend.common.aside_right_chat')
	 		</div>
	 	</div>
	 </div>
</section>


@push('js')

<script>
  (function ($) {
    $(document).ready(function(){
      
    // hide .navbar first
    $(".fadeout_navbar").hide();
    
    // fade in .navbar
    $(function () {
      $(window).scroll(function () {
              // set distance user needs to scroll before we fadeIn navbar
        if ($(this).scrollTop() > 350) {
          
          $('.fadeout_navbar').fadeIn();
        } else {
          $('.fadeout_navbar').fadeOut();
        }
      });

    
    });

  });
    }(jQuery));
</script>


<script>
	$(function(){
		
        $(window).scroll(function(){
            if( $(window).scrollTop() > 350 ) {
                
                $('#map_section').css({position: 'fixed', top: '10%' , width: '37.5%', height:'100%'});
                $('.timeline-plan-image').css({position:'fixed',top:'38%',left:'29%'});
				$('.timeline-semi-transparent-button').css({position:'fixed',top: '38%',left: '31%',width: '4%'});
				$('.timeline-suggestions-image').css({position:'fixed',top:'45%',left:'29%'});
				$('.timeline-suggestions-transparent-button').css({position:'fixed',top:'45%',left:'31%',width:'7%'});
				$('.timeline-experiences-image').css({position:'fixed',top:'31%',left:'29%'});
				$('.timeline-experiences-transparent-button').css({position:'fixed',top:'31%',left:'31%',width:'7%'});
				$('.timeline-questions-image').css({position:'fixed',top:'52%',left:'29%'});
				$('.timeline-questions-transparent-button').css({position:'fixed',top:'52%',left:'31%',width:'6%'});
				//$('.news-scetion').css({width:'502px'});

            } else {
                
                $('#map_section').css({position: 'absolute', width: '500px', height:'600px', top:'0'});
                $('.timeline-plan-image').css({position:'absolute',top:'26%',left:'72%'});
				$('.timeline-semi-transparent-button').css({position:'absolute',top:'26%',left:'78%',width:'10%'});
				$('.timeline-suggestions-image').css({position:'absolute',top:'34%',left:'72%'});
				$('.timeline-suggestions-transparent-button').css({position:'absolute',top:'34%',left:'78%',width:'18%'});
				$('.timeline-experiences-image').css({position:'absolute',top:'18%',left:'72%'});
				$('.timeline-experiences-transparent-button').css({position:'absolute',top:'18%',left:'78%',width:'18%'});
				$('.timeline-questions-image').css({position:'absolute',top:'42%',left:'72%'});
				$('.timeline-questions-transparent-button').css({position:'absolute',top:'42%',left:'78%',width:'15%'});
				//$('.news-scetion').css({width:'502px'});
            }
        });
  	});
</script>

@endpush
@endsection