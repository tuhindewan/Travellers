
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
        <h1 class="page-header"><small>Dashboard > </small>{{$title}}</h1>
        <hr>
        <!-- start row -->
        <div class="row">
            <div class="role_view_section">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="{{URL::to('verification-request-post')}}" class="btn btn-xs btn-info" >verification request post</a>
                            <a href="{{URL::to('verified-post')}}" class="btn btn-xs btn-primary" >verified post</a>
                            <a href="{{URL::to('active-post')}}" class="btn btn-xs btn-success" >active post</a>
                            <a href="{{URL::to('in-active-post')}}" class="btn btn-xs btn-danger" >Inactive post</a>
                            

                            
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <a href="{{URL::to('user-post-admin')}}" class="btn btn-xs btn-success" >All post</a>
                    </div>
                    <div class="panel-body">
                        <!-- role view section -->
                        <input type="hidden" value="{{$postget}}" id="post-get">
                        <table id="postView" class="table table-striped table-bordered nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th width="20%"> Post Id</th>
                                    <th width="10%">Publishing Date</th>
                                    <th width="10%">Post by</th>
                                    <th width="10%">Post type</th>
                                    <th width="35%">Post description</th>
                                    <th width="10%">Status</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
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

    

    <script src="{{asset('public/backend/plugins/jquery/jquery-1.9.1.min_2.js')}}"></script>
    <script type="text/javascript">
        
        $(function() {
            var postGet = $("#post-get").val();
            $('#postView').DataTable( {
                processing: true,
                serverSide: true,
                ajax: '{!! URL::asset("post-view") !!}'+'/'+postGet,
                columns: [
                    
                    { data: '_id'},
                    { data: 'created_at'},
                    { data: 'user'},
                    { data: 'post_type'},
                    { data: 'description'},
                    { data: 'status'},
                    { data: 'action'}
                ]
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            
            TableManageResponsive.init();

        });
    </script>       
@endsection
