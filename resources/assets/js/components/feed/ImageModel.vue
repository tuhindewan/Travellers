<template>
	<div>
		<div class="modal-mask" @click="close" v-show="show" >
            <div class="modal-container" @click.stop>
                
                <div class="modal-body modal-body-image no_padding">
                	<a class="modal-default-button" @click="savePost()">
                        <i class="fa fa-times res_fs_15" style="font-size: 25px;"></i>
                    </a>
                    <div class="row no_padding" style="height:100%;">
                        <div class="col-sm-8 col-xs-12 no_padding res_h_39" style="height:100%;">
                            <div class="image_section">
                                
                                <div class="pre" @click="prePost(pre)"><i class="fa fa-angle-left"></i></div>
                                <img v-if="imageInfo.images" :src="url+'/images/post/photo/'+imageInfo.images" class="img-responsive" alt="">
                                <div class="next" @click="nextPost(next)"><i class="fa fa-angle-right"></i></div>   
                                
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="cotent_section">
                                <div class="right_content">
                                    <div class="single_post_top">
                                        <div class="user_profile">
                                            
                                            <img v-if="postUser.profile_image" :src="userProfilePath+postUser.profile_image">
                                            
                                        </div>
                                        <div class="user_info">
                                            <!-- <a :href="url+'/'+postUser.username"><b>{{ postUser.fullname }}</b></a> -->
                                            <userLink :userinfo="postUser"></userLink>
                                            <div>
                                                <a :href="url+'/'+postUser.username+'/photos/'+imageInfo._id" class="show_time">{{ formatTime(imageInfo.created_at) }}</a>                      
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="single_post_bottom">
                                      
                                      <div class="like_comment_section">

                                        <imageLike :postImage="imageInfo" :image_like="imageInfo.image_like" :imageComment="imageInfo.image_comment"></imageLike>
                                        
                                        <hr>
                                        
                                        <div class="show_post_comment">
                                            <imageComments :imageId="imageInfo._id" :comments="imageInfo.image_comment" :authInfo="authInfo"></imageComments>
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
	</div>
</template>

<script>
    import userLink from './UserLink.vue';
	import imageLike from './ImageLikeCommentCount.vue';
    import imageComments from './ImageComment.vue';
	export default {

		props: ['show','postUser','imageInfo','next','pre','postImage'],
        data() {

            return {
                url:$("#base_url").val(),
                userProfilePath: $("#base_url").val()+"/images/users/profile/s160",
                authId:$("#authId").val(),
                postImage:[],
                showModal: false,
                pre:'',
                next:'',
                
                postUser:{},
                imageInfo:{},
                authInfo:{}

            }
        },
        components:{
            imageLike,imageComments,userLink
        },
        methods: {
        	formatTime (time) {
                let previousTime = moment(time,'YYYY-MM-DD HH:mm:ss').format('x');
                let timeDifference = moment(previousTime,'x').fromNow();
                return timeDifference;
            } ,
		    close: function () {
		      this.$emit('close');
               
		    },
		    savePost: function () {
		      // Some save logic goes here...
		      
		      this.close();
		    },

		    nextPost(e){
                
		    	let postImages = this.postImage;
                
		    	if(e >= this.postImage.length || e==="-1"){
		    		this.imageInfo = postImages[0];
		    		
		    		this.pre = -1;
                	this.next= 1;
		    	}else{
		    		this.imageInfo = postImages[e];
		    			
		    		this.pre=e-1;
                	this.next=e+1;
		    	}
                
		    },
		    prePost(e){
                //console.log(e);
		    	let postImages = this.postImage;
		    	
		    	if(e == "-1"){
		    		
                    this.imageInfo = postImages[postImages.length-1];
		    		this.pre = postImages.length-2;
                	this.next= postImages.length;
		    	}else{
		    		
		    		
                    this.imageInfo = postImages[e];	
		    		this.pre=e-1;
                	this.next=e+1;
		    	}
		    },

            
		},
		mounted: function () {

		    document.addEventListener("keydown", (e) => {
		      if (this.show && e.keyCode == 27) {
		        this.close();
		      }
		    });


            axios.get(this.url+'/auth-info').then( response=> {
                this.authInfo = response.data;
            });
            //$('body').css('overflow', 'hidden');
            
            
		}

    }
</script>
<style>
	.modal-mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, .5);
    transition: opacity .3s ease;
}
.cotent_section{width:100%; height:100%; padding-top: 20px;}
.modal-container { width: 90%; overflow: hidden; margin: 40px auto; padding: 0px; background-color: #fff; border-radius: 2px; -webkit-box-shadow: 0 2px 8px rgba(0, 0, 0, .33); box-shadow: 0 2px 8px rgba(0, 0, 0, .33); -webkit-transition: all .3s ease; transition: all .3s ease; font-family: Helvetica, Arial, sans-serif; padding-bottom: 0px; height: 90%;
}

.modal-header h3 {
    margin-top: 0;
    color: #42b983;
}

.modal-body-image { width: 100%; height: 100%; }

.text-right {
    text-align: right;
}

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
.modal-default-button{position: fixed; top: 5px; right: 48px; border: 2px solid #0e1626; color: red; border-radius: 50px; padding: 5px;}

.image_section{width: auto; height: 100%; position: relative;background: #000; padding-top: 30px;}
.image_section img{margin:0 auto}


.right_content{width: 100%; padding: 0 15px; height: 95%; overflow-y:scroll; }

.next{position: absolute; right: 27px; top: 44%; color: none; background: none; padding: 0 9px; font-size: 42px;}
.next:hover{cursor:pointer; position: absolute; right: 27px; top: 44%; color: #fff; background: #ccc; padding: 0 9px; font-size: 42px;}
.pre{position: absolute; left: 27px; top: 44%; color: none; background: none; padding: 0 9px; font-size: 42px;}
.pre:hover{cursor:pointer; position: absolute; left: 27px; top: 44%; color: #fff; background: #ccc; padding: 0 9px; font-size: 42px;}
</style>