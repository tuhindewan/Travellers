<!-- Button trigger modal -->
<a type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal{{$service->_id}}">
  <i class="fa fa-edit"></i>
</a>

<!-- Modal -->
<div class="modal fade" id="editModal{{$service->_id}}" tabindex="-1" role="dialog" aria-labelledby="myEditLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myEditLabel">{{ $service->service_name }}</h4>
      </div>
      {!! Form::open(array('route' => ['agency-services.update',$service->_id],'class'=>'form-horizontal','method'=>'PUT','files'=>'true')) !!}
      {{ csrf_field() }}
      <div class="modal-body">
        <div class="row">
        	<div class="form-group col-sm-12">
	            <label class="control-label col-md-3 col-sm-3">Status :</label>
	            <div class="col-md-2 col-sm-2">
	                <div class="radio">
	                    <label>
	                        <input type="radio" name="status" value="1" id="radio-required" data-parsley-required="true" @if($service->status== '1') checked @endif> Active
	                    </label>
	                </div>
	            </div>

	            <div class="col-md-3 col-sm-3">
	                <div class="radio">
	                    <label>
	                        <input type="radio" name="status" id="radio-required2" value="0" @if($service->status== '0') checked @endif> Inactive
	                    </label>
	                </div>
	            </div> 
	        </div>
	        <div class="form-group col-sm-12" >
	            <label class="control-label col-sm-3">Services name* : </label>
	            <div class="col-sm-9">
	              <input type="text" value="{{$service->service_name}}" class="form-control" name="service_name" required="required">  
	                  
	            </div>
	        </div>
	        <div class="form-group col-sm-12" >
	            <label class="control-label col-sm-3">Services description* : </label>
	            <div class="col-sm-9">
	              <textarea rows="6" placeholder="Type services details..." class="form-control" name="description" required="required" style="width: 100%; height: 100%">{{$service->description}}</textarea>
	                  
	            </div>
	        </div>
	        <div class="form-group col-sm-12" >
	            <label class="control-label col-sm-3">Services logo* : </label>
	            <div class="col-sm-9">
	              <div class="input-group">
	                  <label class="slide_upload" for="file" style="bottom:0">
	                      <!--  -->
	                      <img id="image_load" src='{{asset("images/agency/services$service->image")}}'>
	                  </label>
	                  <input type="file" id="file" name="image" onchange="readURL(this,this.id)" style="display:none">
	              </div>  
	                  
	            </div>
	        </div>
        </div>		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      {!! Form::close(); !!}
    </div>
  </div>
</div>
