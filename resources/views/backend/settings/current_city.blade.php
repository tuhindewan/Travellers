
@extends('backend.layout.app')
	@section('content')	
	<style>
		.form_delete{display: inline;}
		.form-group{display: block !important;}
		.modal .form-control{width: 100% !important;}
	</style>
	<!-- begin #content -->
	<div id="content" class="content">
		
		<ol class="breadcrumb pull-right">
			<li><a href="javascript:;">Dashboard</a></li>
			<li class="active">Current City</li>
		</ol>
		<h1 class="page-header"><small>Dashboard > Settings > </small>Current Page</h1>
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
                        <h4 class="panel-title">City</h4>
                    </div>

                    <div class="panel-body">
						<!-- role add section -->
	                    <div class="role_add_section">
							<div class="add_more">
								<a href="role#create" class="btn btn-sm btn-success" data-toggle="modal">Add New City</a>
							</div>

							<!-- #create -->
							<div class="modal fade" id="create">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">City</h4>
										</div>
										{!! Form::open(array('route' => 'current-city.store','class'=>'form-horizontal author_form','method'=>'POST','files'=>'true')) !!}
										<div class="modal-body">
											
											{!! csrf_field() !!}
											<div class="form-group">
												<label class="control-label col-md-4 col-sm-4">City Status :</label>
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
											<div class="form-group">
			                                    <label class="control-label col-md-4 col-sm-4">City Name :</label>
			                                    <div class="col-md-8 col-sm-8">
			                                     	<input type="text" class="form-control" name="city_name" placeholder="Enter City Name">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="control-label col-md-4 col-sm-4">Description :</label>
			                                    <div class="col-md-8 col-sm-8">
			                                     	<textarea name="description" rows="3" class="form-control" placeholder="Enter Description"></textarea>
			                                    </div>
			                                </div>
											
										</div>
										<div class="modal-footer">
											<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
											
											<button type="submit" class="btn btn-sm btn-success">Confirm</button>
										</div>
										{!! Form::close(); !!}
									</div>
								</div>
							</div>
						</div>
						<!-- role add section -->

						<!-- role view section -->
						
                        <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th width="5%">SL.</th>
                                    <th width="15%">City Name</th>
                                    <th width="65%">Description</th>
                                    <th width="5%">Status</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i=0; ?>
                            @foreach($getCurrentCity as $city)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{$city->city_name}}</td>
                                    <td>
                                    <?php 
                                    	$string = strip_tags($city->description);

										if (strlen($string) > 100) {

										    // truncate string
										    $stringCut = substr($string, 0, 120);
										    $stringLast = substr($string, 120);

										    // make sure it ends in a word so assassinate doesn't become ass...
										    $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'<br>... <button type="button" class="btn btn-sm btn-success" data-toggle="collapse" data-target="#demo">more</button>
												  <div id="demo" class="collapse">
												    '.$stringLast.'
												  </div>'; 
										}
										echo $string;
                                    ?>
                                    </td>
                                    <td>
                                    	@if($city->status == 1)
											Active
                                    	@else
											Inactive
                                    	@endif

                                    </td>
                                    <td>
                                    	<!-- edit role section start -->

										<a href="role#update{{$city->_id}}" class="btn btn-sm btn-info" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
									

										<!-- #update -->
										<div class="modal fade" id="update{{$city->_id}}">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
														<h4 class="modal-title">{{$city->city_name}}</h4>
													</div>
													{!! Form::open(array('route' => ['current-city.update',$city->_id],'class'=>'form-horizontal author_form','method'=>'PUT','files'=>'true')) !!}
													<div class="modal-body">
														
														{!! csrf_field() !!}
														<div class="form-group">
															<label class="control-label col-md-4 col-sm-4">City Status :</label>
															<div class="col-md-2 col-sm-2">
																<div class="radio">
																	<label>
																		<input type="radio" name="status" value="1" id="radio-required" data-parsley-required="true" @if($city->status=="1"){{"checked"}}@endif /> Active
																	</label>
																</div>
															</div>
										
															<div class="col-md-4 col-sm-4">
																<div class="radio">
																	<label>
																		<input type="radio" name="status" id="radio-required2" value="0" @if($city->status=="0"){{"checked"}}@endif /> Inactive
																	</label>
																</div>
															</div> 
														</div>
														<div class="form-group">
						                                    <label class="control-label col-md-4 col-sm-4">City Name :</label>
						                                    <div class="col-md-8 col-sm-8">
						                                     	<input type="text" class="form-control" name="city_name" value="{{$city->city_name}}" >
						                                    </div>
						                                </div>

						                                <div class="form-group">
						                                    <label class="control-label col-md-4 col-sm-4">City Description :</label>
						                                    <div class="col-md-8 col-sm-8">
						                                     	<textarea name="description" rows="3" class="form-control"><?php echo $city->description; ?></textarea>
						                                    </div>
						                                </div>
														
													</div>
													<div class="modal-footer">
														<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
														
														<button type="submit" class="btn btn-sm btn-success">Update</button>
													</div>
													{!! Form::close(); !!}
												</div>
											</div>
										</div>
                                    	<!-- edit role section end -->

                                    	<!-- delete role section -->
                                        {!! Form::open(array('route'=> ['current-city.destroy',$city->_id],'method'=>'DELETE','class'=>'form_delete')) !!}
                                            {{ Form::hidden('id',$city->_id)}}
                                            <button type="submit" onclick="return confirmDelete();" class="btn btn-danger">
                                              <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </button>
                                        {!! Form::close() !!}
                                        <!-- delete role section end -->
                                    </td>
                                </tr>
                            @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end panel -->
			</div>
		</div>
		<!-- end row -->
	</div>
	<!-- end #content -->

	<script src="{{asset('public/backend/plugins/jquery/jquery-1.9.1.min_2.js')}}"></script>
	<script>
        $(document).ready(function() {
            // /App.init();
            TableManageResponsive.init();
        });
    </script>		
@endsection
