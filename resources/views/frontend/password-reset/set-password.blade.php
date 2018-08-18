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
							<div class="overlay" style="border-radius: unset; min-height: 280px;"></div>
							<div class="verification-form">
								{!! Form::open(array('url' => 'confirm-password','class'=>'form-horizontal','method'=>'GET','files'=>'true')) !!} 
								{!! csrf_field() !!}
									<div class="verification-title">
										<div class="verification-heading">Enter Security Code</div>
										
										<div class="verification-body">
											@if(Session::has('error'))
												<div class="alert alert-danger alert-dismissable ">
										        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style=" right: 5px;">×</button>
										       <b style="font-size:12px;">{!! Session::get('error')!!}</b> 
										       </div>
											@endif
											<p>A strong password is a combination of letters and punctuation marks. It must be at least 6 characters long.</p>
										    <div class="row">
										    	<div class="col-sm-12 no_padding" style="margin-bottom:10px;">
										    		<label class="col-sm-4 res_fs_10">New password : </label>
										    		<div class="col-sm-8 form-group" style="margin-left: 0;">
													    <input type="password" name="password" class="form-control" id="code" placeholder="New password" required>
													</div>
													
										    	</div>
										    	<input type="hidden" value="{{$input['security_id']}}" name="security_id">
										    	<div class="col-sm-12 no_padding">
										    		<label class="col-sm-4 res_fs_10">Confirm password : </label>
										    		<div class="col-sm-8 form-group" style="margin-left: 0;">
													    <input type="password" name="c_password" class="form-control" id="code" placeholder="Confirm password" required>
													</div>
													
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