@extends('backend.layout.app')
	@section('content')	
	<style>
		.form_delete{display: inline;}
		.form-group{display: block !important;}
		.append_image{position: relative;}
		.close_image{position: absolute; top: 27px; right: 21px;}
		.data_load{display: inline;}
		.image_upload_loader{display: inherit;}
	</style>
	
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />

	<link rel="stylesheet" href="{{asset('public/backend/css/host_traveller.css')}}">

	<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.js"></script> -->
	
	
	<!-- begin #content -->
	<div id="content" class="content">
		
		<ol class="breadcrumb pull-right">
			<li><a href="javascript:;">Dashboard</a></li>
			<li class="active">Host accumulator</li>
		</ol>
		<h1 class="page-header"><small>Dashboard > Administration > </small> accumulator</h1>
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
                        <h4 class="panel-title">accumulator create</h4>
                    </div>
                    <div class="panel-body">
	                    <div class="row">
	                    	<div class="col-md-2"></div>
	                    	<div class="col-md-8">
	                    		{!! Form::open(array('route' => 'host-accumulator.store','class'=>'','method'=>'POST','files'=>'true')) !!}
		                          {!! csrf_field() !!}
		                            <input type="hidden" name="fk_user_id" value="{{Auth::user()->_id}}" >
		                            <div class="row">
		                                <div class="col-md-12">
		                                    <div class="">
			                                    <h4 style="display: inline">Publish status : </h4>
			                                    <div class="checkbox m-b-5 m-t-0" style="display: inline">
			                                        <input type="checkbox" id="switchery" name="status"data-render="switchery" data-theme="default"  checked >
			                                        <span class="text-muted m-l-5 m-r-20"></span>
			                                    </div>
			                                </div>
		                                </div>
		                            </div>
		                            <div class="row">
		                                <div class="col-md-12">
		                                    <div class="form-group">
		                                        <label for="name" class="cols-sm-2 control-label">Title</label>
		                                        <div class="cols-sm-10">
		                                            <div class="input-group">
		                                                <span class="input-group-addon"><i class="fa fa-header fa" aria-hidden="true"></i></span>
		                                                <input type="text" class="form-control" name="title" placeholder="Enter Title"/ required>
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
		                                                <textarea placeholder="Enter Description" name="description" class="form-control form-rounded" rows="3" required></textarea>
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
		                                                    <a class=" btn options-message" data-toggle="tooltip" data-placement="bottom"   data-original-title="Add photo">
		                                                      
		                                                        <span class="btn btn-info "><svg class="olymp-camera-icon" data-toggle="modal" data-target="#update-header-photo" style="padding-top: 8px;"><use xlink:href="public/frontend/icons/icons.svg#olymp-camera-icon"></use></svg> Add Photos</span>
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
		                                        <label for="name" class="cols-sm-2 control-label">Location </label>
		                                        <div class="cols-sm-10">
		                                            <div class="input-group">
		                                                <span class="input-group-addon"><i class="fa fa-building" aria-hidden="true"></i></span>
		                                                <select class="selectpicker" name="location" title="Pick your condiments" data-live-search="true" required>
	                                                      <option>- Choose place -</option>
	                                                      <option value="barguna">Barguna</option>
	                                                      <option value="barisal">Barisal</option>
	                                                      <option value="bagerhat">Bagerhat</option>
	                                                      <option value="bhola">Bhola</option>
	                                                      <option value="bandarban">Bandarban</option>
	                                                      <option value="brahmanbaria">Brahmanbaria</option>
	                                                      <option value="bogra">Bogra</option>
	                                                      <option value="chandpur">Chandpur</option>
	                                                      <option value="chittagong">Chittagong</option>
	                                                      <option value="comilla">Comilla</option>
	                                                      <option value="cox's bazar">Cox's azar</option>
	                                                      <option value="chuadanga">Chuadanga</option>
	                                                      <option value="chapai nawabganj">Chapai Nawabganj</option>
	                                                      <option value="dhaka">Dhaka</option>
	                                                      <option value="dinajpur">Dinajpur</option>
	                                                      <option value="dighapatia palace">Dighapatia palace</option>
	                                                      <option value="feni">Feni</option>
	                                                      <option value="faridpur">Faridpur</option>
	                                                      <option value="fakir lalon shah’s mazaar">Fakir lalon shah’s mazaar</option>
	                                                      <option value="gazipur">Gazipur</option>
	                                                      <option value="gopalganj">Gopalganj</option>
	                                                      <option value="gaibandha">Gaibandha</option>
	                                                      <option value="habiganj">Habiganj</option>
	                                                      <option value="jhalokati">Jhalokati</option>
	                                                      <option value="jessore">Jessore</option>
	                                                      <option value="jhenaidah">Jhenaidah</option>
	                                                      <option value="jamalpur">Jamalpur</option>
	                                                      <option value="joypurhat">Joypurhat</option>
	                                                      <option value="jaflong">Jaflong</option>
	                                                      <option value="kuakata">Kuakata</option>
	                                                      <option value="khagrachari">Khagrachari</option>
	                                                      <option value="khulna">Khulna</option>
	                                                      <option value="kushtia">Kushtia</option>
	                                                      <option value="kurigram">Kurigram</option>
	                                                      <option value="kishoreganj">Kishoreganj</option>
	                                                      <option value="kaptai island">Kaptai island</option>
	                                                      <option value="kantajew temple">Kantajew temple</option>
	                                                      <option value="lalmonirhat">Lalmonirhat</option>
	                                                      <option value="madaripur">Madaripur</option>
	                                                      <option value="manikganj">Manikganj</option>
	                                                      <option value="munshiganj">Munshiganj</option>
	                                                      <option value="magura">Magura</option>
	                                                      <option value="
	                                                      mainamati">Mainamati</option>
	                                                      <option value="meherpur">Meherpur</option>
	                                                      <option value="mymensingh">Mymensingh</option>
	                                                      <option value="moulvibazar">Moulvibazar</option>
	                                                      <option value="madhabkunda">Madhabkunda</option>
	                                                      <option value="mahasthangarh">Mahasthangarh</option>
	                                                      <option value="moheshkhali island">Moheshkhali island</option>
	                                                      <option value="noakhali">Noakhali</option>
	                                                      <option value="nijhum dwip">Nijhum dwip</option>
	                                                      <option value="narayanganj">Narayanganj</option>
	                                                      <option value="narsingdi">Narsingdi</option>
	                                                      <option value="narail">Narail</option>
	                                                      <option value="netrokona">Netrokona</option>
	                                                      <option value="naogaon">Naogaon</option>
	                                                      <option value="natore">Natore</option>
	                                                      <option value="nilphamari">Nilphamari</option>
	                                                      <option value="patuakhali">Patuakhali</option>
	                                                      <option value="pirojpur">Pirojpur</option>
	                                                      <option value="parki beach">Parki beach</option>
	                                                      <option value="pabna">Pabna</option>
	                                                      <option value="panchagarh">Panchagarh</option>
	                                                      <option value="paharpur buddha vihara">Paharpur buddha vihara</option>
	                                                      <option value="Rangamati">rangamati</option>
	                                                      <option value="rajbari">Rajbari</option>
	                                                      <option value="rajshahi">Rajshahi</option>
	                                                      <option value="rangpur">Rangpur</option>
	                                                      <option value="ratargul swamp lake">Ratargul swamp lake</option>
	                                                      <option value="sitakunda">Sitakunda</option>
	                                                      <option value="sonadia island">Sonadia island</option>
	                                                      <option value="sajek valley">Sajek valley</option>
	                                                      <option value="shariatpur">Shariatpur</option>
	                                                      <option value="sixty-dome-mosque">Sixty-Dome-Mosque</option>
	                                                      <option value="satkhira">Satkhira</option>
	                                                      <option value="sherpur">Sherpur</option>
	                                                      <option value="sirajganj">Sirajganj</option>
	                                                      <option value="sunamganj">Sunamganj</option>
	                                                      <option value="sylhet">Sylhet</option>
	                                                      <option value="sundarban">Sundarban</option>
	                                                      <option value="world war II cemetery">World war II Cemetery</option>
		                                                </select>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>

		                            <div class="row">
		                                <div class="col-md-12">
		                                    <div class="form-group">
		                                        <label for="name" class="cols-sm-2 control-label">Location Details</label>
		                                        <div class="cols-sm-10">
		                                            <div class="input-group">
		                                                <span class="input-group-addon"><i class="fa fa-map-marker fa" aria-hidden="true"></i></span>
		                                                <input id="pac-input-search" name="place_name" type="text" class="form-control"placeholder="Type details location"/ required>
		                                                <input name="lat" class="lat" type="hidden">  
		                                                 <input name="lon" class="lon" type="hidden"> 
		                                            </div>

		                                            <div id="map"></div>

		                                        </div>
		                                    </div>
		                                </div>
		                            </div>

		                            <div class="row">
		                            	<div class="col-md-12">
		                            		<div class="form-group">
		                                        <label for="" class="cols-sm-2 control-label">Property Facility (Optional)</label>
		                                        <div class="cols-md-10">
		                                            <div class="input-group">
		                                                <span class="input-group-addon"><i class="fa fa-building-o fa" aria-hidden="true"></i></span>
		                                                  <select class="selectpicker" multiple name="facility[]" title="Property Facility" data-live-search="true">
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
		                            
		                            <div class="row">
		                            	<div class="col-md-12">
		                            		<div class="form-group">
		                                        <label for="" class="cols-sm-2 control-label">No of room available </label>
		                                        <div class="cols-md-10">
		                                            <div class="input-group">
		                                                <span class="input-group-addon"><i class="fa fa-building-o fa" aria-hidden="true"></i></span>
		                                                  <select class="selectpicker" onchange="choose_room(this.value)" name="room_no" title="No of room">
		                                                    <option value="-1">- select -</option>
		                                                    <option value="1">1</option>
		                                                    <option value="2">2</option>
		                                                    <option value="3">3</option>
		                                                  </select>
		                                            </div>
		                                        </div>
		                                    </div>
		                            	</div>	
		                            </div>
		                            <div id="load-room-details"></div>
		                            
		                            <div class="row">
		                                <div class="col-md-12">
		                                    <div class="form-group">
		                                        <label for="name" class="cols-sm-2 control-label">Terms and condition</label>
		                                        <div class="cols-sm-10">
		                                            <div class="input-group">
		                                                <textarea placeholder="Enter terms and condition" name="terms_condition" class="form-control form-rounded" id="wysihtml5" rows="4" required></textarea>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		                            <div class="form-group ">
		                                <button type="submit" class="btn btn-success btn-block login-button">Confirm</button>
		                            </div>
		                            
		                            
		                        {!! Form::close(); !!}
	                    	</div>
	                    	<div class="col-md-2"></div>
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
<!-- <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script> -->
<script src="{{asset('public/frontend/js/bootstrap-select.min_2.js')}}"></script>



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

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCALSYjrJyQ3R9ONak9nVMaAkOuRetWv4&v=3.exp&libraries=places&callback=initMap"></script>



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

