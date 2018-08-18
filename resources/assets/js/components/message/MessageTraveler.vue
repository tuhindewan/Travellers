
<template>
    <div style="display:inline">
        <a :user="users" v-bind:key="users._id" @click="activateUser(users)" :id="users._id" class="btn btn-primary btn-sm user-btn">Message</a>
    </div>
    
</template>

<script>
    export default {
        data() {

            return {
                
                url:$("#base_url").val(),
                users:{}
                
            }
        },
        props:['userid'],
        methods:{
            activateUser (selectedUser) {
                console.log(selectedUser);

                
                this.$emit('getcurrentuser',{
                    userId:selectedUser._id
                });

                // show chat conversation
                var datashow = $(".activate-chat").show();
                
                $(".chat-info").hide();
                // to make clicked li active
                $(".user-log .active").removeClass("active");
                $("#"+selectedUser._id).addClass("active");
                $(".header-chat").html('<p class="header_user">'+selectedUser.fullname+'</p>');
                if(selectedUser.activity===1){
                    $("#activity-check").html('<i class="fa fa-dot-circle-o" aria-hidden="true"style="color:#42b72a"></i>');
                }else{
                    $("#activity-check").html('<i class="fa fa-dot-circle-o" aria-hidden="true"style="color:red;"></i>');
                }
                
                $("#selectUserName").html(selectedUser.fullname);

                $("#selectUser").val(selectedUser._id);
                
            },
            
        },
        
        
        mounted() {
            axios.get(this.url+'/user/'+this.userid).then( response=> {
                this.users = response.data;
            });
        }
    }
</script>
