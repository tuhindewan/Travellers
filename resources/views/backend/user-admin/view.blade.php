
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
			<li class="active">User Admin</li>
		</ol>
		<h1 class="page-header"><small>Dashboard > Administration > </small>{{$getAdmin->username}} Profile Page</h1>
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
                        <h4 class="panel-title">{{$getAdmin->username}}</h4>
                    </div>

                    <div class="panel-body">
						
						<div class="view_admin_profile_section">
                            <div class="profile-section">
                                <!-- begin profile-left -->
                                <div class="profile-left">
                                    <?php $image = $getAdminProfile['image']; ?>
                                    <!-- begin profile-image -->
                                    <div class="profile-image">
                                        <img src='{{asset("images/admin/$image")}}' />
                                        <i class="fa fa-user hide"></i>
                                    </div>
                                    <!-- end profile-image -->
                                    <div class="m-b-10">
                                        <a href="admin#update{{$getAdmin->_id}}" id="edit" class="btn btn-warning btn-block btn-sm" data-toggle="modal">Edit Profile</a>

                                        <!-- #model body -->
                                        <div class="modal fade passwordModal" id="update{{$getAdmin->_id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h4 class="modal-title">Please Type Your Password</h4>
                                                    </div>
                                                    {!! Form::open(array('url' => "check_access/$getAdmin->_id/1",'class'=>'form-horizontal author_form','method'=>'POST','files'=>'true')) !!}
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
                                        <br>
                                        <!-- change password section -->
                                        <a href="admin#password{{$getAdmin->_id}}" id="edit" class="btn btn-info btn-block btn-sm" data-toggle="modal">Change Password</a>

                                        <!-- #model body -->
                                        <div class="modal fade passwordModal" id="password{{$getAdmin->_id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h4 class="modal-title">Please Type Your Password</h4>
                                                    </div>
                                                    {!! Form::open(array('url' => "check_access/$getAdmin->_id/2",'class'=>'form-horizontal author_form','method'=>'POST','files'=>'true')) !!}
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
                                    </div>
                                    <!-- begin profile-highlight -->
                                    <div class="profile-highlight">
                                        <h4><i class="fa fa-cog"></i> Access Role Type</h4>
                                        <div class="checkbox m-b-5 m-t-0">
                                            <input type="checkbox" data-render="switchery" data-theme="default" checked>
                                            <span class="text-muted m-l-5 m-r-20">{{$getRole['role_name']}}</span>
                                        </div>
                                    </div>
                                    <!-- end profile-highlight -->
                                </div>
                                <!-- end profile-left -->
                                <!-- begin profile-right -->
                                <div class="profile-right">
                                    <!-- begin profile-info -->
                                    <div class="profile-info">
                                        <!-- begin table -->
                                        <div class="table-responsive">
                                            <table class="table table-profile">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>
                                                            <h4>{{$getAdmin->username}}</h4>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="highlight">
                                                        <td class="field">Email</td>
                                                        <td><a href="#">{{$getAdmin->email}}</a></td>
                                                    </tr>
                                                    <tr class="divider">
                                                        <td colspan="2"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="field">Mobile</td>
                                                        <td><i class="fa fa-mobile fa-lg m-r-5"></i> {{$getAdmin->phone}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="field">Status</td>
                                                        <td>
                                                            @if($getAdmin->status==1)
                                                                Active
                                                            @else
                                                                Inactive
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="field">First Name</td>
                                                        <td><a href="#">{{$getAdmin->firstname}}</a></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td class="field">Last Name</td>
                                                        <td><a href="#">{{$getAdmin->lastname}}</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="field">Address</td>
                                                        <td><a href="#">{{$getAdmin->address}}</a></td>
                                                    </tr>
                                                    
                                                    <tr class="divider">
                                                        <td colspan="2"></td>
                                                    </tr>
                                                    <tr class="highlight">
                                                        <td class="field">Created By</td>
                                                        <td><a href="#">{{$getAdmin->created_by}}</a></td>
                                                    </tr>
                                                    <tr class="divider">
                                                        <td colspan="2"></td>
                                                    </tr>
                                                    
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end table -->
                                    </div>
                                    <!-- end profile-info -->
                                </div>
                                <!-- end profile-right -->
                            </div>    
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
	<script>
        $(document).ready(function() {
            // /App.init();
            FormSliderSwitcher.init();
        });
    </script>		
@endsection
