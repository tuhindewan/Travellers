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
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <h4>Booking  
                          @if($getBooking[0]->status == 0) request successfully sent @elseif($getBooking[0]->status == 1) confirmation  @elseif($getBooking[0]->status == 2) rejected  @elseif($getBooking[0]->status == 4) confirmed @elseif($getBooking[0]->status == 5) No show @else  cancel  @endif
                        </h4>
                        <hr>
                        <p>Thanks {{$getBooking[0]->users->fullname}}</p>
                        <h3>Your booking in {{$getBooking[0]->host_accumulator->place_name}} is @if($getBooking[0]->status == 0) request successfully sent @elseif($getBooking[0]->status == 1) confirmed  @elseif($getBooking[0]->status == 2) rejected  @elseif($getBooking[0]->status == 4) confirmed @elseif($getBooking[0]->status == 5) No show @else  cancel  @endif.</h3>
                      </div>
                    </div>

                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">Check your details</h3>
                      </div>
                      <div class="panel-body">
                        <h4>{{$getBooking[0]->host_accumulator->title}}</h4>

                        <div class="table-responsive">
                          <table class="table">
                            <tr>
                              <th>Confirmation number</th>
                              <td>{{$id}}</td>
                            </tr>
                            <tr>
                              <th>Check-In </th>
                              <td>{{$getBooking[0]->check_in}}</td>
                            </tr>
                            <tr>
                              <th>Check-Out </th>
                              <td>{{$getBooking[0]->check_out}}</td>
                            </tr>
                          </table>
                        </div>
                        @foreach($getBooking as $details)
                        <div class="panel panel-default">
                          <div class="panel-heading capitalize">
                            {{$details->accumulator_room->room_type}}
                            <span class="pull-right">{{$details->accumulator_room->rent_rate}} {{$details->accumulator_room->currency}}</span>
                          </div>
                          <div class="panel-body">
                            {{$details->accumulator_room->room_description}}
                            <div class="table-responsive">
                            <table class="table">
                              <tr>
                                <th>Adult</th>
                                <td>Children</td>
                              </tr>
                              <tr>
                                <th>{{$details->accumulator_room->adult}}</th>
                                <td>{{$details->accumulator_room->children}}</td>
                              </tr>
                              
                            </table>
                          </div>
                          </div>
                        </div>
                        @endforeach
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
  (function ($) {
    $(document).ready(function(){
      
    // hide .navbar first
    $(".navbar-xs").hide();

  });
    }(jQuery));
</script>


@endpush
@endsection