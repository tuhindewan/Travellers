

<div class="panel panel-default">
  <div class="panel-body">
    <div class="single_post_top">
      <div class="user_profile">
      
      </div>
      <div class="user_info">
      @foreach($getUserInfo as $user)
      @if($user['_id'] == $post['fk_user_id'])
        <a href="">{{$user['fullname']}}</a>
      @endif  
      @endforeach
        <br>
        
        <a class="show_time"></a> <?php echo $post->created_at->diffForHumans(); ?>
      </div>
      <div class="post_changeable">
        @if($post['fk_user_id'] == Auth::user()->_id)
         <div class="dropdown">
            <a class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              ...
            </a>
            <div class="dropdown-menu post_edit_btn ">
              <!-- edit section -->
              <a class="dropdown-item show-dialog-pop" id="post-ed<?php echo $post['_id']; ?>" onclick="singlePostEdit(this.id)">Edit</a>
              
              <!-- delete section -->
              <a class="dropdown-item show-dialog-pop" id="post-del<?php echo $post['_id']; ?>" onclick="singlePostDelete(this.id)">Delete</a>
            
              <?php 
                $headerMessage = "Post";
                $bodyMessage = "Are you sure you want to delete this Post?"; 
                $_id = $post['_id']; 
              ?>
              </div>
              <!-- edit modal -->
              @include('frontend.newsfeed.post.post-edit-modal')
              <!-- delete modal -->
              @include('frontend.newsfeed.post.delete-modal')
          </div>
        @endif
        
      </div>
    </div> 
    <div class="single_post_body post-body<?php echo $post['_id'];?>">
      <div class="post_description" id="post-content-text<?php echo $post['_id'];?>">
        <?php 
        $str = preg_replace('/#([a-zA-Z0-9!_%]+)([^;\w]{1}|$)/', '<a href="hashtag/$1">#$1</a>$2',$post['description']);
        echo nl2br($str);
        ?>
        
      </div>

    @if(count($getPostWiseImage)>0) 
    
    <div class="post_image">
      <div id="gallery<?php echo $post['_id']; ?>">   
    </div>
          
    @push('js')
    
    <script>

      var images<?php echo $post['_id'];?> = [
      <?php 
        foreach ($getPostWiseImage as $postImg) {
          if($postImg->fk_post_id == $post['_id']){
            $postImage = $postImg->images;
            ?>
            '<?php echo asset("images/post/photo/s487/$postImage"); ?>',
            <?php
          }
        }
       ?>
          
      ];

      $(function() {

          $('#gallery<?php echo $post['_id']; ?>').imagesGrid({
              images: images<?php echo $post['_id'];?>
          });

      });

    </script>

     @endpush
    
    </div>
    @endif
    <hr> 
    </div> 
    <div class="single_post_bottom">
      <div class="row">
        <div class="col-sm-6">
          <div id="like_section">
            @if(count($getPostLike)>0)
            <?php 
              $flag=0;
              $counter=0;
            ?>
              @foreach($getPostLike as $like)
              <?php ++$counter; ?>
                @if($like['fk_post_id'] == $post['_id'])
                  <div id="heart<?php echo $post['_id']; ?>" onclick="like(this.id)" class="oneLine heart_icon on" user="{{Auth::user()->_id}}" rel="1"> </div>
                  <?php
                    $flag=0;
                    break;
                   ?>
                @else
                <?php
                  $flag++;
                  continue;
                ?>
                @endif
              @endforeach
              @if($flag>0 || $counter==0 )
              
              <div id="heart<?php echo $post['_id']; ?>" onclick="like(this.id)" class="oneLine heart_icon off" user="{{Auth::user()->_id}}" rel="0"> </div>
              @endif
            @else
              <?php
                $status = 'off';
                $rel = '0';
               ?>
              <div id="heart<?php echo $post['_id']; ?>" onclick="like(this.id)" class="oneLine heart_icon <?php echo $status; ?>" user="{{Auth::user()->_id}}" rel="{{$rel}}"> </div>
            @endif

            </div>
        </div>
        <div class="col-sm-6"><a class="click_comment" id="comment<?php echo $post['_id']; ?>" onclick="clickComment(this.id)"><i class="fa fa-commenting-o" aria-hidden="true"></i> Comment</a></div>
      </div>
          
      <hr>
      <div class="like_comment_section">
        <div class="row">
          <div class="col-sm-6">
            <div class="like_show_section">
              <div class="button_gly"></div><span id="like_love_<?php echo $post['_id'];?>"><?php echo $post['like']; ?></span> @if($post['like'] <= 1)  @else others @endif
            </div>
            
          </div>
          <div class="col-sm-6">
            <div class="comment_show_section">
              <a href="javascript: void(0)" id="all_comment<?php echo $post['_id'];?>" onclick="previous_comment_load(this.id)"><span id="comment_counter<?php echo $post['_id'];?>"><?php echo $post['comment']; ?></span> Comments</a>
            </div>
          </div>
        </div>
        <hr>
        <!-- post comment show section start -->
        <div class="show_post_comment">
          @include('frontend.newsfeed.post.post-all-comment')
        </div>
        <!--  -->
        <div class="comment_add_section">
          <div class="row">
            <div class="col-sm-2 post_activity_left">
              <div class="profile">
                
                <img class="min_profile_home" src='{{asset("images/users")}}' alt=""> 
              </div> 
            </div>
            <div class="col-sm-9 post_activity_right no_padding">
              <div class="comment">
                <div class="form-group">
                  <textarea name="description" class="form-control post-comment" id="description<?php echo $post['_id'];?>" user="{{Auth::user()->_id}}" onkeypress="comment(event , this.id)" placeholder="Write a comment..."></textarea>
                </div>   
              </div>
            </div>
            
          </div>  
        </div>
      </div>
    </div> 
  </div>
</div>

