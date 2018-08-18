@push('css-style')
	<link rel="stylesheet" href="{{asset('public/frontend/css/pages/aside_map_page.css')}}">
@endpush


	<div class="map_search">
      	<input id="pac-input-search" class="controls from-control" type="text" placeholder="Search Box">
    </div>
    <div id="map"></div>

	<!--  -->

	<div>
		<a><img class="plan-image" src="{{asset('public/frontend/img/plans.png')}}" alt=""></a>
		
	</div>
	<div>
		<a><img class="experiences-image" src="{{asset('public/frontend/img/experiences.png')}}" alt=""></a>
		
		
	</div>
	<div>
		<a><img class="suggestions-image" src="{{asset('public/frontend/img/suggestions.png')}}" alt=""></a>
		
	</div>
	
	<div>
		<a><img class="questions-image" src="{{asset('public/frontend/img/questions.png')}}" alt=""></a>
		
	</div>

@push('js')
	<script>
	function initMap() {
		var bounds = new google.maps.LatLngBounds();
        
        
         
		var map = new google.maps.Map(document.getElementById('map'), {
          	center: {lat: <?php echo $getSinglePlace['lat']; ?>, lng: <?php echo $getSinglePlace['lon']; ?>},
          	disableDefaultUI: true,
          	mapTypeControl: false,
          	zoom: 2,
          	streetViewControlOptions: {
            	position: google.maps.ControlPosition.LEFT_BOTTOM,

          	},
          	streetViewControl: true,
          	mapTypeId: 'roadmap',
          
            styles:[
            	{
              		"elementType": "geometry",
              		"stylers": [
		                {
		                  "color": "#1d2c4d"
		                }
              		]
            	},
	            {
	              	"elementType": "labels.text.fill",
	              	"stylers": [
	                	{
	                  		"color": "#8ec3b9"
	                	}
	              	]
	            },
	            {
	              	"elementType": "labels.text.stroke",
	              	"stylers": [
	                	{
	                  		"color": "#1a3646"
	                	}
	              	]
	            },
	            {
	              	"featureType": "administrative.country",
	              	"elementType": "geometry.stroke",
	              	"stylers": [
	                	{
	                  		//"color": "#00bfff",
	                  		//"color": "#00ffff",
	                  		"color": "#6495ed",
	                	}
	              	]
	            },
	            {
	              	"featureType": "administrative.land_parcel",
	              	"elementType": "geometry.fill",
	              	"stylers": [
	                	{
	                  		"weight": 8
	                	}
	              ]
	            },
	            {
	              "featureType": "administrative.land_parcel",
	              "elementType": "labels.text.fill",
	              "stylers": [
	                {
	                  "color": "#64779e"
	                }
	              ]
	            },
	            {
	              "featureType": "administrative.province",
	              "elementType": "geometry.stroke",
	              "stylers": [
	                {
	                  "color": "#4b6878"
	                }
	              ]
	            },
	            {
	              "featureType": "landscape.man_made",
	              "elementType": "geometry.stroke",
	              "stylers": [
	                {
	                  "color": "#334e87"
	                }
	              ]
	            },
	            {
	              "featureType": "landscape.natural",
	              "elementType": "geometry",
	              "stylers": [
	                {
	                  "color": "#023e58"
	                }
	              ]
	            },
	            {
	              "featureType": "poi",
	              "elementType": "geometry",
	              "stylers": [
	                {
	                  "color": "#283d6a"
	                }
	              ]
	            },
	            {
	              "featureType": "poi",
	              "elementType": "labels.text.fill",
	              "stylers": [
	                {
	                  "color": "#6f9ba5"
	                }
	              ]
	            },
	            {
	              "featureType": "poi",
	              "elementType": "labels.text.stroke",
	              "stylers": [
	                {
	                  "color": "#1d2c4d"
	                }
	              ]
	            },
	            {
	              "featureType": "poi.park",
	              "elementType": "geometry.fill",
	              "stylers": [
	                {
	                  "color": "#023e58"
	                }
	              ]
	            },
	            {
	              "featureType": "poi.park",
	              "elementType": "labels.text.fill",
	              "stylers": [
	                {
	                  "color": "#3C7680"
	                }
	              ]
	            },
	            {
	              "featureType": "road",
	              "stylers": [
	                {
	                  "visibility": "off"
	                }
	              ]
	            },
	            {
	              "featureType": "road",
	              "elementType": "geometry",
	              "stylers": [
	                {
	                  "color": "#304a7d"
	                }
	              ]
	            },
	            {
	              "featureType": "road",
	              "elementType": "labels.text.fill",
	              "stylers": [
	                {
	                  "color": "#98a5be"
	                }
	              ]
	            },
	            {
	              "featureType": "road",
	              "elementType": "labels.text.stroke",
	              "stylers": [
	                {
	                  "color": "#1d2c4d"
	                }
	              ]
	            },
	            {
	              "featureType": "road.highway",
	              "elementType": "geometry",
	              "stylers": [
	                {
	                  "color": "#2c6675"
	                }
	              ]
	            },
	            {
	              "featureType": "road.highway",
	              "elementType": "geometry.stroke",
	              "stylers": [
	                {
	                  "color": "#255763"
	                }
	              ]
	            },
	            {
	              "featureType": "road.highway",
	              "elementType": "labels.text.fill",
	              "stylers": [
	                {
	                  "color": "#b0d5ce"
	                }
	              ]
	            },
	            {
	              "featureType": "road.highway",
	              "elementType": "labels.text.stroke",
	              "stylers": [
	                {
	                  "color": "#023e58"
	                }
	              ]
	            },
	            {
	              "featureType": "transit",
	              "elementType": "labels.text.fill",
	              "stylers": [
	                {
	                  "color": "#98a5be"
	                }
	              ]
	            },
	            {
	              "featureType": "transit",
	              "elementType": "labels.text.stroke",
	              "stylers": [
	                {
	                  "color": "#1d2c4d"
	                }
	              ]
	            },
	            {
	              "featureType": "transit.line",
	              "elementType": "geometry.fill",
	              "stylers": [
	                {
	                  "color": "#283d6a"
	                }
	              ]
	            },
	            {
	              "featureType": "transit.station",
	              "elementType": "geometry",
	              "stylers": [
	                {
	                  "color": "#3a4762"
	                }
	              ]
	            },
	            {
	              "featureType": "water",
	              "elementType": "geometry",
	              "stylers": [
	                {
	                  "color": "#0e1626"
	                }
	              ]
	            },
	            {
	              "featureType": "water",
	              "elementType": "labels.text.fill",
	              "stylers": [
	                {
	                  "color": "#4e6d70"
	                }
	              ]
	            }
          	]
        });

		var input = document.getElementById('pac-input-search');

        map.setTilt(45);
        //map.setOptions({ minZoom: 2});   
        map.setOptions({ minZoom: 2, maxZoom: 15 }); 
        
        var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
            this.setZoom(15);
            google.maps.event.removeListener(boundsListener);
        });

        
        
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });
        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });


		var infoWin = new google.maps.InfoWindow();
		  // Add some markers to the map.
		  // Note: The code uses the JavaScript Array.prototype.map() method to
		  // create an array of markers based on a given "locations" array.
		  // The map() method here has nothing to do with the Google Maps API.
		var markers = locations.map(function(location, i) {
		    var marker = new google.maps.Marker({
		      position: location,
		      animation: google.maps.Animation.DROP,
		    });
		    google.maps.event.addListener(marker, 'click', function(event) {
		      	latitude = event.latLng.lat();
		        longitude = event.latLng.lng();
		        window.location.href=("{{ URL::to('check-place')}}"+'/'+latitude+'/'+longitude);
		    });

		    google.maps.event.addListener(marker, 'mouseover', function(evt) {
		      infoWin.setContent(location.info);
		      infoWin.open(map, marker);
		    });
		    return marker;
		});

		  // Add a marker clusterer to manage the markers.
		var markerCluster = new MarkerClusterer(map, markers, {
		    //imagePath: "{{asset('public/img/aaa')}}"
		    imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
		});

		}
		var locations = [
			{
			  lat: <?php echo $getSinglePlace['lat']; ?>,
			  lng: <?php echo $getSinglePlace['lon']; ?>,
			  info: "<div><?php echo $getSinglePlace['place_name']; ?></div>"
			},

			<?php 
				foreach ($getPostWisePlaceId as $placeId) {
					foreach ($getPlace as $place) {
						if ($placeId == $place->_id && $place->_id != $getSinglePlace['_id']) {
							?>
							{
							  lat: <?php echo $place->lat; ?>,
							  lng: <?php echo $place->lon; ?>,
							  info: "<div><?php echo $place->place_name; ?></div>"
							},
							<?php
						}
					}
				}

			 ?> 
			 
		];

	</script>
	<script src="{{asset('public/js/mapmarkerclusterer.js')}}"></script>
@endpush