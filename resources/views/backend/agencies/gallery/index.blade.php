@extends('backend.layout.app')
	@section('content')	
	
	<style>
		
    .slide_upload {bottom: 6px;}
    label{text-align: right;}
    .add_image{width: 10%; margin: 0 auto;}
    .checkbox, .radio {margin-top: 0; margin-bottom: 0px;  }
    .gallery .image img { width: auto; height: 150px; border-radius: 3px 3px 0 0;}
    .gallery .image-btn { position: absolute; top: 15px; right: 0; background: rgba(0, 0, 0, .6); color: #fff; padding: 5px 15px; margin: 0;}
    .file_cancel_btn { right: -23px;}
	</style>

  <link href="{{asset('public/backend/plugins/lightbox/css/lightbox_2.css')}}" rel="stylesheet" />
	<link rel="stylesheet" href="{{asset('public/backend/css/agencies.css')}}">
	<!-- begin #content -->
	<div id="content" class="content">
		
		
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
                <h4 class="panel-title"> Gallery section</h4>
            </div>
            <div class="panel-body">
              <div class="create_gallery_section">
                <div class="row">
                  <div class="add_image">
                    <!-- Button trigger modal -->
                    <a type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addImage">
                      Add image/video
                    </a>

                    <!-- Modal -->
                    <div class="modal fade" id="addImage" tabindex="-1" role="dialog" aria-labelledby="myEditLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myEditLabel">Add new image</h4>
                          </div>
                          {!! Form::open(array('route' => 'agencies-gallery.store','class'=>'','method'=>'POST','files'=>'true')) !!}
                          {{ csrf_field() }}
                          <div class="modal-body">
                            <div class="row">
                              <div class="form-group col-sm-12">
                                <label class="control-label col-md-3 col-sm-3">Status :</label>
                                <div class="col-md-2 col-sm-2">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="status" value="1" id="radio-required" data-parsley-required="true"  checked> Active
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-3">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="status" id="radio-required2" value="0"> Inactive
                                        </label>
                                    </div>
                                </div> 
                              </div>
                              
                              <div class="form-group col-sm-12" >
                                  <label class="control-label col-sm-3">Choose file* : </label>
                                  <div class="col-sm-9">
                                    <div class="input-group">
                                        <label class="slide_upload" for="file" style="bottom:0">
                                            <!--  -->
                                            <div class="file_load"></div>
                                            <img class="image_load" src='{{ URL::to("/public/loader-cycle.gif")}}' alt="" style="display: none">
                                        </label>
                                        <input type="file" id="file" onchange="readURL(this,this.id)" style="display:none">
                                        
                                    </div>  
                                    
                                    <span class="text-danger errorMessage"></span>
                                    
                                        
                                  </div>
                              </div>
                              <div class="form-group col-sm-12" >
                                  <label class="control-label col-sm-3">File caption : </label>
                                  <div class="col-sm-9">
                                    <input type="text" placeholder="Type file caption" class="form-control" name="caption" >  
                                        
                                  </div>
                              </div>
                            </div>    
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                          {!! Form::close(); !!}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="view_gallery_section">
                <div class="row">
                  <div id="gallery" class="gallery">
                    @foreach($getGallery as $gallery)
                    <div class="image col-xs-2">
                        <div class="image-inner">
                            <a href='{{asset("images/agency/gallery/$gallery->file")}}' data-lightbox="gallery-group-1">
                              @if($gallery->type == 1)
                                <img src='{{asset("images/agency/gallery/$gallery->file")}}' alt="{{$gallery->caption}}">
                              @else
                              <video width="auto" height="150" controls>
                                <source src='{{asset("images/agency/gallery/$gallery->file")}}' type="video/mp4">
                              </video>
                              @endif
                            </a>
                            <p class="image-caption">
                                {{$gallery->caption}}
                            </p>
                            <!--  -->
                            <!-- delete gallery section -->
                            {!! Form::open(array('route'=> ['agencies-gallery.destroy',$gallery->_id],'method'=>'DELETE','class'=>'form_delete')) !!}
                                {{ Form::hidden('id',$gallery->_id)}}
                                <button type="submit" onclick="return confirmDelete();" class="btn btn-sm btn-danger image-btn">
                                  <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </button>
                            {!! Form::close() !!}
                            <!-- delete gallery section end -->
                        </div>
                        
                    </div>
                    @endforeach
                    
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

 
  <!-- ================== BEGIN PAGE LEVEL JS ================== -->
  
  <script src="{{asset('public/backend/plugins/lightbox/js/lightbox.min_2.js')}}"></script>
  <script src="{{asset('public/backend/js/gallery.demo.min_2.js')}}"></script>


<script type="text/javascript">
  function readURL(input,image_load) {
    var target_image='#'+$('#'+image_load).prev().children().attr('id');
    $(".image_load").css('display','block');
    if (input.files && input.files[0]) {
      var i=$('i').length;
      var reader = new FileReader();
        
      reader.onload = function (e) {
        var video = 'data:video';
        var string = e.target.result;
        var _token = $('input[name="_token"]').val();
        if(string.match(video)){
          var file = e.target.result;
          $.ajax({
            url: "{{ URL::to('agency-gallery-video-upload')}}",
            type: "POST",
            data: { _token : _token,
                file: file
            },
            success: function(response){
              var videoLink = response.result;
              var resultType = response.type;
              if(resultType == 'success'){
                $('.file_load').html('<div class="" id="single_file_'+i+'"><video src="'+e.target.result+'" class="append_load_image" id="append_select_image"></video><button type="button" class="btn btn-danger btn-sm file_cancel_btn" id="'+videoLink+'" onclick="file_cancel(this.id)"><i class="fa fa-times" aria-hidden="true"></i></button><input id="file_data" type="hidden" name="file" value="'+videoLink+'"><input id="type_data" type="hidden" name="type" value="2"></div>');  
                $(".errorMessage").html('');
              }else{
                $(".errorMessage").html(response.result);
              }
              $(".image_load").css('display','none');
            }
          });
        }else{
          var file = e.target.result;
          $.ajax({
            url: "{{ URL::to('agency-gallery-image-upload')}}",
            type: "POST",
            data: { _token : _token,
                file: file
            },
            success: function(response){
              var imageLink = response;
              $('.file_load').append('<div class="" id="single_file_'+i+'"><img src="'+e.target.result+'" class="append_load_image" id="append_select_image"><button type="button" class="btn btn-danger btn-sm file_cancel_btn" id="'+imageLink+'" onclick="file_cancel(this.id)"><i class="fa fa-times" aria-hidden="true"></i></button><input type="hidden" id="file_data" name="file" value="'+imageLink+'"><input id="type_data" type="hidden" name="type" value="1"></div>');
                $(".image_load").css('display','none');
            }
          });
        }   
      }
      reader.readAsDataURL(input.files[0]);
    i++;
    }
    
         
  }

</script>
<script>
  function file_cancel(url){
    var _token = $('input[name="_token"]').val();
    $.ajax({
      url: "{{ URL::to('agency-gallery-file-delete')}}",
      type: "POST",
      data: { _token : _token,
          file: url
      },
      success: function(response){
        if(response == 'success'){
          $(".file_load").html('');
        }
      }
    });
  }
</script>
<script>
    $(document).ready(function() {
        // /App.init();
        Gallery.init();
    });
</script> 		
@endsection
