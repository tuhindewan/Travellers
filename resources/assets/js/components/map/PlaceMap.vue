<template>
    <data>
      <div id="inputSearch">
        <gmap-autocomplete :value="sharePlace" @place_changed="setPlace" class="form-control map_search" style="position:fixed; width:40%">
        </gmap-autocomplete>
        
      </div>

      <gmap-map :center="center" :zoom="zoom" :options="{minZoom: 2,streetViewControl: false, fullscreenControl: false, scrollwheel: true, mapTypeControl: false, styles: styles}" class="res_placemap" style="width: 41.5%; float:left; position:fixed; height: 92%">
        <gmap-info-window :options="infoOptions" :position="infoWindowPos" :opened="infoWinOpen" @closeclick="infoWinOpen=false">
            {{infoContent}}
        </gmap-info-window>
        <gmap-cluster><gmap-marker :key="i" v-for="(m,index) in markers" :position="m.position" :clickable="true" @click="getLocation(m,index)" @mouseover="toggleInfoWindow(m,index)"></gmap-marker></gmap-cluster>
      </gmap-map>


      <div>
        <a><img class="plan-image" :src="url+'/public/frontend/img/plans.png'" alt=""></a>
        
      </div>
      <div>
        <a><img class="experiences-image" :src="url+'/public/frontend/img/experiences.png'" alt=""></a>
        
        
      </div>
      <div>
        <a><img class="suggestions-image" :src="url+'/public/frontend/img/suggestions.png'" alt=""></a>
        
      </div>
      
      <div>
        <a><img class="questions-image" :src="url+'/public/frontend/img/questions.png'" alt=""></a>
        
      </div>
    
    </data>
    
	
  
</template>

<script>
import VueGoogleMaps from 'vue2-google-maps';
import VueRouter from 'vue-router';
const router = new VueRouter({
        mode: 'history',
        
    });
export default {
    
    data () {
      
        return {
            url:$("#base_url").val(),
            zoom:13,
            //position:{},
            center:'',
            infoContent: '',
            infoWindowPos: {
                lat: 0,
                lng: 0
            },
            infoWinOpen: false,
            currentMidx: null,
            //optional: offset infowindow so it visually sits nicely on top of our marker
            infoOptions: {
                pixelOffset: {
                    width: 0,
                    height: -35
                }
            },

            markers: [],
            styles:[],
            places: [],
            icons:[],
            currentPlace: null,
            pId:$("#place").val(),
        }
      },
      router,
      methods:{
        getLocation(markers,idx){
          
          if(markers.id){
            var lat = markers.position.lat;
            var lng = markers.position.lng;
            var placeId = markers.id;
            window.location.href=this.url+"/place/"+placeId;  
          }else{
            
          }

          
          
        },

         
        setPlace(place) {
          this.currentPlace = place;
          
          if (this.currentPlace) {
            const marker = {
              lat: this.currentPlace.geometry.location.lat(),
              lng: this.currentPlace.geometry.location.lng()
            };
            //this.markers.push({ position: marker,infoText:this.currentPlace.formatted_address,icon:this.currentPlace.icon});
            //this.markers.push({ infoText: this.currentPlace.adr_address});
            this.places.push(this.currentPlace);
            //this.icons.push(this.icon);
            this.center = marker;
            this.currentPlace = null;
            this.zoom=13;
          }
        },
        
        toggleInfoWindow(marker,idx){
          this.infoWindowPos = marker.position;
            this.infoContent = marker.infoText;

            //check if its the same marker that was selected if yes toggle
            if (this.currentMidx == idx) {
              this.infoWinOpen = !this.infoWinOpen;
            }
            //if different marker set infowindow to open and reset current marker index
            else {
              this.infoWinOpen = true;
              this.currentMidx = idx;

            }
        },

        geolocate: function() {
          navigator.geolocation.getCurrentPosition(position => {
            // this.center = {
            //   lat: position.coords.latitude,
            //   lng: position.coords.longitude
            // };
            //console.log(this.center);
          });
        }  
          
      },
      
      

    mounted(){
      
      this.geolocate();
      axios.get(this.url+'/place-wise-marker'+'/'+this.pId).then( response=> {
        
        this.center ={
          lat: response.data.position.lat,
          lng: response.data.position.lng 
        };
        
              
      });
      //console.log(this.$route.fullPath);
      var place = 0;
      if(this.$route.fullPath=='/travel-project/place/'+this.pId+'/suggestions'){
        place  = 1;
      }else if(this.$route.fullPath=='/travel-project/place/'+this.pId+'/plans'){
        place  = 3;
      }else if(this.$route.fullPath=='/travel-project/place/'+this.pId+'/questions'){
        place  = 2;
      }else{
        place  = 4;
      }
      //var place  = ;
      axios.get(this.url+'/public-wise-markers'+'/'+place).then( response=> {
          
          this.markers = response.data;
          
      });
      this.styles=
            [
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
            ];
    }
  }
</script>


<style>
#inputSearch{width: 23%; z-index: 10; position: absolute; left: 5px; top: 5px; background: transparent; color: #fff;}  
#inputSearch input{background: transparent; color: #fff; }  
.map_search::-webkit-input-placeholder {color: #fff;}
.map_search::-moz-placeholder {color: #fff; }
    </style>