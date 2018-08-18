
<div id="techAdea">

	<div class="aside-right" style="padding-top: 7px; padding-left: 0;">
		<div class="aside-right-activity" id="content" style=" border: 1px solid rgb(204, 204, 204); position: relative; color: rgb(255, 255, 255); z-index: 1; border-radius: 5px; border-bottom: 0; ">
				<?php
	                $imageSrc = URL::to('images/users/profile/s80').Auth::user()->profile_image;
	            ?>
				<input type="hidden" value="{{ Auth::user()->username }}" id="user_name">
	            <input type="hidden" value="{{ Auth::user()->id }}" id="authId">
	            <input type="hidden" value="{{ $imageSrc }}" id="default_image">
	            <input type="hidden" value="{{ url('/') }}" id="base_url">
	            <input type="hidden" value="" id="selectUser">
				
				<div class="row announce-scroll top-split" style=" width: 100%;background-color:transparent;padding: 10px 20px;margin: 0px;height: 245px;" >
					<div class="col-md-12">
						<friend-activity></friend-activity>
					</div>
				</div>
					
				<div class="panel-mid splitter-horizontal">
					<hr class="hrStyle">
				</div>
				<div class="row message-scroll bottom-split" style="width: 100%; margin: 0;height: 276px;display: inline-block;">
					<div class="col-md-12">
						<user-log :users="users" v-on:getcurrentuser="getCurrentUser" id="user-friend-list"></user-log>
					
							
					</div>
					
				</div>
				
				

				
			
			<div class="aside-right-overlay" style="width: 100%; height: 100%; position: absolute; top: 0; right: 0;  background: #c7c7c7; opacity: 0.3; z-index: -1;">
			</div>
			
		</div>
		
	</div>
	<div class="chat" style="position: absolute;top: 36%;right: 100%;background: #fff;width: 300px;">
		<div class="activate-chat" :id="selectUserId">
	        <div class="">
	            <div class="panel panel-primary">
	                <div class="panel-heading">
	                    <!-- <span class="glyphicon glyphicon-comment"></span> -->
	                    <span id="activity-check"></span>
	                    <div class="header-chat"></div>
	                    <button @click="removeUser" class="close_btn fa fa-times" :id="userId"></button>
	                </div>
	                <div class="panel-body" style="padding-bottom: 5px">
	                    
	                    <div class="row">
	                        <div class="col-sm-12 no_padding">
	                            
	                            <div id="content-chat" class="scrollbar">
	                                <ul class="messages" v-chat-scroll style="padding: 0 10px;">
	                                    <chat-log :messages="messages"></chat-log>
	                                    <li><a v-if="typing !== ''" class="typing" rel="tooltip" data-toggle="tooltip" data-placement="top" :title="typing">
	                                        <div class="progress container">
	                                          <span></span>
	                                          <span></span>
	                                          <span></span>
	                                        </div>
	                                    </a></li>
	                                </ul>
	                            </div>
	                            
	                            
	                        </div>
	                    </div>

	                </div>
	                <div class="panel-footer" style="padding: 0">
	                    <div class="footer-chat">
	                        <chat-composer v-on:messagesent="addMessage" :user-id="userId"></chat-composer>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</div>
<!-- application chat section -->


@push('js')
	<!-- <script src="{{asset('public/js/sweetalert.min.js')}}"></script> -->
    <script src="{{asset('public/js/moment.min.js')}}"></script>
	
@endpush