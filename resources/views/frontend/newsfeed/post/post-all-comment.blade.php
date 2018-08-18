<div class="row">
  @if($post['comment'] >= 5)
  <div class="view_previous_comment" id="view-previous-comment<?php echo $post['_id'];?>">
    <a href="javascript: void(0)" class="previous_comment" id="all_comment<?php echo $post['_id'];?>" onclick="previous_comment_load(this.id)">View previous comments</a>
  </div>
  <div class="loader"><span id="loader<?php echo $post['_id'];?>"><img src="/techtravel/public/loader.gif"></span></div>
  @else
  
  @endif

  <!--  -->
  <div id="load-all-comment<?php echo $post['_id'];?>"></div>
  <!--  -->
  <div class="show_comment_limit show_comment" id="show-comment-limit<?php echo $post['_id'];?>">
    <?php 
      $data=array(); 
      $j=0;
    ?>
    @for ($i = 0; $i < count($getPostComment); $i++)
      @if($getPostComment[$i]['fk_post_id'] == $post['_id'])
        <?php
        $j++; 
        if($j<5){
          $data[] = $getPostComment[$i]; 
        }
        ?>
      @endif  
    @endfor
    <?php $getComment = array_reverse($data); ?>
    @foreach($getComment as $comment)
      <?php $commentUser = \App\User::findOrFail($comment['fk_user_id']);?>
    <div class="post_comment_content si_com_<?php echo $comment['_id'];?>">
  
      <div class="col-sm-2 post_activity_left">
        <div class="posted_profile">
          
            
            <?php $image = URL::to('images/users/').$commentUser->user_image['image']; ?>
            <img src="<?php echo $image; ?>">
          
        </div>
      </div>
      <div class="col-sm-9 post_activity_right no_padding" id="post-comment-right<?php echo $comment['_id']; ?>">
        <div class="post_comment_top">
          <b>{{ $commentUser->fullname }}</b>
          <small id="comment-body-content<?php echo $comment['_id'];?>"> <?php echo nl2br($comment['comment']); ?></small>
        </div>
        <div class="post_comment_bottom">
          Like . <a href="javascript: void(0)" id="comment_reply_box<?php echo $comment['_id'];?>" onclick="comment_reply_box(this.id)"> Reply</a> . <?php echo \Carbon\Carbon::parse($comment['created_at'])->diffForHumans(); ?>
        </div>
        <!-- sub comment section start -->
        <div class="sub_comment_section">
          @include('frontend.newsfeed.post.sub_comment.all-sub-comment')  
        </div>
        <!-- sub comment section end -->
      </div>
      <div class="col-sm-1 no_padding">
        @if($comment['fk_user_id'] == Auth::user()->_id)
        <div class="dropdown">
          <a class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            ...
          </a>
          <div class="dropdown-menu post_edit_btn ">
            <!-- edit section -->
            <a class="dropdown-item show-dialog-pop" id="post-com-ed<?php echo $comment['_id']; ?>" onclick="singleCommentEdit(this.id)">Edit</a>
            
            <!-- delete section -->
            <a class="dropdown-item show-dialog-pop" id="post-comment<?php echo $comment['_id']; ?>" onclick="singleCommentDelete(this.id)">Delete</a>
          
            <?php 
              $headerMessage = "Comment";
              $bodyMessage = "Are you sure you want to delete this comment?"; 
              $_id = $comment['_id']; 
            ?>
          </div>
          <!-- edit modal -->
          @include('frontend.newsfeed.post.edit-modal')
          <!-- delete modal -->
          @include('frontend.newsfeed.post.delete-modal')
        </div>
        @endif
      </div>
    </div>
    
  @endforeach
  </div>
  <div id="append_comment_<?php echo $post['_id']?>"></div>
</div>