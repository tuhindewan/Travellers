
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
            <li class="active">All User</li>
        </ol>
        <h1 class="page-header"><small>Dashboard > Administration > </small>User List Page</h1>
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
                        <h4 class="panel-title">All User</h4>
                    </div>
                        <div class="panel-body">
                            
                            <!-- role view section -->
                            
                            <table id="userView" class="table table-striped table-bordered nowrap" width="100%">
                                <thead>
                                    <tr>
                                        <th width="15%">Id.</th>
                                        <th width="10%">Fullname</th>
                                        <th width="10%">Username</th>
                                        <th width="15%">Email</th>
                                        <th width="10%">Account Created</th>
                                        <th width="5%">Status</th>
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
            $('#userView').DataTable( {
                processing: true,
                serverSide: true,
                ajax: '{!! URL::asset("user-view") !!}',
                columns: [
                    
                    { data: '_id'},
                    { data: 'fullname'},
                    { data: 'username'},
                    { data: 'email'},
                    { data: 'created_at'},
                    { data: 'status'},
                    { data: 'action'}
                ]
            });
        });
    </script>
    

    <script src="{{asset('public/backend/plugins/jquery/jquery-1.9.1.min_2.js')}}"></script>
        
        <script src="{{asset('public/backend/js/apps.min_2.js')}}"></script>
    
    
    <script>
        $(document).ready(function() {
            
            TableManageResponsive.init();

        });
    </script>       
@endsection
