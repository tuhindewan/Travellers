
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
			<li class="active">Messages</li>
		</ol>
		<h1 class="page-header"><small> Dashboard > Messages > </small>Newsletter</h1>
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
                        <h4 class="panel-title">Newsletter</h4>
                    </div>

                    <div class="panel-body">
                        {!! Form::open(array('route' => 'newsletter.store','class'=>'form-horizontal','method'=>'POST','files'=>'true')) !!}  
                            
                            <div class="form-group col-sm-12" >
                                <label class="control-label col-sm-3">Emails (Users) : </label>
                                <div class="col-sm-9">
                                  <input name="users-email" id="user-email" class="form-control" value="" data-default="add a E-mails" /> 
                                      
                                </div>
                            </div>
                            
                            <div class="form-group col-sm-12" >
                                <label class="control-label col-sm-3">E-mails (subscribers) : </label>
                                <div class="col-sm-9">
                                  <input name="subscribers-email" id="subscriber-email" class="form-control" value="" data-default="add a E-mails" />  
                                </div>
                            </div>
                            

                            <div class="form-group col-sm-12" >
                                <label class="control-label col-sm-3">Email Address : </label>
                                <div class="col-sm-9">
                                  <input type="text" name="email_address" class="form-control" id="email_address" value="">  
                                      
                                </div>
                            </div>

                            <div class="form-group col-sm-12" >
                                <label class="control-label col-sm-3">Newsletter Subject :</label>
                                <div class="col-sm-9">
                                  <input type="text" name="subject" class="form-control" id="phone" value="">  
                                      
                                </div>
                            </div>

                            <div class="form-group col-sm-12" >
                                <label class="control-label col-sm-3">Newsletter Content :</label>
                                <div class="col-sm-9">
                                  <textarea class="textarea form-control" name="body" id="wysihtml5" placeholder="Enter text ..." rows="18"></textarea>   
                                      
                                </div>
                            </div>
                    
                             
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                  
                                  <button type="submit" class="btn btn-success btn-trans waves-effect w-md waves-success m-b-5">
                                    <span class="btn-label">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    Send
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
	<script>
        $(document).ready(function() {
            
            FormWysihtml5.init();
            $('#user-email').tagsInput({
                defaultText: "Add a Users Email",
            });
            $('#subscriber-email').tagsInput({
                defaultText: "Add a Subscriber Email", 
            });
        });
    </script>
  		
@endsection
