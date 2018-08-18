<template>
  	<div class="personal_information_content">
  		<div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">CONTACT INFORMATION</h3>
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
                      Phone
                    </div>
                    <div class="col-sm-7">
                      {{ phone }}
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
                      Address
                    </div>
                    <div class="col-sm-8">
                      {{ address }}
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
                      Email
                    </div>
                    <div class="col-sm-8">
                      {{ email }}
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
                      Phone
                    </div>
                    <div class="col-sm-7">
                      {{ userInfo.country_code }}{{ phone }}
                    </div>
                    <div class="col-sm-1">
                      <a class="accordion-toggle per_info_editable" data-toggle="collapse" data-parent="#accordion" href="#Phone">
                        Edit
                      </a>
                    </div>
                  </div>
                 
                </h4>
              </div>
              <div id="Phone" class="panel-collapse collapse">
                <div class="panel-body">
                  <div class="panel-center">
                      <div class="form-horizontal">
                        
                        <div class="form-group">
                          <label for="Phone" class="col-sm-4 control-label">Phone</label>
                          <div class="col-sm-8 input-group">
                            <div class="input-group-addon">{{ authInfo.country_code }}</div>
                            <input required="required" v-model="phone" type="number" class="form-control" id="Phone" placeholder="Phone">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <div class="col-sm-offset-4 col-sm-10">
                            <button type="button" @click="updatePhone()" class="btn btn-success btn-sm">Update</button>
                            
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
                      Address
                    </div>
                    <div class="col-sm-7">
                      <div v-if="address">
                        {{ address }}
                      </div>
                      <div v-else>
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#Address">
                        Add Address
                      </a>
                      </div>
                    </div>
                    <div class="col-sm-1">
                      <a class="accordion-toggle per_info_editable" data-toggle="collapse" data-parent="#accordion" href="#Address">
                        Edit
                      </a>
                    </div>
                  </div>
                 
                </h4>
              </div>
              <div id="Address" class="panel-collapse collapse">
                <div class="panel-body">
                  <div class="panel-center">
                      <div class="form-horizontal">
                        
                        <div class="form-group">
                          <label for="Address" class="col-sm-4 control-label">Address</label>
                          <div class="col-sm-8 input-group">
                            
                            <input required="required" v-model="address" type="text" class="form-control" id="Address" placeholder="Address">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <div class="col-sm-offset-4 col-sm-10">
                            <button type="button" @click="updateAddress()" class="btn btn-success btn-sm">Update</button>
                            
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
                      Email
                    </div>
                    <div class="col-sm-7">
                      {{ email }}
                    </div>
                    <div class="col-sm-1">
                      <a class="accordion-toggle per_info_editable" data-toggle="collapse" data-parent="#accordion" href="#Email">
                        Edit
                      </a>
                    </div>
                  </div>
                 
                </h4>
              </div>
              <div id="Email" class="panel-collapse collapse">
                <div class="panel-body">
                  <div class="panel-center">
                      <div class="form-horizontal">
                        
                        <div class="form-group">
                          <label for="Email" class="col-sm-4 control-label">Email</label>
                          <div class="col-sm-8 input-group">
                            
                            <input required="required" v-model="email" type="email" class="form-control" id="Email" placeholder="Email">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <div class="col-sm-offset-4 col-sm-10">
                            <button type="button" @click="updateEmail()" class="btn btn-success btn-sm">Update</button>
                            
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
                      Link
                    </div>
                    <div class="col-sm-7">
                      <span style="text-transform: none;">{{url}}/{{userInfo.username}}</span>
                    </div>
                    <div class="col-sm-1">
                      
                    </div>
                  </div>
                 
                </h4>
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
      <!-- basic -->
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">BASIC INFORMATION</h3>
        </div>
        <div class="panel-body">
          <div v-if="authInfo._id !== userInfo._id" class="panel-group unauthorize" id="accordion">
            <div class="panel panel-default panel-ediable">
              <div class="panel-heading">
                <h4 class="panel-title ">
                  <div class="row">
                    <div class="col-sm-4">
                      Birth Date
                    </div>
                    <div class="col-sm-7">
                      {{ month }} {{ day }}
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
                      Birth Year
                    </div>
                    <div class="col-sm-8">
                      {{ year }}
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
                      Gender
                    </div>
                    <div class="col-sm-8">
                      {{ userInfo.gender }}
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
                      Birth Date
                    </div>
                    <div class="col-sm-7">
                      {{month}} {{day}} 
                    </div>
                    <div class="col-sm-1">
                      <!-- <a class="accordion-toggle per_info_editable" data-toggle="collapse" data-parent="#accordion" href="#B-Date">
                        Edit
                      </a> -->
                    </div>
                  </div>
                 
                </h4>
              </div>
              <div id="B-Date" class="panel-collapse collapse">
                <div class="panel-body">
                  <div class="panel-center">
                      <div class="form-horizontal">
                        
                        <div class="form-group">
                          <label for="B-Date" class="col-sm-4 control-label">Birth Date</label>
                          <div class="col-sm-8 input-group">
                            
                            
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <div class="col-sm-offset-4 col-sm-10">
                            <button type="button" @click="updateAddress()" class="btn btn-success btn-sm">Update</button>
                            
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
                      Birth Year
                    </div>
                    <div class="col-sm-7">
                      {{ year }}
                    </div>
                    <div class="col-sm-1">
                      <!-- <a class="accordion-toggle per_info_editable" data-toggle="collapse" data-parent="#accordion" href="#B-Year">
                        Edit
                      </a> -->
                    </div>
                  </div>
                 
                </h4>
              </div>
              <div id="B-Year" class="panel-collapse collapse">
                <div class="panel-body">
                  Anim pariatur cliche reprehenderit, 
                </div>
              </div>
            </div>
            <div class="panel panel-default panel-ediable">
              <div class="panel-heading">
                <h4 class="panel-title ">
                  <div class="row">
                    <div class="col-sm-4">
                      Gender
                    </div>
                    <div class="col-sm-7">
                      {{ userInfo.gender }}
                    </div>
                    <div class="col-sm-1">
                      <!-- <a class="accordion-toggle per_info_editable" data-toggle="collapse" data-parent="#accordion" href="#Gender">
                        Edit
                      </a> -->
                    </div>
                  </div>
                 
                </h4>
              </div>
              <div id="Gender" class="panel-collapse collapse">
                <div class="panel-body">
                  Anim pariatur cliche reprehenderit, 
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
  	</div>
    
