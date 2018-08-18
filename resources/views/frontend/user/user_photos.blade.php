
<div class="photos_section">
	<div class="row photos_section-row">
		<div class="col-md-12">
			<div class="photos-ui-block">
				<div class="photos-ui-block-title">
					<div class="h6 title">{{$user_info['firstname']}} {{$user_info['middlename']}} {{$user_info['lastname']}}’s Photo Gallery</div>

					<ul class="nav nav-tabs photo-gallery" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#photo-page" role="tab">
								<svg class="olymp-photos-icon"><use xlink:href="public/frontend/icons/icons.svg#olymp-photos-icon"></use></svg>
							</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#album-page" role="tab">
								<svg class="olymp-albums-icon"><use xlink:href="public/frontend/icons/icons.svg#olymp-albums-icon"></use></svg>
							</a>
						</li>
					</ul>

					<a href="#" class="more"><i class="fa fa-ellipsis-h dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i></a>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="photos_section">
	<div class="row photos_section-row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<!-- Tab panes -->
				<div class="tab-content photo-tab-content">
					<div class="tab-pane" id="photo-page" role="tabpanel">

						<div class="photo-album-wrapper">

						@foreach($images as $image)
							<div class="photo-item single-photo-item col-4-width">
								<?php 
								$img = $image->images;
								?>
								<img  src='{{asset("images/post/photo/s243/$img")}}' alt="photo">
								<div class="single-photo-overlay overlay-dark"></div>
								<a href="#" class="more"><i style="font-size: 20px;" class="fa fa-ellipsis-h dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i></a>
								<a href="#" class="post-add-icon inline-items">
									<i class="fa fa-heart-o" style="font-size: 22px;color: #fff;" aria-hidden="true"></i>
									<span>15</span>
								</a>
								<?php
								$image_id = $image->_id;
								?>
								<a href="#single_image{{$image_id}}" data-toggle="modal"  class="  full-block"></a>
								<div class="content">
									<a href="#" class="h6 title">Header Photos</a>
									<time class="published" datetime="2017-03-24T18:18">1 week ago</time>
								</div>
							</div>

							<!-- photos-Window-popup Open Photo Popup V1 -->

							<div class="modal fade" id="single_image{{$image_id}}">
								<div class="modal-dialog photos-ui-block photos-window-popup open-photo-popup open-photo-popup-v1" style="width: 970px;height: 1272px;border:none;">
									<a href="#" class="close photos-icon-close" data-dismiss="modal" aria-label="Close">
										<svg class="olymp-close-icon"><use xlink:href="public/frontend/icons/icons.svg#olymp-close-icon"></use></svg>
									</a>

									<div class="open-photo-thumb">
										<div class="swiper-container" data-slide="fade">
											<div class="swiper-wrapper">

												<div class="swiper-slide">
													<div class="open-photo-item">
														<img src='{{asset("images/post/photo/s243/$img")}}' height="630px" width="970px;" alt="photo">
													</div>
												</div>


											</div>

											<!--Prev Next Arrows-->

											<svg class="btn-next-without olymp-popup-right-arrow"><use xlink:href="public/frontend/icons/icons.svg#olymp-popup-right-arrow"></use></svg>

											<svg class="btn-prev-without olymp-popup-left-arrow"><use xlink:href="public/frontend/icons/icons.svg#olymp-popup-left-arrow"></use></svg>
										</div>
									</div>

									<div class="open-photo-content">

										<article class="hentry post">

											<div class="post__author author vcard inline-items">
												<img src="public/frontend/img/author-page.jpg" alt="author">
												<?php 
												$post_id = $image->fk_post_id;
												$post = App\Models\Posts::where('_id',$post_id)->first();
												?>
												<div class="author-date">
													<a class="h6 post__author-name fn" href="02-ProfilePage.html">{{$user_info['firstname']}} {{$user_info['middlename']}} {{$user_info['lastname']}}</a>
													<div class="post__date">
														<time class="published" datetime="2017-03-24T18:18">
															{{$post->created_at->diffForHumans()}}
														</time>
													</div>
												</div>

												<div class="more dropdown photo-dropdown">
													<i class="fa fa-ellipsis-h dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
													<ul class="dropdown-menu photo-dropdown-ul">
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

											<p>{{$post->description}}</p>

											<div class="post-additional-info inline-items">

												<a href="#" class="post-add-icon inline-items">
													<svg class="olymp-heart-icon"><use xlink:href="public/frontend/icons/icons.svg#olymp-heart-icon"></use></svg>
													<span>148 Likes</span>
												</a>
							 
												<ul class="friends-harmonic" style="margin-right: 2px;">
													<li>
														<a href="#">
															<img src="public/frontend/img/friend-harmonic7.jpg" alt="friend">
														</a>
													</li>
													<li>
														<a href="#">
															<img src="public/frontend/img/friend-harmonic8.jpg" alt="friend">
														</a>
													</li>
													<li>
														<a href="#">
															<img src="public/frontend/img/friend-harmonic9.jpg" alt="friend">
														</a>
													</li>
													<li>
														<a href="#">
															<img src="public/frontend/img/friend-harmonic10.jpg" alt="friend">
														</a>
													</li>
													<li>
														<a href="#">
															<img src="public/frontend/img/friend-harmonic11.jpg" alt="friend">
														</a>
													</li>
												</ul>

												<div class="names-people-likes">
													<a href="#">Diana</a>, <a href="#">Nicholas</a> and
													<br>13 more liked this
												</div>


												<div class="comments-shared">
													<a href="#" class="post-add-icon inline-items">
														<svg class="olymp-speech-balloon-icon"><use xlink:href="public/frontend/icons/icons.svg#olymp-speech-balloon-icon"></use></svg>
														<span>61 Comments</span>
													</a>

												</div>


											</div>

										</article>

										<div class="mCustomScrollbar" data-mcs-theme="dark" style="overflow-y: scroll;">

											<ul class="comments-list">
												<li>
													<div class="post__author author vcard inline-items">
														<img src="public/frontend/img/avatar48-sm.jpg" alt="author">

														<div class="author-date">
															<a class="h6 post__author-name fn" href="#">Marina Valentine</a>
															<div class="post__date">
																<time class="published" datetime="2017-03-24T18:18">
																	46 mins ago
																</time>
															</div>
														</div>

														<a href="#" class="more"><i class="fa fa-ellipsis-h dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i></a>

													</div>

													<p>I had a great time too!! We should do it again!</p>

													<a href="#" class="post-add-icon inline-items">
														<svg class="olymp-heart-icon"><use xlink:href="public/frontend/icons/icons.svg#olymp-heart-icon"></use></svg>
														<span>8 Likes</span>
													</a>
													<a href="#" class="reply" style="color: #c2c5d9;margin-left: 15px;">Reply</a>
												</li>

												<li>
													<div class="post__author author vcard inline-items">
														<img src="public/frontend/img/avatar4-sm.jpg" alt="author">

														<div class="author-date">
															<a class="h6 post__author-name fn" href="#">Chris Greyson</a>
															<div class="post__date">
																<time class="published" datetime="2017-03-24T18:18">
																	1 hour ago
																</time>
															</div>
														</div>

														<a href="#" class="more"><i class="fa fa-ellipsis-h dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i></a>

													</div>

													<p>Dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit.</p>

													<a href="#" class="post-add-icon inline-items">
														<svg class="olymp-heart-icon"><use xlink:href="public/frontend/icons/icons.svg#olymp-heart-icon"></use></svg>
														<span>7 Likes</span>
													</a>
													<a href="#" class="reply" style="color: #c2c5d9;margin-left: 15px;">Reply</a>

												</li>
											</ul>

										</div>

										<form class="comment-form inline-items">

											<div class="post__author author vcard inline-items">
												<img src="public/frontend/img/author-page.jpg" alt="author">

												<div class="form-group with-icon-right ">
													<textarea class="form-control photo-form-control" placeholder="Press Enter to post..." style="resize: none;"></textarea>
													<div class="add-photo-options-message">
														<a href="#" class="options-message">
															<svg class="olymp-camera-icon"><use xlink:href="public/frontend/icons/icons.svg#olymp-camera-icon"></use></svg>
														</a>
													</div>
												</div>
											</div>

										</form>

									</div>

								</div>
							</div>

							<!-- ... end photos-Window-popup Open Photo Popup V1 -->
						@endforeach

							<a href="#" class="btn photo-btn-control btn-more"><i class="fa fa-ellipsis-h dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i></a>

						</div>

					</div>

					<div class="tab-pane active" id="album-page" role="tabpanel">

						<div class="photo-album-wrapper">

							<div class="photo-album-item-wrap col-4-width" >
								<div class="photo-album-item create-album" data-mh="album-item" style="height: 412px;">

									<a href="#" data-toggle="modal" data-target="#create-photo-album" class="  full-block"></a>

									<div class="content">

										<a href="#" class="btn photo-btn-control bg-primary-icons" data-toggle="modal" data-target="#create-photo-album">
											<svg class="olymp-plus-icon"><use xlink:href="public/frontend/icons/icons.svg#olymp-plus-icon"></use></svg>
										</a>

										<a href="#" class="title h5 create-album-title" data-toggle="modal" data-target="#create-photo-album">Create an Album</a>
										<span class="sub-title">It only takes a few minutes!</span>

									</div>

								</div>
							</div>

							<div class="photo-album-item-wrap col-4-width">
								<div class="photo-album-item" data-mh="album-item">
									<div class="photo-item album-photo-item">
										<img src="public/frontend/img/photo-item2.jpg" alt="photo">
										<div class="overlay overlay-dark"></div>
										<a href="#" class="more"><i class="fa fa-ellipsis-h dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i></a>
										<a href="#" class="post-add-icon">
											<i class="fa fa-heart-o" style="font-size: 22px;color: #fff;" aria-hidden="true"></i>
											<span>324</span>
										</a>
										<a href="#" data-toggle="modal" data-target="#open-photo-popup-v2" class="  full-block"></a>
									</div>

									<div class="content">
										<div class="album-title-section">
											<a href="#" class="title h5">South America Vacations</a>
											<span class="sub-title">Last Added: 2 hours ago</span>
										</div>

										<div class="swiper-container">
											<div class="swiper-wrapper">
												<div class="swiper-slide">
													<ul class="friends-harmonic">
														<li>
															<a href="#">
																<img src="public/frontend/img/friend-harmonic5.jpg" alt="friend">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/friend-harmonic10.jpg" alt="friend">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/friend-harmonic7.jpg" alt="friend">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/friend-harmonic8.jpg" alt="friend">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/friend-harmonic2.jpg" alt="friend">
															</a>
														</li>
													</ul>
													<div class="friend-count">
														<a href="#" class="photo-count-item">
															<div class="h6">24</div>
															<div class="title" style="font-size: 13px;">Photos</div>
														</a>
														<a href="#" class="photo-count-item">
															<div class="h6">86</div>
															<div class="title" style="font-size: 13px;">Comments</div>
														</a>
														<a href="#" class="photo-count-item">
															<div class="h6">16</div>
															<div class="title" style="font-size: 13px;">Share</div>
														</a>
													</div>
												</div>
											</div>

											<!-- If we need pagination -->
											<div class="swiper-pagination"></div>
										</div>
									</div>

								</div>
							</div>

							<div class="photo-album-item-wrap col-4-width">
								<div class="photo-album-item" data-mh="album-item">
									<div class="photo-item album-photo-item">
										<img src="public/frontend/img/photo-album1.jpg" alt="photo">
										<div class="overlay overlay-dark"></div>
										<a href="#" class="more"><i class="fa fa-ellipsis-h dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i></a>
										<a href="#" class="post-add-icon">
											<i class="fa fa-heart-o" style="font-size: 22px;color: #fff;" aria-hidden="true"></i>
											<span>324</span>
										</a>

										<a href="#" data-toggle="modal" data-target="#open-photo-popup-v1" class="  full-block"></a>
									</div>

									<div class="content">
										<div class="album-title-section">
											<a href="#" class="title h5">Photoshoot Summer 2016</a>
											<span class="sub-title">Last Added: 5 weeks ago</span>
										</div>

										<div class="swiper-container" data-slide="fade">
											<div class="swiper-wrapper">
												<div class="swiper-slide">
													<ul class="friends-harmonic">
														<li>
															<a href="#">
																<img src="public/frontend/img/friend-harmonic5.jpg" alt="friend">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/friend-harmonic10.jpg" alt="friend">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/friend-harmonic7.jpg" alt="friend">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/friend-harmonic8.jpg" alt="friend">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/friend-harmonic2.jpg" alt="friend">
															</a>
														</li>
													</ul>
													<div class="friend-count">
														<a href="#" class="photo-count-item">
															<div class="h6">24</div>
															<div class="title" style="font-size: 13px;">Photos</div>
														</a>
														<a href="#" class="photo-count-item">
															<div class="h6">86</div>
															<div class="title" style="font-size: 13px;">Comments</div>
														</a>
														<a href="#" class="photo-count-item">
															<div class="h6">16</div>
															<div class="title" style="font-size: 13px;">Share</div>
														</a>
													</div>
												</div>
											</div>

											<!-- If we need pagination -->
											<div class="swiper-pagination"></div>
										</div>
									</div>

								</div>
							</div>

							<div class="photo-album-item-wrap col-4-width">
								<div class="photo-album-item" data-mh="album-item">
									<div class="photo-item album-photo-item">
										<img src="public/frontend/img/photo-album2.jpg" alt="photo">
										<div class="overlay overlay-dark"></div>
										<a href="#" class="more"><i class="fa fa-ellipsis-h dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i></a>
										<a href="#" class="post-add-icon">
											<i class="fa fa-heart-o" style="font-size: 22px;color: #fff;" aria-hidden="true"></i>
											<span>324</span>
										</a>

										<a href="#" data-toggle="modal" data-target="#open-photo-popup-v1" class="  full-block"></a>
									</div>

									<div class="content">
										<div class="album-title-section">
											<a href="#" class="title h5">Amazing Street Food</a>
										<span class="sub-title">Last Added: 6 mins ago</span>
										</div>

										<div class="swiper-container" data-slide="fade">
											<div class="swiper-wrapper">
												<div class="swiper-slide">
													<ul class="friends-harmonic">
														<li>
															<a href="#">
																<img src="public/frontend/img/friend-harmonic10.jpg" alt="friend">
															</a>
														</li>
													</ul>
													<div class="friend-count">
														<a href="#" class="photo-count-item">
															<div class="h6">24</div>
															<div class="title" style="font-size: 13px;">Photos</div>
														</a>
														<a href="#" class="photo-count-item">
															<div class="h6">86</div>
															<div class="title" style="font-size: 13px;">Comments</div>
														</a>
														<a href="#" class="photo-count-item">
															<div class="h6">16</div>
															<div class="title" style="font-size: 13px;">Share</div>
														</a>
													</div>
												</div>
											</div>

											<!-- If we need pagination -->
											<div class="swiper-pagination"></div>
										</div>
									</div>

								</div>
							</div>

							<div class="photo-album-item-wrap col-4-width">
								<div class="photo-album-item" data-mh="album-item">
									<div class="photo-item album-photo-item">
										<img src="public/frontend/img/photo-album3.jpg" alt="photo">
										<div class="overlay overlay-dark"></div>
										<a href="#" class="more"><i class="fa fa-ellipsis-h dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i></a>
										<a href="#" class="post-add-icon">
											<i class="fa fa-heart-o" style="font-size: 22px;color: #fff;" aria-hidden="true"></i>
											<span>324</span>
										</a>

										<a href="#" data-toggle="modal" data-target="#open-photo-popup-v1" class="  full-block"></a>
									</div>

									<div class="content">
										<div class="album-title-section">
											<a href="#" class="title h5">Graffiti & Street Art</a>
											<span class="sub-title">Last Added: 16 hours ago</span>
										</div>

										<div class="swiper-container" data-slide="fade">
											<div class="swiper-wrapper">
												<div class="swiper-slide">
													<ul class="friends-harmonic">
														<li>
															<a href="#">
																<img src="public/frontend/img/friend-harmonic10.jpg" alt="friend">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/friend-harmonic7.jpg" alt="friend">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/friend-harmonic8.jpg" alt="friend">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/friend-harmonic2.jpg" alt="friend">
															</a>
														</li>
													</ul>
													<div class="friend-count">
														<a href="#" class="photo-count-item">
															<div class="h6">24</div>
															<div class="title" style="font-size: 13px;">Photos</div>
														</a>
														<a href="#" class="photo-count-item">
															<div class="h6">86</div>
															<div class="title" style="font-size: 13px;">Comments</div>
														</a>
														<a href="#" class="photo-count-item">
															<div class="h6">16</div>
															<div class="title" style="font-size: 13px;">Share</div>
														</a>
													</div>
												</div>
											</div>

											<!-- If we need pagination -->
											<div class="swiper-pagination"></div>
										</div>
									</div>

								</div>
							</div>

							<div class="photo-album-item-wrap col-4-width">
								<div class="photo-album-item" data-mh="album-item">
									<div class="photo-item album-photo-item">
										<img src="public/frontend/img/photo-album4.jpg" alt="photo">
										<div class="overlay overlay-dark"></div>
										<a href="#" class="more"><i class="fa fa-ellipsis-h dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i></a>
										<a href="#" class="post-add-icon">
											<i class="fa fa-heart-o" style="font-size: 22px;color: #fff;" aria-hidden="true"></i>
											<span>324</span>
										</a>

										<a href="#" data-toggle="modal" data-target="#open-photo-popup-v1" class="  full-block"></a>
									</div>

									<div class="content">
										<div class="album-title-section">
											<a href="#" class="title h5">Amazing Landscapes</a>
											<span class="sub-title">Last Added: 13 mins ago</span>
										</div>

										<div class="swiper-container" data-slide="fade">
											<div class="swiper-wrapper">
												<div class="swiper-slide">
													<ul class="friends-harmonic">
														<li>
															<a href="#">
																<img src="public/frontend/img/friend-harmonic5.jpg" alt="friend">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/friend-harmonic10.jpg" alt="friend">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/friend-harmonic7.jpg" alt="friend">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/friend-harmonic8.jpg" alt="friend">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/friend-harmonic2.jpg" alt="friend">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/avatar30-sm.jpg" alt="author">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/avatar29-sm.jpg" alt="user">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/avatar28-sm.jpg" alt="user">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/avatar27-sm.jpg" alt="user">
															</a>
														</li>
														<li>
															<a href="#" class="all-users">+3</a>
														</li>
													</ul>
													<div class="friend-count">
														<a href="#" class="photo-count-item">
															<div class="h6">24</div>
															<div class="title" style="font-size: 13px;">Photos</div>
														</a>
														<a href="#" class="photo-count-item">
															<div class="h6">86</div>
															<div class="title" style="font-size: 13px;">Comments</div>
														</a>
														<a href="#" class="photo-count-item">
															<div class="h6">16</div>
															<div class="title" style="font-size: 13px;">Share</div>
														</a>
													</div>
												</div>
											</div>

											<!-- If we need pagination -->
											<div class="swiper-pagination"></div>
										</div>
									</div>

								</div>
							</div>

							<div class="photo-album-item-wrap col-4-width">
								<div class="photo-album-item" data-mh="album-item">
									<div class="photo-item album-photo-item">
										<img src="public/frontend/img/photo-item6.jpg" alt="photo">
										<div class="overlay overlay-dark"></div>
										<a href="#" class="more"><i class="fa fa-ellipsis-h dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i></a>
										<a href="#" class="post-add-icon">
											<i class="fa fa-heart-o" style="font-size: 22px;color: #fff;" aria-hidden="true"></i>
											<span>324</span>
										</a>

										<a href="#" data-toggle="modal" data-target="#open-photo-popup-v1" class="  full-block"></a>
									</div>

									<div class="content">
										<div class="album-title-section">
											<a href="#" class="title h5">The Majestic Canyon</a>
											<span class="sub-title">Last Added: 57 mins ago</span>
										</div>

										<div class="swiper-container" data-slide="fade">
											<div class="swiper-wrapper">
												<div class="swiper-slide">
													<ul class="friends-harmonic">
														<li>
															<a href="#">
																<img src="public/frontend/img/friend-harmonic10.jpg" alt="friend">
															</a>
														</li>
													</ul>
													<div class="friend-count">
														<a href="#" class="photo-count-item">
															<div class="h6">24</div>
															<div class="title" style="font-size: 13px;">Photos</div>
														</a>
														<a href="#" class="photo-count-item">
															<div class="h6">86</div>
															<div class="title" style="font-size: 13px;">Comments</div>
														</a>
														<a href="#" class="photo-count-item">
															<div class="h6">16</div>
															<div class="title" style="font-size: 13px;">Share</div>
														</a>
													</div>
												</div>
											</div>

											<!-- If we need pagination -->
											<div class="swiper-pagination"></div>
										</div>
									</div>

								</div>
							</div>

							<div class="photo-album-item-wrap col-4-width">
								<div class="photo-album-item" data-mh="album-item">
									<div class="photo-item album-photo-item">
										<img src="public/frontend/img/photo-album5.jpg" alt="photo">
										<div class="overlay overlay-dark"></div>
										<a href="#" class="more"><i class="fa fa-ellipsis-h dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i></a>
										<a href="#" class="post-add-icon">
											<i class="fa fa-heart-o" style="font-size: 22px;color: #fff;" aria-hidden="true"></i>
											<span>324</span>
										</a>

										<a href="#" data-toggle="modal" data-target="#open-photo-popup-v1" class="  full-block"></a>
									</div>

									<div class="content">
										<div class="album-title-section">
											<a href="#" class="title h5">Winter 2015 Portraits</a>
										<span class="sub-title">Last Added: 1 year ago</span>
										</div>

										<div class="swiper-container" data-slide="fade">
											<div class="swiper-wrapper">
												<div class="swiper-slide">
													<ul class="friends-harmonic">
														<li>
															<a href="#">
																<img src="public/frontend/img/friend-harmonic10.jpg" alt="friend">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/avatar30-sm.jpg" alt="author">
															</a>
														</li>
														<li>
															<a href="#">
																<img src="public/frontend/img/avatar29-sm.jpg" alt="user">
															</a>
														</li>
													</ul>
													<div class="friend-count">
														<a href="#" class="photo-count-item">
															<div class="h6">24</div>
															<div class="title" style="font-size: 13px;">Photos</div>
														</a>
														<a href="#" class="photo-count-item">
															<div class="h6">86</div>
															<div class="title" style="font-size: 13px;">Comments</div>
														</a>
														<a href="#" class="photo-count-item">
															<div class="h6">16</div>
															<div class="title" style="font-size: 13px;">Share</div>
														</a>
													</div>
												</div>
											</div>

											<!-- If we need pagination -->
											<div class="swiper-pagination"></div>
										</div>
									</div>

								</div>
							</div>

						</div>

					</div>
				</div>

			</div>
	</div>
