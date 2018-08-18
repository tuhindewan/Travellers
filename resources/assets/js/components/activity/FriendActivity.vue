<template>
    <div class="activity">
       <div class="row announce-text-div" v-for="post in posts">
            <a :href="url+'/'+post.users.username+'/posts/'+post._id" style="width: 100%;overflow: hidden;color:white;" >
                <p class="list-group-item">
                    <div class="row">
                        
                        <div class="col-md-2 no_padding">
                            <img :src="userProfilePath+post.users.profile_image" class="img-responsive" style="border-radius:50%">
                        </div>
                        <div class="col-md-10">
                            <a :href="url+'/'+post.users.username"><b class="capitalize authName">{{ post.users.fullname }}</b></a>
                            <span class="description-aside">
                                <!-- <userLink :userinfo="post.users"></userLink> -->
                                
                                {{ getPostBody(post.description) }}</span>
                        </div>
                    </div>
                </p>
            </a>
        </div>
    </div>
</template>

<script>
    import userLink from './../feed/UserLink.vue';
    export default {
        data() {

            return {
                userProfilePath: $("#base_url").val()+"/images/users/profile/s160",
                url:$("#base_url").val(),
                posts:[],
                authInfo:'',
                
            }
        },
        components:{
            userLink
        },
        methods:{
            getPostBody (post) {
                return post.slice(0, 250) + (stop < post.length ? clamp || '...' : '')           
            },
            getPosts () {

                //get all post
                axios.get(this.url+'/friends-wise-post/20').then( response=> {
                    this.posts = response.data;
                    //console.log(response.data);
                    if(response.data.length===0){
                        axios.get(this.url+'/public-post/20').then( response=> {
                            this.posts = response.data;
                        });    
                    }
                    
                });
                    
                //get auth info
                axios.get(this.url+'/auth-info').then( response=> {
                    this.authInfo = response.data;
                });
                
            },
            /*scrollToEnd: function() {
                var container = document.querySelector(".announce-scroll");
                var scrollHeight = container.scrollHeight;
                container.scrollTop = scrollHeight;
            },
            
            formatTime (time) {
                let previousTime = moment(time,'YYYY-MM-DD HH:mm:ss').format('x');
                let timeDifference = moment(previousTime,'x').fromNow();
                return timeDifference;
            } ,*/
            
        },
        
        
        mounted() {
          this.getPosts();
            
        }
    }
</script>