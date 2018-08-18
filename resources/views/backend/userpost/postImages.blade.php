<div>
	@foreach($getPost->post_image as $image)
	<?php $postImg = $image['images'] ?>
	<img src='{{asset("images/post/photo/thum$postImg")}}' class="img-thumbnail" alt="Cinque Terre" width="304" height="236">
	@endforeach
</div>