</div>







<!-- photos-Window-popup Create Photo Album -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
	$(document).ready(function() {
	   $('.selectpicker').selectpicker();
	});
</script>

<div class="modal fade" id="create-photo-album">
	<div class="modal-dialog photos-ui-block photos-window-popup create-photo-album" style="height: auto;width: 60%;">
		<a href="#" class="close photos-icon-close" data-dismiss="modal" aria-label="Close">
			<svg class="olymp-close-icon"><use xlink:href="public/frontend/icons/icons.svg#olymp-close-icon"></use></svg>
		</a>

	<div class="photos-ui-block-title">
		<h6 class="title photo-modal-title">Create Photo Album</h6>
	</div>

	<div class="photos-ui-block-content">

		<form class="form-group label-floating">
			<label class="control-label albumName">Album Name</label>
			<input class="form-control photo-form-control albumNameFormControl" placeholder="" type="text" value="Rock Garden Festival - Day 4">
		</form>

		<div class="photo-album-wrapper">
			<div class="photo-album-item-wrap col-3-width" >
				<div class="photo-album-item create-album" data-mh="album-item">
					<div class="content">
						<a href="#" class="btn photo-btn-control bg-primary-icons">
							<svg class="olymp-plus-icon"><use xlink:href="public/frontend/icons/icons.svg#olymp-plus-icon"></use></svg>
						</a>

						<a href="#" data-toggle="modal" data-target="#update-header-photo" class="title h5">Add More Photos...</a>
					</div>
				</div>
			</div>

			<div class="photo-album-item-wrap col-3-width" >
				<div class="photo-album-item" data-mh="album-item">
					<div class="form-group">
						<img src="public/frontend/img/photo-album6.jpg" alt="photo">
						<textarea style="height: 135px;padding: 17px;" class="form-control photo-form-control" placeholder="Write something about this photo..."></textarea>
					</div>

					<form class="form-group label-floating is-select">
						<svg class="olymp-happy-face-icon"><use xlink:href="public/frontend/icons/icons.svg#olymp-happy-face-icon"></use></svg>

						<select class="selectpicker form-control photo-form-control style-2 show-tick" multiple  data-live-search="true">
							<option title="Green Goo Rock" data-content='<div class="inline-items">
										<div class="author-thumb">
											<img src="public/frontend/img/avatar52-sm.jpg" alt="author">
										</div>
											<div class="h6 author-title">Green Goo Rock</div>

										</div>'>Green Goo Rock
							</option>

							<option title="Mathilda Brinker" data-content='<div class="inline-items">
											<div class="author-thumb">
												<img src="public/frontend/img/avatar74-sm.jpg" alt="author">
											</div>
											<div class="h6 author-title">Mathilda Brinker</div>
										</div>'>Mathilda Brinker
							</option>

							<option title="Marina Valentine" data-content='<div class="inline-items">
											<div class="author-thumb">
												<img src="public/frontend/img/avatar48-sm.jpg" alt="author">
											</div>
											<div class="h6 author-title">Marina Valentine</div>
										</div>'>Marina Valentine
							</option>

							<option title="Dave Marinara" data-content='<div class="inline-items">
											<div class="author-thumb">
												<img src="public/frontend/img/avatar75-sm.jpg" alt="author">
											</div>
											<div class="h6 author-title">Dave Marinara</div>
										</div>'>Dave Marinara
							</option>

							<option title="Rachel Howlett" data-content='<div class="inline-items">
											<div class="author-thumb">
												<img src="public/frontend/img/avatar76-sm.jpg" alt="author">
											</div>
											<div class="h6 author-title">Rachel Howlett</div>
										</div>'>Rachel Howlett
							</option>

						</select>
					</form>
				</div>
			</div>

			<div class="photo-album-item-wrap col-3-width" >
				<div class="photo-album-item" data-mh="album-item">
					<div class="form-group">
						<img src="public/frontend/img/photo-album7.jpg" alt="photo">
						<textarea style="height: 135px;padding: 17px;" class="form-control photo-form-control" placeholder="Write something about this photo..."></textarea>
					</div>
					<form class="form-group label-floating is-select">
						<svg class="olymp-happy-face-icon"><use xlink:href="public/frontend/icons/icons.svg#olymp-happy-face-icon"></use></svg>

						<select class="selectpicker form-control photo-form-control style-2 show-tick" multiple data-max-options="2" data-live-search="true">
							<option title="Green Goo Rock" data-content='<div class="inline-items">
										<div class="author-thumb">
											<img src="public/frontend/img/avatar52-sm.jpg" alt="author">
										</div>
											<div class="h6 author-title">Green Goo Rock</div>

										</div>'>Green Goo Rock
							</option>

							<option title="Mathilda Brinker" data-content='<div class="inline-items">
											<div class="author-thumb">
												<img src="public/frontend/img/avatar74-sm.jpg" alt="author">
											</div>
											<div class="h6 author-title">Mathilda Brinker</div>
										</div>'>Mathilda Brinker
							</option>

							<option title="Marina Valentine" data-content='<div class="inline-items">
											<div class="author-thumb">
												<img src="public/frontend/img/avatar48-sm.jpg" alt="author">
											</div>
											<div class="h6 author-title">Marina Valentine</div>
										</div>'>Marina Valentine
							</option>

							<option title="Dave Marinara" data-content='<div class="inline-items">
											<div class="author-thumb">
												<img src="public/frontend/img/avatar75-sm.jpg" alt="author">
											</div>
											<div class="h6 author-title">Dave Marinara</div>
										</div>'>Dave Marinara
							</option>

							<option title="Rachel Howlett" data-content='<div class="inline-items">
											<div class="author-thumb">
												<img src="public/frontend/img/avatar76-sm.jpg" alt="author">
											</div>
											<div class="h6 author-title">Rachel Howlett</div>
										</div>'>Rachel Howlett
							</option>

						</select>
					</form>
				</div>
			</div>

			<div class="photo-album-item-wrap col-3-width" >
				<div class="photo-album-item" data-mh="album-item">
					<div class="form-group">
						<img src="public/frontend/img/photo-album8.jpg" alt="photo">
						<textarea style="height: 135px;padding: 17px;" class="form-control photo-form-control" placeholder="Write something about this photo..."></textarea>
					</div>

					<form class="form-group label-floating is-select">
						<svg class="olymp-happy-face-icon"><use xlink:href="public/frontend/icons/icons.svg#olymp-happy-face-icon"></use></svg>

						<select class="selectpicker form-control photo-form-control style-2 show-tick" multiple data-max-options="2" data-live-search="true">
							<option title="Green Goo Rock" data-content='<div class="inline-items">
										<div class="author-thumb">
											<img src="public/frontend/img/avatar52-sm.jpg" alt="author">
										</div>
											<div class="h6 author-title">Green Goo Rock</div>

										</div>'>Green Goo Rock
							</option>

							<option title="Mathilda Brinker" data-content='<div class="inline-items">
											<div class="author-thumb">
												<img src="public/frontend/img/avatar74-sm.jpg" alt="author">
											</div>
											<div class="h6 author-title">Mathilda Brinker</div>
										</div>'>Mathilda Brinker
							</option>

							<option title="Marina Valentine" data-content='<div class="inline-items">
											<div class="author-thumb">
												<img src="public/frontend/img/avatar48-sm.jpg" alt="author">
											</div>
											<div class="h6 author-title">Marina Valentine</div>
										</div>'>Marina Valentine
							</option>

							<option title="Dave Marinara" data-content='<div class="inline-items">
											<div class="author-thumb">
												<img src="public/frontend/img/avatar75-sm.jpg" alt="author">
											</div>
											<div class="h6 author-title">Dave Marinara</div>
										</div>'>Dave Marinara
							</option>

							<option title="Rachel Howlett" data-content='<div class="inline-items">
											<div class="author-thumb">
												<img src="public/frontend/img/avatar76-sm.jpg" alt="author">
											</div>
											<div class="h6 author-title">Rachel Howlett</div>
										</div>'>Rachel Howlett
							</option>

						</select>
					</form>
				</div>
			</div>

			<div class="photo-album-item-wrap col-3-width" >
				<div class="photo-album-item" data-mh="album-item">
					<div class="form-group">
						<img src="public/frontend/img/photo-album9.jpg" alt="photo">
						<textarea style="height: 135px;padding: 17px;" class="form-control photo-form-control" placeholder="Write something about this photo..."></textarea>
					</div>

					<form class="form-group label-floating is-select">
						<svg class="olymp-happy-face-icon"><use xlink:href="public/frontend/icons/icons.svg#olymp-happy-face-icon"></use></svg>

						<select class="selectpicker form-control photo-form-control style-2 show-tick" multiple data-max-options="2" data-live-search="true">
							<option title="Green Goo Rock" data-content='<div class="inline-items">
										<div class="author-thumb">
											<img src="public/frontend/img/avatar52-sm.jpg" alt="author">
										</div>
											<div class="h6 author-title">Green Goo Rock</div>
										</div>'>Green Goo Rock
							</option>

							<option title="Mathilda Brinker" data-content='<div class="inline-items">
											<div class="author-thumb">
												<img src="public/frontend/img/avatar74-sm.jpg" alt="author">
											</div>
											<div class="h6 author-title">Mathilda Brinker</div>
										</div>'>Mathilda Brinker
							</option>

							<option title="Marina Valentine" data-content='<div class="inline-items">
											<div class="author-thumb">
												<img src="public/frontend/img/avatar48-sm.jpg" alt="author">
											</div>
											<div class="h6 author-title">Marina Valentine</div>
										</div>'>Marina Valentine
							</option>

							<option title="Dave Marinara" data-content='<div class="inline-items">
											<div class="author-thumb">
												<img src="public/frontend/img/avatar75-sm.jpg" alt="author">
											</div>
											<div class="h6 author-title">Dave Marinara</div>
										</div>'>Dave Marinara
							</option>

							<option title="Rachel Howlett" data-content='<div class="inline-items">
											<div class="author-thumb">
												<img src="public/frontend/img/avatar76-sm.jpg" alt="author">
											</div>
											<div class="h6 author-title">Rachel Howlett</div>
										</div>'>Rachel Howlett
							</option>

						</select>
					</form>
				</div>
			</div>

			<div class="photo-album-item-wrap col-3-width" >
				<div class="photo-album-item" data-mh="album-item">
					<div class="form-group">
						<img src="public/frontend/img/photo-album10.jpg" alt="photo">
						<textarea style="height: 135px;padding: 17px;" class="form-control photo-form-control" placeholder="Write something about this photo..."></textarea>
					</div>

					<form class="form-group label-floating is-select">
						<svg class="olymp-happy-face-icon"><use xlink:href="public/frontend/icons/icons.svg#olymp-happy-face-icon"></use></svg>

								<select class="selectpicker form-control photo-form-control style-2 show-tick" multiple data-max-options="2" data-live-search="true">
									<option title="Green Goo Rock" data-content='<div class="inline-items">
										<div class="author-thumb">
											<img src="public/frontend/img/avatar52-sm.jpg" alt="author">
										</div>
											<div class="h6 author-title">Green Goo Rock</div>

										</div>'>Green Goo Rock
									</option>

									<option title="Mathilda Brinker" data-content='<div class="inline-items">
											<div class="author-thumb">
												<img src="public/frontend/img/avatar74-sm.jpg" alt="author">
											</div>
											<div class="h6 author-title">Mathilda Brinker</div>
										</div>'>Mathilda Brinker
									</option>

									<option title="Marina Valentine" data-content='<div class="inline-items">
											<div class="author-thumb">
												<img src="public/frontend/img/avatar48-sm.jpg" alt="author">
											</div>
											<div class="h6 author-title">Marina Valentine</div>
										</div>'>Marina Valentine
									</option>

									<option title="Dave Marinara" data-content='<div class="inline-items">
											<div class="author-thumb">
												<img src="public/frontend/img/avatar75-sm.jpg" alt="author">
											</div>
											<div class="h6 author-title">Dave Marinara</div>
										</div>'>Dave Marinara
									</option>

									<option title="Rachel Howlett" data-content='<div class="inline-items">
											<div class="author-thumb">
												<img src="public/frontend/img/avatar76-sm.jpg" alt="author">
											</div>
											<div class="h6 author-title">Rachel Howlett</div>
										</div>'>Rachel Howlett
									</option>

								</select>
							</form>

				</div>
			</div>
		</div>

		<a href="#" class="btn  btn-discard btn-lg btn--half-width">Discard Everything</a>
		<a href="#" class="btn  btn-post-album btn-lg btn--half-width">Post Album</a>

	</div>
