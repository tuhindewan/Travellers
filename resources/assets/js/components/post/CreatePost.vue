<template>
	<div class="section">
	  <div class="overlay-modal overlay-modal-edit" style="margin-left: -225px; display: none;">
	  	<div class="overlay-modal"></div>
	    <div class="travel_dialog show_travel_edit create_post" style="min-height: 90px;">
	      <div class="fade-box-edit fade-box">
	        <div class="inner_gray clearfix">
	          <div class="inner_gray_text">
	           Post  
	          </div>
	          <div class="inner_gray_close_button">
	            <a href="#" class="close" role="button" title="Close">Close</a>
	          </div>
	        </div>
	        <div class="inner_body">
	          
	          <input type="hidden" name="fk_user_id" value="" > 
	          <input type="hidden" name="posted_by" value="0" > 
	          <small style="margin-left:10px; color:red; font-weight:bold;" v-if="imageError===false && textError===false && error == true"> This post appears to be blank. Please write something or attach a photo to post. </small>
	          <div class="inner_body_content">
	
	              <div class="modal-body">
	              
	                  <div class="body-content">
	                  	<div class="form-group">
	                  		<select v-model="selected" v-on:change="postType(selected)" name="post_type" required="required" class="res_form_control form-control">
          							  <option v-for="option in options" v-bind:value="option.value">
          							    {{ option.text }}
          							  </option>
          							</select>
	                  	</div>
	                  	
	                    <div class="form-group" style="margin-bottom: 8px;">
                            <gmap-autocomplete :value="sharePlace" @place_changed="setPlace" class="res_form_control form-control map_search1" id="postLocation" required placeholder="Type The Post Location...">
                						</gmap-autocomplete>
                						<small style="color:red; font-weight:bold;" v-if="locationError===false">please enter correct location..</small>
	                    </div>
	                      
		                <div class="form-group">
		                    <textarea v-model="postDescription" name="description" class="res_textarea form-control post-body edit-textarea" id="description" rows="10" @change = "postText" placeholder="What's on your mind?" required></textarea>
		                </div>
	                  </div>

	                <!-- load live image /video -->
	                <div class="row" style="margin-right:18px;">
	                  <div class="load_select_option">
	                    <div class="file_load" style="display: inline; width:80px; height:60px; float:left;" v-for="(image,index) in images" v-on:click="removeImage(image,index)">
                    		<div class="single_load_file" :id="'image'+index">
                    			<img class="bottom" :src="url+'/public/img/fileclose.png'" alt="">
	                    		<img :src="url+'/images/post/photo/thum/'+image" class="append_load_image top" id="append_select_image">
	                    		
	                    	</div>
	                    	
	                    </div>
					            <div class="load_chose_file" style="float:left;"></div>
	                  </div>
	                </div>
	                
		            <div class="post-bottom">
		              <div class="row">
		              	<div class="col-sm-3"></div>
		                <div class="add_file_button col-md-6">
		                    
        							<label class="" for="post_file" style="width:100%;">
        				        <a class="btn btn-success btn-sm add_photo" style="width:100%;">Add Photo </a>
        					    </label>
        							<input type="file" id="post_file" multiple @change="photo" style="display:none;">
        		        </div>
		                <div class="col-sm-3"></div>

		              </div>
		                
		            </div>
	            </div>
	          </div>
	          <div class="inner_buttons">
              <div class="checkbox">
                <label>
                 <input v-model="travelExp" type="checkbox" value="1">
                 <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                 Refer to expert
                </label>
                <popper trigger="hover" :options="{placement: 'bottom'}" >
                  <div class="popper post-section" style="background-color: #000000; color: #ffffff;font-size: 12px; border: 1px #07415a solid; padding:5px;">
                    Popper Content
                  </div>

                  <a slot="reference" class="bottom">
                    (help)
                  </a>  
                </popper>
              </div>

	            <button type="submit" @click="createdPost" class="btn-sm btn-post btn-success">Post</button>
	            <a class="cancel_modal_button cancel_edit" role="button"> Cancel </a>
	          </div>
	          
	        </div>
	      </div>
	    </div>
	  </div>
	</div>	
</template>

<script>
import VueGoogleMaps from 'vue2-google-maps';
import VueRouter from 'vue-router';
  const router = new VueRouter({
        mode: 'history',
        
    });
