@extends('frontend.layout.app')

@push('css-style')
<link rel="stylesheet" href="{{asset('public/frontend/css/style.css')}}">

<link rel="stylesheet" href="{{asset('public/frontend/css/pages/aside_right_chat.css')}}" />
<link rel="stylesheet" href="{{asset('public/frontend/css/host_traveller/style.css')}}">
<link rel="stylesheet" href="{{asset('public/frontend/css/host_traveller/elegant-fonts.css')}}">
<link rel="stylesheet" href="{{asset('public/frontend/css/host_traveller/zabuto_calendar.min.css')}}">
<link rel="stylesheet" href="{{asset('public/frontend/css/host_traveller/owl.carousel.css')}}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>


<style>
   
        #playground-container {
            height: 500px;
            overflow: hidden !important;
            -webkit-overflow-scrolling: touch;
        }

        .main-login{
            background-color: #fff;
            /* shadows and rounded borders */
            -moz-border-radius: 2px;
            -webkit-border-radius: 2px;
            border-radius: 2px;
            -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);

        }
        #button {
            border: 1px solid #ccc;
            margin-top: 28px;
            padding: 6px 12px;
            color: #666;
            text-shadow: 0 1px #fff;
            cursor: pointer;
            -moz-border-radius: 3px 3px;
            -webkit-border-radius: 3px 3px;
            border-radius: 3px 3px;
            -moz-box-shadow: 0 1px #fff inset, 0 1px #ddd;
            -webkit-box-shadow: 0 1px #fff inset, 0 1px #ddd;
            box-shadow: 0 1px #fff inset, 0 1px #ddd;
            background: #f5f5f5;
            background: -moz-linear-gradient(top, #f5f5f5 0%, #eeeeee 100%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #f5f5f5), color-stop(100%, #eeeeee));
            background: -webkit-linear-gradient(top, #f5f5f5 0%, #eeeeee 100%);
            background: -o-linear-gradient(top, #f5f5f5 0%, #eeeeee 100%);
            background: -ms-linear-gradient(top, #f5f5f5 0%, #eeeeee 100%);
            background: linear-gradient(top, #f5f5f5 0%, #eeeeee 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f5f5f5', endColorstr='#eeeeee', GradientType=0);
        }
        .main{margin-left: 40px;}
        .main-center{
            margin-top: 30px;
            margin: 0 auto;
            width: 100%;
            padding: 10px 40px;
            background:#fff;
                color: #FFF;
            text-shadow: none;
            -webkit-box-shadow: 0px 3px 5px 0px rgba(0,0,0,0.31);
        -moz-box-shadow: 0px 3px 5px 0px rgba(0,0,0,0.31);
        box-shadow: 0px 3px 5px 0px rgba(0,0,0,0.31);

        }
        span.input-group-addon i {
            color: #009edf;
            font-size: 17px;
        }

        .login-button{
            margin-top: 5px;
        }

        .login-register{
            font-size: 11px;
            text-align: center;
        }

        .bootstrap-select{
            width: 225px;
        }

        .bootstrap-select.btn-group .dropdown-menu.inner{
            padding: 20px;
        }
        .input-group-btn-vertical {
          position: relative;
          white-space: nowrap;
          width: 1%;
          vertical-align: middle;
          display: table-cell;
        }
        .input-group-btn-vertical > .btn {
          display: block;
          float: none;
          width: 100%;
          max-width: 100%;
          padding: 8px;
          margin-left: -1px;
          position: relative;
          border-radius: 0;
        }
        .input-group-btn-vertical > .btn:first-child {
          border-top-right-radius: 4px;
        }
        .input-group-btn-vertical > .btn:last-child {
          margin-top: -2px;
          border-bottom-right-radius: 4px;
        }
        .input-group-btn-vertical i{
          position: absolute;
          top: 2px;
          left: 4px;
        }
        
        /* #datepicker{width:180px; margin: 0 20px 20px 20px;} */
        #datepicker > span:hover{cursor: pointer;}
    

    /*map search*/
    /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 98%;
        width: 41.6%; float: left;
        margin-top: -15px;
        margin-left: 5px;
      }
      /* Optional: Makes the sample page fill the window. */
      
      #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;.6
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


      #pac-input:focus {
        border-color: #4d90fe;
      }

      #title {
        color: #000;
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
        .map_search input::-webkit-input-placeholder {color: #000;}
        .map_search input::-moz-placeholder {color: #000;}
        .controls{margin-top: 5px;}

        .imagePreview {
            width: 100%;
            height: 100px;
            background-position: center center;
          background:url(http://cliquecities.com/assets/no-image-e3699ae23f866f6cbdf8ba2443ee5c4e.jpg);
          background-color:#fff;
            background-size: cover;
          background-repeat:no-repeat;
            display: inline-block;
        }
        .btn-primary-upload
        {
          display:block;
          border-radius:0px;
          margin-top:-5px;
          background-color:#009edf;

        }
        .imgUp
        {
          margin-bottom:15px;
          padding-left: 0px;
        }
        .del
        {
          position:absolute;
          top:0px;
          right:15px;
          width:30px;
          height:30px;
          text-align:center;
          line-height:30px;
          background-color:rgba(255,255,255,0.6);
          cursor:pointer;
        }
        .imgAdd
        {
          width:30px;
          height:30px;
          border-radius:50%;
          background-color:#009edf;
          color:#fff;
          box-shadow:0px 0px 2px 1px rgba(0,0,0,0.2);
          text-align:center;
          line-height:30px;
          margin-top:0px;
          cursor:pointer;
          font-size:15px;
        }
        .add_photo{
          color: #fff;
          background: #0c506d;
          border-color: #0c506d;
          padding-left: 1px;
          padding-right: 1px;
          padding-top: 0px;
          padding-bottom: 2px;
        }
        .image_add{
          height: 30px;
          width: 30px;
        }
        .add_file_button{
          width: 10%;
        }

         .options-message {
            color: #c2c5d9;
            fill: #c2c5d9;
            position: relative;
            display: inline-block;
            cursor: pointer;
            vertical-align: middle;
            padding: 0px;
        }

        .options-message svg {
            width: 22px;
            height: 22px;
        }
        .post_hr{
          margin: 2px 0px;
        }
       

</style>
@endpush
@section('content')
@include('frontend._partials.nav')
<section class="connection_page" style="margin-top: 60px;">
     <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="jumbotron">
                    <h2 style="text-align: center;margin-top: 5px;">Search</h2>
                    @include('frontend.common.host_search')
                    <!--end form-filter-->
                </div>
            </div>
            <div class="col-md-6 no_padding">
                <div class="row main">
                    <div class="main-login main-center">
                        {!! Form::open(array('route' => 'host_info.store','class'=>'','method'=>'POST','files'=>'true')) !!}
                          {!! csrf_field() !!}
                            <input type="hidden" name="fk_user_id" value="{{Auth::user()->_id}}" >
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Title</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-header fa" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control" name="title" placeholder="Enter Title"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Description</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-asterisk fa" aria-hidden="true"></i></span>
                                                <textarea placeholder="Enter Description" name="description" class="form-control form-rounded" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                            <div class="row">
                                              <div class="load_select_option">
                                                <div class="file_load" style="display: inline;"></div>
                                                <div class="load_chose_file"></div>
                                              </div>
                                            </div>
                                        <div class="post-bottom">
                                          <div class="row">
                                            <div class="add_file_button col-md-6">
                                              <label class="" for="post_file" style="margin-bottom: 0">
                                                    <a class=" btn options-message" data-toggle="tooltip" data-placement="top"   data-original-title="ADD PHOTOS">
                                                      
                                                        <span class="btn btn-info btn-lg"><svg class="olymp-camera-icon" data-toggle="modal" data-target="#update-header-photo" style="padding-top: 8px;"><use xlink:href="public/frontend/icons/icons.svg#olymp-camera-icon"></use></svg> Add Photos</span>
                                                    </a>
                                                  </label>
                                              <input type="file" id="post_file" multiple onchange="readURL(this,this.id)" style="display:none;">

                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Destination</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-map-marker fa" aria-hidden="true"></i></span>
                                                <input id="pac-input-search" type="text" class="form-control" name="destination" placeholder="Enter Your Destination"/>
                                                <input name="lat" class="lat" type="hidden">  
                                                 <input name="lon" class="lon" type="hidden"> 
                                            </div>

                                            <div id="map"></div>

                                            <!-- {{-- <div id="map" class="">  
                                                 <input id="pac-input" class="controls" placeholder="insert the location" ame="location" type="text">  
                                                 <div id="map-canvas"> </div>  
                                                 <input name="lat" class="lat" type="hidden">  
                                                 <input name="lon" class="lon" type="hidden">  
                                            </div> --}} -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="cols-sm-2 control-label">Check In</label>
                                        <div class="cols-md-10">
                                            <div id="datepicker" class="input-group date" data-date-format="mm-dd-yyyy">
                                                <span class="input-group-addon"><i class="fa fa-calendar-check-o fa" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control" name="start_date_time"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="cols-sm-2 control-label">Check Out</label>
                                        <div class="cols-md-10">
                                            <div id="datepicker1" class="input-group date" data-date-format="mm-dd-yyyy">
                                                <span class="input-group-addon"><i class="fa fa-calendar-check-o fa" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control" name="end_date_time"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="cols-sm-2 control-label">Person (Adult)</label>
                                        <div class="cols-md-10">
                                            <div class="input-group spinner-male">
                                                <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control" value="1" name="adult" id="email"/>
                                                <div class="input-group-btn-vertical">
                                                  <button class="btn btn-default" style="min-height: 20px;" type="button"><i class="fa fa-caret-up"></i></button>
                                                  <button class="btn btn-default" style="min-height: 20px;" type="button"><i class="fa fa-caret-down"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="cols-sm-2 control-label">Children</label>
                                        <div class="cols-md-10">
                                            <div class="input-group spinner-child">
                                                <span class="input-group-addon"><i class="fa fa-child fa" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control" value="1" name="children" id="email"/>
                                                <div class="input-group-btn-vertical">
                                                  <button class="btn btn-default" style="min-height: 20px;" type="button"><i class="fa fa-caret-up"></i></button>
                                                  <button class="btn btn-default" style="min-height: 20px;" type="button"><i class="fa fa-caret-down"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Rent Rate (BDT)</label>
                                        <div class="cols-sm-10">
                                            <!-- <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-credit-card fa" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control" name="rent" id="name"  placeholder="Enter your rent rate"/>
                                            </div> -->
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-credit-card fa" aria-hidden="true"></i></span>
                                                  <select class="selectpicker" name="rent" title="Pick your condiments" data-live-search="true">
                                                      <option>1000 - 1999</option>
                                                      <option>2000 - 2999</option>
                                                      <option>3000 - 3999</option>
                                                      <option>4000+</option>
                                                  </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="cols-sm-2 control-label">Property Type (Optional)</label>
                                        <div class="cols-md-10">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-building-o fa" aria-hidden="true"></i></span>
                                                  <select class="selectpicker" multiple name="p_type[]" title="Pick your condiments" data-live-search="true">
                                                      <option>Apartment</option>
                                                      <option>Hotel</option>
                                                      <option>Boat</option>
                                                      <option>Villa</option>
                                                      <option>Ski Center</option>
                                                      <option>Cottage</option>
                                                      <option>Hostel</option>
                                                      <option>Motel</option>
                                                  </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="cols-sm-2 control-label">Property Facility (Optional)</label>
                                        <div class="cols-md-10">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-building-o fa" aria-hidden="true"></i></span>
                                                  <select class="selectpicker" multiple name="p_facility[]" title="Pick your condiments" data-live-search="true">
                                                    <option>Wi-Fi</option>
                                                    <option>Free Parking</option>
                                                    <option>Airport Shuttle</option>
                                                    <option>Family Room</option>
                                                  </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <button type="submit" class="btn btn-primary btn-lg btn-block login-button">Confirm</button>
                            </div>
                            
                            
                        {!! Form::close(); !!}

                    </div>
                </div>
            </div>
            <div class="col-md-3 right-section">
                @include('frontend.common.aside_right_chat')
            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
     </div>
</section>


@push('js')


<script>
    function initMap() {
        var bounds = new google.maps.LatLngBounds();
        
        var map = new google.maps.Map(document.getElementById('map'), {
         
        });

        var input = document.getElementById('pac-input-search');

        map.setTilt(45);
        //map.setOptions({ minZoom: 2});   
    
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });
        
    
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }
          markers = [];  
            var bounds = new google.maps.LatLngBounds();  
            for (var i = 0, place; place = places[i]; i++) {  
              var image = {  
                url: place.icon,  
                size: new google.maps.Size(75, 75),  
                origin: new google.maps.Point(0, 0),  
                anchor: new google.maps.Point(17, 34),  
                scaledSize: new google.maps.Size(25, 25)  
              };  
          
              // Create a marker for each place.  
              var marker = new google.maps.Marker({  
                map: map,  
                icon: image,  
                title: place.name,  
                position: place.geometry.location  
              });  
              $('.lat').val(marker.position.lat());  
              $('.lon').val(marker.position.lng());  
              /*alert('Lat :' + marker.position.lat() + ' Lon :' + marker.position.lng()); */ 
              markers.push(marker);  
              bounds.extend(place.geometry.location);  
            }
          

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          
          map.fitBounds(bounds);

        });
        var infoWin = new google.maps.InfoWindow();
      
        }
        
    </script>

