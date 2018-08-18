@push('css-style')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css" media="all" />
    
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/price_range_style.css')}}"/>
@endpush
<?php 
    if(Session::has('searchDetail')){
        $search = Session::get('searchDetail');
        $location = $search['location'];
        $checkIn = $search['check_in'];
        $checkOut = $search['check_out'];
        $adult = $search['adult'];
        $children = $search['children'];
        $room = $search['room'];
        $min = $search['min'];
        $max = $search['max'];
    }else{
        $location = '';
        $checkIn = '';
        $checkOut = '';
        $adult = '1';
        $children = '0';
        $room = '1';
        $min = 0;
        $max = $maxprice; 
    }

 ?>
{!! Form::open(array('url' => 'accumulator-search','class'=>'','method'=>'POST','files'=>'true')) !!}
  {!! csrf_field() !!}
    <div class="form-group capitalize">
        <label for="form-filter-destination">Destination</label>
        {{ Form::select('location', ['' => '- select location -', 'barguna' => 'barguna','barisal' => 'barisal','bagerhat' => 'bagerhat','bhola' => 'bhola','bandarban' => 'bandarban','brahmanbaria' => 'brahmanbaria','bogra' => 'bogra','chandpur' => 'chandpur','chittagong' => 'chittagong','comilla' => 'comilla',"cox's bazar" => "cox's bazar",'chuadanga' => 'chuadanga','chapai nawabganj' => 'chapai nawabganj','dhaka' => 'dhaka','dinajpur' => 'dinajpur','dighapatia palace' => 'dighapatia palace','feni' => 'feni','faridpur' => 'faridpur','fakir lalon shah’s mazaar' => 'fakir lalon shah’s mazaar','gazipur' => 'gazipur','gopalganj' => 'gopalganj','gaibandha' => 'gaibandha','habiganj' => 'habiganj','jhalokati' => 'jhalokati','jessore' => 'jessore','jhenaidah' => 'jhenaidah','jamalpur' => 'jamalpur','joypurhat' => 'joypurhat','jaflong' => 'jaflong','kuakata' => 'kuakata','khagrachari' => 'khagrachari','khulna' => 'khulna','kushtia' => 'kushtia','kurigram' => 'kurigram','kishoreganj' => 'kishoreganj','kaptai island' => 'kaptai island','kantajew temple' => 'kantajew temple','lalmonirhat' => 'lalmonirhat','madaripur' => 'madaripur','manikganj' => 'manikganj','munshiganj' => 'munshiganj','magura' => 'magura','mainamati' => 'mainamati','meherpur' => 'meherpur','mymensingh' => 'mymensingh','moulvibazar' => 'moulvibazar','madhabkunda' => 'madhabkunda','mahasthangarh' => 'mahasthangarh','moheshkhali island' => 'moheshkhali island','noakhali' => 'noakhali','nijhum dwip' => 'nijhum dwip','narayanganj' => 'narayanganj','narsingdi' => 'narsingdi','narail' => 'narail','netrokona' => 'netrokona','naogaon' => 'naogaon','natore' => 'natore','nilphamari' => 'nilphamari','patuakhali' => 'patuakhali','pirojpur' => 'pirojpur','parki beach' => 'parki beach','pabna' => 'pabna','panchagarh' => 'panchagarh','paharpur buddha vihara' => 'paharpur buddha vihara','rangamati' => 'rangamati','rajbari' => 'rajbari','rajshahi' => 'rajshahi','rangpur' => 'rangpur','ratargul swamp lake' => 'ratargul swamp lake','sitakunda' => 'sitakunda','sonadia island' => 'sonadia island','sajek valley' => 'sajek valley','shariatpur' => 'shariatpur','sixty-dome-mosque' => 'sixty-dome-mosque','satkhira' => 'satkhira','sherpur' => 'sherpur','sirajganj' => 'sirajganj','sunamganj' => 'sunamganj','sylhet' => 'sylhet','sundarban' => 'sundarban','world war II cemetery' => 'world war II cemetery'], "$location", ['class' => 'form-control chosen']) }}
        
    </div>

    <!--end form-group-->
    <div class="form-group-inline">
        <div class="form-group date" data-date-format="mm-dd-yyyy">
            <label for="form-filter-check-in">Check In</label>
            <input name="check_in" required="required" type="text" class="form-control checkIn" value="{{$checkIn}}" placeholder="Check-In">
        </div>
        <!--end form-group-->
        <div class="form-group">
            <label for="form-filter-check-in">Check Out</label>
            <input name="check_out" required="required" type="text" class="form-control checkOut" value="{{$checkOut}}" placeholder="Check-Out"> 
        </div>
        <!--end form-group-->
    </div>
    
    <!--end form-group-inline-->
    <div class="form-group-inline">
        <div class="form-group">
            <label for="form-filter-check-out">Adult</label>
            {{ Form::select('adult',['1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6'],"$adult",['class'=>'form-control'])}}
            
        </div>
        <!--end form-group-->
        <div class="form-group">
            <label for="form-filter-check-out">Children</label>
            {{ Form::select('children',['0'=>'0','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5'],"$children",['class'=>'form-control'])}}
            
        </div>
        <!--end form-group-->
    </div>
    <!--end form-group-inline-->
    <div class="form-group-inline">
        <div class="form-group">
            <label for="form-filter-room">Room</label>
            {{ Form::select('room',['1'=>'1 room','2'=>'2 room','3'=>'3 room','4'=>'4 room','5'=>'5 room'],"room",['class'=>'form-control'])}}
            
        </div>
        <!--end form-group-->
    </div>
    <!--end form-group-inline-->
    <div class="form-group-inline">
        <div class="form-group">
            <label>Price</label>
            <input type="hidden" value="@if($maxprice) {{ $maxprice }} @endif" id="maxprice">
            <div id="slider-range" class="price-filter-range" name="rangeInput" style="width: 100%;"></div>
            <div style="margin:15px auto">
              <input name="min" type="number" min=0 max="{{ $maxprice }}" oninput="validity.valid||(value='0');" id="min_price" class="price-range-field" />
              <input name="max" type="number" min=0 max="{{ $maxprice }}" oninput='validity.valid||(value="{{ $maxprice }}");' id="max_price" class="price-range-field" />
            </div>
        </div>
        <!--end form-group-->
    </div>
    
    <!--end collapse-->
    <div class="form-group center">
        <button type="submit" class="btn btn-primary btn-rounded form-control">Search</button>
    </div>
{!! Form::close(); !!}
@push('js')

