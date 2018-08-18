
<template>
    
    <div class="message-notification">

            <li class="media" v-for="notification in getNotification" :user="notification" v-bind:key="notification.id" @click="activateUser(notification)" :id="notification.id">
                                
                <div class="notification_body" v-if="notification.type==0" style="background: #edf0f5;">
                    <div class="media-left"><img :src="notification.picture" class="media-object" alt="" /></div>
                    <div class="media-body">
                        <h6 class="media-heading">{{ notification.name }}</h6>
                        <p>{{ notification.message}}</p>
                        <div class="text-muted f-s-11">{{ notification.time }}</div>
                    </div>
                </div>
                <div v-else class="notification_body">
                    <div class="media-left"><img :src="notification.picture" class="media-object" alt="" /></div>
                    <div class="media-body">
                        <h6 class="media-heading">{{ notification.name }}</h6>
                        <p>{{ notification.message}}</p>
                        <div class="text-muted f-s-11">{{ notification.time }}</div>
                    </div>
                </div>
            </li>

            <li class="dropdown-footer text-center">
                <a href="">View more</a>
            </li>  
        

    </div>
    

</template>

<script>
    export default {
        data() {

            return {
                default_image:$("#default_image").val(),
                url:$("#base_url").val(),
                getNotification:[],
                
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
            
        },
        
        
        mounted() {
            axios.get(this.url+'/chat-notification').then( response=> {
                if(this.getNotification){
                    this.getNotification = response.data;
                }
            });
        }
    }
</script>
