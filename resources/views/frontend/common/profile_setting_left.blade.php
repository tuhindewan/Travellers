<div class="profileSet-ui-block">
	<div class="your-profile">
		<div class="profileSet-ui-block-title profileSet-ui-block-title-small">
			<h6 class="title">Your PROFILE</h6>
		</div>

		<div id="accordion" role="tablist" aria-multiselectable="true">
			<div class="card">
				<div class="card-header" role="tab" id="headingOne">
					<h6 class="mb-0">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							Profile Settings
							<!-- <svg class="olymp-dropdown-arrow-icon"><use xlink:href="icons/icons.svg#olymp-dropdown-arrow-icon"></use></svg> -->
						</a>
					</h6>
				</div>

				<div role="tabpanel" aria-labelledby="headingOne">
					<ul class="your-profile-menu">
						<li>
							<a href="{{ URL::to('account_settings')}}">Account Settings</a>
						</li>
						<li>
							<a href="{{ URL::to('change_password')}}">Change Password</a>
						</li>
					</ul>
				</div>
			</div>
		</div>


		<div class="profileSet-ui-block-title">
			<a href="{{ URL::to('all_notifications')}}" class="h6 title">Notifications</a>
			<?php 
			$unreadNoti = App\Models\Notification::where('status',1)
			            ->where('user_logged',Auth::user()->_id)
			            ->count();
			?>
			<a href="#" class="items-round-little bg-primary-notty">{{ $unreadNoti }}</a>
		</div>
		<div class="profileSet-ui-block-title">
			<a href="{{ URL::to('all_activity')}}" class="h6 title">Activity Log</a>
		</div>
		<div class="profileSet-ui-block-title">
			<a href="{{ URL::to('friend_request')}}" class="h6 title">Friend Requests</a>
			<?php 
			$pending = DB::collection('relationships')
						->where('user_id_two','=',Auth::user()->_id)
						->where('status',0)
						->count();
			?>
			<a href="#" class="items-round-little bg-blue-request">{{$pending}}</a>
		</div>
		<div class="profileSet-ui-block-title">
			<a href="{{ URL::to('all_messages')}}" class="h6 title">Chat / Messages</a>
			<a href="#" class="items-round-little bg-green-message">10</a>
		</div>
		<div class="profileSet-ui-block-title">
			<a href="{{ URL::to('fav_agencies')}}" class="h6 title">Favourite Agencies</a>
		</div>
	</div>
</div>