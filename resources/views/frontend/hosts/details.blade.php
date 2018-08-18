@extends('frontend.layout.app')

@push('css-style')
<script src="{{asset('public/js/jssor.slider.min.js')}}" type="text/javascript"></script> 
    <link type="text/css" rel="stylesheet" href="{{asset('public/css/lightslider.min.css')}}" />
<link rel="stylesheet" href="{{asset('public/frontend/css/style.css')}}">

    <link rel="stylesheet" href="{{asset('public/frontend/css/pages/aside_right_chat.css')}}" />
<link rel="stylesheet" href="{{asset('public/frontend/css/host_traveller/style.css')}}">
<link rel="stylesheet" href="{{asset('public/frontend/css/host_traveller/elegant-fonts.css')}}">
<link rel="stylesheet" href="{{asset('public/frontend/css/host_traveller/zabuto_calendar.min.css')}}">

@endpush
@section('content')
@include('frontend._partials.nav')
<section class="connection_page" style="margin-top: 60px;">
     <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="jumbotron">
                    <!-- <a class="btn btn-primary btn-xs" style="width: 100%;margin-left: 18px;font-size: 17px;" href="{{URL::to("host_a_plan")}}" role="button">Host a Traveller Now</a> -->
                    <h4 style="text-align: center;">Search</h4>
                    @include('frontend.common.host_search')
                    
                    <!--end form-filter-->
                </div>
                <?php 
                    if(Session::has('searchDetail')){
                        $search = Session::get('searchDetail');
                        $location = $search['location'];
                        $checkIn = $search['check_in'];
                        $checkOut = $search['check_out'];
                        $adult = $search['adult'];
                        $children = $search['children'];
                        $room = $search['room'];
                        $min = $search['min'];
                        $max = $search['max'];
                    }else{
                        $location = '';
                        $checkIn = '';
                        $checkOut = '';
                        $adult = '1';
                        $children = '0';
                        $room = '1';
                        $min = 0;
                        $max = $maxprice; 
                    }

                 ?>
                <div class="reserved_section" id="reserved-section">
                    <h4 style="text-align: center;" class="your_reservation">Your Reservation</h4>
                        {!! Form::open(array('url' => 'booking-accumulator','class'=>'','method'=>'POST','files'=>'true')) !!}
                            {!! csrf_field() !!}
                        <div class="vk-make-a-room" id="append-reserve-room"></div>
                        <div id="demo-reserve">
                            <h5 class="center">You have no reservation</h5>
                        </div>
                        <input type="hidden" value="{{$host_details->_id}}" name="accumulator_id">
                        <input type="hidden" value="{{$checkIn}}" name="check_in">
                        <input type="hidden" value="{{$checkOut}}" name="check_out">
                        <!--end collapse-->
                        <div class="form-group center" id="confirm-reserve" style="display: none">
                            <button type="submit" class="btn btn-primary btn-rounded form-control">Confirm</button>
                        </div>
                        {!! Form::close(); !!}
                    
                </div>
            </div>
            <div class="col-md-6" style="background-color: #fff;">
                <div class="main-content">
                    @include('frontend.common.notificaion_popup')
                    <div class="quick-navigation" data-fixed-after-touch="">
                        
                    </div>
                    <div class="main-content">
                        <div class="title">
                            <div class="left">
                                <h2 style="display: inline">{{ $host_details->title }} </h2>
                               <!--  <h5 style="display: inline"><span><i class="fa fa-home"></i> Avaliable room {{ $host_details->room_no }}</span>
                                </h5> -->
                                <h5><a href="#"><i class="fa fa-map-marker"></i> {{ $host_details['place_name'] }}</a></h5>
                            </div>
                            <div class="right">
                               
                                
                            </div>
                        </div>
                        <!--end title-->

                        <section>
                          <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:960px;height:480px;overflow:hidden;visibility:hidden;background-color:#24262e;">
                            <!-- Loading Screen -->
                            <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                                <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="{{asset('public/img/spin.svg')}}" />
                            </div>
                            <div data-u="slides" style="cursor:default;position:relative;top:0px;left:240px;width:720px;height:480px;overflow:hidden;">
                              @foreach($host_details->accumulator_image as $accuImg)
                                <div data-p="150">
                                    <img data-u="image" src='{{asset("images/host/photo/$accuImg->image")}}' />
                                    <img data-u="thumb" src='{{asset("images/host/photo/thum/$accuImg->image")}}' />
                                </div>
                              @endforeach
                            </div>
                            <!-- Thumbnail Navigator -->
                            <div data-u="thumbnavigator" class="jssort101" style="position:absolute;left:0px;top:0px;width:240px;height:480px;background-color:#000;" data-autocenter="2" data-scale-left="0.75">
                                <div data-u="slides">
                                    <div data-u="prototype" class="p" style="width:99px;height:66px;">
                                        <div data-u="thumbnailtemplate" class="t"></div>
                                        <svg viewbox="0 0 16000 16000" class="cv">
                                            <circle class="a" cx="8000" cy="8000" r="3238.1"></circle>
                                            <line class="a" x1="6190.5" y1="8000" x2="9809.5" y2="8000"></line>
                                            <line class="a" x1="8000" y1="9809.5" x2="8000" y2="6190.5"></line>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <!-- Arrow Navigator -->
                            <div data-u="arrowleft" class="jssora093" style="width:50px;height:50px;top:0px;left:270px;" data-autocenter="2">
                                <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                    <circle class="c" cx="8000" cy="8000" r="5920"></circle>
                                    <polyline class="a" points="7777.8,6080 5857.8,8000 7777.8,9920 "></polyline>
                                    <line class="a" x1="10142.2" y1="8000" x2="5857.8" y2="8000"></line>
                                </svg>
                            </div>
                            <div data-u="arrowright" class="jssora093" style="width:50px;height:50px;top:0px;right:30px;" data-autocenter="2">
                                <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                    <circle class="c" cx="8000" cy="8000" r="5920"></circle>
                                    <polyline class="a" points="8222.2,6080 10142.2,8000 8222.2,9920 "></polyline>
                                    <line class="a" x1="5857.8" y1="8000" x2="10142.2" y2="8000"></line>
                                </svg>
                            </div>
                          </div>
                        </section>
                        <section>
                            <div class="accumulator_details">
                                <?php echo $host_details->description; ?>   
                            </div>
                        </section>  
                         
                        
                        <section class="availability">
                            <strong> <h4>Availability</h4></strong>
                            <div class="availability_check">
                                <div class="panel panel-default" style="border:outset;">
                                {!! Form::open(array('url' => 'accumulator-search','class'=>'','method'=>'POST','files'=>'true')) !!}
                                    {!! csrf_field() !!}
                                  <div class="panel-body">
                                    <input type="hidden" name="location" value="{{$location}}">
                                    <input type="hidden" name="adult" value="{{$adult}}">
                                    <input type="hidden" name="children" value="{{$children}}">
                                    <input type="hidden" name="room" value="{{$room}}">
                                    <input type="hidden" name="min" value="{{$min}}">
                                    <input type="hidden" name="max" value="{{$max}}">
                                    <div class="form-group-inline">
                                        <div class="form-group date" data-date-format="mm-dd-yyyy">
                                            <label for="form-filter-check-in">Check In</label>
                                            <input name="check_in" value="{{$checkIn}}" type="text" class="form-control checkIn1" placeholder="Check-In">
                                        </div>
                                        <!--end form-group-->
                                        <div class="form-group">
                                            <label for="form-filter-check-in">Check Out</label>
                                            <input name="check_out" type="text" class="form-control checkOut1" value="{{$checkOut}}" placeholder="Check-Out"> 
                                        </div>
                                        
                                        <!--end form-group-->
                                        <div class="form-group">
                                            <label for="form-filter-check-in"> &nbsp;</label>
                                            <button type="submit" class="btn btn-primary btn-rounded form-control">Change search</button>
                                            
                                        </div>
                                        <!--end form-group-->
                                    </div>
                                  </div>
                                  {!! Form::close(); !!}
                                </div>
                            </div>
                        </section> 
                        <section class="additional-information">
                            <strong> <h4>Room Facilities</h4></strong>
                            <div class="room_faciliti">
                            <ul>
                              @foreach($host_details->facility as $facility)
                              <li>{{$facility}}</li>
                              @endforeach
                            </ul>
                          </div>
                        </section>              
                        <section id="room-details">
                          <h4>Room details</h4>
                          <div class="row">
                            <?php $i = 0; ?>
                            @foreach($host_details->accumulator_room as $room)
                            <?php $i++; ?>
                            <div class="col-sm-12" style="border-bottom: 1px solid #ccc; padding-bottom: 10px;">
                              <h5 style="text-transform: capitalize; ">{{$room->room_type}}</h5>
                              <div class="col-sm-7 no_padding">
                                <div class="room_image_section">
                                  <div class="demo">
                                    <ul id="lightSlider" class="lightSlider<?php echo $i; ?>">
                                    @foreach($roomImages as $roomImg)
                                    @if($room->_id == $roomImg['fk_room_id'])
                                        <li data-thumb='{{asset("images/host/room/photo/thum/$roomImg->image")}}'>
                                            <img src='{{asset("images/host/room/photo/$roomImg->image")}}' class="img-responsive">
                                        </li>
                                    @endif
                                    @endforeach
                                    </ul>
                                </div>
                                
                                </div>
                              </div>
                              <div class="col-sm-5">
                                <div class="room_descriptoin">
                                  <p>{{$room->room_description}}</p>
                                  <p>
                                  <strong>
                                    Adult :
                                  </strong>
                                    {{$room->adult}}
                                  </p>

                                  <p>
                                  <strong>
                                    Children :
                                  </strong>
                                    {{$room->children}}
                                  </p>
                                  <p>
                                  <strong>
                                    Rent rate :
                                  </strong>
                                  <b>{{$room->rent_rate}}</b> {{ $room->currency}} for 1 night  &nbsp;
                                  <?php $checkReserved = 0; ?> 
                                  @foreach($roomCheck as $check)
                                   @if($check['id'] == $room->_id)
                                    @if($check['status'] == 1)
                                     <?php $checkReserved = 1; ?>

                                    @endif  
                                   @endif     
                                  @endforeach
                                  @if($checkReserved == 0)
                                  <a id="reserve-{{$room->_id}}" data="{{json_encode($room)}}" class="btn btn-success btn-xs" onclick="reserve(this.id, {{json_encode($room)}})">reserve</a><a id="reserved-{{$room->_id}}" class="btn btn-danger btn-xs" onclick="reserved_cancel(this.id)" style="display: none">reserved</a>
                                  @else
                                    <p><kbd>The room is not available for this date</kbd></p>
                                  @endif
                                 
                                  </p>
                                </div>
                              </div>
                              
                            </div>
                            @endforeach
                          </div>
                        </section>
                        <!-- <section id="map">
                            <strong><h4>Map</h4></strong>

                        </section> -->
                        <!--end row-->            
                        <section id="additional-information">
                            <h4>Terms & Conditions</h4>
                            <dl class="info">
                                <?php echo $host_details->terms_condition; ?>
                            </dl>
                            <!--end info-->
                        </section> 
                    </div>

                    <!--end main-content-->
                </div>     
            </div>
            <div class="col-md-3 right-section">
                @include('frontend.common.aside_right_chat')
            </div>
        </div>
     </div>
