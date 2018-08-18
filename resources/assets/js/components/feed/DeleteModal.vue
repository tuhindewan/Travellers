<template>
	<div class="section-delete"> 
	  <div :class="'overlay-modal overlay-modal-delete'+id" style="margin-left: 0px; display: none;">
	    <div :class="'travel_dialog show_travel_modal'+id" style="min-height: 90px;">
	      <div :class="'fade-box-delete fade-box'+id">
	        <div class="inner_gray clearfix">
	          <div class="inner_gray_text">
	          Delete {{ title }}
	          </div>
	          <div class="inner_gray_close_button">
	            <a href="#" class="close" role="button" title="Close">Close</a>
	          </div>
	        </div>
	        <div class="inner_body">
	          <div class="inner_body_content">
	            Are you sure you want to delete this {{ title }}?
	          </div>

	          <div class="inner_buttons">
	            <button :class="'okay_modal_button delete_button_ok'" type="submit" tabindex="0" @click="deleteData">
	              Okay
	            </button>
	            <a class="cancel_modal_button cancel_delete" role="button"> Cancel </a>
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
                //post:'',
                
            }
        },
		
        props:['id','title','route_name','remove_div'],

        methods:{
        	deleteData(){
        		axios.delete(this.url+'/'+this.route_name+'/'+this.id).then( response=> {
        			//console.log(response.data);
        			$("."+this.remove_div+this.id).css('display','none');
	                
                });
        	}
        },
        mounted() {
           
        }

        
        

    }
</script>