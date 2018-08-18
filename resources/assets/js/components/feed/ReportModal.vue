<template>
	<div>
		<div class="section">
		  <div :class="'overlay-modal report-modal'+tId" style="margin-left: 0; display: none;">
		    <div :class="'travel_dialog show_report_modal'+tId" style="min-height: 90px;">
		      <div :class="'fade-box-edit fade-box'+tId">
		        <div class="inner_gray clearfix">
		          <div class="inner_gray_text">
		           Give report on this {{ typeData }}
		          </div>
		          <div class="inner_gray_close_button">
		            <a href="#" class="close" role="button" title="Close">Close</a>
		          </div>
		        </div>
		        <div class="inner_body report_content">
		          <div class="inner_body_content">
		          	<img :src="url+'/public/img/notification_warning.png'" class="inline">
		          	<p class="inline">We use your feedback to help us learn when something isn't right.</p>
		          	
		          	<div v-if="typeData==='post'" class="form-horizontal row">
                        <div class="col-sm-6">
                        	<div class="radio">
							  <label>
							    <input type="radio" name="radio" id="Nudity" value="nudity" v-model="catType">
							    Nudity
							  </label>
							</div>
							<div class="radio">
							  <label>
							    <input type="radio" name="radio" id="Violence" value="violence" v-model="catType">
							    Violence
							  </label>
							</div>
							<div class="radio">
							  <label>
							    <input type="radio" name="radio" id="Harassment" value="harassment" v-model="catType">
							    Harassment
							  </label>
							</div>
							<div class="radio">
							  <label>
							    <input type="radio" name="radio" id="Spam" value="spam" v-model="catType">
							   	Spam
							  </label>
							</div>
                        </div>
						<div class="col-sm-6">
							<div class="radio">
							  <label>
							    <input type="radio" name="radio" id="False" value="false news" v-model="catType">
							   	False news
							  </label>
							</div>
							<div class="radio">
							  <label>
							    <input type="radio" name="radio" id="Unauthorised" value="unauthorised sales" v-model="catType">
							   	Unauthorised sales
							  </label>
							</div>
							<div class="radio">
							  <label>
							    <input type="radio" name="radio" id="Hate" value="hate speech" v-model="catType">
							   	Hate speech
							  </label>
							</div>
							<div class="radio">
							  <label>
							    <input type="radio" name="radio" id="Other" value="Other" v-model="catType">
							    Other
							  </label>
							</div>
						</div>
                    </div>
                    <div v-if="typeData==='user'" class="form-horizontal row">
                    	
                        <div class="col-sm-6">
                        	<div class="radio">
							  <label>
							    <input type="radio" name="radio" id="annoying" value="this person is annoying me" v-model="catType">
							    This person is annoying me
							  </label>
							</div>
							<div class="radio">
							  <label>
							    <input type="radio" name="radio" id="pretending" value="they're pretending to be me or someone i know" v-model="catType">
							    They're pretending to be me or someone I know
							  </label>
							</div>
							<div class="radio">
							  <label>
							    <input type="radio" name="radio" id="fake" value="this is a fake account" v-model="catType">
							    This is a fake account
							  </label>
							</div>
							<div class="radio">
							  <label>
							    <input type="radio" name="radio" id="Close" value="close this account" v-model="catType">
							   	Close this account
							  </label>
							</div>
							
                        </div>
                        <div class="col-sm-6">
                        	
							<div class="radio">
							  <label>
							    <input type="radio" name="radio" id="This" value="this profile represents a business or organisation" v-model="catType">
							   	This profile represents a business or organisation
							  </label>
							</div>
							<div class="radio">
							  <label>
							    <input type="radio" name="radio" id="They" value="they're using a different name than they use in everyday life" v-model="catType">
							   	They're using a different name than they use in everyday life
							  </label>
							</div>
							
                        </div>
						
                    </div>
                    <hr>
                    <p>Type somthing about report</p>
		            <textarea :id="'report'+tId" v-model="reportText" class="form-control edit-textarea"></textarea>
		          </div>
		          <div class="inner_buttons">
		            <button :class="'okay_modal_button report'+tId" @click="confirmReport" type="submit" tabindex="0" v-bind:disabled="!catType">
		              send
		            </button>
		            <!-- <a class="cancel_modal_button cancel_report" role="button"> Cancel </a> -->
		          </div>
		        </div>
		        <div class="confirm_message" style="display:none">
		        	<div class="row">
		        		<div class="col-sm-12">
		        			<div class="img_message">
		        				<img :src="url+'/public/img/notification_warning50.png'">
			        		</div>
			        		<h4 class="text-center">Thanks! We've received your feedback.</h4>
		        		</div>
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
                authId:$("#authId").val(),
                reportText:'',
                catType:'',
                btnDisable: false,
                //post:'',
                
            }
        },
		
        props:['typeData','tId'],
        methods:{
        	confirmReport(){
        		let reportData = {
                    type:this.typeData,
                    category:this.catType,
                    fk_user_id:this.authId,
                    description:this.reportText,
                    report_type_id:this.tId,
                    status: 0,
                };

                let notifiy = {
                    title:'Error report',
                    message:'Something error found! Please reload the page and try again',
                    type:'error'
                };
                
                

                axios.post(this.url+'/reports',reportData).then( response=> {
                	
                	if(response.data==='success'){
                		$(".inner_gray_text").html('Confirmation')
		                var confirm = $(".confirm_message").html();
		                $(".report_content").html(confirm);
		                
                	}else if(response.data==='exist'){
                		$(".inner_gray_text").html('Reported')
		                var confirm = '<h4 class="text-center">You are already reported</h4>';
		                $(".report_content").html(confirm);
                	}else{

                    	this.reportMsg(notifiy);
                	}
                });
        	}
        },
        notifications: {
	      reportMsg: {}
	    },
	    mounted(){
	    	
	    },
	    ready () { 
	      miniToastr.init();
	    },
        
        

    }
</script>

<style>
button[disabled], html input[disabled] {
    cursor: default;
    opacity: .8;
}
.mini-toastr-notification__message{padding:0}
</style>

