@extends('frontend.layout.app')
@push('css-style')
	<link href="{{asset('public/css/map.css')}}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/css/dropdown_com.css')}}" />

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


<section class="profile_page">
	 <div class="container-fluid">
	 	<div class="row">
	 		<div class="col-md-10 profile-left-section">
				<div class="row">
					<div class="col-md-3" style="padding-right: 3px;">
						@include('frontend.common.profile_setting_left')
					</div>
					<div class="col-md-9"> 
						<div class="profileSet-ui-block" style="max-height: 575px;max-width: 795px;">
							<div class="profileSet-ui-block-title" style="border-bottom: 1px solid #e6ecf5;">
								<h6 class="title" style="width: 725px;">Chat / Messages</h6>
								<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
							</div>

							<div class="row">
								<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 padding-r-0 ">
									<ul class="notification-list chat-message chatmessagelist chatlistCustomScrollbar">
										<li>
											<div class="author-thumb">
												<img src="public/frontend/img/avatar8-sm.jpg" alt="author">
											</div>
											<div class="notification-event">
												<a href="#" class="h6 notification-friend">Diana Jameson</a>
												<span class="chat-message-item">Hi James! It’s Diana, I just wanted to let you know that we have to reschedule...</span>
												<span class="notification-list-date"><time class="entry-date updated" datetime="2004-07-24T18:18">4 hours ago</time></span>
											</div>
												
										</li>

										<li>
											<div class="author-thumb">
												<img src="public/frontend/img/avatar9-sm.jpg" alt="author">
											</div>
											<div class="notification-event">
												<a href="#" class="h6 notification-friend">Jake Parker</a>
												<span class="chat-message-item">Great, I’ll see you tomorrow!.</span>
												<span class="notification-list-date"><time class="entry-date updated" datetime="2004-07-24T18:18">4 hours ago</time></span>
											</div>
										</li>
										<li>
											<div class="author-thumb">
												<img src="public/frontend/img/avatar10-sm.jpg" alt="author">
											</div>
											<div class="notification-event">
												<a href="#" class="h6 notification-friend">Elaine Dreyfuss</a>
												<span class="chat-message-item">We’ll have to check that at the office and see if the client is on board with...</span>
												<span class="notification-list-date"><time class="entry-date updated" datetime="2004-07-24T18:18">Yesterday at 9:56pm</time></span>
											</div>
										</li>
										<li>
											<div class="author-thumb">
												<img src="public/frontend/img/avatar10-sm.jpg" alt="author">
											</div>
											<div class="notification-event">
												<a href="#" class="h6 notification-friend">Elaine Dreyfuss</a>
												<span class="chat-message-item">We’ll have to check that at the office and see if the client is on board with...</span>
												<span class="notification-list-date"><time class="entry-date updated" datetime="2004-07-24T18:18">Yesterday at 9:56pm</time></span>
											</div>
										</li><li>
											<div class="author-thumb">
												<img src="public/frontend/img/avatar10-sm.jpg" alt="author">
											</div>
											<div class="notification-event">
												<a href="#" class="h6 notification-friend">Elaine Dreyfuss</a>
												<span class="chat-message-item">We’ll have to check that at the office and see if the client is on board with...</span>
												<span class="notification-list-date"><time class="entry-date updated" datetime="2004-07-24T18:18">Yesterday at 9:56pm</time></span>
											</div>
										</li>
									</ul>

								</div>

								<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 padding-l-0">
									<div class="chat-field">
<!-- 										<div class="profileSet-ui-block-title">
	<h6 class="title" style="width: 395px;">Elaine Dreyfuss</h6>
	<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
