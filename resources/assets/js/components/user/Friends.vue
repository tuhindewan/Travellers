<template>
    <div>
        <div class="col-md-12" style="padding-left: 6px;">

            <div class="panel panel-default" style="margin-top: 6px;">
              <div class="panel-heading"><i class="fa fa-users"></i>  Friends</div>
              <div class="panel-body">
                <div class="row" style="padding: 0px 30px;">
  
                  <div class="col-md-6" v-for="friend in friends" :id="'user'+friend._id">
                    <div class="single_friend_section">
                      <div class="row">
                        <div class="col-md-3">
                          <div class="friend_profile">
                            <img :src="userProfilePath+friend.profile_image">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="friend_name">
                            
                            <userLink :userinfo="friend"></userLink>
                            <p>
                              <i class="fa fa-home"></i>
                              <span>Lives in 
                              <a v-if="friend.current_city" class="capitalize">{{ friend.current_city.city_name }}</a></span>
                            </p>
                          </div>
                          <div>
                            
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="friend-btn">
                            <relationship class="pull-right" :userid="friend._id"></relationship>
                          </div>
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
  import relationship from './../feed/Relationship.vue';
  import userLink from './../feed/UserLink.vue';
	export default {

		props:['userInfo','authInfo'],
        data() {

            return {
                url:$("#base_url").val(),
                userProfilePath: $("#base_url").val()+"/images/users/profile/s160",
                authId:$("#authId").val(),
                friends:[],
                myFriends:[]

                
                
                
            }
        },
        components:{
          userLink,relationship
        },
        methods:{
        	formatTime (time) {
                let previousTime = moment(time,'YYYY-MM-DD HH:mm:ss').format('x');
                let timeDifference = moment(previousTime,'x').fromNow();
                return timeDifference;
            } ,

            getFriends(){
              var userId = $("#uId").val();
              
              //get user friends
              // axios.get(this.url+'/user-wise-friends/'+userId).then( response=> {
              //     this.friends = response.data;

                  
              // });

              axios.get(this.url+'/user-friends/'+userId).then( response=> {
                  //console.log(response.data);
                  this.friends = response.data;
              });

              //get my friends
              axios.get(this.url+'/user-friends-list').then( response=> {
                  this.myFriends = response.data;

                  
              });
            },
            unfriend(id){
              axios.post(this.url+'/relationship-remove/'+id).then( response=> {
                  
                  if(response.data == 1){
                    $("#user"+id).remove();
                  }

                  
              });  
            }
            
            
        },
        
        

        mounted(){
	    	
          this.getFriends();
		    
	    }
    }
</script>
