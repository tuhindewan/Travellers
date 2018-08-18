<template>
	<div v-if="imageId">
		<div class="row">
		  
		  <div class="view_previous_comment" v-if="comments.length >=5" :id="'view-previous-comment'+imageId">
		    <a href="javascript: void(0)" class="previous_comment" :id="'all_comment'+imageId" onclick="previous_comment_load(this.id)">View previous comments</a>
		  </div>
		  
		  <div class="show_comment_limit show_comment" :id="'show-comment-limit'+imageId">
		    <div v-for="comment in limitComments" :class="'post_comment_content si_com_'+comment._id" :id="'si_com_'+comment._id">
		  
		      <div class="col-sm-2 col-xs-2">
		        <div class="posted_profile">
		            <img :src="userProfilePath+comment.users.profile_image">
		        </div>
		      </div>
		      <div class="col-sm-9 col-xs-8 no_padding" :id="'post-comment-right'+comment._id">
		        <div class="comment_box_section" :id="'comment_right'+comment._id">
		        	<div class="post_comment_top">
  			          
  			          <userLink :userinfo="comment.users"></userLink>
  			          <strong :id="'comment-body-content'+comment._id" v-html="innerText(comment.comment)"> </strong>
  			        </div>
  			        <div class="post_comment_bottom" style="margin-bottom:7px;">
  			          <imgCommentLike :commentId="comment._id" :imgCommentLike="comment.image_comment_like"></imgCommentLike> . <a href="javascript: void(0)" :id="'comment'+imageId" onclick="clickComment(this.id)"> Reply</a> . {{ formatTime(comment.created_at) }}
  			        </div>
		        </div>
		        <div class="update_comment_box" :id="'update_comment_box'+comment._id" style="display:none;">
		        	<textarea :class="'form-control comment_area'+comment._id" :id="comment._id" onkeypress="commentUpdate(event , this.id, this.value)">{{ comment.comment }}</textarea>
		        	<a href="javascript:void(0)" class="cancel_box" :id="comment._id" onclick="box_cancel(this.id)">Cancel</a>
		        	
		        </div>
		        <div class="loader" :id="'loader-update'+comment._id" style="display:none"><span><img :src="url+'/public/loader.gif'"></span></div>
		        
		      </div>
		      
		      <div class="col-sm-1 col-xs-2 no_padding">
		        <div class="dropdown" v-if="comment.fk_user_id == authId">

		          <a class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 2px 5px;">
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
		    <div class="loader" :id="'loader'+imageId" style="display:none"><span><img :src="url+'/public/loader.gif'"></span></div>
		    
		  </div>
		  
		</div>
		<div class="row">
			<div class="comment_add_section">
	        	<a v-if="commentTyping !== '' && imageId==commentTyping" class="typing comment-typing" rel="tooltip" data-toggle="tooltip" data-placement="top" :title="typing">
                    <div class="progress container">
                      <span></span>
                      <span></span>
                      <span></span>
                    </div>
	          		<span class="badge badge-primary" style="margin-left: 9%; margin-bottom: 5px;"> A Friend is typing a comment</span>
                </a>
	          <div class="footer_section_comment" :id="'comment_box'+imageId">
	            <div class="col-sm-2 col-xs-2">
	              <div class="profile">
	                
	                <img v-if="authInfo.profile_image" class="min_profile_home" :src="userProfilePath+authInfo.profile_image" :alt="authInfo.fullname">

	              </div> 
	            </div>
	            <div class="col-sm-9 col-xs-9 post_activity_right no_padding">
	              <div class="comment">
	                <div class="form-group">
	                  <textarea v-model="imgCommentTyping" v-on:keydown="inputKeypress" @keydown="commentImage" :name="index" :class="'form-control post-comment comment-box'+imageId" :id="imageId" :user="authId" placeholder="Write a comment..."></textarea>
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
	import imgCommentLike from './ImageCommentLike.vue';
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
                imgCommentTyping:'',
                commentTyping:'',
                comments:[],
                
                updateData:'',
                limit:'5',
                
            }
        },
		
        props:['imageId','comments','authInfo'],
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
        		var imageId = e.path[0].id;
        		var key = e.key;
        		this.key=key;
        		this.typingId=imageId;   
        	},
        	scrollToEnd: function() {
	            var container = document.querySelector("#content-chat");
	            var scrollHeight = container.scrollHeight;
	            container.scrollTop = scrollHeight;
	        },
        	//
        	innerText(description){
        		return description.replace(/(?:\r\n|\r|\n)/g, '<br />');
        	},
        	load_comment(){
        		this.limit = this.comments.length;
			},
        	//postcomment section
        	commentImage(e){
        		if (e.keyCode === 13 && !e.shiftKey) {
	        		var imageId = e.path[0].id;
	        		var index = e.path[0].name;
	        		var comment = this.imgCommentTyping;
	        		
	        		if(comment !== " "){
	        			$("#loader"+this.imageId).css('display','block');
	        			$("#comment_box"+this.imageId).css('display','none');
	        			let commentData = {
		                    fk_image_id:imageId,
		                    comment: comment,
		                    comment_by:0,
		                };

		                axios.post(this.url+'/post-image-comment',commentData).then( response=> {
		                    this.comments.push(response.data);
		                    this.imgCommentTyping = "";
		                    $("#loader"+this.imageId).css('display','none');
		          			$("#comment_box"+this.imageId).css('display','block');
		          			
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
            
        },
        watch:{
	    	imgCommentTyping(){
        		Echo.private('comment')
				    .whisper('commentTyping', {
				        imageId: this.typingId,
				        name: this.key,
				    });
				    
        	},
	    },
        components:{
        	deleteModal,imgCommentLike, userLink
        },
        
        
        mounted(){
	    	Echo.private('comment')
		    .listenForWhisper('commentTyping', (e) => {
		        if(e.name != '' && e.name !='Backspace' && e.name != 'Enter'){
		        	this.commentTyping = e.imageId;
		        }else{
		        	this.commentTyping = '';
		        }
		    });
		    
		    
	    },
	    updated() {
	        this.scrollToEnd();
	    }
        
        

    }
</script>