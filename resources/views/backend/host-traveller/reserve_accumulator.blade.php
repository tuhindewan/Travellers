
@extends('backend.layout.app')
    @section('content') 
    <style>
        .form_delete{display: inline;}
        .form-group{display: block !important;}
        .modal-body input{width: 100% !important;} 
        .form-group {width: 100%;overflow: hidden;}
        table { table-layout: fixed; }
        table th, table td { overflow: hidden; }
        .read_row{background: #fff !important;}
        .unread_row{background: #f0f3f5 !important;}
        .room_comfirm_btn{display: inline;}
    </style>


    <!-- begin #content -->
    <div id="content" class="content">
        
        <ol class="breadcrumb pull-right">
            <li><a href="javascript:;">Dashboard</a></li>
            <li class="active">Reserve accumulator</li>
        </ol>
        <h1 class="page-header"><small>Dashboard > </small>Reserve accumulator Page</h1>
        <hr>
        <!-- start row -->
        <div class="row">
            <div class="role_view_section">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">Reserve accumulator</h4>
                    </div>
                    <div class="panel-body">
                       <div>

                          <!-- Nav tabs -->
                          <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#all" aria-controls="all" role="tab" data-toggle="tab">All booking</a></li>
                            <li role="presentation"><a href="#Current" aria-controls="Current" role="tab" data-toggle="tab">Current booking</a></li>
                            <li role="presentation"><a href="#Future" aria-controls="Future" role="tab" data-toggle="tab">Future booking</a></li>
                            
                          </ul>

                          <!-- Tab panes -->
                          <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="all">
                                <br>
                                <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="5%">SL.</th>
                                            <th width="10%">User name</th>
                                            <th width="25%">Accumulator title</th>
                                            <th width="25%">Room type</th>
                                            <th width="10%">Check in</th>
                                            <th width="10%">Check out</th>
                                            <th width="15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=0; ?>
                                        @foreach($bookingData as $booking)
                                        
                                        <?php 
                                            $bookingId = $booking->_id;
                                            $userId = $booking->users->_id;
                                            $accumulatorId = $booking->host_accumulator['_id'];
                                        ?>
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td><a href='{{ URL::to("all_user/$userId")}}' target="_blank" class="capitalize">{{ $booking->users->fullname}}</a></td>
                                            <td><a href='{{ URL::to("host-accumulator/$accumulatorId")}}' target="_blank">{{ $booking->host_accumulator->title }}</a></td>
                                            <td><a href='{{ URL::to("host-accumulator/$accumulatorId")}}' target="_blank" class="capitalize">{{ $booking->accumulator_room->room_type }}</a></td>
                                            <td><kbd>{{ $booking->check_in }}</kbd></td>
                                            <td><kbd>{{ $booking->check_out }}</kbd></td>
                                            <td>
                                            <?php $d = new DateTime('+1day');
                                            $tomorrow  = $d->format('Y-m-d');
                                            $tomorrow  = $d->format('Y-m-d');
                                            $today = date('Y-m-d');
                                            ?>
                                            @if($booking->check_in >= $tomorrow || $booking->check_in == $today)
                                                @if($booking->status == 0)
                                                {!! Form::open(array('url'=> "reserve-request-confirm/$bookingId",'method'=>'get','class'=>'form room_comfirm_btn')) !!}
                                                <button type="sumbit" class="btn btn-success btn-sm">Confirm</button>
                                                {!! Form::close() !!}

                                                {!! Form::open(array('url'=> "reserve-request-reject/$bookingId",'method'=>'get','class'=>'form room_comfirm_btn')) !!}
                                                <button type="sumbit" class="btn btn-danger btn-sm">Reject</button>
                                                {!! Form::close() !!}

                                                @elseif($booking->status == 1)
                                                <kbd style="background: green">Confirmed</kbd> 
                                                {!! Form::open(array('url'=> "reserve-request-reject/$bookingId",'method'=>'get','class'=>'form room_comfirm_btn')) !!}
                                                <button type="sumbit" class="btn btn-danger btn-sm">Reject</button>
                                                {!! Form::close() !!}

                                                @elseif($booking->status == 2)
                                                <kbd style="background: red">Rejected</kbd> 
                                                {!! Form::open(array('url'=> "reserve-request-confirm/$bookingId",'method'=>'get','class'=>'form room_comfirm_btn')) !!}
                                                <button type="sumbit" class="btn btn-success btn-sm">Confirm</button>
                                                {!! Form::close() !!}
                                                @endif
                                            @else
                                                @if($booking->status == 0)
                                                <kbd style="background: red">Request</kbd>
                                                @elseif($booking->status == 1)
                                                {!! Form::open(array('url'=> "reserve-request-arrive/$bookingId",'method'=>'get','class'=>'form room_comfirm_btn')) !!}
                                                <button type="sumbit" class="btn btn-success btn-sm"> Arrived </button>
                                                {!! Form::close() !!}

                                                {!! Form::open(array('url'=> "reserve-request-postpone/$bookingId",'method'=>'get','class'=>'form room_comfirm_btn')) !!}
                                                <button type="sumbit" class="btn btn-danger btn-sm"> No show </button>
                                                {!! Form::close() !!}
                                                @elseif($booking->status == 2)
                                                <kbd style="background: red">Rejected</kbd>
                                                @elseif($booking->status == 4)
                                                <kbd style="background: red">Confirmed</kbd>
                                                @elseif($booking->status == 5)
                                                <kbd style="background: red">Canceled</kbd>
                                                @endif
                                            @endif

                                            </td>
                                        </tr>
                                        
                                        
                                        @endforeach 
                                    </tbody>
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="Current">
                                <br>
                                <table id="data-table1" class="table table-striped table-bordered nowrap" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="5%">SL.</th>
                                            <th width="10%">User name</th>
                                            <th width="25%">Accumulator title</th>
                                            <th width="25%">Room type</th>
                                            <th width="10%">Check in</th>
                                            <th width="10%">Check out</th>
                                            <th width="15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $i=0; 
                                            $d = new DateTime('+2day');
                                            $day2 = $d->format('Y-m-d');
                                            $today = date('Y-m-d');
                                        ?>
                                        @foreach($bookingData as $booking)
                                        @if($booking->check_in >= $today && $booking->check_in <= $day2)
                                        <?php 
                                            $bookingId = $booking->_id;
                                            $userId = $booking->users->_id;
                                            $accumulatorId = $booking->host_accumulator['_id'];
                                        ?>
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td><a href='{{ URL::to("all_user/$userId")}}' target="_blank" class="capitalize">{{ $booking->users->fullname}}</a></td>
                                            <td><a href='{{ URL::to("host-accumulator/$accumulatorId")}}' target="_blank">{{ $booking->host_accumulator->title }}</a></td>
                                            <td><a href='{{ URL::to("host-accumulator/$accumulatorId")}}' target="_blank" class="capitalize">{{ $booking->accumulator_room->room_type }}</a></td>
                                            <td><kbd>{{ $booking->check_in }}</kbd></td>
                                            <td><kbd>{{ $booking->check_out }}</kbd></td>
                                            <td>
                                            <?php $d = new DateTime('+1day');
                                            $tomorrow  = $d->format('Y-m-d');
                                            $tomorrow  = $d->format('Y-m-d');
                                            $today = date('Y-m-d');
                                            ?>
                                            @if($booking->check_in >= $tomorrow || $booking->check_in == $today)
                                                @if($booking->status == 0)
                                                {!! Form::open(array('url'=> "reserve-request-confirm/$bookingId",'method'=>'get','class'=>'form room_comfirm_btn')) !!}
                                                <button type="sumbit" class="btn btn-success btn-sm">Confirm</button>
                                                {!! Form::close() !!}

                                                {!! Form::open(array('url'=> "reserve-request-reject/$bookingId",'method'=>'get','class'=>'form room_comfirm_btn')) !!}
                                                <button type="sumbit" class="btn btn-danger btn-sm">Reject</button>
                                                {!! Form::close() !!}

                                                @elseif($booking->status == 1)
                                                <kbd style="background: green">Confirmed</kbd> 
                                                {!! Form::open(array('url'=> "reserve-request-reject/$bookingId",'method'=>'get','class'=>'form room_comfirm_btn')) !!}
                                                <button type="sumbit" class="btn btn-danger btn-sm">Reject</button>
                                                {!! Form::close() !!}

                                                @elseif($booking->status == 2)
                                                <kbd style="background: red">Rejected</kbd> 
                                                {!! Form::open(array('url'=> "reserve-request-confirm/$bookingId",'method'=>'get','class'=>'form room_comfirm_btn')) !!}
                                                <button type="sumbit" class="btn btn-success btn-sm">Confirm</button>
                                                {!! Form::close() !!}
                                                @endif
                                            @else
                                                @if($booking->status == 0)
                                                <kbd style="background: red">Request</kbd>
                                                @elseif($booking->status == 1)
                                                {!! Form::open(array('url'=> "reserve-request-arrive/$bookingId",'method'=>'get','class'=>'form room_comfirm_btn')) !!}
                                                <button type="sumbit" class="btn btn-success btn-sm"> Arrived </button>
                                                {!! Form::close() !!}

                                                {!! Form::open(array('url'=> "reserve-request-postpone/$bookingId",'method'=>'get','class'=>'form room_comfirm_btn')) !!}
                                                <button type="sumbit" class="btn btn-danger btn-sm"> No show </button>
                                                {!! Form::close() !!}
                                                @elseif($booking->status == 2)
                                                <kbd style="background: red">Rejected</kbd>
                                                @elseif($booking->status == 4)
                                                <kbd style="background: red">Confirmed</kbd>
                                                @elseif($booking->status == 5)
                                                <kbd style="background: red">Canceled</kbd>
                                                @endif
                                            @endif

                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach 
                                    </tbody>
                                </table>   
                            </div>
                            <div role="tabpanel" class="tab-pane" id="Future">
                                <br>
                                <table id="data-table2" class="table table-striped table-bordered nowrap" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="5%">SL.</th>
                                            <th width="10%">User name</th>
                                            <th width="25%">Accumulator title</th>
                                            <th width="25%">Room type</th>
                                            <th width="10%">Check in</th>
                                            <th width="10%">Check out</th>
                                            <th width="15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i=0;
                                            $d = new DateTime('+2day');
                                            $day2 = $d->format('Y-m-d');
                                            $today = date('Y-m-d'); 
                                        ?>
                                        @foreach($bookingData as $booking)
                                        @if($booking->check_in > $day2)
                                        <?php 
                                            $bookingId = $booking->_id;
                                            $userId = $booking->users->_id;
                                            $accumulatorId = $booking->host_accumulator['_id'];
                                        ?>
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td><a href='{{ URL::to("all_user/$userId")}}' target="_blank" class="capitalize">{{ $booking->users->fullname}}</a></td>
                                            <td><a href='{{ URL::to("host-accumulator/$accumulatorId")}}' target="_blank">{{ $booking->host_accumulator->title }}</a></td>
                                            <td><a href='{{ URL::to("host-accumulator/$accumulatorId")}}' target="_blank" class="capitalize">{{ $booking->accumulator_room->room_type }}</a></td>
                                            <td><kbd>{{ $booking->check_in }}</kbd></td>
                                            <td><kbd>{{ $booking->check_out }}</kbd></td>
                                            <td>
                                            <?php $d = new DateTime('+1day');
                                            $tomorrow  = $d->format('Y-m-d');
                                            $tomorrow  = $d->format('Y-m-d');
                                            $today = date('Y-m-d');
                                            ?>
                                            @if($booking->check_in >= $tomorrow || $booking->check_in == $today)
                                                @if($booking->status == 0)
                                                {!! Form::open(array('url'=> "reserve-request-confirm/$bookingId",'method'=>'get','class'=>'form room_comfirm_btn')) !!}
                                                <button type="sumbit" class="btn btn-success btn-sm">Confirm</button>
                                                {!! Form::close() !!}

                                                {!! Form::open(array('url'=> "reserve-request-reject/$bookingId",'method'=>'get','class'=>'form room_comfirm_btn')) !!}
                                                <button type="sumbit" class="btn btn-danger btn-sm">Reject</button>
                                                {!! Form::close() !!}

                                                @elseif($booking->status == 1)
                                                <kbd style="background: green">Confirmed</kbd> 
                                                {!! Form::open(array('url'=> "reserve-request-reject/$bookingId",'method'=>'get','class'=>'form room_comfirm_btn')) !!}
                                                <button type="sumbit" class="btn btn-danger btn-sm">Reject</button>
                                                {!! Form::close() !!}

                                                @elseif($booking->status == 2)
                                                <kbd style="background: red">Rejected</kbd> 
                                                {!! Form::open(array('url'=> "reserve-request-confirm/$bookingId",'method'=>'get','class'=>'form room_comfirm_btn')) !!}
                                                <button type="sumbit" class="btn btn-success btn-sm">Confirm</button>
                                                {!! Form::close() !!}
                                                @endif
                                            @else
                                                @if($booking->status == 0)
                                                <kbd style="background: red">Request</kbd>
                                                @elseif($booking->status == 1)
                                                {!! Form::open(array('url'=> "reserve-request-arrive/$bookingId",'method'=>'get','class'=>'form room_comfirm_btn')) !!}
                                                <button type="sumbit" class="btn btn-success btn-sm"> Arrived </button>
                                                {!! Form::close() !!}

                                                {!! Form::open(array('url'=> "reserve-request-postpone/$bookingId",'method'=>'get','class'=>'form room_comfirm_btn')) !!}
                                                <button type="sumbit" class="btn btn-danger btn-sm"> No show </button>
                                                {!! Form::close() !!}
                                                @elseif($booking->status == 2)
                                                <kbd style="background: red">Rejected</kbd>
                                                @elseif($booking->status == 4)
                                                <kbd style="background: red">Confirmed</kbd>
                                                @elseif($booking->status == 5)
                                                <kbd style="background: red">Canceled</kbd>
                                                @endif
                                            @endif

                                            </td>
                                        </tr>
                                        
                                        @endif
                                        @endforeach 
                                    </tbody>
                                </table>
                            </div>
                            
                          </div>

                        </div> 
                        
                    </div>
                </div>
                <!-- end panel -->

            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end #content -->



   
    
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script>
        $(document).ready(function() {
           
            TableManageResponsive.init();

        });

        $(document).ready(function() {
            $('table.table').dataTable();
        } );
    </script>       
@endsection
