<div class="row">
  <div class="col-sm-2">
    <div class="profile">
      <?php $userImage = URL::to('images/users/').$getUser->user_image['image']; ?>
        
      <img class="min_profile_home" src="<?php echo $userImage; ?>" alt="<?php echo $getUser->fullname; ?>">
    </div>
  </div>
  <div class="col-sm-10 no_padding">
    <textarea name="sub_comment" class="form-control post-sub-comment" id="sub_comment<?php echo $comment['_id'];?>" onkeypress="sub_comment(event , this.id, this.value)" placeholder="Write a sub comment..."></textarea>
  </div>
</div>
