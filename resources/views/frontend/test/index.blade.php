@extends('frontend.layout.app')
@push('css-style')
	<link href="{{asset('public/css/map.css')}}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/css/dropdown_com.css')}}" />
	<!-- <link rel="stylesheet" href="{{asset('public/css/dialog.css')}}" /> -->
	<link rel="stylesheet" href="{{asset('public/frontend/css/pages/post_type_page.css')}}" />
	<link rel="stylesheet" href="{{asset('public/frontend/css/pages/post_page.css')}}" />
	<link rel="stylesheet" href="{{asset('public/frontend/css/pages/aside_right_chat.css')}}" />
	<link rel="stylesheet" href="{{asset('public/frontend/css/pages/welcome_page.css')}}" />
@endpush
@section('content')
<section class="home_main_container first">
	<div class="home_container_top">

		<!-- map section start -->
		<App></App>
		<!-- map section end -->
		
	</div>

	@include('frontend.newsfeed.nav_bottom')
		
</section>


@endsection