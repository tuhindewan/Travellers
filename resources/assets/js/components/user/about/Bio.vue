<template>
  	<div class="personal_information_content">
  		
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">BIO INFORMATION</h3>
        </div>
        <div class="panel-body">
          <div v-if="message !== ''" :class="'alert alert-'+status+' alert-dismissable'">
              
              <b>{{message}}</b> 

            </div>
          <div v-if="authInfo._id !== userInfo._id" class="panel-group unauthorize" id="accordion">
            <div class="panel panel-default panel-ediable">
              <div class="panel-heading">
                <h4 class="panel-title ">
                  <div class="row">
                    <div class="col-sm-4">
                      Interest
                    </div>
                    <div class="col-sm-7">
                      <span v-for="interest in interests">{{ interest.name }} ,</span>
                    </div>
                    
                  </div>
                 
                </h4>
              </div>
            </div>
            <div class="panel panel-default panel-ediable">
              <div class="panel-heading">
                <h4 class="panel-title ">
                  <div class="row">
                    <div class="col-sm-4">
                      Prefers
                    </div>
                    <div class="col-sm-8">
                      <span v-for="perfer in prefers">{{ perfer.name }} ,</span> 
                    </div>
                  </div>
                 
                </h4>
              </div>
            </div>
            <div class="panel panel-default panel-ediable">
              <div class="panel-heading">
                <h4 class="panel-title ">
                  <div class="row">
                    <div class="col-sm-4">
                      {{userInfo.fullname}} is 
                    </div>
                    <div class="col-sm-8">
                      <span v-for="into in intos">{{ into.name }} ,</span>
                    </div>
                  </div>
                 
                </h4>
              </div>
            </div>
            <div class="panel panel-default panel-ediable">
              <div class="panel-heading">
                <h4 class="panel-title ">
                  <div class="row">
                    <div class="col-sm-4">
                      Inspiration
                    </div>
                    <div class="col-sm-8">
                      {{ inspiration }}
                    </div>
                  </div>
                 
                </h4>
              </div>
            </div>
            
          </div>
          <div v-if="authInfo._id === userInfo._id" class="panel-group authorize" id="accordion">
            
            <div class="panel panel-default panel-ediable">
              <div class="panel-heading">
                <h4 class="panel-title ">
                  <div class="row">
                    <div class="col-sm-4">
                      Interest
                    </div>
                    <div class="col-sm-7">
                      <div v-if="interests.length > 0">
                        <span v-for="interest in interests">{{ interest.name }} ,</span>
                      </div>
                      <div v-else>
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#Interest">
                        Add interest
                      </a>
                      </div>
                      
                    </div>
                    <div class="col-sm-1">
                      <a class="accordion-toggle per_info_editable" data-toggle="collapse" data-parent="#accordion" href="#Interest">
                        Edit
                      </a>
                    </div>
                  </div>
                 
                </h4>
              </div>
              <div id="Interest" class="panel-collapse collapse">
                <div class="panel-body">
                  <div class="panel-center">
                      <div class="form-horizontal">
                        
                        <div class="form-group">
                          <label for="Interest" class="col-sm-4 control-label">Interest</label>
                          <div class="col-sm-8 input-group">
                            <multiselect v-model="interests" :options="interestOptions" :multiple="true" :close-on-select="false" :clear-on-select="false" :hide-selected="true" :preserve-search="true" placeholder="Pick some" label="name" track-by="name" :preselect-first="false">
                              <template slot="tag" slot-scope="props"><span class="custom__tag"><span>{{ props.option.name }}</span><span class="custom__remove" @click="props.remove(props.option)">❌</span></span></template>
                            </multiselect>
                            
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <div class="col-sm-offset-4 col-sm-10">
                            <button type="button" @click="updateInterest()" class="btn btn-success btn-sm">Update</button>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                  
                </div>
              </div>
            </div>
            <div class="panel panel-default panel-ediable">
              <div class="panel-heading">
                <h4 class="panel-title ">
                  <div class="row">
                    <div class="col-sm-4">
                      Prefers
                    </div>
                    <div class="col-sm-7">
                      
                      <div v-if="prefers.length > 0">
                        <span v-for="perfer in prefers">{{ perfer.name }} ,</span> 
                      </div>
                      <div v-else>
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#Prefers">
                        Add Prefers
                        </a>
                      </div>
                    </div>
                    <div class="col-sm-1">
                      <a class="accordion-toggle per_info_editable" data-toggle="collapse" data-parent="#accordion" href="#Prefers">
                        Edit
                      </a>
                    </div>
                  </div>
                 
                </h4>
              </div>
              <div id="Prefers" class="panel-collapse collapse">
                <div class="panel-body">
                  <div class="panel-center">
                      <div class="form-horizontal">
                        
                        <div class="form-group">
                          <label for="Prefers" class="col-sm-4 control-label">Prefers</label>
                          <div class="col-sm-8 input-group">
                            <multiselect v-model="prefers" :options="preferOptions" :multiple="true" :close-on-select="false" :clear-on-select="false" :hide-selected="true" :preserve-search="true" placeholder="Pick some" label="name" track-by="name" :preselect-first="false">
                              <template slot="tag" slot-scope="props"><span class="custom__tag"><span>{{ props.option.name }}</span><span class="custom__remove" @click="props.remove(props.option)">❌</span></span></template>
                            </multiselect>
                            
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <div class="col-sm-offset-4 col-sm-10">
                            <button type="button" @click="updatePerfer()" class="btn btn-success btn-sm">Update</button>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
            <div class="panel panel-default panel-ediable">
              <div class="panel-heading">
                <h4 class="panel-title ">
                  <div class="row">
                    <div class="col-sm-4">
                      I am
                    </div>
                    <div class="col-sm-7">
                      <div v-if="intos.length > 0">
                        <span v-for="into in intos">{{ into.name }} ,</span> 
                      </div>
                      <div v-else>
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#Me">
                        Add what are you?
                        </a>
                      </div>
                    </div>
                    <div class="col-sm-1">
                      <a class="accordion-toggle per_info_editable" data-toggle="collapse" data-parent="#accordion" href="#Me">
                        Edit
                      </a>
                    </div>
                  </div>
                 
                </h4>
              </div>
              <div id="Me" class="panel-collapse collapse">
                <div class="panel-body">
                  <div class="panel-center">
                      <div class="form-horizontal">
                        
                        <div class="form-group">
                          <label for="ME" class="col-sm-4 control-label">I am</label>
                          <div class="col-sm-8 input-group">
                            <multiselect v-model="intos" :options="meOptions" :multiple="true" :close-on-select="false" :clear-on-select="false" :hide-selected="true" :preserve-search="true" placeholder="Pick some" label="name" track-by="name" :preselect-first="false">
                              <template slot="tag" slot-scope="props"><span class="custom__tag"><span>{{ props.option.name }}</span><span class="custom__remove" @click="props.remove(props.option)">❌</span></span></template>
                            </multiselect>
                            
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <div class="col-sm-offset-4 col-sm-10">
                            <button type="button" @click="updateInto()" class="btn btn-success btn-sm">Update</button>
                            
                          </div>
                        </div>
                      </div>
                    </div> 
                </div>
              </div>
            </div>
            <div class="panel panel-default panel-ediable">
              <div class="panel-heading">
                <h4 class="panel-title ">
                  <div class="row">
                    <div class="col-sm-4">
                      Inspiration
                    </div>
                    <div class="col-sm-7">
                      <div v-if="inspiration">
                        <span>{{ inspiration }} </span> 
                      </div>
                      <div v-else>
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#Inspiration">
                        Add inspiration
                        </a>
                      </div>
                    </div>
                    <div class="col-sm-1">
                      <a class="accordion-toggle per_info_editable" data-toggle="collapse" data-parent="#accordion" href="#Inspiration">
                        Edit
                      </a>
                    </div>
                  </div>
                 
                </h4>
              </div>
              <div id="Inspiration" class="panel-collapse collapse">
                <div class="panel-body">
                  <div class="panel-center">
                      <div class="form-horizontal">
                        
                        <div class="form-group">
                          <label for="Inspiration" class="col-sm-4 control-label">Inspiration</label>
                          <div class="col-sm-8 input-group">
                            
                            <!-- <input required="required" v-model="inspiration" type="text" class="form-control" id="Inspiration" placeholder="Inspiration"> -->
                            <textarea required="required" v-model="inspiration" type="text" class="form-control" id="Inspiration" placeholder="Inspiration"></textarea>
                            <span style="color:red">Max word 250</span>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <div class="col-sm-offset-4 col-sm-10">
                            <button type="button" @click="updateInspiration()" class="btn btn-success btn-sm">Update</button>
                            
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
      <div class="modal-check">
        <div class="overlay-modal overlay-modal-check" style="margin-left: 0px; display: none;">
          <div class="travel_dialog show_travel_modal" style="min-height: 90px;">
            <div class="fade-box-delete fade-box">
              <div class="inner_gray clearfix">
                <div class="inner_gray_text">
                Check Password
                </div>
                <div class="inner_gray_close_button">
                  <a href="#" @click="closeModal" class="close" role="button" title="Close">Close</a>
                </div>
              </div>
              <div class="inner_body">
                <div class="inner_body_content">
                  <div class="form-horizontal">
                    <div class="form-group">
                      <label for="OD" class="col-sm-5 no_padding control-label">Type Your Password : </label>
                      <div class="col-sm-7">
                        <input v-model="checkPass" type="password" class="form-control" id="OD" @keyup.enter="checkPassword" placeholder="Type Password">
                        <small style="color:red; display:none" id="error-message">Password do not match</small>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="inner_buttons">
                  <button class="okay_modal_button check_button_ok" type="button" tabindex="0" @click="checkPassword">
                    Confirm
                  </button>
                  <a class="cancel_modal_button cancel_check" @click="closeModal" role="button"> Cancel </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  	</div>
    
