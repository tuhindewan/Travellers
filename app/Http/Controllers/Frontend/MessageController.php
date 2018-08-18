<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\MessagePosted;
use Illuminate\Support\Facades\Log;
use App\User;
use App\Message;
use App\Receiver;
use App\Models\MessageNotification;
use Auth;
use DB;
use URL;
class MessageController extends Controller
{
	public function __construct()
    {
        $this->middleware(['auth','checkstatus']);
    }
    public function sendMessage(Request $request,$userId){
    	
    	$user = Auth::user();
    	$id = Auth::user()->_id;
    	$userInfo = User::findOrFail($id);
    	$input = $request->all();
    	//$message = Message::createMessage($input);
	    $message = $user->messages()->create([
	        'message'=>request()->get('message'),
	        'type'=>request()->get('type'),
	    ]);
    	//$receivers = Receiver::createReceiver($input);
	    $message->receivers()->create([
	        'user_id'=>$userId
	    ]);

	    //check conversation and add
	    $checkMe = MessageNotification::existsConversationSender($id,$userId);
	    $checkFriend = MessageNotification::existsConversationReceiver($userId,$id);
	    if(count($checkMe)>0 || count($checkFriend)>0){
	    	if(count($checkMe)>0){
	    		$tId = $checkMe['_id'];
	    	}elseif(count($checkFriend)>0){
	    		$tId = $checkFriend['_id'];
	    	}else{
	    		return redirect()->back();
	    	}	
	    	MessageNotification::updateChatConvertion($tId, $userId);
	    }else{
	    	MessageNotification::insertChatConvertion($id, $userId);
	    }
	    //$user = Auth::user()->fullname;
	    // // new message has been posted
	    $image_path = URL::to('/images/users/profile/s160').$userInfo['profile_image'];
	    broadcast(new MessagePosted($message,$user,$userId,$image_path))->toOthers();
	    $obj = new User();
	    $obj->image = $image_path;
	    $output['message'] = $message;
	    $output['user'] = $user;
	    $output['image_path'] = $image_path;
	    return ['output'=> $output];
    }

    public function sendFile($userId){
    	$file = request('file');
	    $user = Auth::user();
	    if (!empty($file)) {
	        $fileName = $file->getClientOriginalName();
	        // file with path
	        $filePath = url('uploads/chats/'.$fileName);
	        //Move Uploaded File
	        $destinationPath = 'uploads/chats';
	        if($file->move($destinationPath,$fileName)) {
	            $request['file_path'] = $filePath;
	            $request['file_name'] = $fileName;
	            $request['message'] = 'file';
	            $request['type'] = request('type');
	        }

	        $message = $user->messages()->create($request);

	        $message->receivers()->create([
	                'user_id'=>$userId
	            ]);

	        //check conversation and add
		    $checkMe = MessageNotification::existsConversationSender($id,$userId);
		    $checkFriend = MessageNotification::existsConversationReceiver($userId,$id);
		    if(count($checkMe)>0 || count($checkFriend)>0){
		    	if(count($checkMe)>0){
		    		$tId = $checkMe['_id'];
		    	}elseif(count($checkFriend)>0){
		    		$tId = $checkFriend['_id'];
		    	}else{
		    		return redirect()->back();
		    	}	
		    		
		    	MessageNotification::updateChatConvertion($tId, $userId);
		    }else{
		    	MessageNotification::insertChatConvertion($id, $userId);
		    }
	        $output = [];
	        broadcast(new MessagePosted($message,$user,$userId))->toOthers();

	        $output['message'] = $message;
	        $output['user'] = $user;
	        return ['output'=> $output];
	    }
    }

