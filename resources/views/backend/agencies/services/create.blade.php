@extends('backend.layout.app')
	@section('content')	
	
	<style>
		
    .slide_upload {bottom: 6px;}
    label{text-align: right;}
	</style>
	

	<link rel="stylesheet" href="{{asset('public/backend/css/agencies.css')}}">
	<!-- begin #content -->
	<div id="content" class="content">
		
		<ol class="breadcrumb pull-right">
			<li><a href="javascript:;">Dashboard</a></li>
			<li class="active">agency services</li>
		</ol>
		<h1 class="page-header"><small>Dashboard > </small>Agency services</h1>
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
                <h4 class="panel-title"> create services</h4>
            </div>
            <div class="panel-body">
              {!! Form::open(array('route' => 'agency-services.store','class'=>'','method'=>'POST','files'=>'true')) !!}
              	{{ csrf_field() }}
			          <div class="form-group col-sm-12" >
                    <label class="control-label col-sm-3">Publish status :</label>
                    <div class="col-sm-9">
                      <div class="checkbox m-b-5 m-t-0" style="display: inline">
                          <input type="checkbox" id="switchery" name="status"data-render="switchery" data-theme="default" checked >
                          <span class="text-muted m-l-5 m-r-20"></span>
                      </div>
                          
                    </div>
                </div>
                <div class="form-group col-sm-12" >
                    <label class="control-label col-sm-3">Services name* : </label>
                    <div class="col-sm-9">
                      <input type="text" placeholder="Type services name..." class="form-control" name="service_name" required="required">  
                          
                    </div>
                </div>
                <div class="form-group col-sm-12" >
                    <label class="control-label col-sm-3">Services description* : </label>
                    <div class="col-sm-9">
                      <textarea rows="6" placeholder="Type services details..." class="form-control" name="description" required="required"></textarea>
                          
                    </div>
                </div>
                <div class="form-group col-sm-12" >
                    <label class="control-label col-sm-3">Services logo* : </label>
                    <div class="col-sm-9">
                      <div class="input-group">
                          <label class="slide_upload" for="file">
                              <!--  -->
                              <img id="image_load" src='' style="display: none;">
                          </label>
                          <input type="file" id="file" name="image" onchange="readURL(this,this.id)" style="display:none">
                      </div>  
                          
                    </div>
                </div>
			               
  							<div class="form-group">
  								<label class="control-label col-md-4 col-sm-4"></label>
  								<div class="col-md-6 col-sm-6">
  									<button type="submit" class="btn btn-success btn-trans waves-effect w-md waves-success">Confirm </button>
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
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>


<script type="text/javascript">
    function readURL(input,image_load) {
      var target_image='#'+$('#'+image_load).prev().children().attr('id');
        $("#image_load").css('display','block');
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(target_image).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script>
    $(document).ready(function() {
        // /App.init();
        FormSliderSwitcher.init();
        FormWysihtml5.init();
    });
</script> 		
@endsection
