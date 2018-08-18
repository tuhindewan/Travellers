<template>
    <div>
        <div class="col-md-12" style="padding-left: 6px;">

            <div class="panel panel-default" style="margin-top: 6px;">
              <div class="panel-heading"><i class="fa fa-user"></i>  About</div>
              <div class="panel-body">
                <div class="row" style="padding: 0px 5%;">
                    
                  <!-- tabs left -->
                  <div class="tabbable tabs-left">
                    <ul class="nav nav-tabs">
                      <!-- <router-link tag="li" :to="{ name: 'overview' }" @click.native="changeMap('')">
                        <a class="about_tab">Overview</a>
                      </router-link> -->

                      <router-link tag="li" :to="{ name: 'personal-information' }" @click.native="changeMap('')">
                        <a>Personal Information</a>
                      </router-link>

                      <router-link tag="li" :to="{ name: 'bio' }" @click.native="changeMap('')">
                        <a class="about_tab">Bio</a>
                      </router-link>

                      <router-link tag="li" :to="{ name: 'places-visited' }" @click.native="changeMap('')">
                        <a class="about_tab">Places You've Visited</a>
                      </router-link>
                    </ul>
                    <div class="tab-content">
                      <router-view :userInfo="userInfo" :authInfo="authInfo" :visitPlaces="visitPlaces" :getPostVisited="getPostVisited"></router-view>  
                    </div>
                </div>
                  <!-- /tabs -->
                      
              </div>
            </div>    
        </div>   
    </div>

    
</div>
</template>

<script>
    import Overview from './about/Overview.vue';
    import PersonalInformation from './about/PersonalInformation.vue';
    import Bio from './about/Bio.vue';
    import PlacesVisited from './about/PlacesVisited.vue';

    import VueRouter from 'vue-router';
    //Vue.use(VueRouter);
    const router = new VueRouter({
        mode: 'history',
        routes: [
            
            // {
            //     path: '/travel-project/'+$("#uName").val()+'/about',
            //     name: 'overview',
            //     component: Overview,
            // },
            /*{
                path: '/travel-project/'+$("#uName").val()+'/about&section=personal-information',
                name: 'personal-information',
                component: PersonalInformation,
            },*/
            {
                path: '/travel-project/'+$("#uName").val()+'/about',
                name: 'personal-information',
                component: PersonalInformation,
            },
            {
                path: '/travel-project/'+$("#uName").val()+'/about&section=bio',
                name: 'bio',
                component: Bio,
            },
            {
                path: '/travel-project/'+$("#uName").val()+'/about&section=places-visited',
                name: 'places-visited',
                component: PlacesVisited,
            },
            
        ],
        linkActiveClass:'active'
    });
	export default {

        data() {

            return {
                url:$("#base_url").val(),
                userProfilePath: $("#base_url").val()+"/images/users/",
                authId:$("#authId").val(),
                authInfo:{},
                userInfo:{},
                visitPlaces:[],
                getPostVisited:[]
                
            }
        },
        router,
        methods:{
        	
            
            
        },
        
        

        mounted(){
	    	
          this.uId=$("#uId").val(),
          axios.get(this.url+'/auth-info').then( response=> {
              this.authInfo=response.data;
          });

          //get user id wise info
          axios.get(this.url+'/user/'+this.uId).then( response=> {
              this.userInfo = response.data;
              
          });

          axios.get(this.url+'/user-wise-markers/'+this.uId+'/4').then( response=> {
            //console.log(this.userInfo._id);           
                       
            this.visitPlaces = response.data;
          });

          axios.get(this.url+'/user-wise-type-post/'+this.uId+'/4').then( response=> {
          //console.log(this.userInfo._id);           
                     
          this.getPostVisited = response.data;
        });
		    
	    }
    }
</script>
<style>

/* custom inclusion of right, left and below tabs */
.tabs-left .nav-tabs{width: 25%; float: left;}
.tabs-left .tab-content{width: 72%; float: right;}
.basic_info_content li{float: left;}
.basic_info_content li:last-child{float: right;}
.tabs-below > .nav-tabs,
.tabs-right > .nav-tabs,
.tabs-left > .nav-tabs {
  border-bottom: 0;
}

.tab-content > .tab-pane,
.pill-content > .pill-pane {
  display: none;
}

.tab-content > .active,
.pill-content > .active {
  display: block;
}

.tabs-below > .nav-tabs {
  border-top: 1px solid #ddd;
}

.tabs-below > .nav-tabs > li {
  margin-top: -1px;
  margin-bottom: 0;
}

.tabs-below > .nav-tabs > li > a {
  -webkit-border-radius: 0 0 4px 4px;
     -moz-border-radius: 0 0 4px 4px;
          border-radius: 0 0 4px 4px;
}

.tabs-below > .nav-tabs > li > a:hover,
.tabs-below > .nav-tabs > li > a:focus {
  border-top-color: #ddd;
  border-bottom-color: transparent;
}

.tabs-below > .nav-tabs > .active > a,
.tabs-below > .nav-tabs > .active > a:hover,
.tabs-below > .nav-tabs > .active > a:focus {
  border-color: transparent #ddd #ddd #ddd;
}

.tabs-left > .nav-tabs > li,
.tabs-right > .nav-tabs > li {
  float: none;
}

.tabs-left > .nav-tabs > li > a,
.tabs-right > .nav-tabs > li > a {
  min-width: 74px;
  margin-right: 0;
  margin-bottom: 3px;
}

.tabs-left > .nav-tabs {
  float: left;
  margin-right: 19px;
  border-right: 1px solid #ddd;
}

.tabs-left > .nav-tabs > li > a {
  margin-right: -1px;
  -webkit-border-radius: 4px 0 0 4px;
     -moz-border-radius: 4px 0 0 4px;
          border-radius: 4px 0 0 4px;
}

.tabs-left > .nav-tabs > li > a:hover,
.tabs-left > .nav-tabs > li > a:focus {
  border-color: #eeeeee #dddddd #eeeeee #eeeeee;
}

.tabs-left > .nav-tabs .active > a,
.tabs-left > .nav-tabs .active > a:hover,
.tabs-left > .nav-tabs .active > a:focus {
  border-color: #ddd transparent #ddd #ddd;
  *border-right-color: #ffffff;
}

.tabs-right > .nav-tabs {
  float: right;
  margin-left: 19px;
  border-left: 1px solid #ddd;
}

.tabs-right > .nav-tabs > li > a {
  margin-left: -1px;
  -webkit-border-radius: 0 4px 4px 0;
     -moz-border-radius: 0 4px 4px 0;
          border-radius: 0 4px 4px 0;
}

.tabs-right > .nav-tabs > li > a:hover,
.tabs-right > .nav-tabs > li > a:focus {
  border-color: #eeeeee #eeeeee #eeeeee #dddddd;
}

.tabs-right > .nav-tabs .active > a,
.tabs-right > .nav-tabs .active > a:hover,
.tabs-right > .nav-tabs .active > a:focus {
  border-color: #ddd #ddd #ddd transparent;
  *border-left-color: #ffffff;
}

</style>