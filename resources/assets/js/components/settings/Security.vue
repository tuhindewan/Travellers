<template>
  	<div>
  		<div class="settings_section">
        <div class="panel panel-success">
          <div class="panel-heading">Change Password</div>
          <div class="panel-body">
            <div v-if="meassge !== ''" :class="'alert alert-'+status+' alert-dismissable'">
              
              <b>{{meassge}}</b> 
            </div>
            <div class="panel-center">
              <form class="form-horizontal">
                <div class="form-group">
                  <label for="old-password" class="col-sm-4 control-label">Old Password</label>
                  <div class="col-sm-8">
                    <input type="password" v-model="oldPassword" class="form-control" id="old-password" placeholder="Old Password">
                  </div>
                </div>
                <div class="form-group">
                  <label for="NP" class="col-sm-4 control-label">New Password</label>
                  <div class="col-sm-8">
                    <input type="password" v-model="newPassword" class="form-control" id="NP" placeholder="New Password">
                  </div>
                </div>
                <div class="form-group">
                  <label for="CNP" class="col-sm-4 control-label">Confirm New Password</label>
                  <div class="col-sm-8">
                    <input type="password" v-model="cNewPassword" class="form-control" id="CNP" placeholder="Confirm New Password">
                  </div>
                </div>
                
                <div class="form-group">
                  <div class="col-sm-offset-4 col-sm-10">
                    <button type="button" @click="updateInfo()" class="btn btn-success btn-sm">Update</button>
                  </div>
                </div>
              </form>
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
          cNewPassword:'',
          newPassword:'',
          oldPassword:'',
          meassge:'',
          status:''
           
          
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
          let passwordData = {
            old_password:this.oldPassword,
            new_password:this.newPassword,
            cnew_password:this.cNewPassword,
          };
          axios.post(this.url+'/updated-user-password',passwordData).then( response=> {
              //console.log(response.data);
              if(response.data.status=='sucess'){
                
                this.meassge=response.data.message;
                this.status=response.data.status;

                
              }else{
                this.meassge=response.data.message;
                this.status=response.data.status;
              }
          });

        }else{
          this.checkUser();
        }

      },  

        
    },
    
    
    

    mounted(){
    

    
    }
  }
</script>