<script>
	function choose_room(value){
    	if(value==='-1'){
    		$("#load-room-details").hide();
    	}else{
    		$("#load-room-details").show();
    		$("#load-room-details").load("{{ URL::to('accumulator-room-details')}}"+'/'+value);
    	}
    }
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
	          	var _token = $('input[name="_token"]').val();
		        var image = e.target.result;
		        var value = 0;
		        $.ajax({
		            url: "{{ URL::to('accumulator-image-upload')}}"+'/'+value,
		            type: "POST",
		            data: { _token : _token,
		                image: image
		            },
		            success: function(response){
		                var imageLink = response;
		                $('.file_load').append('<div class="single_load_file" id="single_file_'+i+'"><img src="'+e.target.result+'" class="append_load_image" id="append_select_image"><button type="button" class="btn btn-danger btn-sm file_cancel_btn" id="'+i+'" isvalue="'+imageLink+'" ispath="images/host/photo/"><i class="fa fa-times" aria-hidden="true"></i></button><input type="hidden" name="accumulator_image[]" value="'+imageLink+'"></div>');
		                $(".image_upload_loader").css('display','none');
		            }
		        });
	            

	            
	          }

                
            }
            reader.readAsDataURL(input.files[0]);
        i++;
        }
        $('.load_chose_file').html('<label class="load_file_label" for="post_file"><div class="slide_upload"><img class="image_upload_loader" src="{{ URL::to("/public/loader-cycle.gif")}}" alt="" /></div></label>');
        /**/
        $(".load_chose_file").removeClass('remove_file');
         
    }

</script>
<script>
    $(document).on('click', '.file_cancel_btn', function(){
      	var id = $(this).attr('id');
      	var isvalue = $(this).attr('isvalue');
      	var _token = $('input[name="_token"]').val();
      	var path = $(this).attr('ispath');
        
        var value = 0;
        $.ajax({
            url: "{{ URL::to('accumulator-image-remove')}}"+'/'+value,
            type: "POST",
            data: { _token : _token,
                image: isvalue,
                path:path
            },
            success: function(response){
           		$("#single_file_"+id).remove();
			    var extFile = $(".file_load").html();
			    if(extFile==""){
			        $(".load_chose_file").addClass('remove_file');
			    }else{
			        $(".load_chose_file").removeClass('remove_file');
			    }     
            }
        });
      //alert(id);
      

  });
</script>	

 <script>
    $(document).ready(function() {
        // /App.init();
        FormSliderSwitcher.init();
        FormWysihtml5.init();
    });
</script> 		
@endsection
