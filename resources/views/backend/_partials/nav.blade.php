	
<!-- begin #sidebar -->
<div id="sidebar" class="sidebar">
	<!-- begin sidebar scrollbar -->
	<div data-scrollbar="true" data-height="100%">
		
		<!-- begin sidebar user -->
		<ul class="nav">
			<li class="nav-profile">
				<div class="image">
					
					<a href="javascript:;"><img src='{{asset("images/admin$image")}}' alt="{{ Auth::user()->username }}" /></a>
				</div>
				<div class="info">
					{{ Auth::user()->username }}
					<small>{{$role_name}}</small>
				</div>
			</li>
		</ul>
		<!-- end sidebar user -->
		<!-- begin sidebar nav -->
		<ul class="nav">
			<li class="nav-header">Navigation</li>
			<li class="{{ Request::is('admin') ? 'active' : '' }}">
				<a href="{{URL::to('/admin')}}">
				    <i class="fa fa-laptop"></i>
				    <span>Dashboard </span> 
				</a>
			</li>
			
			@if($role_name == 'host a traveler')
			<li class="has-sub {{ Request::is('host-accumulator/create') || Request::is('host-accumulator') ? 'active' : '' }}">
				<a href="javascript:;">
					<b class="caret pull-right"></b>
					<i class="fa fa-file-text-o" aria-hidden="true"></i>
					<span>Accumulators </span>
				</a>
				<ul class="sub-menu">
				    <li class="{{ Request::is('host-accumulator/create') ? 'active' : '' }}"><a href="{{ URL::to('host-accumulator/create')}}">Create accumulator</a></li>
				    <li class="{{ Request::is('host-accumulator') ? 'active' : '' }}"><a href="{{URL::to('host-accumulator')}}">View accumulators </a></li>
				</ul>
			</li>
			<li class="has-sub {{ Request::is('reserve-accumulator') ? 'active' : '' }}">
				<?php $myId = Auth::user()->_id; ?>
				<a href='{{URL::to("/reserve-accumulator")}}'>
				    <i class="fa fa-bell" aria-hidden="true"></i>
				    <span>Reserve accumulators</span> 
				</a>
			</li>
			<!-- <li class="has-sub {{ Request::is('reserve-request') || Request::is('host-accumulator') ? 'active' : '' }}">
				<a href="javascript:;">
					<b class="caret pull-right"></b>
					<i class="fa fa-bell" aria-hidden="true"></i>
					<span>Reserve accumulators </span>
				</a>
				<ul class="sub-menu">
				    <li class="{{ Request::is('reserve-request') ? 'active' : '' }}"><a href="{{ URL::to('reserve-request')}}">Reserve</a></li>
				    <li class="{{ Request::is('host-accumulator') ? 'active' : '' }}"><a href="{{URL::to('host-accumulator')}}">Request confirm </a></li>
				    <li class="{{ Request::is('host-accumulator') ? 'active' : '' }}"><a href="{{URL::to('host-accumulator')}}">Request rejected </a></li>
				</ul>
			</li> -->
			@elseif($role_name == 'agencies')
			<li class="has-sub {{ Request::is('agencies-create/post') || Request::is('agencies-view/post') ? 'active' : '' }}">
				<a href="javascript:;">
					<b class="caret pull-right"></b>
					<i class="fa fa-file-text-o" aria-hidden="true"></i>
					<span>Posts</span>
				</a>
				<ul class="sub-menu">
				    <li class="{{ Request::is('agencies-create/post') ? 'active' : '' }}"><a href="{{ URL::to('agencies-create/post')}}">create post</a></li>
				    <li class="{{ Request::is('agencies-view/post') ? 'active' : '' }}"><a href="{{URL::to('agencies-view/post')}}">view posts</a></li>
				</ul>
			</li>
			<li class="has-sub {{ Request::is('agencies-create/package') || Request::is('agencies-view/package') ? 'active' : '' }}">
				<a href="javascript:;">
					<b class="caret pull-right"></b>
					<i class="fa fa-file-text-o" aria-hidden="true"></i>
					<span>Package</span>
				</a>
				<ul class="sub-menu">
				    <li class="{{ Request::is('agencies-create/package') ? 'active' : '' }}"><a href="{{ URL::to('agencies-create/package')}}">create package</a></li>
				    <li class="{{ Request::is('agencies-view/package') ? 'active' : '' }}"><a href="{{URL::to('agencies-view/package')}}">view packages</a></li>
				</ul>
			</li>
			<li class="has-sub {{ Request::is('admin-announcement') || Request::is('admin-announcement/create') ? 'active' : '' }}">
				<a href="javascript:;">
					<b class="caret pull-right"></b>
					<i class="fa fa-file-text-o" aria-hidden="true"></i>
					<span>Message</span>
				</a>
				<ul class="sub-menu">
				    <li class="{{ Request::is('admin-announcement') ? 'active' : '' }}"><a href="{{ URL::to('admin-announcement')}}">create service</a></li>
				    <li class="{{ Request::is('admin-announcement/create') ? 'active' : '' }}"><a href="{{URL::to('admin-announcement/create')}}">view service</a></li>
				</ul>
			</li>
			<li class="has-sub {{ Request::is('agency-services') || Request::is('agency-services/create') ? 'active' : '' }}">
				<a href="javascript:;">
					<b class="caret pull-right"></b>
					<i class="fa fa-file-text-o" aria-hidden="true"></i>
					<span>Services</span>
				</a>
				<ul class="sub-menu">
				    <li class="{{ Request::is('agency-services/create') ? 'active' : '' }}"><a href="{{ URL::to('agency-services/create')}}">create service</a></li>
				    <li class="{{ Request::is('agency-services') ? 'active' : '' }}"><a href="{{URL::to('agency-services')}}">view services</a></li>
				</ul>
			</li>

			
			<li class="{{ Request::is('agencies-gallery') ? 'active' : '' }}">
				<a href="{{ URL::to('agencies-gallery')}}">
				    <i class="fa fa-image"></i>
				    <span>Gallery</span> 
				</a>
			</li>
			
			<li class="has-sub {{ Request::is('agencies-about') ? 'active' : '' }}">
				<a href="javascript:;">
					<b class="caret pull-right"></b>
					<i class="fa fa-file-text-o" aria-hidden="true"></i>
					<span>Settings</span>
				</a>
				<ul class="sub-menu">
				    <li class="{{ Request::is('agencies-about') ? 'active' : '' }}"><a href="{{ URL::to('agencies-about')}}">About info</a></li>
				    
				    <li class=""><a href="#">Terms & conditions</a></li>
				</ul>
			</li>
			@else
			<li class="has-sub {{ Request::is('role') || Request::is('permission') || Request::is('role-wise-permission') || Request::is('user-admin/create') || Request::is('user-admin') ? 'active' : '' }}">
				<a href="javascript:;">
					<b class="caret pull-right"></b>
					<i class="fa fa-assistive-listening-systems" aria-hidden="true"></i>
					<span>Administration</span>
				</a>
				<ul class="sub-menu">
				    <li class="{{ Request::is('role') ? 'active' : '' }}"><a href="{{URL::to('role')}}">Role</a></li>
				    <li class="{{ (Request::path() == 'permission') ? 'active' : '' }}"><a href="{{URL::to('permission')}}">Permission</a></li>
				    <li class="{{ (Request::path() == 'role-wise-permission') ? 'active' : '' }}"><a href="{{URL::to('role-wise-permission')}}">Role Wise Permission</a></li>
				    <li class="{{ (Request::path() == 'user-admin/create') ? 'active' : '' }}"><a href="{{URL::to('user-admin/create')}}">Add New User</a></li>
				    <li class="{{ (Request::path() == 'user-admin') ? 'active' : '' }}"><a href="{{URL::to('user-admin')}}">View Users</a></li>
				</ul>
			</li>
			<li class="has-sub">
				<a href="javascript:;">
					<span class="badge pull-right">10</span>
					<i class="fa fa-users" aria-hidden="true"></i>
					<span>Staff</span>
				</a>
				<ul class="sub-menu">
				    <li><a href="">All Staff</a></li>
				    <li><a href="">Staff Permission</a></li>
				</ul>
			</li>
			
			<li class="has-sub {{ Request::is('user-account-report') || Request::is('user-post-report') ? 'active' : '' }}">
				<a href="javascript:;">
				    <b class="caret pull-right"></b>
				    <i class="fa fa-newspaper-o" aria-hidden="true"></i>
				    <span>Report</span>
				</a>
				<ul class="sub-menu">
					
					<!-- <li class="has-sub">
					    <a href="javascript:;"><b class="caret pull-right"></b> Account</a>
					    <ul class="sub-menu">
					        <li><a href="">Default</a></li>
					        <li><a href="">Deleted Account</a></li>
					    </ul>
					</li>
					<li class="has-sub">
					    <a href="javascript:;"><b class="caret pull-right"></b> Post Reort</a>
					    <ul class="sub-menu">
					        <li><a href="">Post</a></li>
					        <li><a href="">Image</a></li>
					        <li><a href="">Video</a></li>
					    </ul>
					</li> -->

					<li class="{{ Request::is('user-account-report') ? 'active' : '' }}"><a href="{{URL::to('/user-account-report')}}">User Account Report</a></li>
					<li class="{{ Request::is('user-post-report') ? 'active' : '' }}"><a href="{{URL::to('/user-post-report')}}">User Post Report</a></li>
				</ul>
			</li>
			<li>
				<a href="#">
				    <i class="fa fa-file-text-o" aria-hidden="true"></i>
				    <span>Admin Post </span> 
				</a>
			</li>
			<li class="has-sub {{ Request::is('admin-announcement') || Request::is('admin-announcement/create') ? 'active' : '' }}">
				<a href="javascript:;">
					<b class="caret pull-right"></b>
					<i class="fa fa-file-text-o" aria-hidden="true"></i>
					<span>Announcement</span>
				</a>
				<ul class="sub-menu">
				    <li class="{{ Request::is('admin-announcement') ? 'active' : '' }}"><a href="{{ URL::to('admin-announcement')}}">All</a></li>
				    <li class="{{ Request::is('admin-announcement/create') ? 'active' : '' }}"><a href="{{URL::to('admin-announcement/create')}}">Publish Announcement</a></li>
				</ul>
			</li>
			<li class="has-sub {{ Request::is('user-post-admin') || Request::is('verification-request-post') || Request::is('verified-post') || Request::is('active-post') || Request::is('in-active-post')  ? 'active' : '' }}">
				<a href="javascript:;">
					<b class="caret pull-right"></b>
					<i class="fa fa-file-text-o" aria-hidden="true"></i>
					<span>User Post</span>
				</a>
				<ul class="sub-menu">
				    <li class="{{ Request::is('user-post-admin') ? 'active' : '' }}"><a href="{{ URL::to('user-post-admin')}}">All post</a></li>
				    <li class="{{ Request::is('verification-request-post') ? 'active' : '' }}"><a href="{{ URL::to('verification-request-post')}}">Request verifiaction post</a></li>
				    <li class="{{ Request::is('verified-post') ? 'active' : '' }}"><a href="{{ URL::to('verified-post')}}">Verifiaction post</a></li>
				</ul>
			</li>
			<li class="has-sub {{ Request::is('all_user') ? 'active' : '' }}">
				<?php 
				$userCount = App\User::count();
				?>
				<a href="javascript:;">
					<span class="badge pull-right">{{$userCount}}</span>
					<i class="fa fa-users" aria-hidden="true"></i>
					<span>Users</span>
				</a>
				<ul class="sub-menu">
				    <li class="{{ Request::is('all_user') ? 'active' : '' }}"><a href="{{URL::to('/all_user')}}">All User</a></li>
				</ul>
			</li>
			<li class="has-sub {{ Request::is('newsletter') || Request::is('contact-message')  ? 'active' : '' }}">
				<a href="javascript:;">
					<b class="caret pull-right"></b>
					<i class="fa fa-comments" aria-hidden="true"></i>
					<span>Message</span>
				</a>
				<ul class="sub-menu">
				    <li class="{{ (Request::path() == 'newsletter') ? 'active' : '' }}"><a href="{{URL::to('newsletter')}}">Newsletter</a></li>
				    <li class="{{ (Request::path() == 'contact-message') ? 'active' : '' }}"><a href="{{URL::to('contact-message')}}">Contact</a></li>
				</ul>
			</li>
			<li class="has-sub {{ Request::is('web-settings') || Request::is('password-reset-email') || Request::is('account-approval-email') || Request::is('account-opening-email') || Request::is('current-city') || Request::is('smtp-settings') || Request::is('page-settings') ? 'active' : '' }}">
				<a href="javascript:;">
					<b class="caret pull-right"></b>
					<i class="fa fa-cogs" aria-hidden="true"></i>
					<span>Settings</span>
				</a>
				<ul class="sub-menu">
				    <li class="{{ (Request::path() == 'current-city') ? 'active' : '' }}"><a href="{{URL::to('current-city')}}">Current City</a></li>
				    <li class="{{ (Request::path() == 'web-settings') ? 'active' : '' }}"><a href="{{URL::to('web-settings')}}">General Settings</a></li>
				    <!-- <li class="{{ (Request::path() == 'send-system-config') ? 'active' : '' }}"><a href="{{URL::to('send-system-config')}}">SMS/Email Config</a></li> -->
				    
					<li class="has-sub {{ Request::is('password-reset-email') || Request::is('account-approval-email') || Request::is('account-opening-email') ? 'active' : '' }}">
					    <a href="javascript:;"><b class="caret pull-right"></b> Manage Email</a>
					    <ul class="sub-menu">
					        <li class="{{ (Request::path() == 'password-reset-email') ? 'active' : '' }}"><a href="{{URL::to('password-reset-email')}}">Password Reset Email</a></li>
					        <li class="{{ (Request::path() == 'account-approval-email') ? 'active' : '' }}"><a href="{{URL::to('account-approval-email')}}">Account Approval Email</a></li>
					        <li class="{{ (Request::path() == 'account-opening-email') ? 'active' : '' }}"><a href="{{URL::to('account-opening-email')}}">Account Opening Email</a></li>
					    </ul>
					</li>

					<li class="{{ (Request::path() == 'smtp-settings') ? 'active' : '' }}"><a href="{{URL::to('smtp-settings')}}">Smtp Settings</a></li>
					<li class="{{ (Request::path() == 'page-settings') ? 'active' : '' }}"><a href="{{URL::to('page-settings')}}"> Page Settings</a></li>
				</ul>
			</li>
			
			<li class="has-sub">
				<a href="javascript:;">
					<b class="caret pull-right"></b>
					<i class="fa fa-hourglass-start" aria-hidden="true"></i>
					<span>SEO</span>
				</a>
				<ul class="sub-menu">
				    <li><a href=""></a></li>
				    <li><a href=""></a></li>
				</ul>
			</li>
			@endif
			
			<li>
				<?php $myId = Auth::user()->_id; ?>
				<a href='{{URL::to("/user-admin/$myId")}}'>
				    <i class="fa fa-user" aria-hidden="true"></i>
				    <span>My Profile </span> 
				</a>
			</li>
			
	        <!-- begin sidebar minify button -->
			<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
	        <!-- end sidebar minify button -->
		</ul>
		<!-- end sidebar nav -->
	</div>
	<!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->

