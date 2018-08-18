
@extends('backend.layout.app')
	@section('content')	
	<style>
		.form_delete{display: inline;}
		.form-group{display: block !important;}
	</style>
	<!-- begin #content -->
	<div id="content" class="content">
		
		<ol class="breadcrumb pull-right">
			<li><a href="javascript:;">Dashboard</a></li>
			<li class="active">Role</li>
		</ol>
		<h1 class="page-header"><small>Dashboard > Administration > </small>Role Page</h1>
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
                        <h4 class="panel-title">Role</h4>
                    </div>

                    <div class="panel-body">
						<!-- role add section -->
	                    <div class="role_add_section">
							<div class="add_more">
								<a href="role#create" class="btn btn-sm btn-success" data-toggle="modal">Add New Role</a>
							</div>

							<!-- #create -->
							<div class="modal fade" id="create">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">Role</h4>
										</div>
										{!! Form::open(array('route' => 'role.store','class'=>'form-horizontal author_form','method'=>'POST','files'=>'true')) !!}
										<div class="modal-body">
											
											{!! csrf_field() !!}
											<div class="form-group">
												<label class="control-label col-md-4 col-sm-4">Role Status :</label>
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
			                                    <label class="control-label col-md-4 col-sm-4">Role Name :</label>
			                                    <div class="col-md-8 col-sm-8">
			                                     	<input type="text" class="form-control" name="role_name" value="" placeholder="Enter Role Name">
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
                                    <th>SL.</th>
                                    <th>Role Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i=0; ?>
                            @foreach($getRole as $role)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{$role->role_name}}</td>
                                    <td>
                                    	@if($role->status == 1)
											Active
                                    	@else
											Inactive
                                    	@endif

                                    </td>
                                    <td>
                                    	<!-- edit role section start -->

										<a href="role#update{{$role->_id}}" class="btn btn-sm btn-info" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
									

										<!-- #update -->
										<div class="modal fade" id="update{{$role->_id}}">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
														<h4 class="modal-title">{{$role->role_name}}</h4>
													</div>
													{!! Form::open(array('route' => ['role.update',$role->_id],'class'=>'form-horizontal author_form','method'=>'PUT','files'=>'true')) !!}
													<div class="modal-body">
														
														{!! csrf_field() !!}
														<div class="form-group">
															<label class="control-label col-md-4 col-sm-4">Role Status :</label>
															<div class="col-md-2 col-sm-2">
																<div class="radio">
																	<label>
																		<input type="radio" name="status" value="1" id="radio-required" data-parsley-required="true" @if($role->status=="1"){{"checked"}}@endif /> Active
																	</label>
																</div>
															</div>
										
															<div class="col-md-4 col-sm-4">
																<div class="radio">
																	<label>
																		<input type="radio" name="status" id="radio-required2" value="0" @if($role->status=="0"){{"checked"}}@endif /> Inactive
																	</label>
																</div>
															</div> 
														</div>
														<div class="form-group">
						                                    <label class="control-label col-md-4 col-sm-4">Role Name :</label>
						                                    <div class="col-md-8 col-sm-8">
						                                     	<input type="text" class="form-control" name="role_name" value="{{$role->role_name}}" >
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
                                        {!! Form::open(array('route'=> ['role.destroy',$role->_id],'method'=>'DELETE','class'=>'form_delete')) !!}
                                            {{ Form::hidden('id',$role->_id)}}
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
