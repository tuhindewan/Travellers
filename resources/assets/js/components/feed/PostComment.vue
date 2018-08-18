<template>
	<div>
		<div class="row">
		  
		  <div class="view_previous_comment" v-if="comments.length >=5 && limitComments.length < 6" :id="'view-previous-comment'+postId">
		    <a href="javascript: void(0)" class="previous_comment" @click="load_comment()">View previous comments</a>
		  </div>
		  <!--  -->
		  <!-- <div :id="'load-all-comment'+postId"></div> -->
		  <!--  -->
		  <div class="show_comment_limit show_comment" :id="'show-comment-limit'+postId">
		  	
		    <div v-for="comment in limitComments" :class="'post_comment_content si_com_'+comment._id" :id="'si_com_'+comment._id">
		  
		      <div class="col-sm-2 col-xs-2 post_activity_left">
		        <div class="posted_profile">
		            <img :src="userProfilePath+comment.users.profile_image">
		        </div>
		      </div>
		      <div class="col-sm-9 col-xs-9 post_activity_right no_padding" :id="'post-comment-right'+comment._id">
		        <div class="comment_box_section" :id="'comment_right'+comment._id">
		        	<div class="post_comment_top font13">
		        	  <userLink :userinfo="comment.users"></userLink>
			          
			          <div class="post_comment_body res_fs_10" :id="'comment-body-content'+comment._id" v-html="innerText(comment.comment)"> </div>
			        </div>
			        <div class="post_comment_bottom" style="margin:7px;">
			          <commentLike :commentId="comment._id" :commentLike="comment.post_comment_like"></commentLike> . <a href="javascript: void(0)" :id="'comment_reply_box'+comment._id" onclick="comment_reply_box(this.id)"> Reply</a> . {{ formatTime(comment.created_at) }}
			        </div>
		        </div>
		        <div class="update_comment_box" :id="'update_comment_box'+comment._id" style="display:none;">
		        	<textarea :class="'form-control comment_area'+comment._id" :id="comment._id" onkeypress="commentUpdate(event , this.id, this.value)">{{ comment.comment }}</textarea>
		        	<a href="javascript:void(0)" class="cancel_box" :id="comment._id" @click="box_comment_cancel()">Cancel</a>
		        	
		        </div>
		        <div class="loader" :id="'loader-update'+comment._id" style="display:none"><span><img :src="url+'/public/loader.gif'"></span></div>
		        <!-- sub comment section start -->
		        <div class="sub_comment_section">
		        	<subComment :sub_comments="comment.post_sub_comment" :commentId="comment._id" :authInfo="authInfo"></subComment>   
		        </div>
		        <!-- sub comment section end -->
		      </div>
		      <div class="col-sm-1 col-xs-1 no_padding">
		        <div class="dropdown" v-if="comment.fk_user_id == authId">
		          <a class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		            ...
		          </a>
		          <div class="dropdown-menu post_edit_btn ">
		            <!-- edit section -->
		            <a class="dropdown-item show-dialog-pop" :id="comment._id" onclick="editComment(this.id)">Edit</a>
		            
		            <!-- delete section -->
		            <a class="dropdown-item show-dialog-pop" :id="comment._id" onclick="Delete(this.id)">Delete</a>
		          
		          </div>
		          <!-- edit modal -->
		          <!-- start delete comment -->
					<deleteModal :id="comment._id" :title="title" :route_name="route_name" :remove_div="remove_div"></deleteModal>
		          <!-- delete modal -->
		        </div>
		      </div>
		    </div>
		    <div class="loader" :id="'loader'+postId" style="display:none"><span><img :src="url+'/public/loader.gif'"></span></div>
		    
		  </div>
		  
		</div>
		<div class="row">
			<div class="comment_add_section">
	        	<a v-if="commentTyping !== '' && postId==commentTyping" class="typing comment-typing" rel="tooltip" data-toggle="tooltip" data-placement="top" :title="typing">
                    <div class="progress container">
                      <span></span>
                      <span></span>
                      <span></span>
                    </div>
	          		<span class="badge badge-primary" style="margin-left: 9%; margin-bottom: 5px;"> A traveler is typing a comment</span>
                </a>
	          <div class="footer_section_comment" :id="'comment_box'+postId">
	            <div class="col-sm-2 col-xs-3  post_activity_left">
	              <div class="profile">
	                
	                <img class="min_profile_home" :src="userProfilePath+authInfo.profile_image" :alt="authInfo.fullname">

	              </div> 
	            </div>
	            <div class="col-sm-9 col-xs-9 res_ml_10 post_activity_right no_padding">
	              <div class="comment">
	                <div class="form-group">
	                  <textarea v-model="postTyping" v-on:keydown="inputKeypress" @keydown="commentPost" :name="index" :class="'form-control post-comment comment-box'+postId" :id="postId" :user="authId" placeholder="Write a comment..."></textarea>
	                </div>   
	              </div>
	            </div>
	            
	          </div>  
	        </div><!-- -->
		</div>
	</div>
