<?php 
	$j=0;
	for ($i=0; $i < $value; $i++) { 
		$j++;
		?>
		<div class="row">
		    <div class="col-md-12">
		        <div class="form-group">
		            <label for="email" class="cols-sm-2 control-label">Room {{ $j}} Type</label>
		            <div class="cols-md-10">
		                <div class="input-group">
		                    <span class="input-group-addon"><i class="fa fa-building-o fa" aria-hidden="true"></i></span>
		                    <input type="text" class="form-control" name="room_type[]" id="name"  placeholder="Ex: Ac room..." required>
		                </div>
		            </div>
		        </div>
		    </div>
		    
		</div>
		<div class="row">
	        <div class="col-md-12">
	            <div class="form-group">
	                <label for="name" class="cols-sm-2 control-label">Room  {{ $j}} Description</label>
	                <div class="cols-sm-10">
	                    <div class="input-group">
	                        <span class="input-group-addon"><i class="fa fa-asterisk fa" aria-hidden="true"></i></span>
	                        <textarea placeholder="Enter Description" name="room_description[]" class="form-control form-rounded" rows="3" required></textarea>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                        <div class="row">
                          <div class="load_select_option">
                            <div class="error_room_{{$j}}"></div>
                            <div class="file_load_room_{{$j}} data_load"></div>
                            <div class="load_chose_file_room_{{$j}} data_load"></div>
                          </div>
                        </div>
                    <div class="post-bottom">
                      <div class="row">
                        <div class="add_file_button col-md-6">
                          <label class="" for="post_file_room{{$j}}" style="margin-bottom: 0">
                                <a class=" btn options-message" data-toggle="tooltip" data-placement="top"   data-original-title="ADD PHOTOS">
                                  
                                    <span class="btn btn-info "><svg class="olymp-camera-icon" data-toggle="modal" data-target="#update-header-photo" style="padding-top: 8px;"><use xlink:href="public/frontend/icons/icons.svg#olymp-camera-icon"></use></svg> Add Photos</span>
                                </a>
                              </label>
                          <input type="file" id="post_file_room{{$j}}" multiple onchange='readURLRoom(this,this.id,"{{$j}}")' style="display:none;">

                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
		<div class="row">
		    <div class="col-md-6">
		        <div class="form-group">
		            <label for="adult" class="cols-sm-2 control-label">Room {{ $j}} Person (Adult)</label>
		            <div class="cols-md-10">
		                <div class="input-group spinner-male">
		                    <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
		                    <input type="number" class="form-control" min="0" value="1" name="adult[]" id="adult"/>
		                    <!-- <div class="input-group-btn-vertical">
		                      <button class="btn btn-default" style="min-height: 20px;" type="button"><i class="fa fa-caret-up"></i></button>
		                      <button class="btn btn-default" style="min-height: 20px;" type="button"><i class="fa fa-caret-down"></i></button>
		                    </div> -->
		                </div>
		            </div>
		        </div>
		    </div>
		    <div class="col-md-6">
		        <div class="form-group">
		            <label for="children" class="cols-sm-2 control-label">Room {{ $j}} Children</label>
		            <div class="cols-md-10">
		                <div class="input-group spinner-child">
		                    <span class="input-group-addon"><i class="fa fa-child fa" aria-hidden="true"></i></span>
		                    <input type="number" class="form-control" value="0" min="0" name="children[]" id="children"/>
		                    <!-- <div class="input-group-btn-vertical">
		                      <button class="btn btn-default" style="min-height: 20px;" type="button"><i class="fa fa-caret-up"></i></button>
		                      <button class="btn btn-default" style="min-height: 20px;" type="button"><i class="fa fa-caret-down"></i></button>
		                    </div> -->
		                </div>
		            </div>
		        </div>
		    </div>
		</div>

		<div class="row">
		    <div class="col-md-12">
		        <div class="form-group">
		            <label for="name" class="cols-sm-2 control-label">Room {{ $j}} Rent Rate (BDT) </label>
		            <div class="cols-sm-10">
		                <div class="input-group">
		                    <span class="input-group-addon"><i class="fa fa-credit-card fa" aria-hidden="true"></i></span>
		                    <input type="text" class="form-control" name="rent_rate[]" id="name"  placeholder="Ex: 1000-1200" required>
		                    <span class="input-group-addon"><select name="currency[]" title="Pick your condiments" data-live-search="true">
		                          <option>৳</option>
		                          <option>$</option>
		                      </select></span>
		                </div>
		                
		            </div>
		        </div>
		    </div>
		</div>
		<?php
	}
 ?>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
 <script type="text/javascript">
    function readURLRoom(input,image_load,id) {
    	
        if (input.files && input.files[0]) {
    		var error = 0;
    		var i=$('i').length;
            var reader = new FileReader();
            
            reader.onload = function (e) {
              var video = 'data:video';
              var string = e.target.result;
          if(string.match(video)){
            // $('.file_load_room_'+id).append('<div class="single_load_file" id="single_file_'+i+'"><video src="'+e.target.result+'" class="append_load_image" id="append_select_image">এই পাকনামি টা</video><button class="btn btn-danger btn-sm file_cancel_btn" id="'+i+'"><i class="fa fa-times" aria-hidden="true"></i></button><input type="hidden" name="video[]" value="'+e.target.result+'"></div>');

            //$('.error_room_'+id).append('No video upload!');

          }else{
          	var _token = $('input[name="_token"]').val();
	        var image = e.target.result;
	        var value = 1;
	        $.ajax({
	            url: "{{ URL::to('accumulator-image-upload')}}"+'/'+value,
	            type: "POST",
	            data: { _token : _token,
	                image: image
	            },
	            success: function(response){
	                var imageLink = response;
	                $('.file_load_room_'+id).append('<div class="single_load_file" id="single_file_'+i+'"><img src="'+e.target.result+'" class="append_load_image" id="append_select_image"><button type="button" class="btn btn-danger btn-sm file_cancel_btn" id="'+id+'-'+i+'" isvalue="'+imageLink+'" ispath="images/host/room/photo/"><i class="fa fa-times" aria-hidden="true"></i></button><input type="hidden" name="room_'+id+'[]" value="'+imageLink+'"></div>');
	                $(".image_upload_loader").css('display','none');
	            }
	        });
            
          }

                
            }
            reader.readAsDataURL(input.files[0]);
        i++;
        }
        $('.load_chose_file_room_'+id).html('<label class="load_file_label" for="post_file_room'+id+'"><div class="slide_upload"><img class="image_upload_loader" src="{{ URL::to("/public/loader-cycle.gif")}}" alt="" /></div></label>');
        /**/
        $(".load_chose_file_room_"+id).removeClass('remove_file');
         
    }

      
</script>
<script>
    $(document).on('click', '.file_cancel_btn', function(){
      var idValue = $(this).attr('id');
      var data = idValue.split("-");
      var id = data[1];
      var no = data[0];
      //alert(id);
      $("#single_file_"+id).remove();
      var extFile = $(".file_load_room_"+no).html();
      if(extFile==""){
        $(".load_chose_file_room_"+no).addClass('remove_file');
      }else{
        $(".load_chose_file_room_"+no).removeClass('remove_file');
      }

  });
</script>	