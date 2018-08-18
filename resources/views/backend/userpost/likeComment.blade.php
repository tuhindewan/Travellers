<div class="like_comment_view">
  <hr>
	<div class="row">
    <div class="col-sm-6">
      <div class="like_show_section capitalize">
        <div class="button_gly"></div>
        @if(count($getPost->post_like)>0)
        @foreach($getPost->post_like as $like)
        @if(count($like) < 2)

        <span  id="like_love_"><a class="font11">{{ $like->users['fullname'] }}</a></span>
        @endif
        @endforeach
        
        @if(count($getPost->post_like) >1 )
        <span id="like_love_"><a class="font11">{{ count($getPost->post_like) }} others</a> </span>
        @endif
        @else
        <span  id="like_love_"><a class="font11">0</a></span>
        @endif
        
      </div>
      
    </div>
    <div class="col-sm-6">
      <div class="comment_show_section">
        <a class="font11" href="javascript: void(0)" id="all_comment" ><span id="comment_counter">{{ count($getPost->post_comment) }}</span> Comments</a>
      </div>
    </div>
    
  </div>
</div>