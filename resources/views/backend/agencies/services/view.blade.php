
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
        .services_details{width: 100%; height: 100%;}
    </style>


    <!-- begin #content -->
    <div id="content" class="content">
        
        <ol class="breadcrumb pull-right">
            <li><a href="javascript:;">Dashboard</a></li>
            <li class="active">Agency services</li>
        </ol>
        <h1 class="page-header"><small>Dashboard > Administration > </small>Agency services Page</h1>
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
                        <h4 class="panel-title">Agency services</h4>
                    </div>
                    <div class="panel-body">
                        
                        <!-- role view section -->
                        
                        <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th width="8%">Position.</th>
                                    <th width="10%">Service name</th>
                                    <th width="42%">description</th>
                                    <th width="10%">Status</th>
                                    <th width="10%">Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach($getServices as $service)
                                <tr>
                                    <td>{{ $service->position }}</td>
                                    <td>{{ $service->service_name }}</td>
                                    <td>{{ substr($service->description, 0,90) }}...</td>
                                    <td>
                                        @if($service->status == 1)    
                                        Active
                                        @else
                                            Inactive
                                        @endif 
                                    </td>
                                    <td>
                                        @include('backend.agencies.services.view_modal')
                                        @include('backend.agencies.services.edit_modal')
                                        <!-- delete service section -->
                                        {!! Form::open(array('route'=> ['agency-services.destroy',$service->_id],'method'=>'DELETE','class'=>'form_delete')) !!}
                                            {{ Form::hidden('id',$service->_id)}}
                                            <button type="submit" onclick="return confirmDelete();" class="btn btn-sm btn-danger">
                                              <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </button>
                                        {!! Form::close() !!}
                                        <!-- delete service section end -->
                                    </td>
                                    
                                </tr>
                                @endforeach 
                            </tbody>
                        </table>
                        
                        <div class="custom_paginate">
                            {{ $getServices->links() }}
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
@endsection
