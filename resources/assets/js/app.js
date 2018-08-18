
require('./bootstrap');

import Vue from 'vue/dist/vue.min.js';
window.Vue = require('vue');

// Include Plugin in project
import VueNotifications from 'vue-notifications'
 
// Include mini-toaster (or any other UI-notification library
import miniToastr from 'mini-toastr'
 
// If using mini-toastr, provide additional configuration
const toastTypes = {
  success: 'success',
  error: 'error',
  info: 'info',
  warn: 'warn'
}
 
miniToastr.init({types: toastTypes})
 
// Here we setup messages output to `mini-toastr`
function toast ({title, message, type, timeout, cb}) {
  return miniToastr[type](message, title, timeout, cb)
}
 
// Binding for methods .success(), .error() and etc. You can specify and map your own methods here.
// Required to pipe our output to UI library (mini-toastr in example here)
// All not-specified events (types) would be piped to output in console.
const options = {
  success: toast,
  error: toast,
  info: toast,
  warn: toast
}
 
// Activate plugin
Vue.use(VueNotifications, options)// VueNotifications have auto install but if we want to specify options we've got to do it manually.


import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueFilter from 'vue-filter';
Vue.use(VueFilter);

import PhotoGrid from 'vue-photo-grid';
 
Vue.use(PhotoGrid);

Vue.use(require('vue-moment'));

//import 'babel-polyfill'; // es6 shim

import myUpload from 'vue-image-crop-upload';

import * as VueGoogleMaps from 'vue2-google-maps';
Vue.use(VueGoogleMaps, {
    load: {
      key: 'AIzaSyCCALSYjrJyQ3R9ONak9nVMaAkOuRetWv4',
      v: '3',
      libraries: 'places', // This is required if you use the Autocomplete plugin
      // OR: libraries: 'places,drawing'
      // OR: libraries: 'places,drawing,visualization'
      // (as you require)
    }
  });
Vue.config.devtools = true;

Vue.use(require('vue-chat-scroll'));

import 'vue-popperjs/dist/css/vue-popper.css';
Vue.component('Popper', require('vue-popperjs'));


// Vue.component('forget-password', require('./components/recover/ForgetPassword.vue'));

Vue.component('chat-message', require('./components/ChatMessage.vue'));
Vue.component('chat-log', require('./components/ChatLog.vue'));
Vue.component('user-log', require('./components/UserLog.vue'));
Vue.component('chat-composer', require('./components/ChatComposer.vue'));
Vue.component('feed-notification', require('./components/notification/FeedNotification.vue'));
Vue.component('booking-notification', require('./components/notification/BookingNotification.vue'));
Vue.component('message-notification', require('./components/notification/MessageNotification.vue'));
Vue.component('message-traveler', require('./components/message/MessageTraveler.vue'));

Vue.component('post-sections', require('./components/feed/PostSections.vue'));
Vue.component('user-section', require('./components/user/UserSection.vue'));
Vue.component('connection-section', require('./components/connection/ConnectionSection.vue'));
Vue.component('public-map', require('./components/map/WorldMap.vue'));
Vue.component('friend-map', require('./components/map/FriendMap.vue'));
Vue.component('place-map', require('./components/map/PlaceMap.vue'));
Vue.component('host-plan-map', require('./components/map/HostPlanMap.vue'));
Vue.component('create-post', require('./components/post/CreatePost.vue'));
Vue.component('single-post', require('./components/post/SinglePost.vue'));
Vue.component('setting-section', require('./components/settings/AccountSettings.vue'));
Vue.component('relationship', require('./components/feed/Relationship.vue'));
Vue.component('user-link', require('./components/feed/UserLink.vue'));
Vue.component('user-featured-photo', require('./components/user/UserFeaturedPhoto.vue'));
Vue.component('friend-activity', require('./components/activity/FriendActivity.vue'));
Vue.component('reports', require('./components/report/Report.vue'));

/*admin section*/
Vue.component('post-view', require('./components/post/SinglePostView.vue'));

