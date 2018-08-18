<template>
	<div>
		
        <div v-if="post" class="panel panel-default" style="margin-bottom:5px">
		  	<div :class="'panel-body post_section_'+post._id" >
		    	<div class="single_post_top">
					<div class="user_profile">
				        <img v-if="post.users.profile_image" :src="userProfilePath+post.users.profile_image">
				    </div>
				   	<div class="user_info">
				        <userLink :userinfo="post.users"></userLink>
				        <div>
				        	
				        	<a :href="url+'/'+post.users.username+'/posts/'+post._id" class="show_time">{{ formatTime(post.created_at) }}</a> 
				        </div>
				    </div>
				    <div class="post_changeable" v-if="post.fk_user_id == authId">
				    	<div class="dropdown">
							<button type="button" class="btn dropdown-toggle change_drop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    ...
							</button>
						  	<div class="dropdown-menu change_dropdown post_edit_btn" aria-labelledby="dropdownMenuButton">
							    <a class="dropdown-item show-dialog-pop" :id="'post-ed'+post._id" onclick="singlePostEdit(this.id)">Edit</a>
				              
				              	<a class="dropdown-item show-dialog-pop" :id="post._id" onclick="Delete(this.id)">Delete</a>
						  	</div>
						  <!-- edit modal section -->
						  	<editModal :post="post"></editModal>
						  <!-- end edit post -->
						  <!-- start delete post -->
						  	<deleteModal :id="post._id" :title="title" :route_name="route_name" :remove_div="remove_div"></deleteModal>
						  <!-- end delete post -->
						</div>
				    </div>
			    </div><!--  end top -->
			    <div :class="'single_post_body post-body'+post._id">
			      <div class="post_description" :id="'post-content-text'+post._id" >
			        {{ post.description }}
			      </div>
			      <div v-if="post.post_image.length > 0">
									
					<photo-grid :box-height="'200px'" :box-width="'100%'" :excess-text="'+ {{count}}'" @clickExcess="triggerClick(post.users, post.post_image)">
				      <img @click="singleImage(index, post.users, image)" v-for="(image, index) in post.post_image" v-bind:src="url+'/images/post/photo/thum/'+image.images" />
				  	</photo-grid>
				  </div>
				  <imageModal :show="showModal" :postUser="postUser" :imageInfo="imageInfo" @close="showModal = false" :next="nextPost" :pre="prePost" :postImage="post.post_image" :postTime="post.created_at"></imageModal>
					
			      
			    </div><!-- end body -->
			    <hr>
			    <div class="single_post_bottom">
			      
			      <div class="like_comment_section">
			        <like :post="post" :post_like="post.post_like"></like>
			        <hr>
			        <!-- post comment show section start -->
			        <div class="show_post_comment">
						<comments :postId="post._id" :comments="post.post_comment" :authInfo="authInfo"></comments>
			        </div>
			        <!-- post comment show section end -->
			        
			      </div>
			    </div>
			</div>
		</div>
  	        
	</div>
</template>

<script>
	import like from './../feed/LikeCommentCount.vue';
	import editModal from './../feed/PostEditModal.vue';
	import deleteModal from './../feed/DeleteModal.vue';
	import comments from './../feed/PostComment.vue';
	import userLink from './../feed/UserLink.vue';
	import imageModal from './../feed/ImageModel.vue';

	export default {

        data() {

            return {
                url:$("#base_url").val(),
                userProfilePath: $("#base_url").val()+"/images/users/profile/s160",
                authId:$("#authId").val(),
                key:'',
                typingId:'',
                postTyping:[],
                commentTyping:'',
                title: 'Post',
                route_name: 'user-post',
                post_comment:[],
                remove_div:'post_section_',
                authInfo:{},
                showModal: false,
                postUser:{},
                nextPost:'',
                prePost:'',
                imageInfo:{}, 
  
            }
        },
        props:['post'],
        methods:{
        	formatTime (time) {
                let previousTime = moment(time,'YYYY-MM-DD HH:mm:ss').format('x');
                let timeDifference = moment(previousTime,'x').fromNow();
                return timeDifference;
            } ,
            

        	triggerClick(postUser, postImage){
        		this.postUser = postUser;
        		this.imageInfo = postImage[3];
        		this.nextPost = 4;
        		this.prePost = 2;
        		this.showModal = true;
        	},
        	singleImage(ind, postUser, imageInfo){
        		
        		//console.log(postUser);
        		this.postUser = postUser;
        		this.imageInfo = imageInfo;
        		//console.log(imgId);
        		this.nextPost = ind+1;
        		this.prePost = ind-1;
        		
        		this.showModal = true;
        		
        	},

            
        },
        
        
        components:{
        	like,editModal,deleteModal,comments,imageModal,userLink
        },
        

        mounted(){
        	
            axios.get(this.url+'/auth-info').then( response=> {
                this.authInfo = response.data;
            });

		    
	    }
    }
</script>