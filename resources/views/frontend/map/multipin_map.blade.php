<style>
	#map_wrapper { width: 100%;position: absolute !important; top:0; left: 0; height: 100%;}
    /* Optional: Makes the sample page fill the window. */
    html, body { height: 100%; margin: 0; padding: 0;}
	
	#map_canvas { width: 100%; height: 100%;}
	.info_content h5{margin-top: 13px; margin-bottom: 3px;}
</style>
<div id="map_wrapper">
    <div id="map_canvas" class="mapping"></div>
</div>

<!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> -->
<script>
	
    function initMap() {
        var map;
        var bounds = new google.maps.LatLngBounds();
        var mapOptions = {
            mapTypeId: 'roadmap',
            mapTypeControl: false,
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
        };
        
                        
        // <!-- Display a map on the page -->
        map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
        map.setTilt(45);
           
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
        // <!-- Override our map zoom level once our fitBounds function runs (Make sure it only runs once) -->
        var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
            this.setZoom(2);
            google.maps.event.removeListener(boundsListener);
        });
        
    }
</script>

