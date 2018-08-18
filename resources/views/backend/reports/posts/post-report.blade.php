
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
            <li class="active">All reported post</li>
        </ol>
        <h1 class="page-header"><small>Dashboard > Administration > </small>post List Page</h1>
        <hr>
        <!-- start row -->
        <div class="row">
            <div class="role_view_section">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                           <a href="{{URL::to('user-post-report-review')}}" class="btn btn-xs btn-info" >Review post</a>
                            <a href="{{URL::to('user-post-report-block')}}" class="btn btn-xs btn-primary" >Block post</a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <a href="{{URL::to('user-post-report')}}" class="btn btn-xs btn-success" >Report post's</a>
                    </div>
                        <div class="panel-body">
                            
                            <!-- role view section -->
                            <input type="hidden" value="{{$status}}" id="status">
                            <table id="userView" class="table table-striped table-bordered nowrap" width="100%">
                                <thead>
                                    <tr>
                                        <th width="20%">Id.</th>
                                        <th width="20%">Reported post</th>
                                        <th width="25%">Category</th>
                                        <th width="10%">Reported by</th>
                                        <th width="10%">Report Count</th>
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
            var status = $("#status").val();
            $('#userView').DataTable( {
                processing: true,
                serverSide: true,
                ajax: '{!! URL::asset("post-view-report") !!}'+'/'+status,
                columns: [
                    
                    { data: '_id'},
                    { data: 'description'},
                    { data: 'category'},
                    { data: 'reported_by'},
                    { data: 'report_count'},
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
