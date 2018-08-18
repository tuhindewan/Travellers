<template>
    <data>
      
      <gmap-map :center="center" :zoom="zoom" :options="{minZoom: 2,streetViewControl: false, fullscreenControl: false, scrollwheel: true, mapTypeControl: false, styles: styles}" style="width:100%; height: 300px">
        <gmap-info-window :options="infoOptions" :position="infoWindowPos" :opened="infoWinOpen" @closeclick="infoWinOpen=false">
            {{infoContent}}
        </gmap-info-window>
        <gmap-cluster><gmap-marker :key="i" v-for="(m,index) in markers" :position="m.position" :clickable="true" @click="getLocation(m,index)" @mouseover="toggleInfoWindow(m,index)"></gmap-marker></gmap-cluster>

        
      </gmap-map>


      
    
    </data>
    
	
  
</template>

<script>
import VueGoogleMaps from 'vue2-google-maps';


export default {
    props:['lat','lng','text'],
    data () {
      
        return {
            url:$("#base_url").val(),
            zoom:13,
            
            center:{},
            infoContent: '',
            infoWindowPos: {},
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
            
        }
      },
      
      methods:{
        toggleInfoWindow(marker,idx){
          this.infoWindowPos = marker.position;
            this.infoContent = this.text;

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


         
          
      },
      
      

    mounted(){
      this.center ={
        lat: parseFloat(this.lat),
        lng: parseFloat(this.lng)
      };
      this.infoWindowPos ={
        lat: parseFloat(this.lat),
        lng: parseFloat(this.lng)
      };
      markers: [{
        position: {
          lat: parseFloat(this.lat),
          lng: parseFloat(this.lng)
          }
      }],
      
      //console.log(this.$route.fullPath);
      
      //var place  = ;
      
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



</style>