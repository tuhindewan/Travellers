<div class="about_section">
	<div class="row">
		<div class="col-md-2" style="">
			<div class="tabbable tabs-left">
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a class="radius" href="#experiences" role="tab" data-toggle="tab">Personal Information</a></li>
					<li role="presentation"><a class="radius" href="#plans" role="tab" data-toggle="tab">Bio</a></li>
					<li role="presentation"><a  class="radius" href="#suggestions" role="tab" data-toggle="tab">Places You've Visited</a></li>
				</ul>
			</div>
		</div>

		<div class="col-md-10 information-section" id="sticky">
			    <div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="experiences">                
						<div class="panel panel-default">
							<div class="panel-body">
					    		<div class="user-info-right">
					    			<div class="row">
					    				<div class="col-md-6">
					    					<div class="basic-info">
					    					  <h3><i class="fa fa-square"></i> Basic Information</h3>
					    					  <p class="data-row">
					    					    <span class="data-name">Name</span>
					    					    <span class="data-value">{{$getUser->firstname}} {{$getUser->middlename}} {{$getUser->lastname}}</span>
					    					  </p>
					    					  <p class="data-row">
					    					    <span class="data-name">Birth Date</span>
					    					    <span class="data-value">{{$getUser->month}} {{$getUser->day}}, {{$getUser->year}}</span>
					    					  </p>
					    					  <p class="data-row">
					    					    <span class="data-name">Gender</span>
					    					    <span class="data-value">{{$getUser->gender}}</span>
					    					  </p>
					    					</div>
					    					
					    				</div>
					    				<div class="col-md-6">
					    					<div class="dropdown">
					    					    <i class="fa fa-cog info-edit-button dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
					    					    <ul class="dropdown-menu info-edit-dropdown">
					    					      <li><a href="{{ URL::to('edit-profile')}}" class="edit-button">Edit</a></li>
					    					      <li><a href="#">Delete</a></li>
					    					    </ul>
					    					  </div>
					    					<div class="contact_info">
					    					  <h3><i class="fa fa-square"></i> Contact Information</h3>
					    					  <div class="contact-info-section">
					    					  	<p class="data-row">
					    					  	  <span class="data-name">Email</span>
					    					  	  <span class="data-value">{{$getUser->email}}</span>
					    					  	</p>
					    					  	<p class="data-row">
					    					  	  <span class="data-name">Mobile Number</span>
					    					  	  <span class="data-value">{{$getUser->country_code}}{{$getUser->phone}}</span>
					    					  	</p>
					    					  </div>
					    					</div>
											
											<div class="edit-contact_info">
											  
											</div>
					    				</div>
					    			</div>
					    		</div>
				  			</div>
						</div>
					</div> 
					<div class="tab-pane" id="plans"> 
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="dropdown">
								    <i class="fa fa-cog bio-edit-button dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
								    <ul class="dropdown-menu bio-edit-dropdown">
								      <li><a href="{{ URL::to('edit-profile')}}" class="edit-button">Edit</a></li>
								      <li><a href="#">Delete</a></li>
								    </ul>
								  </div>
								<div class="basic-info">
									<h3><i class="fa fa-square"></i> Bio Information</h3>
								  <p class="data-row">
								    <span class="data-name">Interest</span>
								    <span class="data-value">{{$getInfo['interest']}}</span>


								  </p>
								  <p class="data-row">
								    <span class="data-name">Prefers</span>
								    <span class="data-value">{{$getInfo['prefer']}}</span>
								  </p>
								  <p class="data-row">
								    <span class="data-name">Inspiration</span>
								    <span class="data-value">{{$getInfo['inspiration']}}</span>
								  </p>
								  <p class="data-row">
								    <span class="data-name">I am</span>
								    <span class="data-value">Traveler and {{$getInfo['youare']}}</span>
								    
								  </p>
								</div>  
							</div>              
						</div>
					</div>
					<div class="tab-pane" id="suggestions"> 
						<div class="panel panel-default">
							<div class="panel-body">
								 <div class="basic-info">
								 	<h3><i class="fa fa-square"></i> Places Visited</h3>

									<div class="row">
										<div class="col-md-12">
											<ul class="about-notification-list">
												<li>
													<div class="visit-place-thumb">
														<img src="public/frontend/img/21.jpg" alt="author">
													</div>
													<div class="notification-event">
														<a href="#" class="h6 notification-friend">Cox's Bazar, Chittagong, Bangladesh</a>.
														<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">March 18th at 8:22pm</time></span>
													</div>
													<div class="more">
														<svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg>
														<svg class="olymp-little-delete"><use xlink:href="icons/icons.svg#olymp-little-delete"></use></svg>
													</div>
												</li>

												<li>
													<div class="visit-place-thumb">
														<img src="public/frontend/img/dhaka.jpg" alt="author">
													</div>
													<div class="notification-event">
														<a href="#" class="h6 notification-friend">Dhaka, Bangladesh</a>.
														<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">March 5th at 6:43pm</time></span>
													</div>


													<div class="more">
														<svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg>
														<svg class="olymp-little-delete"><use xlink:href="icons/icons.svg#olymp-little-delete"></use></svg>
													</div>
												</li>
											</ul>
										</div>
									</div>
									<div class="dropdown">
									    <a href="" data-toggle="modal" data-target="#update-header-photo"><i class="fa fa-plus-circle add-plus-circle info-edit-button"  aria-hidden="true"> Add Place</i></a>
									    
									  </div>
									<h3><i class="fa fa-square"></i> Plans To Visit</h3>
								 </div> 
							</div>              
						</div>
					</div>
				</div>
		</div>
	</div>
