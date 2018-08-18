@foreach($getComment as $comment)
  
  <div class="post_comment_content si_com_<?php echo $comment['_id'];?>">

    <div class="col-sm-2 post_activity_left">
      <div class="posted_profile">
      @foreach($getUserProfile as $userProfile)
        @if($userProfile['fk_user_id'] == $comment['fk_user_id'])
          <?php $image = $userProfile['image']; ?>
          <img src='{{asset("images/users$image")}}'>
        @endif  
      @endforeach  
      </div>
    </div>
    <div class="col-sm-9 post_activity_right no_padding" id="post-comment-right<?php echo $comment['_id']; ?>">
      <div class="post_comment_top">
      @foreach($getUserName as $userName)
        @if($userName['_id'] == $comment['fk_user_id'])
        <b>{{$userName->username}} </b>
        @endif
      @endforeach
        <small id="comment-body-content<?php echo $comment['_id'];?>"> <?php echo nl2br($comment['comment']); ?></small>
      </div>
      <div class="post_comment_bottom">
        Like . Reply . <?php echo $comment['created_at']->diffForHumans(); ?>
      </div>
      
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