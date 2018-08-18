@extends('backend.layout.app')
	@section('content')	
	
	<style>
		
    .slide_upload {bottom: 6px;}
    label{text-align: right;}
    hr{margin: 5px; margin-bottom: 15px;}
    .append-form{margin: 5px;}
    
	</style>
	

	<link rel="stylesheet" href="{{asset('public/backend/css/agencies.css')}}">
	<!-- begin #content -->
	<div id="content" class="content">
		
		
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
                <h4 class="panel-title"> About infomation</h4>
            </div>
            <div class="panel-body">
              {!! Form::open(array('route' => 'agencies-about.store','class'=>'','method'=>'POST','files'=>'true')) !!}
              	{{ csrf_field() }}
			          <p class="text-center"><kbd>All * required.</kbd></p>
                <h4 class="col-sm-offset-3 col-sm-9" style="margin-top: 0; margin-bottom: 0;">General info</h4>
                <hr class="col-sm-offset-2 col-sm-9"> 
                <div class="form-group col-sm-12" >
                    <label class="control-label col-sm-3">Agency name* : </label>
                    <div class="col-sm-9">
                      <input type="text" value="{{ $getAbout['agency_name'] }}" placeholder="Type your agency name..." class="form-control" name="agency_name" required="required">  
                          
                    </div>
                </div>
                <div class="form-group col-sm-12" >
                    <label class="control-label col-sm-3">Founding date* : </label>
                    <div class="col-sm-2">
                      <input type="date" placeholder="Type your founding date" class="form-control" name="founding_date" value="{{ $getAbout['founding_date'] }}" required="required">  
                          
                    </div>
                </div>
                
                <div class="form-group col-sm-12" >
                    <label class="control-label col-sm-3">Agency location* : </label>
                    <div class="col-sm-9">
                      <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-map-marker fa" aria-hidden="true"></i></span>
                          @if(count($getAbout) > 0)
                          <input id="pac-input-search" value="{{ $getAbout->places['place_name'] }}" name="place" type="text" class="form-control"placeholder="Type your location" required>
                          <input name="lat" value="{{ $getAbout->places['lat'] }}" class="lat" type="hidden">  
                           <input name="lon" value="{{ $getAbout->places['lon'] }}" class="lon" type="hidden">
                          @else
                          <input id="pac-input-search" value="" name="place" type="text" class="form-control"placeholder="Type your location" required>
                          <input name="lat" class="lat" type="hidden">  
                           <input name="lon" class="lon" type="hidden">
                          @endif 
                      </div>

                      <div id="map"></div>  
                          
                    </div>
                </div>

                <div class="form-group col-sm-12" >
                    <label class="control-label col-sm-3">License key : </label>
                    <div class="col-sm-9">
                      <input type="text" placeholder="Type your license key" class="form-control" value="{{ $getAbout['license_key'] }}" name="license_key">  
                          
                    </div>
                </div>
                <div class="form-group col-sm-12" >
                    <label class="control-label col-sm-3">Description : </label>
                    <div class="col-sm-9">
                      <textarea rows="6" placeholder="Type your details..." class="form-control" name="description" >{{ $getAbout['description'] }}</textarea>
                          
                    </div>
                </div>
                <div class="form-group col-sm-12" >
                    <label class="control-label col-sm-3">Mission : </label>
                    <div class="col-sm-9">
                      <textarea rows="6" placeholder="Type your mission..." class="form-control" name="mission">{{ $getAbout['mission'] }}</textarea>
                          
                    </div>
                </div>
                <div class="form-group col-sm-6" >
                    <label class="control-label col-sm-6">Agency logo* : </label>
                    <div class="col-sm-6" style="padding-left: 23px;">
                      <div class="input-group">
                          <label class="slide_upload" for="file">
                              <!--  -->
                              @if($getAbout['logo'] != '')
                              <?php $logo = $getAbout['logo']; ?>
                              <img id="image_load" src='{{asset("images/agency/about/$logo")}}'>
                              @else
                              <img id="image_load" src='' style="display: none;">
                              @endif
                          </label>
                          <input type="file" id="file" name="agency_logo" onchange="readURL(this,this.id)" style="display:none">
                      </div>  
                          
                    </div>
                </div>
                <div class="form-group col-sm-6" >
                    <label class="control-label col-sm-5">Agency cover image* : </label>
                    <div class="col-sm-7">
                      <div class="input-group">
                          <label class="slide_upload" for="fileCover">
                              <!--  -->
                              @if($getAbout['cover_image'] != '')
                              <?php $cover_image = $getAbout['cover_image']; ?>
                              <img id="image_load1" src='{{asset("images/agency/about/$cover_image")}}'>
                              @else
                              <img id="image_load1" src='' style="display: none;">
                              @endif
                              
                          </label>
                          <input type="file" id="fileCover" name="agency_cover_image" onchange="readURL(this,this.id)" style="display:none">
                      </div>  
                          
                    </div>
                </div>
                <div class="form-group col-sm-12">
                  <label class="control-label col-md-6 col-sm-6"></label>
                  <div class="col-md-6 col-sm-6">
                    <button type="submit" class="btn btn-success btn-trans waves-effect w-md waves-success">Save change </button>
                  </div>
                </div>
                <h4 class="col-sm-offset-3 col-sm-9" style="margin-top: 0; margin-bottom: 0;">Contact info</h4>
                <hr class="col-sm-offset-2 col-sm-9"> 

                <div class="form-group col-sm-12" >
                    <label class="control-label col-sm-3">Email : </label>
                    <div class="col-sm-9">
                      <input type="email" value="{{ $getAbout['email'] }}" placeholder="Type your email" class="form-control" name="email" >  
                          
                    </div>
                </div>
                <div class="form-group col-sm-12" >
                    <label class="control-label col-sm-3">Phone number : </label>
                    <div class="col-sm-9">
                      <input type="phone" value="{{ $getAbout['phone'] }}" placeholder="Type your phoen number" class="form-control" name="phone" >  
                          
                    </div>
                </div>
                <div class="form-group col-sm-12" >
                    <label class="control-label col-sm-3">Website link : </label>
                    <div class="col-sm-9">
                      <input type="text" value="{{ $getAbout['website'] }}" placeholder="Type your website link" class="form-control" name="website" >  
                          
                    </div>
                </div>
                <div class="form-group col-sm-12" >
                    <label class="control-label col-sm-3">Other accounts : </label>
                    <div class="col-sm-9">
                      @foreach($getAboutSocial as $social)
                      <div class="col-sm-12 no_padding append-form" id="exists-div-{{$social->_id}}">
                        
                        <input type="text" name="link[]" value="{{ $social->link}}" class="col-sm-5 form-class-exists" placeholder="Type link...">
                        <input type="hidden" name="social_id[]" value="{{ $social->_id}}">
                        {{ Form::select('social_name[]', ['facebook' => 'Facebook', 'instagram' => 'Instagram', 'twitter' => 'Twitter', 'twitter' => 'Twitter', 'youtube' => 'YouTube', 'skype' => 'Skype'], "$social->social_name") }}
                        <a onclick="deleteExistsLink(this.id)" id="{{$social->_id}}" class="btn btn-xs btn-danger"><i class="fa fa-close"></i></a>
                      </div>
                      @endforeach
                      <div id="exists-link-delete"></div>
                      <div id="accounts"></div>
                      <a id="add-accounts" class="btn btn-info btn-sm">Add account</a>  
                          
                    </div>
                </div>
                <div class="form-group col-sm-12">
                  <label class="control-label col-md-6 col-sm-6"></label>
                  <div class="col-md-6 col-sm-6">
                    <button type="submit" class="btn btn-success btn-trans waves-effect w-md waves-success">Save change </button>
                  </div>
                </div>
			          <h4 class="col-sm-offset-3 col-sm-9" style="margin-top: 0; margin-bottom: 0;">More info</h4>
                <hr class="col-sm-offset-2 col-sm-9"> 
                <div class="form-group col-sm-12" >
                    <label class="control-label col-sm-3">Impressum : </label>
                    <div class="col-sm-9">
                      <textarea rows="6" placeholder="Type your impressum..." class="form-control" name="impressum">{{ $getAbout['impressum'] }}</textarea>
                          
                    </div>
                </div>
                <div class="form-group col-sm-12" >
                    <label class="control-label col-sm-3">Awards : </label>
                    <div class="col-sm-9">
                      <textarea rows="6" placeholder="Type your awards..." class="form-control" name="awards">{{ $getAbout['awards'] }}</textarea>
                          
                    </div>
                </div>
                <div class="form-group col-sm-12" >
                    <label class="control-label col-sm-3">Products : </label>
                    <div class="col-sm-9">
                      <textarea rows="6" placeholder="Type your products..." class="form-control" name="products">{{ $getAbout['products'] }}</textarea>
                          
                    </div>
                </div> 
                <div class="form-group col-sm-12">
                  <label class="control-label col-md-6 col-sm-6"></label>
                  <div class="col-md-6 col-sm-6">
                    <button type="submit" class="btn btn-success btn-trans waves-effect w-md waves-success">Save change </button>
                  </div>
                </div>  
                <h4 class="col-sm-offset-3 col-sm-9" style="margin-top: 0; margin-bottom: 0;">Story info</h4>
                <hr class="col-sm-offset-2 col-sm-9">  
                <div class="form-group col-sm-12" >
                    <label class="control-label col-sm-3">Title : </label>
                    <div class="col-sm-9">
                      <input type="text" placeholder="Type your story title..." class="form-control" value="{{ $getAboutStory['story_title'] }}" name="story_title" >  
                          
                    </div>
                </div>
                <div class="form-group col-sm-12" >
                    <label class="control-label col-sm-3">Cover image : </label>
                    <div class="col-sm-9">
                      <div class="input-group">
                          <label class="slide_upload" for="storyCover">
                              <!--  -->
                              @if($getAboutStory['story_image'] != '')
                              <?php $story_image = $getAboutStory['story_image']; ?>
                              <img id="image_load2" src='{{asset("images/agency/about/$story_image")}}'>
                              @else
                              <img id="image_load2" src='' style="display: none;">
                              @endif
                          </label>
                          <input type="file" id="storyCover" name="story_image" onchange="readURL(this,this.id)" style="display:none">
                      </div> 
                          
                    </div>
                </div>
                <div class="form-group col-sm-12" >
                    <label class="control-label col-sm-3">Details : </label>
                    <div class="col-sm-9">
                      <textarea rows="6" placeholder="Type your story details..." class="form-control" name="story_details">{{ $getAboutStory['story_details'] }}</textarea>  
                          
                    </div>
                </div>
  							<div class="form-group col-sm-12">
  								<label class="control-label col-md-6 col-sm-6"></label>
  								<div class="col-md-6 col-sm-6">
  									<button type="submit" class="btn btn-success btn-trans waves-effect w-md waves-success">Save change </button>
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
  $(document).ready(function(){
    var count = 1;
    $("#add-accounts").click(function(){
      $("#accounts").append('<div class="col-sm-12 no_padding append-form" id="append-div-'+count+'"><input type="text" name="add_account_link[]" class="col-sm-5 form-class-append" placeholder="Type link..."><select name="add_account[]" id="" class=""><option value="facebook">Facebook</option><option value="instagram">Instagram</option><option value="twitter">Twitter</option><option value="youtube">YouTube</option><option value="skype">Skype</option></select><a onclick="deleteLink(this.id)" id="'+count+'" class="btn btn-xs btn-danger"><i class="fa fa-close"></i></a></div>');
      count++;
    });

  });
</script>
<script type="text/javascript">
  function deleteLink(id){
    $("#append-div-"+id).remove();
  }

  function deleteExistsLink(id){
    $("#exists-link-delete").append('<input type="hidden" name="exists_link_delete[]" value="'+id+'">');
    $("#exists-div-"+id).remove();
  }
</script>
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
      var target_image='#'+$('#'+image_load).prev().children().attr('id');
        $("#image_load").css('display','block');
        $("#image_load1").css('display','block');
        $("#image_load2").css('display','block');
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(target_image).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script>
    $(document).ready(function() {
        // /App.init();
        FormSliderSwitcher.init();
        FormWysihtml5.init();
    });
</script> 		
@endsection
