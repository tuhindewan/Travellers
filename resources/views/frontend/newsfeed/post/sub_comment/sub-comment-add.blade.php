<style>
  .overlay-modal{margin-left: 0!important;}
</style>
<div class="sub_comment_content post_sub_com_<?php echo $comment['_id']; ?>">
            
  <div class="row">
    <div class="col-sm-2 sub_comment_activity_left">
      <div class="posted_profile">
      
          <?php $userImage = URL::to('images/users/').$subCommentUser->user_image['image']; ?>
        <img src="<?php echo $userImage; ?>">
          
      </div>
    </div>
    <div class="col-sm-8 no_padding" id="post-sub-comment-right<?php echo $comment['_id']; ?>">
      <div class="sub_comment_top">
      
        <b>{{$subCommentUser->fullname}} </b>
        
        <samp><?php echo nl2br($comment['comment']); ?></samp>
      </div>
      <div class="post_comment_bottom">
        Like . Just Now
      </div>
    </div>
    <div class="col-sm-2 no_padding">
      @if($comment['fk_user_id'] == Auth::user()->_id)
      <div class="dropdown">
        <a class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          ...
        </a>
        <div class="dropdown-menu post_edit_btn ">
          <a class="dropdown-item show-dialog-pop" id="post-com-ed<?php echo $comment['_id']; ?>" onclick="singleCommentEdit(this.id)">Edit</a>
          <a class="dropdown-item show-dialog-pop" id="post-comment<?php echo $comment['_id']; ?>" onclick="singleCommentDelete(this.id)">Delete</a>

          <?php 
            $headerMessage = " Sub Comment";
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
  
</div>