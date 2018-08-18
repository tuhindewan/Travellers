<template>
    <div>
        <div class="col-md-12" style="padding-left: 6px;">

            <div class="panel panel-default" style="margin-top: 6px;">
              <div class="panel-heading"><i class="fa fa-image"></i>  Photos</div>
              <div class="panel-body">
                <div class="row user_photo_section" style="padding: 0px 30px;">
                  <div class="col-md-3 single_user_photo no_padding" v-for="(photo, index) in postPhotos">
                    <img @click="singleImage(index, photo)" :src="url+'/images/post/photo/thum/'+photo.images" class="img-responsive"> 

                    <imageModal :show="showModal" :postUser="postUser" :imageInfo="imageInfo" @close="showModal = false" :next="nextPost" :pre="prePost" :postImage="postPhotos"></imageModal>

                  </div>
                  
              </div>
            </div>    
        </div>   
    </div>

    
</div>
</template>

<script>
  import imageModal from './../feed/ImageModel.vue';
	export default {

		props:['userInfo','authInfo'],
        data() {

            return {
                url:$("#base_url").val(),
                
                authId:$("#authId").val(),
                postPhotos:[],
                showModal: false,
                postUser:{},
                nextPost:'',
                prePost:'',
                imageInfo:{},

                
                
                
            }
        },
        methods:{
        	formatTime (time) {
                let previousTime = moment(time,'YYYY-MM-DD HH:mm:ss').format('x');
                let timeDifference = moment(previousTime,'x').fromNow();
                return timeDifference;
            } ,

            getFriends(){
              var userId = $("#uId").val();
              
              //get user photos
              axios.get(this.url+'/user-wise-post-image/'+userId).then( response=> {
                  this.postPhotos = response.data;
                  //console.log(this.postPhotos);
                  
              });

            },

            singleImage(ind, imageInfo){
            
              this.postUser = this.userInfo;
              this.imageInfo = imageInfo;
              //console.log(imgId);
              this.nextPost = ind+1;
              this.prePost = ind-1;
              
              this.showModal = true;
              
            },
            
            
        },
        
        components:{
          imageModal
        },

        mounted(){
	    	
          this.getFriends();
		    
	    }
    }
</script>
<style>
  .user_photo_section .single_user_photo{width: 25%; height: 200px;}
   .single_user_photo img{width: 100%; height: 100%;object-fit: cover; max-width:unset !important;}
   
</style>