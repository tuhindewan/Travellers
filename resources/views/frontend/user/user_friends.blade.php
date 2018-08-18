<link rel="stylesheet" type="text/css" href="{{URL::to('public/frontend/css/jquery-ui.min.css')}}">
<div class="friend_section">
	<div class="row">
		<div class="col-md-12">
			<div class="friends-ui-block">
				<div class="friends-ui-block-title">
					<div class="h6 title">James’s Friends (86)</div>
					<form class="w-search">
						<div class="form-group with-button is-empty">
							<input class="form-control friends-form-control" type="text" id="friendListSearch"  placeholder="Search Friends...">
							<button>
								<i class="fa fa-search friends-search" aria-hidden="true"></i>
							</button>
						</div>
					</form>
					<div class="more dropdown">
						<i class="fa fa-ellipsis-h dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
						<ul class="dropdown-menu search-dropdown">
							<li>
								<a href="#">Report Profile</a>
							</li>
							<li>
								<a href="#">Block Profile</a>
							</li>
							<li>
								<a href="#">Turn Off Notifications</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="friend_section">
	<div class="row">

	@foreach($friendsOne as $friend)
		<div class="col-md-3">
			<div class="friends-ui-block">
				<div class="friend-item">
					<div class="friend-header-thumb">
						<?php 
						$cover = App\Models\UserCoverImage::where('fk_user_id',$friend->user_id_two)->orderBy('created_at','desc')->first();
						$image = $cover['coverimage'];

						?>
						@if($image)
						<img src='{{asset("images/users$image")}}' alt="friend">
						@else
						<img src='public/frontend/images/Cover/blank-cover-template-1.jpg' alt="friend">
						@endif
					</div>

					<div class="friend-item-content">

						<div class="more dropdown">
							<i class="fa fa-ellipsis-h dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
							<ul class="dropdown-menu">
								<li>
									<a href="#">Report Profile</a>
								</li>
								<li>
									<a href="#">Block Profile</a>
								</li>
								<li>
									<a href="#">Turn Off Notifications</a>
								</li>
							</ul>
						</div>
						<div class="friend-avatar">
							<div class="author-thumb">
								<?php 
									$image = $friend->users2->user_image['image']; 
								?>
								<img src='{{asset("images/users$image")}}' alt="author">
							</div>
							<div class="author-content">
								<a href="#" class="h5 author-name">{{$friend->users2->firstname}} {{$friend->users2->middlename}} {{$friend->users2->lastname}}</a>
								<?php
								$city_id = $friend->users2->fk_city_id;
								$city_name = App\Models\CurrentCity::select('city_name')->where('_id',$city_id)->first();
								?>
								<div class="country">{{$city_name->city_name}}</div>
							</div>
						</div>

						<div class="swiper-container">
						    <div class="swiper-wrapper">
						      <div class="swiper-slide">
						      	<div class="friend-count">
						      		<?php 
						      		$f_count_1 = App\Models\Relationship::where('user_id_one',$friend->user_id_two)->where('status',1)->count();

						      		$f_count_2 = App\Models\Relationship::where('user_id_two',$friend->user_id_two)->where('status',1)->count();
						      		$toatal_count = $f_count_1 + $f_count_2; 
						      		?>
						      		<a href="#" class="friend-count-item">
						      			<div class="h6">{{$toatal_count}}</div>
						      			<div class="title">Friends</div>
						      		</a>
						      		<?php 
						      		$image_count = App\Models\PostImages::where('fk_user_id',$friend->user_id_two)->count();
						      		?>
						      		<a href="#" class="friend-count-item">
						      			<div class="h6">{{$image_count}}</div>
						      			<div class="title">Photos</div>
						      		</a>
						      		<a href="#" class="friend-count-item">
						      			<div class="h6">0</div>
						      			<div class="title">Videos</div>
						      		</a>
						      	</div>
						      	<div class="control-block-button">
						      		<a href="{{ url('/unfriend') }}/{{ $friend['user_id_two'] }}" class="btn friends-btn-control bg-blue"  data-toggle="tooltip" title="Unfriend">
						      			<img class="friend-request-img" src="{{asset('public/frontend/icons/unfriend.svg')}}"> 
						      		</a>

						      		<a href="#" class="btn friends-btn-control bg-purple">
						      			
						      			<img class="send-message-img"  src="{{asset('public/frontend/icons/text-messages.svg')}}">
						      		</a>

						      	</div>
						      </div>

						      <div class="swiper-slide">
						      	<p class="friend-about">
						      		<?php 
						      		$inspiration = App\Models\PersonalInformation::where('fk_user_id',$friend->user_id_two)->first();
						      		?>
						      		{{$inspiration['inspiration']}}
						      	</p>

						      	<div class="friend-since">
						      		<span>Friends Since:</span>
						      		<div class="h6">{{date('F Y', strtotime($friend->updated_at))}}</div>
						      	</div>
						      </div>
						    </div>
						    <!-- Add Pagination -->
						    <div class="swiper-pagination"></div>
						  </div>
					</div>
				</div>
			</div>
		</div>
	@endforeach

	@foreach($friendsTwo as $friend)

		<div class="col-md-3">
			<div class="friends-ui-block">
				<div class="friend-item">
					<div class="friend-header-thumb">
						<?php 
						$cover = App\Models\UserCoverImage::where('fk_user_id',$friend->user_id_one)->orderBy('created_at','desc')->first();
						$image = $cover['coverimage'];
						?>
						@if($image)
						<img src='{{asset("images/users$image")}}' alt="friend">
						@else
						<img src='public/frontend/images/Cover/blank-cover-template-1.jpg' alt="friend">
						@endif
					</div>

					<div class="friend-item-content">

						<div class="more dropdown">
							<i class="fa fa-ellipsis-h dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
							<ul class="dropdown-menu">
								<li>
									<a href="#">Report Profile</a>
								</li>
								<li>
									<a href="#">Block Profile</a>
								</li>
								<li>
									<a href="#">Turn Off Notifications</a>
								</li>
							</ul>
						</div>
						<div class="friend-avatar">
							<div class="author-thumb">
								<?php 
									$image = $friend->users->user_image['image']; 
								?>
								<img  src='{{asset("images/users$image")}}' alt="author">
							</div>
							<div class="author-content">
								<a href="#" class="h5 author-name">{{$friend->users->firstname}} {{$friend->users->middlename}} {{$friend->users->lastname}}</a>
								<?php
								$city_id = $friend->users->fk_city_id;
								$city_name = App\Models\CurrentCity::select('city_name')->where('_id',$city_id)->first();
								?>
								<div class="country">{{$city_name->city_name}}</div>
							</div>
						</div>

						<div class="swiper-container">
						    <div class="swiper-wrapper">
						      <div class="swiper-slide">
						      	<div class="friend-count">
						      		<?php 
						      		$f_count_1 = App\Models\Relationship::where('user_id_one',$friend->user_id_one)->where('status',1)->count();

						      		$f_count_2 = App\Models\Relationship::where('user_id_two',$friend->user_id_one)->where('status',1)->count();
						      		$toatal_count = $f_count_1 + $f_count_2; 
						      		?>
						      		<a href="#" class="friend-count-item">
						      			<div class="h6">{{$toatal_count}}</div>
						      			<div class="title">Friends</div>
						      		</a>
						      		<?php 
						      		$image_count = App\Models\PostImages::where('fk_user_id',$friend->user_id_one)->count();
						      		?>
						      		<a href="#" class="friend-count-item">
						      			<div class="h6">{{$image_count}}</div>
						      			<div class="title">Photos</div>
						      		</a>
						      		<a href="#" class="friend-count-item">
						      			<div class="h6">0</div>
						      			<div class="title">Videos</div>
						      		</a>
						      	</div>
						      	<div class="control-block-button">
						      		<a href="{{ url('/unfriend2') }}/{{ $friend['user_id_one'] }}" class="btn friends-btn-control bg-blue" data-toggle="tooltip" title="Unfriend">
						      			<img class="friend-request-img" src="{{asset('public/frontend/icons/unfriend.svg')}}">
						      		</a>

						      		<a href="#" class="btn friends-btn-control bg-purple">
						      			
						      			<img class="send-message-img"  src="{{asset('public/frontend/icons/text-messages.svg')}}">
						      		</a>

						      	</div>
						      </div>

						      <div class="swiper-slide">
						      	<p class="friend-about">
						      		<?php 
						      		$inspiration = App\Models\PersonalInformation::where('fk_user_id',$friend->user_id_one)->first();
						      		?>
						      		{{$inspiration['inspiration']}}
						      	</p>

						      	<div class="friend-since">
						      		<span>Friends Since:</span>
						      		<div class="h6">{{date('F Y', strtotime($friend->updated_at))}}</div>
						      	</div>
						      </div>
						    </div>
						    <!-- Add Pagination -->
						    <div class="swiper-pagination"></div>
						  </div>
					</div>
				</div>
			</div>
		</div>
	@endforeach
	
	</div>
</div>

<script type="text/javascript" src="{{URL::to('public\frontend\js\jquery-ui.min.js')}}"></script>

<script>
  var swiper = new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
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

<script>
  $( function() {
    var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];
    $( "#friendListSearch" ).autocomplete({
      source: 'http://localhost/techtravel/search'
    });
  } );
  </script>

