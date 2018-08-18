<!-- Button trigger modal -->
<a type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#viewModal{{$service->_id}}">
  <i class="fa fa-eye"></i>
</a>

<!-- Modal -->
<div class="modal fade" id="viewModal{{$service->_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{{ $service->service_name }}</h4>
      </div>
      <div class="modal-body">
        <div class="row">
        	<div class="col-sm-12">
	        	<div class="col-sm-8">
	        		<div class="services_details">
	        			<textarea rows="15" class="form-control" readonly style="width: 100%; height: 100%">{{ $service->description }}</textarea>
	        			
	        		</div>
	        	</div>
	        	<div class="col-sm-4">
	        		<div class="services_logo">
	        			<a class="thumbnail">
					      <img src='{{asset("images/agency/services$service->image")}}' alt="{{ $service->service_name }}">
					    </a>
	        		</div>
	        	</div>
	        </div>
        </div>		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>