<template>
	<div>
		
    <div class="dropdown inline report_section">
                    
      <button type="button" class="btn btn-success btn-sm dropdown-toggle change_drop user-report" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size:28px;">
          ...
      </button>
        
        <div class="dropdown-menu change_dropdown post_edit_btn user_edit_btn" aria-labelledby="dropdownMenuButton" style="border: 1px solid #ccc;">
          <a class="dropdown-item show-dialog-pop" :id="'report-data'+reportid" onclick="report(this.id)">Report</a>
          <a class="dropdown-item show-dialog-pop">Block</a>
        </div>
        <!-- report modal section -->
        <reportModal typeData='user' :tId="reportid"></reportModal>
        <!-- report modal section end -->
      
    </div>

	</div>
</template>

<script>
  import reportModal from '../feed/ReportModal.vue';
	export default {
		data() {

            return {
            	url:$("#base_url").val(),
              authId:$("#authId").val(),
                
                
            }
        },
        http: {
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	       },
        // components:{
        //     Popper
        // },
      		
        props:['reportid'],
        components:{
          reportModal
        },
        methods:{
        		
          
          
        	
        },
        mounted(){
        	
	    		
		    
	    },
        
        

    }
</script>