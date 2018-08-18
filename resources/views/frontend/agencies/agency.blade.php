@extends('frontend.layout.app')

@push('css-style')
    <link rel="stylesheet" href="{{asset('public/frontend/css/style.css')}}">

    <link rel="stylesheet" href="{{asset('public/frontend/css/pages/aside_right_chat.css')}}" />
<link rel="stylesheet" href="{{asset('public/frontend/css/host_traveller/style.css')}}">
<link rel="stylesheet" href="{{asset('public/frontend/css/agencies/style.css')}}">
<link rel="stylesheet" href="{{asset('public/frontend/css/host_traveller/elegant-fonts.css')}}">
<link rel="stylesheet" href="{{asset('public/frontend/css/host_traveller/zabuto_calendar.min.css')}}">


<link rel="stylesheet" href="{{asset('public/frontend/css/profile_settings/account_settings.css')}}">
<link rel="stylesheet" href="{{asset('public/frontend/css/profile_settings/personal_information.css')}}">
<link rel="stylesheet" href="{{asset('public/frontend/css/profile_settings/notifications.css')}}">
<link rel="stylesheet" href="{{asset('public/frontend/css/profile_settings/friend_request.css')}}">
<link rel="stylesheet" href="{{asset('public/frontend/css/connection/connection_index.css')}}">
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

        .cover--header {
            padding-top: 215px !important;
            color: #999;
            background-size: 100% 300px;
            background-position: center top;
            margin-top: -5px;
        }
        .cover--avatar {
            display: inline-block;
            position: relative;
            margin-bottom: 12px;
            padding: 5px;
            z-index: 0;
        }
        .cover--avatar img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
        }

        .cover--user-activity {
            margin-top: 5px;
        }

        .cover--avatars {
            margin-top: 14px;
        }

        .cover--avatars .nav {
            font-size: 0;
            line-height: 0;
        }

        .cover--avatars .nav > li {
            float: none;
            display: inline-block;
            margin: 0 15px;
        }

        .cover--avatars .nav > li > a {
            padding: 1px;
            border-radius: 50%;
            overflow: hidden;
        }

        .cover--avatars .nav > li > a img {
            width: 20px;
            height: 20px;
            border-radius: 50%;
        }
        .cover--avatars + .cover--user-desc {
            margin-top: 8px;
        }
        .cover--user-desc {
            display: inline-block;
            max-width: 800px;
            margin-top: 18px;
        }
        .fs--12 { font-size: 12px; line-height: 22px; }
        .fs--14 { font-size: 14px; line-height: 24px; }
        .fs--16 { font-size: 16px; line-height: 26px; }
        .fs--18 { font-size: 18px; line-height: 28px; }
        .fs--20 { font-size: 20px; line-height: 30px; }
        .fs--22 { font-size: 22px; line-height: 32px; }
        .fs--24 { font-size: 24px; line-height: 34px; }
        .fs--26 { font-size: 26px; line-height: 36px; }
        .fs--28 { font-size: 28px; line-height: 38px; }
        .fs--30 { font-size: 30px; line-height: 40px; }

        .fw--100 { font-weight: 100; }
        .fw--200 { font-weight: 200; }
        .fw--300 { font-weight: 300; }
        .fw--400 { font-weight: 400; }
        .fw--500 {font-weight: 500;}
        .fw--600 { font-weight: 600; }
        .fw--700 { font-weight: 700; }
        .fw--800 { font-weight: 800; }
        .fw--900 { font-weight: 900; }

        .text-black { color: #333; }
        .text-darkest { color: #555; }
        .text-darker { color: #777; }
        .text-default { color: #999; }
        .text-lightest { color: #fefefe; }
        .text-gray { color: #aaa; }
        .text-lightgray { color: #ccc; }
        .text-white { color: #fff; }
        .text-primary { color: #1da1f2; }

        /* 2.3. MARGINS */
        .mt--0 { margin-top: 0; }
        .mt--2 { margin-top: 2px; }
        .mt--4 { margin-top: 4px; }
        .mt--6 { margin-top: 6px; }
        .mt--8 { margin-top: 8px; }
        .mt--10 { margin-top: 10px; }
        .mt--15 { margin-top: 15px; }
        .mt--20 { margin-top: 20px; }
        .mt--30 { margin-top: 30px; }
        .mt--40 { margin-top: 40px; }
        .mt--50 { margin-top: 50px; }
        .mt--60 { margin-top: 60px; }
        .mt--70 { margin-top: 70px; }
        .mt--80 { margin-top: 80px; }
        .mt--90 { margin-top: 90px; }
        .mt--100 { margin-top: 100px; }

        .mb--0 { margin-bottom: 0; }
        .mb--2 { margin-bottom: 2px; }
        .mb--4 { margin-bottom: 4px; }
        .mb--6 { margin-bottom: 6px; }
        .mb--8 { margin-bottom: 8px; }
        .mb--10 { margin-bottom: 10px; }
        .mb--15 { margin-bottom: 15px; }
        .mb--20 { margin-bottom: 20px; }
        .mb--30 { margin-bottom: 30px; }
        .mb--40 { margin-bottom: 40px; }
        .mb--50 { margin-bottom: 50px; }
        .mb--60 { margin-bottom: 60px; }
        .mb--70 { margin-bottom: 70px; }
        .mb--80 { margin-bottom: 80px; }
        .mb--90 { margin-bottom: 90px; }
        .mb--100 { margin-bottom: 100px; }

        .ml--0 { margin-left: 0; }
        .ml--2 { margin-left: 2px; }
        .ml--4 { margin-left: 4px; }
        .ml--6 { margin-left: 6px; }
        .ml--8 { margin-left: 8px; }
        .ml--10 { margin-left: 10px; }
        .ml--15 { margin-left: 15px; }
        .ml--20 { margin-left: 20px; }
        .ml--30 { margin-left: 30px; }
        .ml--40 { margin-left: 40px; }
        .ml--50 { margin-left: 50px; }
        .ml--60 { margin-left: 60px; }
        .ml--70 { margin-left: 70px; }
        .ml--80 { margin-left: 80px; }
        .ml--90 { margin-left: 90px; }
        .ml--100 { margin-left: 100px; }

        .mr--0 { margin-right: 0; }
        .mr--2 { margin-right: 2px; }
        .mr--4 { margin-right: 4px; }
        .mr--6 { margin-right: 6px; }
        .mr--8 { margin-right: 8px; }
        .mr--10 { margin-right: 10px; }
        .mr--15 { margin-right: 15px; }
        .mr--20 { margin-right: 20px; }
        .mr--30 { margin-right: 30px; }
        .mr--40 { margin-right: 40px; }
        .mr--50 { margin-right: 50px; }
        .mr--60 { margin-right: 60px; }
        .mr--70 { margin-right: 70px; }
        .mr--80 { margin-right: 80px; }
        .mr--90 { margin-right: 90px; }
        .mr--100 { margin-right: 100px; }

        /* 2.4. PADDINGS */
        .pt--8 { padding-top: 8px; }
        .pt--10 { padding-top: 10px; }
        .pt--15 { padding-top: 15px; }
        .pt--20 { padding-top: 20px; }
        .pt--30 { padding-top: 30px; }
        .pt--40 { padding-top: 40px; }
        .pt--50 { padding-top: 50px; }
        .pt--60 { padding-top: 60px; }
        .pt--70 { padding-top: 70px; }
        .pt--80 { padding-top: 80px; }
        .pt--90 { padding-top: 90px; }
        .pt--100 { padding-top: 100px; }
        .pt--150 { padding-top: 150px; }

        .pb--8 { padding-bottom: 8px; }
        .pb--10 { padding-bottom: 10px; }
        .pb--15 { padding-bottom: 15px; }
        .pb--20 { padding-bottom: 20px; }
        .pb--30 { padding-bottom: 30px; }
        .pb--40 { padding-bottom: 40px; }
        .pb--50 { padding-bottom: 50px; }
        .pb--60 { padding-bottom: 60px; }
        .pb--70 { padding-bottom: 70px; }
        .pb--80 { padding-bottom: 80px; }
        .pb--90 { padding-bottom: 90px; }
        .pb--100 { padding-bottom: 100px; }
        .pb--150 { padding-bottom: 150px; }

        .main--content-inner.drop--shadow {
            padding: 30px 20px;
            box-shadow: 0 0 3px rgba(0, 0, 0, 0.1);
        }
        /* 6.1. CONTENT NAV */
        .content--nav {
            margin: -30px -20px 0;
        }

        .content--nav .nav {
            padding: 10px 0;
            border-bottom: 1px solid #1da1f2;
        }

        .content--nav .nav > li {
            border-right: 1px solid rgba(0, 0, 0, 0.05);
        }

        .content--nav .nav > li:last-child {
            border-right-width: 0;
        }

        .content--nav .nav > li > a {
            padding: 8px 15px;
        }

        .activity--items > li {
            float: none;
        }

        .activity--items > li + li {
            margin-top: 30px;
        }

        .activity--items > li + li .activity--avatar {
            margin-top: 24px;
        }

        .activity--items > li + li .activity--info {
            padding-top: 24px;
            border-top: 1px solid #e5e5e5;
        }

        .activity--avatar {
            float: left;
            position: relative;
            width: 60px;
            height: 60px;
            margin-right: 15px;
            border-radius: 50%;
            overflow: hidden;
            z-index: 0;
        }

        .activity--avatar:before {
            content: " ";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #1da1f2;
            opacity: 0.3;
            z-index: -1;
        }

        .activity--avatar img {
            display: block;
            margin: 5px;
            border-radius: 50%;
        }

        .activity--info {
            overflow: hidden;
        }

        .activity--header p a {
            color: #555;
            font-weight: 700;
        }

        .activity--header .fa-smile-o {
            color: #ec407a;
        }

        .activity--meta {
            margin-top: 1px;
        }

        .activity--meta .fa {
            margin-left: 1px;
        }

        .activity--content {
            margin-top: 14px;
        }

        .activity--content .img--embed {
            max-width: 250px;
        }

        .activity--content .img--embed-full {
            max-width: none;
        }

        .activity--item .activity--content a {
            color: #555;
        }

        .activity--item .activity--content .btn-link {
            color: #1da1f2;
            font-style: italic;
        }
        .acomment--items > li {
            float: none;
        }

        .activity--action {
            margin-top: 6px;
        }

        /* 3.13. ACTIVITY COMMENTS */


        .acomment--item {
            margin-top: 22px;
            padding-top: 30px;
            border-top: 1px solid #e5e5e5;
        }

        .acomment--avatar {
            float: left;
            position: relative;
            margin-right: 18px;
            padding: 2px;
            z-index: 0;
        }

        .acomment--avatar:before {
            content: " ";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #1da1f2;
            border-radius: 50%;
            opacity: 0.3;
            z-index: -1;
        }

        .acomment--avatar img {
            display: block;
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .acomment--info {
            overflow: hidden;
        }

        .acomment--header p a {
            color: #555;
            font-weight: 700;
        }

        .acomment--meta {
            margin-top: 3px;
        }

        .acomment--meta .fa {
            margin-left: 1px;
        }

        .acomment--content {
            margin-top: 8px;
        }

        .acomment--content p {
            margin-bottom: 0;
        }

        .acomment--info .acomment--content a {
            color: #555;
        }

        /* 3.9. GALLERY EMBED */
        .gallery--embed .nav {
            margin: -20px -10px 0;
        }

        .gallery--embed .nav > li {
            float: left;
            width: 50%;
        }

        .gallery--embed .nav > li > a {
            display: block;
            position: relative;
            padding: 20px 10px 0;
            z-index: 0;
        }

        .gallery--embed .nav > li > a:before {
            top: 20px;
            left: 10px;
            right: 10px;
            bottom: 0;
            width: auto;
            height: auto;
            z-index: 1;
        }

        .gallery--embed .nav > li > a span {
            display: block;
            position: absolute;
            top: 50%;
            left: 10px;
            right: 10px;
            margin-top: -10px;
            color: #fff;
            font-size: 18px;
            line-height: 28px;
            text-align: center;
            z-index: 1;
        }

        img, .nav > li > a > img {
            max-width: 100%;
            height: auto;
        }

        .sideways {
          border-bottom: none;
          border-right: 1px solid #ddd;
          background-color: #1b547e;
        }

        .tabs-left>li {
          float: none;
         margin:0px;  
        }

        .tabs-left>li.active>a,
        .tabs-left>li.active:hover,
        .tabs-left>li.active:focus {
          border-bottom-color: #ddd;
          border-right-color: transparent;
          background:#fff;
          border:none;
          border-radius:0px;
          margin:0px;
          color: #333;
        }


        .tabs-left>li:hover{
          border-bottom-color: #ddd;
          border-right-color: transparent;
          background:#fff;
          border:none;
          border-radius:0px;
          margin:0px;
        }
        .nav-tabs>li>a:hover {
            /* margin-right: 2px; */
            line-height: 1.42857143;
            border: 1px solid transparent;
            /* border-radius: 4px 4px 0 0; */
        }
        .tabs-left>li.active>a::after{content: "";
            content: "";
            position: absolute;
            top: 10px;
            right: -10px;
            border-top: 10px solid transparent;
            border-bottom: 10px solid transparent;
            border-left: 10px solid #fff;
            display: block;
            width: 0;}

            .embed-responsive-100x400px{
              padding-bottom: 400px;
            }

            .gallery_container {
              width: 700px;
              height: 380px;
              margin: 20px auto;
              box-sizing: border-box;
            }

            .holder {
              width: 200px;
              height: 150px;
              margin: 15px;
              float: left;
            }

            .holder img {
              width:100%;
              height: 100%;
              opacity: 1;
              transition: opacity 1s, transform 0.7s        ease-in;
            }

            img:hover {
              opacity: 1;
              transform: scale(1.1);
              box-shadow: 1px 3px 8px 4px rgb(195, 195, 195);
            }

            .rating_heading {
                font-size: 20px;
                margin-right: 25px;
            }

            

            .checked {
                color: orange;
            }

            /* Three column layout */
            .side {
                float: left;
                width: 15%;
                margin-top:3px;
            }

            .middle {
                margin-top:10px;
                float: left;
                width: 70%;
            }

            /* Place text to the right */
            .right {
                text-align: right;
            }

            /* Clear floats after the columns */
            .row:after {
                content: "";
                display: table;
                clear: both;
            }

            /* The bar container */
            .bar-container {
                width: 100%;
                background-color: #f1f1f1;
                text-align: center;
                color: white;
            }

            /* Individual bars */
            .bar-5 {width: 70%;height: 4px;background-color: #2196F3;}
            .bar-4 {width: 30%; height: 4px;background-color: #2196F3;}
            .bar-3 {width: 10%; height: 4px;background-color: #2196F3;}
            .bar-2 {width: 4%; height: 4px;background-color: #2196F3;}
            .bar-1 {width: 15%; height: 4px;background-color: #2196F3;}

            /* Responsive layout - make the columns stack on top of each other instead of next to each other */
            @media (max-width: 400px) {
                .side, .middle {
                    width: 100%;
                }
                .right {
                    display: none;
                }
            }
</style>
@endpush
@section('content')
@include('frontend._partials.nav')
<section class="connection_page" style=" margin-top: 60px;">
     <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <!-- Cover Header Start -->
                <div class="row">
                    <div class="cover--header pt--80 text-center bg--img" data-bg-img="img/cover-header-img/bg-02.jpg" data-overlay="0.6" data-overlay-color="white" style="background-image: url('public/frontend/images/bg-02.jpg');">
                        <div class="container">
                            <div class="cover--avatar" data-overlay="0.3" data-overlay-color="primary">
                                <img src="public/frontend/images/avatar-02.jpg" alt="">
                            </div>

                            <div class="cover--user-name">
                                <h2 class="h3 fw--600">Food Recipes</h2>
                            </div>

                            <div class="cover--user-activity">
                                <p><i class="fa mr--8 fa-clock-o"></i>Active 1 year 9 monts ago</p>
                            </div>
                            <div class="cover--user-desc fw--400 fs--18 fstyle--i text-darkest">
                                <p>Hello everyone ! There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Cover Header End -->
                <br>
                <!-- Page Wrapper Start -->
                <div class="row">
                    <div class="col-md-3">
                        <ul class="nav nav-tabs tabs-left sideways">
                            <li class="active" style="border-bottom: 1px solid #e6ecf5;">
                                
                                <a href="#home-v" data-toggle="tab" style="padding-left: 25px;font-size: 13px;color: #fff;width: 100%"><i class="fa fa-home" aria-hidden="true" style="font-size: 16px;padding-right: 3px;"></i>Home</a>
                            </li>
                            <li style="border-bottom: 1px solid #e6ecf5;">
                                
                                <a href="#post-v" data-toggle="tab" style="padding-left: 25px;font-size: 13px;color: #fff;padding-right: 120px;width: 100%"><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 16px;padding-right: 3px;"></i>Posts</a>
                            </li>
                            <li style="border-bottom: 1px solid #e6ecf5;">
                                
                                <a href="#package-v" data-toggle="tab" style="padding-left: 25px;font-size: 13px;color: #fff;width: 100%;"><i class="fa fa-briefcase" aria-hidden="true" style="font-size: 16px;padding-right: 3px;"></i>Packages</a>
                            </li>
                            <li style="border-bottom: 1px solid #e6ecf5;">
                                
                                <a href="#gallery-v" data-toggle="tab" style="padding-left: 25px;font-size: 13px;color: #fff;width: 100%;"><i class="fa fa-picture-o" aria-hidden="true" style="font-size: 16px;padding-right: 3px;"></i>Gallery</a>                            
                            </li>

                            <li  style="border-bottom: 1px solid #e6ecf5;">
                                
                                <a href="#setting-v" data-toggle="tab" style="padding-left: 25px;font-size: 13px;color: #fff;width: 100%"><i class="fa fa-cogs" aria-hidden="true" style="font-size: 16px;padding-right: 3px;"></i>Settings</a>
                            </li>
                            <li  style="border-bottom: 1px solid #e6ecf5;">
                                
                                <a href="#about-v" data-toggle="tab" style="padding-left: 25px;font-size: 13px;color: #fff;width: 100%"><i class="fa fa-info-circle" aria-hidden="true" style="font-size: 16px;padding-right: 3px;"></i>About</a>
                            </li>
                            <li style="border-bottom: 1px solid #e6ecf5;">
                                
                                <a href="#review-v" data-toggle="tab" style="padding-left: 25px;font-size: 13px;color: #fff;width: 100%;"><i class="fa fa-star-o" aria-hidden="true" style="font-size: 16px;padding-right: 3px;"></i>Reviews</a>                            
                            </li>
                            <li style="border-bottom: 1px solid #e6ecf5;">
                                
                                <a href="#contact-v" data-toggle="tab" style="padding-left: 25px;font-size: 13px;color: #fff;width: 100%;"><i class="fa fa-phone-square" aria-hidden="true" style="font-size: 16px;padding-right: 3px;"></i>Contact</a>                            
                            </li>
                          </ul>
                    </div>

                    <div class="col-md-9" style="overflow: hidden;">
                        <div class="tab-content">
                            <div class="tab-pane active" id="home-v">Home Tab.</div>
                            <div class="tab-pane" id="post-v">Profile Tab.</div>
                            <div class="tab-pane" id="package-v">Messages Tab.</div>
                            <div class="tab-pane" id="gallery-v">
                                <div class="panel panel-default panel-shadow">
                                    <div class="panel-heading" style="font-size: 20px;font-weight: bolder;">
                                        <i class="fa fa-picture-o"></i>
                                        Gallery</div>
                                    <div class="panel-body">
                                        <div class="gallery_container">
                                             <div class="holder">
                                             <img src="https://images.unsplash.com/photo-1502214722586-9c0a74759710?auto=format&fit=crop&w=752&q=80">
                                             </div>
                                                
                                              <div class="holder">
                                              <img src="https://images.unsplash.com/photo-1464692805480-a69dfaafdb0d?auto=format&fit=crop&w=750&q=80">
                                              </div>

                                               <div class="holder">
                                               <img src="https://images.unsplash.com/photo-1481233673589-df886804ee96?auto=format&fit=crop&w=750&q=80">
                                               </div>
                                                    
                                               <div class="holder">
                                               <img src="https://images.unsplash.com/photo-1478145787956-f6f12c59624d?auto=format&fit=crop&w=750&q=80">
                                               </div>

                                               <div class="holder">
                                               <img src="https://images.unsplash.com/photo-1512248805576-c1b31f6fcab1?auto=format&fit=crop&w=751&q=80">
                                               </div>
                                                    
                                               <div class="holder">
                                               <img src="https://images.unsplash.com/photo-1498931299472-f7a63a5a1cfa?auto=format&fit=crop&w=753&q=80">
                                               </div>
                                        </div>
                                    </div>    

                                </div> 
                            </div>
                            <div class="tab-pane" id="setting-v">Settings Tab.</div>
                            <div class="tab-pane" id="about-v">About Tab.</div>
                            <div class="tab-pane" id="review-v">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="panel panel-default panel-shadow">
                                                <!-- <div class="panel-heading" style="font-size: 20px;font-weight: bolder;">
                                                    <i class="fa fa-picture-o"></i>
                                                    Gallery</div> -->
                                                <div class="panel-body">
                                                    <span class="rating_heading">User Rating</span>
                                                    <p><span style="padding: 5px 5px;font-size: 15px;" class="badge badge-pill badge-primary">4.1</span> average based on 254 reviews.</p>
                                                    <hr style="border:1px solid #f1f1f1;margin-top:10px;">

                                                    <div class="row">
                                                      <div class="side">
                                                        <div>5 stars</div>
                                                      </div>
                                                      <div class="middle">
                                                        <div class="bar-container">
                                                          <div class="bar-5"></div>
                                                        </div>
                                                      </div>
                                                      <div class="side right">
                                                        <div>150</div>
                                                      </div>
                                                      <div class="side">
                                                        <div>4 star</div>
                                                      </div>
                                                      <div class="middle">
                                                        <div class="bar-container">
                                                          <div class="bar-4"></div>
                                                        </div>
                                                      </div>
                                                      <div class="side right">
                                                        <div>63</div>
                                                      </div>
                                                      <div class="side">
                                                        <div>3 star</div>
                                                      </div>
                                                      <div class="middle">
                                                        <div class="bar-container">
                                                          <div class="bar-3"></div>
                                                        </div>
                                                      </div>
                                                      <div class="side right">
                                                        <div>15</div>
                                                      </div>
                                                      <div class="side">
                                                        <div>2 star</div>
                                                      </div>
                                                      <div class="middle">
                                                        <div class="bar-container">
                                                          <div class="bar-2"></div>
                                                        </div>
                                                      </div>
                                                      <div class="side right">
                                                        <div>6</div>
                                                      </div>
                                                      <div class="side">
                                                        <div>1 star</div>
                                                      </div>
                                                      <div class="middle">
                                                        <div class="bar-container">
                                                          <div class="bar-1"></div>
                                                        </div>
                                                      </div>
                                                      <div class="side right">
                                                        <div>20</div>
                                                      </div>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-md-9">
                                            <div class="panel panel-default panel-shadow">
                                                <!-- <div class="panel-heading" style="font-size: 20px;font-weight: bolder;">
                                                    <i class="fa fa-picture-o"></i>
                                                    Gallery</div> -->
                                                <div class="panel-body">
                                                    
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="contact-v">
                                <div class="panel panel-default panel-shadow">
                                    <div class="panel-heading" style="font-size: 20px;font-weight: bolder;">
                                        <i class="fa fa-phone-square"></i>
                                        Contact</div>
                                    <div class="panel-body">
                                        <div class="embed-responsive embed-responsive-100x400px">
                                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3652.5868795980323!2d90.41103359980882!3d23.726442524567027!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8f824831043%3A0x5b07cde0e0e8d5a1!2zUmFtbmEgQmhhYmFuLCA0NSwg4Kas4KaZ4KeN4KaX4Kas4Kao4KeN4Kan4KeBIOCmj-CmreCmv-CmqOCmv-CmiSwg4Kai4Ka-4KaV4Ka-IDEwMDA!5e0!3m2!1sbn!2sbd!4v1526278386198" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                                        </div>
                                        <br>
                                        <div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h4>Additional Contact Info</h4>
                                                    <hr style="border-top: 1px solid #e4e4e4;margin-top: -5px;margin-bottom: 5px;">
                                                    <ul style="font-size: 13px;padding-left: 0px;">
                                                        <li style="padding-bottom: 7px;">
                                                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                                            <a>contact@techadea.com</a>

                                                        </li>
                                                        <li style="padding-bottom: 7px;">
                                                            <i class="fa fa-globe" aria-hidden="true"></i>
                                                            <a href="http://www.techadea.com" target="_blank">http://www.techadea.com</a>
                                                        </li>
                                                        <li style="padding-bottom: 7px;">
                                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                                            <a href="http://www.techadea.com">+8801986069452</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
        </div>

        <div class="col-md-3 right-section">
            @include('frontend.common.aside_right_chat')
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