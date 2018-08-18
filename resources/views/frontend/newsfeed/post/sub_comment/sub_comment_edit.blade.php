
  <div class="sub_comment_top">
  
    <b>{{$getUserName['username']}} </b>
    <samp id="sub-comment-body-content<?php echo $subComment['_id'];?>"> <?php echo nl2br($subComment['comment']); ?></samp>
  </div>
  <div class="post_comment_bottom">
    Like . <a href="javascript: void(0)" id="comment_reply_box<?php echo $subComment['fk_post_comment_id'];?>" onclick="comment_reply_box(this.id)"> Reply</a> . <?php echo $subComment->created_at->diffForHumans(); ?>
  </div>