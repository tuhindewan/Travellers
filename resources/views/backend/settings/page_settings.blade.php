
@extends('backend.layout.app')
	@section('content')	
	<style>
		.form_delete{display: inline;}
		.form-group{display: block !important;}
        input{width: 100% !important;}

	</style>
	<!-- begin #content -->
	<div id="content" class="content">
		
		<ol class="breadcrumb pull-right">
			<li><a href="javascript:;">Dashboard</a></li>
			<li class="active">Settings</li>
		</ol>
		<h1 class="page-header"><small> Dashboard > Settings > </small>Page Settings</h1>
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
                        <h4 class="panel-title">Page Settings</h4>
                    </div>

                    <div class="panel-body">
						<?php $id  = $getPageSettings['_id']; ?>
                        {!! Form::open(array('route' => ['page-settings.update',$id],'class'=>'form-horizontal','method'=>'PUT','files'=>'true')) !!}  
                            

                            <div class="form-group col-sm-12" >
                                <label class="control-label col-sm-3">Trems & Conditions : </label>
                                <div class="col-sm-9">
                                  <textarea class="textarea form-control" name="terms_conditions" id="wysihtml5" placeholder="Enter text ..." rows="18"><?php echo $getPageSettings['terms_conditions']; ?></textarea>    
                                </div>
                            </div>

                            <div class="form-group col-sm-12" >
                                <label class="control-label col-sm-3">Privacy Policy : </label>
                                <div class="col-sm-9">
                                  <textarea class="textarea form-control" name="privacy_policy" id="wysihtml5" placeholder="Enter text ..." rows="18"><?php echo $getPageSettings['privacy_policy']; ?></textarea>    
                                      
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
            FormWysihtml5.init();
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
