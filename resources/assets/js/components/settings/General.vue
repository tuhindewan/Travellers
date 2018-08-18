<template>
  	<div>
  		<div class="settings_section">
        <div class="panel panel-success">
          <div class="panel-heading">General Account Settings</div>
          <div class="panel-body">
            <div class="alert alert-danger alert-dismissable" style="color:red; display:none" id="post-error-message">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="font-size:14px !important;">×</button>
              <b>something went wrong please try again</b> 
            </div>
            <div class="alert alert-success alert-dismissable" style="color:green; display:none" id="post-success-message">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="font-size:14px !important;">×</button>
              <b>updated sucessfully</b> 
            </div>
            
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                  <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#Name" aria-expanded="false" aria-controls="Name">
                      <div class="row">
                        <div class="col-xs-3">Name</div>
                        <div class="col-xs-7">{{ authInfo.fullname }}</div>
                        <div class="col-xs-2"><a href="#">Edit</a></div>
                      </div>
                    </a>
                  </h4>
                </div>
                <div id="Name" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                  <div class="panel-body">
                    <div class="panel-center">
                      
                      <div class="form-horizontal">
                        <div class="form-group">
                          <label for="FName" class="col-sm-4 control-label">First Name</label>
                          <div class="col-sm-8">
                            <input required="required" v-model="firstname" type="text" class="form-control" id="FName" placeholder="First Name">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="MName" class="col-sm-4 control-label">Middel Name</label>
                          <div class="col-sm-8">
                            <input v-model="middlename" type="text" class="form-control" id="MName" placeholder="Middel Name">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="LName" class="col-sm-4 control-label">Last Name</label>
                          <div class="col-sm-8">
                            <input required="required" v-model="lastname" type="text" class="form-control" id="LName" placeholder="Last Name">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <div class="col-sm-offset-4 col-sm-10">
                            <button type="button" @click="updateInfo()" class="btn btn-success btn-sm">Update</button>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwo">
                  <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#Email" aria-expanded="false" aria-controls="Email">
                      <div class="row">
                        <div class="col-xs-3">Email</div>
                        <div class="col-xs-7">{{ email }}</div>
                        <div class="col-xs-2"><a href="#">Edit</a></div>
                      </div>
                    </a>
                  </h4>
                </div>
                <div id="Email" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                  <div class="panel-body">
                    <div class="panel-center">
                      <div class="form-horizontal">
                        <div class="form-group">
                          <label for="Eamil" class="col-sm-4 control-label">Email</label>
                          <div class="col-sm-8">
                            <input required="required" v-model="email" type="email" class="form-control" id="Eamil" placeholder="Email">
                          </div>
                        </div>
                        
                        
                        <div class="form-group">
                          <div class="col-sm-offset-4 col-sm-10">
                            <button type="button" @click="updateInfo()" class="btn btn-success btn-sm">Update</button>
                            
                          </div>
                        </div>
                      </div>
                    </div> 
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingThree">
                  <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#Phone" aria-expanded="false" aria-controls="Phone">
                      <div class="row">
                        <div class="col-xs-3">Phone</div>
                        <div class="col-xs-7">{{ authInfo.country_code }}{{ phone }}</div>
                        <div class="col-xs-2"><a href="#">Edit</a></div>
                      </div>
                    </a>
                  </h4>
                </div>
                <div id="Phone" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                  <div class="panel-body">
                    <div class="panel-center">
                      <div class="form-horizontal">
                        
                        <div class="form-group">
                          <label for="Phone" class="col-sm-4 control-label">Phone</label>
                          <div class="col-sm-8 input-group">
                            <div class="input-group-addon">{{ authInfo.country_code }}</div>
                            <input required="required" v-model="phone" type="text" class="form-control" id="Phone" placeholder="Phone">
                          </div>
                        </div>
                        
                        
                        <div class="form-group">
                          <div class="col-sm-offset-4 col-sm-10">
                            <button type="button" @click="updateInfo()" class="btn btn-success btn-sm">Update</button>
                            
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
            authInfo:{},
            
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
      updateInfo(){
        if(this.checkUserAccess === false){
          this.checkUser();
        }

        if(this.checkUserAccess === true){
          let nameData = {
            firstname:this.firstname,
            middlename:this.middlename,
            lastname:this.lastname,
            email:this.email,
            phone:this.phone,
            fullname:this.firstname+' '+this.middlename+' '+this.lastname,
          };
          axios.post(this.url+'/updated-user-info',nameData).then( response=> {
              //console.log(response.data);
              if(response.data=='yes'){
                $("#post-error-message").hide();
                $("#post-success-message").show();
                
                this.authInfo.fullname=this.firstname+' '+this.middlename+' '+this.lastname;
                //window.location.href=this.url+"/settings";
              }else{
                $("#post-success-message").hide();
                $("#post-error-message").show();
              }
          });

        }else{
          this.checkUser();
        }

      },
      

        
    },
    
    
    

    mounted(){
      
      axios.get(this.url+'/auth-info').then( response=> {
          this.authInfo   = response.data;
          this.firstname  = this.authInfo.firstname;
          this.lastname   = this.authInfo.lastname;
          this.middlename = this.authInfo.middlename;
          this.email      = this.authInfo.email;
          this.phone      = this.authInfo.phone;
      });
    
    }
  }
</script>

<style>

.panel-default>.panel-heading:hover {
    background: #f9f9f9;
}
.panel-center{width:50%; margin:0 auto;}
</style>
