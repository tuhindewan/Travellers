
@extends('backend.layout.app')
    @section('content') 
    <style>
        .form_delete{display: inline;}
        .form-group{display: block !important;}
        .modal-body input{width: 100% !important;} 
        .form-group {width: 100%;overflow: hidden;}
        table { table-layout: fixed; }
        table th, table td { overflow: hidden; }
        .dataTables_info{display: none;}
        .custom_paginate{text-align: center;}
        .dataTables_paginate{display: none;}
    </style>


    <!-- begin #content -->
    <div id="content" class="content">
        
        <ol class="breadcrumb pull-right">
            <li><a href="javascript:;">Dashboard</a></li>
            <li class="active">Agency {{ $type }}</li>
        </ol>
        <h1 class="page-header"><small>Dashboard > Administration > </small>Agency {{ $type }} Page</h1>
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
                        <h4 class="panel-title">Agency {{ $type }}</h4>
                    </div>
                    <div class="panel-body">
                        
                        <!-- role view section -->
                        
                        <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th width="5%">SL.</th>
                                    <th width="45%">Description</th>
                                    <th width="10%">Location</th>
                                    <th width="10%">Status</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0; ?>
                                @foreach($getPost as $post)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $post->description }}</td>
                                    <td>{{ $post->places->place_name }}</td>
                                    <td>
                                        @if($post->status == 1)    
                                        Active
                                        @else
                                            Inactive
                                        @endif 
                                    </td>
                                    
                                </tr>
                                @endforeach 
                            </tbody>
                        </table>
                        
                        <div class="custom_paginate">
                            {{ $getPost->links() }}
                        </div>
                    </div>
                </div>
                <!-- end panel -->

            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end #content -->



   
    
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script>
        $(document).ready(function() {
           
            TableManageResponsive.init();

        });
    </script>       
@endsection
