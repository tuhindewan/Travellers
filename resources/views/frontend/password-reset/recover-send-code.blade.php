@include('frontend._partials.header')
	<div class="main-map-bottom">
		<div class="container">
			<div class="verification-section">
				<div class="row">
					<div class="col-sm-3">
						@include('frontend._partials.logo')	
					</div>
					<div class="col-sm-7 no_padding">
						<div class="verification">
							<div class="overlay" style="border-radius: unset; min-height: 245px;"></div>
							<div class="verification-form">

								{!! Form::open(array('url' => 'set-password','class'=>'form-horizontal','method'=>'GET','files'=>'true')) !!} 
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


											<p>Please check your email for a message with your code. Your code is 6 digits long.</p>
										    <div class="row">
										    	<div class="col-sm-7">
										    		<input type="hidden" value="{{ $getUser['receive_code']}}" name="send_mail">
										    		<div class="form-group" style="margin-left: 0;">
													    <input type="text" name="verification-code" class="form-control" id="code" placeholder="Enter code" required>
													</div>
													
										    	</div>
										    	<div class="col-sm-5" style="text-align:right">
										    		<label class="res_fs_10">We sent your code to: </label>
										    		<p>{{ $getUser['receive_code']}}</p>	
										    	</div>
										    	
										    </div>
										</div>
										<input type="hidden" value="{{ $getUser['token_id']}}" name="security_id">
										<div class="verification-footer">
											<div class="row">
												<div class="col-md-7">
													<?php $id = $getUser['token_id'];?>
													<a href='{{URL::to("password-recover/$id")}}' class="sendCode">resend a code.</a>
												</div>
										    	<div class="col-md-5 pull-right">
										    		<button type="submit" class="btn btn-success btn-sm" style="    margin-left: 5px; float:right;">Continue</button>
										    		
										    		<a href="{{URL::to('/')}}" class="btn btn-default btn-sm" style="float: right;">Cancel</a>
										    	</div>	
											</div>
										</div>
									</div>
								{!! Form::close(); !!}
								
							</div>
							
						</div>
					</div>
					<div class="col-sm-2 no_padding">
						
					</div>
				</div>
			</div>
				
			
			
			
		</div>
		@include('frontend._partials.footer')