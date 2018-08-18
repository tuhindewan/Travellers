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
								<h6 class="title">Personal Information</h6>
							</div>
							@if(Session::has('success'))

							    <div class="alert alert-success">
							        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="font-size: 17px !important;">×</button>
							       <b>{!! Session::get('success')!!}</b> 
							    </div>
							
							@elseif(Session::has('error'))
								
							    <div class="alert alert-danger">
							        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="font-size: 17px !important;">×</button>
							       <b>{!! Session::get('error')!!}</b> 
							       </div>
								
							@endif
							<div class="profileSet-ui-block-content">
								{!! Form::open(array('route' => 'personal_information.store','method'=>'POST')) !!} 
									     
			                		{!! csrf_field() !!}
									<div class="row">
										<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="form-group profileSet_formGroup label-floating">
										
												<input class="form-control" name="inspiration" placeholder="Your Inspiration (Max 250 words)" type="text">
											</div>
										</div>
									</div>
									<?php $fk_user_id = Auth::user()->_id; ?>
									<input type="hidden" name="fk_user_id" value="{{$fk_user_id}}">

										<div class="row">
											<div class="col-md-4">
												<div class="form-group profileSet_formGroup label-floating is-select">
													<label class="control-label" style="font-size: 11px;">Your Interest</label>
													<select name="interest" id="profile_dropdown" class="selectpicker form-control" multiple data-max-options="1"  data-live-search="true">
												    	<option value="Acting">Acting</option>
												    	<option value="Book Restoration">Book Restoration</option>
												    	<option value="Calligraphy">Calligraphy</option>
												    	<option value="Computer programming">Computer programming</option>
												    	<option value="Cooking">Cooking</option>
												    	<option value="Cryptography">Cryptography</option>
												    	<option value="Dance">Dance</option>
												    	<option value="Electronics">Electronics</option>
												    	<option value="Fashion">Fashion</option>
												    	<option value="Ice skating">Ice skating</option>
												    	<option value="Jewelry making">Jewelry making</option>
								    					<option value="Listening to Music">Listening to Music</option>
												    	<option value="Magic">Magic</option>
												    	<option value="Painting">Painting</option>
												    	<option value="Pet">Pet</option>
												    	<option value="Photography">Photography</option>
												    	<option value="Playing musical instruments">Playing musical instruments</option>
												    	<option value="Puzzles">Puzzles</option>
												    	<option value="Reading">Reading</option>
												    	<option value="Singing">Singing</option>
												    	<option value="Stand-up comedy">Stand-up comedy</option>
												    	<option value="Table tennis">Table tennis</option>
												    	<option value="Video gaming">Video gaming</option>
												    	<option value="Watching movies">Watching movies</option>
												    	<option value="Watching television">Watching television</option>
												    	<option value="Web surfing">Web surfing</option>
												    	<option value="Writing">Writing</option>
												    	<option value="Yoga">Yoga</option>
												    	<option value="Archery">Archery</option>
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group profileSet_formGroup label-floating is-select">
													<label class="control-label" style="font-size: 11px;">You Prefer</label>
													<select name="prefer" id="profile_dropdown" class="selectpicker form-control" multiple data-max-options="1"  data-live-search="true">
														<option value="Travelling Solo">Travelling Solo</option>
														<option value="As Couple">As Couple</option>
														<option value="In Group">In Group</option>
														<option value="All of Them">All of Them</option>
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group profileSet_formGroup label-floating is-select">
													<label class="control-label" style="font-size: 11px;">You Are</label>
													<select name="youare" id="profile_dropdown"  class="selectpicker form-control" multiple data-max-options="1"  data-live-search="true">
														<option value="Actors">Actor</option>
														<option value="Artists">Artist</option>
														<option value="Doctor">Doctor</option>
														<option value="Engineer">Engineer</option>
														<option value="Engineer">Student</option>
														<option value="Engineer">Teacher</option>
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-3" style="padding-top: 25px;">
												<a href="" class="btn btn-restore btn-sm full-width">Restore all Attributes</a>
											</div>
											<div class="col-md-3" style=" margin-left: -30px;padding-left: 0px;padding-top: 25px;">
												<button type="submit" class="btn btn-save-change btn-sm full-width">Save all Changes</button>
											</div>
										</div>
								{!! Form::close(); !!}
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
  
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
	$(document).ready(function() {
	   $('.selectpicker').selectpicker();
	});
</script>



		  

@endsection