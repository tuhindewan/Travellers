<template>
  	<div class="personal_information_content">
  		
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">VISITED PLACES</h3>
        </div>
        <div class="panel-body">
          <div class="panel-group" id="accordion">
           
            <div class="panel panel-default">
              <div class="panel-body" v-if="visitPlaces" v-for="place in visitPlaces" >
                <div class="row">
                  <div class="col-sm-2">
                    <div class="placeImage" v-for="(post,index) in getPostVisited" >

                      <a :href="url+'/'+userInfo.username+'/posts/'+post._id" v-if="post.fk_place_id == place.id"><img :src="url+'/images/post/photo/thum/'+post.post_image[0].images" class="img-responsive"></a>
                    </div>
                  </div>
                  <div class="col-sm-10">
                    <div class="headline">
                      <h4>{{ place.infoText }}</h4>
                    </div>
                    <div v-for="post in getPostVisited" >
                      <div v-if="post.fk_place_id == place.id" class="time">
                        <a :href="url+'/'+userInfo.username+'/posts/'+post._id">{{ post.created_at }}</a>
                      </div>
                    </div> 
                  </div>
                </div>
                
                
              </div>
            </div>
            
          </div>
        </div>
      </div>
  	</div>
    
</template>

<script>

  export default {
    props:['userInfo','authInfo','visitPlaces','getPostVisited'],
    data() {

        return {
            url:$("#base_url").val(),
            visitPlaces:[],
            userInfo:{},
            authInfo:{},
            getPostVisited:[]
            
        }
    },
    methods:{
      formatTime (time) {
          let previousTime = moment(time,'YYYY-MM-DD HH:mm:ss').format('x');
          let timeDifference = moment(previousTime,'x').fromNow();
          return timeDifference;
      } ,
    
    },
    mounted(){

    
    }
  }
</script>
<style>
.per_info_editable{display:inlin; float:right}
.panel-default>.panel-heading { overflow: hidden; }
.panel-ediable>.panel-heading {background: #fbfbfb !important;}
.panel-ediable>.panel-heading:hover{background: #fff !important;}
</style>