<!-- <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>
<script src="{{asset('public/js/price_range_script.js')}}" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
<script>
    $(".checkIn").datepicker({
        format: "yyyy-mm-dd",
        todayBtn: true,
        autoclose: true,
        startDate: new Date()
      })
      .on("changeDate", function(e) {
        var checkInDate = e.date, $checkOut = $(".checkOut");    
        checkInDate.setDate(checkInDate.getDate());
        //checkInDate.setDate(checkInDate.getDate() + 1);
        $checkOut.datepicker("setStartDate", checkInDate);
        $checkOut.datepicker("setDate", checkInDate).focus();
      });

    $(".checkOut").datepicker({
      format: "yyyy-mm-dd",
      todayBtn: true,
      autoclose: true
    });

    $(".checkIn1").datepicker({
        format: "yyyy-mm-dd",
        todayBtn: true,
        autoclose: true,
        startDate: new Date()
      })
      .on("changeDate", function(e) {
        var checkInDate = e.date, $checkOut1 = $(".checkOut1");    
        checkInDate.setDate(checkInDate.getDate());
        //checkInDate.setDate(checkInDate.getDate() + 1);
        $checkOut1.datepicker("setStartDate", checkInDate);
        $checkOut1.datepicker("setDate", checkInDate).focus();
      });

    $(".checkOut1").datepicker({
      format: "yyyy-mm-dd",
      todayBtn: true,
      autoclose: true
    });
</script>


@endpush



