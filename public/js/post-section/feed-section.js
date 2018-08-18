var app_url = $("#base_url").val();
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

/*single comment delete*/
  function Delete(id){ 
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

        //alert(id);
        $(".si_com_"+id).html(" ");
        var _token = $('input[name="_token"]').val();
        $.ajax({
            
            //url: app_url+'/post-comment/'+id,
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

/*on click focus comment button*/
function clickComment(id){
    var getMediaId = id.split("comment");
    var id = getMediaId[1];

    var center = $(window).height() / 2;
    var div = $("#comment_box"+id);
    if(div.length){
        var top = div.offset().top;
        if (top > center) {
            $('html, body').animate({
                scrollTop: top - center }, 2000);          
        }
        $(".comment-box"+id).focus();
    }
  
};
/*end click comment box focus*/

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

/*update post comment*/
function commentUpdate(e, commentId, value){
    if (e.keyCode == 13 && !e.shiftKey){
        if(value != " "){
            $("#update_comment_box"+commentId).css('display','none');
            $("#loader-update"+commentId).css('display','block');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: app_url+'/post-comment/'+commentId,
                type: "PUT",
                data: { _token : _token,
                    commentId: commentId,
                    comment: value
                },
                success: function(response){
                    $("#loader-update"+commentId).css('display','none');
                    $("#comment_box_section").css('display','block');
                    $("#comment_right"+commentId).css('display','block');
                    var center = $(window).height() / 2;
                    var div = $(".si_com_"+commentId);
                    if(div.length){
                        var top = div.offset().top;
                        if (top > center) {
                            $('html, body').animate({
                                scrollTop: top - center }, 2000);
                                    
                        }
                        $("#si_com_"+commentId).focus(); 
                            
                    }
                    var responseResult = response.replace(/\n/g, "<br />");
                    $("#comment-body-content"+commentId).html( $.trim(responseResult) ).effect('highlight',{},2500);

                }
            });
        }

    }
}

/*sub comment fouck on replay button*/
function comment_reply_box(id){
    var getMediaId = id.split("comment_reply_box");
    var id = getMediaId[1];
    $(".sub_comment_append"+id).show();

    var center = $(window).height() / 2;
    var div = $(".sub_comment"+id);
    if(div.length){
        var top = div.offset().top;
        if (top > center) {
            $('html, body').animate({
                scrollTop: top - center }, 2000);
        }
    }
        
    $(".sub_comment"+id).focus();
    
}

//edit sub comment
function singleSubCommentEdit(id){
    $(".subcomment_box_section").css('display','block');
    $(".update_sub_comment_box").css('display','none');
    $("#sub_comment_right"+id).css('display','none');    
    $("#update_sub_comment_box"+id).css('display','block');
    var center = $(window).height() / 2;
    var div = $("#update_sub_comment_box"+id);
    if(div.length){
        var top = div.offset().top;
        if (top > center) {
            $('html, body').animate({
                scrollTop: top - center }, 2000);
                       
        }
        $(".sub_comment_area"+id).focus(); 
        
    }
    
    //$("#si_com_"+id).html().effect('highlight',{},2500);  
}
/*cancel box*/
function box_cancel(id){
    $(".subcomment_box_section").css('display','block');
    $(".update_sub_comment_box").css('display','none');
}
/*update sub comment*/
function subCommentUpdate(e, commentId, value){
    if (e.keyCode == 13 && !e.shiftKey){
        if(value != " "){
            $("#update_sub_comment_box"+commentId).css('display','none');
            $("#loader-update"+commentId).css('display','block');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: app_url+'/post-sub-comment/'+commentId,
                type: "PUT",
                data: { _token : _token,
                    subComId: commentId,
                    comment: value
                },
                success: function(response){
                    $("#loader-update"+commentId).css('display','none');
                    $("#subcomment_box_section").css('display','block');
                    $("#sub_comment_right"+commentId).css('display','block');
                    var center = $(window).height() / 2;
                    var div = $(".si_sub_com_"+commentId);
                    if(div.length){
                        var top = div.offset().top;
                        if (top > center) {
                            $('html, body').animate({
                                scrollTop: top - center }, 2000);          
                        }
                        $("#si_sub_com_"+commentId).focus();     
                    }
                    var responseResult = response.replace(/\n/g, "<br />");
                    $("#sub-comment-body-content"+commentId).html( $.trim(responseResult) ).effect('highlight',{},2500);

                }
            });
        }

    }
}//

///
function showPostModal(){
    
    
    $(".overlay-modal-edit").show();
    $(".show_travel_edit").css("width", "225").animate({
        "opacity" : 1,
        height : 'auto',
        width : "448"
    }, 600, function() {
        /*When animation is done show inside content*/
        $(".fade-box").show();
    });
    //modal delete section
    $(".cancel_edit, .close").click(function() {
      $(".overlay-modal-edit").fadeOut("slow", function() {
        /*Remove inline styles*/
        $(".overlay-modal, .travel_dialog").removeAttr("style");
      });
    });
}


