@include('frontend._partials.header')
	<div class="main-map-bottom" id="wrapper">
		<div class="container">
			<div class="row">
				<header class="index_header">
					<div class="header_contianer">
						<div class="header_overlay"></div>
						<div class="container">
							<div class="footer_top">
								<div class="row">
									<div class="col-md-2 no_padding">
										@include('frontend._partials.logo')	
									</div>
									
								</div>	
							</div>
							
						</div>
						
					</div>
				</header>
				
			</div>
			
			<div class="row">
				
				<div class="login-section">
					<div class="row">
						<div class="col-md-9"></div>
						<div class="col-md-3 no_padding">
							<div class="login">
								<div class="overlay"></div>
								<div class="login-form">
									<form class="form-horizontal" method="POST" action="{{ route('login') }}">
	                					{{ csrf_field() }}
									  <div class="form-group no_margin {{ $errors->has('email') ? ' has-error' : '' }}">
									    <label for="email">Username / E-Mail</label>
									    <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Username / E-Mail">
									    @if ($errors->has('email'))
		                                    <span class="help-block no_margin">
		                                        <strong>{{ $errors->first('email') }}</strong>
		                                    </span>
		                                @endif
									  </div>
									  <div class="form-group no_margin {{ $errors->has('password') ? ' has-error' : '' }}">
									    <label for="password">Password</label>
									    <input id="password" type="password" class="form-control" name="password" required placeholder="Password">
	
		                                @if ($errors->has('password'))
		                                    <span class="help-block no_margin">
		                                        <strong>{{ $errors->first('password') }}</strong>
		                                    </span>
		                                @endif
									  </div>
									  
									  <div class="from-group">
									  	<div class="checkbox">
										    <label>
										      <input style="display:unset;" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> remember me
										    </label>
										  </div>
									  </div>
									  <div class="from-group" style="margin:10px 0;">
									  		<button type="submit" class="btn btn-success">Log in</button>
									  </div>
									  
									  <label><a @click="forgetPassword()">Forget Password?</a></label>
									  <br>
									  <label>Not a Member , <a href="{{URL::to('users/create')}}" class="">sign up</a></label>
	
									</form>
	
								</div>
								
							</div>
						</div>
					</div>
				</div>
				
			</div>
			<div class="row hidden-xs hidden-sm">
				<div class="col-md-4 aside_section" >
					<div class="get-started-section">
						<div class="get_started_overlay"></div>	
						<div class="get-started">
							<h2>My Home is <br> in forest, not in Cage</h2>
							<a href="{{URL::to('users/create')}}" class="btn btn-success">Get Started</a>
						</div>
						
						
					</div>
				</div>
				<div class="col-md-8"></div>
				
			</div>
			
		</div>

		@include('frontend._partials.footer')
		<script>
			$("#email").focus();
		</script>	