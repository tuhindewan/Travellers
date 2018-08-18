
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
			<li class="active">Role Wise Permission</li>
		</ol>
		<h1 class="page-header"><small>Dashboard > Administration > </small>Role Wise Permission Page</h1>
		<hr>
		<!-- start row -->
		<div class="row">
			<div class="permission_view_section">
		        <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">Role Wise Permission</h4>
                    </div>

                    <div class="panel-body">
						<!--   -->
						{!! Form::open(array('route' => 'role-wise-permission.store','class'=>'form-horizontal','method'=>'POST','files'=>'true')) !!}  
			                <div class="form-group col-sm-12 role_select" >
			                    <label class="control-label col-sm-3">Select Role* </label>
			                    <div class="col-sm-9">
			                        <select name="fk_role_id" required="required" class="form-control chosen" onchange="roleWisePermission(this.value)">
			                            @if($getRole)
			                              <option value="-1"> - Select - </option>
			                              @foreach($getRole as $role)
			                                <option value="<?php echo $role->_id; ?>"><?php echo $role->role_name; ?></option>
			                              @endforeach
			                            @endif
			                        </select>
			                          
			                    </div>
			                </div>
			                <div id="roleWisePermission"></div>
			                    
			                <div class="form-group">
			                    <div class="col-sm-offset-3 col-sm-9">
			                      <!-- {{ Form::submit('Confirm') }} --> 
			                      <button type="submit" class="btn btn-success btn-trans waves-effect w-md waves-success m-b-5">
			                        <span class="btn-label">
			                            <i class="fa fa-check"></i>
			                        </span>
			                        Confirm
			                      </button>
			                    </div>
			                </div>
						{!! Form::close(); !!}
                        
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
            
        });
    </script>
      
      <script type="text/javascript">
        function roleWisePermission(value){
	        if(value === '-1'){
	            $("#roleWisePermission").hide();
	        }else{

	        	$("#roleWisePermission").load("{{ URL::to('role-wise-permission')}}"+'/'+value);
	        	$("#roleWisePermission").show();
	        }

        }
      </script>		
@endsection
