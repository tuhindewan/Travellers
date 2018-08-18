
@extends('backend.layout.app')
    @section('content') 
    <style>
        .form_delete{display: inline;}
        .form-group{display: block !important;}
        .modal-body input{width: 100% !important;} 
        .form-group {width: 100%;overflow: hidden;}
        table { table-layout: fixed; }
        table th, table td { overflow: hidden; }
    </style>


    <!-- begin #content -->
    <div id="content" class="content">
        
        <ol class="breadcrumb pull-right">
            <li><a href="javascript:;">Dashboard</a></li>
            <li class="active">Admin Publish Announcement</li>
        </ol>
        <h1 class="page-header"><small>Dashboard > Administration > </small>Admin Announcement Page</h1>
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
                        <h4 class="panel-title">Admin Announcement</h4>
                    </div>
                        <div class="panel-body">
                            
                            <!-- role view section -->
                            
                            <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                <thead>
                                    <tr>
                                        <th width="5%">SL.</th>
                                        <th width="35%">Announcement</th>
                                        <th width="20%">Publishing Date</th>
                                        <th width="20%">Ending Date</th>
                                        <th width="10%">Status</th>
                                        <th width="20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=0; ?>
                                    @foreach($getData as $data)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ substr($data->description,0,50) }} {{ strlen($data->description) > 50 ? "...." : "" }}</td>
                                        <td>{{ date('jS F Y, g:iA',strtotime($data->start_date_time)) }}</td>
                                        <td>{{ date('jS F Y, g:iA',strtotime($data->last_date_time)) }}</td>
                                        <td>
                                     <?php $adminId = Auth::user()->_id;?>
                                     <?php $fk_admin_id =  $data->fk_admin_id; ?>       

                                    @if($data->status == 1)    
                                        <a <?php if ($adminId != $fk_admin_id): ?>disabled<?php endif ?> href="#status{{$data->_id}}"  class="btn btn-success btn-sm m-r-5 m-b-5" data-toggle="modal">Active</a>
                                    @else
                                        <a <?php if ($adminId != $fk_admin_id): ?>disabled<?php endif ?> href="#status{{$data->_id}}"  class="btn btn-danger btn-sm m-r-5 m-b-5" data-toggle="modal">Inactive</a>
                                    @endif    
                                            <!-- #model body -->
                                            <div class="modal fade passwordModal" id="status{{$data->_id}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h4 class="modal-title">Please Type Your Password</h4>
                                                        </div>
                                                        {!! Form::open(array('url' => "admin_announcement_access/$data->_id/0",'class'=>'form-horizontal author_form','method'=>'POST','files'=>'true')) !!}
                                                        <div class="modal-body">
                                                            <h5 class="change-message" style="color: red;">To Change This Announcement's <b>Status</b>, Confirm Your Password  </h5>
                                                            {!! csrf_field() !!}
                                                            <input type="hidden" value="{{Auth::user()->_id}}" name="adminId">
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
                                            <a href="{{ route('admin-announcement.show',$data->_id) }}" class="btn btn-success btn-sm m-r-5 m-b-5" target="_blank"> View </a>
                                            
                                            <!-- end user edit section -->
                                            <!-- start user edit section -->
                                            
                                            
                                            
                                            <a <?php if ($adminId != $fk_admin_id): ?>disabled<?php endif ?>  href="#edit{{$data->_id}}"  class="btn btn-warning btn-sm m-r-5 m-b-5" data-toggle="modal">Edit</a>
                                        

                                            <!-- #model body -->
                                            <div class="modal fade passwordModal" id="edit{{$data->_id}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h4 class="modal-title">Please Type Your Password</h4>
                                                        </div>
                                                        {!! Form::open(array('url' => "admin_announcement_access/$data->_id/1",'class'=>'form-horizontal author_form','method'=>'POST','files'=>'true')) !!}
                                                        <div class="modal-body">
                                                            <h5 class="change-message" style="color: red;">To Edit This Announcement's <b>Information</b>, Then Confirm Your Password  </h5>
                                                            {!! csrf_field() !!}
                                                            <input type="hidden" value="{{Auth::user()->_id}}" name="adminId">
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
                                            <!-- start user delete section -->
                                            <a <a <?php if ($adminId != $fk_admin_id): ?>disabled<?php endif ?> href="#delete{{$data->_id}}"  class="btn btn-danger btn-sm m-r-5 m-b-5" data-toggle="modal">Delete</a>
                                        

                                            <!-- #model body -->
                                            <div class="modal fade passwordModal" id="delete{{$data->_id}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h4 class="modal-title">Please Type Your Password</h4>
                                                        </div>
                                                        {!! Form::open(array('url' => "admin_announcement_access/$data->_id/2",'class'=>'form-horizontal author_form','method'=>'POST','files'=>'true')) !!}
                                                        <div class="modal-body">
                                                            <h5 class="change-message" style="color: red;">To <b>Delete</b>This Announcement, Then Confirm Your Password  </h5>
                                                            {!! csrf_field() !!}
                                                            <input type="hidden" value="{{Auth::user()->_id}}" name="adminId">
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
    
    
    <script>
        $(document).ready(function() {
            
            FormWysihtml5.init();
            FormPlugins.init();
            FormMultipleUpload.init();
            TableManageResponsive.init();

        });
    </script>       
@endsection
