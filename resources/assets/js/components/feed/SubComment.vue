<template>
	<div>
		<div :id="'show_sub_comment_box'+commentId">
		  <div v-if="sub_comments.length > 0">
		    <blockquote :class="'sub_code sub_comment_exi'+commentId">
		      <!-- show all sub comment section -->
		      <div :class="'show_sub_comment'+subComment._id" v-for="subComment in sub_comments">
		        
		          	<div class="single_sub_comment" :id="'si_sub_com_'+subComment._id">
		          		<div class="row">
		          			<div class="col-sm-2 col-xs-2 sub_comment_activity_left">
		  				        <div class="posted_profile">
		                    		<img :src="userProfilePath+subComment.users.profile_image" :alt="subComment.users.fullname">  
		  				        </div>
		  				    </div>
		                	
	    				    <div class="col-sm-8 col-xs-9 no_padding" :id="'post-sub-comment-right'+subComment._id">
	    				        <div class="subcomment_box_section" :id="'sub_comment_right'+subComment._id">
	    				        	<div class="sub_comment_top font13">

									  <userLink :userinfo="subComment.users"></userLink>
		    				          
		    				          <samp :id="'sub-comment-body-content'+subComment._id"  v-html="innerText(subComment.comment)"> </samp>
		    				        </div>
		    				        <div class="post_comment_bottom res_fs_8 ">
		    				          <a href="javascript: void(0)" :id="'comment_reply_box'+commentId" onclick="comment_reply_box(this.id)"> Reply</a> . {{ formatTime(subComment.created_at) }}
		    				        </div>
	    				        </div>
	    				        <div class="update_sub_comment_box" :id="'update_sub_comment_box'+subComment._id" style="display:none;">
						        	<textarea :class="'form-control sub_comment_area'+subComment._id" :id="subComment._id" onkeypress="subCommentUpdate(event , this.id, this.value)">{{ subComment.comment }}</textarea>
						        	<a href="javascript:void(0)" class="cancel_box" :id="subComment._id" onclick="box_cancel(this.id)">Cancel</a>
						        	
						        </div>
						        <div class="loader" :id="'loader-update'+subComment._id" style="display:none"><span><img :src="url+'/public/loader.gif'"></span></div>
	    				        
	    				    </div>
			                <div class="col-sm-2 col-xs-1 no_padding option_btn" :id="'sub_com_option'+subComment._id">
			                  
			                  <div class="dropdown" v-if="subComment.fk_user_id == authId">
			                    <a class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			                      ...
			                    </a>
			                    <div class="dropdown-menu post_edit_btn ">
			                      <a class="dropdown-item" :com-id="commentId" :id="subComment._id" onclick="singleSubCommentEdit(this.id)">Edit</a>

			                      <a class="dropdown-item show-dialog-pop" :id="subComment._id" onclick="Delete(this.id)">Delete</a>

			                    </div>
			                    
			                    <!-- start delete comment -->
									<deleteModal :id="subComment._id" :title="title" :route_name="route_name" :remove_div="remove_div"></deleteModal>
						        <!-- delete modal -->
			                    
			                  </div>
			                  
			                </div>
		          		</div>	
		          	</div>        
		        </div>

		        <div class="loader" :id="'loader'+commentId" style="display:none"><span><img :src="url+'/public/loader.gif'"></span></div>

		        <a v-if="subCommentTyping !== '' && commentId==subCommentTyping" class="typing comment-typing" rel="tooltip" data-toggle="tooltip" data-placement="top" :title="typing">
                    <div class="progress container">
                      <span></span>
                      <span></span>
                      <span></span>
                    </div>
	          		<span class="badge badge-primary" style="margin-left: 13%; margin-bottom: 5px;"> A traveler is typing a sub comment</span>
                </a>
		        <div class="row" :id="'sub_comment_add'+commentId">
		        	
				  <div class="col-sm-2 col-xs-3">
				    <div class="profile">
				      <img class="min_profile_home" :src="userProfilePath+authInfo.profile_image" :alt="authInfo.fullname">
				    </div>
				  </div>
				  <div class="col-sm-10 col-xs-9 no_padding">
				    <textarea :class="'form-control post-sub-comment sub_comment'+commentId" :id="commentId" v-model="commentTyping" v-on:keydown="inputKeypress" @keydown="subCommentPost" :name="index" :user="authId" placeholder="Write a sub comment..."></textarea>
				  </div>
				</div>
		      
		      <!-- show sub comment add box -->
		    </blockquote>
		  </div>
		  <div v-else>
		    <blockquote :class="'sub_code sub_comment_append'+commentId" style="display: none;">
		     
		        <div class="loader" :id="'loader'+commentId" style="display:none"><span><img :src="url+'/public/loader.gif'"></span></div>

		        <a v-if="subCommentTyping !== '' && commentId==subCommentTyping" class="typing comment-typing" rel="tooltip" data-toggle="tooltip" data-placement="top" :title="typing">
                    <div class="progress container">
                      <span></span>
                      <span></span>
                      <span></span>
                    </div>
	          		<span class="badge badge-primary" style="margin-left: 13%; margin-bottom: 5px;"> A traveler is typing a sub comment</span>
                </a>
		        <div class="row" :id="'sub_comment_add'+commentId">
		        	
				  <div class="col-sm-2">
				    <div class="profile">
				      <img class="min_profile_home" :src="userProfilePath+authInfo.profile_image" :alt="authInfo.fullname">
				    </div>
				  </div>
				  <div class="col-sm-10 no_padding">
				    <textarea :class="'form-control post-sub-comment sub_comment'+commentId" :id="commentId" v-model="commentTyping" v-on:keydown="inputKeypress" @keydown="subCommentPost" :name="index" :user="authId" placeholder="Write a sub comment..."></textarea>
				  </div>
				</div>
		    </blockquote>
		  </div>
		</div>
	</div>
