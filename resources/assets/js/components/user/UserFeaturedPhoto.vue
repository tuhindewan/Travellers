<template>
  <div class="featuredPhoto">

    <div v-if="authId===userid" class="featuredEdit" onclick="featuredPhoto()"><a > <i class="fa fa-edit"></i> </a></div>
    <div class="section-modal"> 
      <div class="overlay-modal featuredPhoto_modal" style="margin-left: 0px; display: none;">
        <div class="travel_dialog show_featured_modal" style="min-height: 190px;">
          <div class="fade-box-delete fade-box">
            <div class="inner_gray clearfix">
              <div class="inner_gray_text">
              Edit Featured Photos
              </div>
              <div class="inner_gray_close_button">
                <a href="#" class="close" role="button" title="Close">Close</a>
              </div>
            </div>
            <div class="inner_body">
              <div class="inner_body_content">
                Choose up to 9 photos you'd like to feature.
                <div class="select_photo">
                 <div class="row">
                    <div class="col-sm-4 no_padding show_pic">
                      <div v-if="photo1 === ''" id="feature-1" class="slide_upload" onclick="featureChoose()"></div>
                      <div id="load-pic1">
                        <div class="load_pic" v-if="photo1 !== ''">
                          <img :src="photo1" id="1" class="img-responsive">
                          <button class="btn btn-danger btn-sm file_cancel_btn" @click="removeItem(photo1, '1')" :id='1'><i class="fa fa-times" aria-hidden="true"></i></button>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-4 no_padding show_pic">
                      <div v-if="photo2 === ''" id="feature-2" class="slide_upload" onclick="featureChoose()"></div>
                      
                      <div id="load-pic2">
                        <div class="load_pic" v-if="photo2 !== ''">
                          <img :src="photo2" id="2" class="img-responsive">
                          <button class="btn btn-danger btn-sm file_cancel_btn" @click="removeItem(photo2, '2')" :id='2'><i class="fa fa-times" aria-hidden="true"></i></button>
                        </div>
                      </div>
                      
                    </div>

                    <div class="col-sm-4 no_padding show_pic">
                      <div  v-if="photo3 === ''" id="feature-3" class="slide_upload" onclick="featureChoose()"></div>
                      
                      <div id="load-pic3">
                        <div class="load_pic" v-if="photo3 !== ''">
                          <img :src="photo3" id="3" class="img-responsive">
                          <button class="btn btn-danger btn-sm file_cancel_btn" @click="removeItem(photo3, '3')" :id='3'><i class="fa fa-times" aria-hidden="true"></i></button>
                        </div>
                      </div>
                      
                    </div>

                    <div class="col-sm-4 no_padding show_pic">
                      <div  v-if="photo4 === ''" id="feature-4" class="slide_upload" onclick="featureChoose()"></div>
                      
                      <div id="load-pic4">
                        <div class="load_pic" v-if="photo4 !== ''">
                          <img :src="photo4" id="4" class="img-responsive">
                          <button class="btn btn-danger btn-sm file_cancel_btn" @click="removeItem(photo4, '4')" :id='4'><i class="fa fa-times" aria-hidden="true"></i></button>
                        </div>
                      </div>
                      
                    </div>

                    <div class="col-sm-4 no_padding show_pic">
                      <div  v-if="photo5 === ''" id="feature-5" class="slide_upload" onclick="featureChoose()"></div>
                      
                      <div id="load-pic5">
                        <div class="load_pic" v-if="photo5 !== ''">
                          <img :src="photo5" id="5" class="img-responsive">
                          <button class="btn btn-danger btn-sm file_cancel_btn" @click="removeItem(photo5, '5')" :id='5'><i class="fa fa-times" aria-hidden="true"></i></button>
                        </div>
                      </div>
                      
                    </div>

                    <div class="col-sm-4 no_padding show_pic">
                      <div  v-if="photo6 === ''" id="feature-6" class="slide_upload" onclick="featureChoose()"></div>
                      
                      <div id="load-pic6">
                        <div class="load_pic" v-if="photo6 !== ''">
                          <img :src="photo6" id="6" class="img-responsive">
                          <button class="btn btn-danger btn-sm file_cancel_btn" @click="removeItem(photo6, '6')" :id='6'><i class="fa fa-times" aria-hidden="true"></i></button>
                        </div>
                      </div>
                      
                    </div>

                    <div class="col-sm-4 no_padding show_pic">
                      <div  v-if="photo7 === ''" id="feature-7" class="slide_upload" onclick="featureChoose()"></div>
                      
                      <div id="load-pic7">
                        <div class="load_pic" v-if="photo7 !== ''">
                          <img :src="photo7" id="7" class="img-responsive">
                          <button class="btn btn-danger btn-sm file_cancel_btn" @click="removeItem(photo7, '7')" :id='7'><i class="fa fa-times" aria-hidden="true"></i></button>
                        </div>
                      </div>
                      
                    </div>

                    <div class="col-sm-4 no_padding show_pic">
                      <div  v-if="photo8 === ''" id="feature-8" class="slide_upload" onclick="featureChoose()"></div>
                      
                      <div id="load-pic8">
                        <div class="load_pic" v-if="photo8 !== ''">
                          <img :src="photo8" id="8" class="img-responsive">
                          <button class="btn btn-danger btn-sm file_cancel_btn" @click="removeItem(photo8, '8')" :id='8'><i class="fa fa-times" aria-hidden="true"></i></button>
                        </div>
                      </div>
                      
                    </div>

                    <div class="col-sm-4 no_padding show_pic">
                      <div  v-if="photo9 === ''" id="feature-9" class="slide_upload" onclick="featureChoose()"></div>
                      
                      <div id="load-pic9">
                        <div class="load_pic" v-if="photo9 !== ''">
                          <img :src="photo9" id="9" class="img-responsive">
                          <button class="btn btn-danger btn-sm file_cancel_btn" @click="removeItem(photo1, '9')" :id='9'><i class="fa fa-times" aria-hidden="true"></i></button>
                        </div>
                      </div>
                      
                    </div>

                   
                 </div>
                  
                </div>
              </div>

              <div class="inner_buttons">
                <button class="okay_modal_button delete_button_ok" @click="confirmPhoto" type="submit" tabindex="0" >
                  Okay
                </button>
                <a class="cancel_modal_button cancel_modal" role="button"> Cancel </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!--  -->
    <div class="section-modal"> 
      <div class="overlay-modal-choose featuredChoose_modal" style="margin-left: 0px; display: none;">
        <div class="travel_dialog choose_dialog show_photo_choose" style="min-height: 190px;">
          <div class="fade-box-delete fade-box">
            <div class="inner_gray clearfix">
              <div class="inner_gray_text">
              Choose Featured Photo
              </div>
              <div class="inner_gray_close_button">
                <a href="#" class="choose_close" role="button" title="Close">Close</a>
              </div>
            </div>
            <div class="inner_body">
              <div class="upload_photo_section">
                <a href=""> <label class="text-center" for="post_file">
                  <i class="fa fa-plus"></i> Upload photo
                </label></a>
                <input type="file" id="post_file" @change="photoSelect" style="display:none;">
              </div>
              <div class="inner_body_content" style="padding:0">
                
                <div class="uploaded_photo_section">
                  <div class="panel panel-default">
                    <div class="panel-heading" style="background: #f7f7f7;">Your photo library</div>
                    <div class="panel-body photo_library_section">
                      <div class="row no_padding">
                        
                        <div class="col-xs-6 col-md-3" v-for="(photo, index) in yourPhotos" style="padding: 0 5px;">
                          <a href="#" class="thumbnail">
                            <img @click="photoYour(photo.images)" :src="url+'/images/post/photo/thum/'+photo.images" class="img-responsive">
                          </a>
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
    </div>
    <!-- exsit image -->
    
    <!-- default image -->
    <ul class="friends" v-if="this.featuredphoto.length === 0">
      
      <li v-for="(photo, index) in defaultImage">
        <a href="#">
          <img :src='url+photo.image' :alt="index" class="img-responsive">
        </a>
      </li>
      
      
    </ul>
    <ul v-else class="featuredItem">
      <!-- if image one -->
      <li class="item1 item_photo_si" v-for="(photo, index) in featuredphoto" v-if="featuredphoto.length===1">
        <a href="#" class="">
          <img @click="singleImage(index, photo)" :src="url+'/images/post/photo/'+photo.image" class="img-responsive">
        </a>
      </li>

      <!-- if image two -->
      <li class="item2 item_photo_si" v-for="(photo, index) in featuredphoto" v-if="featuredphoto.length===2">
        <a href="#" class="">
          <img @click="singleImage(index, photo)" :src="url+'/images/post/photo/thum/'+photo.image" class="img-responsive">
        </a>
      </li>

      <!-- if image three -->
      <li class="item3 item_photo_si" v-for="(photo, index) in featuredphoto" v-if="featuredphoto.length===3">
        <a href="#" class="">
          <img @click="singleImage(index, photo)" :src="url+'/images/post/photo/thum/'+photo.image" class="img-responsive">
        </a>
      </li>

      <!-- if image four -->
      <li class="item4 item_photo_si" v-for="(photo, index) in featuredphoto" v-if="featuredphoto.length===4">
        <a href="#" class="">
          <img @click="singleImage(index, photo)" :src="url+'/images/post/photo/thum/'+photo.image" class="img-responsive">
        </a>
      </li>

      <!-- if image five -->
      <li class="item5 item_photo_si" v-for="(photo, index) in featuredphoto" v-if="featuredphoto.length===5">
        <a href="#" class="">
          <img @click="singleImage(index, photo)" :src="url+'/images/post/photo/thum/'+photo.image" class="img-responsive">
        </a>
      </li>

      <!-- if image six -->
      <li class="item6 item_photo_si" v-for="(photo, index) in featuredphoto" v-if="featuredphoto.length===6">
        <a href="#" class="">
          <img @click="singleImage(index, photo)" :src="url+'/images/post/photo/thum/'+photo.image" class="img-responsive">
        </a>
      </li>

      <!-- if image seven -->
      <li class="item7 item_photo_si" v-for="(photo, index) in featuredphoto" v-if="featuredphoto.length===7">
        <a href="#" class="">
          <img @click="singleImage(index, photo)" :src="url+'/images/post/photo/thum/'+photo.image" class="img-responsive">
        </a>
      </li>

      <!-- if image eight -->
      <li class="item8 item_photo_si" v-for="(photo, index) in featuredphoto" v-if="featuredphoto.length===8">
        <a href="#" class="">
          <img @click="singleImage(index, photo)" :src="url+'/images/post/photo/thum/'+photo.image" class="img-responsive">
        </a>
      </li>

      <!-- if image nine -->
      <li class="item9 item_photo_si" v-for="(photo, index) in featuredphoto" v-if="featuredphoto.length===9">
        <a href="#" class="">
          <img @click="singleImage(index, photo)" :src="url+'/images/post/photo/thum/'+photo.image" class="img-responsive">
        </a>
      </li>

    </ul>
    <featuredModal :show="showModal" :imageInfo="imageInfo" @close="showModal = false" :next="nextPost" :pre="prePost" :featuredImages="showImages"></featuredModal>
  </div>
