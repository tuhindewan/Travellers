
@extends('backend.layout.app')
    @section('content')
    <script src="{{asset('public/js/jssor.slider.min.js')}}" type="text/javascript"></script> 
    <link type="text/css" rel="stylesheet" href="{{asset('public/css/lightslider.min.css')}}" /> 
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {width: 100px;height: 100px;
      }
      
      #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
      }

      #infowindow-content .title {
        font-weight: bold;
      }

      #infowindow-content {
        display: none;
      }

      #map #infowindow-content {
        display: inline;
      }

      .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      #pac-input-search {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
      }
      #target {
        width: 345px;
      }
      .gmnoprint a, .gmnoprint span {
        display:none;
    }
    .gmnoprint div {
         background:none !important;  
    }
    #GMapsID div div a div img{
        display:none;
    }
    .accumulator_details{width: 100%; overflow: hidden; margin-top: 15px;}
    .room_faciliti{margin-left: 30px;}
/* lightslider */
    .demo {
      width:100%;
    }
    .demo ul {
        list-style: none outside none;
        padding-left: 0;
        margin-bottom:0;
    }
    .demo ul li {
        display: block;
        float: left;
        margin-right: 6px;
        cursor:pointer;
    }
    .demo ul li img {
        display: block;
        height: auto;
        max-width: 100%;
    }

    /*jssor slider loading skin spin css*/
        .jssorl-009-spin img {
            animation-name: jssorl-009-spin;
            animation-duration: 1.6s;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }

        @keyframes jssorl-009-spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /*jssor slider arrow skin 093 css*/
        .jssora093 {display:block;position:absolute;cursor:pointer;}
        .jssora093 .c {fill:none;stroke:#fff;stroke-width:400;stroke-miterlimit:10;}
        .jssora093 .a {fill:none;stroke:#fff;stroke-width:400;stroke-miterlimit:10;}
        .jssora093:hover {opacity:.8;}
        .jssora093.jssora093dn {opacity:.6;}
        .jssora093.jssora093ds {opacity:.3;pointer-events:none;}

        /*jssor slider thumbnail skin 101 css*/
        .jssort101 .p {position: absolute;top:0;left:0;box-sizing:border-box;background:#000;}
        .jssort101 .p .cv {position:relative;top:0;left:0;width:100%;height:100%;border:2px solid #000;box-sizing:border-box;z-index:1;}
        .jssort101 .a {fill:none;stroke:#fff;stroke-width:400;stroke-miterlimit:10;visibility:hidden;}
        .jssort101 .p:hover .cv, .jssort101 .p.pdn .cv {border:none;border-color:transparent;}
        .jssort101 .p:hover{padding:2px;}
        .jssort101 .p:hover .cv {background-color:rgba(0,0,0,6);opacity:.35;}
        .jssort101 .p:hover.pdn{padding:0;}
        .jssort101 .p:hover.pdn .cv {border:2px solid #fff;background:none;opacity:.35;}
        .jssort101 .pav .cv {border-color:#fff;opacity:.35;}
        .jssort101 .pav .a, .jssort101 .p:hover .a {visibility:visible;}
        .jssort101 .t {position:absolute;top:0;left:0;width:100%;height:100%;border:none;opacity:.6;}
        .jssort101 .pav .t, .jssort101 .p:hover .t{opacity:1;}
    
    </style>
    <link rel="stylesheet" href="{{asset('public/backend/css/host_traveller.css')}}">
    <!-- begin #content -->
    <div class="content">
        
        <ol class="breadcrumb pull-right">
            <li><a href="javascript:;">Dashboard</a></li>
            <li class="active">Host accumulator</li>
        </ol>
        <h1 class="page-header"><small>Dashboard > Administration > </small>Host accumulator</h1>
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
                        <h4 class="panel-title"> Host accumulator</h4>
                    </div>
                    <input type="hidden" value="{{URL::to('/')}}" id="base_url">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="main-content">
                                    
                                    <div class="main-content">
                                        <div class="title">
                                            <div class="left">
                                                <h3 style="display: inline">{{ $accumulator->title }} </h3>
                                                <h5 style="display: inline"><span><i class="fa fa-home"></i> Avaliable room {{ $accumulator->room_no }}</span>
                                                </h5>
                                                <h5><a href="#"><i class="fa fa-map-marker"></i> {{ $accumulator['place_name'] }}</a></h5>
                                            </div>
                                            
                                        </div>
                                        <!--end title-->

                                        <!-- accumulator image slide -->

    
                                        <section>
                                          <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:960px;height:480px;overflow:hidden;visibility:hidden;background-color:#24262e;">
                                            <!-- Loading Screen -->
                                            <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                                                <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="{{asset('public/img/spin.svg')}}" />
                                            </div>
                                            <div data-u="slides" style="cursor:default;position:relative;top:0px;left:240px;width:720px;height:480px;overflow:hidden;">
                                              @foreach($accumulator->accumulator_image as $accuImg)
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
                                        
                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                <section id="description" class="accumulator_details">
                                                    
                                                  <p>{{ $accumulator->description }}</p>
                                                    
                                                </section>
                                                <section id="facilities">
                                                  <h4>Room Facilities</h4>
                                                  <div class="room_faciliti">
                                                    <ul>
                                                      @foreach($accumulator->facility as $facility)
                                                      <li>{{$facility}}</li>
                                                      @endforeach
                                                    </ul>
                                                  </div>
                                                </section>
                                                <section id="room-details">
                                                  <h4>Room details</h4>
                                                  <div class="row">
                                                    <?php $i = 0; ?>
                                                    @foreach($accumulator->accumulator_room as $room)
                                                    <?php $i++; ?>
                                                    <div class="col-sm-12" style="border-bottom: 1px solid #ccc; padding-bottom: 10px;">
                                                      <h5 style="text-transform: capitalize; ">{{$room->room_type}}</h5>
                                                      <div class="col-md-6 no_padding">
                                                        <div class="room_image_section">
                                                          <div class="demo">
                                                            <ul id="lightSlider" class="lightSlider<?php echo $i; ?>">
                                                            @foreach($roomImages as $roomImg)
                                                            @if($room->_id == $roomImg['fk_room_id'])
                                                                <li data-thumb='{{asset("images/host/room/photo/thum/$roomImg->image")}}'>
                                                                    <img src='{{asset("images/host/room/photo/$roomImg->image")}}' />
                                                                </li>
                                                            @endif
                                                            @endforeach
                                                            </ul>
                                                        </div>
                                                        
                                                        </div>
                                                      </div>
                                                      <div class="col-md-6">
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
                                                          {{$room->rent_rate}} {{ $room->currency}} for 1 night
                                                          </p>
                                                        </div>
                                                      </div>
                                                      
                                                    </div>
                                                    @endforeach
                                                  </div>
                                                </section>
                                                <section id="map-section">
                                                    <h4>Map</h4>
                                                    
                                                    <div id="map" style="width: 100% !important;height: 300px !important; margin-top: 10px !important;"></div>
                                                    
                                                    <!--end map-->
                                                </section>
                                            </div>
                                        </div>
                                        <!--end row-->
                                                            
                                        <section id="additional-information">
                                            <h4>Terms & Conditions</h4>
                                            <dl class="info">
                                                <?php echo $accumulator->terms_condition; ?>
                                            </dl>
                                            <!--end info-->
                                        </section>
                                    </div>
                                    <!--end main-content-->
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
    <script src="{{asset('public/js/lightslider.js')}}"></script>
    <script type="text/javascript">
      
      <?php
        $i = 0;
        foreach ($accumulator->accumulator_room as $room) {
          $i++;
          ?>

        $(".lightSlider<?php echo $i; ?>").lightSlider({
            gallery: true,
            item: 1,
            loop: true,
            slideMargin: 0,
            thumbItem: 9
        });
          <?php
        }
       ?>
      // $('.lightSlider1').lightSlider({
      //     gallery: true,
      //     item: 1,
      //     loop: true,
      //     slideMargin: 0,
      //     thumbItem: 9
      // });
    </script>
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

      function initMap() {
      // The location of Uluru
      //var uluru = {lat: -25.344, lng: 131.036};
      var center = {lat: <?php echo $accumulator['lat']; ?>, lng: <?php echo $accumulator['lon']; ?>};
      // The map, centered at Uluru
      var map = new google.maps.Map(
          document.getElementById('map'), {zoom: 10, center: center});
      // The marker, positioned at Uluru
      var marker = new google.maps.Marker({position: center, map: map});
    }
    </script>
    <script src="{{asset('public/js/mapmarkerclusterer.js')}}"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCALSYjrJyQ3R9ONak9nVMaAkOuRetWv4&v=3.exp&libraries=places&callback=initMap"></script>
 
           
@endsection