</template>

<script>
  import Multiselect from 'vue-multiselect'

  // register globally
  //Vue.component('multiselect', Multiselect);
  export default {
    components: { Multiselect },
    props:['userInfo','authInfo'],
    data() {

        return {
            url:$("#base_url").val(),
            message:'',
            status:'',
            checkUserAccess:false,
            checkPass:'',
            interests: [],
            interestOptions: [
              { name: 'acting' },
              { name: 'archery' },
              { name: 'book restoration'},
              { name: 'calligraphy'},
              { name: 'computer programming'},
              { name: 'cooking' },
              { name: 'cryptography' },
              { name: 'dance' },
              { name: 'electronics' },
              { name: 'fashion' },
              { name: 'ice skating' },
              { name: 'jewelry making' },
              { name: 'listening to music' },
              { name: 'magic' },
              { name: 'painting' },
              { name: 'pet' },
              { name: 'photography' },
              { name: 'playing musical instruments' },
              { name: 'puzzles' },
              { name: 'reading' },
              { name: 'singing' },
              { name: 'stand-up comedy' },
              { name: 'table tennis' },
              { name: 'video gaming' },
              { name: 'watching movies' },
              { name: 'watching television' },
              { name: 'web surfing' },
              { name: 'writing' },
              { name: 'yoga' }
            ],
            prefers: [],
            preferOptions: [
              { name: 'travelling solo' },
              { name: 'as couple' },
              { name: 'in group' },
              { name: 'all of them' }
            ],
            intos: [],
            meOptions: [
              { name: 'actor' },
              { name: 'artist'},
              { name: 'doctor'},
              { name: 'engineer'},
              { name: 'student'},
              { name: 'teacher'},
            ],
            inspiration:'',
            authInfo:{},
            userInfo:{},
            Data:{},

            
            
        }
    },
    
    methods:{
     checkUser(){
        if(this.checkUserAccess===false){
          $(".overlay-modal-check").show();
          $(".show_travel_modal").css("width", "225").animate({
              "opacity" : 1,
              height : 'auto',
              width : "448"
          }, 600, function() {
              /*When animation is done show inside content*/
              $(".fade-box").show();
              $("#OD").focus();
          });

        }
      },
      checkPassword(){
        let passwordData = { password:this.checkPass};
        axios.post(this.url+'/check-password',passwordData).then( response=> {
            //console.log(response.data);
            if(response.data === 'yes'){
              this.checkUserAccess = true;
              this.updateInfo();
              $("#error-message").hide();
              $(".overlay-modal-check").fadeOut("slow", function() {
                /*Remove inline styles*/
                $(".overlay-modal, .travel_dialog").removeAttr("style");
              });
            }else{
              this.checkUserAccess = false;
              $("#error-message").show();
            }
        });
      },
      closeModal(){
        $(".overlay-modal-check").fadeOut("slow", function() {
          /*Remove inline styles*/
          $(".overlay-modal, .travel_dialog").removeAttr("style");
        });
      
      },
      updateInterest(){
        let Data = {
          interests:this.interests,
        };
        
        if(this.interests !==''){
          this.Data = Data;
          this.updateInfo(); 
        }else{
          $('.collapse').collapse('hide');
        }
        
      },
      updatePerfer(){
        let Data = {
          prefers:this.prefers,
        };
        
        if(this.prefers !==''){
          this.Data = Data;
          this.updateInfo(); 
        }else{
          $('.collapse').collapse('hide');
        }
        
      },
      updateInto(){
        let Data = {
          intos:this.intos,
        };
        
        if(this.intos !==''){
          this.Data = Data;
          this.updateInfo(); 
        }else{
          $('.collapse').collapse('hide');
        }
        
      },
      updateInspiration(){
        let Data = {
          inspiration:this.inspiration,
        };
        
        if(this.inspiration !==''){
          this.Data = Data;
          this.updateInfo(); 
        }else{
          $('.collapse').collapse('hide');
        }
        
      },
      
      updateInfo(){
        
        if(this.checkUserAccess === false){
          this.checkUser();
        }
        if(this.checkUserAccess === true){
          axios.post(this.url+'/change-user-info',this.Data).then( response=> {
            //console.log(response.data);

              if(response.data.status=='sucess'){
                
                this.message=response.data.message;
                this.status=response.data.status;
                
              }else{
                this.message=response.data.message;
                this.status=response.data.status;
              }
              $('.collapse').collapse('hide');
              
          });

        }else{
          this.checkUser();
        }

      },
      
    
    },
    mounted(){
      this.uId=$("#uId").val(),
      axios.get(this.url+'/auth-info').then( response=> {
          this.authInfo=response.data;
      });

      //get user id wise info
      axios.get(this.url+'/user/'+this.uId).then( response=> {
          this.userInfo = response.data;
          this.interests     = JSON.parse(this.userInfo.interests);
          this.prefers      = JSON.parse(this.userInfo.prefers);
          this.intos         = JSON.parse(this.userInfo.intos);
          this.inspiration  = this.userInfo.inspiration;
          
      });  
      
    
    }
  }
</script>

<style>
.per_info_editable{display:inlin; float:right}
.panel-default>.panel-heading { overflow: hidden; }
.panel-ediable>.panel-heading {background: #fbfbfb !important;}
.panel-ediable>.panel-heading:hover{background: #fff !important;}
.multiselect__content-wrapper{z-index:57 !important; max-height:170px !important;}
.multiselect__content{z-index:57 !important;}

</style>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>



