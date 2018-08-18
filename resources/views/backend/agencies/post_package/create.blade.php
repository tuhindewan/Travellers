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

	<link rel="stylesheet" href="{{asset('public/backend/css/agencies.css')}}">
	<!-- begin #content -->
	<div id="content" class="content">
		
		<ol class="breadcrumb pull-right">
			<li><a href="javascript:;">Dashboard</a></li>
			<li class="active">agency</li>
		</ol>
		<h1 class="page-header"><small>Dashboard > </small>Agency {{ $type }}</h1>
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
                        <h4 class="panel-title">{{ $type }} create</h4>
                    </div>
                    <div class="panel-body">
	                    {!! Form::open(array('route' => 'agencies-post-package.store','class'=>'','method'=>'POST','files'=>'true')) !!}
	                    	{{ csrf_field() }}
              							@if($type == 'post')
              							<input type="hidden" value="1" name="post_type">
              							@else
              							<input type="hidden" value="2" name="post_type">
              							@endif
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
	                                    <label for="name" class="cols-sm-2 control-label">Location</label>
	                                    <div class="cols-sm-10">
	                                        <div class="input-group">
	                                            <span class="input-group-addon"><i class="fa fa-map-marker fa" aria-hidden="true"></i></span>
	                                            <input id="pac-input-search" name="place" type="text" class="form-control"placeholder="Type location" required>
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
                                        <label for="name" class="cols-sm-2 control-label">Description</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-asterisk fa" aria-hidden="true"></i></span>
                                                <textarea placeholder="Enter Description" name="description" class="form-control form-rounded" rows="6" required></textarea>
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
                                                    <a class=" btn btn-info options-message" data-toggle="tooltip" data-placement="bottom" data-original-title="Add photo"> Add Photos </a>
                                              </label>
                                          		<input type="file" id="post_file" multiple onchange="readURL(this,this.id)" style="display:none;">

                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4"></label>
								<div class="col-md-6 col-sm-6">
									<button type="submit" class="btn btn-success btn-trans waves-effect w-md waves-success">create {{ $type }} </button>
								</div>
							</div>
	                    {!! Form::close(); !!}
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
<script type="text/javascript">
  function readURL(input,image_load) {
        if (input.files && input.files[0]) {
    	var i=$('i').length;
            var reader = new FileReader();
            
            reader.onload = function (e) {
              var video = 'data:video';
              var string = e.target.result;
	          if(string.match(video)){
	            $('.file_load').append('<div class="single_load_file" id="single_file_'+i+'"><video src="'+e.target.result+'" class="append_load_image" id="append_select_image"></video><button class="btn btn-danger btn-sm file_cancel_btn" id="'+i+'"><i class="fa fa-times" aria-hidden="true"></i></button><input type="hidden" name="video[]" value="'+e.target.result+'"></div>');
	          }else{
	          	var _token = $('input[name="_token"]').val();
		        var image = e.target.result;
		        var value = 0;
		        $.ajax({
		            url: "{{ URL::to('agency-post-package-image-upload')}}",
		            type: "POST",
		            data: { _token : _token,
		                image: image
		            },
		            success: function(response){
		                var imageLink = response;
		                $('.file_load').append('<div class="single_load_file" id="single_file_'+i+'"><img src="'+e.target.result+'" class="append_load_image" id="append_select_image"><button type="button" class="btn btn-danger btn-sm file_cancel_btn" id="'+i+'" isvalue="'+imageLink+'" ispath="images/agency/post_package/photo/"><i class="fa fa-times" aria-hidden="true"></i></button><input type="hidden" name="images[]" value="'+imageLink+'"></div>');
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
            url: "{{ URL::to('agency-post-package-image-remove')}}",
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
