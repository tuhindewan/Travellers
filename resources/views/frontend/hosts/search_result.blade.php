@extends('frontend.layout.app')

@push('css-style')
<link rel="stylesheet" href="{{asset('public/frontend/css/style.css')}}">

<link rel="stylesheet" href="{{asset('public/frontend/css/pages/aside_right_chat.css')}}" />
<link rel="stylesheet" href="{{asset('public/frontend/css/host_traveller/style.css')}}">
<link rel="stylesheet" href="{{asset('public/frontend/css/host_traveller/elegant-fonts.css')}}">
<link rel="stylesheet" href="{{asset('public/frontend/css/host_traveller/zabuto_calendar.min.css')}}">
<link rel="stylesheet" href="{{asset('public/OwlCarousel2-2.3.3/dist/assets/owl.carousel.css')}}">
<link rel="stylesheet" href="{{asset('public/OwlCarousel2-2.3.3/dist/assets/owl.carousel.min.css')}}">
@include('frontend._partials.nav')
<style>
    
    
        .mark-circle.description {
            background-color: #488f3e;
            color: #fff;
            opacity: 1;
            bottom: 23px;
            left: 0px;
        }
        .mark-circle.map {
            background-color: #488f3e;
            color: #fff;
            opacity: 1;
            bottom: 0px;
            top: 100px;
            left: 0px;
        }
        .mark-circle.top {
            left: 0px;
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
                            <a href="{!! url('/listing-list') !!}" class="active" data-toggle="tooltip" data-placement="left" title="Display list"><i class="fa fa-th-list"></i></a>
                            <a href="{!! url('/listing-grid') !!}" data-toggle="tooltip" data-placement="left" title="Display matrix"><i class="fa fa-th"></i></a>
                        </div>
                    </div>
                    <!--end title-->

                    @foreach($resultHosts as $host)
                    <?php 
                     $info_id = $host['_id'];
                    $info_details = App\Models\Host::findOrFail($info_id);
                    ?>
                        <div class="item list" data-map-latitude="48.87" data-map-longitude="2.29" data-id="1">
                            <div class="image-wrapper">
                                <div class="mark-circle description" data-toggle="tooltip" data-placement="right" title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin quis erat vel quam aliquet hendrerit semper eget elit. Aenean tincidunt ultrices bibendum. Proin nisi erat, iaculis non pulvinar a, scelerisque ut est. "><i class="fa fa-question"></i></div>
                                <div class="mark-circle map" data-toggle="tooltip" data-placement="right" title="Show on map"><i class="fa fa-map-marker"></i></div>
                                <div class="mark-circle top" data-toggle="tooltip" data-placement="right" title="Top accommodation"><i class="fa fa-thumbs-up"></i></div>
                                <div class="image">
                                    <a href="{{ route('host_info.show',$info_id) }}" class="">
                                        <div class="gallery">
                                            <div id="themeSlider" class="carousel slide" data-ride="carousel">
                                                <!-- <ol class="carousel-indicators">
                                                    <li data-target="#themeSlider" data-slide-to="0" class="active"></li>
                                                    <li data-target="#themeSlider" data-slide-to="1"></li>
                                                    <li data-target="#themeSlider" data-slide-to="2"></li>
                                                </ol>
                                                 -->
                                                <div class="carousel-inner">
                                                <?php 
                                                 $host_image = App\Models\HostImage::where('fk_host_info_id', new \MongoDB\BSON\ObjectID($info_id))->orderBy('created_at','desc')->first();
                                                 $image = $host_image['images'];
                                                ?>
                                                    

                                                    
                                                     @if($image)
                                                     <div class="item active">
                                                         <img  src='{{asset("images/Host/photo/s487/$image")}}' alt="First slide" style="height: 200px;">
                                                     </div>
                                                    @else
                                                     <div class="item active">
                                                         <img  src='public/frontend/images/Cover/blank-cover-template-1.jpg' alt="First slide" style="height: 200px;">
                                                     </div>
                                                     @endif
                                                    


                                                </div>

                                                <!-- <a class="left carousel-control" href="#themeSlider" data-slide="prev">
                                                    <span class="fa fa-chevron-left"></span>
                                                </a>
                                                <a class="right carousel-control"href="#themeSlider" data-slide="next">
                                                    <span class="fa fa-chevron-right"></span>
                                                </a> -->
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <!--end image-->
                            <div class="description">
                                <div class="meta">
                                    <span><i class="fa fa-male"></i>{{ $info_details->adult }}</span>
                                    <span><i class="fa fa-child"></i>{{ $info_details->children }}</span>
                                </div>
                                <!--end meta-->
                                <div class="info">
                                    <a href="{{ route('host_info.show',$info_id) }}"><h3 style="font-size: 20px;">{{ $info_details->title}}</h3></a>

                                
                                    <figure class="location">{{ $host['place_name'] }}</figure>


                                    <figure class="label label-info">check in</figure>
                                    <figure class="label label-info">{{ $info_details->start_date_time }}</figure>
                                    <figure class="label live-info">check out</figure>
                                    <figure class="label live-info">{{ $info_details->end_date_time }}</figure>
                                    <p>
                                        {{ substr($info_details->description, 0,100) }} {{ strlen($info_details->description)>100 ? "..." : "" }}
                                    </p>
                                    <div class="price-info">From<span class="price">BDT {{ $info_details->rent}}</span><span class="appendix">/night</span></div>
                                    <a href="{{ route('host_info.show',$info_id) }}" class="btn btn-rounded btn-default btn-framed btn-small">View detail</a>
                                </div>
                                <!--end info-->
                            </div>
                            <!--end description-->
                        </div>
                        <!--end item-->

                    @endforeach
                    



                    <div class="center">
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
                        <!-- end pagination-->
                    </div>
                    <!-- end center-->
                </div>
                <!--end main-content-->      
            </div>
            <div class="col-md-3 right-section">
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

<script type="text/javascript" src="{{asset('public/OwlCarousel2-2.3.3/dist/owl.carousel.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/OwlCarousel2-2.3.3/dist/owl.carousel.js')}}"></script>


@endpush
@endsection