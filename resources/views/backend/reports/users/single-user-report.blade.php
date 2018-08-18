
@extends('backend.layout.app')
    @section('content') 
    <style>
        .form_delete{display: inline;}
        .form-group{display: block !important;}
        .profile-image { height: auto; padding: 14px 0; }
        .profile-image img{width: 160px; height: auto; margin: 0 auto;}
    </style>
    <!-- begin #content -->
    <div id="content" class="content">
        
        <ol class="breadcrumb pull-right">
            <li><a href="javascript:;">Dashboard</a></li>
            <li class="active">User Admin</li>
        </ol>
        <h1 class="page-header"><small>Dashboard > Administration > </small>{{$getReports[0]->report_users['fullname']}} Report Page</h1>
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
                        <h4 class="panel-title" style="text-transform: capitalize;">{{$getReports[0]->report_users['fullname']}}</h4>
                    </div>

                    <div class="panel-body">
                        
                        <div class="view_admin_profile_section">
                            <div class="profile-section">
                                <!-- begin profile-left -->
                                <div class="profile-left">
                                    <?php $image = $getReports[0]->report_users['profile_image']; ?>
                                    <!-- begin profile-image -->
                                    <div class="profile-image">
                                        <img src='{{asset("images/users/profile/s160/$image")}}' />
                                        <i class="fa fa-user hide"></i>
                                    </div>
                                    <!-- end profile-image -->
                                    <div class="m-b-10">

                                        <?php $userId =  $getReports[0]->report_users['_id']?>
                                        <input type="hidden" value="{{ $userId }}" id="uId">
                                        <a href='{{URL::to("/all_user/$userId")}}' class="btn btn-warning btn-block btn-sm" target="_blank">View Profile</a>
                                    </div>

                                    <div class="profile-highlight">
                                        <h4><i class="fa fa-cog"></i> Review status</h4>
                                        <div class="checkbox m-b-5 m-t-0">
                                            <input type="checkbox" id="switchery" value="{{$getReports[0]->status}}" data-render="switchery" data-theme="default" @if($getReports[0]->status==1) checked @endif>
                                            <span class="text-muted m-l-5 m-r-20"></span>
                                        </div>
                                    </div>
                                    
                                </div>
                                <!-- end profile-left -->
                                <!-- begin profile-right -->
                                <div class="profile-right">
                                    <!-- begin profile-info -->
                                    <div class="profile-info">
                                        <!-- begin table -->
                                        <div class="table-responsive">
                                            @foreach($getReports as $report)
                                            <table class="table table-profile">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>
                                                            <h4 style="text-transform: capitalize;">{{$report->users['fullname']}}</h4>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="highlight">
                                                        <td class="field">Issue :</td>
                                                        <td>{{$report->category}}</td>
                                                    </tr>
                                                    <tr class="divider">
                                                        <td colspan="2"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="field">Details :</td>
                                                        <td> {{$report->description}}</td>
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
                                            @endforeach
                                        </div>
                                        <!-- end table -->
                                    </div>
                                    <!-- end profile-info -->
                                </div>
                                <!-- end profile-right -->
                            </div>    
                        </div>      
                        
                        
                    </div>
                </div>
                <!-- end panel -->
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end #content -->

    <script src="{{asset('public/backend/plugins/jquery/jquery-1.9.1.min_2.js')}}"></script>
    <script>
        $(document).ready(function() {
            // /App.init();
            FormSliderSwitcher.init();
        });
    </script> 

    <script>

        $("#switchery").on("change", function(){
            var _token = $('input[name="_token"]').val();
            var uId = $('#uId').val();
            var status = $("#switchery").val();
            $.ajax({
                url: "{{URL::to('/')}}"+'/confirm-review/'+uId,
                type: "post",
                data: {_token : _token,
                    status:status,
                    type:'user'
                    },
                success:function(result)
                {
                    //console.log(result);

                }
            });
        })
    </script>      
@endsection
