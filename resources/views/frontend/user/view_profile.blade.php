@extends('frontend.layout.app')

@push('css-style')
    <link href="{{asset('public/css/map.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/frontend/css/images-grid.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/custom.css')}}">
    <!-- <link rel="stylesheet" href="{{asset('public/css/dialog.css')}}" /> -->
     <link href="{{asset('public/css/map.css')}}" rel="stylesheet"> <link rel="stylesheet" href="{{asset('public/frontend/css/new/errors.css')}}">
    
    
    <link rel="stylesheet" href="{{asset('public/frontend/css/pages/post_type_page.css')}}" />
    <link rel="stylesheet" href="{{asset('public/frontend/css/pages/post_page.css')}}" />
    <link rel="stylesheet" href="{{asset('public/frontend/css/pages/aside_right_chat.css')}}" />
    
    


    <link rel="stylesheet" type="text/css" href="{{asset('public/frontend/css/fullscreen.css')}}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{asset('public/frontend/css/settings.css')}}" media="screen" />
    <!-- Picker --> 
    <link rel="stylesheet" href="{{asset('public/frontend/css/jquery-ui.css')}}" />
    <link rel="stylesheet" href="{{asset('public/frontend/css/form-wizard-purple.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/switcher.css')}}">

    <link rel="stylesheet" href="{{asset('public/css/public.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/cover.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/profile/profile_timeline.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/profile/profile_about.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/profile/profile_friends.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/profile/profile_photos.css')}}">
    


    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.3/css/swiper.min.css" />
    <link href="{{asset('public/backend/plugins/jquery-jvectormap/jquery-jvectormap_2.css')}}" rel="stylesheet" />
    <link href="{{asset('public/backend/plugins/bootstrap-calendar/css/bootstrap_calendar_2.css')}}" rel="stylesheet" />
    <link href="{{asset('public/backend/plugins/gritter/css/jquery.gritter_2.css')}}" rel="stylesheet" />
    <link href="{{asset('public/backend/plugins/morris/morris_2.css')}}" rel="stylesheet" />

    <link href="{{asset('public/backend/css/style.min_2.css')}}" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.3/js/swiper.js"></script> 
@endpush
@section('content')
@include('frontend._partials.nav')

