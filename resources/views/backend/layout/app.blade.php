@include('backend._partials.header')
	<style type="text/css">
			.alert-dismissable{margin-left: 17%; margin-top: 25px;}
		</style>
	@if(Session::has('success'))
		
	    <div class="alert alert-success alert-dismissable ">
	        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	       <b>{!! Session::get('success')!!}</b> 
	    </div>
	
	@elseif(Session::has('error'))
		
	    <div class="alert alert-danger alert-dismissable ">
	        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	       <b>{!! Session::get('error')!!}</b> 
	    </div>
		
	@endif
	<section>
		@yield('content')
	</section>

@include('backend._partials.footer')