<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use Auth;
use Session;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function likeReply($reply_id)
    {
        $like = Like::create([
            'user_id' => Auth::user()->id,
            'reply_id' => $reply_id
        ]);
        $like->save();
        return redirect()->back();
    }

    public function dislikeReply($reply_id)
    {
        $like = Like::where(['user_id' => Auth::id(), 'reply_id' => $reply_id]);
        $like->delete();
        return redirect()->back();
    }
}
