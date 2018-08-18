<!-- load permission -->
  <hr>
  <div class="row">
  @if(isset($getPermission))
    @foreach($getPermission as $permission)
    <?php 
      $flag=0;
      $counter=0;
      foreach($getRoleWisePermissions as $p){
        ++$counter;

        if($permission->id == $p->fk_permission_id){
          ?>
          <div class="col-md-3">
            <div class="single_permission" style="margin:10px 0;">

              <input type="checkbox" data-render="switchery" data-theme="default" name="fk_permission_id[]" id="permission_id" value="{{$permission->_id}}" checked>
              <span class="text-muted m-l-5 m-r-20">{{$permission->permission_name}}</span>
            </div>
          </div>
        <?php
          $flag=0;
          break;
              
        }else{
          $flag++;
          continue;
          }
        }
        if($flag>0 || $counter==0 ){
          ?>
          <div class="col-md-3">
            <div class="single_permission" style="margin:10px 0;">

              <input type="checkbox" data-render="switchery" data-theme="default" name="fk_permission_id[]" id="permission_id" value="{{$permission->_id}}">
              <span class="text-muted m-l-5 m-r-20">{{$permission->permission_name}}</span>
            </div>
          </div>
          <?php
        }
        ?>
    @endforeach
  @endif
  </div>

  <div id="loadDelete"></div>

  <script src="{{asset('public/backend/plugins/jquery/jquery-1.9.1.min_2.js')}}"></script>
  <script type="text/javascript">
    //
     $("input:checkbox").change(function() {
          var ischecked= $(this).is(':checked');
          exist_val = $(this).val();
          if(!ischecked)
            $('<input name="permission[]" type="hidden" />').appendTo('#loadDelete').val(exist_val);
      }); 

   
    //
    
</script>
  <script>
    $(document).ready(function() {
        // App.init();
      FormSliderSwitcher.init();
    });
  </script>

  <script type="text/javascript">
    function roleWisePermission(value){
      if(value === '-1'){
          $("#roleWisePermission").hide();
      }else{

        $("#roleWisePermission").load("{{ URL::to('role-wise-permission')}}"+'/'+value);
        $("#roleWisePermission").show();
      }
    }
  </script>

      
