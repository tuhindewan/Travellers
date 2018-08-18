@extends('frontend.layout.app')

@push('css-style')

<link href="{{asset('public/backend/css/style.min_2.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('public/frontend/css/images-grid.css')}}">
<link rel="stylesheet" href="{{asset('public/frontend/css/connection/connection_index.css')}}">
<link rel="stylesheet" href="{{asset('public/frontend/css/pages/post_type_page.css')}}" />
<link rel="stylesheet" href="{{asset('public/frontend/css/pages/post_page.css')}}" />
<link rel="stylesheet" href="{{asset('public/frontend/css/pages/aside_right_chat.css')}}" />
<link rel="stylesheet" href="{{asset('public/css/like/like.css')}}">
<link rel="stylesheet" href="{{asset('public/frontend/css/profile/profile_timeline.css')}}" />
<style>
    .post_activity_left { width: 13.5% !important; }
    small{font-size: 13px !important;}
    .button_gly {margin-top: 0 !important;}
    .comment_add_section{margin-top: 10px;}
    .signle_post_section{width: 100%; height: auto; margin-top: 60px;}
</style>
@endpush
@section('content')
@include('frontend._partials.nav')
<section class="connection_page">
    
     <div class="container-fluid signle_post_section">
        <div class="row">
            
           
            <div class="col-md-2">
                
            </div>
            <div class="col-md-4 no_padding">
                <div class="single_post_content">
                    <input type="hidden" id="postId" value="{{$getPost->_id}}">
                    <single-post :post="{{ json_encode($getPost) }}"></single-post> 
                </div>
            </div>
            <div class="col-md-3">
                <div class="top_section">
                    <div class="experiences top_box">
                        <div class="panel panel-default">
                          <div class="panel-body">
                            <p><b style="display: inline">@if($getPost->post_type == '4')Experiences @elseif($getPost->post_type == '3')  Plans @elseif($getPost->post_type == '2') Questions @else Suggestions @endif</b><a class="text-right" style="float: right;">see all</a></p>

                            <div class="top_section_content">
                                @foreach($getTypePost as $post)
                                <div class="single_section">
                                    <hr>
                                    <a href="" class="">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="author_img">
                                                    <?php $image = $post->users->profile_image; ?>
                                                    <img src='{{asset("images/users/profile/s160$image")}}' alt="">
                                                </div>
                                            </div>
                                            <div class="col-sm-10 no_padding">
                                                <div class="postDescription">
                                                    <a class="capitalize" href='<?php echo url('/').'/'.$post->users->username; ?>'>
                                                        <b>{{$post->users->fullname }} </b>
                                                        <userLink :userinfo="{{ json_encode($post->users) }}"></userLink>
                                                    </a> 
                                                    <p> {{$post->description}}</p>      
                                                </div>
                                            </div>
                                            <?php $username = $post->users->username; ?>
                                            <a href='<?php echo url("/$username/posts/$post->_id") ?>'> <?php echo $post->created_at->diffForHumans(); ?></a>
                                        </div>
                                    </a>
                                </div>
                                @endforeach
                                
                            </div>
                          </div>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
       
            
            
            <div class="col-md-2 right-section">
                @include('frontend.common.aside_right_chat')
            </div>
        </div>
     </div>
</section>
@push('js')
    
    
    <script type="text/javascript" src="{{asset('public/js/dialog.min.js')}}"></script>

    <script src="{{asset('public/frontend/js/images-grid.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    
    <!-- mousewheel scroll up and down -->
    
    
@endpush
@endsection