</template>

<script>

  export default {
    
    data() {

        return {
            url:$("#base_url").val(),
            checkUserAccess:false,
            checkPass:'',
            phone:'',
            email:'',
            firstname:'',
            middlename:'',
            lastname:'',
            address:'',
            userInfo:{},
            authInfo:{},
            message:'',
            status:'',
            Data:{},
            day:'',
            month:'',
            year:''
            
            
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
      updatePhone(){
        let Data = {
          phone:this.phone,
        };
        if(this.phone !=='' && this.phone!==this.userInfo.phone){
          this.Data = Data;
          this.updateInfo(); 
        }else{
          $('.collapse').collapse('hide');
        }
        
      },
      updateAddress(){
        let Data = {
          address:this.address,
        };
        if(this.address !=='' && this.address!==this.userInfo.address){
          this.Data = Data;
          this.updateInfo(); 
        }else{
          $('.collapse').collapse('hide');
        }
        
      },
      updateEmail(){
        let Data = {
          email:this.email,
        };
        if(this.email !=='' && this.email!==this.userInfo.email){
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
          this.firstname  = this.userInfo.firstname;
          this.lastname   = this.userInfo.lastname;
          this.middlename = this.userInfo.middlename;
          this.email      = this.userInfo.email;
          this.phone      = this.userInfo.phone;
          this.address      = this.userInfo.address;
          this.day      = this.userInfo.day;
          this.month      = this.userInfo.month;
          this.year      = this.userInfo.year;
          
      });
      
      
    }
  }
</script>
<style>
.per_info_editable{display:inline; float:right}
.panel-default>.panel-heading { overflow: hidden; }
.panel-ediable>.panel-heading {background: #fbfbfb !important;}
.panel-ediable>.panel-heading:hover{background: #fff !important;}
</style>



