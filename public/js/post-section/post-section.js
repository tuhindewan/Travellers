var app_url = $("#base_url").val();
/*post section start*/
function singlePostEdit(id){
    getMediaId = id.split("post-ed");
    id = getMediaId[1];
    $(".post-modal-edit"+id).show();
    $(".show_post_edit"+id).css("width", "225").animate({
        "opacity" : 1,
        height : 'auto',
        width : "448"
    }, 600, function() {
        /*When animation is done show inside content*/
        $(".fade-box"+id).show();
    });
    // post edit modal section
    $(".edit_post"+id).click(function() {

        //alert(id);
        var _token = $('input[name="_token"]').val();
        var post = $("#post-edit"+id).val();

        $.ajax({
            url: app_url+'/user-post/'+id,
            type: "PUT",
            data: { _token : _token,
                postId: id,
                description: post
            },
            success: function(response){
                
                //
                var center = $(window).height() / 2;
                var top = $(".post-body"+id).offset().top;
                if (top > center) {
                    $('html, body').animate({
                        scrollTop: top - center }, 2000);
                    $(".post-body"+id).focus();           
                }else{
                   $(".post-body"+id).focus(); 
                }
                $("#post-content-text"+id).html( $.trim(response) ).effect('highlight',{},2500);

            }
        });

        $(".overlay-modal-edit"+id+", .show_travel_modal"+id).fadeOut("slow", function() {
            /*Remove inline styles*/
            $(".overlay-modal, .travel_dialog").removeAttr("style");
        });
    });
    //post modal cancel section
    $(".cancel_edit, .close").click(function() {
      $(".show_post_edit"+id+", .post-modal-edit"+id).fadeOut("slow", function() {
        /*Remove inline styles*/
        $(".overlay-modal, .travel_dialog").removeAttr("style");
      });
    });
}

/*post section end*/


/*like section start js*/

$(".heart_icon").mouseout(function() {
  $(this).removeAttr("style");
});
function like(id){


    var getMediaId = id.split("heart");
    var id = getMediaId[1]; // Result is the media Id from div called "heart"

    var rel = $("#heart" + id).attr('rel');
    var userId = $("#heart" + id).attr('user');
   
    var _token = $('input[name="_token"]').val();
    $.ajax({
        //url: '/'+"{{URL::to('/')}}"+'post-like',
        url: app_url+'/post-like',
        type: "POST",
        data: { _token : _token,
            userId:  userId,
            status: rel,
            postId: id 
        },
        success: function(response){
            //console.log(response);
            $("#like_love_"+id).html(response);
        }
    });
    //alert(user);
    if (rel == 0) {
        $("#heart" + id).removeClass("off").addClass("on heartAnimation");
        $("#heart" + id).attr('rel','1');
    } else if (rel == 1) {
        $("#heart" + id).removeClass("on heartAnimation").addClass("off").css("background-position","left");
        $("#heart" + id).attr('rel','0');
    }
};

/*like section end js*/

/*comment section start js*/
function comment( e , id){

    if (e.keyCode == 13 && !e.shiftKey)
    {        
        e.preventDefault();
        //now call the code to submit your form
        var getId = id.split("description");
        var id = getId[1];
        description = $("#description"+id).val();
        check = description.replace( /\s\s+/g, '' );
        
        if(check != ""){
            var userId = $("#description" + id).attr('user');
   
            var _token = $('input[name="_token"]').val();
            $.ajax({
                //url: '/'+"{{URL::to('/')}}"+'post-like',
                url: app_url+'/post-comment',
                type: "POST",
                data: { _token : _token,
                    userId:  userId,
                    text: description,
                    postId: id 
                },
                success: function(response){
                    //
                    $("#append_comment_"+id).append(response);
                }
            });
            //console.log(description);
            $("#description"+id).val("").css("height", "auto");
            return;    
        }
        
    }

    // if (e.keyCode == 13 && e.shiftKey)
    // {       
    //     //this is the shift+enter right now it does go to a new line
    //     //alert("shift+enter was pressed");        
    // }    
  };
