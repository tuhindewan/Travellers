<template>
	
	<div id="comment_like_section" style="display:inline">
      	<a v-if="likers" class="liked" @click="like">Like</a>
        <a v-else class="like" @click="like">Like</a>
        
        <span v-if="commentLike.length >0 ">
            &nbsp;
            <i v-if="likers" class="fa fa-thumbs-up liked" aria-hidden="true"></i>
            <i v-else class="fa fa-thumbs-o-up" aria-hidden="true"></i>
        </span>

        <a class="capitalize" v-if="commentLike.length < 2" v-for="like in commentLike" :href="url+'/'+like.users.username">  {{ like.users.fullname }} </a>
        <a v-if="commentLike.length > 1" @click="showUserList(commentId)">   {{ commentLike.length }} Others</a>
		    &nbsp;
       	
        <div class="modal-check" style="display:inline">
          <div class="overlay-modal overlay-modal-check" :id="'modal'+commentId" style="margin-left: 0px; display: none;">
            <div :class="'travel_dialog show_travel_modal'+commentId" style="min-height: 90px;">
              <div :class="'fade-box-delete fade-box'+commentId">
                <div class="inner_gray clearfix">
                  <div class="inner_gray_text">
                  All {{ commentLike.length }}
                  </div>
                  <div class="inner_gray_close_button">
                    <a href="#" @click="closeModal(commentId)" class="close" role="button" title="Close">Close</a>
                  </div>
                </div>
                <div class="inner_body">
                  <div class="inner_body_content user_popup">
                      <div class="panel popup-user panel-default" v-for="like in commentLike">
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
		
        props:['commentId','commentLike'],

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
                    commentId:this.commentId,
                    userId:this.authId,
                    status: status,
                };

                //console.log(data);

                axios.post(this.url+'/comment-like',likeData).then( response=> {
                	//console.log(response.data);
                    this.commentLike = response.data;
                });

                Echo.private('commentLike')
		    	.listen('CommentLike',(e)=>{
	            	this.commentLike = e.commentLike;    
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
        		this.commentLike.forEach( (like)=>{
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