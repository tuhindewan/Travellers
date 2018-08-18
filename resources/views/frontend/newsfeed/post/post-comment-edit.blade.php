
  <div class="post_comment_top">
  
    <b>{{$getUserName['username']}} </b>
    
    <small> <?php echo nl2br($comments['comment']); ?></small>
  </div>
  <div class="post_comment_bottom">
    Like . Reply . <?php echo $comments->created_at->diffForHumans(); ?>
  </div>

  
  
