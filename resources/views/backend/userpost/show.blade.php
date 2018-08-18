
@extends('backend.layout.app')
    @section('content') 
    <style type="text/css">
        .like_comment_count{display: none;}
        .like_comment_view hr{display: none;}
        /*.comment_add_section{display: none;}*/
    </style>
    
    <link rel="stylesheet" href="{{asset('public/css/like/like.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/profile/profile_timeline.css')}}">
    <!-- begin #content -->
    <div class="content">
        
        <ol class="breadcrumb pull-right">
            <li><a href="javascript:;">Dashboard</a></li>
            <li class="active">Admin Publish Announcement</li>
        </ol>
        <h1 class="page-header"><small>Dashboard > Administration > </small>User Post Page</h1>
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
                        <h4 class="panel-title">{{$getPost->users['fullname']}} Post</h4>
                    </div>
                    <input type="hidden" value="{{URL::to('/')}}" id="base_url">
                    <div class="panel-body">
                        <div class="single_post">
                            <div class="col-sm-3 no_padding">
                                @if($getPost->posted_by==1)
                                <div class="verification_reques">
                                    <h5>Requested for post verification</h5>
                                    <a href='{{URL::to("post-verification-request/$getPost->_id-1")}}' class="btn btn-success btn-sm">Confirm</a>
                                    <a href='{{URL::to("post-verification-request/$getPost->_id-0")}}' class="btn btn-danger btn-sm">Cancel</a>
                                </div>
                                @elseif($getPost->posted_by==2)
                                <div class="verified_section">
                                    <img width="100px;" src="{{asset('public/img/verified.png')}}" class="img-responsive" alt="">
                                </div>
                                @else
                                @endif 

                                <div class="profile-highlight">
                                    <h4><i class="fa fa-cog"></i> Post publish status</h4>
                                    <div class="checkbox m-b-5 m-t-0">
                                        <input type="checkbox" id="switchery" value="{{$getPost->status}}" data-render="switchery" data-theme="default" @if($getPost->status==1) checked @endif>
                                        <span class="text-muted m-l-5 m-r-20"></span>
                                    </div>
                                </div>
                                <input type="hidden" value="{{ $getPost['_id'] }}" id="uId">   
                            </div>
                            <div class="col-sm-6">
                                <div  class="panel panel-default" style="margin-bottom:5px">
                                    <div class="panel-body post_section_" >
                                        <div class="single_post_top">
                                            <div class="user_profile">
                                                <?php 
                                                    $profile_img = $getPost->users['profile_image'];
                                                 ?>
                                                <img  src='{{asset("images/users/profile/s160$profile_img")}}'>
                                            </div>
                                            <div class="user_info capitalize">
                                                <b>{{ $getPost->users['fullname'] }}</b>
                                                <div>
                                                    
                                                {{ $getPost->created_at }} 
                                                </div>
                                            </div>
                                            
                                        </div><!--  end top -->
                                        <div class="single_post_body post-body">
                                          <div class="post_description" id="post-content-text" >
                                            {{ $getPost->description }}
                                          </div>
                                          
                                            @foreach($getPost->post_image as $image)
                                            <?php $postImg = $image['images'] ?>
                                            <img src='{{asset("images/post/photo/thum/$postImg")}}' class="img-thumbnail" width="200" height="100">
                                            @endforeach
                                            
                                          
                                        </div><!-- end body -->
                                        <hr>
                                        <div class="single_post_bottom">
                                            <div class="like_comment_section">
                                                @include('backend.userpost.likeComment')
                                                <hr>
                                                <!-- post comment show section start -->
                                                <div class="show_post_comment">
                                                    @include('backend.userpost.comment')   
                                                </div>
                                                <!-- post comment show section end -->
                                                
                                              </div>  
                                          
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3"></div>
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
            if(status ==0){
              var sData = 1;
            }else{
              var sData = 0;
            }
            $.ajax({
                url: "{{URL::to('/')}}"+'/user-post-admin/'+uId,
                type: "put",
                data: {_token : _token,
                    status:sData,
                    receive:'ajax'
                    },
                success:function(result)
                {
                  console.log(result);

                }
            });
        })
    </script>
 
           
@endsection
