<template>
	
	<div id="comment_like_section" style="display:inline">
      	<a v-if="likers" class="liked"  @click="like"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Like</a>

		<a v-else class="like" @click="like"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Like</a>
		
       	( {{ imgCommentLike.length }} )
      </div>
	
</template>
<script>
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

	    watch:{
        	    

        },
		
        props:['commentId','imgCommentLike'],

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
                    fk_comment_id:this.commentId,
                    fk_user_id:this.authId,
                    status: status,
                    liked_by:0
                };

                //console.log(data);

                axios.post(this.url+'/image-comment-like',likeData).then( response=> {
                	//console.log(response.data);
                    this.imgCommentLike = response.data;
                });

       //          Echo.private('imgCommentLike')
		    	// .listen('imgCommentLike',(e)=>{
	      //       	this.imgCommentLike = e.imgCommentLike;    
	      //       });
                
        	},
        	
        },
        mounted(){
	    	
		    
	    },
        
        computed:{

        	likers(){
        		var likers = [];
				var count = 0;
        		if(this.imgCommentLike){
                    this.imgCommentLike.forEach( (like)=>{
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