</template>

<script>
	import userLink from './UserLink.vue';
	import deleteModal from './DeleteModal.vue';
	import subComment from './SubComment.vue';
	import commentLike from './CommentLike.vue';
	export default {
		data() {

            return {
            	url:$("#base_url").val(),
            	userProfilePath: $("#base_url").val()+"/images/users/profile/s80",
                authId:$("#authId").val(),
                title: 'Post comment',
                route_name: 'post-comment',
                remove_div: 'si_com_',
                key:'',
                typingId:'',
                postTyping:'',
                commentTyping:'',
                comments:[],
                lastComment:'',
                updateData:'',
                limit:'5',

                
            }
        },

        props:['postId','comments','authInfo'],
        computed: {
			limitComments(){
				
				if(this.comments.length >= this.limit){
			    	return this.comments.slice(this.comments.length-this.limit, this.comments.length);
			    	
			    }else{
			    	return this.comments;
			    }
			}

		},
        methods:{
            
            formatTime (time) {
                let previousTime = moment(time,'YYYY-MM-DD HH:mm:ss').format('x');
                let timeDifference = moment(previousTime,'x').fromNow();
                return timeDifference;

                
            },
            inputKeypress(e){
        		var postId = e.path[0].id;
        		var key = e.key;
        		this.key=key;
        		this.typingId=postId;   
        	},
        	scrollToEnd: function() {
	            var container = document.querySelector("#content-chat");
	            var scrollHeight = container.scrollHeight;
	            container.scrollTop = scrollHeight;
	        },
        	//

        	//postcomment section
        	commentPost(e){
        		if (e.keyCode === 13 && !e.shiftKey) {
	        		var postId = e.path[0].id;
	        		var index = e.path[0].name;
	        		var comment = this.postTyping;
	        		
	        		if(comment !== " "){
	        			$("#loader"+this.postId).css('display','block');
	        			$("#comment_box"+this.postId).css('display','none');
	        			let commentData = {
		                    fk_post_id:postId,
		                    comment: comment,
		                    type:4,
		                };

		                axios.post(this.url+'/post-comment',commentData).then( response=> {
		                    this.comments.push(response.data);
		                    this.postTyping = "";
		                    $("#loader"+this.postId).css('display','none');
		          			$("#comment_box"+this.postId).css('display','block');
		          			this.lastComment = response.data._id;
		          			//

		                    this.$nextTick(() => {
			                    this.scrollToEnd();
			                });
		                });
		                
	        		}else{

	        		}

	        		Echo.private('comment')
			    	.listen('Comments',(e)=>{
			    		//console.log(e.PostComment._id);
		            	this.comments.push(e.PostComment); 

		            	
		                this.$nextTick(() => {
		                    this.scrollToEnd();
		                });   
		            });
			    }
        	},

        	box_comment_cancel(){
        		$(".comment_box_section").css('display','block');
    			$(".update_comment_box").css('display','none');
        	},

        	innerText(description){
        		return description.replace(/(?:\r\n|\r|\n)/g, '<br />');
        	},
        	load_comment(){
        		this.limit = this.comments.length;
			},

        	
            
        },
        watch:{
	    	postTyping(){
        		Echo.private('comment')
				    .whisper('commentTyping', {
				        postId: this.typingId,
				        name: this.key,
				    });
				    
        	},
	    },
        components:{
        	deleteModal,subComment,commentLike,userLink
        },
        
        
        mounted(){
	    	Echo.private('comment')
		    .listenForWhisper('commentTyping', (e) => {
		        if(e.name != '' && e.name !='Backspace' && e.name != 'Enter'){
		        	this.commentTyping = e.postId;
		        }else{
		        	this.commentTyping = '';
		        }
		    });

		    
		    
		    //$("#post-comment-right"+this.lastComment).addClass('highlighted');
  			//$(".si_com_"+response.data._id).addClass('highlighted');
	        // setTimeout(function () {
	        //     $('div.highlightable').removeClass('highlighted');
	        // }, 2000);
	        //
		    
	    },
	    updated() {
	        this.scrollToEnd();
	    }
        
        

    }
</script>