</template>
<script>
	import userLink from './UserLink.vue';
	import deleteModal from './DeleteModal.vue';
	export default {
		props:['sub_comments','commentId','authInfo'],
        data() {

            return {
                url:$("#base_url").val(),
                userProfilePath: $("#base_url").val()+"/images/users/profile/s80",
                authId:$("#authId").val(),
                subCommentTyping:'',
                commentTyping:'',
                typingId:'',
                title: 'Sub Comment',
                route_name: 'post-sub-comment',
                remove_div: 'show_sub_comment',
                key:'',
                
                
                
            }
        },
        methods:{
        	formatTime (time) {
                let previousTime = moment(time,'YYYY-MM-DD HH:mm:ss').format('x');
                let timeDifference = moment(previousTime,'x').fromNow();
                return timeDifference;
            } ,
            scrollToEnd: function() {
	            var container = document.querySelector("#content-chat");
	            var scrollHeight = container.scrollHeight;
	            container.scrollTop = scrollHeight;
	        },
	        inputKeypress(e){
        		var commentId = e.path[0].id;
        		var key = e.key;
        		this.key=key;
        		this.typingId=commentId;   
        	},
        	subCommentPost(e){
	        	if (e.keyCode === 13 && !e.shiftKey) {
	        		var commentId = e.path[0].id;
	        		var comment = this.commentTyping;
	        		
	        		if(comment !== " "){
	        			$("#loader"+this.commentId).css('display','block');
	        			$("#sub_comment_add"+this.commentId).css('display','none');
	        			let commentData = {
		                    fk_post_comment_id:commentId,
		                    comment: comment,
		                };

		                axios.post(this.url+'/post-sub-comment',commentData).then( response=> {
		                	
		                    this.sub_comments.push(response.data);
		                    this.commentTyping = "";
		                    $("#loader"+this.commentId).css('display','none');
		          			$("#sub_comment_add"+this.commentId).css('display','block');
		          			//this.lastComment = response.data._id;
		          			//

		                    this.$nextTick(() => {
			                    this.scrollToEnd();
			                });
		                });
		                
	        		}else{

	        		}

	        		Echo.private('subComment')
			    	.listen('SubComments',(e)=>{
			    		//console.log(e.PostComment._id);
		            	this.sub_comments.push(e.subComment); 

		            	
		                this.$nextTick(() => {
		                    this.scrollToEnd();
		                });   
		            });
			    }
        	},
        	innerText(description){
        		return description.replace(/(?:\r\n|\r|\n)/g, '<br />');
        	},
            
        },
        watch:{
	    	commentTyping(){
        		Echo.private('subComment')
				    .whisper('subCommentTyping', {
				        commentId: this.typingId,
				        name: this.key,
				    });
				    
        	},
	    },
	    components:{
        	deleteModal,userLink
        },
        
        mounted(){
	    	Echo.private('subComment')
		    .listenForWhisper('subCommentTyping', (e) => {
		        if(e.name != '' && e.name !='Backspace' && e.name != 'Enter'){
		        	this.subCommentTyping = e.commentId;
		        }else{
		        	this.subCommentTyping = '';
		        }
		    });
		    
	    },
	    updated() {
	        this.scrollToEnd();
	    }
    }
</script>