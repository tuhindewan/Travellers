<!DOCTYPE html>
<html>
<head>
	<title>Travels</title>
	<link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="{{asset('public/frontend/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('public/frontend/css/form-wizard-purple.css')}}">
	<link rel="stylesheet" href="{{asset('public/frontend/css/switcher.css')}}">
	<link rel="stylesheet" href="{{asset('public/frontend/css/responsive.css')}}">
	<link rel="stylesheet" href="{{asset('public/css/chosen.min.css')}}">
	<link rel="stylesheet" href="{{asset('public/css/intlTelInput.css')}}">
	<link rel="stylesheet" href="{{asset('public/frontend/css/login_register.css')}}">
	<style>
		label{color: #fff;}
		.form-wizard {background: transparent; padding: 10px;}
		.form-wizard-steps { margin-top: 0px;}
		.form-group { margin-bottom: 5px;}
		.checkbox input[type="checkbox"], .checkbox-inline input[type="checkbox"], .radio input[type="radio"], .radio-inline input[type="radio"] {margin-top:4px;}
		.form-wizard label span { color: #00b2ff;}
		.form-header-stylist .form-wizard-step.active { background: transparent;}
		.form-header-stylist .form-wizard-step.active::after {border-left: 20px solid #51504f;}
		.form-wizard-tolal-steps-4 .form-wizard-step { width: 33%;}
		.form-wizard p, h1,h2, a, h3 {color: #fff;}
		.form-body-stylist.form-wizard .btn { border: 2px solid #667fc5;}
		.form-wizard .btn.btn-next, .form-wizard .btn.btn-next:focus, .form-wizard .btn.btn-next:active:focus, .form-wizard .btn.btn-next.active:focus { background: #213b9a;}
		.form-wizard h3 { color: #ede8ef;}
		.form-header-stylist .form-wizard-step.activated::after {border-left: 20px solid #51504f;}
		.form-header-stylist .form-wizard-step.activated { background: #cccccc;}
		.form-wizard .success .success-icon { color: #5edc1d; border: 5px solid #9dff00;}
		.form-header-stylist .form-wizard-step.activated .form-wizard-step-icon { background: #778196;}
		.form-wizard .success h3 {color: #ffffff;}
		.form-wizard .btn.btn-submit, .form-wizard .btn.btn-submit:focus, .form-wizard .btn.btn-submit:active:focus, .form-wizard .btn.btn-submit.active:focus { background: #1f15b9;}
		.pd-r-0{padding-right: 0px;}
	</style>
</head>
<body>
	
<div class="main-section">
	<div class="main-map-section">
		<input type="hidden" value="{{URL::to('/')}}" id="url-get">
		<video autoplay muted loop id="myVideo">
		  <source src="{{asset('public/frontend/video/background.mp4')}}" type="video/mp4">
		</video>	
	</div>
	<div class="main-map-bottom">
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
				
				<div class="login-section" id="wrapper">
					<div class="row">
						
						<div class="col-md-3 hidden-xs hidden-sm">
							<div class="login ">
								<div class="overlay"></div>
								<div class="login-form">
									<form class="form-horizontal" method="POST" action="{{ route('login') }}">
	                					{{ csrf_field() }}
									  <div class="form-group no_margin {{ $errors->has('email') ? ' has-error' : '' }}">
									    <label for="email">Username / E-Mail</label>
									    <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Username / E-Mail">
									    @if ($errors->has('email'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('email') }}</strong>
		                                    </span>
		                                @endif
									  </div>
									  <div class="form-group no_margin {{ $errors->has('password') ? ' has-error' : '' }}">
									    <label for="password">Password</label>
									    <input id="password" type="password" class="form-control" name="password" required placeholder="Password">
	
		                                @if ($errors->has('password'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('password') }}</strong>
		                                    </span>
		                                @endif
									  </div>
									  
									  <div class="from-group">
									  	<div class="checkbox">
										    <label>
										      <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> remember me
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
						<div class="col-md-1 hidden-xs hidden-sm"></div>
						<div class="col-md-8 col-sx-12 col-sm-12">
							<div class="sign_up_section">
								<div class="sign_up_content">
									<div class="sign_up_overlay"></div>
									<div class="sign_up">
										<div class="form-wizard form-header-stylist form-body-stylist">
										{!! Form::open(array('route' => 'users.store','class'=>'form-horizontal','method'=>'POST','files'=>'true')) !!} 
					                		{!! csrf_field() !!}
											
											<!-- Form progress -->
					                		<div class="form-wizard-steps form-wizard-tolal-steps-4">
					                			<div class="form-wizard-progress">
					                			    <div class="form-wizard-progress-line" data-now-value="12.25" data-number-of-steps="4" style="width: 12.25%;"></div>
					                			</div>
												<!-- Step 1 -->
					                			<div class="form-wizard-step active">
					                				<div class="form-wizard-step-icon"><i class="fa fa-unlock-alt" aria-hidden="true"></i></div>
					                				<p>Account</p>
					                			</div>
												<!-- Step 1 -->
												
												<!-- Step 2 -->
					                			<div class="form-wizard-step">
					                				<div class="form-wizard-step-icon"><i class="fa fa-camera" aria-hidden="true"></i></div>
					                				<p>Image</p>
					                			</div>
												<!-- Step 2 -->
												
												<!-- Step 3 -->
					                			<!-- <div class="form-wizard-step">
					                				<div class="form-wizard-step-icon"><i class="fa fa-users" aria-hidden="true"></i></div>
					                				<p>invite friends</p>
					                			</div> -->
												<!-- Step 3 -->
												
												<!-- Step 4 -->
												<div class="form-wizard-step">
					                				<div class="form-wizard-step-icon"><i class="fa fa-check" aria-hidden="true"></i></div>
					                				<p>Success</p>
					                			</div>
												<!-- Step 4 -->
					                		</div>
											<!-- Form progress -->
					                		
											
											<!-- Form Step 1 -->
					                		<fieldset>
					                			<small class="requied_condition"><i class="fa fa-hand-o-right" aria-hidden="true"></i> All * required.</small>
														
												<div class="form-group">
													<label class="radio-inline">
													  <input type="radio" name="gender" value="Mr" checked="checked"> Mr.
													</label>
					                                <label class="radio-inline">
													  <input type="radio" name="gender" value="Ms"> Ms./Mrs.
													</label>
													
					                            </div>
										  			
										  		<div class="row">
										  			<div class="col-sm-12 col-xs-12">
										  				<div class="row">
										  					<div class="col-sm-4 col-xs-4">
										  						<div class="form-group">
																    <label for="FirstName">First Name: <span>*</span></label>
																    <input type="text" name="firstname" class="input-class form-control input-sm required" id="FirstName" placeholder="First Name" required>
																</div>
										  					</div>
										  					<div class="col-sm-4 col-xs-4">
										  						<div class="form-group">
																    <label for="MiddleName">Middle Name :</label>
																    <input type="text" name="middlename" class="form-control input-class" id="MiddleName" placeholder="Middle Name">
																</div>
										  					</div>
										  					<div class="col-sm-4 col-xs-4">
										  						<div class="form-group">
																    <label for="LastName">Last Name: <span>*</span></label>
																    <input type="text" name="lastname" class="form-control input-class required" id="LastName" placeholder="Last Name">
																</div>
										  					</div>
										  				</div>
										  			</div>
										  		</div>
										  		<div class="form-group">
						  						    <label for="dateofBirth">Date of Birth: <span class="city_label">*</span></label>
						  						 	<div class="row">
					 		  						 	<div class="col-sm-12 col-xs-12">
					 		  						 		<div class="row">
							 		  						 	<div class="col-sm-4 col-xs-4 pd-r-0">
										 	                        <select name="month" class = "form-control input-lg">
										 	                            <option value="0" selected="1">Month</option>
											  						 	<option value="Jan">Jan</option>
											  						 	<option value="Feb">Feb</option>
											  						 	<option value="Mar">Mar</option>
											  						 	<option value="Apr">Apr</option>
											  						 	<option value="May">May</option>
											  						 	<option value="Jun">Jun</option>
											  						 	<option value="Jul">Jul</option>
											  						 	<option value="Aug">Aug</option>
											  						 	<option value="Sep">Sep</option>
											  						 	<option value="Oct">Oct</option>
											  						 	<option value="Nov">Nov</option>
											  						 	<option value="Dec">Dec</option>
											  						</select>                        
							 		  						 	</div>
							 		  						 	<div class="col-sm-4 col-xs-4 pd-l-0 pd-r-0">
											 	                    <select name="day" class = "form-control input-lg">
											 	                    	<option value="0" selected="1">Day</option>
									 		  						 	<option value="1">1</option>
									 		  						 	<option value="2">2</option>
									 		  						 	<option value="3">3</option>
									 		  						 	<option value="4">4</option>
									 		  						 	<option value="5">5</option>
									 		  						 	<option value="6">6</option>
									 		  						 	<option value="7">7</option>
									 		  						 	<option value="8">8</option>
									 		  						 	<option value="9">9</option>
									 		  						 	<option value="10">10</option>
									 		  						 	<option value="11">11</option>
									 		  						 	<option value="12">12</option>
									 		  						 	<option value="13">13</option>
									 		  						 	<option value="14">14</option>
									 		  						 	<option value="15">15</option>
									 		  						 	<option value="16">16</option>
									 		  						 	<option value="17">17</option>
									 		  						 	<option value="18">18</option>
									 		  						 	<option value="19">19</option>
									 		  						 	<option value="20">20</option>
									 		  						 	<option value="21">21</option>
									 		  						 	<option value="22">22</option>
									 		  						 	<option value="23">23</option>
									 		  						 	<option value="24">24</option>
									 		  						 	<option value="25">25</option>
									 		  						 	<option value="26">26</option>
									 		  						 	<option value="27">27</option>
									 		  						 	<option value="28">28</option>
									 		  						 	<option value="29">29</option>
									 		  						 	<option value="30">30</option>
									 		  						 	<option value="31">31</option>
									 		  						</select>                        
							 		  						 	</div>
							 		  						 	<div class="col-sm-4 col-xs-4 pd-l-0">
										 	                        <select name="year" class = "form-control input-lg">
										 	                        	<option value="0" selected="1">Year</option>
									 		  						 	<option value="1960">1960</option>
									 		  						 	<option value="1961">1961</option>
									 		  						 	<option value="1962">1962</option>
									 		  						 	<option value="1963">1963</option>
									 		  						 	<option value="1964">1964</option>
									 		  						 	<option value="1965">1965</option>
									 		  						 	<option value="1966">1966</option>
									 		  						 	<option value="1967">1967</option>
									 		  						 	<option value="1968">1968</option>
									 		  						 	<option value="1969">1969</option>
									 		  						 	<option value="1970">1970</option>
									 		  						 	<option value="1971">1971</option>
									 		  						 	<option value="1972">1972</option>
									 		  						 	<option value="1973">1973</option>
									 		  						 	<option value="1974">1974</option>
									 		  						 	<option value="1975">1975</option>
									 		  						 	<option value="1976">1976</option>
									 		  						 	<option value="1977">1977</option>
									 		  						 	<option value="1978">1978</option>
									 		  						 	<option value="1979">1979</option>
									 		  						 	<option value="1980">1980</option>
									 		  						 	<option value="1981">1981</option>
									 		  						 	<option value="1982">1982</option>
									 		  						 	<option value="1983">1983</option>
									 		  						 	<option value="1984">1984</option>
									 		  						 	<option value="1985">1985</option>
									 		  						 	<option value="1986">1986</option>
									 		  						 	<option value="1987">1987</option>
									 		  						 	<option value="1988">1988</option>
									 		  						 	<option value="1989">1989</option>
									 		  						 	<option value="1990">1990</option>
									 		  						 	<option value="1991">1991</option>
									 		  						 	<option value="1992">1992</option>
									 		  						 	<option value="1993">1993</option>
									 		  						 	<option value="1994">1994</option>
									 		  						 	<option value="1995">1995</option>
									 		  						 	<option value="1996">1996</option>
									 		  						 	<option value="1997">1997</option>
									 		  						 	<option value="1998">1998</option>
									 		  						 	<option value="1999">1999</option>
									 		  						 	<option value="2000">2000</option>
									 		  						 	<option value="2001">2001</option>
									 		  						 	<option value="2002">2002</option>
									 		  						 	
								 		  						 	</select>                        
							 		  						 	</div>
					 		  						 		</div>
					 		  						 	</div>
						  						 	</div>
						  						</div>
						  						<div class="row">
						  							<div class="col-sm-6 col-xs-6">
						  								<div class="form-group">
														    <label for="currentCity">Current City: <span class="city_label">*</span></label>
														    <select name="fk_city_id" data-placeholder="Choose a Country..." class="chosen required city" tabindex="1">
																<option value="">Choose City...</option>
																@foreach($currentCity as $city)
																	<option value="{{$city->_id}}">{{$city->city_name}}</option>
																@endforeach
															</select>
														</div>	
						  							</div>
						  							<div class="col-sm-6 col-xs-6">
						  								<div class="form-group">
														    <label for="Email">Email: <span>*</span></label>
														    <input type="Email" name="email" placeholder="Email" class="form-control required" required>
														</div>
						  							</div>
						  						</div>
								  					
										  			
										  		<div class="row">
										  			<div class="col-sm-12">
										  				<div class="row">
										  					<div class="col-sm-6 col-xs-6">
										  						<div class="form-group">
									                			    <label>User Name: <span>*</span></label>
									                                <input type="text" id="username" name="username" placeholder="User Name" onblur="checkAvailability()" class="form-control required" pattern="^[a-zA-Z0-9]+$">
									                                <p id="user-availability-status"></p>
									                            </div>	
										  					</div>
										  					<div class="col-sm-6 col-xs-6">
										  						<div class="form-group">
																    <label>Mobile Number: <span>*</span></label>
																    <input type="tel" name="phone" id="phone" placeholder="Mobile number" class ="form-control phone-number" onKeyPress="edValueKeyPress()" required>
																    
																</div>
																<input type="hidden" value="" class="country-code" name="country_code">
										  					</div>
										  				</div>
										  			</div>
										  		</div>
					                			<div class="row">
					                				<div class="col-sm-6 col-xs-6">
					                					<div class="form-group">
							                			    <label>Password: <span>* </span></label>
							                                <input minlength="6" type="password" name="password" placeholder="At least six characters" class="form-control required password">
							                            </div>	
					                				</div>
					                				<div class="col-sm-6 col-xs-6">
					                					<div class="form-group">
							                			    <label>Confirm Password: <span>*</span></label>
							                                <input type="password" name="password_confirmation" placeholder="Confirm Password" class="form-control required confirm-password">
							                            </div>
					                				</div>

					                			</div>
					                            
												
												
					                            <div class="form-wizard-buttons">
					                                <button type="button" class="btn btn-next">Next</button>
					                            </div>
					                        </fieldset>
											<!-- Form Step 1 -->

											<!-- Form Step 2 -->
					                        <fieldset>
												
												<div style="clear:both;"></div>
													<div class="form-group image-upload">
													  <div class="setting image_picker">
														  <br/><h3 class="text-center">Upload Profile Image</h3>
														  <div class="settings_wrap">
															<label class="drop_target">
															  <div class="image_preview"></div>
															  <input id="inputFile" type="file" name="image" />
															</label>
															<!-- <div class="settings_actions vertical"><a class="disabled" data-action="remove_current_image"><i class="fa fa-trash" aria-hidden="true"></i> Remove Image</a></div> -->
															<!-- <div class="setting_actions"> <p>Take Photo</p></div> -->
														  </div>
														</div>							  
													</div>
												  	
					                            <div class="form-wizard-buttons">
					                                <button type="button" class="btn btn-previous">Previous</button>
					                                <button type="button" class="btn btn-next">Next</button>
					                            </div>
					                        </fieldset>
											<!-- Form Step 2 -->

											<!-- Form Step 3 -->
					                        <!-- <fieldset>
												<div class="form-group image-upload">
													  <div class="setting image_picker">
														  <br/><h3 class="text-center">Invite Friends</h3>
														  <div class="settings_wrap">
															
															
															<div class="invite_friend_section"> <p></p></div>
														  </div>
														</div>							  
													</div>
					                			
												
					                            <div class="form-wizard-buttons">
					                                <button type="button" class="btn btn-previous">Previous</button>
					                                <button type="button" class="btn btn-next">Next</button>
					                            </div>
					                        </fieldset> -->
											<!-- Form Step 3 -->
											
											<!-- Form Step 4 -->
											<fieldset>
												
												<div style="clear:both;"></div>
													<div class="success">
															<h3>Sing Up Success</h3>
														  	<div class="success-icon"><i class="fa fa-check" aria-hidden="true"></i></div>					  
													</div>
					                            <div class="form-wizard-buttons">
					                                <button type="button" class="btn btn-previous">Previous</button>
					                                <button type="submit" class="btn btn-submit">Confirm</button>
					                            </div>
					                        </fieldset>
											<!-- Form Step 4 -->
					                	
					                	{!! Form::close(); !!}
										
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			
			
		</div>
		<footer class="index_footer">
			<div class="footer_contianer">
				<div class="footer_overlay"></div>
				<div class="container">
					<div class="footer_top">
						<div class="row">
							<div class="col-md-10">
								
								<nav class="footer_nav">
									<ul>
										<li><a href="">Places</a></li>
										<li><a href="">Locations</a></li>
										<li><a href="{{URL::to('redirect-login-page')}}">Find Friends</a></li>
										<li><a href="" >Host a Travel</a></li>
										<li><a href="" >Mobile</a></li>
										<li><a href="{{URL::to('faqs-section')}}">FAQs</a></li>
										<li><a href="">Contact</a></li>
										<li><a href="{{URL::to('termsofuse')}}">Terms and Conditions</a></li>
										<li><a href="{{URL::to('privacy-policy')}}">Privacy and Policy</a></li>
									</ul>
								</nav>
									
							</div>
							<div class="col-md-2"><p class="copy-right">@ Adea 2018</p></div>
						</div>	
					</div>
					
				</div>
				
			</div>
		</footer>
	</div>
</div>

	



<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="{{asset('public/js/intlTelInput.js')}}"></script>
	<script src="{{asset('public/js/utils.js')}}"></script>
	<script src="{{ asset('public/js/app.js') }}"></script>
	<script>
		// $(document).on('keyup keypress', 'form input[type="text"]', function(e) {
		//   if(e.keyCode == 13) {
		//     e.preventDefault();
		//     return false;
		//   }
		// });
	</script>
	<script>
		$("#phone").intlTelInput({
			
	      // allowDropdown: false,
	      autoHideDialCode: false,
	      autoPlaceholder: "off",
	      dropdownContainer: "body",
	      // excludeCountries: ["us"],
	      //formatOnDisplay: false,
	      geoIpLookup: function(callback) {
	        $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
	          var countryCode = (resp && resp.country) ? resp.country : "";
	          callback(countryCode);
	        });
	      },
	      // hiddenInput: "full_number",
	      initialCountry: "auto",
	      // nationalMode: false,
	      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
	      placeholderNumberType: "MOBILE",
	      //preferredCountries: ['cn', 'jp'],
	       separateDialCode: true,
	     // utilsScript: "/build/js/utils.js"
	    });
	</script>

	<script>
   		function edValueKeyPress()
	    {
	        var edValue = document.getElementsByClassName("selected-dial-code");
	        countryCode = edValue[0].innerHTML;
	        $('.country-code').val(countryCode);
	    	//alert(countryCode);
  
	    }
	</script>
	<script>
		$("#username").on('keypress', function (event) {
		    $(this).val($(this).val().replace(/[^a-z0-9]/gi, ''));
		});

		function checkAvailability(){
			var username = $("#username").val();
			_token = $('input[name="_token"]').val();
			// var clearName =  username.replace(/[^A-Za-z0-9]/, '');
			// var username = $("#username").val(clearName);
			if(username !== " "){
				$.ajax({
					url: "{{URL::to('/')}}"+'/users/'+username,
		          	type: "get",
		          	data: {_token : _token,
		          		username:username
		          		},
		          	success:function(result)
		          	{
		            	if(result=='no'){
		            		$("#username").addClass('input-success');
							$(".btn-next").show();
							$("#user-availability-status").html('<span style="color:#49ce49">* This username is available</span>');
		            	}else{
		            		$("#username").addClass('input-error');
							$(".btn-next").hide();
							$("#user-availability-status").html('<span style="color:red">* This username is not available</span>');

		            	}

			        }
				});
			}else{
				$("#user-availability-status").hide();	
			}
		};
	</script>
	<script src="{{asset('public/frontend/js/form-wizard.js')}}"></script>
	<script src="{{asset('public/js/chosen.jquery.min.js')}}"></script>
	<script src="{{asset('public/js/chosen.proto.min.js')}}"></script>
	  <script>
	    jQuery(document).ready(function(){
	      jQuery(".chosen").chosen();
	    });
	  </script>
	
</body>
</html>