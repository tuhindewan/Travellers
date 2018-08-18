<template>
	<div>
	
		<div class="like_comment_count">
	      	<div class="row">
		        <div class="col-sm-6 col-xs-6">
		          <div id="like_section">
		          	<a v-if="likers" class="liked"  @click="like"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Like</a>
   
        			<a v-else class="like" @click="like"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Like</a>
		           	 
		          </div>
		        </div>
		        <div class="col-sm-6 col-xs-6"><a class="click_comment" :id="'comment'+post._id" onclick="clickComment(this.id)"><i class="fa fa-commenting-o" aria-hidden="true"></i> Comment</a></div>
		    </div>
	    </div>
	          
      <div v-if="post_like.length >0 " class="like_comment_view">
	        <hr>
	      	<div class="row">
	          <div class="col-sm-6 col-xs-6">
	            <div class="like_show_section capitalize">
	              <div class="button_gly"></div>
	              <span v-if="post_like.length < 2" v-for="like in post_like" :id="'like_love_'+post._id"><a class="font11" :href="url+'/'+like.users.username">{{ like.users.fullname }}</a></span>

	              <span v-if="post_like.length > 1" :id="'like_love_'+post._id"><a  @click="showUserList(post._id)" class="font11">{{ post_like.length }} others</a> </span>

	            </div>
	            
	          </div>
	          <div class="col-sm-6 col-xs-6">
	            <div class="comment_show_section">
	              <a class="font11" href="javascript: void(0)" :id="'all_comment'+post._id" onclick="previous_comment_load(this.id)"><span :id="'comment_counter'+post._id">{{ post.post_comment.length }}</span> Comments</a>
	            </div>
	          </div>
            <div class="modal-check">
              <div class="overlay-modal post-comment-like" :id="'modal'+post._id" style="margin-left: 0px; display: none;">
                <div :class="'travel_dialog show_travel_modal'+post._id" style="min-height: 90px;">
                  <div :class="'fade-box-delete fade-box'+post._id">
                    <div class="inner_gray clearfix">
                      <div class="inner_gray_text">
                      All {{ post_like.length }}
                      </div>
                      <div class="inner_gray_close_button">
                        <a href="#" @click="closeModal(post._id)" class="close" role="button" title="Close">Close</a>
                      </div>
                    </div>
                    <div class="inner_body">
                      <div class="inner_body_content user_popup">
                          <div class="panel popup-user panel-default" v-for="like in post_like">
                            <div class="panel-body no_padding">
                              <div class="row">
                                  <div class="col-sm-2">
                                      <div class="user_img">
                                          <img :src="url+'/images/users/profile/s80'+like.users.profile_image" alt="">
                                      </div>
                                  </div>
                                  <div class="col-sm-6 no_padding">
                                      <div class="user_name capitalize">
                                          <a class="font12" :href="url+'/'+like.users.username">{{ like.users.fullname }}</a>
                                      </div>
                                  </div>
                                  <div class="col-sm-4">
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
    </div>
</template>

<script>
  import relationship from './Relationship.vue';
	export default {
		data() {

            return {
            	url:$("#base_url").val(),
                authId:$("#authId").val(),
                checkUserAccess:false,
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
		
        props:['post','post_like'],

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
                    postId:this.post._id,
                    userId:this.authId,
                    status: status,
                };

                //console.log(data);

                axios.post(this.url+'/post-like',likeData).then( response=> {
                    this.post_like = response.data;
                });

                Echo.private('postLike')
			    .listen('PostLikes', (e) => {
			    	this.post_like = e.postLike;
			    });
                
                
        	},
          showUserList(id){
            $("#modal"+id).show();
            $(".show_travel_modal"+id).css("width", "225").animate({
                "opacity" : 1,
                height : 'auto',
                width : "448"
            }, 600, function() {
                /*When animation is done show inside content*/
                $(".fade-box"+id).show();
                
            });
          },
          closeModal(id){
              $("#modal"+id).fadeOut("slow", function() {
                /*Remove inline styles*/
                $("#modal"+id+", .show_travel_modal"+id).removeAttr("style");
              });
            
          },

        },
        mounted(){
	    	
		    
	    },
        
        computed:{

        	likers(){
        		var likers = [];
				var count = 0;
        		this.post_like.forEach( (like)=>{
        			likers.push(like.fk_user_id)
        			if(like.fk_user_id === this.authId){
        				count = 1;
        			}

        		});
        		
        		if(count===1){
        			return true;
        		}else{
        			return false;
        		}
        		
        	}

        },
        

    }
</script>