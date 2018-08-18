@extends('backend.layout.app')
	@section('content')	
	<style>
		.form_delete{display: inline;}
		.form-group{display: block !important;}
		.append_image{position: relative;}
		.close_image{position: absolute; top: 27px; right: 21px;}
	</style>
	<!-- begin #content -->
	<div id="content" class="content">
		
		<ol class="breadcrumb pull-right">
			<li><a href="javascript:;">Dashboard</a></li>
			<li class="active">Admin Announcement</li>
		</ol>
		<h1 class="page-header"><small>Dashboard > Administration > </small>Admin Announcement Edit Page</h1>
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
                        <h4 class="panel-title">Edit Announcement</h4>
                    </div>
                    <div class="panel-body">
	                    {!! Form::open(array('route' => ['admin-announcement.update',$data['_id']],'class'=>'form-horizontal','method'=>'PUT','files'=>'true')) !!}
	                    	{{ csrf_field() }}
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4" for="headline">Announcement Status * :</label>
								<div class="col-md-6 col-sm-6">
									
									@if($data->status == 1)    
									   <input type="checkbox" name="status" checked data-toggle="toggle"> 
									@else
									    <input type="checkbox" name="status"  data-toggle="toggle"> 
									@endif  
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4" for="website">Start Date :</label>
								<div class="col-md-6 col-sm-6">
									<div class="input-group date" id="datetimepicker1">
                                        <input type="text" class="form-control" name="start_date_time" value="{{$data->start_date_time}}" placeholder="Required" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                        			@if ($errors->has('start_date_time'))
                                        <span class="text-danger">{{ $errors->first('start_date_time') }}</span>
                                    @endif
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4" for="website">Last Date :</label>
								<div class="col-md-6 col-sm-6">
									<div class="input-group date" id="datetimepicker3">
                                        <input type="text" class="form-control" name="last_date_time" value="{{$data->last_date_time}}" placeholder="Required" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                        			@if ($errors->has('start_date_time'))
                                        <span class="text-danger">{{ $errors->first('start_date_time') }}</span>
                                    @endif
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4" for="body">Your Announcement (Maximum 250 Words) :</label>
								<div class="col-md-6 col-sm-6">
									<textarea style="text-transform: initial; text-align: justify;" class="textarea form-control" placeholder="Enter text ..." rows="12" name="description">{{ $data->description }}</textarea>
									@if ($errors->has('description'))
						                <span class="text-danger">{{ $errors->first('description') }}</span>
						            @endif
								</div>
							</div>
							<input type="hidden" value="{{Auth::user()->_id}}" name="admin_id">
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4"></label>
								<div class="col-md-6 col-sm-6">
									<button type="submit" class="btn btn-success btn-trans waves-effect w-md waves-success">UPDATE</button>
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

	<script>
		
		$('#images').on('change',function(e){
			var files = e.target.files;
			
			$.each(files, function(i, file){
				var reader = new FileReader();

				reader.readAsDataURL(file);
				
				i=$('img').length;

				reader.onload = function(e){
					var template = '<div class="col-md-3" id="addfile_'+i+'">'+							
									'<img height="100px" class="append_image" id="image_'+i+'" width="100px" src="'+e.target.result+'" alt="" style="margin-top: 27px"> <button type="button" class="close_image" auto= "'+i+'" onclick="myFunction(this.id)" id="'+i+'"><i class="fa fa-times" aria-hidden="true"></i></button>'+
											'</div>';

					$('#images-to-upload').append(template);
					i++;
				};
			});
			
		});//

		/*$(".close_image").on('click', function(){
			
		});*/
		function myFunction(id) {
			
			$("#addfile_"+id).remove();
		}
	</script>

	<script src="{{asset('public/backend/plugins/jquery/jquery-1.9.1.min_2.js')}}"></script>
	<script src="{{asset('public/backend/plugins/bootstrap-wysihtml5/dist/bootstrap3-wysihtml5.all.min_2.js')}}"></script>


	<script src="{{asset('public/backend/js/form-wysiwyg.demo.min_2.js')}}"></script>
	<script src="{{asset('public/backend/plugins/jquery-file-upload/js/vendor/jquery.ui.widget_2.js')}}"></script>
    <script src="{{asset('public/backend/plugins/jquery-file-upload/js/vendor/tmpl.min_2.js')}}"></script>
    <script src="{{asset('public/backend/plugins/jquery-file-upload/js/vendor/load-image.min_2.js')}}"></script>
    <script src="{{asset('public/backend/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min_2.js')}}"></script>
    <script src="{{asset('public/backend/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min_2.js')}}"></script>
    <script src="{{asset('public/backend/plugins/jquery-file-upload/js/jquery.iframe-transport_2.js')}}"></script>
    <script src="{{asset('public/backend/plugins/jquery-file-upload/js/jquery.fileupload_2.js')}}"></script>
    <script src="{{asset('public/backend/plugins/jquery-file-upload/js/jquery.fileupload-process_2.js')}}"></script>
    <script src="{{asset('public/backend/plugins/jquery-file-upload/js/jquery.fileupload-image_2.js')}}"></script>
    <script src="{{asset('public/backend/plugins/jquery-file-upload/js/jquery.fileupload-audio_2.js')}}"></script>
    <script src="{{asset('public/backend/plugins/jquery-file-upload/js/jquery.fileupload-video_2.js')}}"></script>
    <script src="{{asset('public/backend/plugins/jquery-file-upload/js/jquery.fileupload-validate_2.js')}}"></script>
    <script src="{{asset('public/backend/plugins/jquery-file-upload/js/jquery.fileupload-ui_2.js')}}"></script>


	<script src="{{asset('public/backend/plugins/bootstrap-datepicker/js/bootstrap-datepicker_2.js')}}"></script>
	<script src="{{asset('public/backend/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min_2.js')}}"></script>
	<script src="{{asset('public/backend/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min_2.js')}}"></script>
	<script src="{{asset('public/backend/plugins/masked-input/masked-input.min_2.js')}}"></script>
	<script src="{{asset('public/backend/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min_2.js')}}"></script>
	<script src="{{asset('public/backend/plugins/password-indicator/js/password-indicator_2.js')}}"></script>
	<script src="{{asset('public/backend/plugins/bootstrap-combobox/js/bootstrap-combobox_2.js')}}"></script>
	<script src="{{asset('public/backend/plugins/bootstrap-select/bootstrap-select.min_2.js')}}"></script>
	<script src="{{asset('public/backend/plugins/jquery-tag-it/js/tag-it.min_2.js')}}"></script>
    <script src="{{asset('public/backend/plugins/bootstrap-daterangepicker/moment_2.js')}}"></script>
    <script src="{{asset('public/backend/plugins/bootstrap-daterangepicker/daterangepicker_2.js')}}"></script>
    <script src="{{asset('public/backend/plugins/select2/dist/js/select2.min_2.js')}}"></script>
    <script src="{{asset('public/backend/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min_2.js')}}"></script>
    <script src="{{asset('public/backend/plugins/bootstrap-show-password/bootstrap-show-password_2.js')}}"></script>
    <script src="{{asset('public/backend/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette_2.js')}}"></script>
    <script src="{{asset('public/backend/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker_2.js')}}"></script>
    <script src="{{asset('public/backend/plugins/clipboard/clipboard.min_2.js')}}"></script>


	<script src="{{asset('public/backend/js/form-plugins.demo.min_2.js')}}"></script>
	<script src="{{asset('public/backend/js/apps.min_2.js')}}"></script>
    <!--[if (gte IE 8)&(lt IE 10)]>
        <script src="{{asset('public/backend/plugins/jquery-file-upload/js/cors/jquery.xdr-transport.js')}}"></script>
    <![endif]-->
	<script src="{{asset('public/backend/js/form-multiple-upload.demo.min_2.js')}}"></script>
	<script src="{{asset('public/backend/js/apps.min_2.js')}}"></script>

	<script src="{{asset('public/backend/plugins/bootstrap-toggle/js/bootstrap-toggle.min.js')}}"></script>

	
	
	
	<script>
        $(document).ready(function() {
            
            FormWysihtml5.init();
           	FormPlugins.init();
            FormMultipleUpload.init();
        });
    </script>		
@endsection
