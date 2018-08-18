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
			<li class="active">Manage Settings</li>
		</ol>
		<h1 class="page-header"><small> Dashboard > Settings > </small>Settings Info</h1>
		<hr>
		<!-- start row -->
		<div class="row">
			
		        <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">Manage Settings</h4>
                    </div>

                    <div class="panel-body">
					
	                   
						
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">Settings</h4>
										</div>
									
										<div class="modal-body">
                    <?php $id  = $getWebSettings['_id']; ?>
                      {!! Form::open(array('route' => ['web-settings.update',$id],'class'=>'form-horizontal author_form','method'=>'PUT','files'=>'true')) !!}
                        <div class="modal-body">
                          
                          {!! csrf_field() !!}
                            <div class="form-group">
                              <label for="Company_Name">Company Name</label>
                              <input type="text" name="company_name" class="form-control" id="company_name" value="{{$getWebSettings['company_name']}}">
                            </div>
                            <div class="form-group">
                              <label for="Logo">Logo</label>
                              <input name="logo" type="file" id="logo">
                            </div>
                            <div class="form-group">
                              <label for="Address">Address</label>
                              <textarea name="address" class="form-control" input type="text" placeholder="Enter ...">{{$getWebSettings['address']}}</textarea>
                            </div>
                           
                             <div class="form-group">
                              <label for="Email">Email</label>
                              <input type="email" name="email" class="form-control" id="email" value="{{$getWebSettings['email']}}">
                            </div>
                            <div class="form-group">
                              <label for="Fav Icon">Fav Icon</label>
                              <input name="fav_icon" type="file" id="fav_icon">
                            </div>
                            <div class="form-group">
                              <button type="submit" class="btn btn-sm btn-success">Update</button>
                            </div>
                        </div>
                        
                        {!! Form::close(); !!}

                    </div>
                    <!-- end modal-body-->
                </div>
                <!-- end panel -->
			</div>
			<!--end modal-content-->
		</div>
		<!-- end row -->
	</div>
	<!-- end #content -->

	<script src="{{asset('public/backend/plugins/jquery/jquery-1.9.1.min_2.js')}}"></script>
	<script>
        $(document).ready(function() {
            TableManageResponsive.init();
        });
    </script>		
@endsection