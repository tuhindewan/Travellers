<style>
  textarea.edit-textarea{overflow-y: scroll !important; height: 250px !important; overflow:auto !important;}
  #pac-input::-webkit-input-placeholder {
      color: black;
  }
  #pac-input:-moz-placeholder {
      color: black;

  }
  #pac-input::-moz-placeholder {
      color: black;

  }
  #post_body::-webkit-input-placeholder {
      color: black;
  }
  #post_body:-moz-placeholder {
      color: black;

  }
  #post_body::-moz-placeholder {
      color: black;

  }

</style>
<div class="section">
  <div class="overlay-modal overlay-modal-edit" style="margin-left: -225px; display: none;">
    <div class="travel_dialog show_travel_edit" style="min-height: 90px;">
      <div class="fade-box-edit fade-box">
        <div class="inner_gray clearfix">
          <div class="inner_gray_text">
           Post  
          </div>
          <div class="inner_gray_close_button">
            <a href="#" class="close" role="button" title="Close">Close</a>
          </div>
        </div>
        <div class="inner_body">
          {!! Form::open(array('route' => 'user-post.store','class'=>'form-horizontal','method'=>'POST','files'=>'true')) !!}
          {!! csrf_field() !!}
          <input type="hidden" name="fk_user_id" value="{{Auth::user()->_id}}" > 
          <input type="hidden" name="posted_by" value="0" > 
          <div class="inner_body_content">
            <select name="post_type" required="required" class="form-control chosen">            
              <option value=""> - Select Post Type - </option>
              <option value="1">Suggestion</option>
              <option value="2">Question</option>
              <option value="3">Plane</option>
              <option value="4">Experience</option> 
            </select>
              <div class="modal-body">
              
                  <div class="body-content" style="margin: 0 15px;">
                    <div class="form-group" style="margin-bottom: 0px;">
                        <div>  
                            <input id="pac-input" name="place" class="controls form-control" placeholder="Type the location" ame="location" type="text" required>  
                            <div id="map-canvas"> </div>  
                            <input name="lat" class="lat" type="hidden">  
                            <input name="lon" class="lon" type="hidden">  
                        </div>
                      </div>
                      <br>
                  <div class="form-group">
                    <textarea id=post_body name="description" class="form-control post-body edit-textarea" id="description" rows="10" placeholder="What's on your mind?"></textarea>
                  </div>
                  </div>

                <!-- load live image /video -->
                <div class="row">
                  <div class="load_select_option">
                    <div class="file_load" style="display: inline;"></div>
                    <div class="load_chose_file"></div>
                  </div>
                </div>
                
            <hr>
            <div class="post-bottom">
              <div class="row">
                <div class="add_file_button col-md-6">
                  <label class="" for="post_file">
                        <a class="btn btn-success add_photo">Add Photo/Video </a>
                      </label>
                  <input type="file" id="post_file" multiple onchange="readURL(this,this.id)" style="display:none;">

                </div>
                <div class="add_current_location col-md-6">
                  <a class="btn btn-info add_photo">Add Location</a>  
                  
                </div>
              </div>
                  
            </div>
              </div>
          </div>
          <div class="inner_buttons">
            <button type="submit" class="btn btn-primary">Post</button>
            <a class="cancel_modal_button cancel_edit" role="button"> Cancel </a>
          </div>
          {!! Form::close(); !!}
        </div>
      </div>
    </div>
  </div>
</div>