@include('frontend._partials.header')
	<div class="main-map-bottom">
		<div class="container">
			<div class="verification-section">
				<div class="row">
					<div class="col-sm-3">
						@include('frontend._partials.logo')	
					</div>
					<div class="col-sm-6">
						<div class="verification">
							<div class="overlay" style="border-radius: unset; min-height: 210px;"></div>
							<div class="verification-form">
								{!! Form::open(array('url' => 'login-identify','class'=>'form-horizontal','method'=>'GET','files'=>'true')) !!} 
								{!! csrf_field() !!}
									<div class="verification-title">
										<div class="verification-heading">Find Your Account</div>
										
										<div class="verification-body">
											<p>Please enter your email address or username to search for your account.</p>
										    <div class="row">
										    	<div class="col-sm-12">
										    		
										    		<div class="form-group" style="margin-left: 0;">
													    <input type="text" name="userdata" class="form-control" id="code" placeholder="Enter your email address that you used to register" required>
													</div>
													
													@if(Session::has('error'))
														<span style="color:red">{!! Session::get('error')!!}</span>
													@endif

										    	</div>
										    	
										    </div>
										</div>

										<div class="verification-footer">
											<div class="row">
												<div class="col-md-7">
													
												</div>
										    	<div class="col-md-5 pull-right">
										    		<button type="submit" class="btn btn-success btn-sm" style="    margin-left: 30px;">Continue</button>
										    		
										    		<a href="{{URL::to('/')}}" class="btn btn-default btn-sm" style="float: right;">Cancel</a>
										    	</div>	
											</div>
										</div>
									</div>
								{!! Form::close(); !!}
								
							</div>
							
						</div>
					</div>
					<div class="col-sm-1"></div>
					<div class="col-sm-2">
						
					</div>
				</div>
			</div>
				
			
			
			
		</div>
		@include('frontend._partials.footer')