//
function readURL(input,image_load) {
    if (input.files && input.files[0]) {
    var i=$('i').length;
        var reader = new FileReader();
        
        reader.onload = function (e) {
            var video = 'data:video';
            var string = e.target.result;
            if(string.match(video)){
                $('.file_load').append('<div class="single_load_file" id="single_file_'+i+'"><video src="'+e.target.result+'" class="append_load_image" id="append_select_image">এই পাকনামি টা</video><button class="btn btn-danger btn-sm file_cancel_btn" id="'+i+'"><i class="fa fa-times" aria-hidden="true"></i></button><input type="hidden" name="video[]" value="'+e.target.result+'"></div>');
            }else{
                /*$('.file_load').append('<div class="single_load_file" id="single_file_'+i+'"><img src="'+e.target.result+'" class="append_load_image" id="append_select_image"><button class="btn btn-danger btn-sm file_cancel_btn" id="'+i+'"><i class="fa fa-times" aria-hidden="true"></i></button><input type="hidden" name="image[]" value="'+e.target.result+'"></div>');*/
            }

            
        }
        reader.readAsDataURL(input.files[0]);
    i++;
    }
    $('.load_chose_file').html('<label class="load_file_label" for="post_file"><div class="slide_upload"></div></label>');
    /**/
    $(".load_chose_file").removeClass('remove_file');
     
}
//
/*$(document).on('click', '.file_cancel_btn', function(){
    var id = $(this).attr('id');
    //alert(id);
    $("#single_file_"+id).remove();
    var extFile = $(".file_load").html();
    if(extFile==""){
        $(".load_chose_file").addClass('remove_file');
    }else{
        $(".load_chose_file").removeClass('remove_file');
    }

});*/
//
$(document).on('keyup keypress', 'form input[type="text"]', function(e) {
  if(e.keyCode == 13) {
    e.preventDefault();
    return false;
  }
});

function search_keyword(e, value){
    if (e.keyCode == 13 && !e.shiftKey){
        if(value != " "){
            
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: app_url+'/search',
                type: "POST",
                data: { _token : _token,
                    type:0,
                    search: value
                },
                success: function(response){
                    //console.log(response);
                   window.location.replace(response); 

                }
            });
        }

    }
}

function search_btn(){
    this.disabled = true;
    return false;
    search = $("#search-keyword").val();
    if(search === ""){
        return false;
    }else{
        return true;
    }
}


/* report section */
function report(id){
    
    getMediaId = id.split("report-data");
    id = getMediaId[1];
    $(".report-modal"+id).show();
    $(".show_report_modal"+id).css("width", "225").animate({
        "opacity" : 1,
        height : 'auto',
        width : "448"
    }, 600, function() {
        /*When animation is done show inside content*/
        $(".fade-box"+id).show();
    });
    
    //post modal cancel section
    $(".cancel_report, .close").click(function() {
      $(".show_report_modal"+id+", .report-modal"+id).fadeOut("slow", function() {
        /*Remove inline styles*/
        $(".overlay-modal, .travel_dialog").removeAttr("style");
      });
    });
}

/* featured section */
function featuredPhoto(){

    $(".featuredPhoto_modal").show();
    $(".show_featured_modal").css("width", "225").animate({
        "opacity" : 1,
        height : 'auto',
        width : "450"
    }, 600, function() {
        /*When animation is done show inside content*/
        $(".fade-box").show();
    });
    
    //post modal cancel section
    $(".cancel_modal, .close").click(function() {
      $(".show_featured_modal, .report-modal").fadeOut("slow", function() {
        /*Remove inline styles*/
        $(".overlay-modal, .travel_dialog").removeAttr("style");
      });
    });
}
/* featured choose section */
function featureChoose(){
    //console.log('hi');
    $(".show_featured_modal").css('opacity','.8');
    $(".featuredChoose_modal").show();
    $(".show_photo_choose").css("width", "225").animate({
        "opacity" : 1,
        height : 'auto',
        width : "450",
        //z-index:'55',
        //position:'fixed'
    }, 600, function() {
        /*When animation is done show inside content*/
        $(".fade-box").show();
    });
    
    //post modal cancel section
    $(".choose_cancel_modal, .choose_close").click(function() {
      $(".show_photo_choose").fadeOut("slow", function() {
        /*Remove inline styles*/
        $(".overlay-modal-choose, .choose_dialog").removeAttr("style");
        $(".show_featured_modal").css('opacity','1');
        $(".featuredChoose_modal").hide();
      });
    });
}