<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCALSYjrJyQ3R9ONak9nVMaAkOuRetWv4&v=3.exp&libraries=places&callback=initMap"></script> -->


<script>
  (function ($) {
    $(document).ready(function(){
      
    // hide .navbar first
    $(".navbar-xs").hide();
    
    

  });
    }(jQuery));
</script>

<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

<script type="text/javascript">
    (function ($) {
      $('.spinner-child .btn:first-of-type').on('click', function() {
        $('.spinner-child input').val( parseInt($('.spinner-child input').val(), 10) + 1);
      });
      $('.spinner-child .btn:last-of-type').on('click', function() {
        $('.spinner-child input').val( parseInt($('.spinner-child input').val(), 10) - 1);
      });
    })(jQuery);
</script>

<script type="text/javascript">
    (function ($) {
      $('.spinner-male .btn:first-of-type').on('click', function() {
        $('.spinner-male input').val( parseInt($('.spinner-male input').val(), 10) + 1);
      });
      $('.spinner-male .btn:last-of-type').on('click', function() {
        $('.spinner-male input').val( parseInt($('.spinner-male input').val(), 10) - 1);
      });
    })(jQuery);
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

<script type="text/javascript">
    $(function () {
      $("#datepicker").datepicker({ 
            autoclose: true, 
            todayHighlight: true
      }).datepicker('update', new Date());
    });

