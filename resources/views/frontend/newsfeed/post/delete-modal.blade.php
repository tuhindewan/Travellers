<div class="section-delete"> 
  <div class="overlay-modal overlay-modal-delete<?php echo $_id; ?>" style="margin-left: -435px; display: none;">
    <div class="travel_dialog show_travel_modal<?php echo $_id; ?>" style="min-height: 90px;">
      <div class="fade-box-delete fade-box<?php echo $_id; ?>">
        <div class="inner_gray clearfix">
          <div class="inner_gray_text">
          Delete  <?php echo $headerMessage; ?>
          </div>
          <div class="inner_gray_close_button">
            <a href="#" class="close" role="button" title="Close">Close</a>
          </div>
        </div>
        <div class="inner_body">
          <div class="inner_body_content">
            <?php echo $bodyMessage; ?>
          </div>
          <div class="inner_buttons">
            <button class="okay_modal_button delete_button_ok<?php echo $_id; ?>" type="submit" tabindex="0">
              Okay
            </button>
            <a class="cancel_modal_button cancel_delete" role="button"> Cancel </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>