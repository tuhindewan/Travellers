<template>

    <div class="res_mlr_5">
        <div class="user_tab">
            <div class="cover-info">
                
                <ul class="cover-nav">
                    <router-link tag="li" :to="{ name: 'timeline' }">
                      <a><i class="fa fa-fw fa-bars"></i> Timeline</a>
                    </router-link>
                    <router-link tag="li" :to="{ name: 'about' }">
                      <a class="about"><i class="fa fa-fw fa-user"></i> About</a>
                    </router-link>
                    <router-link tag="li" :to="{ name: 'friends' }">
                      <a class="friends"><i class="fa fa-fw fa-users"></i> Friends</a>
                    </router-link>
                    <router-link tag="li" :to="{ name: 'photos' }">
                      <a class="photos"><i class="fa fa-fw fa-image"></i> Photos</a>
                    </router-link>
                    <!-- <router-link tag="li" :to="{ name: 'videos' }">
                      <a class="videos"><i class="fa fa-fw fa-video"></i> Videos </a>
                    </router-link> -->
                </ul>
            </div>
        </div>

        <div class="user_info_body_section">
            <router-view :userInfo="userInfo" :authInfo="authInfo"></router-view>
        </div>
    </div>


</template>
<script>

    import Timeline from './Timeline.vue';
    import About from './About.vue';
    import Friends from './Friends.vue';
    import Photos from './Photos.vue';
    import Videos from './Videos.vue';

    import VueRouter from 'vue-router';
    //Vue.use(VueRouter);
    const router = new VueRouter({
        mode: 'history',
        routes: [
            
            
            {
                path: '/travel-project/'+$("#uName").val()+'&timeline=suggestions',
                name: 'timelinetimeline=suggestions',
                component: Timeline,
            },
            {
                path: '/travel-project/'+$("#uName").val()+'&timeline=plans',
                name: 'timeline=plans',
                component: Timeline,
            },
            {
                path: '/travel-project/'+$("#uName").val()+'&timeline=questions',
                name: 'timeline=questions',
                component: Timeline,
            },
            {
                path: '/travel-project/'+$("#uName").val(),
                name: 'timeline',
                component: Timeline,
            },
            // {
            //     path: '/travel-project/'+$("#uName").val()+'/about&section=personal-information',
            //     name: 'personal-information',
            //     component: About,
            // },
            {
                path: '/travel-project/'+$("#uName").val()+'/about&section=bio',
                name: 'bio',
                component: About,
            },
            {
                path: '/travel-project/'+$("#uName").val()+'/about&section=places-visited',
                name: 'places-visited',
                component: About,
            },
            {
                path: '/travel-project/'+$("#uName").val()+'/about',
                name: 'about',
                component: About,
            },
            {
                path: '/travel-project/'+$("#uName").val()+'/friends',
                name: 'friends',
                component: Friends,
            },
            {
                path: '/travel-project/'+$("#uName").val()+'/photos',
                name: 'photos',
                component: Photos,
            },
            {
                path: '/travel-project/'+$("#uName").val()+'/videos',
                name: 'videos',
                component: Videos,
            },
        ],
        linkActiveClass:'active'
    });
    //export default router;
    export default {
        data() {

            return {
                url:$("#base_url").val(),
                userInfo:'',
                authInfo:'',
                uId:''
                
                
            }
        },
        router,
        
        methods:{
            getUser(){
                this.uId=$("#uId").val(),
                axios.get(this.url+'/auth-info').then( response=> {
                    this.authInfo=response.data;
                });

                //get user id wise info
                axios.get(this.url+'/user/'+this.uId).then( response=> {
                    this.userInfo = response.data;
                    
                });

            }   
            
            
        },
        
        
        mounted() {
           this.getUser()
        }
    }
</script>