</template>

<script>
  import featuredModal from './FeaturedImage.vue';
	export default {

      data() {

        return {
          url:$("#base_url").val(),
          userProfilePath: $("#base_url").val()+"/images/users/profile/s160",
          authId:$("#authId").val(),
          featuredphoto:[],
          yourPhotos:[],
          photo1:'',
          photo2:'',
          photo3:'',
          photo4:'',
          photo5:'',
          photo6:'',
          photo7:'',
          photo8:'',
          photo9:'',
          images:[],
          showImages:[],
          removeImage:[],
          defaultImage:[
            { image: '/public/frontend/images/Friends/guy-1.jpg' },
            { image: '/public/frontend/images/Friends/guy-2.jpg' },
            { image: '/public/frontend/images/Friends/guy-3.jpg' },
            { image: '/public/frontend/images/Friends/guy-4.jpg' },
            { image: '/public/frontend/images/Friends/guy-5.jpg' },
            { image: '/public/frontend/images/Friends/guy-6.jpg' },
            { image: '/public/frontend/images/Friends/guy-7.jpg' },
            { image: '/public/frontend/images/Friends/guy-8.jpg' },
            { image: '/public/frontend/images/Friends/guy-9.jpg' },
          ],
          showModal: false,
          nextPost:'',
          prePost:'',
          imageInfo:{},
        }
      },
      
      props:['userid','featuredphoto'],
      components:{
          featuredModal
      },
      methods:{
      	formatTime (time) {
              let previousTime = moment(time,'YYYY-MM-DD HH:mm:ss').format('x');
              let timeDifference = moment(previousTime,'x').fromNow();
              return timeDifference;
        },

        photoSelect(e){
          this.imageError = true;
          let image = e.target.files[0];
          
          let reader = new FileReader();
          reader.readAsDataURL(image);
          reader.onload = e => {
            
            let commentData = {
              image:e.target.result,
              type:'1'
            };
            
            
            axios.post(this.url+'/post-image',commentData).then( response=> {
              if(response.data === 'error'){

              }else{
                
                var item = 0;
                if(this.photo1 === ''){
                  this.photo1 = e.target.result;
                  $("#feature-1").hide();
                  item = 1;
                }else if(this.photo2 === ''){
                  this.photo2 = e.target.result;
                  $("#feature-2").hide();
                  item = 2;
                }else if(this.photo3 === ''){
                  this.photo3 = e.target.result;
                  $("#feature-3").hide();
                  item = 3;
                }else if(this.photo4 === ''){
                  this.photo4 = e.target.result;
                  $("#feature-4").hide();
                  item = 4;
                }else if(this.photo5 === ''){
                  this.photo5 = e.target.result;
                  $("#feature-5").hide();
                  item = 5;
                }else if(this.photo6 === ''){
                  this.photo6 = e.target.result;
                  $("#feature-6").hide();
                  item = 6;
                }else if(this.photo7 === ''){
                  this.photo7 = e.target.result;
                  $("#feature-7").hide();
                  item = 7;
                }else if(this.photo8 === ''){
                  this.photo8 = e.target.result;
                  $("#feature-8").hide();
                  item = 8;
                }else if(this.photo9 === ''){
                  this.photo9 = e.target.result;
                  $("#feature-9").hide();
                  item = 9;
                }
                $("#load-pic"+item).show();
                this.images.push(response.data);
                $(".overlay-modal-choose, .choose_dialog").removeAttr("style");
                $(".show_featured_modal").css('opacity','1');
                $(".featuredChoose_modal").hide();
              }
                    
            });
            
          }
          
        }, 
        photoYour(src){
          var link = this.url+'/images/post/photo/thum/'+src;
          //console.log(link);
          
          var item = 0;
          if(this.photo1 === ''){
            this.photo1 = link;
            $("#feature-1").hide();
            item = 1;
          }else if(this.photo2 === ''){
            this.photo2 = link;
            $("#feature-2").hide();
            item = 2;
          }else if(this.photo3 === ''){
            this.photo3 = link;
            $("#feature-3").hide();
            item = 3;
          }else if(this.photo4 === ''){
            this.photo4 = link;
            $("#feature-4").hide();
            item = 4;
          }else if(this.photo5 === ''){
            $("#feature-5").hide();
            this.photo5 = link;
            item = 5;
          }else if(this.photo6 === ''){
            this.photo6 = link;
            $("#feature-6").hide();
            item = 6;
          }else if(this.photo7 === ''){
            this.photo7 = link;
            $("#feature-7").hide();
            item = 7;
          }else if(this.photo8 === ''){
            this.photo8 = link;
            $("#feature-8").hide();
            item = 8;
          }else if(this.photo9 === ''){
            this.photo9 = link;
            $("#feature-9").hide();
            item = 9;
          }
          
          $("#load-pic"+item).show();
          this.images.push(src);

          $(".overlay-modal-choose, .choose_dialog").removeAttr("style");
          $(".show_featured_modal").css('opacity','1');
          $(".featuredChoose_modal").hide();
        },
        removeItem(item, indx){
          var photo = item.split(this.url+'/images/post/photo/thum/');
          this.removeImage.push(photo[1]);
          this.images.shift(photo[1]);
          $("#feature-"+indx).show();
          
          $("#load-pic"+indx).hide();
          if(indx==='1'){
            this.photo1 = '';
          }else if(indx==='2'){
            this.photo2 = '';
          }else if(indx==='3'){
            this.photo3 = '';
          }else if(indx==='4'){
            this.photo4 = '';
          }else if(indx==='5'){
            this.photo5 = '';
          }else if(indx==='6'){
            this.photo6 = '';
          }else if(indx==='7'){
            this.photo7 = '';
          }else if(indx==='8'){
            this.photo8 = '';
          }else if(indx==='9'){
            this.photo9 = '';
          }
          
        },
        confirmPhoto(){

          let commentData ={
            removeImage: this.removeImage,
            newImage: this.images,
            type:1
          };

          axios.post(this.url+'/featured-photo',commentData).then( response=> {
            console.log(response.data);
            if(response.data==='error'){

            }else{
              $(".overlay-modal, .travel_dialog").removeAttr("style");
              this.featuredphoto = response.data;
            }
          });  
        },
        singleImage(ind, imageInfo){
          this.showImages = this.featuredphoto;
          this.imageInfo = imageInfo.image;
          
          this.nextPost = ind+1;
          this.prePost = ind-1;
          
          this.showModal = true;
          
        },
          
      },
        
      mounted(){
	    	
        axios.get(this.url+'/featured-photo/'+this.userid).then( response=> {
          this.featuredphoto = response.data;
          
          for (var i = 0; i < this.featuredphoto.length; i++) {
            
            if([i][0] === 0){

              this.photo1 = this.url+'/images/post/photo/thum/'+this.featuredphoto[i].image;
            }else if([i][0] === 1){
              this.photo2 = this.url+'/images/post/photo/thum/'+this.featuredphoto[i].image;
            }else if([i][0] === 2){
              this.photo3 = this.url+'/images/post/photo/thum/'+this.featuredphoto[i].image;
            }else if([i][0] === 3){
              this.photo4 = this.url+'/images/post/photo/thum/'+this.featuredphoto[i].image;
            }else if([i][0] === 4){
              this.photo5 = this.url+'/images/post/photo/thum/'+this.featuredphoto[i].image;
            }else if([i][0] === 5){
              this.photo6 = this.url+'/images/post/photo/thum/'+this.featuredphoto[i].image;
            }else if([i][0] === 6){
              this.photo7 = this.url+'/images/post/photo/thum/'+this.featuredphoto[i].image;
            }else if([i][0] === 7){
              this.photo8 = this.url+'/images/post/photo/thum/'+this.featuredphoto[i].image;
            }else if([i][0] === 8){
              this.photo9 = this.url+'/images/post/photo/thum/'+this.featuredphoto[i].image;
            }
            
          }
          
          //console.log(response.data);
        });  

        axios.get(this.url+'/user-wise-post-image/'+this.userid).then( response=> {
          this.yourPhotos = response.data;
          //console.log(this.postPhotos);
            
        });
		    
	    }
    }
</script>