/*comment section end js*/

/*single comment section edit*/
$(".overlay-modal, .travel_dialog").css("opacity", 1);
  $(".overlay-modal").show();
  var editheight = $(".fade-box-edit").height();
  var deleteheight = $(".fade-box-delete").height();
  $(".overlay-modal, .travel_dialog").css("opacity", 0);
  /*Remove inline styles*/
  $(".overlay-modal, .travel_dialog").removeAttr("style");

  /*Set min height to 90px after fbheight has been set*/
  $(".travel_dialog").css("min-height", "90px");


  //post comment edit
  function singleCommentEdit(id){
    //alert(id);
    getMediaId = id.split("post-com-ed");
    id = getMediaId[1];
    //$(".overlay-modal-edit"+id).css('display','block');
    $(".overlay-modal-edit"+id).show();
    $(".show_travel_edit"+id).css("width", "225").animate({
        "opacity" : 1,
        height : 'auto',
        width : "448"
    }, 600, function() {
        /*When animation is done show inside content*/
        $(".fade-box"+id).show();
    });

    // modal update comment
    $(".edit_button_ok"+id).click(function() {

        //alert(id);

        // $(".si_com_"+id).html(" ");
        var _token = $('input[name="_token"]').val();
        var comment = $("#post-comment-edit"+id).val();
        
        //alert(comment);
        $.ajax({
        //     //url: '/'+"{{URL::to('/')}}"+'post-like',
            url: app_url+'/post-comment/'+id,
            type: "PUT",
            data: { _token : _token,
                commentId: id,
                comment: comment
            },
            success: function(response){
                //alert(response);
                //$("#comment-body-content"+id).html(response);
                var center = $(window).height() / 2;
                var top = $(".si_com_"+id).offset().top;
                if (top > center) {
                    $('html, body').animate({
                        scrollTop: top - center }, 2000);
                    $(".si_com_"+id).focus();           
                }else{
                   $(".si_com_"+id).focus(); 
                }
                $("#post-comment-right"+id).html( $.trim(response) ).effect('highlight',{},2500);

            }
        });

        $(".overlay-modal-edit"+id+", .show_travel_modal"+id).fadeOut("slow", function() {
            /*Remove inline styles*/
            $(".overlay-modal, .travel_dialog").removeAttr("style");
        });
    });

    //modal delete section
    $(".cancel_edit, .close").click(function() {
      $(".overlay-modal-eidt"+id+", .show_travel_edit"+id).fadeOut("slow", function() {
        /*Remove inline styles*/
        $(".overlay-modal, .travel_dialog").removeAttr("style");
      });
    });
  }


  //post comment delete
  function singleCommentDelete(id){
    getMediaId = id.split("post-comment");
    id = getMediaId[1]; 
    /*Show the dialog overlay-modal*/
    $(".overlay-modal-delete"+id).show();
    /*Animate Dialog*/
    $(".show_travel_modal"+id).css("width", "225").animate({
        "opacity" : 1,
        height : deleteheight,
        width : "448"
    }, 600, function() {
        /*When animation is done show inside content*/
        $(".fade-box"+id).show();
    });
    //
    /*$(".delete_button_ok"+id).click(function() {

        //alert(id);
        $(".si_com_"+id).html(" ");
        var _token = $('input[name="_token"]').val();
        $.ajax({
            
            url: app_url+'/post-comment/'+id,
            type: "DELETE",
            data: { _token : _token
            },
            success: function(response){
                //
                //console.log(response);
                valueData = response.split("_");
                counter = valueData[1]; 
                postId = valueData[0];
                $("#comment_counter"+postId).html(counter);
                
                $(".si_com_"+id).remove();
            }
        });

        $(".overlay-modal-delete"+id+", .show_travel_modal"+id).fadeOut("slow", function() {
            /*Remove inline styles*/
            $(".overlay-modal, .travel_dialog").removeAttr("style");
        });
    });*/

    //modal delete section
    $(".cancel_delete, .close").click(function() {
      $(".overlay-modal-delete"+id+", .show_travel_modal"+id).fadeOut("slow", function() {
        /*Remove inline styles*/
        $(".overlay-modal, .travel_dialog").removeAttr("style");
      });
    });
  };
