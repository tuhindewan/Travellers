<style>
  .edit-textarea{overflow-y: scroll !important; height: 250px !important; overflow:auto !important;}
</style>
<div class="section">
  <div class="overlay-modal post-modal-edit<?php echo $_id; ?>" style="margin-left: -435px; display: none;">
    <div class="travel_dialog show_post_edit<?php echo $_id; ?>" style="min-height: 90px;">
      <div class="fade-box-edit fade-box<?php echo $_id; ?>">
        <div class="inner_gray clearfix">
          <div class="inner_gray_text">
           Edit <?php echo $headerMessage; ?>
            
          </div>
          <div class="inner_gray_close_button">
            <a href="#" class="close" role="button" title="Close">Close</a>
          </div>
        </div>
        <div class="inner_body">
          <div class="inner_body_content">
            <textarea id="post-edit<?php echo $post['_id'];?>" class="form-control edit-textarea"><?php echo $post['description']; ?></textarea>
          </div>
          <div class="inner_buttons">
            <button class="okay_modal_button edit_post<?php echo $_id; ?>" type="submit" tabindex="0">
              Okay
            </button>
            <a class="cancel_modal_button cancel_edit" role="button"> Cancel </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