</div>

<!-- about-Window-popup Update Header Photo -->


<div class="modal fade" id="update-header-photo">



	<script>
		$(document).ready(function() {
			App.init();
			FormPlugins.init();
		});
	</script>
	<div class="modal-dialog about-ui-block about-window-popup about-update-header-photo">
		<a href="#" class="close about-icon-close" data-dismiss="modal" aria-label="Close">
			<svg class="olymp-close-icon"><use xlink:href="icons/icons.svg#olymp-close-icon"></use></svg>
		</a>

		<div class="about-ui-block-title photo-modal-about-ui-block-title">
			<h6 class="title photo-modal-title" id="" >Add Place Where You Want to Visit</h6>
		</div>
		<div class="about-ui-block-content">
			<form action="">
				<div class="form-group">
					<label for="name" class="cols-sm-2 control-label">Where</label>
					<div class="cols-sm-10">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-map-marker fa" aria-hidden="true"></i></span>
							<input type="text" class="form-control about-form-control" name="name" id=""  placeholder="Enter Location Name"/>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="cols-sm-2 control-label">When</label>
					<div class="cols-sm-10">
						<div class="input-group">
							<input type="text" class="form-control about-form-control" name="start" placeholder="Date Start" />
							<span class="input-group-addon">to</span>
							<input type="text" class="form-control about-form-control" name="end" placeholder="Date End" />
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="cols-sm-2 control-label">With</label>
					<div class="cols-sm-10">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
							<input type="text" class="form-control about-form-control" name="name" id="name"  placeholder="Add Connector"/>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-3 add-md-3">
						<button class="btn btn-add btn-sm full-width">Save</button>
					</div>
					<div class="col-md-3 cancel-md-3">
						<button class="btn btn-save-change btn-sm full-width">Cancel</button>
					</div>
				</div>
			</form>

		</div>
	</div>
</div>

<!-- ... end about-Window-popup Update Header Photo -->

<script>
	$(document).ready(function() {
	   $('.selectpicker').selectpicker();
	});
</script>

<script>
$(document).ready(function(){
    $(".edit-button").click(function(){
            $(".contact_info").hide("fast", function(){
                $(".edit-contact_info").html(
					    					  "<h3><i class='fa fa-square'></i> Contact Information</h3><p class='data-row'><span class='data-name'>Email</span><span class='data-value'><input style='width: 165px;height: 25px;margin-top: -5px;padding: 5px;' type='text' class='form-control' value='tuhinsshadow@gmail.com'></span></p><p class='data-row'><span class='data-name'>Mobile Number</span><span class='data-value'><input style='width: 165px;height: 25px;margin-top: -5px;padding: 5px;' type='text' class='form-control' value='+8801878045907'></span></p><p class='data-row'><button class='btn btn-primary btn-xs'>Save Changes</button><button style='margin-left:5px;' class='btn btn-default btn-xs'>Cancel</button></p>"
					    				);
            });
        });
});
</script>
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






