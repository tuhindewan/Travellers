<template>
	<div>
		<div class="col-md-2 col-sm-12 col-xs-12">
			<div class="tabbable tabs-left res_w_100" style="width:14%; position:fixed;">
				<ul class="nav nav-tabs " role="tablist" style="width: 100%; height: auto;">
					
					<router-link tag="li" :to="{ name: 'general' }">
						<a class="radius"><img style="width:20px;" src="https://png.icons8.com/office/40/000000/edit-user-male.png">General</a>
					</router-link>
					<router-link tag="li" :to="{ name: 'security' }">
						<a class="radius" ><img style="width:20px;" src="https://png.icons8.com/doodle/40/000000/security-checked.png">Security</a>
					</router-link>
					
				</ul>
			</div>
 		</div>
 		<div class="col-md-7 col-sm-12 col-xs-12 no_padding res_div_scroll">
			<div class="newsletter-scroll">
				

				<div class="news-scetion">
		        	<router-view></router-view>	   
		        </div>
			    
			</div>
		    
 		</div>
 		
	</div>
</template>

<script>

    import General from './General.vue';
    import Security from './Security.vue';
    
    import VueRouter from 'vue-router';
    //Vue.use(VueRouter);
    const router = new VueRouter({
        mode: 'history',
        routes: [
            {
                path: '/travel-project/settings'+'/security',
                name: 'security',
                component: Security,
            },
            {
                path: '/travel-project/settings',
                name: 'general',
                component: General,
            },
            
        ],
        linkActiveClass:'active_tab'
    });
    //export default router;
    export default {
        data() {

            return {
            	
                url:$("#base_url").val(),
                 
            }
        },
        router,
        components:{
        	
        },
        computed: {
          
        },
        methods:{
           
            
            
        },
        
        
        mounted() {
           
        }
    }
</script>