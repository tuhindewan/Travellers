<div class="row">
		  
  <!-- <div class="view_previous_comment" id="view-previous-comment">
    <a href="javascript: void(0)" class="previous_comment" id="all_comment" >View previous comments</a>
  </div> -->
  <!--  -->
  <!-- <div :id="'load-all-comment'+postId"></div> -->
  <!--  -->
  <div class="show_comment_limit show_comment" id="show-comment-limit">
  	@foreach($getPost->post_comment as $comment)
    <div class="post_comment_content si_com_" id="si_com_">
  
      <div class="col-sm-2 post_activity_left">
        <div class="posted_profile">
        	<?php $comUserImg = $comment->users['profile_image']; ?>
            <img src='{{asset("images/users/profile/s160$comUserImg")}}'>
        </div>
      </div>
      <div class="col-sm-9 post_activity_right no_padding" id="post-comment-right">
        <div class="comment_box_section" id="comment_right">
        	<div class="post_comment_top font13 capitalize">
        	  <b>{{ $comment->users['fullname'] }}</b>
	          
	          <div class="post_comment_body font13" id="comment-body-content"> {{ $comment->comment }} </div>
	        </div>
	        <div class="post_comment_bottom font12" style="margin:7px;">
	        <i class="fa fa-thumbs-up" aria-hidden="true"></i>
	        @if(count($comment->post_comment_like)>0)
	        @foreach($comment->post_comment_like as $like)
	        @if(count($like) < 2)

	        <span  id="like_love_"><a class="font11">{{ $like->users['fullname'] }}</a></span>
	        @endif
	        @endforeach
	        
	        @if(count($comment->post_comment_like) >1 )
	        <span id="like_love_"><a class="font11">{{ count($comment->post_comment_like) }} others</a> </span>
	        @endif
	        @else
	        <span  id="like_love_"><a class="font11">0</a></span>
	        @endif 

	          . <a href="javascript: void(0)" id="comment_reply_box"> Reply</a> . {{ $comment->created_at }}
	        </div>
        </div>
        
        
        <!-- sub comment section start -->
        <div class="sub_comment_section">
        	<div >
		    <blockquote class="sub_code sub_comment_exi">
		      <!-- show all sub comment section -->
		      @foreach($comment->post_sub_comment as $sub_comment)
		      <div class="show_sub_comment">
		        
		          	<div class="single_sub_comment" id="si_sub_com_">
		          		<div class="row">
		          			<div class="col-sm-2 sub_comment_activity_left">
		  				        <div class="posted_profile">
		  				        	<?php $subComPro = $sub_comment->users['profile_image']; ?>
		                    		<img src='{{asset("images/users/profile/s160$subComPro")}}'>  
		  				        </div>
		  				    </div>
		                	
	    				    <div class="col-sm-8 no_padding" id="post-sub-comment-right">
	    				        <div class="subcomment_box_section" id="sub_comment_right">
	    				        	<div class="sub_comment_top font13 capitalize">

									  <b>{{ $sub_comment->users['fullname'] }}</b>
		    				          
		    				          <samp id="sub-comment-body-content"> {{ $sub_comment->comment }} </samp>
		    				        </div>
		    				        <div class="post_comment_bottom font12">
		    				          <a href="javascript: void(0)"id="comment_reply_box" > Reply</a> . {{ $sub_comment->created_at }}
		    				        </div>
	    				        </div>
	    				        
	    				    </div>
			                
		          		</div>	
		          	</div>        
		        </div>
				@endforeach
		        
		    </blockquote>
		  </div>
        	   
        </div>
        <!-- sub comment section end -->
      </div>
      
    </div>
    @endforeach
    
  </div>
  
</div>