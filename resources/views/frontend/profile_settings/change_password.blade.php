@extends('frontend.layout.app')
@push('css-style')
	<link href="{{asset('public/css/map.css')}}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/css/dropdown_com.css')}}" />
	<!-- <link rel="stylesheet" href="{{asset('public/css/dialog.css')}}" /> -->
	<link rel="stylesheet" href="{{asset('public/frontend/css/pages/aside_right_chat.css')}}" />
	<link href="{{asset('public/backend/css/style.min_2.css')}}" rel="stylesheet" />
	<link rel="stylesheet" href="{{asset('public/frontend/css/profile_settings/personal_information.css')}}">
	<link rel="stylesheet" href="{{asset('public/frontend/css/profile_settings/change_password.css')}}">
	<link rel="stylesheet" href="{{asset('public/frontend/css/profile_settings/notifications.css')}}">
	<link rel="stylesheet" href="{{asset('public/frontend/css/profile_settings/friend_request.css')}}">
	<style>
	
	.right-section{padding: 0px !important;border: 1px solid #fff;border-bottom: none;border-top: none;border-right: none;height: 582px;z-index: 10;position: fixed;right: 5px;top: 55px;width: 285px;
	}
	#register .short{
    font-weight:bold;
	color:#FF0000;
	font-size:larger;
	}
	#register .weak{
	    font-weight:bold;
		color:orange;
		font-size:larger;
	}
	#register .good{
	    font-weight:bold;
		color:#2D98F3;
		font-size:larger;
	}
	#register .strong{
	    font-weight:bold;
		color: limegreen;
		font-size:larger;
	}

</style>
@endpush
@section('content')
@include('frontend._partials.nav')


<section class="profile_page" style="width: 100%; overflow: hidden;margin-top: 55px">
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
								<h6 class="title">Change Password</h6>
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
								{!! Form::open(array('route' => ['users.update',Auth::user()->_id],'class'=>'form-horizontal','method'=>'PUT','files'=>'true')) !!} 
									     
			                		{!! csrf_field() !!}
									<div class="row">
										
										<input type="hidden" name="type" value="0">
										<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="form-group label-floating">
					
												<input class="form-control" name="currentPass" placeholder="Current Password" type="password" required="">
											</div>
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
											<div class="form-group label-floating is-empty">
												<input class="form-control" name="newPassword" id="newPassword" placeholder="New Password" type="password" required="">
												<span id="newPasswordResult"></span>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
											<div class="form-group label-floating is-empty">
												<input class="form-control" name="conPassword" id="conPassword" placeholder="Confirm New Password" type="password" required="">
												<span id="conPasswordResult"></span>
											</div>
										</div>

										<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<button type="submit" class="btn btn-password-change btn-sm  full-width">Change Password Now!</button>
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
  
  

@endsection