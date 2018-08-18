
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
        width: 41.6%; float: left;
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

		#pac-input-search{width: 50%; z-index: 0; position: absolute; left: 0px; top: 0px; background: transparent; color: #fff; border: 1px solid #ccc;}  
		.map_search input::-webkit-input-placeholder {color: #fff;}
		.map_search input::-moz-placeholder {color: #fff;}
		.controls{margin-top: 5px;}
	</style>
  </head>
  <body>
  	<div class="map_search">
  		
    	<input id="pac-input-search" class="controls from-control" type="text" placeholder="Search Box">
  	</div>
    <div id="map"></div>
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> -->
    <script>
      
      function initMap() {
      	var bounds = new google.maps.LatLngBounds();
        var map = new google.maps.Map(document.getElementById('map'), {
          //center: {lat: -33.8688, lng: 151.2195},
          disableDefaultUI: true,
          mapTypeControl: false,
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
		
        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input-search');

        map.setTilt(45);
        map.setOptions({ minZoom: 2});   
        // <!-- Multiple Markers -->
        var markers = [
        	['Mirpur-1, Dhaka, Dhaka Division, Bangladesh',23.7956037, 90.35365479999996, 6],
            ['Bondi Beach', -33.890542, 151.274856, 4],
            ['Coogee Beach', -33.923036, 151.259052, 5],
            ['Cronulla Beach', -34.028249, 151.157507, 3],
            ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
            ['Maroubra Beach', -33.950198, 151.259302, 1]
            
        ];

        // <!-- Info Window Content -->
        var infoWindowContent = [
        	['<div class="info_content">' +
            '<h5>Mirpur-1, Dhaka, Dhaka Division, Bangladesh</h5>' +
            '</div>'],
            ['<div class="info_content">' +
            '<h5>Bondi Beach</h5>' +
            '</div>'],
            ['<div class="info_content">' +
            '<h5>Coogee Beach</h5>' +
            '</div>'],
            ['<div class="info_content">' +
            '<h5>Cronulla Beach</h5>' +
            '</div>'],
            ['<div class="info_content">' +
            '<h5>Manly Beach</h5>' +
            '</div>'],
            ['<div class="info_content">' +
            '<h5>Maroubra Beach</h5>' +
            '</div>']
            
        ];
        // <!-- Display multiple markers on a map -->
        var infoWindow = new google.maps.InfoWindow(), marker, i;
        
        // <!-- Loop through our array of markers & place each one on the map   -->
        for( i = 0; i < markers.length; i++ ) {
            var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
            bounds.extend(position);
            marker = new google.maps.Marker({
                position: position,
                map: map,
                title: markers[i][0]
            });
            
            // <!-- Allow each marker to have an info window     -->
            google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
                return function() {
                	//this.setIcon('http://www.christielakekids.com/_images/map_pins/events/canoe-for-kids.png');
                    infoWindow.setContent(infoWindowContent[i][0]);
                    infoWindow.open(map, marker);
                }
            })(marker, i));

            /*onclick map marker*/
            google.maps.event.addListener(marker, 'click', function( event ){
            	latitude = event.latLng.lat();
            	longitude = event.latLng.lng();
			    alert( "Latitude: "+latitude+" "+", longitude: "+longitude ); 
			});

			

            // <!-- Automatically center the map fitting all markers on the screen -->
            map.fitBounds(bounds);
        }

        var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
            this.setZoom(2);
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
      }

    </script>

