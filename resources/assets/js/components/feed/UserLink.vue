<template>
	<div style="display: inline;">
		<popper trigger="hover" :options="{placement: 'auto'}">
        <div class="popper">
          <div class="hovercard popbox-content">
                <div class="display-pic">
                    <div class="cover-photo">
                        <div class="display-pic-gradient"></div>
                        <img v-if="userinfo.cover_image" :src= "url+'/images/users/cover/'+userinfo.cover_image">

                        <img v-else-if="userinfo.cover_image === null" :src= "url+'/public/frontend/images/Cover/blank-cover-template-1.jpg'">

                    </div>

                    <div class="profile-pic" v-if="userinfo.profile_image">
                        <div class="pic">
                            <img v-if="userinfo.profile_image !== '' " :src="userProfilePath+userinfo.profile_image" title="Profile Image">
                            <img v-else-if="userinfo.profile_image === '' && userinfo.gender === 'Mr'" :src="url+'/public/frontend/img/user.jpg'">
                            <img v-else-if="userinfo.profile_image === '' && userinfo.gender !== 'Mr'" :src="url+'/public/frontend/images/Anonymous_female.png'">
                        </div>
                        
                        <div class="details">
                            <ul class="details-list">
                                <!-- <li class="details-list-item">
                                    <p><span class="glyph glyph-work"></span>
                                    <span>Founder at <a href=
                                    "#">CodeDodle</a></span></p>
                                </li> -->

                                <li class="details-list-item">
                                    <p><i class="fa fa-home"></i>
                                    <span>Lives in 
                                    <a v-if="userinfo.current_city" class="capitalize">{{ userinfo.current_city.city_name }}</a></span></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="display-pic-gradient"></div>

                <div class="title-container">
                    <a :href="url+'/'+userinfo.username" class="title capitalize">{{ userinfo.fullname }}</a>
                
                    <!-- <p class="other-info">2 followers</p> -->
                </div>

                <div class="info" v-if="authId !== userinfo._id">
                    <div class="info-inner">
                        <div class="interactions">
                            <div>
                                
                                <relationship v-if="userinfo._id" class="pull-right" :userid="userinfo._id" style="margin-left:10px;"></relationship>
                                
                                <!-- <messageTraveler :userid="userinfo._id" v-on:getcurrentuser="getCurrentUser"></messageTraveler> -->     
                            </div>
                            <!-- <div v-else>
                              <a class="btn btn-info btn-sm" href="#">Update Info</a>   
                            </div> -->
                        </div>

                    </div>
                </div>
                
            </div>
        </div>
        <a :href="url+'/'+userinfo.username" slot="reference" class="userlink capitalize"><b v-html="highlightPhrase(userinfo.fullname)">{{userinfo.fullname}}</b></a>
        
      </popper>
	    
	</div>

</template>

<script>
    
    //import messageTraveler from './../message/MessageTraveler.vue';
    import relationship from './Relationship.vue';
	export default {

		data() {

            return {
            	url:$("#base_url").val(),
                authId:$("#authId").val(),
                userProfilePath: $("#base_url").val()+"/images/users/profile/s160",
                
                //relationship:''
                //post:'',
                
            }
        },
		components:{
            relationship
        },
        props:['userinfo','highlight'],

        methods:{
        	

            highlightPhrase (text) {
              if (!this.highlight) return text
              return text.replace(this.highlight, `<span style="color: #daa732;">${this.highlight}</span>`)
            }
        	
        },
        mounted() {
            //console.log(this.userinfo);
        }

        
        

    }
</script>

<style>
    .userlink:hover{transition-delay:0.5s;}
    .is-flex{
        height: 100%;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .inline{
        display: inline-block;
        position: relative;
    }
    .user-popover{
        position: absolute;
        width: auto;
        background: #fff;
        border: 1px solid #07415a;
        
        box-shadow: 0 6px 6px rgba(16, 16, 16, 0.04), 0 6px 6px rgba(0, 0, 0, 0.05);
        z-index:999; clear: both;
    }
	

.hovercard {
    width: 370px;
    height: 240px;
    border: 0;
    position: relative;
    border-radius: 2px;
    
}



.display-pic {
    height: 140px;
    background-color: #07415a;
    position: relative;
}

.display-pic-gradient {
    height: auto;
    position: absolute;
    top: 43;
    width: 100%;
    background: -moz-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(38,38,38,0.40) 100%); /* FF3.6+ */
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,0)), color-stop(100%,rgba(38,38,38,0.40))); /* Chrome,Safari4+ */
    background: -webkit-linear-gradient(top, rgba(255,255,255,0) 0%,rgba(38,38,38,0.40) 100%); /* Chrome10+,Safari5.1+ */
    background: -o-linear-gradient(top, rgba(255,255,255,0) 0%,rgba(38,38,38,0.40) 100%); /* Opera 11.10+ */
    background: -ms-linear-gradient(top, rgba(255,255,255,0) 0%,rgba(38,38,38,0.40) 100%); /* IE10+ */
    background: linear-gradient(to bottom, rgba(255,255,255,0) 0%,rgba(38,38,38,0.40) 100%); /* W3C */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00ffffff', endColorstr='#8c262626',GradientType=0 ); /* IE6-9 */
}
.display-pic-gradient img{width: 100%; height: 100%;}
.cover-photo { height: 140px; overflow: hidden; opacity: .7}
.cover-photo img{ width: 100%; height: 100%;}

.profile-pic {
    position: absolute;
    width: 350px;
    height: 100px;
    left: 10px;
    top: 85px;
    z-index: 1;
}

.pic {
    border: 1px solid rgba(0, 0, 0, .3);
    width: 100px;
    height: 100px;
    border-radius: 3px;
    padding: 3px;
    background-color: white;
}
.pic img{width: 100%; height: 100%;}
.title-container {
    margin: -40px 0 0 140px;
    position: absolute; z-index: 600;
}

.title-container a {
    color: #ffffff;
    font-size: 12px;
    font-family: Helvetica, Arial, 'lucida grande',tahoma,verdana,arial,sans-serif;
    font-weight: bold;
    font-size: 14px;
}

.other-info {
    color: #fff;
    font-size: 12px;
    margin: 0;
}

/** Hover card info and interaction */

.info {
    height: 40px;
    width: 100%;
    background-color: #f2f2f2;
    border: 1px solid #ccc;
    border-bottom: none;
    border-left: none;
    border-right: none;
    position: absolute;
    top: 200px;
}

.info-inner {
    padding: 6px;
    margin-left: 120px;
}

.info-inner a {
    text-decoration: none;
}

.interactions {
    float: right;
}

/** Person/Page info styles */

.details {
    margin-top: -40px;
    margin-left: 0px;
    font-size: 12px;
}

.details-list {
    list-style-type: none;
    color: #333;
    font-family: 'lucida grande',tahoma,verdana,arial,sans-serif;
}
.details-list-item{padding: unset !important; z-index: -1; border-bottom: unset !important;}

.details-list-sub-item {
    color: #9197a3;
}

</style>