</div>
</div>

<!-- ... end photos-Window-popup Create Photo Album -->


<!-- photos-Window-popup Choose from my Photo -->

<div class="modal fade" id="choose-from-my-photo">
	<div class="modal-dialog photos-ui-block photos-window-popup choose-from-my-photo">
		<a href="#" class="close photos-icon-close" data-dismiss="modal" aria-label="Close">
			<svg class="olymp-close-icon"><use xlink:href="public/frontend/icons/icons.svg#olymp-close-icon"></use></svg>
		</a>

		<div class="photos-ui-block-title">
			<h6 class="title">Choose from My Photos</h6>

			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" data-toggle="tab" href="#home" role="tab" aria-expanded="true">
						<svg class="olymp-photos-icon"><use xlink:href="public/frontend/icons/icons.svg#olymp-photos-icon"></use></svg>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-expanded="false">
						<svg class="olymp-albums-icon"><use xlink:href="public/frontend/icons/icons.svg#olymp-albums-icon"></use></svg>
					</a>
				</li>
			</ul>
		</div>


		<div class="photos-ui-block-content">
			<!-- Tab panes -->
			<div class="tab-content">
				<div class="tab-pane active" id="home" role="tabpanel" aria-expanded="true">

					<div class="choose-photo-item" data-mh="choose-item">
						<div class="radio">
							<label class="custom-radio">
								<img src="img/choose-photo1.jpg" alt="photo">
								<input type="radio" name="optionsRadios">
							</label>
						</div>
					</div>
					<div class="choose-photo-item" data-mh="choose-item">
						<div class="radio">
							<label class="custom-radio">
								<img src="img/choose-photo2.jpg" alt="photo">
								<input type="radio" name="optionsRadios">
							</label>
						</div>
					</div>
					<div class="choose-photo-item" data-mh="choose-item">
						<div class="radio">
							<label class="custom-radio">
								<img src="img/choose-photo3.jpg" alt="photo">
								<input type="radio" name="optionsRadios">
							</label>
						</div>
					</div>

					<div class="choose-photo-item" data-mh="choose-item">
						<div class="radio">
							<label class="custom-radio">
								<img src="img/choose-photo4.jpg" alt="photo">
								<input type="radio" name="optionsRadios">
							</label>
						</div>
					</div>
					<div class="choose-photo-item" data-mh="choose-item">
						<div class="radio">
							<label class="custom-radio">
								<img src="img/choose-photo5.jpg" alt="photo">
								<input type="radio" name="optionsRadios">
							</label>
						</div>
					</div>
					<div class="choose-photo-item" data-mh="choose-item">
						<div class="radio">
							<label class="custom-radio">
								<img src="img/choose-photo6.jpg" alt="photo">
								<input type="radio" name="optionsRadios">
							</label>
						</div>
					</div>

					<div class="choose-photo-item" data-mh="choose-item">
						<div class="radio">
							<label class="custom-radio">
								<img src="img/choose-photo7.jpg" alt="photo">
								<input type="radio" name="optionsRadios">
							</label>
						</div>
					</div>
					<div class="choose-photo-item" data-mh="choose-item">
						<div class="radio">
							<label class="custom-radio">
								<img src="img/choose-photo8.jpg" alt="photo">
								<input type="radio" name="optionsRadios">
							</label>
						</div>
					</div>
					<div class="choose-photo-item" data-mh="choose-item">
						<div class="radio">
							<label class="custom-radio">
								<img src="img/choose-photo9.jpg" alt="photo">
								<input type="radio" name="optionsRadios">
							</label>
						</div>
					</div>


					<a href="#" class="btn btn-secondary btn-lg btn--half-width">Cancel</a>
					<a href="#" class="btn btn-primary btn-lg btn--half-width">Confirm Photo</a>

				</div>
				<div class="tab-pane" id="profile" role="tabpanel" aria-expanded="false">

					<div class="choose-photo-item" data-mh="choose-item">
						<figure>
							<img src="img/choose-photo10.jpg" alt="photo">
							<figcaption>
								<a href="#">South America Vacations</a>
								<span>Last Added: 2 hours ago</span>
							</figcaption>
						</figure>
					</div>
					<div class="choose-photo-item" data-mh="choose-item">
						<figure>
							<img src="img/choose-photo11.jpg" alt="photo">
							<figcaption>
								<a href="#">Photoshoot Summer 2016</a>
								<span>Last Added: 5 weeks ago</span>
							</figcaption>
						</figure>
					</div>
					<div class="choose-photo-item" data-mh="choose-item">
						<figure>
							<img src="img/choose-photo12.jpg" alt="photo">
							<figcaption>
								<a href="#">Amazing Street Food</a>
								<span>Last Added: 6 mins ago</span>
							</figcaption>
						</figure>
					</div>

					<div class="choose-photo-item" data-mh="choose-item">
						<figure>
							<img src="img/choose-photo13.jpg" alt="photo">
							<figcaption>
								<a href="#">Graffity & Street Art</a>
								<span>Last Added: 16 hours ago</span>
							</figcaption>
						</figure>
					</div>
					<div class="choose-photo-item" data-mh="choose-item">
						<figure>
							<img src="img/choose-photo14.jpg" alt="photo">
							<figcaption>
								<a href="#">Amazing Landscapes</a>
								<span>Last Added: 13 mins ago</span>
							</figcaption>
						</figure>
					</div>
					<div class="choose-photo-item" data-mh="choose-item">
						<figure>
							<img src="img/choose-photo15.jpg" alt="photo">
							<figcaption>
								<a href="#">The Majestic Canyon</a>
								<span>Last Added: 57 mins ago</span>
							</figcaption>
						</figure>
					</div>


					<a href="#" class="btn btn-secondary btn-lg btn--half-width">Cancel</a>
					<a href="#" class="btn btn-primary btn-lg disabled btn--half-width">Confirm Photo</a>
				</div>
			</div>
		</div>

	</div>
