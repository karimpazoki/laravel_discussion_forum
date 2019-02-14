<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reply;
use Auth;
use Session;

class ReplyController extends Controller
{
    public function store($id)
    {
        $r = request();
        $r->validate([
            'content' => 'required'
        ]);

        $reply = Reply::create([
            'content' => $r->content,
            'discussion_id' => $id,
            'user_id' => Auth::id()
        ]);
        $reply->save();
        Session::flash('success', 'Your reply posted successfully!');
        return redirect()->back();
    }

    public function edit($id)
    {
        $reply = Reply::find($id);
        if(Auth::user()->id == $reply->user_id or Auth::user()->admin == 1) {
            return view('reply.edit', ['reply' => $reply]);
        }
        return redirect()->back();
    }

    public function update($id)
    {
        request()->validate([
            'content' => 'required'
        ]);
        $reply = Reply::find($id);
        if(Auth::user()->id == $reply->user_id or Auth::user()->admin == 1) {
            $reply->content = request()->content;
            $reply->save();
            Session::flash('success', 'Your reply updated successfully!');
            return redirect()->route('discussion.show', ['discussion' => $reply->discussion->slug]);
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        $reply = Reply::find($id);
        if(Auth::user()->id == $reply->user_id or Auth::user()->admin == 1) {
            Reply::destroy($id);
            Session::flash('success', 'Your reply deleted successfully!');
            return redirect()->route('discussion.show', ['discussion' => $reply->discussion->slug]);
        }
        return redirect()->back();
    }
}