</section>
@push('js')
<script>
    function reserve(id,data){

        <?php if($checkIn == '' && $checkOut == ''){
        ?>
        $(".checkIn1").focus();
        <?php
        }else{ ?>
       //var data = JSON.parse(resultData);
       $("#reserve-"+data._id).hide();
       $("#reserved-"+data._id).show();
       $("#append-reserve-room").append('<div class="single_room" id="append_room'+data._id+'"><h4 class="capitalize">'+data.room_type+'<span> (per night - '+data.rent_rate+data.currency+')</span>'+'</h4><ul><li>Adult: '+data.adult+'</li><li>Children: '+data.children+'</li></ul><input type="hidden" name="room_id[]" id="booking_room" value="'+data._id+'"></div>');
       $("#confirm-reserve").show();
       $("#demo-reserve").hide(); 

   <?php } ?>
    }

    function reserved_cancel(dataId){
        var data = dataId.split('-');
        var id = data[1];
        //alert(id);
        $("#append_room"+id).remove();
        var check = $("#append-reserve-room").html();
        if(check === ''){
            $("#confirm-reserve").hide();   
            $("#demo-reserve").show();   
        }
        $("#reserve-"+id).show();
        $("#reserved-"+id).hide();

    }
</script>
<script src="{{asset('public/js/lightslider.js')}}"></script>
    
