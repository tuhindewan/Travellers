@extends('frontend.layout.app')

@push('css-style')
    
    <link rel="stylesheet" href="{{asset('public/frontend/css/style.css')}}">

    <link rel="stylesheet" href="{{asset('public/frontend/css/pages/aside_right_chat.css')}}" />

    <link rel="stylesheet" href="{{asset('public/frontend/css/host_traveller/style.css')}}">
    <!-- <link rel="stylesheet" href="{{asset('public/frontend/css/host_traveller/elegant-fonts.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/host_traveller/zabuto_calendar.min.css')}}"> -->
    
    

@endpush
@section('content')
@include('frontend._partials.nav')
<section class="connection_page" style="margin-top: 60px;">
     <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="jumbotron">
                    <!-- <a class="btn btn-primary btn-xs" style="width: 100%;margin-left: 18px;font-size: 17px;" href="{{URL::to("host_a_plan")}}" role="button">Host a Traveller Now</a> -->
                  <h2 style="text-align: center;">Search</h2>
                  @include('frontend.common.host_search')
                
                    <!--end form-filter-->
                </div>
            </div>
            <div class="col-md-6">
                <div class="main-content">
                    <div class="row">
                      @if(count($hostPlaces) > 0)
                      @foreach($hostPlaces as $host)
                      <?php $locationName = $host->_id->location; ?>
                      <div class="col-xs-6 col-md-6">
                        <a href='{{URL::to("stay-with-locals/$locationName")}}' class="thumbnail host_postcard">
                          <img class="host_postcard_img" src="https://cdn.britannica.com/700x450/97/189797-004-64386776.jpg" alt="...">
                          <div class="unified-postcard__overlay">
                            <div class="unified-postcard__header">
                                <h3 style="text-transform: capitalize;"> {{ $locationName }}
                                <img src="https://s-ec.bstatic.com/static/img/flags/24/bd/93dddabc4e9d7afd3ea8b144f8c4411bf38e1acf.png" alt="Malaysia" valign="middle">
                                </h3>
                                <p> {{ $host->count }} propertie<?php if($host->count > 1){echo 's';} ?></p>
                            </div>
                          </div>
                          <div class="lp-postcard-deals-avg-price-badge">
                            <div class="lp-postcard-deals-avg-price-pricetag">
                            <svg class="bk-icon -experiments-index_price_badge" height="40" width="30" viewBox="0 0 72 96"><path fill-rule="evenodd" d="M52 96a9.6 9.6 0 0 1-6-3L3 50c-.7-.7-1-1-1-2s.4-1.4 1-2L46 2c2-2 3.3-2 6-2h20v96H52zm6-38c2.6-2.8 4-6 4-10s-1.4-7.2-4-10c-2.8-2.6-6-4-10-4s-7.2 1.4-10 4c-2.6 2.8-4 6-4 10s1.4 7.2 4 10c2.8 2.6 6 4 10 4s7.2-1.4 10-4z"></path></svg>
                            </div>
                            <div class="lp-postcard-deals-avg-price-content">
                            <span class="lp-postcard-deals-avg-price-copy">
                            Deals start at
                            </span>
                            <br>
                            <span class="lp-postcard-deals-avg-price-value">
                            BDT&nbsp;1,700</span>
                            </div>
                           </div>
                        </a>
                      </div>
                      @endforeach
                      @endif 
                      
                    </div>
                </div>
                <!--end main-content-->      
            </div>
            <div class="col-md-3 right-section" style="padding-right: 0.5%; padding-left: 4%;">
                @include('frontend.common.aside_right_chat')
            </div>
        </div>
     </div>
</section>
@push('js')
<script>
  (function ($) {
    $(document).ready(function(){
      
    // hide .navbar first
    $(".navbar-xs").hide();

  });
    }(jQuery));
</script>


@endpush
@endsection