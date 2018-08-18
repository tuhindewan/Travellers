<div class="container_top_bar">
			<div class="container">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-3 pull-left home_top_panel no_padding">
							<input type="text" class="form-control home_set_box_panel" name="" value="" placeholder="Search..."><!-- <i class="fa fa-search" aria-hidden="true"></i> -->
							<div class="home_search_overlay"></div>
						</div>
						<div class="col-md-offset-1 col-md-4 home_top_panel no_padding">
							<!-- <input type="text" class="form-control home_search" name="" value="" placeholder="Search..."> --> 
							<textarea name="newsfeed" class="form-control home_set_box_panel show-dialog" id="" rows="3" placeholder="What's on your mind?"></textarea>
							<div class="home_post_overlay"></div>
							<!-- <button class="show-dialog"> Show Dialog </button> -->
							<div class="post-dialog"> 
								<textarea name="" class="form-control post-body" id="" rows="10" placeholder="What's on your mind?"></textarea>

								<div class="file_load"></div>
								
								<div class="post-bottom">
									<div class="form-group col-md-12 {{ $errors->has('logo') ? 'has-error' : ''}} ">
		                                
		                                <div class="col-md-5">
		                                  <label class="slide_upload" for="file_logo">
		                                      <!--  -->
		                                      <img id="image_load_logo" src=''>
		                                  </label>
		                                  <input type="file" id="file_logo" name="logo" onchange="readURL(this,this.id)" style="display:none">
		                                   
		                                </div>
		                                
		                                
		                                
		                            </div>
								</div>
								<!-- <a href="#" id="fbclose">Close this dialog</a> -->
							 </div>
						</div>

						<div class="col-md-3 pull-right">
							<div class="home_profile">
								<div id="dl-menu" class="dl-menuwrapper">
									<button>
										<div class="home_profile_overlay"></div>
										<img class="min_profile_home" src="{{asset('public/frontend/img/user.jpg')}}" alt=""> Md. xyz  <i class="fa fa-chevron-down" aria-hidden="true"></i>
									</button>
									<ul class="dl-menu">
										<li><a href="#">View Profile</a> </li>
										<li><a href="#">Edit Profile</a> </li>
										<li><a href="#">Setting</a> </li>
										<li><a href="{{URL::to('/users/logout')}}" class="last">Logout</a> </li>
										<div class="home_submenu_overlay"></div>
									</ul>
								</div><!-- /dl-menuwrapper -->
								
							</div>
						</div>
					</div>
				</div>	
			</div>
		</div>

		