var csrf_token = $('meta[name="csrf-token"]').attr('content');
//export default router;
var app = new Vue({
    el: "#wrapper",
    data: {
        messages:[],
        userInRoom:'',
        information:'',
        users:[],
        userId:'',
        chatWindows:[],
        selectUserId:'',
        url:$("#base_url").val(),
        position:[],
        text:[],
        color:[],
        typing:'',
        countNotification:'0',
        getNotification:[],
        posts:[],
        likes:[],
        // friendSearch: '',
        // findFriends:[],
        //onlineUsers:[],
        url:$("#base_url").val(),

        uploadType:'',
        //cover-image-upload set
        showCover:false,
        coverUploadPath:$("#base_url").val()+'/update-cover-picture',
        coverDataUrl:$("#coverPic").val(),
        //profile-image-upload set
        showProfile: false,
        
        params: {
            _token: csrf_token
        },
        headers: {
            smail: '*_~'
        },
        imgDataUrl: $("#profilePic").val(),
        profileUploadPath:$("#base_url").val()+'/update-profile-picture',
        //profile-image-upload end
    },
    http: {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    },
    components: {
        'my-upload': myUpload
    },
    
    methods: {
        
        /**
         * add message
         * @param array
         */
        addMessage(message) {
            // add message to existing messages
            this.messages.push(message);
              
            
            // scroll to bottom after new message added
            this.$nextTick(() => {
                this.scrollToEnd();
            })
        },
        /**
         * to scroll page to end
         * @return void
         */
        scrollToEnd: function() {
            var container = document.querySelector("#content-chat");
            var scrollHeight = container.scrollHeight;
            container.scrollTop = scrollHeight;
        },
        
        
        getCurrentUser(user) {
            //console.log(user);
            this.messages = "";
            this.userId = user.userId;
            
            this.selectUserId = 'chat_user-'+this.userId;
            axios.get(this.url+'/messages/'+this.userId).then( response=> {
                this.messages = response.data;
                //console.log(this.messages);
                // scroll to bottom after new message added
                this.$nextTick(() => {
                    this.scrollToEnd();
                });
            });

            //message seen

            axios.get(this.url+'/update-notification-count/'+this.userId).then( response=> {
                this.countNotification = response.data;
                //console.log(this.countNotification);
            });

            //
            axios.get(this.url+'/chat-notification').then( response=> {
                this.getNotification = response.data;
            });
   
            //message seen end

            var authId = $("#authId").val();
            
            var privateId = this.userId+authId; // unique id for private chat
            // laravel echo to send message to other ends (i.e who join given chatroom)

            
            Echo.private('chatroom.'+privateId)
            .listen('MessagePosted',(e)=>{
                this.messages.push({
                    message:e.message.message,
                    user:e.user.name,
                    time:e.message.created_at,
                    image_path:e.image_path,
                    type:e.message.type,
                    file_path:e.message.file_path,
                    file_name:e.message.file_name,
                    position:'pull-left',
                    text:'pull-left'
                });
                //console.log(e);
                //message count start
                axios.get(this.url+'/chat-notification-count/'+this.userId).then( response=> {
                    this.countNotification = response.data;
                });
                //message count end

                this.getNotification.push({
                    name:e.user.name,
                    time:e.message.created_at,
                    type:0,
                    picture:e.message.file_path,
                    message:e.message.message
                });

                // scroll to bottom after new message added
                this.$nextTick(() => {
                    this.scrollToEnd();
                });
            })

            .listenForWhisper('typing', (e) => {
                if(e.name != ''){
                    this.typing = e.userName+' is typing...'  
                }else{
                    this.typing = ''
                }
            });
             
        },
        
        removeUser(event){
            //this.id:event.target.id;
            $(".activate-chat").hide();
            
            $(".chat-info").show();
            //console.log(event.target.id);
        },
        getUserId(event){
            this.userId = event.target.id;
            this.createChatWindow(this.userId,event.target.innerHTML);
            
        },
        createChatWindow(userId){
            if(!this.chatWindowStatus[userId]){
                
                this.chatWindowStatus[userId] = 1;
                this.chatMessage[userId] = '';
                this.$set(app.chats, userId , {});
                this.$set(app.chatCount, userId , 0);
                this.chatWindows.push({"senderid" : userId });
            }
            
        },
        messageNotificationCount(){
            //show count message notification
            axios.get(this.url+'/chat-notification-count').then( response=> {
                this.countNotification = response.data;
            });
        },
        /*Cover image upload section*/
        toggleShowCover() {

            this.showCover  = !this.showCover ;
            this.uploadType = 2;
        },
        /*profile image upload section start*/
        toggleShowProfile() {

            this.showProfile  = !this.showProfile ;
            this.uploadType = 1;
        },
        /**
         * crop success
         *
         * [param] imgDataUrl
         * [param] field
         */
        cropSuccess(imgDataUrl, field){
            //console.log('-------- crop success --------');
            if(this.uploadType===1){

                this.imgDataUrl = imgDataUrl;
            }else if(this.uploadType===2){
                this.coverDataUrl = imgDataUrl
            }
            //console.log(field);
        },
        /**
         * upload success
         *
         * [param] jsonData  server api return data, already json encode
         * [param] field
         */
        cropUploadSuccess(jsonData, field){
            //console.log('-------- upload success --------');
            
            
            //console.log(jsonData);
            //console.log('field: ' + field);
        },
        /**
         * upload fail
         *
         * [param] status    server api return error status, like 500
         * [param] field
         */
        cropUploadFail(status, field){
            // console.log('-------- upload fail --------');
            // console.log(status);
            // console.log('field: ' + field);
        },
        /*profile image upload section end*/
        /*forget password issue*/
        forgetPassword(url){
            var user = $("#email").val();
            var url = $("#url-get").val();
            if(user !== ''){
                axios.get(url+'/check-users/'+user).then( response=> {
                    if(response.data.status === 'success'){
                        window.location.href=url+'/password-recover/'+response.data.userid; 
                    }else{
                        window.location.href=url+'/login-identify'; 
                    }
                    
                });
            }else{
                window.location.href=url+'/login-identify';   
            }

        },
    },
    mounted() {
        if(this.url !== undefined){
            axios.get(this.url+'/user-friends-list').then( response=> {
                this.users = response.data;
                //console.log(this.users);
            });

            this.messageNotificationCount();
        }
        

    },
    
    
    updated() {
        this.scrollToEnd();
    }
});