<style>
    .sticky{display: block; top: 0px; left: 41%;}
    .right-section{padding: 0px !important;border: 1px solid #fff;border-bottom: none;border-top: none;border-right: none;height: 582px;z-index: 10;position: fixed;right: 5px;top: 55px;width: 285px;}
    
    .announce-text-color{color: #808487; text-transform: none;}
    .chat-user-name{color: #808487 !important;}
    .pd-r-5{padding-right:5px;}
    .cover-image .overlay {
        bottom: 12px;
        right: 12px;
        border-radius: 5px;
        width: 100%;
        height: 100%;
    }
    .cover-image:hover .overlay {
    opacity: 1; }
    .cover-image .cover-add-icon {
    position: absolute;
    left: 1%;
    top: 3%;
    opacity: 0;
    transition: all .3s ease;
}
.cover-image:hover .cover-add-icon {
    opacity: 1; }
    .btn-update-cover{background: transparent;
    border: 1px solid #6f7174;
    color: #6f7174;}
    .btn-update-cover:hover{
        color: #6f7174;
    }
    .btn-update-cover:focus{
        color: #6f7174;
    }
    .update-btn-dropdown{
        width: 171px;
    background: #fff;
    opacity: 0.4;
    }
    input[type="file"] {
  display: none !important;
}

.btn-update-propic{background: transparent;
    border: 1px solid #fff;
    color: #fff;
    position: absolute;
    top: 76%;
    font-size: 9px;
    border-left: none;
    border-right: none;
    padding: 4px;
    margin-left: 2px;
    opacity: 0;}
    .btn-update-propic:hover{
        color: #fff;
    }
    .btn-update-propic:focus{
        color: #fff;
    }
    .avatar:hover .btn-update-propic{opacity: 1;}

.btn-save-cover{position: absolute;
    bottom: 20%;
    right: 6%;
    background: #ff5e3a;
    color: #fff;
    font-size: 10px;
    padding: 2px;
display: none;}

.btn-cancel-cover{
    position: absolute;
    bottom: 20%;
    right: 1%;
    background: #9a9fbf;
    color: #fff;
    font-size: 10px;
    padding: 2px;
    display: none;
}
.btn-position-cover{
    position: absolute;
    bottom: 20%;
    right: 13.7%;
    background: #3879d9;
    font-size: 10px;
    padding: 2px;
    display: none;
}
.btn-position-cover a {color: #fff;}
.btn-save-cover:hover, .btn-cancel-cover:hover{
    color: #fff;
}
.btn-save-cover:focus, .btn-cancel-cover:focus{
    color: #fff;
}
.profile-overlay{background: rgba(43, 45, 59, 0.8);}

        
</style>


<section class="profile_page">
     <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 profile-left-section">
                <div class="row pd-r-5">
                  <div class="col-md-12">
                    <div class="cover profile">
                      <div class="wrapper">
                        <div class="image">
                          <div class="cover-image picture-container" style="width: 788px;height: 300px;overflow: hidden; position: relative;">
                            <?php $coverimage = $getCover['coverimage'];?>
                            @if($coverimage)
                            <a href="">
                                <img style="position: absolute;" height="350px" width="788px;" id="blah" class="headerimage ui-corner-all" src='{{asset("images/users$coverimage")}}' alt="photo">
                            </a>
                            @else
                            <a href="">
                                <img style="position: absolute;" height="350px" width="788px;" id="blah" class="headerimage ui-corner-all" src='{{asset("public/frontend/images/Cover/blank-cover-template-1.jpg")}}' alt="photo">
                            </a>
                            @endif
                          </div>
                        </div>
                        <ul class="friends">
                          <li>
                            <a href="#">
                              <img src="../public/frontend/images/Friends/guy-6.jpg" alt="people" class="img-responsive">
                            </a>
                          </li>
                          <li>
                            <a href="#">
                              <img src="../public/frontend/images/Friends/woman-3.jpg" alt="people" class="img-responsive">
                            </a>
                          </li>
                          <li>
                            <a href="#">
                              <img src="../public/frontend/images/Friends/guy-2.jpg" alt="people" class="img-responsive">
                            </a>
                          </li>
                          <li>
                            <a href="#">
                              <img src="../public/frontend/images/Friends/guy-9.jpg" alt="people" class="img-responsive">
                            </a>
                          </li>
                          <li>
                            <a href="#">
                              <img src="../public/frontend/images/Friends/woman-9.jpg" alt="people" class="img-responsive">
                            </a>
                          </li>
                          <li>
                            <a href="#">
                              <img src="../public/frontend/images/Friends/guy-4.jpg" alt="people" class="img-responsive">
                            </a>
                          </li>
                          <li>
                            <a href="#">
                              <img src="../public/frontend/images/Friends/guy-1.jpg" alt="people" class="img-responsive">
                            </a>
                          </li>
                          <li>
                            <a href="#">
                              <img src="../public/frontend/images/Friends/woman-4.jpg" alt="people" class="img-responsive">
                            </a>
                          </li>
                          <li><a href="#" class="group"><i class="fa fa-group"></i></a></li>
                        </ul>
                      </div>
                      <div class="cover-info">
                        <?php 
                            $image = $user_info->user_image['image'];
                         ?>
                        <div class="avatar">
                          @if($image)
                          <a href="">
                            <img src='{{asset("images/users$image")}}' alt="people">
                          </a>
                          @else
                          <a href="">
                            <img src='../public/frontend/images/Anonymous_male.jpg' alt="people">
                          </a>
                          @endif
                          <button class="btn btn-update-propic" type="button"><i class="fa fa-camera-retro" aria-hidden="true"></i> Update Profile Picture</button>
                        </div>
                        <div class="name"><a href="#">{{$user_info['firstname']}} {{$user_info['middlename']}} {{$user_info['lastname']}}</a></div>
                        <ul class="cover-nav">
                          <li class="active"><a href="" ><i class="fa fa-fw fa-bars"></i> Timeline</a></li>
                          <li><a class="about" href="#"><i class="fa fa-fw fa-user"></i> About</a></li>
                          <li><a class="friends" href="#"><i class="fa fa-fw fa-users"></i> Friends</a></li>
                          <li><a class="photos" href="#"><i class="fa fa-fw fa-image"></i> Photos</a></li>
                          <li><a class="videos" href="#"><i class="fa fa-fw fa-image"></i> Videos</a></li>
                        </ul>
                      </div>

                    </div>
                  </div>
                </div>
            </div>
            <div class="col-md-2 right-section">
                @include('frontend.common.aside_right_chat')
            </div>
        </div>
     </div>
</section>
<div id="about_section"></div>
<div id="friends_section"></div>
<div id="photos_section"></div>
<div id="videos_section"></div>
<div class="home_container_top" id="map-timeline">
        @include('frontend.map.profile_map_select') 
            
        
        <div>
            <a href="#plans" role="tab" data-toggle="tab"><img class="timeline-plan-image" src="../public/frontend/img/plans.png" alt=""></a>
            <a class="timeline-semi-transparent-button active" href="#plans" role="tab" data-toggle="tab">Plans</a>
        </div>
        <div>
            <a href="#suggestions" role="tab" data-toggle="tab"><img class="timeline-suggestions-image" src="../public/frontend/img/suggestions.png" alt=""></a>
            <a class="timeline-suggestions-transparent-button" href="#suggestions" role="tab" data-toggle="tab">Suggestions</a>
        </div>
        <div>
            <a href="#experiences" role="tab" data-toggle="tab"><img class="timeline-experiences-image" src="../public/frontend/img/experiences.png" alt=""></a>
            <a class="timeline-experiences-transparent-button" href="#experiences" role="tab" data-toggle="tab">Experiences</a>
        </div>
        <div>
            <a href="#questions" role="tab" data-toggle="tab"><img class="timeline-questions-image" src="../public/frontend/img/questions.png" alt=""></a>
            <a class="timeline-questions-transparent-button" href="#questions" role="tab" data-toggle="tab">Questions</a>
        </div>

    
    <div class="col-md-6 sticky">
        <div class="row timeline-row-newsletter">
            <div class="col-md-8 newsletter-scroll">
                <div class="row newsletter-scroll-row">
                    <a href="" data-toggle="modal" data-target="#myModal"><textarea class="form-control timeline_set_box_panel show-dialog" id="" rows="3" placeholder="What's on your mind?"></textarea></a>

                    @include('frontend.common.post_section')
                </div>
                <div class="row news-scetion">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane" id="experiences">                
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <p>Experiences</p>
                                    </div>
                                </div>
                            </div> 
                            <div class="tab-pane active" id="plans"> 
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        
                                        <p>Plans</p> <p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p><p>Plans</p> 
                                    </div>              
                                </div>
                            </div>
                            <div class="tab-pane" id="suggestions"> 
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <p>Suggestions</p>  
                                    </div>              
                                </div>
                            </div>
                            <div class="tab-pane" id="questions"> 
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <p>Questions</p>  
                                    </div>              
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCALSYjrJyQ3R9ONak9nVMaAkOuRetWv4&v=3.exp&libraries=places&callback=initMap"></script>
    <script src="{{asset('public/js/map.js')}}"></script>

<script>
    function announcePopover() {       
           $("#pop-One").popover({
                  placement: 'left',
                  html: 'true',
                  trigger : 'click',
                  container: 'body',
                  title : '<span class="text-info" style=""><strong>Announcement</strong></span>'+
                          '<button type="button"  class="btn btn-default close"\
               onclick="$(&quot;#pop-One&quot;).popover(&quot;hide&quot;);">×</button>',
                  content : '<p class="popup" style="color:#323232;"> \Lorem Ipsum is simply dummy\ text of the printing and typesetting industry. Lorem Ipsum has been the industry standard\ dummy text ever since the 1500s,</p>'
            }).on('shown.bs.popover', function() {
              var popup = $(this);
              $(this).parent().find("div.popover .close").click(function() {
                popup.click();
              });
            });  
           //window.location.href=("home-activity");
    }
</script>

<script>
  (function ($) {
    $(document).ready(function(){
      
    // hide .navbar first
    $(".fadeout_navbar").hide();
    
    // fade in .navbar
    $(function () {
      $(window).scroll(function () {
              // set distance user needs to scroll before we fadeIn navbar
        if ($(this).scrollTop() > 238) {
          
          $('.fadeout_navbar').fadeIn();
        } else {
          $('.fadeout_navbar').fadeOut();
        }
      });

    
    });

  });
    }(jQuery));
</script>


<script>
    $(function(){
        
        $(window).scroll(function(){
            if( $(window).scrollTop() > 350 ) {
                $('#map').css({position: 'fixed', top: '15px' , width: '41.66666667%', height:'100%'});
                $('.sticky').css({display: 'block', top: '0px', left:'42%'});
                $('.timeline-plan-image').css({position:'fixed',top:'25%'});
                $('.timeline-semi-transparent-button').css({position:'fixed',top:'29%'});
                $('.timeline-suggestions-image').css({position:'fixed',top:'35%'});
                $('.timeline-suggestions-transparent-button').css({position:'fixed',top:'39%'});
                $('.timeline-experiences-image').css({position:'fixed',top:'45%'});
                $('.timeline-experiences-transparent-button').css({position:'fixed',top:'49%'});
                $('.timeline-questions-image').css({position:'fixed',top:'55%'});
                $('.timeline-questions-transparent-button').css({position:'fixed',top:'59%'});
                $('.news-scetion').css({width:'502px'});

            } else {
                $('#map').css({position: 'relative', width: '41.66666667%', top:'0'});
                $('.sticky').css({display: 'block', top: '0px', left:'41%'});
                $('.timeline-plan-image').css({position:'absolute',top:'17%'});
                $('.timeline-semi-transparent-button').css({position:'absolute',top:'21%'});
                $('.timeline-suggestions-image').css({position:'absolute',top:'27%'});
                $('.timeline-suggestions-transparent-button').css({position:'absolute',top:'31%'});
                $('.timeline-experiences-image').css({position:'absolute',top:'37%'});
                $('.timeline-experiences-transparent-button').css({position:'absolute',top:'41%'});
                $('.timeline-questions-image').css({position:'absolute',top:'47%'});
                $('.timeline-questions-transparent-button').css({position:'absolute',top:'51%'});
                $('.news-scetion').css({width:'502px'});
            }
        });
    });
</script>

<script>
    $(".about").click(function(){
        $('#about_section').load("{{ URL::to('user-about-section')}}");
        $('.home_container_top,friends_section,photos_section,videos_section').hide();
    });
</script>

<script>
    $(".friends").click(function(){
        $('#friends_section').load("{{ URL::to('user-friends-section')}}");
        $('.home_container_top, #about_section,photos_section,videos_section').hide();
    });
</script>

<script>
    $(".photos").click(function(){
        $('#photos_section').load("{{ URL::to('user-photos-section')}}");
        $('.home_container_top, #about_section, #friends_section,videos_section').hide();
    });
</script>
<script>
    $(".videos").click(function(){
        $('#videos_section').load("{{ URL::to('user-videos-section')}}");
        $('.home_container_top, #about_section, #friends_section,photos_section').hide();
    });
</script>

<script>
    function readURL(input) {
           if (input.files && input.files[0]) {
               var reader = new FileReader();

               reader.onload = function (e) {
                   $('#blah')
                       .attr('src', e.target.result)
                       .width(788)
                       .height(300);
               };

                   $(".btn-save-cover").show();
                   $(".btn-cancel-cover").show();
                   $(".btn-position-cover").show();


               reader.readAsDataURL(input.files[0]);
           }
       }
</script>

<!-- <script type="text/javascript">
    jQuery(function($) {
      $('input[type="file"]').change(function() {
        if ($(this).val()) {
            error = false;
        
          var filename = $(this).val();

                $(this).closest('.file-upload').find('.file-name').html(filename);

          if (error) {
            parent.addClass('error').prepend.after('<div class="alert alert-error">' + error + '</div>');
          }
        }
      });
    });
</script> -->

<!-- <script>
$(document).ready(function(){
    $("#upload-cover").click(function(){
        $(".btn-save-cover").show();
    });
});
</script> -->
<script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
  crossorigin="anonymous">  
</script>

<script type="text/javascript">
    $(document).ready(function () {
        var img = $('.picture-container img');
        var y1 = $('.picture-container').height();
            var y2 = img.height();
            var x1 = $('.picture-container').width();
            var x2 = img.width();
            var desktop_start_x=0;
            var desktop_start_y=0;
            var mobile_start_x= -200;
            var mobile_start_y= -200;
                    $('.save').click(function(event){

                            event.preventDefault();
                            var t = img.position().top,
                    l = img.position().left;
                           img.attr('data-top', t);
                            img.attr('data-left', l);
                            img.draggable({ disabled: true });
                })
                    $('.pos').click(function(event){
                        
                        event.preventDefault();
                          img.draggable({ 
                            disabled: false,
                            scroll: false,
                            axis: 'y, x',
                            cursor : 'move',
                             drag: function(event, ui) {
                                                 if(ui.position.top >= 0)
                                                  {
                                                      ui.position.top = 0;
                                                  }
                                                  if(ui.position.top <= y1 - y2)
                                                  {
                                                      ui.position.top = y1 - y2;
                                                  }
                                                  if (ui.position.left >= 0) {
                                                    ui.position.left = 0;
                                                  };
                                                   if(ui.position.left <= x1 - x2)
                                                  {
                                                      ui.position.left = x1 - x2;
                                                  }
                            }
                });
                });
            });

</script>
<script type="text/javascript">
    function submitForm() {
        document.getElementById("coverimageform").submit();
    }
</script>
@endpush
@endsection