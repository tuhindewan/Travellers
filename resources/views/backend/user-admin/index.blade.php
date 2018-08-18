
@extends('backend.layout.app')
	@section('content')	
	<style>
		.form_delete{display: inline;}
		.form-group{display: block !important;}
        .modal-body input{width: 100% !important;} 
        
	</style>
	<!-- begin #content -->
	<div id="content" class="content">
		
		<ol class="breadcrumb pull-right">
			<li><a href="javascript:;">Dashboard</a></li>
			<li class="active">User Admin</li>
		</ol>
		<h1 class="page-header"><small>Dashboard > Administration > </small>User Admin Page</h1>
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
                        <h4 class="panel-title">List Of User Admin</h4>
                    </div>

                    <div class="panel-body">
						
						<!-- role view section -->
						
                        <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Role Name</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i=0; ?>
                            @foreach($getUser as $user)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>
                                        @foreach($getAdminWiseRole as $adminWiseRole)
                                            @if($adminWiseRole->fk_admin_id==$user->_id)
                                                @foreach($getRole as $role)
                                                    @if($role->_id==$adminWiseRole->fk_role_id)
                                                        {{$role->role_name}}
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                    	@if($user->status == 1)
											<a href="admin#status{{$user->_id}}" id="status" class="btn btn-danger btn-sm m-r-5 m-b-5" data-toggle="modal">Inactive</a>
                                    	@else
											<a href="admin#status{{$user->_id}}" id="status" class="btn btn-success btn-sm m-r-5 m-b-5" data-toggle="modal">Active</a>
                                    	@endif
                                        <!-- #model body -->
                                        <div class="modal fade passwordModal" id="status{{$user->_id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h4 class="modal-title">Please Type Your Password</h4>
                                                    </div>
                                                    {!! Form::open(array('url' => "check_access/$user->_id/0",'class'=>'form-horizontal author_form','method'=>'POST','files'=>'true')) !!}
                                                    <div class="modal-body">
                                                        <h5 class="change-message">To Change This User's <b>Status</b>, Then Confirm Your Password  </h5>
                                                        {!! csrf_field() !!}
                                                        <input type="hidden" value="{{Auth::user()->_id}}" name="id">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4 col-sm-4">Password :</label>
                                                            <div class="col-md-8 col-sm-8">
                                                                <input type="password" class="form-control" name="password" placeholder="Please Type Your Password" >
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

                                    </td>
                                    <td>
                                        <!-- start user edit section -->
                                        <a href='{{URL::to("user-admin/$user->_id")}}' class="btn btn-success btn-sm m-r-5 m-b-5" target="_blank"> View </a>
                                        
                                        <!-- end user edit section -->
                                        <!-- start user edit section -->
                                        

                                        <a href="admin#update{{$user->_id}}" id="edit" class="btn btn-warning btn-sm m-r-5 m-b-5" data-toggle="modal">Edit</a>
                                    

                                        <!-- #model body -->
                                        <div class="modal fade passwordModal" id="update{{$user->_id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h4 class="modal-title">Please Type Your Password</h4>
                                                    </div>
                                                    {!! Form::open(array('url' => "check_access/$user->_id/1",'class'=>'form-horizontal author_form','method'=>'POST','files'=>'true')) !!}
                                                    <div class="modal-body">
                                                        <h5 class="change-message">To Change This User's <b>Information Update</b>, Then Confirm Your Password  </h5>
                                                        {!! csrf_field() !!}
                                                        <input type="hidden" value="{{Auth::user()->_id}}" name="id">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4 col-sm-4">Password :</label>
                                                            <div class="col-md-8 col-sm-8">
                                                                <input type="password" class="form-control" name="password" placeholder="Please Type Your Password" >
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
                                        
                                        <!-- end user edit section -->
                                        <!-- start user change password -->
                                        <a href="admin#change-password{{$user->_id}}" id="change-password" class="btn btn-info btn-sm m-r-5 m-b-5" data-toggle="modal">Change Password</a>
                                        
                                        <!-- #model body -->
                                        <div class="modal fade passwordModal" id="change-password{{$user->_id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h4 class="modal-title">Please Type Your Password</h4>
                                                    </div>
                                                    {!! Form::open(array('url' => "check_access/$user->_id/2",'class'=>'form-horizontal author_form','method'=>'POST','files'=>'true')) !!}
                                                    <div class="modal-body">
                                                        <h5 class="change-message">To Change This User's <b>Change Password</b>, Then Confirm Your Password  </h5>
                                                        {!! csrf_field() !!}
                                                        <input type="hidden" value="{{Auth::user()->_id}}" name="id">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4 col-sm-4">Password :</label>
                                                            <div class="col-md-8 col-sm-8">
                                                                <input type="password" class="form-control" name="password" placeholder="Please Type Your Password" >
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
                                        
                                        <!-- end user change password -->

                                        <!-- start user delete section -->
                                        <a href="admin#delete{{$user->_id}}" id="delete" class="btn btn-danger btn-sm m-r-5 m-b-5" data-toggle="modal">Delete</a>
                                    

                                        <!-- #model body -->
                                        <div class="modal fade passwordModal" id="delete{{$user->_id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h4 class="modal-title">Please Type Your Password</h4>
                                                    </div>
                                                    {!! Form::open(array('url' => "check_access/$user->_id/3",'class'=>'form-horizontal author_form','method'=>'POST','files'=>'true')) !!}
                                                    <div class="modal-body">
                                                        <h5 class="change-message">To Change This User's <b>Delete</b>, Then Confirm Your Password  </h5>
                                                        {!! csrf_field() !!}
                                                        <input type="hidden" value="{{Auth::user()->_id}}" name="id">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4 col-sm-4">Password :</label>
                                                            <div class="col-md-8 col-sm-8">
                                                                <input type="password" class="form-control" name="password" placeholder="Please Type Your Password" >
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
                                        <!-- {!! Form::open(array('route'=> ['user-admin.destroy',$user->_id],'method'=>'DELETE','class'=>'form_delete')) !!}
                                            {{ Form::hidden('id',$user->_id)}}
                                            <button type="submit" onclick="return confirmDelete();" class="btn btn-danger btn-sm m-r-5 m-b-5">
                                              <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </button>
                                        {!! Form::close() !!} -->
                                        
                                        <!-- end user delete section -->
                                        
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
