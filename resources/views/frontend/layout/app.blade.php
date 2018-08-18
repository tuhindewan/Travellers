<!DOCTYPE html>
<html>
<head>
	<title>Travels</title>
	<link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="{{asset('public/frontend/css/bootstrap.min.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{asset('public/css/jquery.hashtags.css')}}">

	@stack('css-style')
	
	<link rel="stylesheet" href="{{asset('public/css/chat.css')}}">
	<link rel="stylesheet" href="{{asset('public/css/chosen.min.css')}}">
	
	<link rel="stylesheet" href="{{asset('public/css/public.css')}}">
	<link rel="stylesheet" href="{{asset('public/frontend/css/custom.css')}}">
	<link rel="stylesheet" href="{{asset('public/frontend/css/bootstrap-select.min_2.css')}}">

 
</head>
<body>
	<?php 
		if(isset(Auth::user()->_id)){

			$getUser = \App\User::findOrFail(Auth::user()->_id); 

		}
	?>
<div id="wrapper">

	@yield('content')


</div>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!-- <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script> -->
<script src="{{asset('public/frontend/js/bootstrap-select.min_2.js')}}"></script>
<script src="{{ asset('public/js/app.js') }}"></script>
<script src="{{ asset('public/js/post-section/feed-section.js') }}"></script>
<!-- common js -->

@stack('js')
<script src="{{asset('public/js/chosen.jquery.min.js')}}"></script>
<script src="{{asset('public/js/chosen.proto.min.js')}}"></script>
  <script>
    jQuery(document).ready(function(){
      jQuery(".chosen").chosen();
    });
  </script>
<!-- has tag script -->
<script src="{{asset('public/js/jquery.hashtags.js')}}" type="text/javascript"></script>
<script src="{{asset('public/js/autosize.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $("textarea").hashtags();
  });
</script>

</body>
</html>