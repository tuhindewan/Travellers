
@extends('backend.layout.app')
  <link rel="stylesheet" href="{{asset('public/frontend/css/cover.css')}}">

    @section('content') 
    <style>
    .profile_img{height: auto !important;}
    .profile_img img{height: auto !important;}
    .tab-content{padding-left: 23%;}
    .info_section{padding-right: 12px; padding-left: 5px;}


    </style>
    <?php 
      if(Session::has('commonData')){
        $commonData = Session::get('commonData');
        $image = $commonData['image'];
        $role_name = $commonData['role_name'];
        $company_name = $commonData['web_settings']['company_name'];
        $company_logo = $commonData['web_settings']['logo'];
        $company_icon = $commonData['web_settings']['fav_icon'];
      }else{
        $image = "";
        $role_name ="";
        $company_name = "";
        $company_logo = "";
        $company_icon = "";
      }

     ?>
    <!-- begin #content -->
    <div id="content" class="content">
        
        <ol class="breadcrumb pull-right">
            <li><a href="javascript:;">Dashboard</a></li>
            <li class="active">user</li>
        </ol>
        <h1 class="page-header"><small>Dashboard > </small>User Profile Page</h1>
        <hr>
        <!-- start row -->
        <div class="row">
            <div class="role_view_section">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            
                        </div>
                        
                        <h4 class="panel-title">{{ $user_info['fullname'] }}</h4>
                    </div>
                    <div class="panel-body">
                        
                        <!-- Announcement view section -->
                        
                      <div class="row">

                        <div class="col-sm-2">
                          @if($role_name !== 'host a traveler' && $role_name !== 'agencies')
						              <div class="profile-highlight">
                            <h4><i class="fa fa-cog"></i> User status</h4>
                            <div class="checkbox m-b-5 m-t-0">
                                <input type="checkbox" id="switchery" value="{{$user_info->status}}" data-render="switchery" data-theme="default" @if($user_info->status==1) checked @endif>
                                <span class="text-muted m-l-5 m-r-20"></span>
                            </div>
                        </div>
                        <input type="hidden" value="{{ $user_info['_id'] }}" id="uId">
                        @elseif($role_name == 'host a traveler')
                        @if(count($userBookingStatus) > 0)
                        <div class="show_host_status">
                          <ul class="list-group">
                            <li class="list-group-item list-group-item-inverse text-center"> <strong>User status</strong> </li>
                            <li class="list-group-item"><span class="badge">{{ $userBookingStatus->user_request }}</span> Booking room</li>
                            <li class="list-group-item"><span class="badge">{{ $userBookingStatus->user_cancel }}</span> Booking cancel</li>
                            <li class="list-group-item"><span class="badge">{{ $userBookingStatus->host_reject }}</span> Reject booking</li>
                            <li class="list-group-item"><span class="badge">{{ $userBookingStatus->host_confirm }}</span> Booking confirm</li>
                            <li class="list-group-item"><span class="badge">{{ $userBookingStatus->user_not_come }}</span> Not came in</li>
                          </ul>
                        </div>
                        @endif
                        @endif
                        </div>
                        <div class="col-sm-10">
                          <div class="cover profile">
                            <div class="wrapper">
                              <div class="image" style="width: 100%;">
                                <div class="cover-image picture-container">
                                    <?php 
                                  $coverImage = $user_info['cover_image'];
                                  ?>
                                  @if(!empty($coverImage))
                                  <?php $coverPic = url('/images/users/cover/').$coverImage; ?>
                                    
                                  @else
                                  <?php $coverPic = url('/public/frontend/images/Cover/blank-cover-template-1.jpg'); ?>
                                  @endif
                                
                                  <img style="position: absolute;" id="blah" class="headerimage ui-corner-all" src="{{ $coverPic }}" >

                                </div>
                              </div>
                              
                            </div>
                            
                          </div>
                          <div class="user_info_profile">
                            <div class="col-sm-3">
                              <div class="user_profile_photo">

                                  <?php 
                                    $image = $user_info['profile_image'];
                                  ?>
                                  <div class="avatar">
                                    @if(!empty($image))
                                    <?php $profilePic = url('/images/users/profile/s160').$image; ?>
                                    @elseif(Auth::user()->gender=='Mr')
                                <?php $profilePic = url('/public/frontend/img/user.jpg'); ?>
                                @else
                                  <?php $profilePic = url('/public/frontend/images/Anonymous_female.jpg'); ?>
                                    @endif
                            
                                    <div class="profile_img">
                                      <img id="profile-picture" src="{{ $profilePic }}" alt="people">
                                    </div>
                                    
                                    
                                  </div>

                              </div>
                            </div>
                            <div class="col-sm-5">
                              <div class="user_profile_name">
                                <a>{{$user_info['fullname']}}</a>
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="basic_section">
                                 
                              </div>
                            </div>
                          </div> 
                          
                          <div class="info_section">
                            <div class="panel panel-default">
                              <div class="panel-heading"><i class="fa fa-user"></i> About</div>
                              <div class="panel-body">
                                <div class="row" style="padding: 0px 5%;">
                    
                                  <!-- tabs left -->
                                  <div class="tabbable tabs-left">
                                    
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist">
                                      <li role="presentation" class="active"><a href="#personal-information" aria-controls="personal-information" role="tab" data-toggle="tab">personal-information</a></li>
                                      <li role="presentation"><a href="#bio" aria-controls="bio" role="tab" data-toggle="tab">bio</a></li>
                                      <li role="presentation"><a href="#place" aria-controls="place" role="tab" data-toggle="tab">place</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                      <div role="tabpanel" class="tab-pane active" id="personal-information">
                                        <div class="personal_information_content">
                                          <div class="panel panel-default">
                                            <div class="panel-heading">
                                              <h3 class="panel-title">CONTACT INFORMATION</h3>
                                            </div>
                                            <div class="panel-body">
                                              
                                              <div class="panel-group unauthorize" id="accordion">
                                                
                                                <div class="panel panel-default panel-ediable">
                                                  <div class="panel-heading">
                                                    <h4 class="panel-title ">
                                                      <div class="row">
                                                        <div class="col-sm-4">
                                                          Phone
                                                        </div>
                                                        <div class="col-sm-8">
                                                          {{ $user_info->phone }}
                                                        </div>
                                                      </div>
                                                     
                                                    </h4>
                                                  </div>
                                                </div>
                                                <div class="panel panel-default panel-ediable">
                                                  <div class="panel-heading">
                                                    <h4 class="panel-title ">
                                                      <div class="row">
                                                        <div class="col-sm-4">
                                                          Address
                                                        </div>
                                                        <div class="col-sm-8">
                                                          {{ $user_info->address }}
                                                        </div>
                                                      </div>
                                                     
                                                    </h4>
                                                  </div>
                                                </div>
                                                <div class="panel panel-default panel-ediable">
                                                  <div class="panel-heading">
                                                    <h4 class="panel-title ">
                                                      <div class="row">
                                                        <div class="col-sm-4">
                                                          Email
                                                        </div>
                                                        <div class="col-sm-8">
                                                          {{ $user_info->email }}
                                                        </div>
                                                      </div>
                                                     
                                                    </h4>
                                                  </div>
                                                </div>
                                                
                                              </div>
                                              
                                            </div>
                                          </div>
                                          
                                          <!-- basic -->
                                          <div class="panel panel-default">
                                            <div class="panel-heading">
                                              <h3 class="panel-title">BASIC INFORMATION</h3>
                                            </div>
                                            <div class="panel-body">
                                              <div class="panel-group unauthorize" id="accordion">
                                                <div class="panel panel-default panel-ediable">
                                                  <div class="panel-heading">
                                                    <h4 class="panel-title ">
                                                      <div class="row">
                                                        <div class="col-sm-4">
                                                          Birth Date
                                                        </div>
                                                        <div class="col-sm-7">
                                                          {{ $user_info->month }} {{ $user_info->day }}
                                                        </div>
                                                        
                                                      </div>
                                                     
                                                    </h4>
                                                  </div>
                                                </div>
                                                <div class="panel panel-default panel-ediable">
                                                  <div class="panel-heading">
                                                    <h4 class="panel-title ">
                                                      <div class="row">
                                                        <div class="col-sm-4">
                                                          Birth Year
                                                        </div>
                                                        <div class="col-sm-8">
                                                          {{ $user_info->year }}
                                                        </div>
                                                      </div>
                                                     
                                                    </h4>
                                                  </div>
                                                </div>
                                                <div class="panel panel-default panel-ediable">
                                                  <div class="panel-heading">
                                                    <h4 class="panel-title ">
                                                      <div class="row">
                                                        <div class="col-sm-4">
                                                          Gender
                                                        </div>
                                                        <div class="col-sm-8">
                                                          {{ $user_info->gender }}
                                                        </div>
                                                      </div>
                                                     
                                                    </h4>
                                                  </div>
                                                </div>
                                                
                                              </div>
                                              
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div role="tabpanel" class="tab-pane" id="bio">
                                        <div class="personal_information_content">
      
                                          <div class="panel panel-default">
                                            <div class="panel-heading">
                                              <h3 class="panel-title">BIO INFORMATION</h3>
                                            </div>
                                            <div class="panel-body">
                                              
                                              <div  class="panel-group unauthorize" id="accordion">
                                                <div class="panel panel-default panel-ediable">
                                                  <div class="panel-heading">
                                                    <h4 class="panel-title ">
                                                      <div class="row">
                                                        <div class="col-sm-4">
                                                          Interest
                                                        </div>
                                                        <div class="col-sm-7">
                                                          @if(count($user_info->interests)>0)
                                                          @foreach(json_decode($user_info->interests) as $interest)
                                                          <span">{{ $interest->name }} ,</span>
                                                          @endforeach
                                                          @endif
                                                        </div>
                                                        
                                                      </div>
                                                     
                                                    </h4>
                                                  </div>
                                                </div>
                                                <div class="panel panel-default panel-ediable">
                                                  <div class="panel-heading">
                                                    <h4 class="panel-title ">
                                                      <div class="row">
                                                        <div class="col-sm-4">
                                                          Prefers
                                                        </div>
                                                        <div class="col-sm-8">
                                                          @if(count($user_info->prefers)>0)
                                                          @foreach(json_decode($user_info->prefers) as $perfer)
                                                          <span">{{ $perfer->name }} ,</span>
                                                          @endforeach
                                                          @endif
                                                           
                                                        </div>
                                                      </div>
                                                     
                                                    </h4>
                                                  </div>
                                                </div>
                                                <div class="panel panel-default panel-ediable">
                                                  <div class="panel-heading">
                                                    <h4 class="panel-title ">
                                                      <div class="row">
                                                        <div class="col-sm-4">
                                                          {{ $user_info->fullname }} is 
                                                        </div>
                                                        <div class="col-sm-8">
                                                          @if(count($user_info->intos)>0)
                                                          @foreach(json_decode($user_info->intos) as $into)
                                                          <span">{{ $into->name }} ,</span>
                                                          @endforeach
                                                          @endif
                                                           
                                                        </div>
                                                      </div>
                                                     
                                                    </h4>
                                                  </div>
                                                </div>
                                                <div class="panel panel-default panel-ediable">
                                                  <div class="panel-heading">
                                                    <h4 class="panel-title ">
                                                      <div class="row">
                                                        <div class="col-sm-4">
                                                          Inspiration
                                                        </div>
                                                        <div class="col-sm-8">
                                                          {{ $user_info->inspiration }}
                                                        </div>
                                                      </div>
                                                     
                                                    </h4>
                                                  </div>
                                                </div>
                                                
                                              </div>
                                              
                                            </div>
                                          </div>
                                          
                                        </div> 
                                      </div>
                                      <div role="tabpanel" class="tab-pane" id="place">
                                        <div class="personal_information_content">
      
                                          <div class="panel panel-default">
                                            <div class="panel-heading">
                                              <h3 class="panel-title">VISITED PLACES</h3>
                                            </div>
                                            <div class="panel-body">
                                              <div class="panel-group" id="accordion">
                                               
                                                <div class="panel panel-default">
                                                  @foreach($markers as $place)
                                                  <div class="panel-body">
                                                    <div class="row">
                                                      <div class="col-sm-2">
                                                        @foreach($getPosts as $image)
                                                        @if($image->fk_place_id== $place->id)
                                                        <div class="placeImage">
                                                          <?php $imageData = $image['post_image'][0]['images'];
                                                            //print_r($imageData);
                                                           ?>
                                                          <a><img src='{{asset("images/post/photo/thum/$imageData")}}' class="img-responsive"></a>
                                                        </div>
                                                        @endif
                                                        @endforeach
                                                      </div>
                                                      <div class="col-sm-10">
                                                        <div class="headline">
                                                          <h4>{{ $place->infoText }}</h4>
                                                        </div>
                                                        
                                                        <div>
                                                          @foreach($getPosts as $image)
                                                          
                                                          @if($image->fk_place_id== $place->id)
                                                          <div class="time">
                                                            
                                                            <a>{{ $image->created_at }}</a>
                                                          </div>
                                                          @endif
                                                          @endforeach
                                                        </div> 
                                                      </div>
                                                    </div>
                                                    
                                                    
                                                  </div>
                                                  @endforeach
                                                </div>
                                                
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                  <!-- /tabs -->
                                      
                              </div>
                              </div>
                            </div>
                          </div>

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
            if(status ==0){
              var sData = 1;
            }else{
              var sData = 0;
            }
            $.ajax({
                url: "{{URL::to('/')}}"+'/all_user/'+uId,
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
