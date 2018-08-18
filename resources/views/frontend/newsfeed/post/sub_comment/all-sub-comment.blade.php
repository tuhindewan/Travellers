<div id="show_sub_comment_box<?php echo $comment['_id'];?>">
  @if($comment['sub_comment']>0)
    <blockquote class="sub_code sub_comment_exi<?php echo $comment['_id'];?>">
      <!-- show all sub comment section -->
      <div class="show_all_sub_comment">
        @foreach($getSubComment as $subComment)
          @if($subComment->fk_post_comment_id == $comment['_id'])
          <?php $subCommentUser = \App\User::findOrFail($subComment['fk_user_id']);?>
          	<div class="single_sub_comment" id="si_sub_com_<?php echo $subComment->_id;?>">
          		<div class="row">
          			<div class="col-sm-2 sub_comment_activity_left">
  				        <div class="posted_profile">
  				          <?php $s_image = URL::to('images/users/').$subCommentUser->user_image['image']; ?>
                    <img src="<?php echo $s_image; ?>">  
  				        </div>
  				      </div>
                <div class="col-sm-10 no_padding" id="edit-sub-com-app<?php echo $subComment['_id'];?>" style="display: none;"></div>
    				    <div class="col-sm-8 no_padding" id="post-sub-comment-right<?php echo $subComment['_id']; ?>">
    				        <div class="sub_comment_top">
    				          <b>{{$subCommentUser->fullname}} </b>
    				          <samp id="sub-comment-body-content<?php echo $subComment['_id'];?>"> <?php echo nl2br($subComment['comment']); ?></samp>
    				        </div>
    				        <div class="post_comment_bottom">
    				          Like . <a href="javascript: void(0)" id="comment_reply_box<?php echo $comment['_id'];?>" onclick="comment_reply_box(this.id)"> Reply</a> . <?php echo \Carbon\Carbon::parse($subComment['created_at'])->diffForHumans(); ?>
    				        </div>
    				        
    				    </div>
                <div class="col-sm-2 no_padding option_btn" id="sub_com_option<?php echo $subComment['_id'];?>">
                  @if($subComment['fk_user_id'] == Auth::user()->_id)
                  <div class="dropdown">
                    <a class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      ...
                    </a>
                    <div class="dropdown-menu post_edit_btn ">
                      <a class="dropdown-item" com-id="<?php echo $comment['_id']; ?>" id="sub-com-ed<?php echo $subComment['_id']; ?>" onclick="singleSubCommentEdit(this.id)">Edit</a>
                      <a class="dropdown-item show-dialog-pop" id="post-sub-comment<?php echo $subComment['_id']; ?>" onclick="singleSubCommentDelete(this.id)">Delete</a>

                      <?php 
                        $headerMessage = " Sub Comment";
                        $bodyMessage = "Are you sure you want to delete this Reply ?"; 
                        $_id = $subComment['_id']; 
                      ?>
                    </div>
                    
                    <!-- delete modal -->
                    @include('frontend.newsfeed.post.delete-modal')
                  </div>
                  @endif
                </div>
          		</div>	
          	</div>  
          @endif 
        @endforeach      
      </div>
      <div id="append_sub_comment_<?php echo $comment['_id'];?>"></div>
      @include('frontend.newsfeed.post.sub_comment.comment_box')
    </blockquote>
  @else
    <blockquote class="sub_code sub_comment<?php echo $comment['_id'];?>" style="display: none;">
      <!-- show all sub comment section -->
      <div class="show_all_sub_comment" id="append_sub_comment_<?php echo $comment['_id'];?>"></div>
      @include('frontend.newsfeed.post.sub_comment.comment_box')
    </blockquote>
  @endif
</div>