<script type="text/javascript">
        jssor_1_slider_init = function() {

            var jssor_1_SlideshowTransitions = [
              {$Duration:1200,$Zoom:1,$Easing:{$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2},
              {$Duration:1000,$Zoom:11,$SlideOut:true,$Easing:{$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,$Zoom:1,$Rotate:1,$During:{$Zoom:[0.2,0.8],$Rotate:[0.2,0.8]},$Easing:{$Zoom:$Jease$.$Swing,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$Swing},$Opacity:2,$Round:{$Rotate:0.5}},
              {$Duration:1000,$Zoom:11,$Rotate:1,$SlideOut:true,$Easing:{$Zoom:$Jease$.$InQuint,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuint},$Opacity:2,$Round:{$Rotate:0.8}},
              {$Duration:1200,x:0.5,$Cols:2,$Zoom:1,$Assembly:2049,$ChessMode:{$Column:15},$Easing:{$Left:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,x:4,$Cols:2,$Zoom:11,$SlideOut:true,$Assembly:2049,$ChessMode:{$Column:15},$Easing:{$Left:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,x:0.6,$Zoom:1,$Rotate:1,$During:{$Left:[0.2,0.8],$Zoom:[0.2,0.8],$Rotate:[0.2,0.8]},$Opacity:2,$Round:{$Rotate:0.5}},
              {$Duration:1000,x:-4,$Zoom:11,$Rotate:1,$SlideOut:true,$Easing:{$Left:$Jease$.$InQuint,$Zoom:$Jease$.$InQuart,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuint},$Opacity:2,$Round:{$Rotate:0.8}},
              {$Duration:1200,x:-0.6,$Zoom:1,$Rotate:1,$During:{$Left:[0.2,0.8],$Zoom:[0.2,0.8],$Rotate:[0.2,0.8]},$Opacity:2,$Round:{$Rotate:0.5}},
              {$Duration:1000,x:4,$Zoom:11,$Rotate:1,$SlideOut:true,$Easing:{$Left:$Jease$.$InQuint,$Zoom:$Jease$.$InQuart,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuint},$Opacity:2,$Round:{$Rotate:0.8}},
              {$Duration:1200,x:0.5,y:0.3,$Cols:2,$Zoom:1,$Rotate:1,$Assembly:2049,$ChessMode:{$Column:15},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad,$Rotate:$Jease$.$InCubic},$Opacity:2,$Round:{$Rotate:0.7}},
              {$Duration:1000,x:0.5,y:0.3,$Cols:2,$Zoom:1,$Rotate:1,$SlideOut:true,$Assembly:2049,$ChessMode:{$Column:15},$Easing:{$Left:$Jease$.$InExpo,$Top:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InExpo},$Opacity:2,$Round:{$Rotate:0.7}},
              {$Duration:1200,x:-4,y:2,$Rows:2,$Zoom:11,$Rotate:1,$Assembly:2049,$ChessMode:{$Row:28},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad,$Rotate:$Jease$.$InCubic},$Opacity:2,$Round:{$Rotate:0.7}},
              {$Duration:1200,x:1,y:2,$Cols:2,$Zoom:11,$Rotate:1,$Assembly:2049,$ChessMode:{$Column:19},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad,$Rotate:$Jease$.$InCubic},$Opacity:2,$Round:{$Rotate:0.8}}
            ];

            var jssor_1_options = {
              $AutoPlay: 1,
              $SlideshowOptions: {
                $Class: $JssorSlideshowRunner$,
                $Transitions: jssor_1_SlideshowTransitions,
                $TransitionsOrder: 1
              },
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $ThumbnailNavigatorOptions: {
                $Class: $JssorThumbnailNavigator$,
                $Rows: 2,
                $SpacingX: 14,
                $SpacingY: 12,
                $Orientation: 2,
                $Align: 156
              }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*#region responsive code begin*/

            var MAX_WIDTH = 960;

            function ScaleSlider() {
                var containerElement = jssor_1_slider.$Elmt.parentNode;
                var containerWidth = containerElement.clientWidth;

                if (containerWidth) {

                    var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

                    jssor_1_slider.$ScaleWidth(expectedWidth);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }
            ScaleSlider();
            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            /*#endregion responsive code end*/
        };
    </script>
    <script type="text/javascript">jssor_1_slider_init();</script>
<script>
  (function ($) {
    $(document).ready(function(){
      
        // hide .navbar first
        $(".navbar-xs").hide();

      });
    }(jQuery));

  $(".pull-right").click(function(){
    @php
        Session::forget('success');
        Session::forget('error');
    @endphp
    $('.top-right').hide();
    })
</script>
<script>
    $(function(){
        
        $(window).scroll(function(){
            if( $(window).scrollTop() > 525 ) {
                
                $('#reserved-section').css({position: 'fixed',top:'65px'});
                

            } else {
                
                $('#reserved-section').css({position: 'absolute', top:'unset'});
                
            }
        });
    });
</script>
<script type="text/javascript">
    <?php
    $i = 0;
    foreach ($host_details->accumulator_room as $room) {
      $i++;
    ?>
    $(document).ready(function() {
      setTimeout(function() {
        $(".lightSlider<?php echo $i; ?>").lightSlider({
            gallery: true,
            item: 1,
            loop: true,
            slideMargin: 0,
            thumbItem: 9
        });
      }, 500);
    });
    <?php
    }
   ?> 
</script>


@endpush
@endsection