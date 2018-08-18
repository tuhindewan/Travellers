<template>
	<div style="margin-top: 17px;">
		<a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14" v-if="status === 1">
			<i class="fa fa-envelope fa-lg"></i>
			<span v-if="count > 0" class="label">{{ count }}</span>
		</a>
						
		<ul class="dropdown-menu media-list pull-right animated fadeInDown"  style="width: 400px;">
			
            <li class="dropdown-header">Notifications</li>

			
            <li v-for="(notify, index) in limitNotifications" class="listed feed_notification">
                
            	<div class="feed_notify_box" v-if="notify.is_unread === 0" style="background: #e9e9e9;">
            		<div class="row" style="padding: 0 10px; width:100%; ">
            		
	            		<div class="col-sm-2">
	    					<div class="request-thum">
	    						
	            				<img :src="notify.rImg" class="media-object" alt="" />
	            			</div>
	    				</div>
	    				<div class="col-sm-10">
	    					<div class="request-event">
	            				<a @click="notifyed(notify._id, '0', notify.thread_id)">
		                            <div class="media-body">
		                                <!-- <h6 class="media-heading inline" style="font-weight: 700;">{{ notify.users.fullname }}</h6> -->
		                                <p class=" inline transform-none" v-html="innerText(notify.body_text)"></p>
		                                <div class="text-muted f-s-11">{{ notify.time }}</div>
		                            </div>
		                        </a>
	            				
	            			</div>	
	    				</div>
	            		
	            	</div>
            	</div>
            	<div class="feed_notify_box" v-if="notify.is_unread === 1">
            		<div class="row" style="padding: 0 10px; width:100%; ">
            		
	            		<div class="col-sm-2">
	    					<div class="request-thum">
	    						
	            				<img :src="notify.rImg" class="media-object" alt="" />
	            			</div>
	    				</div>
	    				<div class="col-sm-10 ">
	    					<div class="request-event">
	            				<a @click="notifyed(notify._id, '1', notify.thread_id)">
		                            <div class="media-body">
		                                <!-- <h6 class="media-heading inline" style="font-weight: 700;">{{ notify.users.fullname }}</h6> -->
		                                <p class=" inline transform-none" v-html="innerText(notify.body_text)"></p>
		                                <div class="text-muted f-s-11">{{ notify.time }}</div>
		                            </div>
		                        </a>
	            				
	            			</div>	
	    				</div>
	            		
	            	</div>
            	</div>
            	
            	
            </li>
            


            <li v-if="notifications.length > 0" class="dropdown-footer text-center">
                <a @click="viewMore">View my booking</a>
            </li>
		</ul>
	</div>
</template>

<script>

	export default {

		props: [],
        data() {

            return {
                url:$("#base_url").val(),
                authId:$("#authId").val(),
                notifications:[],
                count:'',
                status: 0


            }
        },
        computed: {
			limitNotifications(){
				return this.notifications.slice(0, 10);
				
			}

		},
        methods: {
        	
        	
            innerText(description){
        		return description.replace(/(?:\r\n|\r|\n)/g, ' ');
        	},

        	notifyed(id, type, thread_id){
        		if(type === '0'){
        			axios.get(this.url+'/booking-notification-isread/'+id).then( response=> {
              			//console.log(response.data);
	              	
	          		});
        		}

        		window.location.href=this.url+"/booking-confirmation/"+thread_id;
        		
        	},
        	viewMore(){
        		window.location.href=this.url+"/myreservations";
        	},

        	viewNotification(){
        		axios.get(this.url+'/booking-notification').then( response=> {
              		
	              	this.notifications = response.data;
	              	if(this.notifications.length > 0){
	              		this.status = 1;
	              	}else{
	              		this.status = 0;
	              	}
	              	this.count = 0;
	              	for (var i = 0; i < this.notifications.length; i++) {
	              		if(this.notifications[i]['is_unread'] == 0){
	              			this.count += 1; 
	              		}
	              	}
	              	
	          	});
        	}
            
		},

		mounted(){
	    	
          this.viewNotification();
		    
	    }
		

    }
</script>