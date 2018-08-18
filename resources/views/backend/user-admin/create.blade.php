
@extends('backend.layout.app')
	@section('content')
	<link href="{{asset('public/backend/plugins/bootstrap-wizard/css/bwizard.min_2.css')}}" rel="stylesheet" />	
	<style>
		.form_delete{display: inline;}
		.form-group{display: block !important;}
		.radio {margin-top: 0;}
		.wizard_div{margin-bottom:10px;}
	</style>
	<!-- begin #content -->
	<div id="content" class="content">
		
		<ol class="breadcrumb pull-right">
			<li><a href="{{URL::to('admin')}}">Dashboard</a></li>
			<li class="active">User Admin Create</li>
		</ol>
		<h1 class="page-header"><small>Dashboard > Administration > </small>User Admin Create Page</h1>
		<hr>
		<!-- start row -->
		<div class="row">
			<div class="role_view_section">
		        <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">User Admin Create</h4>
                    </div>

                    <div class="panel-body">
						<div class="user-admin-section">
							{!! Form::open(array('route' => 'user-admin.store','class'=>'form-horizontal author_form','method'=>'POST','files'=>'true','data-parsley-validate'=>'true', 'name'=> 'form-wizard')) !!}
								{!! csrf_field() !!}
							
								<div id="wizard">
									<ol>
										<li>
										    Contact & Login Information 
										    <small>Aliquam bibendum felis id purus ullamcorper, quis luctus leo sollicitudin.</small>
										</li>
										
										<li>
										    Select Role and Completed
										    <small>Sed nunc neque, dapibus non leo sed, rhoncus dignissim elit.</small>
										</li>
									</ol>
									<!-- begin wizard step-1 -->
									<div class="wizard-step-1">
                                        <fieldset>
                                            <legend class="pull-left width-full">Identification & Login</legend>
                                            
                                            <!-- begin row -->
                                            <div class="row">
                                            	<!-- begin col-6 -->
                                                <div class="col-md-6">
													<div class="form-group">
														<label>Email Address</label>
														<input type="email" name="email" placeholder="someone@example.com" class="form-control" data-parsley-group="wizard-step-1" data-parsley-type="email" required />
													</div>
                                                </div>
                                                <!-- end col-6 -->
                                                <!-- begin col-6 -->
                                                <div class="col-md-6">
													<div class="form-group">
														<label>Phone Number</label>
														<input type="text" name="phone" placeholder="1234567890" class="form-control" data-parsley-group="wizard-step-1" data-parsley-type="number" required />
													</div>
                                                </div>
                                                <!-- end col-6 -->
                                                
                                            </div>
                                            <!-- end row -->
                                            <!-- begin row -->
                                            <div class="row">
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Username</label>
                                                        <div class="controls">
                                                            <input type="text" name="username" placeholder="johnsmithy" class="form-control" data-parsley-group="wizard-step-1" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Pasword</label>
                                                        <div class="controls">
                                                            <input type="password" name="password" placeholder="password minimum 6 characters" class="form-control" data-parsley-group="wizard-step-1" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Confirm Pasword</label>
                                                        <div class="controls">
                                                            <input type="password" name="password_confirmation" placeholder="Confirmed password" class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
                                            </div>
                                            <!-- end row -->
										</fieldset>
									</div>
									<!-- end wizard step-1 -->
									<!-- begin wizard step-2 -->
									<div>
									    <div class="jumbotron m-b-0 text-center">
                                        	<div class="row">
                                        		<div class="col-md-offset-3 col-md-6 wizard_div">
													<div class="form-group">
														<label class="col-md-4 col-sm-4">Status :</label>
														<div class="col-md-2 col-sm-2">
															<div class="radio">
																<label>
																	<input type="radio" name="status" value="1" id="radio-required" data-parsley-required="true" checked /> Active
																</label>
															</div>
														</div>
									
														<div class="col-md-4 col-sm-4">
															<div class="radio">
																<label>
																	<input type="radio" name="status" id="radio-required2" value="0" /> Inactive
																</label>
															</div>
														</div>
													</div>
                                                </div>
                                        		
                                        	<!-- </div> 
                                            <div class="row"> -->
	                                            <!-- <h3 class="set_role">Set Role</h3> -->
	                                            <div class="col-md-offset-3 col-md-6 wizard_div">
	                                            	<div class="form-group" >
									                    <label class="col-md-4 col-sm-4">Select Role : </label>
									                    <div class="col-sm-8">
									                        <select name="fk_role_id" required="required" class="form-control chosen" >
									                            @if($getRole)
									                              <option value="-1"> - Select - </option>
									                              @foreach($getRole as $role)
									                                <option value="<?php echo $role->_id; ?>"><?php echo $role->role_name; ?></option>
									                              @endforeach
									                            @endif
									                        </select>
									                          
									                    </div>
									                </div>	
	                                            </div>
												<input type="hidden" name="created_by" value="{{Auth::user()->email}}">
	                                            <div class="col-md-offset-3 col-md-6 wizard_div">
	                                            	<div class="form-group" >
									                    <button type="submit" class="btn btn-success">Confirm</button>
									                </div>	
	                                            </div>
                                            
                                            </div>		  
                                        </div>
									</div>
									<!-- end wizard step-2 -->
									
								</div>
							{!! Form::close(); !!}
						</div>
                    </div>
                </div>
                <!-- end panel -->
			</div>
		</div>
		<!-- end row -->
	</div>
	<!-- end #content -->

	<script src="{{asset('public/backend/plugins/jquery/jquery-1.9.1.min_2.js')}}"></script>
	<script src="{{asset('public/backend/plugins/parsley/dist/parsley_2.js')}}"></script>
	<script src="{{asset('public/backend/plugins/bootstrap-wizard/js/bwizard_2.js')}}"></script>
	<script src="{{asset('public/backend/js/form-wizards-validation.demo.min_2.js')}}"></script>
	<script>
        $(document).ready(function() {
            // /App.init();
            FormWizardValidation.init();
            FormSliderSwitcher.init();
        });
    </script>		
@endsection
