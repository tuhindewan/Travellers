<template>
    <div>
        <div class="user-log" v-if="onlineUsers">
        
            <div v-if="onlineUsers.length > 0" class="user-item" v-for="user in onlineUsers" :user="user" v-bind:key="user.id" @click="activateUser(user)" :id="user.id">
                <i v-if="user.activity === 1" class="fa fa-check-circle connected-status"></i> <i v-else-if="user.activity === '0'" class="fa fa-clock-o away-status"></i> <i v-else class="fa fa-clock-o away-status"></i> <img :src="user.image" class="img-chat" style="">&nbsp; {{ user.name }}
            </div>
            
        
        </div>
        <div v-else-if="onlineUsers.length == 0" disabled>No friends found</div>
         <div class="row chat-search">
            <input class="chat_search_box_panel form-control" placeholder="Search" name="srch-term" id="srch-term" type="text" v-model="friendSearch" v-on:keyup="autoComplete">
            <i class="fa fa-search" aria-hidden="true"></i>
            <a href="#settingModal" data-toggle="modal"><i class="fa fa-cog" aria-hidden="true"></i></a>
        </div>
    </div>
    

</template>

<script>
    export default {
        data() {

            return {
                default_image:$("#default_image").val(),
                users:[],
                url:$("#base_url").val(),
                onlineUsers:[],
                friendSearch: '',
                findFriends:[],
                
            }
        },
        methods:{
            activateUser (selectedUser) {

                this.$emit('getcurrentuser',{
                    userId:selectedUser.id
                });

                // show chat conversation
                var datashow = $(".activate-chat").show();
                //$(".activate-chat").css('display','none');
                //var chatTab=$(".activate-chat").html();
                //$("#show-tab").append(chatTab);
                $(".chat-info").hide();
                // to make clicked li active
                $(".user-log .active").removeClass("active");
                $("#"+selectedUser.id).addClass("active");
                $(".header-chat").html('<p class="header_user">'+selectedUser.name+'</p>');
                if(selectedUser.activity===1){
                    $("#activity-check").html('<i class="fa fa-dot-circle-o" aria-hidden="true"style="color:#42b72a"></i>');
                }else{
                    $("#activity-check").html('<i class="fa fa-dot-circle-o" aria-hidden="true"style="color:red;"></i>');
                }
                //$("#selectUserImage").attr('src',selectedUser.image_path);
                $("#selectUserName").html(selectedUser.name);

                //var datalog = $("#chat_user-"+selectedUser.id).html(datashow);
                //$("#show-tab").append(selectedUser.name);
                //console.log(datalog);
                $("#selectUser").val(selectedUser.id);
                
            },
            autoComplete(){
                this.findFriends = [];
                if(this.friendSearch.length > 0 && this.friendSearch !==null){
                    
                    axios.get(this.url+'/search-friend',{params: {friendSearch: this.friendSearch}}).then(response => {
                        
                        this.onlineUsers = response.data;
                    });
                }else{
                    axios.get(this.url+'/search-friend',{params: {friendSearch: " "}}).then(response => {
                        
                        this.onlineUsers = response.data;
                    });   
                }
            },
            activeOnlineUser() {
                //console.log('hi');
                Echo.join('chatroom.'+0)
                .here((users) => {
                    axios.get(this.url+'/user-friends-list').then( response=> {
                        this.onlineUsers = response.data;
                        //console.log(this.users);
                    });
                    
                })
                .joining((users) => { 
                    
                    axios.get(this.url+'/online-friends'+'/'+users._id).then( response=> {
                       //console.log(response.data);
                    });
                    axios.get(this.url+'/user-friends-list').then( response=> {
                        this.onlineUsers = response.data;
                    });
                })
                .leaving((users) => { 
                    
                   axios.get(this.url+'/offline-friends'+'/'+users._id).then( response=> {
                        //console.log(response.data);
                    });
                    axios.get(this.url+'/user-friends-list').then( response=> {
                        this.onlineUsers = response.data;
                        //console.log(this.users);
                    });
                }); 
            },
        },
        
        
        mounted() {
            // get users lists in left sidebar

            if(this.url !== 'undefined'){
                axios.get(this.url+'/user-friends-list').then( response=> {
                    this.users = response.data;
                    //console.log(this.users);
                });
            }

            this.activeOnlineUser();
        }
    }
</script>
