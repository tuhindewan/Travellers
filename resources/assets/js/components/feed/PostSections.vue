<template>
    <div>
        <router-link :to="{ name: 'experiences' }">
            <a class="experiences-transparent-button res_postsection_experience"><img src="http://localhost/travel-project/public/frontend/img/experiences.png" alt="" class="experiences-image res_postsection_xp_img"> Experiences</a>
        </router-link>
        <router-link :to="{ name: 'plans' }">
            <a class="semi-transparent-button res_postsection_plans"><img src="http://localhost/travel-project/public/frontend/img/plans.png" alt="" class="plan-image res_postsection_plans_img"> Plans</a>
        </router-link>
        
        <router-link :to="{ name: 'suggestions' }">
            <a class="suggestions-transparent-button res_postsection_suggestions"><img src="http://localhost/travel-project/public/frontend/img/suggestions.png" alt="" class="suggestions-image res_postsection_suggestions_img"> Suggestions</a>
        </router-link>
        <router-link :to="{ name: 'questions' }">
            
            <a class="questions-transparent-button res_postsection_questions"><img src="http://localhost/travel-project/public/frontend/img/questions.png" alt="" class="questions-image res_postsection_questions_img"> Questions</a>
        </router-link>

        <div class="post-section">
            <router-view v-bind="postProps" :authInfo="authInfo"></router-view>
        </div>
    </div>
</template>
<script>

    import Plans from './Plans.vue';
    import Experiences from './Experiences.vue';
    import Suggestions from './Suggestions.vue';
    import Questions from './Questions.vue';
    import VueRouter from 'vue-router';
    //Vue.use(VueRouter);
    const router = new VueRouter({
        mode: 'history',
        routes: [
            {
                path: '/travel-project/place/'+$("#place").val(),
                name: 'experiences',
                component: Experiences,
            },
            {
                path: '/travel-project/place/'+$("#place").val()+'/plans',
                name: 'plans',
                component: Plans,
            },
            
            {
                path: '/travel-project/place/'+$("#place").val()+'/suggestions',
                name: 'suggestions',
                component: Suggestions,
            },
            {
                path: '/travel-project/place/'+$("#place").val()+'/questions',
                name: 'questions',
                component: Questions,
            },
        ],
        linkActiveClass:'active'
    });
    //export default router;
    export default {
        data() {

            return {
                url:$("#base_url").val(),
                posts:[],
                placeId:$("#place").val(),
                authInfo:'',
                
            }
        },
        router,
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
                
                //get all post
                axios.get(this.url+'/place-wise-post/'+this.placeId).then( response=> {
                    this.posts = response.data;

                    this.$nextTick(() => {
                        this.scrollToEnd();
                    });
                });
                    
                //get auth info
                axios.get(this.url+'/auth-info').then( response=> {
                    this.authInfo = response.data;
                });

                //get all post like
                // axios.get(this.url+'/auth-info').then( response=> {
                //     this.authInfo = response.data;
                // });
                
            },
            
        },
        
        
        mounted() {
          this.getPosts();  
        }
    }
</script>