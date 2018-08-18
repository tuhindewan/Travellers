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
            <li class="active">SEO</li>
        </ol>
        <h1 class="page-header"><small> Dashboard > SEO > </small>Social Network Reach</h1>
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
                        <h4 class="panel-title">Social Network Reach</h4>
                    </div>
                      
                    <div class="panel-body">
                  <ul class="list-group">
                                    <li class="list-group-item">
                                        Facebook Interactions
                                    </li>
                                    <li class="list-group-item">
                                        Twitter Mentions
                                    </li>
                                    <li class="list-group-item">
                                        Google+
                                    </li>
                                    <li class="list-group-item">
                                        Linkedin Shares
                                    </li>
                                    <li class="list-group-item">
                                        Pinterest Shares
                                    </li>
                                </ul>

                                </div>
                   
                    <!-- end panel-body-->
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
                    