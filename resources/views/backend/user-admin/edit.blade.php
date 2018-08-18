
@extends('backend.layout.app')
	@section('content')	
	<style>
		.form_delete{display: inline;}
		.form-group{display: block !important;}
        input{width: 100% !important;}
        .slide_upload {bottom: 6px;}

	</style>
	<!-- begin #content -->
	<div id="content" class="content">
		
		<ol class="breadcrumb pull-right">
			<li><a href="javascript:;">Dashboard</a></li>
			<li class="active">User Admin</li>
		</ol>
		<h1 class="page-header"><small>Dashboard > Administration > </small>{{$getAdmin->username}} Edit Page</h1>
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
						{!! Form::open(array('route' => ['user-admin.update',$getAdmin->_id],'class'=>'form-horizontal','method'=>'PUT','files'=>'true')) !!}  
                            
                            <div class="form-group col-sm-12">
                                <label class="control-label col-md-3 col-sm-3">Status :</label>
                                <div class="col-md-2 col-sm-2">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="status" value="1" id="radio-required" data-parsley-required="true" @if($getAdmin->status=="1"){{"checked"}}@endif /> Active
                                        </label>
                                    </div>
                                </div>
            
                                <div class="col-md-3 col-sm-3">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="status" id="radio-required2" value="0" @if($getAdmin->status=="0"){{"checked"}}@endif /> Inactive
                                        </label>
                                    </div>
                                </div> 
                            </div>
                            <div class="form-group col-sm-12" >
                                <label class="control-label col-sm-3">Select Role : </label>
                                <div class="col-sm-9">
                                    <select name="fk_role_id" required="required" class="form-control chosen" >
                                        
                                      @foreach($getRole as $role)
                                        <option value="<?php echo $role->_id; ?>" @if($accessRole['_id']==$role->_id){{"selected"}}@endif><?php echo $role->role_name; ?></option>
                                      @endforeach
                                        
                                    </select>
                                      
                                </div>
                            </div>
                            <div class="form-group col-sm-12" >
                                <label class="control-label col-sm-3">User Name : </label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" name="username" value="{{$getAdmin->username}}">  
                                      
                                </div>
                            </div>

                            <div class="form-group col-sm-12" >
                                <label class="control-label col-sm-3">Email : </label>
                                <div class="col-sm-9">
                                  <input type="email" class="form-control" name="email" value="{{$getAdmin->email}}">  
                                      
                                </div>
                            </div>
                            <input type="hidden" value="{{$getAdmin->password}}" name="password">
                            <div class="form-group col-sm-12" >
                                <label class="control-label col-sm-3">Phone : </label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" name="phone" value="{{$getAdmin->phone}}">  
                                      
                                </div>
                            </div>
                            <div class="form-group col-sm-12" >
                                <label class="control-label col-sm-3">First Name : </label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" name="firstname" value="{{$getAdmin->firstname}}">  
                                      
                                </div>
                            </div>
                            <div class="form-group col-sm-12" >
                                <label class="control-label col-sm-3">Last Name : </label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" name="lastname" value="{{$getAdmin->lastname}}">  
                                      
                                </div>
                            </div>
                            <div class="form-group col-sm-12" >
                                <label class="control-label col-sm-3">Address : </label>
                                <div class="col-sm-9">
                                  <textarea rows="3" class="form-control" name="address"><?php echo $getAdmin->address; ?></textarea> 
                                      
                                </div>
                            </div>
                            <div class="form-group col-md-12 {{ $errors->has('image') ? 'has-error' : ''}} ">
                                <label class="control-label col-sm-3">Profile Image * </label>
                                
                                <div class="col-md-5">
                                  <label class="slide_upload" for="file{{$getAdminProfile['_id']}}">
                                      <!--  -->
                                      <?php $image = $getAdminProfile['image']; ?>
                                      <img id="image_load{{$getAdminProfile['_id']}}" src='{{asset("images/admin/$image")}}'>
                                  </label>
                                  <input type="file" id="file{{$getAdminProfile['_id']}}" name="image" onchange="readURL(this,this.id)" style="display:none">
                                   
                                </div>
                                
                                
                                
                            </div>
                            
                                
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                  
                                  <button type="submit" class="btn btn-success btn-trans waves-effect w-md waves-success m-b-5">
                                    <span class="btn-label">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    Update
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
            // /App.init();
            TableManageResponsive.init();
        });
    </script>
    <script type="text/javascript">
        function readURL(input,image_load) {
          var target_image='#'+$('#'+image_load).prev().children().attr('id');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $(target_image).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>		
@endsection
