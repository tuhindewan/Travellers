<?php $i=0;
	
	 ?>
@foreach($friendsOne as $friend)
<?php $i++; ?>
	<?php 
		$friendList[]= User::findOrFail($friend->user_id_two);
	 ?>
@endforeach
<?php $j=$i; ?>
@foreach($friendsTwo as $friend)
	<?php $j++; ?>
	<?php 
		$friendList[]= User::findOrFail($friend->user_id_one);
	 ?>
@endforeach

<?php
	echo json_encode($friendList); 
?>

