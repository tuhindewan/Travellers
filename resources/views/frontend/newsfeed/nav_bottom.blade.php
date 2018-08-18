<div class="home_navigition">
		<div class=" no_padding ">
			<nav class="navbar navbar-inverse home_navbar">
			  <div class="container">
			    <!-- Brand and toggle get grouped for better mobile display -->
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			      <a class="navbar-brand" href="#"></a>
			    </div>

			    <!-- Collect the nav links, forms, and other content for toggling -->
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			      <ul class="nav navbar-nav">
			        <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{URL::to('/')}}">Home</a></li>
			        <?php $username = Auth::user()->username; ?>
			        <li class="{{ Request::is('profile') ? 'active' : '' }}"><a href='{{URL::to("/$username")}}'>Profile</a></li>
			        <li class="{{ Request::is('connection') ? 'active' : '' }}"><a href="{{URL::to('connection')}}">Connections</a></li>
			        <li class="{{ Request::is('map') ? 'active' : '' }}"><a href="{{URL::to('map')}}">Map</a></li>
			        
			      </ul>
			      <!-- <ul class="nav navbar-nav navbar-right">
			        <li><a href="#" class="scroll-bottom"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></a></li>
			      </ul> -->
			      
			    </div><!-- /.navbar-collapse -->
			  </div><!-- /.container-fluid -->
			</nav>
			<div class="scroll_to_bottom">
				<a href="#" class="scroll-bottom bottom"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></a>	
			</div>
		</div>
	</div>