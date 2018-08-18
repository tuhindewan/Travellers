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
			<li class="active">Search Index</li>
			</ol>
		<h1 class="page-header"><small> Dashboard > SEO > </small>Search Index</h1>
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
                        <h4 class="panel-title">SEO</h4>
                    </div>
                    <div class="panel-body">
					
	                   <div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">Search Index</h4>
										</div>
               </div>
               <div class="modal-body">
                     <div class="form-group">
                                        <label class="col-md-3 control-label">Google Websearch Index (Total search Results)</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">La La La</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Total Backlinks</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">La La La</p>
                                        </div>    
                                    </div>
                                    <div class="form-group" >
                                        <label class="col-md-3 control-label">Search Engine Traffic</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">Search Engine Traffic: (Google.com)</p>
                                            <div id="stacked-chart" class="height-md" ></div>
                                        </div>    
                                    </div>
                                    div class="form-group" >
                                        <label class="col-md-3 control-label">Search Engine Traffic Price</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">Search Engine Traffic Price: (Google.com)</p>
                                            <div id="stacked-chart" class="height-md" ></div>
                                        </div>    
                                    </div>
                                    
                  </div>
                    <!-- end modal-body-->
                <div>
			</div>
			<!--end modal-content-->
		
</div>
                <!-- end panel -->
			
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
       
