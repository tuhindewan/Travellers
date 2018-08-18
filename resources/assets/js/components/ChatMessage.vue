<template>
    
    <li class="media messages" v-if="message.sendUserId == authUserId">
        <div class="media-body">
            <div class="media text-right" :id="message.text">
                <a class="pull-right" href="#" :class="message.position">
                    <img class="media-object user_image" :src="message.image_path">
                </a>
                <div class="media-body">
                    
                    <p  v-if="message.type == 1">
                        {{ message.message }}
                    </p>
                    
                    <p v-else-if="message.type == 4">
                        <a :href="message.file_path" download>
                            <img :src="message.file_path" style="max-width:500px">
                            <!-- {{ message.file_name }} -->
                        </a>
                    </p>

                    <p v-else>
                        <a :href="message.file_path" download>
                            {{ message.file_name }}
                        </a>
                    </p>
                    <br><br>
                   <p class="text-muted-right" style="padding-top:10px;"> <i class="fa fa-clock-o"></i> &nbsp;{{ (message.time) }}</p>
                    <hr>
                </div>
            </div>

        </div>
    </li>
    <li class="media messages" v-else>
        <div class="media-body">
            <div class="media" :id="message.text" >
                <a class="left_side" href="#" :class="message.position" >
                    <img class="media-object user_image" :src="message.image_path">
                </a>
                <div class="media-body">
                    <p  v-if="message.type == 1">
                        {{ message.message }}
                    </p>
                    <p v-else-if="message.type == 4">
                        <a :href="message.file_path" download>
                            <img :src="message.file_path" style="max-width:500px">
                            <!-- {{ message.file_name }} -->
                        </a>
                    </p>
                    <p v-else>
                        <a :href="message.file_path" download>
                            {{ message.file_name }}
                        </a>
                    </p>
                    <br>
                   <p class="text-muted-left" style="padding-top:10px;"> <i class="fa fa-clock-o"></i> &nbsp;{{ (message.time) }}</p>
                    <hr>
                </div>
            </div>

        </div>
    </li>
</template>

<script>
    export default {
        props:['message'],
        data() {
            return {
                userName:$("#user_name").val(),
                authUserId:$("#authId").val()
            }
        },
        
        
        methods:{
            formatTime (time) {
                let previousTime = moment(time,'YYYY-MM-DD HH:mm:ss').format('x');
                let timeDifference = moment(previousTime,'x').fromNow();
                return timeDifference;
            }
        }
    }
</script>