</div>

<!-- ... end photos-Window-popup Choose from my Photo -->







<!-- photos-Window-popup Open Photo Popup V2 -->

<div class="modal fade" id="open-photo-popup-v2">
	<div class="modal-dialog photos-ui-block photos-window-popup open-photo-popup open-photo-popup-v2" style="width: 1200px;height: 642px;border:none;">
		<a href="#" class="close photos-icon-close" data-dismiss="modal" aria-label="Close">
			<svg class="olymp-close-icon"><use xlink:href="public/frontend/icons/icons.svg#olymp-close-icon"></use></svg>
		</a>

		<div class="open-photo-thumb">

			<div class="swiper-container" data-effect="fade" data-autoplay="4000">

				<!-- Additional required wrapper -->
				<div class="swiper-wrapper">
					<!-- Slides -->

					<div class="swiper-slide">
						<div class="open-photo-item" data-swiper-parallax="-300" data-swiper-parallax-duration="500">
							<img src="public/frontend/img/open-photo2.jpg" alt="photo">
						</div>
					</div>

					<div class="swiper-slide">
						<div class="open-photo-item" data-swiper-parallax="-300" data-swiper-parallax-duration="500">
							<img src="public/frontend/img/open-photo3.jpg" alt="photo">
						</div>
					</div>

					<div class="swiper-slide">
						<div class="open-photo-item" data-swiper-parallax="-300" data-swiper-parallax-duration="500">
							<img src="public/frontend/img/open-photo4.jpg" alt="photo">
						</div>
					</div>

					<div class="swiper-slide">
						<div class="open-photo-item" data-swiper-parallax="-300" data-swiper-parallax-duration="500">
							<img src="public/frontend/img/open-photo5.jpg" alt="photo">
						</div>
					</div>

					<div class="swiper-slide">
						<div class="open-photo-item" data-swiper-parallax="-300" data-swiper-parallax-duration="500">
							<img src="public/frontend/img/open-photo6.jpg" alt="photo">
						</div>
					</div>

					<div class="swiper-slide">
						<div class="open-photo-item" data-swiper-parallax="-300" data-swiper-parallax-duration="500">
							<img src="public/frontend/img/open-photo6.jpg" alt="photo">
						</div>
					</div>

					<div class="swiper-slide">
						<div class="open-photo-item" data-swiper-parallax="-300" data-swiper-parallax-duration="500">
							<img src="public/frontend/img/open-photo7.jpg" alt="photo">
						</div>
					</div>

					<div class="swiper-slide">
						<div class="open-photo-item" data-swiper-parallax="-300" data-swiper-parallax-duration="500">
							<img src="public/frontend/img/open-photo8.jpg" alt="photo">
						</div>
					</div>

					<div class="swiper-slide">
						<div class="open-photo-item" data-swiper-parallax="-300" data-swiper-parallax-duration="500">
							<img src="public/frontend/img/open-photo9.jpg" alt="photo">
						</div>
					</div>


				</div>

			</div>

			<!--Pagination tabs-->

			<div class="slider-slides">
				<a href="#" class="slides-item ">
					<img src="public/frontend/img/photo-tabs1.jpg" alt="slide">
					<div class="overlay overlay-dark"></div>
				</a>

				<a href="#" class="slides-item ">
					<img src="public/frontend/img/photo-tabs2.jpg" alt="slide">
					<div class="overlay overlay-dark"></div>
				</a>

				<a href="#" class="slides-item ">
					<img src="public/frontend/img/photo-tabs3.jpg" alt="slide">
					<div class="overlay overlay-dark"></div>
				</a>

				<a href="#" class="slides-item ">
					<img src="public/frontend/img/photo-tabs4.jpg" alt="slide">
					<div class="overlay overlay-dark"></div>
				</a>
				<a href="#" class="slides-item ">
					<img src="public/frontend/img/photo-tabs5.jpg" alt="slide">
					<div class="overlay overlay-dark"></div>
				</a>

				<a href="#" class="slides-item ">
					<img src="public/frontend/img/photo-tabs6.jpg" alt="slide">
					<div class="overlay overlay-dark"></div>
				</a>

				<a href="#" class="slides-item ">
					<img src="public/frontend/img/photo-tabs7.jpg" alt="slide">
					<div class="overlay overlay-dark"></div>
				</a>

				<a href="#" class="slides-item ">
					<img src="public/frontend/img/photo-tabs8.jpg" alt="slide">
					<div class="overlay overlay-dark"></div>
				</a>

				<a href="#" class="slides-item ">
					<img src="public/frontend/img/photo-tabs9.jpg" alt="slide">
					<div class="overlay overlay-dark"></div>
				</a>

				<!--Prev Next Arrows-->

				<svg class="btn-next olymp-popup-right-arrow"><use xlink:href="public/frontend/icons/icons.svg#olymp-popup-right-arrow"></use></svg>

				<svg class="btn-prev olymp-popup-left-arrow"><use xlink:href="public/frontend/icons/icons.svg#olymp-popup-left-arrow"></use></svg>


			</div>

		</div>

		<div class="open-photo-content">

			<article class="hentry post">

				<div class="post__author author vcard inline-items">
					<img src="public/frontend/img/author-page.jpg" alt="author">

					<div class="author-date">
						<a class="h6 post__author-name fn" href="02-ProfilePage.html">James Spiegel</a>
						<div class="post__date">
							<time class="published" datetime="2017-03-24T18:18">
								2 hours ago
							</time>
						</div>
					</div>

					<a href="#" class="more" style="position: absolute;left: 90%;"><i style="font-size: 20px;" class="fa fa-ellipsis-h dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i></a>

					
				</div>

				<p>Here’s a photo from last month’s photoshoot. We really had a great time and got a batch of incredible shots for the new catalog.</p>

				<div class="post-additional-info inline-items">

					<a href="#" class="post-add-icon inline-items">
						<i class="fa fa-heart-o" style="font-size: 22px;color: #c2c5d9;" aria-hidden="true"></i>
						<span>148 Likes</span>
					</a>

					<div class="comments-shared">
						<a href="#" class="post-add-icon inline-items">
							<i class="fa fa-commenting-o" style="font-size: 22px;color: #c2c5d9;" aria-hidden="true"></i>
							<span>61 Comments</span>
						</a>
					</div>


				</div>

			</article>

			<div class="mCustomScrollbar" data-mcs-theme="dark">
				<ul class="comments-list">
					<li>
						<div class="post__author author vcard inline-items">
							<img src="public/frontend/img/avatar48-sm.jpg" alt="author">

							<div class="author-date">
								<a class="h6 post__author-name fn" href="#">Marina Valentine</a>
								<div class="post__date">
									<time class="published" datetime="2017-03-24T18:18">
										46 mins ago
									</time>
								</div>
							</div>

							<a href="#" class="more" style="position: absolute;left: 90%;" ><i style="font-size: 20px;" class="fa fa-ellipsis-h dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i></a></a>

						</div>

						<p>I had a great time too!! We should do it again!</p>

						<a href="#" class="post-add-icon inline-items">
							<i class="fa fa-heart-o" style="font-size: 22px;color: #c2c5d9;" aria-hidden="true"></i>
							<span>8</span>
						</a>
						<a href="#" class="reply" style="color: #c2c5d9;margin-left: 15px;">Reply</a>
					</li>

					<li>
						<div class="post__author author vcard inline-items">
							<img src="public/frontend/img/avatar4-sm.jpg" alt="author">

							<div class="author-date">
								<a class="h6 post__author-name fn" href="#">Chris Greyson</a>
								<div class="post__date">
									<time class="published" datetime="2017-03-24T18:18">
										1 hour ago
									</time>
								</div>
							</div>

							<a href="#" class="more" style="position: absolute;left: 90%;"><i style="font-size: 20px;" class="fa fa-ellipsis-h dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i></a></a>

						</div>

						<p>Dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit.</p>

						<a href="#" class="post-add-icon inline-items">
							<i class="fa fa-heart-o" style="font-size: 22px;color: #c2c5d9;" aria-hidden="true"></i>
							<span>7</span>
						</a>
						<a href="#" class="reply" style="color: #c2c5d9;margin-left: 15px;">Reply</a>

					</li>
				</ul>
			</div>

			<form class="comment-form inline-items">

				<div class="post__author author vcard inline-items">
					<img src="public/frontend/img/avatar73-sm.jpg" alt="author">
					<div class="form-group with-icon-right ">
						<textarea class="form-control photo-form-control" style="resize: none;" placeholder="Press Enter to post..." ></textarea>
						<div class="add-options-message">
							<a href="#" class="options-message">
								<svg class="olymp-camera-icon"><use xlink:href="public/frontend/icons/icons.svg#olymp-camera-icon"></use></svg>
							</a>
						</div>
					</div>
				</div>
				
			</form>

		</div>

	</div>
