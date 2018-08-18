@include('frontend._partials.header')
<link href="{{asset('public/backend/css/style.min_2.css')}}" rel="stylesheet" />
@include('frontend._partials.nav')

<div class="error-header"> </div>
<div class="container ">
    <section class="error-container text-center">
        <h1 class="animated fadeInDown">404</h1>
        <div class="error-divider animated fadeInUp">
            <h2>PAGE NOT FOUND.</h2>
            <p class="description">We Couldn't Find This Page</p>
        </div>
    </section>
</div>



<script>
  (function ($) {
    $(document).ready(function(){
      
    // hide .navbar first
    $(".navbar-xs").hide();
    
  });
    }(jQuery));
</script>

@include('frontend._partials/footer')