/*end*/



/*on click focus comment button*/
function clickComment(id){
    var getMediaId = id.split("comment");
    var id = getMediaId[1];

    var center = $(window).height() / 2;
    var top = $("#description"+id).offset().top;
        if (top > center) {
            $('html, body').animate({
                scrollTop: top - center }, 2000);
        }
        $("#description"+id).focus(); 

    //$("#description"+id).focus();  
};
/*end click comment box focus*/

/*previous_comment_load section*/
function previous_comment_load(id){
    var getMediaId = id.split("all_comment");
    var id = getMediaId[1];
    $("#show-comment-limit"+id).hide();
    $("#load-all-comment"+id).fadeOut('slow').load(app_url+'/all-comment/'+id).fadeIn('slow').addClass('show_comment');
    $("#view-previous-comment"+id).css('display','none');
    //$("#loader"+id).html(' ');

}
/*previous_comment_load section end*/

/*comment replay section start*/
function comment_reply_box(id){
    
    var getMediaId = id.split("comment_reply_box");
    var id = getMediaId[1];
    $(".sub_comment"+id).show();

    var center = $(window).height() / 2;
    var div = $("#sub_comment"+id);
    if(div.length){
        var top = div.offset().top;
        if (top > center) {
            $('html, body').animate({
                scrollTop: top - center }, 2000);
        }
    }
        
    $("#sub_comment"+id).focus();
    
}

//sub comment post in database
function sub_comment( e, commentId, value){
    //alert("a");
    if (e.keyCode == 13 && !e.shiftKey)
    {  
    
        e.preventDefault();
        //now call the code to submit your form
        var getId = commentId.split("sub_comment");
        var id = getId[1];
        var check = value.replace( /\s\s+/g, '' );
       
        if(check != ""){
            var _token = $('input[name="_token"]').val();
            $.ajax({
                //url: '/'+"{{URL::to('/')}}"+'post-like',
                url: app_url+'/post-sub-comment',
                type: "POST",
                data: { _token : _token,
                    text: value,
                    commentId: id 
                },
                success: function(response){
                    console.log(response);
                    $("#append_sub_comment_"+id).append(response);
                }
            });
            
            $("#sub_comment"+id).val("").css("height", "auto");
            return;    
        }
        
    }
   
  };