</script>

<script type="text/javascript">
    $(function () {
      $("#datepicker1").datepicker({ 
            autoclose: true, 
            todayHighlight: true
      }).datepicker('update', new Date());
    });

</script>




<script type="text/javascript">
  function readURL(input,image_load) {
        if (input.files && input.files[0]) {
    var i=$('i').length;
            var reader = new FileReader();
            
            reader.onload = function (e) {
              var video = 'data:video';
              var string = e.target.result;
          if(string.match(video)){
            $('.file_load').append('<div class="single_load_file" id="single_file_'+i+'"><video src="'+e.target.result+'" class="append_load_image" id="append_select_image">এই পাকনামি টা</video><button class="btn btn-danger btn-sm file_cancel_btn" id="'+i+'"><i class="fa fa-times" aria-hidden="true"></i></button><input type="hidden" name="video[]" value="'+e.target.result+'"></div>');
          }else{
            $('.file_load').append('<div class="single_load_file" id="single_file_'+i+'"><img src="'+e.target.result+'" class="append_load_image" id="append_select_image"><button class="btn btn-danger btn-sm file_cancel_btn" id="'+i+'"><i class="fa fa-times" aria-hidden="true"></i></button><input type="hidden" name="image[]" value="'+e.target.result+'"></div>');
          }

                
            }
            reader.readAsDataURL(input.files[0]);
        i++;
        }
        $('.load_chose_file').html('<label class="load_file_label" for="post_file"><div class="slide_upload"></div></label>');
        /**/
        $(".load_chose_file").removeClass('remove_file');
         
    }

      
</script>
<script>
    $(document).on('click', '.file_cancel_btn', function(){
      var id = $(this).attr('id');
      //alert(id);
      $("#single_file_"+id).remove();
      var extFile = $(".file_load").html();
      if(extFile==""){
        $(".load_chose_file").addClass('remove_file');
      }else{
        $(".load_chose_file").removeClass('remove_file');
      }

  });
</script>


@endpush
@endsection

