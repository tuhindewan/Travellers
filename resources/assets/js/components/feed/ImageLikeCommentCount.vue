<template>
	<div>
		<div class="like_comment_count">
	      	<div class="row">
		        <div class="col-sm-6 col-xs-6">
		          <div id="like_section">
		          	<a v-if="likers" class="liked" @click="like"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Like</a>
   
        			<a v-else class="like" @click="like"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Like</a>
		           	 
		          </div>
		        </div>
		        <div class="col-sm-6 col-xs-6"><a class="click_comment" :id="'comment'+postImage._id" onclick="clickComment(this.id)"><i class="fa fa-commenting-o" aria-hidden="true"></i> Comment</a></div>
		    </div>
	    </div>
	          
        <div class="like_comment_view" v-if="image_like">
	       <hr>
	      	<div class="row" v-if="image_like.length >0">
	          <div class="col-sm-6 col-xs-6">
	            <div v-if='image_like' class="like_show_section">
	              <div class="button_gly" style="margin-top:0"></div>
	              <span v-for="like in image_like" v-if="image_like.length < 2" :id="'like_love_'+postImage._id"><a class="font12 capitalize" :href="url+'/'+like.users.username">{{ like.users.fullname }}</a></span>
	              <span v-if="image_like.length > 1" :id="'like_love_'+postImage._id"><a @click="showUserList()" class="font12">{{ image_like.length }} others</a> </span>
	            </div>
	            
	          </div>
	          <div class="col-sm-6 col-xs-6">
	            <div v-if="imageComment" class="comment_show_section">
	              <a href="javascript: void(0)" :id="'all_comment'+postImage._id" onclick="previous_comment_load(this.id)"><span :id="'comment_counter'+postImage._id">{{ imageComment.length }}</span> Comments</a>
	            </div>
	          </div>
	        </div>
            <div class="modal-check">
              <div class="overlay-modal overlay-modal-check" style="margin-left: 0px; display: none;">
                <div class="travel_dialog show_travel_modal" style="min-height: 90px;">
                  <div class="fade-box-delete fade-box">
                    <div class="inner_gray clearfix">
                      <div class="inner_gray_text">
                      All {{ image_like.length }}
                      </div>
                      <div class="inner_gray_close_button">
                        <a href="#" @click="closeModal" class="close" role="button" title="Close">Close</a>
                      </div>
                    </div>
                    <div class="inner_body">
                      <div class="inner_body_content user_popup">
                          <div class="panel popup-user panel-default" v-for="like in image_like">
                            <div class="panel-body no_padding">
                              <div class="row">
                                  <div class="col-sm-2 col-xs-2">
                                      <div class="user_img">
                                          <img :src="url+'/images/users/profile/s80'+like.users.profile_image" alt="">
                                      </div>
                                  </div>
                                  <div class="col-sm-6 col-xs-6 no_padding">
                                      <div class="user_name capitalize">
                                          <a class="font12" :href="url+'/'+like.users.username">{{ like.users.fullname }}</a>
                                      </div>
                                  </div>
                                  <div class="col-sm-4 col-xs-4">
                                    <relationship class="pull-right" :userid="like.users._id"></relationship>
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
    </div>
</template>

<script>
  import relationship from './Relationship.vue';
	export default {
		data() {

            return {
            	url:$("#base_url").val(),
                authId:$("#authId").val(),
                //post:'',
                
            }
        },
        http: {
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    },
      components:{
        relationship
      },
	    watch:{
        	    

        },
		
        props:['postImage','image_like','imageComment'],

        methods:{
        	like(){
        		var check = this.likers;
        		if(check===false){
        			status = 0;
        			this.likers = true;
        		}else{
        			status = 1;
        			this.likers = false;
        		}
        		//console.log(check);
        		let likeData = {
                    fk_image_id:this.postImage._id,
                    fk_user_id:this.authId,
                    status: status,
                    liked_by:0
                };

                //console.log(data);

                axios.post(this.url+'/post-image-like',likeData).then( response=> {
                    //console.log(response.data);
                    this.image_like = response.data;
                });

       //          Echo.private('postLike')
			    // .listen('PostLikes', (e) => {
			    // 	this.image_like = e.postLike;
			    // });
                
                
        	},
            showUserList(){
              
            $(".overlay-modal-check").show();
            $(".show_travel_modal").css("width", "225").animate({
                "opacity" : 1,
                height : 'auto',
                width : "448"
            }, 600, function() {
                /*When animation is done show inside content*/
                $(".fade-box").show();
                $("#OD").focus();
            });
          },
          closeModal(){
              $(".overlay-modal-check").fadeOut("slow", function() {
                /*Remove inline styles*/
                $(".overlay-modal, .travel_dialog").removeAttr("style");
              });
            
          },

        },
        mounted(){
	    	
		    
	    },
        
        computed:{

        	likers(){
        		var likers = [];
				var count = 0;
        		if(this.image_like){
                    this.image_like.forEach( (like)=>{
                        likers.push(like.fk_user_id)
                        if(like.fk_user_id === this.authId){
                            count = 1;
                        }
                    });
                }
        		
        		if(count===1){
        			return true;
        		}else{
        			return false;
        		}
        		
        	}

        },
        

    }
</script>