/*comment replay section end*/
function singleSubCommentEdit(subComId){
    var getId = subComId.split("sub-com-ed");
    var id = getId[1];
    subComment = $("#sub-comment-body-content"+id).html();
    comId = $("#sub-com-ed" + id).attr('com-id');

    $("#post-sub-comment-right"+id).hide();
    $("#sub_com_option"+id).hide();
    $("#edit-sub-com-app"+id).show();
    $(".option_btn").hide();
    appendBox = '<textarea name="sub_comment" class="form-control post-sub-comment" id="sub_comment'+id+'" onkeypress="sub_comment_update(event , this.id, this.value)" placeholder="Write a sub comment...">'+subComment+'</textarea><a href="javascript:void(0)" class="cancel_box" id="'+id+'" onclick="box_cancel(this.id)">Cancel</a>';
    $("#edit-sub-com-app"+id).html(appendBox);
    $("#sub_comment"+id).focus();


}
///
//post comment delete
  function singleSubCommentDelete(id){
    getMediaId = id.split("post-sub-comment");
    id = getMediaId[1]; 

    /*Show the dialog overlay-modal*/
    $(".overlay-modal-delete"+id).show();
    /*Animate Dialog*/
    $(".show_travel_modal"+id).css("width", "225").animate({
        "opacity" : 1,
        height : deleteheight,
        width : "448"
    }, 600, function() {
        /*When animation is done show inside content*/
        $(".fade-box"+id).show();
    });
    //
    $(".delete_button_ok"+id).click(function() {
        
        
        $("#si_sub_com_"+id).html(" ");
        var _token = $('input[name="_token"]').val();
        $.ajax({
            
            //url: app_url+'/post-sub-comment/'+id,
            url: app_url+'/post-sub-comment/'+id,
            type: 'DELETE',
            //dataType: 'json',
            data: {
                _token: _token
            },
            success: function(response){
                //
                //alert(response);
                // valueData = response.split("_");
                // counter = valueData[1]; 
                // postId = valueData[0];
                // $("#comment_counter"+postId).html(counter);
                
                // $(".si_com_"+id).remove();
            }
        });

        $(".overlay-modal-delete"+id+", .show_travel_modal"+id).fadeOut("slow", function() {
            /*Remove inline styles*/
            $(".overlay-modal, .travel_dialog").removeAttr("style");
        });
    });

    //modal delete section
    $(".cancel_delete, .close").click(function() {
      $(".overlay-modal-delete"+id+", .show_travel_modal"+id).fadeOut("slow", function() {
        /*Remove inline styles*/
        $(".overlay-modal, .travel_dialog").removeAttr("style");
      });
    });
  };
/*end*/
/*sub comment update */
//sub comment post in database
function sub_comment_update( e, subComId, value){
    //alert(value);
    if (e.keyCode == 13 && !e.shiftKey)
    {  
    
        e.preventDefault();
        //now call the code to submit your form
        var getId = subComId.split("sub_comment");
        var id = getId[1];
        var check = value.replace( /\s\s+/g, '' );
       
        if(check != ""){
            var _token = $('input[name="_token"]').val();
            $.ajax({
                //url: '/'+"{{URL::to('/')}}"+'post-like',
                url: app_url+'/post-sub-comment/'+id,
                type: "PUT",
                data: { _token : _token,
                    comment: value,
                    subComId: id 
                },
                success: function(response){
                    console.log(response);
                    $("#post-sub-comment-right"+id).css('display','block');
                    $("#sub_com_option"+id).show();
                    $("#edit-sub-com-app"+id).hide();
                    $(".option_btn").show();
                    var center = $(window).height() / 2;
                    var top = $("#si_sub_com_"+id).offset().top;
                    if (top > center) {
                        $('html, body').animate({
                            scrollTop: top - center }, 2000);
                        $("#si_sub_com_"+id).focus();           
                    }else{
                       $("#si_sub_com_"+id).focus(); 
                    }
                    $("#post-sub-comment-right"+id).html( $.trim(response) ).effect('highlight',{},2500);
                }
            });
            
            $("#sub_comment"+id).val("").css("height", "auto");
            return;    
        }
        
    }
   
  };
  /*sub comment update section end*/


//edit comment
function editComment(id){
    $(".comment_box_section").css('display','block');
    $(".update_comment_box").css('display','none');
    $("#comment_right"+id).css('display','none');    
    $("#update_comment_box"+id).css('display','block');
    var center = $(window).height() / 2;
    var div = $("#update_comment_box"+id);
    if(div.length){
        var top = div.offset().top;
        if (top > center) {
            $('html, body').animate({
                scrollTop: top - center }, 2000);
            $(".comment_area"+id).focus();           
        }else{
           $(".comment_area"+id).focus(); 
        }
    }
    
    //$("#si_com_"+id).html().effect('highlight',{},2500);  
}
/*cancel box*/
function box_cancel(id){
    
    $(".comment_box_section").css('display','block');
    $(".update_comment_box").css('display','none');
}