    public function getMessage($userId){
    	$authUserId = Auth::user()->id;

	    /*$output = DB::table('messages')
	        ->leftJoin('users','users.id',  '=',    'messages.user_id')
	        ->join('receivers','receivers.message_id','=','messages.id')
	        ->where('messages.user_id','=',$authUserId)
	        ->where('receivers.user_id','=',$userId)
	        ->orWhere('messages.user_id','=',$userId)
	        ->where('receivers.user_id','=',$authUserId)
	        ->select('users.name as user','users.image','users.image_path','users.id as userId','messages.user_id as sendUserId','messages.message','messages.file_path','messages.file_name','messages.type','messages.created_at as time','receivers.user_id as r_user_id')
	        ->orderBy("messages.id","asc")
	        ->get();*/


	        //$authUserId->messages();
	    $sender = Message::orderBy('_id','asc')->get();

	    $i=0;
	    $data = array();

	    foreach ($sender as $send) {
	    	if($send->user_id == Auth::user()->_id && $send->receivers[0]->user_id == $userId){
		    	$id = User::findOrFail($authUserId);
		    	$userImage = URL::to('images/users/profile/s160').$id['profile_image'];
		    	$obj = new Message();
		    	$obj->user = $send->user->username;
		    	$obj->image_path = $userImage;
		    	$obj->userId = $userId;
		    	$obj->sendUserId = $authUserId;
		    	$obj->message = $send->message;
		    	$obj->file_path = $send->file_path;
		    	$obj->file_name = $send->file_name;
		    	$obj->type = $send->type;
		    	$obj->time = $send->created_at->diffForHumans();
		    	$obj->r_user_id = $send->receivers[0]->user_id;
		    	$i++;

		    	$data[]=$obj;
		    	
		    }

		    
		    if($send->user_id == $userId && $send->receivers[0]->user_id == Auth::user()->_id){
		    	$id = User::findOrFail($userId);
		    	$userImage = URL::to('images/users/profile/s160').$id['profile_image'];
		    	$obj = new Message();
		    	$obj->user = $send->user->username;
		    	$obj->image_path = $userImage;
		    	$obj->userId = $authUserId;
		    	$obj->sendUserId = $userId;
		    	$obj->message = $send->message;
		    	$obj->file_path = $send->file_path;
		    	$obj->file_name = $send->file_name;
		    	$obj->type = $send->type;
		    	$obj->time = $send->created_at->diffForHumans();
		    	$obj->r_user_id = $send->receivers[0]->user_id;
		    	$i++;

		    	$data[]=$obj;
		    	
		    }
		   
		    
	    }
	    
	    return json_encode($data);
    }

    // message notification show count
    public function notificationCount(){
    	$id = Auth::user()->_id;
    	$notificationSender = MessageNotification::getNotificationSenderCount($id);
    	$notificationReceiver = MessageNotification::getNotificationReceiverCount($id);
    	$countData = count($notificationSender) +count($notificationReceiver);
    	
    	return $countData;	
    }

    // send friend message notification count
    public function notificationCountSend($id){
    	$notificationSender = MessageNotification::getNotificationSenderCount($id);
    	$notificationReceiver = MessageNotification::getNotificationReceiverCount($id);
    	$countData = (count($notificationSender) +count($notificationReceiver)) +1;
    	
    	return $countData;	
    }

    // update notification count
    public function notificationCountUpdate($senderId){
    	$id = Auth::user()->_id;

    	$send = MessageNotification::existsConversationSender($id,$senderId);
    	$receive = MessageNotification::existsConversationReceiver($senderId,$id);

    	if(count($send)>0){
    		$t_id = $send['_id'];
    	}elseif(count($receive)>0){
    		$t_id = $receive['_id'];
    	}else{
    		$t_id = null;
    	}


    	MessageNotification::where('_id',$t_id)->update([
    		'status'=>1,
    		'updated_at' => date('Y-m-d h:i:s')
    	]);
    	
    	$countNotification = $this->notificationCount();

    	return $countNotification;	
    }

    // message notification show
    public function notification(){
    	$id = Auth::user()->_id;
    	$notificationSender = MessageNotification::getNotificationSender($id);
    	$notificationReceiver = MessageNotification::getNotificationReceiver($id);

    	$allNoti = array_merge($notificationSender,$notificationReceiver);
    	$sender = Message::orderBy('_id','asc')->get();
    	/*echo "<pre>";
    	print_r($allNoti);*/
	    $i=0;
	    $messageData = array();

	    
    	foreach ($allNoti as $data) {
    		$senderId = $data['sender_id'];
    		$receiverId = $data['receiver_id'];
    		foreach ($sender as $send) {
    			if($data['sender_id']==$id){
    				$reciver_me = $data['receiver_id'];
			    	if($send->user_id == $id && $send->receivers[0]->user_id == $reciver_me){
			    		$obj = new Message();
				    	$obj->message = $send->message;
				    	$userInfo = User::findOrFail($reciver_me);
				    	$obj->id = $userInfo->_id;
				    	$obj->name = $userInfo->fullname;
				    	$obj->picture = URL::to('images/users/profile/s160').$userInfo->profile_image;
				    	$obj->time = $send->created_at->diffForHumans();
				    	$obj->type = $data['status'];
				    	$obj->activity = $userInfo->activity;
				    	$i++;
				    }
				}

				if($data['receiver_id']==$id){
	    			$reciver_me = $data['sender_id'];
			    
				    if($send->user_id == $reciver_me && $send->receivers[0]->user_id == $id){
				    	$obj = new Message();
				    	$obj->message = $send->message;
				    	$userInfo = User::findOrFail($reciver_me);
				    	$obj->id = $userInfo->_id;
				    	$obj->name = $userInfo->fullname;
				    	$obj->picture = URL::to('images/users/profile/s160').$userInfo->profile_image;
				    	$obj->time = $send->created_at->diffForHumans();
				    	$obj->type = $data['status'];
				    	$obj->activity = $userInfo->activity;
				    	$i++;
				    	
				    }
				}
    		
			   
			    
		    }
		    $messageData[] = $obj;
		    
    	}
    	
		return json_encode($messageData);
	
    }
    
}
