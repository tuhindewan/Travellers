<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\Models\Posts;


class ConnectionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','checkstatus']);
    }
    public function index()
    {
        
        return view('frontend.connection.index');
    }

    public function popularPost($type)
    {
        $getPopularPost = Posts::where('post_type',$type)->orderBy('hits_count','desc')->get();
        return json_encode($getPopularPost);
    }

    
}
