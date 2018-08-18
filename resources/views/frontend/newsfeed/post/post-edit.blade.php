<div class="post_description">
	<?php 
	$str = preg_replace('/#([a-zA-Z0-9!_%]+)([^;\w]{1}|$)/', '<a href="hashtag/$1">#$1</a>$2',$getPost['description']);
	echo nl2br($str);
	?>

</div>