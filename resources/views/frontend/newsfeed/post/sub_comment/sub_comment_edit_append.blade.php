
    <textarea name="sub_comment" class="form-control post-sub-comment" id="sub_comment<?php echo $comment['_id'];?>" onkeypress="sub_comment_update(event , this.id, this.value)" style="margin-top:5px; margin-bottom: 10px; overflow-y: hidden; height: auto;"><?php echo nl2br($subComment['comment']); ?></textarea>
    <a href="javascript:void(0)" class="cancel_box" id="<?php echo $comment['_id'];?>" onclick="box_cancel(this.id)">Cancel</a>
