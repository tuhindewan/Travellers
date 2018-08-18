<template>
	<div>
		<div class="col-md-2 hidden-xs">
			<div class="tabbable tabs-left" style="width:14%; position:fixed; background: #09506f;">
				<ul class="nav nav-tabs" role="tablist" style="width: 100%; height: auto;">
					
					<router-link tag="li" :to="{ name: 'experiences' }">
						<a class="radius" >Experiences</a>
					</router-link>
					<router-link tag="li" :to="{ name: 'plans' }">
						<a class="radius" >Plans</a>
					</router-link>
					<router-link tag="li" :to="{ name: 'suggestions' }">
						<a class="radius">Suggestions</a>
					</router-link>
					<router-link tag="li" :to="{ name: 'questions' }">
						<a class="radius">Questions</a>
					</router-link>
				</ul>
			</div>
 		</div>
 		<div class="col-md-4 no_padding">
			    <div class="newsletter-scroll">
				<div class="newsletter-scroll-row">
					<!-- <a href="" data-toggle="modal" data-target="#myModal"><textarea class="form-control timeline_set_box_panel show-dialog" id="" rows="3" placeholder="What's on your mind?" style="z-index: -1;"></textarea></a> -->
					<a class="show-dialog-pop" id="post-com-ed" onClick="showPostModal()"><textarea class="form-control timeline_set_box_panel show-dialog" id="" rows="3" placeholder="What's on your mind?" style="z-index: -1;"></textarea></a>
					<createPost></createPost>

				</div>
			    
			</div>
		    
 		</div>
 		<div class="col-md-3 hidden-sm hidden-xs">
 			<div class="top_section">
 				<div class="experiences top_box">
	            	<div class="panel panel-default">
					  <div class="panel-body">
					    <p><b style="display: inline">Experiences </b><a class="text-right" style="float: right;">see all</a></p>

					    <div class="top_section_content">
					    	
					    	<div class="single_section" v-for="(popular,index) in topExperiencesPost.slice(0, 6)" v-if="popular.post_type === '4'">
					    		<hr>
					    		
					    		<div class="row">
						    		<div class="col-sm-2">
						    			<div class="author_img">
						    				<img :src="userProfilePath+popular.users.profile_image" alt="">
								    	</div>
						    		</div>
						    		<div class="col-sm-10 no_padding">
						    			<div class="postDescription">
						    				 
						    				<userLink :userinfo="popular.users"></userLink>
								    		<p> {{ popular.description }}</p>		
								    	</div>
						    		</div>
						    		<a :href="url+'/'+popular.users.username+'/posts/'+popular._id" class="show_time">{{ formatTime(popular.created_at) }}</a>
						    	</div>
					    	</div>
					    	

					    </div>
					  </div>
					</div>
	            </div>
	            
	            <div class="plans top_box">
	            	<div class="panel panel-default">
					  <div class="panel-body">
					    
					    <p><b style="display: inline">Plans </b><a class="text-right" style="float: right;">see all</a></p>
					    <div class="top_section_content">
					    	
					    	<div class="single_section" v-for="(popular,index) in topPlansPost.slice(0, 6)" v-if="popular.post_type === '3'">
					    		<hr>
				    		
					    		<div class="row">
						    		<div class="col-sm-2">
						    			<div class="author_img">
						    				<img :src="userProfilePath+popular.users.profile_image" alt="">
								    	</div>
						    		</div>
						    		<div class="col-sm-10 no_padding">
						    			<div class="postDescription">
						    				<userLink :userinfo="popular.users"></userLink> 
								    		<p> {{ popular.description }}</p>		
								    	</div>
						    		</div>
						    		<a :href="url+'/'+popular.users.username+'/posts/'+popular._id" class="show_time">{{ formatTime(popular.created_at) }}</a>
						    	</div>
					    	
					    	</div>
					    	

					    </div>
					  </div>
					</div>	
	            </div>
	            
	            <div class="suggestions top_box">
	            	<div class="panel panel-default">
					  <div class="panel-body">
					    <p><b style="display: inline">Suggestions </b><a class="text-right" style="float: right;">see all</a></p>
						<div class="top_section_content">
					    	
					    	<div class="single_section" v-for="(popular,index) in topSuggestionsPost.slice(0, 6)" v-if="popular.post_type === '1'">
					    		<hr>
					    		
					    		<div class="row">
						    		<div class="col-sm-2">
						    			<div class="author_img">
						    				<img :src="userProfilePath+popular.users.profile_image" alt="">
								    	</div>
						    		</div>
						    		<div class="col-sm-10 no_padding">
						    			<div class="postDescription">
						    				<userLink :userinfo="popular.users"></userLink> 
								    		<p> {{ popular.description }}</p>		
								    	</div>
						    		</div>
						    		<a :href="url+'/'+popular.users.username+'/posts/'+popular._id" class="show_time">{{ formatTime(popular.created_at) }}</a>
						    	</div>
					    	</div>
					    	

					    </div>
					  </div>
					</div>
	            </div>
	            
	            <div class="questions top_box">
	            	<div class="panel panel-default">
					  <div class="panel-body">
					    
					    <p><b style="display: inline">Questions </b><a class="text-right" style="float: right;">see all</a></p>
					    <div class="top_section_content">
					    	
					    	<div class="single_section" v-for="(popular,index) in topQuestionsPost.slice(0, 6)" v-if="popular.post_type === '2'">
					    		<hr>
					    		
					    		<div class="row">
						    		<div class="col-sm-2">
						    			<div class="author_img">
						    				<img :src="userProfilePath+popular.users.profile_image" alt="">
								    	</div>
						    		</div>
						    		<div class="col-sm-10 no_padding">
						    			<div class="postDescription">
						    				<userLink :userinfo="popular.users"></userLink> 
								    		<p> {{ popular.description }}</p>		
								    	</div>
						    		</div>
						    		<a :href="url+'/'+popular.users.username+'/posts/'+popular._id" class="show_time">{{ formatTime(popular.created_at) }}</a>
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
	import userLink from './../feed/UserLink.vue';
    import Plans from './../feed/Plans.vue';
    import Experiences from './../feed/Experiences.vue';
    import Suggestions from './../feed/Suggestions.vue';
    import Questions from './../feed/Questions.vue';
    import VueRouter from 'vue-router';
    import createPost from './../post/CreatePost.vue';
    //Vue.use(VueRouter);
    const router = new VueRouter({
        mode: 'history',
        routes: [
            {
                path: '/travel-project/connection',
                name: 'experiences',
                component: Experiences,
            },
            {
                path: '/travel-project/connection'+'/plans',
                name: 'plans',
                component: Plans,
            },
            
            {
                path: '/travel-project/connection'+'/suggestions',
                name: 'suggestions',
                component: Suggestions,
            },
            {
                path: '/travel-project/connection'+'/questions',
                name: 'questions',
                component: Questions,
            },
        ],
        linkActiveClass:'active_tab'
    });
    //export default router;
    export default {
        data() {

            return {
            	userProfilePath: $("#base_url").val()+"/images/users/profile/s160",
                url:$("#base_url").val(),
                posts:[],
                authInfo:'',
                topExperiencesPost:[],
                topPlansPost:[],
                topSuggestionsPost:[],
                topQuestionsPost:[]
                
            }
        },
        router,
        components:{
        	createPost,userLink
        },
        computed: {
          postProps() {
            return { posts: this.posts }
          }
        },
        methods:{
            scrollToEnd: function() {
                var container = document.querySelector("#content-chat");
                var scrollHeight = container.scrollHeight;
                container.scrollTop = scrollHeight;
            },
            getPosts () {

                if(this.url){
                	//get all post
	                axios.get(this.url+'/friends-wise-post').then( response=> {
	                    this.posts = response.data;
	                    //console.log(this.posts);
	                    this.$nextTick(() => {
	                        this.scrollToEnd();
	                    });
	                });
	                    
	                //get auth info
	                axios.get(this.url+'/auth-info').then( response=> {
	                    this.authInfo = response.data;
	                });

	                //topExperiencesPost
	                axios.get(this.url+'/popular-post/4').then( response=> {
	                    this.topExperiencesPost = response.data;
	                });

	                //topPlansPost
	                axios.get(this.url+'/popular-post/3').then( response=> {
	                    this.topPlansPost = response.data;
	                });

	                //topSuggestionsPost
	                axios.get(this.url+'/popular-post/1').then( response=> {
	                    this.topSuggestionsPost = response.data;
	                });

	                //topQuestionsPost
	                axios.get(this.url+'/popular-post/2').then( response=> {
	                    this.topQuestionsPost = response.data;
	                });
                }




                
            },
            formatTime (time) {
                let previousTime = moment(time,'YYYY-MM-DD HH:mm:ss').format('x');
                let timeDifference = moment(previousTime,'x').fromNow();
                return timeDifference;
            } ,
            
        },
        
        
        mounted() {
          this.getPosts();
          //console.log(this.posts);  
        }
    }
</script>