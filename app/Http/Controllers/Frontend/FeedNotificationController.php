<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\PostLike;
use App\Models\PostComment;
use App\Models\FeedNotification;
use App\Models\PostCommentLike;
use App\Models\PostSubComment;
use Auth;
use Validator;
use DB;

class FeedNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getNotification = json_decode($this->create());
        //return count($getNotification);
        return view('frontend.profile_settings.user_notification', compact('getNotification'));
    }

    public function data()
    {
        $getNotification = FeedNotification::where('fk_user_id','!=',\Auth::user()->_id)->orderBy('created_at','desc')->get();
        $checkAccessUser = array();
        $likeUser = array();
        //like section
        for ($i=0; $i < count($getNotification); $i++) {

            $checkAccess = PostLike::checkUserLike($getNotification[$i]['thread_id']);

            for ($c=0; $c < count($checkAccess); $c++) { 
              $likeUser[] = $checkAccess[$c]->fk_user_id;  
            }
            
        }

        //comment section
        $commentUser = array();
        $subCommentUser = array();
        $commentLikeUser = array();
        for ($i=0; $i < count($getNotification); $i++) {

            $checkAccess = PostComment::checkUserComment($getNotification[$i]['thread_id']);
            for ($c=0; $c < count($checkAccess); $c++) { 
              $commentUser[] = $checkAccess[$c]->fk_user_id;

                //comment like section
                $checkSubAccess = PostCommentLike::checkUserCommentLike($checkAccess[$c]['_id']);
                for ($l=0; $l < count($checkSubAccess); $l++) { 
                  $commentLikeUser[] = $checkSubAccess[$l]->fk_user_id;  
                }

                //sub comment section
                $checkSubAccess = PostSubComment::checkUserSubComment($checkAccess[$c]['_id']);
                for ($s=0; $s < count($checkSubAccess); $s++) { 
                  $subCommentUser[] = $checkSubAccess[$s]->fk_user_id;  
                }
            }
            
        }

        //sub comment section
        $commentUser = array();
        for ($i=0; $i < count($getNotification); $i++) {

            $checkAccess = PostComment::checkUserComment($getNotification[$i]['thread_id']);
            for ($c=0; $c < count($checkAccess); $c++) { 
              $commentUser[] = $checkAccess[$c]->fk_user_id;  
            }
            
        }
        
        return $subCommentUser;
        return array_merge($likeUser, $commentUser);

        return json_encode($getNotification);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authId = Auth::user()->_id;
        $getPostLike = PostLike::where('fk_user_id',$authId)->get();
        $getPostComment = PostComment::where('fk_user_id',$authId)->get();
        $getPostCommentLike = PostCommentLike::where('fk_user_id',$authId)->get();
        $getPostCommentSubCom = PostSubComment::where('fk_user_id',$authId)->get();

        $getNotification = FeedNotification::where('fk_user_id','!=',\Auth::user()->_id)->orderBy('created_at','desc')->get();


        
        $myNotify = array();

        for ($i=0; $i < count($getNotification); $i++) { 
            //post

            if($getNotification[$i]->posts['fk_user_id'] == $authId){
                $myNotify[] = $getNotification[$i];
                $post = 1;
            }else{
                $post = 0;
            }

            if($post==0){

                if(count($getPostLike) > 0){
                  $postLike = $getNotification[$i]->posts->post_like; 

                  $countPostLike = count($postLike);
                  for ($p=0; $p < $countPostLike; $p++) { 
                      if($postLike[$p]['fk_user_id'] == $authId){
                          $myNotify[] = $getNotification[$i];
                          $postL = 1;   
                      }else{
                          $postL = 0;
                      }
                  }
                }else{
                  $postL = 0;
                }

                if($postL == 0){
                    if(count($getPostComment) > 0){
                      $postComment = $getNotification[$i]->posts->post_comment; 
                      $countPostComment = count($postComment);
                      //return $countPostComment;
                      for ($c=0; $c < $countPostComment; $c++) { 
                          
                          if($postComment[$c]['fk_user_id'] == $authId){
                              $myNotify[] = $getNotification[$i];
                              $postC = 1;
                              $c = $countPostComment + 1;   
                          }else{
                              $postC = 0;
                          }
                      }
                    }else{
                      $postC = 0;
                    }
                    
                    if($postC == 0){
                        if(count($getPostCommentLike) > 0){
                          $postCommentLike = $getNotification[$i]->posts->post_comment->post_comment_like; 
                          $countPostCommentLike = count($postCommentLike);
                          for ($l=0; $l < $countPostCommentLike; $l++) { 
                              if($postCommentLike[$l]['fk_user_id'] == $authId){
                                  $myNotify[] = $getNotification[$i];
                                  $postCL = 1;
                                  $l = $countPostCommentLike + 1;   
                              }else{
                                  $postCL = 0;
                              }
                          }
                        }else{
                          $postCL = 0;
                        }

                        if($postCL == 0){
                          if(count($getPostCommentSubCom) > 0){
                            $postCommentSub = $getNotification[$i]->posts->post_comment->post_sub_comment; 
                              $countPostCommentSub = count($postCommentSub);
                              for ($x=0; $x < $countPostCommentSub; $x++) { 
                                  if($postCommentSub[$x]['fk_user_id'] == $authId){
                                      $myNotify[] = $getNotification[$i];
                                      $postCS = 1;
                                      $x = $countPostCommentSub + 1; 
                                  }else{
                                      $postCS = 0;
                                  }
                              }
                          }    
                        }
                    }    
                }
            }
        }
        
        return json_encode($myNotify);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $getNotify = FeedNotification::findOrFail($id);
        $getNotify->update([
            'is_unread' => 1
        ]);
        return $getNotify->thread_id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
