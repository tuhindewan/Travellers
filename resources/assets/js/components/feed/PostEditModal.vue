<template>
	<div>
		<div class="section">
		  <div :class="'overlay-modal post-modal-edit'+post._id" style="margin-left: 0; display: none;">
		    <div :class="'travel_dialog show_post_edit'+post._id" style="min-height: 90px;">
		      <div :class="'fade-box-edit fade-box'+post._id">
		        <div class="inner_gray clearfix">
		          <div class="inner_gray_text">
		           Edit Post
		          </div>
		          <div class="inner_gray_close_button">
		            <a href="#" class="close" role="button" title="Close">Close</a>
		          </div>
		        </div>
		        <div class="inner_body">
		          <div class="inner_body_content">
		            <textarea :id="'post-edit'+post._id" class="form-control edit-textarea">{{ post.description }}</textarea>
		          </div>
		          <div class="inner_buttons">
		            <button :class="'okay_modal_button edit_post'+post._id" type="submit" tabindex="0">
		              Okay
		            </button>
		            <a class="cancel_modal_button cancel_edit" role="button"> Cancel </a>
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
                //post:'',
                
            }
        },
		
        props:['post'],

        
        

    }
</script>