</div>
<!-- photos-Window-popup Open Photo Popup V2 -->

<!-- Window-popup Update Header Photo -->

<div class="modal fade" id="update-header-photo">
    <div class="modal-dialog ui-block window-popup update-header-photo">
        <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
            <svg class="olymp-close-icon"><use xlink:href="public/frontend/icons/icons.svg#olymp-close-icon"></use></svg>
        </a>

        <div class="ui-block-title">
            <h6 class="title">Update Header Photo</h6>
        </div>

        <a href="#" class="upload-photo-item">
            <svg class="olymp-computer-icon"><use xlink:href="public/frontend/icons/icons.svg#olymp-computer-icon"></use></svg>

            <h6>Upload Photo</h6>
            <span>Browse your computer.</span>
        </a>

        <a href="#" class="upload-photo-item" data-toggle="modal" data-target="#choose-from-my-photo">

            <svg class="olymp-photos-icon"><use xlink:href="public/frontend/icons/icons.svg#olymp-photos-icon"></use></svg>

            <h6>Choose from My Photos</h6>
            <span>Choose from your uploaded photos</span>
        </a>
    </div>
</div>


<!-- ... end Window-popup Update Header Photo -->


<script>
	$(function(){
       $(window).scroll(function(){
               if( $(window).scrollTop() > 350 ) {
                       $('.tabs-left').css({position: 'fixed', top: '100px' , width: '41.66666667%', height:'100%'});
                       $('.sticky').css({display: 'block', top: '0px', left:'42%'});


               } else {
                       $('.tabs-left').css({position: 'relative', width: '41.66666667%', top:'0'});
                       $('.sticky').css({display: 'block', top: '0px', left:'0%'});
               }
       });
 	});
</script>

<script>
	$(function(){
	 $(".dropdown").hover(            
	         function() {
	             $('.dropdown-menu', this).stop( true, true ).fadeIn("fast");
	             $(this).toggleClass('open');
	             $('b', this).toggleClass("caret caret-up");                
	         },
	         function() {
	             $('.dropdown-menu', this).stop( true, true ).fadeOut("fast");
	             $(this).toggleClass('open');
	             $('b', this).toggleClass("caret caret-up");                
	         });
	 });
	 
</script>





