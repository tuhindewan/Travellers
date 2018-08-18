@extends('frontend.layout.app')

@push('css-style')
    
    <link rel="stylesheet" href="{{asset('public/frontend/css/style.css')}}">

    <link rel="stylesheet" href="{{asset('public/frontend/css/pages/aside_right_chat.css')}}" />

    <link rel="stylesheet" href="{{asset('public/frontend/css/host_traveller/style.css')}}">
    
    
    
<style>
    
    
        
        .mark-circle.description {
            background-color: #488f3e;
            color: #fff;
            opacity: 1;
            top: 95px;
            left: 0px;
        }
        .mark-circle.map {
            background-color: #488f3e;
            color: #fff;
            opacity: 1;
            bottom: 0px;
            top: 45px;
            left: 0px;
        }
        .mark-circle.top {
            left: 0px; bottom: 20px;
        }


        @import url(https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css);

        /*CAROUSEL*/
        .main-text {
            position: absolute;
            top: 100px;
            width: 96.66666666666666%;
            color: #FFF;
        }

        .carousel-btns {
            margin-top: 2em; 
        }

        .carousel-btns .btn {
            width: 150px;
        }

        .carousel-inner .imgOverlay {
            position: absolute;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(6, 28, 38, 0.5);
        }

        .carousel-inner img {
           width: 100%;
        }

        /*CONTROL*/
        .carousel-control {
            width: auto;
        }

        .carousel-control .icon-prev,
        .carousel-control .icon-next,
        .carousel-control .fa-chevron-left,
        .carousel-control .fa-chevron-right {
          position: absolute;
          top: 47%;
          right: 0;
          z-index: 5;
          display: inline-block;
          background-color: #000;
          width: 38px;
          height: 38px;
          line-height: 40px;
          font-size: 14px;
        }

        .carousel-control .icon-prev,
        .carousel-control .fa-chevron-left {
          left: 0;
        }

        .carousel-indicators li {
          width: 12px;
          height: 12px;
          margin: 0 1px;
          border: 2px solid #fff;
          opacity: .8;
        }

        .carousel-indicators .active {
            background-color: #28ace2;
            border-color: #28ace2;
        }

        .carousel-control .icon-prev, .carousel-control .fa-chevron-left,
        .carousel-control .icon-right, .carousel-control .fa-chevron-right {
            border-radius: 50px;
        }

        .carousel-control .icon-prev, .carousel-control .fa-chevron-left {
            left: 30px;
        }

        .carousel-control .icon-right, .carousel-control .fa-chevron-right {
            right: 30px;
        }

</style>
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
                    <div class="title">
                        <h1>Listing</h1>
                        <div class="display-selector">
                            <span>Display:</span>
                            <a href="#" class="active" data-toggle="tooltip" data-placement="left" title="Display list"><i class="fa fa-th-list"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="left" title="Display matrix"><i class="fa fa-th"></i></a>
                        </div>
                    </div>
                    <!--end title-->
                    @if(count($hosts) > 0)
                    @foreach($hosts as $host)

                        <div class="item list" data-map-latitude="48.87" data-map-longitude="2.29" data-id="1">
                            <div class="image-wrapper">
                                <div class="mark-circle description" data-toggle="tooltip" data-placement="right" title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin quis erat vel quam aliquet hendrerit semper eget elit. Aenean tincidunt ultrices bibendum. Proin nisi erat, iaculis non pulvinar a, scelerisque ut est. "><i class="fa fa-question"></i></div>
                                <div class="mark-circle map" data-toggle="tooltip" data-placement="right" title="Show on map"><i class="fa fa-map-marker"></i></div>
                                <div class="mark-circle top" data-toggle="tooltip" data-placement="right" title="Top accommodation"><i class="fa fa-thumbs-up"></i></div>
                                <div class="image">
                                    <a href='{{URL::to("stay-with-locals/$host->location/$host->title")}}' class="">
                                        <div class="gallery">
                                            <div id="themeSlider" class="carousel slide" data-ride="carousel">
                                                
                                                <div class="carousel-inner">
                                                    
                                                    @if(count($host->accumulator_image) > 0)
                                                    <?php $image = $host->accumulator_image[0]['image']; ?>
                                                    <div class="item active">

                                                        <img  src='{{asset("images/host/photo/thum/$image")}}' alt="First slide" style="height: 200px;" class="img-responsive">
                                                    </div>
                                                   @else
                                                    <div class="item active">
                                                        <img  src='public/frontend/images/Cover/blank-cover-template-1.jpg' alt="First slide" style="height: 200px;">
                                                    </div>
                                                    @endif


                                                </div>

                                               
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <!--end image-->
                            <div class="description" style="padding: 10px 25px;">
                                <div class="meta">
                                    <?php $c = 0 ?>
                                    @if($roomCheck)
                                        @foreach($roomCheck as $check)
                                        @if($check['accumulatorId'] == $host->_id)
                                        <?php $c++; ?>
                                        @endif
                                        @endforeach
                                    @endif
                                    <i class="fa fa-hotel"></i>  {{ $host->room_no - $c }} Room available </span>
                                    
                                </div>
                                <!--end meta-->
                                <div class="info">
                                    <a href='{{URL::to("stay-with-locals/$host->location/$host->title")}}'><h3 style="font-size: 16px;">{{ $host->title}}</h3></a>

                                
                                    <figure class="location font12"><i class="fa fa-map-marker"></i> {{ $host->place_name }}</figure>

                                    <p>
                                        {{ substr($host->description, 0,100) }} {{ strlen($host->description)>100 ? "..." : "" }}
                                    </p>
                                    <!-- <div class="price-info">From<span class="price">BDT {{ $host->rent}}</span><span class="appendix">{{$host->currency}}</span></div> -->
                                    @if(($host->room_no - $c) !== 0)
                                    <div class="alert-success alert-dismissable" style=" padding: 5px;">
                                        
                                       <b>{{ $host->room_no - $c }} @if(($host->room_no - $c) > 1)room's @else room @endif available</b> 
                                    </div>
                                    @else
                                    <div class="alert-danger alert-dismissable" style="background: #f3f1f1; padding: 5px;">
                                        
                                       <b>{{ $host->room_no - $c }} room available</b> 
                                    </div>
                                    @endif
                                    <a href='{{URL::to("stay-with-locals/$host->location/$host->title")}}' class="btn btn-rounded btn-default btn-framed btn-small">View detail</a>
                                </div>
                                <!--end info-->
                            </div>
                            <!--end description-->
                        </div>
                        <!--end item-->

                    @endforeach
                    @else
                    <div class="panel panel-default">
                      <div class="panel-body no_results">
                        <img src="{{asset('public/img/no-results.png')}}" alt=""> <span>We couldn't found!</span>
                      </div>
                    </div>
                    
                    @endif
                    



                    <!-- <div class="center">
                        <ul class="pagination">
                            <li class="prev">
                                <a href="#"><i class="fa fa-arrow-left"></i></a>
                            </li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li class="next">
                                <a href="#"><i class="fa fa-arrow-right"></i></a>
                            </li>
                        </ul>
                        end pagination
                    </div> -->
                    <!-- end center-->
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