</div> -->
										<div class="mCustomScrollbar" data-mcs-theme="dark" style="overflow-y: scroll !important;">
											<ul class="notification-list chat-message chat-message-field">
												<li>
													<div class="author-thumb">
														<img src="public/frontend/img/avatar10-sm.jpg" alt="author">
													</div>
													<div class="notification-event">
														<a href="#" class="h6 notification-friend">Elaine Dreyfuss</a>
														<span class="notification-chat-message-date"><time class="entry-date updated" datetime="2004-07-24T18:18">Yesterday at 8:10pm</time></span>
														<span class="chat-message-item">Hi James, How are your doing? Please remember that next week we are going to Gotham Bar to celebrate Marina’s Birthday.</span>
													</div>
												</li>

												<li>
													<div class="author-thumb">
														<img src="public/frontend/img/author-page.jpg" alt="author">
													</div>
													<div class="notification-event">
														<a href="#" class="h6 notification-friend">James Spiegel</a>
														<span class="notification-chat-message-date"><time class="entry-date updated" datetime="2004-07-24T18:18">Yesterday at 8:30pm</time></span>
													<span class="chat-message-item">Hi Elaine! I have a question, do you think that tomorrow we could talk to
														the client to iron out some details before the presentation? I already finished the first screen but
														I need to ask him something before moving on. Anyway, here’s a preview!
													</span>
														<div class="added-photos">
															<img src="public/frontend/img/photo-message1.jpg" alt="photo">
															<img src="public/frontend/img/photo-message2.jpg" alt="photo">
															<span class="photos-name">icons.jpeg; bunny.jpeg</span>
														</div>
													</div>
												</li>

												<li>
													<div class="author-thumb">
														<img src="public/frontend/img/avatar10-sm.jpg" alt="author">
													</div>
													<div class="notification-event">
														<a href="#" class="h6 notification-friend">Elaine Dreyfuss</a>
														<span class="notification-chat-message-date"><time class="entry-date updated" datetime="2004-07-24T18:18">Yesterday at 9:56pm</time></span>
														<span class="chat-message-item">We’ll have to check that at the office and see if the client is on board with it. I think That looks really good!</span>
													</div>
												</li>
											</ul>
										</div>

										<form>

											<div class="form-group">
												<textarea class="messenger-text" placeholder="What's on your mind..."></textarea>
											</div>

											<div class="add-options-message add-options-message-sidemap">
												
												<a href="#" class="options-message">
													<svg class="olymp-computer-icon"><use xlink:href="icons/icons.svg#olymp-computer-icon"></use></svg>
												</a>
												<a href="#" class="options-message">
													<svg class="olymp-computer-icon"><use xlink:href="icons/icons.svg#olymp-computer-icon"></use></svg>
												</a>
												<div class="options-message smile-block">
													<svg class="olymp-happy-sticker-icon"><use xlink:href="icons/icons.svg#olymp-happy-sticker-icon"></use></svg>

													<ul class="more-dropdown more-with-triangle triangle-bottom-right">
														<li>
															<a href="#">
																<img src="public/frontend/img/icon-chat1.png" alt="icon">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/icon-chat2.png" alt="icon">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/icon-chat3.png" alt="icon">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/icon-chat4.png" alt="icon">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/icon-chat5.png" alt="icon">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/icon-chat6.png" alt="icon">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/icon-chat7.png" alt="icon">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/icon-chat8.png" alt="icon">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/icon-chat9.png" alt="icon">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/icon-chat10.png" alt="icon">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/icon-chat11.png" alt="icon">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/icon-chat12.png" alt="icon">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/icon-chat13.png" alt="icon">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/icon-chat14.png" alt="icon">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/icon-chat15.png" alt="icon">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/icon-chat16.png" alt="icon">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/icon-chat17.png" alt="icon">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/icon-chat18.png" alt="icon">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/icon-chat19.png" alt="icon">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/icon-chat20.png" alt="icon">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/icon-chat21.png" alt="icon">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/icon-chat22.png" alt="icon">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/icon-chat23.png" alt="icon">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/icon-chat24.png" alt="icon">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/icon-chat25.png" alt="icon">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/icon-chat26.png" alt="icon">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/icon-chat27.png" alt="icon">
															</a>
														</li>
													</ul>
												</div>
												<a href="#" class="options-message">
													<button class="msg_send_btn"><i class="fa fa-paper-plane-o"></i></button>
												</a>
											</div>

										</form>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
	 		</div>
	 		<div class="col-md-2 chat-right-section">
				<div class="profileSet-ui-block">
					<div class="profileSet-ui-block-title">
						<div class="post__author author vcard inline-items">
							<img src="public/frontend/img/avatar10-sm.jpg" alt="author">

							<div class="author-date">
								<a class="h6 post__author-name fn" href="02-ProfilePage.html">Elaine Dreyfuss</a>
								<div class="post__date" style="margin-top: 5px;">
									<time class="published" datetime="2017-03-24T18:18">
										 <strong>Active</strong> 19 hours ago
									</time>
								</div>
							</div>

							<div class="more"><i class="fa fa-cog" aria-hidden="true"></i>
								<ul class="more-dropdown">
									<li>
										<a href="#">Edit Post</a>
									</li>
									<li>
										<a href="#">Delete Post</a>
									</li>
									<li>
										<a href="#">Turn Off Notifications</a>
									</li>
									<li>
										<a href="#">Select as Featured</a>
									</li>
								</ul>
							</div>

						</div>
					</div>

					<ul class="widget w-friend-pages-added notification-list friend-requests">
						
					</ul>

				</div>
	 		</div>
	 	</div>
	 </div>
</section>
  
  


@endsection