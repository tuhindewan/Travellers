@extends('frontend.layout.app')
@push('css-style')
	<link href="{{asset('public/css/map.css')}}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/css/dropdown_com.css')}}" />

	<link rel="stylesheet" href="{{asset('public/frontend/css/pages/aside_right_chat.css')}}" />
	<link href="{{asset('public/backend/css/style.min_2.css')}}" rel="stylesheet" />

	
	<link rel="stylesheet" href="{{asset('public/frontend/css/profile_settings/personal_information.css')}}">
	<link rel="stylesheet" href="{{asset('public/frontend/css/profile_settings/account_settings.css')}}">
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
								<h6 class="title">Account Settings</h6>
							</div>
							<div class="profileSet-ui-block-content">
								<form>
									<div class="row">

										<div class="col-md-3">
											<div class="form-group label-floating is-select">
												<label class="control-label">Who Can Make Connection</label>
												<select class="selectpicker form-control">
													<option value="EO">Everyone</option>
													<option value="EO">Friends of Friends</option>
													<option value="NO">No One</option>
												</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group label-floating is-select">
												<label class="control-label">Who Can View Your Posts</label>
												<select class="selectpicker form-control">
													<option value="US">Friends Only</option>
													<option value="EO">Public</option>
													<option value="EO">Only Me</option>
												</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group label-floating is-select">
												<label class="control-label">Who Can Tagged You</label>
												<select class="selectpicker form-control">
													<option value="US">Friends Only</option>
													<option value="EO">Everyone</option>
													<option value="EO">No One</option>
												</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group label-floating is-select">
												<label class="control-label">Who Can See Your Profile</label>
												<select class="selectpicker form-control">
													<option value="US">Friends Only</option>
													<option value="EO">Everyone</option>
												</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group label-floating is-select">
												<label class="control-label">Who Can Send You Messages</label>
												<select class="selectpicker form-control">
													<option value="US">Friends Only</option>
													<option value="EO">Everyone</option>
												</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group label-floating is-select">
												<label class="control-label">Who Can See Your Friendlist</label>
												<select class="selectpicker form-control">
													<option value="US">No One</option>
													<option value="US">Friends Only</option>
													<option value="EO">Everyone</option>
												</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group label-floating is-select">
												<label class="control-label">Who Can Post Comments</label>
												<select class="selectpicker form-control">
													<option value="US">Friends Only</option>
													<option value="US">Friends of Friends</option>
													<option value="EO">Everyone</option>
												</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group label-floating is-select">
												<label class="control-label">Who Can See Your Photos</label>
												<select class="selectpicker form-control">
													<option value="US">Friends Only</option>
													<option value="US">Friends of Friends</option>
													<option value="EO">Everyone</option>
													<option value="EO">No One</option>
												</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group label-floating is-select">
												<label class="control-label">Who Can See Your Email Address</label>
												<select class="selectpicker form-control">
													<option value="US">Friends Only</option>
													<option value="EO">Everyone</option>
													<option value="US">Friends of Friends</option>
													<option value="US">Only Me</option>
												</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group label-floating is-select">
												<label class="control-label">Who Can See Your Phone Number</label>
												<select class="selectpicker form-control">
													<option value="US">Friends Only</option>
													<option value="EO">Everyone</option>
													<option value="US">Friends of Friends</option>
													<option value="US">Only Me</option>
												</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group label-floating is-select">
												<label class="control-label">Who Can See Your Tagged Posts</label>
												<select class="selectpicker form-control">
													<option value="US">Friends Only</option>
													<option value="EO">Everyone</option>
													<option value="US">Friends of Friends</option>
													<option value="US">Only Me</option>
												</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group label-floating is-select">
												<label class="control-label">Who Can Post on Yor Timeline</label>
												<select class="selectpicker form-control">
													<option value="US">Friends Only</option>
													<option value="US">Only Me</option>
												</select>
											</div>
										</div>

										<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="description-toggle">
												<div class="description-toggle-content">
													<div class="h6">Notifications Sound</div>
													<p>A sound will be played each time you receive a new activity notification</p>
												</div>

												<div class="togglebutton">
													<label>
														<input type="checkbox" checked="">
													</label>
												</div>
											</div>
											<div class="description-toggle">
												<div class="description-toggle-content">
													<div class="h6">Notifications Email</div>
													<p>We’ll send you an email to your account each time you receive a new activity notification</p>
												</div>

												<div class="togglebutton">
													<label>
														<input type="checkbox" checked="">
													</label>
												</div>
											</div>
											<div class="description-toggle">
												<div class="description-toggle-content">
													<div class="h6">Friend’s Birthdays</div>
													<p>Choose wheather or not receive notifications about your friend’s birthdays on your newsfeed</p>
												</div>

												<div class="togglebutton">
													<label>
														<input type="checkbox" checked="">
													</label>
												</div>
											</div>
											<div class="description-toggle">
												<div class="description-toggle-content">
													<div class="h6">Chat Message Sound</div>
													<p>A sound will be played each time you receive a new message on an inactive chat window</p>
												</div>

												<div class="togglebutton">
													<label>
														<input type="checkbox" checked="">
													</label>
												</div>
											</div>
											<div class="description-toggle">
												<div class="description-toggle-content">
													<div class="h6">Block Users</div>
													<p>Once you block someone, that person can no longer see things you post on your timeline, start a conversation with you, or add you as a friend</p>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-3" style="padding-top: 25px;">
												<button class="btn btn-restore btn-sm full-width">Restore all Attributes</button>
											</div>
											<div class="col-md-3" style=" margin-left: -30px;padding-left: 0px;padding-top: 25px;">
												<button class="btn btn-save-change btn-sm full-width">Save all Changes</button>
											</div>
										</div>
									</div>
								</form>
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