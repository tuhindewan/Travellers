@extends('frontend.layout.app')

@push('css-style')
    <style>
      .inline{display: inline}
    </style>
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
                  <h4 class="text-center">Booking details</h4>

                 <div class="panel panel-default">
                    <div class="panel-body">
                      <div>

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#all-booking" aria-controls="all-booking" role="tab" data-toggle="tab">All booking</a></li>
                          <li role="presentation"><a href="#current-booking" aria-controls="current-booking" role="tab" data-toggle="tab">Current booking</a></li>
                          <li role="presentation"><a href="#future-booking" aria-controls="future-booking" role="tab" data-toggle="tab">Future booking</a></li>
                          
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                          <div role="tabpanel" class="tab-pane active" id="all-booking">
                            <div class="panel panel-info">
                              <div class="panel-heading text-center">All booking</div>
                              <div class="panel-body">
                                @foreach($getBooking as $booking)
                                <div class="single_booking">
                                  <div class="row">
                                    <div class="col-sm-4 no_padding">
                                      <div class="booking_room_img">
                                          <?php $check = 0; ?>
                                          @foreach($roomImages as $roomImg)
                                         
                                          @if($roomImg->fk_room_id == $booking->accumulator_room->_id)
                                            
                                          <?php $image = url('/images/host/room/photo/thum').'/'.$roomImg->image; 
                                            $check = 1;

                                          ?>
                                            @break
                                          @endif
                                          @endforeach
                                          @if($check==0)
                                          <?php $image = url('public/frontend/images/Cover/blank-cover-template-1.jpg'); ?>
                                          @endif
                                          
                                          <div class="item">

                                              <img  src="{{$image}}"  style="height: auto;" class="img-responsive">
                                          </div>
                                           
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                      <div class="booking_room_description">
                                        <div class="row">
                                          <div class="col-sm-8">
                                            <div class="title">
                                              <a ><h3 class="capitalize no_margin" style="font-size: 16px;">{{ $booking->accumulator_room->room_type }}</h3></a>
                                            </div>
                                            
                                          </div>
                                          <div class="col-sm-4">
                                            <div class="meta">
                                              <span><i class="fa fa-male"></i> {{ $booking->accumulator_room->adult }} </span>
                                              <span><i class="fa fa-child"></i> {{ $booking->accumulator_room->children }}</span>
                                            </div>
                                          </div>
                                        </div>  
                                        <!--end meta-->
                                        <div class="info">
                                            
                                          <figure class="location font12"><i class="fa fa-map-marker"></i> {{ $booking->host_accumulator->place_name }}</figure>

                                          <p>
                                              {{ $booking->accumulator_room->room_description }}
                                          </p>
                                          <figure class="pull-left">Check in : <kbd>{{ $booking->check_in }}</kbd></figure>
                                          
                                          <figure class="pull-right">Check out : <kbd>{{ $booking->check_out }}</kbd></figure>
                                          <br>
                                          <div class="price-info">From
                                            <span class="price">BDT {{ $booking->accumulator_room->rent_rate}}</span><span class="appendix">{{$booking->currency}}</span></div>
                                            <?php 
                                            $location = $booking->host_accumulator['location'];
                                            $title = $booking->host_accumulator->title;
                                            $urlLink = "stay-with-locals/$location/$title"; ?>
                                          <a href="{{ $urlLink }}" class="btn btn-rounded btn-default btn-framed btn-small" target="_blank">View detail</a>
                                          <?php 
                                            $d = new DateTime('+1day');
                                            $tomorrow = $d->format('Y-m-d');
                                            $today = date('Y-m-d');
                                          ?>

                                          @if($booking->check_in >= $tomorrow || $booking->check_in == $today)
                                          {!! Form::open(array('url'=> ['booking-cancel'],'method'=>'POST','class'=>'form_delete inline')) !!}
                                          {{ Form::hidden('id',$booking->_id)}}
                                          
                                            <button type="submit" onclick="return bookingCancel();" class="btn btn-rounded btn-danger btn-framed btn-small" style="color: #000;">Booking cancel
                                            </button>
                                          {!! Form::close() !!}

                                          @endif
                                          <kbd>Booking @if($booking->status == 0) requested @elseif($booking->status == 1) <kbd style="background:green">confirmed</kbd> @elseif($booking->status == 2 ) <kbd style="background:red">rejected</kbd> @endif </kbd> 
                                        </div>
                                        
                                        <!--end info-->
                                    </div> 
                                    </div>
                                  </div>
                                </div>
                                
                                  <!--end item-->
                                <hr>
                              @endforeach
                              </div>
                            </div>
                          </div>
                          <div role="tabpanel" class="tab-pane" id="current-booking">
                            <div class="panel panel-info">
                              <div class="panel-heading text-center">Current booking</div>
                              <div class="panel-body">
                                <?php $d = new DateTime('+2day');
                                  $day2 = $d->format('Y-m-d');
                                  $today = date('Y-m-d');

                                ?>
                                @foreach($getBooking as $booking)
                                @if($booking->check_in >= $today && $booking->check_in <= $day2)
                                <div class="single_booking">
                                  <div class="row">
                                    <div class="col-sm-4 no_padding">
                                      <div class="booking_room_img">
                                          <?php $check = 0; ?>
                                          @foreach($roomImages as $roomImg)
                                         
                                          @if($roomImg->fk_room_id == $booking->accumulator_room->_id)
                                            
                                          <?php $image = url('/images/host/room/photo/thum').'/'.$roomImg->image; 
                                            $check = 1;

                                          ?>
                                            @break
                                          @endif
                                          @endforeach
                                          @if($check==0)
                                          <?php $image = url('public/frontend/images/Cover/blank-cover-template-1.jpg'); ?>
                                          @endif
                                          
                                          <div class="item">

                                              <img  src="{{$image}}"  style="height: auto;" class="img-responsive">
                                          </div>
                                           
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                      <div class="booking_room_description">
                                        <div class="row">
                                          <div class="col-sm-8">
                                            <div class="title">
                                              <a ><h3 class="capitalize no_margin" style="font-size: 16px;">{{ $booking->accumulator_room->room_type }}</h3></a>
                                            </div>
                                            
                                          </div>
                                          <div class="col-sm-4">
                                            <div class="meta">
                                              <span><i class="fa fa-male"></i> {{ $booking->accumulator_room->adult }} </span>
                                              <span><i class="fa fa-child"></i> {{ $booking->accumulator_room->children }}</span>
                                            </div>
                                          </div>
                                        </div>  
                                        <!--end meta-->
                                        <div class="info">
                                            
                                          <figure class="location font12"><i class="fa fa-map-marker"></i> {{ $booking->host_accumulator->place_name }}</figure>

                                          <p>
                                              {{ $booking->accumulator_room->room_description }}
                                          </p>
                                          <figure class="pull-left">Check in : <kbd>{{ $booking->check_in }}</kbd></figure>
                                          
                                          <figure class="pull-right">Check out : <kbd>{{ $booking->check_out }}</kbd></figure>
                                          <br>
                                          <div class="price-info">From
                                            <span class="price">BDT {{ $booking->accumulator_room->rent_rate}}</span><span class="appendix">{{$booking->currency}}</span></div>
                                            <?php 
                                            $location = $booking->host_accumulator['location'];
                                            $title = $booking->host_accumulator->title;
                                            $urlLink = "stay-with-locals/$location/$title"; ?>
                                          <a href="{{ $urlLink }}" class="btn btn-rounded btn-default btn-framed btn-small" target="_blank">View detail</a>
                                          <?php 
                                            $d = new DateTime('+1day');
                                            $tomorrow = $d->format('Y-m-d');
                                            $today = date('Y-m-d');
                                          ?>

                                          @if($booking->check_in >= $tomorrow || $booking->check_in == $today)
                                          {!! Form::open(array('url'=> ['booking-cancel'],'method'=>'POST','class'=>'form_delete inline')) !!}
                                          {{ Form::hidden('id',$booking->_id)}}
                                          
                                            <button type="submit" onclick="return bookingCancel();" class="btn btn-rounded btn-danger btn-framed btn-small" style="color: #000;">Booking cancel
                                            </button>
                                          {!! Form::close() !!}

                                          @endif
                                          <kbd>Booking @if($booking->status == 0) requested @elseif($booking->status == 1) <kbd style="background:green">confirmed</kbd> @elseif($booking->status == 2 ) <kbd style="background:red">rejected</kbd> @endif </kbd> 
                                        </div>
                                        
                                        <!--end info-->
                                    </div> 
                                    </div>
                                  </div>
                                </div>
                                
                                  <!--end item-->
                                <hr>
                                @else
                                <div class="panel panel-default">
                                  <div class="panel-body">
                                    No current booking found!.
                                  </div>
                                </div>
                                @endif
                                @endforeach
                              </div>
                            </div>
                            
                          </div>
                          <div role="tabpanel" class="tab-pane" id="future-booking">
                            <div class="panel panel-info">
                              <div class="panel-heading text-center">Future booking</div>
                              <div class="panel-body">
                                <?php $d = new DateTime('+2day');
                                  $day2 = $d->format('Y-m-d');
                                  $today = date('Y-m-d');

                                ?>
                                @foreach($getBooking as $booking)
                                @if($booking->check_in > $day2)
                                <div class="single_booking">
                                  <div class="row">
                                    <div class="col-sm-4 no_padding">
                                      <div class="booking_room_img">
                                          <?php $check = 0; ?>
                                          @foreach($roomImages as $roomImg)
                                         
                                          @if($roomImg->fk_room_id == $booking->accumulator_room->_id)
                                            
                                          <?php $image = url('/images/host/room/photo/thum').'/'.$roomImg->image; 
                                            $check = 1;

                                          ?>
                                            @break
                                          @endif
                                          @endforeach
                                          @if($check==0)
                                          <?php $image = url('public/frontend/images/Cover/blank-cover-template-1.jpg'); ?>
                                          @endif
                                          
                                          <div class="item">

                                              <img  src="{{$image}}"  style="height: auto;" class="img-responsive">
                                          </div>
                                           
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                      <div class="booking_room_description">
                                        <div class="row">
                                          <div class="col-sm-8">
                                            <div class="title">
                                              <a ><h3 class="capitalize no_margin" style="font-size: 16px;">{{ $booking->accumulator_room->room_type }}</h3></a>
                                            </div>
                                            
                                          </div>
                                          <div class="col-sm-4">
                                            <div class="meta">
                                              <span><i class="fa fa-male"></i> {{ $booking->accumulator_room->adult }} </span>
                                              <span><i class="fa fa-child"></i> {{ $booking->accumulator_room->children }}</span>
                                            </div>
                                          </div>
                                        </div>  
                                        <!--end meta-->
                                        <div class="info">
                                            
                                          <figure class="location font12"><i class="fa fa-map-marker"></i> {{ $booking->host_accumulator->place_name }}</figure>

                                          <p>
                                              {{ $booking->accumulator_room->room_description }}
                                          </p>
                                          <figure class="pull-left">Check in : <kbd>{{ $booking->check_in }}</kbd></figure>
                                          
                                          <figure class="pull-right">Check out : <kbd>{{ $booking->check_out }}</kbd></figure>
                                          <br>
                                          <div class="price-info">From
                                            <span class="price">BDT {{ $booking->accumulator_room->rent_rate}}</span><span class="appendix">{{$booking->currency}}</span></div>
                                            <?php 
                                            $location = $booking->host_accumulator['location'];
                                            $title = $booking->host_accumulator->title;
                                            $urlLink = "stay-with-locals/$location/$title"; ?>
                                          <a href="{{ $urlLink }}" class="btn btn-rounded btn-default btn-framed btn-small" target="_blank">View detail</a>
                                          <?php 
                                            $d = new DateTime('+1day');
                                            $tomorrow = $d->format('Y-m-d');
                                            $today = date('Y-m-d');
                                          ?>

                                          @if($booking->check_in >= $tomorrow || $booking->check_in == $today)

                                          {!! Form::open(array('url'=> ['booking-cancel'],'method'=>'POST','class'=>'form_delete inline')) !!}
                                          {{ Form::hidden('id',$booking->_id)}}
                                          
                                            <button type="submit" onclick="return bookingCancel();" class="btn btn-rounded btn-danger btn-framed btn-small" style="color: #000;">Booking cancel
                                            </button>
                                          {!! Form::close() !!}

                                          @endif

                                          <kbd>Booking @if($booking->status == 0) requested @elseif($booking->status == 1) <kbd style="background:green">confirmed</kbd> @elseif($booking->status == 2 ) <kbd style="background:red">rejected</kbd> @endif </kbd> 
                                        </div>
                                        <!--end info-->
                                    </div> 
                                    </div>
                                  </div>
                                </div>
                                
                                  <!--end item-->
                                <hr>
                                @else
                                <div class="panel panel-default">
                                  <div class="panel-body">
                                    No feature booking found!.
                                  </div>
                                </div>
                                @endif
                                @endforeach
                              </div>
                            </div>  
                          </div>
                        </div>

                      </div>
                    </div>
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
  function bookingCancel() {
    return confirm('Do You Sure Want To Cancel This Booking ?');
  }
  
</script>

@endpush
@endsection