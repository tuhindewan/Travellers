<?php 
	if(Session::has('commonData')){
		$commonData = Session::get('commonData');
		$image = $commonData['image'];
		$role_name = $commonData['role_name'];
		$company_name = $commonData['web_settings']['company_name'];
		$company_logo = $commonData['web_settings']['logo'];
		$company_icon = $commonData['web_settings']['fav_icon'];
	}else{
		$image = "";
		$role_name ="";
		$company_name = "";
		$company_logo = "";
		$company_icon = "";
	}

 ?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>{{$company_name}}</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<link rel="icon" href='{{asset("images/settings/web_settings/$company_icon")}}'>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- <link href="{{ asset('public/css/app.css') }}" rel="stylesheet"> -->
	<link rel="stylesheet" href="{{asset('public/frontend/css/custom.css')}}">
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="{{asset('public/backend/plugins/jquery-ui/themes/base/minified/jquery-ui.min_2.css')}}" rel="stylesheet" />
	<link href="{{asset('public/css/jquery.tagsinput.css')}}" rel="stylesheet" />
	<link href="{{asset('public/backend/plugins/bootstrap/css/bootstrap.min_2.css')}}" rel="stylesheet" />
	<link href="{{asset('public/backend/plugins/font-awesome/css/font-awesome.min_2.css')}}" rel="stylesheet" />
	<link href="{{asset('public/backend/css/animate.min_2.css')}}" rel="stylesheet" />
	<link href="{{asset('public/backend/css/style.min_2.css')}}" rel="stylesheet" />
	<link href="{{asset('public/backend/css/style-responsive.min_2.css')}}" rel="stylesheet" />
	<link href="{{asset('public/backend/css/theme/default_2.css')}}" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="{{asset('public/backend/plugins/bootstrap-wysihtml5/dist/bootstrap3-wysihtml5.min_2.css')}}" rel="stylesheet" />
	<link rel="stylesheet" href="{{asset('public/css/chosen.min.css')}}">
	<link href="{{asset('public/backend/plugins/switchery/switchery.min_2.css')}}" rel="stylesheet" />
	<link href="{{asset('public/backend/plugins/DataTables/media/css/dataTables.bootstrap.min_2.css')}}" rel="stylesheet" />
	<link href="{{asset('public/backend/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min_2.css')}}" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	<!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
    <link href="{{asset('public/backend/plugins/jquery-jvectormap/jquery-jvectormap_2.css')}}" rel="stylesheet" />
    <link href="{{asset('public/backend/plugins/bootstrap-calendar/css/bootstrap_calendar_2.css')}}" rel="stylesheet" />
    <link href="{{asset('public/backend/plugins/gritter/css/jquery.gritter_2.css')}}" rel="stylesheet" />
    <link href="{{asset('public/backend/plugins/morris/morris_2.css')}}" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL CSS STYLE ================== -->

	<!-- ================== Start PAGE Custom CSS STYLE ================== -->
	<link href="{{asset('public/backend/css/custom.css')}}" rel="stylesheet" />
	<link href="{{asset('public/css/public.css')}}" rel="stylesheet" />
	<!-- ================== END PAGE Custom CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{asset('public/backend/plugins/pace/pace.min_2.js')}}"></script>
	<!-- ================== END BASE JS ================== -->
	<style>
		.company_logo{width: 50px; height: auto; display: inline !important; border-radius: 10px;}
	</style>
</head>
<body>

	
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
		<div id="header" class="header navbar navbar-default navbar-fixed-top">
			<!-- begin container-fluid -->
			<div class="container-fluid">
				<!-- begin mobile sidebar expand / collapse button -->
				<div class="navbar-header">
					<a href="index_2.html" class="navbar-brand"><img class="company_logo" src='{{asset("images/settings/web_settings/$company_logo")}}' alt="{{$company_name}}"> {{$company_name}}</a>
					<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- end mobile sidebar expand / collapse button -->
				
				<!-- begin header navigation right -->
				<ul class="nav navbar-nav navbar-right">
					<li>
						<form class="navbar-form full-width">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Enter keyword" />
								<button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
							</div>
						</form>
					</li>
					<li class="dropdown">
						<a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">
							<i class="fa fa-bell-o"></i>
							<span class="label">5</span>
						</a>
						<ul class="dropdown-menu media-list pull-right animated fadeInDown">
                            <li class="dropdown-header">Notifications (5)</li>
                            <li class="media">
                                <a href="javascript:;">
                                    <div class="media-left"><i class="fa fa-bug media-object bg-red"></i></div>
                                    <div class="media-body">
                                        <h6 class="media-heading">Server Error Reports</h6>
                                        <div class="text-muted f-s-11">3 minutes ago</div>
                                    </div>
                                </a>
                            </li>
                            <li class="media">
                                <a href="javascript:;">
                                    <div class="media-left"><img src="" class="media-object" alt="" /></div>
                                    <div class="media-body">
                                        <h6 class="media-heading">John Smith</h6>
                                        <p>Quisque pulvinar tellus sit amet sem scelerisque tincidunt.</p>
                                        <div class="text-muted f-s-11">25 minutes ago</div>
                                    </div>
                                </a>
                            </li>
                            <li class="media">
                                <a href="javascript:;">
                                    <div class="media-left"><img src="" class="media-object" alt="" /></div>
                                    <div class="media-body">
                                        <h6 class="media-heading">Olivia</h6>
                                        <p>Quisque pulvinar tellus sit amet sem scelerisque tincidunt.</p>
                                        <div class="text-muted f-s-11">35 minutes ago</div>
                                    </div>
                                </a>
                            </li>
                            <li class="media">
                                <a href="javascript:;">
                                    <div class="media-left"><i class="fa fa-plus media-object bg-green"></i></div>
                                    <div class="media-body">
                                        <h6 class="media-heading"> New User Registered</h6>
                                        <div class="text-muted f-s-11">1 hour ago</div>
                                    </div>
                                </a>
                            </li>
                            <li class="media">
                                <a href="javascript:;">
                                    <div class="media-left"><i class="fa fa-envelope media-object bg-blue"></i></div>
                                    <div class="media-body">
                                        <h6 class="media-heading"> New Email From John</h6>
                                        <div class="text-muted f-s-11">2 hour ago</div>
                                    </div>
                                </a>
                            </li>
                            <li class="dropdown-footer text-center">
                                <a href="javascript:;">View more</a>
                            </li>
						</ul>
					</li>
					<li class="dropdown navbar-user">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<img src='{{asset("images/admin$image")}}'/>
							<span class="hidden-xs">{{Auth::user()->username}}</span> <b class="caret"></b>
						</a>
						<ul class="dropdown-menu animated fadeInLeft">
							<li class="arrow"></li>
							<li><a href="javascript:;">Edit Profile</a></li>
							<li><a href="javascript:;"><span class="badge badge-danger pull-right">2</span> Inbox</a></li>
							<li><a href="javascript:;">Calendar</a></li>
							<li><a href="javascript:;">Setting</a></li>
							<li class="divider"></li>
							<li><a href="{{URL::to('admin/logout')}}">Log Out</a></li>
						</ul>
					</li>
				</ul>
				<!-- end header navigation right -->
			</div>
			<!-- end container-fluid -->
		</div>
		<!-- end #header -->

		<!-- start side navigation bar -->
		@include('backend._partials.nav')

		<!-- end side navigation bar -->