export default {
    
    data () {
    	
        return {
            url:$("#base_url").val(),
            currentPlace: null,
            lat:'',
            lng:'',
            images:[],
            locationError:null,
            error:false,
            imageError:false,
            textError:false,
            postDescription:'',
            locationPlace:'',
            travelExp:false,

    		    options: [
    		      { text: 'Experience', value: '4' },
    		      { text: 'Plans', value: '3' },
    		      { text: 'Suggestion', value: '1' },
    		      { text: 'Question', value: '2' }
    		    ],
    		    selected: '4',
            }
      },
	    router,
      methods:{
      	photo(e){
      		this.imageError = true;
      		let image = e.target.files[0];
      		var i=$('i').length;
      		let reader = new FileReader();
      		reader.readAsDataURL(image);
      		reader.onload = e => {
      			//this.images.push('e.target.result');
      			this.images.push('loader-cycle.gif');
      			let ind = this.images.length - 1; 
      			let commentData = {
                    image:e.target.result,
                    type:'1'
                };
      			axios.post(this.url+'/post-image',commentData).then( response=> {
      				if(response.data === 'error'){

      				}else{
      					this.images.splice(ind, 1);
      					this.images.push(response.data);
      				}
                    
            });
      			
      		}
      		
      		i++;

  			$('.load_chose_file').html('<label class="load_file_label" for="post_file"><div class="slide_upload"></div></label>');
		    /**/
		    $(".load_chose_file").removeClass('remove_file');
      		
      	},
      	removeImage(image,index){
      		
      		let commentData = {
                image:image,
                type:'0'
            };
  			axios.post(this.url+'/post-image',commentData).then( response=> {
  				if(response.data === 'error'){

  				}else{
  					Vue.delete(this.images, index);
				    if(this.images ==""){
				    	this.error = true;
				    	this.imageError = false;
				        $(".load_chose_file").addClass('remove_file');
				    }else{
				        $(".load_chose_file").removeClass('remove_file');
				    }
  				}
                
            });
      		
      	},
      	setPlace(place) {
          this.currentPlace = place;
          	
	        if (this.currentPlace.geometry) {
	            this.lat = this.currentPlace.geometry.location.lat();
	            this.lng = this.currentPlace.geometry.location.lng();
	            this.locationPlace = this.currentPlace.formatted_address;
	            this.locationError=true;
	            
	        }else{
	        	this.lat = '';
            this.lng = '';
            this.locationPlace = '';
	        	this.locationError=false;
	        	
	        }
	    },
	    postText(e){
	    	this.error = true;
	    	if (this.postDescription!="") {
	    		this.textError = true;	
	    	}else{
	    		this.textError = false;
	    	}
	    	

	    },
	    postType(e){
	    	this.selected = e;
	    	//console.log(this.selected);
	    },
      createdPost(){
        
      	this.error = true;
      	if(this.locationError===true && (this.textError===true || this.imageError===true)){
          
          if(this.travelExp === true){
            var posted = 1;
          }else{
            var posted = 0;
          }
      		let commentData = {
            description:this.postDescription,
            post_type: this.selected,
            lat:this.lat,
            lon:this.lng,
            image:this.images,
            place:this.locationPlace,
            posted_by:posted,
          };
          
          axios.post(this.url+'/user-post',commentData).then( response=> {
            ///console.log(response.data);
            if(response.data == 'error'){

            }else{
            	window.location.href='http://localhost'+this.$route.fullPath; 
            }
          });
      	}else{
      		//this.error = false;
      		if(this.locationError === null){
      			this.locationError = false;
      		}
      	}
      	
      },
      

      geolocate: function() {
        navigator.geolocation.getCurrentPosition(position => {
          // this.center = {
          //   lat: position.coords.latitude,
          //   lng: position.coords.longitude
          // };
          //console.log(this.center);
        });
      }  
          
    },
      
      

    mounted(){
    	
    	if(this.$route.fullPath=='/travel-project/suggestions'){
	        this.selected  = '1';
	    }else if(this.$route.fullPath=='/travel-project/plans'){
	        this.selected = '3';
	    }else if(this.$route.fullPath=='/travel-project/questions'){
	        this.selected = '2';
	    }else{
	        this.selected = '4';
	    }
      	
      	this.geolocate();
      
      
    }
  }
</script>


<style>
.post-section[x-placement^="top"] .popper__arrow { border-color: #0f0f0f transparent transparent transparent !important;}
.post-section[x-placement^="left"] .popper__arrow { border-color: #0f0f0f transparent transparent transparent !important;}
.post-section[x-placement^="right"] .popper__arrow { border-color: #0f0f0f transparent transparent transparent !important;}
.post-section[x-placement^="bottom"] .popper__arrow { border-color: #0f0f0f transparent transparent transparent !important;}
.form-group{margin-bottom: 8px;}
.chosen-container {
    width: 50%!important;
    margin-bottom: 10px;
}
.add_photo{width: 100%;}
.btn-post { padding: 1px 16px;}
  textarea.edit-textarea{overflow-y: scroll !important; height: 70px !important; overflow:auto !important;}
	.chosen-container {padding-left: 15px !important;}
	.modal-body{padding-top: 0; padding-bottom: 0;}
  
 #postLocation::-webkit-input-placeholder {
      color: black;
  }
  #postLocation:-moz-placeholder {
      color: black;

  }
  #postLocation::-moz-placeholder {
      color: black;

  }
  #description::-webkit-input-placeholder {
      color: black;
  }
  #description:-moz-placeholder {
      color: black;

  }
  #description::-moz-placeholder {
      color: black;

  }
.single_load_file{  position:relative;
  height:80px;
  width:60px;
  margin:0 auto; cursor: pointer;
}

.single_load_file img {
	width: 80px; height: 60px;
  position:absolute;
  left:0;
  -webkit-transition: opacity 1s ease-in-out;
  -moz-transition: opacity 1s ease-in-out;
  -o-transition: opacity 1s ease-in-out;
  transition: opacity 1s ease-in-out;
}

.top:hover {
  opacity:0.3;
}
.slide_upload {bottom: 9px;
    left: 10px;
}
.edit-textarea{margin:0;}
</style>